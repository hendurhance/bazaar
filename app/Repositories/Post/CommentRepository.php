<?php

namespace App\Repositories\Post;

use App\Abstracts\BaseCrudRepository;
use App\Models\Comment;
use App\Contracts\Repositories\CommentRepositoryInterface;
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
     * @param \App\Models\User $user
     * @return void
     */
    public function storeComment(array $data, string $slug, User $user): void
    {
        $post = app(PostRepository::class)->findBy('slug', $slug, function () {
            abort(404);
        });
        
        if($data['reply_to']) {
            $parentComment = $this->findBy('id', $data['reply_to'], function () {
                abort(404);
            });
            
            $post->comments()->create([
                'user_id' => $user->id,
                'parent_id' => $parentComment->id,
                'content' => $data['content']
            ]);
        } else {
            $post->comments()->create([
                'user_id' => $user->id,
                'content' => $data['content']
            ]);
        }
    }

}
