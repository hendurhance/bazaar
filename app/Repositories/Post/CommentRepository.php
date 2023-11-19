<?php

namespace App\Repositories\Post;

use App\Abstracts\BaseCrudRepository;
use App\Models\Comment;
use App\Contracts\Repositories\CommentRepositoryInterface;
use App\Models\Admin;
use App\Models\User;

class CommentRepository extends BaseCrudRepository implements CommentRepositoryInterface
{
    public function __construct(Comment $model)
    {
        parent::__construct($model);
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
            abort(404);
        });
        
        if($data['reply_to']) {
            $parentComment = $this->findBy('id', $data['reply_to'], function () {
                abort(404);
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
