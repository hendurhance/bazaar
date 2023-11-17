<?php

namespace App\Repositories\Post;

use App\Abstracts\BaseCrudRepository;
use App\Models\Post;
use App\Contracts\Repositories\PostRepositoryInterface;
use App\Traits\MediaHandler;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository extends BaseCrudRepository implements PostRepositoryInterface
{
    use MediaHandler;

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

    /**
     * Get all posts for admin
     * 
     * @param int $limit
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllPostsForAdmin(int $limit = 10, array $filters = null): LengthAwarePaginator
    {
        return $this->model->query()->with(['admin:id,name,username,avatar', 'featuredImage:id,url'])
            ->when($filters, function ($query) use ($filters) {
                $query->when(isset($filters['search']), function ($query) use ($filters) {
                    $query->where(function ($query) use ($filters) {
                        $query->where('title', 'like', '%' . $filters['search'] . '%')
                            ->orWhereJsonContains('tags', $filters['search'])
                            ->orWhereHas('admin', function ($query) use ($filters) {
                                $query->where('name', 'like', '%' . $filters['search'] . '%')
                                    ->orWhere('username', 'like', '%' . $filters['search'] . '%');
                            });
                    });
                })
                    ->when(isset($filters['published']), function ($query) use ($filters) {
                        $query->where('is_published', $filters['published'] === 'published' ? true : false);
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($limit)
            ->appends([
                'search' => $filters['search'] ?? null,
                'published' => $filters['published'] ?? null,
            ]);
    }




    // /**
    //  * Create a post
    //  * 
    //  * @param array $data
    //  * @param \App\Models\Admin $admin
    //  * @return \App\Models\Post
    //  */
    // public function create(array $data, \App\Models\Admin $admin): \App\Models\Post
    // {

    // }

    // /**
    //  * Update a post
    //  * 
    //  * @param string $slug
    //  * @param array $data
    //  */
    // public function update(string $slug, array $data): void
    // {

    // }

    // /**
    //  * Delete a post
    //  * 
    //  * @param string $slug
    //  */
    // public function delete(string $slug): void
    // {

    // }
}
