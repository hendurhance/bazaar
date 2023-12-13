<?php

namespace App\Repositories\Post;

use App\Abstracts\BaseCrudRepository;
use App\Models\Comment;
use App\Contracts\Repositories\CommentRepositoryInterface;
use App\Enums\CommentStatus;
use App\Exceptions\CommentException;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CommentRepository extends BaseCrudRepository implements CommentRepositoryInterface
{
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all comments
     * 
     * @param int $limit
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllCommentsForAdmin(int $limit = 10, array $filters = null): LengthAwarePaginator
    {
        return $this->model->query()->with(['user:id,name,username,avatar', 'admin:id,name,username,avatar', 'post:id,title,slug'])
            ->when($filters, function ($query, $filters) {
                $query->when(isset($filters['status']) && $filters['status'], function ($query) use ($filters) {
                    match (CommentStatus::from($filters['status'])) {
                        CommentStatus::APPROVED => $query->approved(),
                        CommentStatus::PENDING => $query->pending(),
                        CommentStatus::REJECTED => $query->rejected(),
                        default => $query,
                    };
                })
                    ->when(isset($filters['search']) && $filters['search'], function ($query) use ($filters) {
                        $query->where(function ($query) use ($filters) {
                            $query->where('id', $filters['search'])
                                ->orWhere('user_id', $filters['search'])
                                ->orWhere('content', 'like', '%' . $filters['search'] . '%')
                                ->orWhereHas('user', function ($query) use ($filters) {
                                    $query->where('name', 'like', '%' . $filters['search'] . '%');
                                })
                                ->orWhereHas('admin', function ($query) use ($filters) {
                                    $query->where('name', 'like', '%' . $filters['search'] . '%');
                                })
                                ->orWhereHas('post', function ($query) use ($filters) {
                                    $query->where('title', 'like', '%' . $filters['search'] . '%');
                                });
                        });
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($limit)
            ->appends([
                'status' => $filters['status'] ?? null,
                'search' => $filters['search'] ?? null,
            ]);
    }

    /**
     * Get comment
     * 
     * @param int $id
     * @return \App\Models\Comment
     */
    public function getComment(int $id): \App\Models\Comment
    {
        return $this->find($id, function () {
            throw new CommentException('Comment not found.');
        });
    }

    /**
     * Update comment
     * 
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateComment(array $data, int $id): void
    {
        $comment = $this->find($id, function () {
            throw new CommentException('Comment not found.');
        });

        $comment->update([
            'status' => $data['status'] ?? $comment->status,
            'content' => strip_tags($data['content']) ?? $comment->content,
        ]);
    }


    /**
     * Store a comment
     * 
     * @param array $data
     * @param string $slug
     * @param \App\Models\User|\App\Models\Admin $user
     * @return void
     */
    public function storeComment(array $data, string $slug, User|Admin $user): void
    {
        $post = app(PostRepository::class)->findBy('slug', $slug, function () {
            throw new CommentException('Post not found.');
        });

        if (isset($data['reply_to'])) {
            $parentComment = $this->findBy('id', $data['reply_to'], function () {
                throw new CommentException('Comment not found.');
            });

            $post->comments()->create([
                'admin_id' => $user instanceof Admin ? $user->id : null,
                'user_id' => $user instanceof User ? $user->id : null,
                'parent_id' => $parentComment->id,
                'content' => $data['content']
            ]);
        } else {
            $post->comments()->create([
                'admin_id' => $user instanceof Admin ? $user->id : null,
                'user_id' => $user instanceof User ? $user->id : null,
                'content' => $data['content']
            ]);
        }
    }
}
