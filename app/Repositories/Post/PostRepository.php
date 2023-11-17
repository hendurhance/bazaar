<?php

namespace App\Repositories\Post;

use App\Abstracts\BaseCrudRepository;
use App\Models\Post;
use App\Contracts\Repositories\PostRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository extends BaseCrudRepository implements PostRepositoryInterface
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all posts
     * 
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllPosts(int $limit = 10): LengthAwarePaginator
    {
        return $this->model->query()->with(['admin:id,name,username,avatar', 'featuredImage:id,url'])
            ->published()
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
    }

    /**
     * Get a post by slug
     * 
     * @param string $slug
     * @return \App\Models\Post
     */
    public function getPost(string $slug): \App\Models\Post
    {
        return $this->model->query()->with(['admin:id,name,username,avatar', 'featuredImage:id,url', 'media:id,url', 'relatedPosts:id,title,slug,created_at,featured_image_id'])
            ->published()
            ->where('slug', $slug)
            ->firstOr(function () {
                abort(404);
            });
    }
}
