<?php

namespace App\Repositories\Post;

use App\Abstracts\BaseCrudRepository;
use App\Models\Post;
use App\Contracts\Repositories\PostRepositoryInterface;
use App\Enums\StorageDiskType;
use App\Exceptions\PostException;
use App\Models\Admin;
use App\Traits\MediaHandler;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

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
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllPosts(int $limit = 10, array $filters = null): LengthAwarePaginator
    {
        return $this->model->query()->with(['admin:id,name,username,avatar', 'featuredImage:id,url', 'tags', 'comments' => function ($query) {
            $query->approved();
        }])
            ->when($filters, function ($query) use ($filters) {
                $query->when(isset($filters['search']), function ($query) use ($filters) {
                    $query->where(function ($query) use ($filters) {
                        $query->where('title', 'like', '%' . $filters['search'] . '%')
                            ->orWhereHas('admin', function ($query) use ($filters) {
                                $query->where('name', 'like', '%' . $filters['search'] . '%')
                                    ->orWhere('username', 'like', '%' . $filters['search'] . '%');
                            });
                    });
                })
                    ->when(isset($filters['tag']), function ($query) use ($filters) {
                        $query->whereHas('tags', function ($query) use ($filters) {
                            $query->where('id', $filters['tag']);
                        });
                    });
            })
            ->published()
            ->orderBy('created_at', 'desc')
            ->paginate($limit)
            ->appends([
                'search' => $filters['search'] ?? null,
                'tag' => $filters['tag'] ?? null,
            ]);
    }

    /**
     * Get a post by slug
     * 
     * @param string $slug
     * @return \App\Models\Post
     */
    public function getPost(string $slug): \App\Models\Post
    {
        return $this->model->query()->with([
            'admin:id,name,username,avatar',
            'featuredImage:id,url',
            'media:id,url',
            'relatedPosts:id,title,slug,created_at,featured_image_id',
            'tags:id,name',
            'comments' => function ($query) {
                $query->approved()->parent()->with(['user:id,name,username,avatar', 'admin:id,name,username,avatar', 'replies' => function ($query) {
                    $query->approved()->with(['user:id,name,username,avatar', 'admin:id,name,username,avatar']);
                }])->orderBy('created_at', 'desc');
            }
        ])
            ->published()
            ->where('slug', $slug)
            ->firstOr(function () {
                throw new PostException('Post not found.');
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
        return $this->model->query()->with(['admin:id,name,username,avatar', 'featuredImage:id,url', 'tags'])
            ->when($filters, function ($query) use ($filters) {
                $query->when(isset($filters['search']), function ($query) use ($filters) {
                    $query->where(function ($query) use ($filters) {
                        $query->where('title', 'like', '%' . $filters['search'] . '%')
                            ->orWhereHas('admin', function ($query) use ($filters) {
                                $query->where('name', 'like', '%' . $filters['search'] . '%')
                                    ->orWhere('username', 'like', '%' . $filters['search'] . '%');
                            })
                            ->orWhereHas('tags', function ($query) use ($filters) {
                                $query->where('name', 'like', '%' . $filters['search'] . '%');
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

    /**
     * Get a post for admin
     * 
     * @param string $slug
     * @return \App\Models\Post
     */
    public function getPostForAdmin(string $slug): \App\Models\Post
    {
        return $this->model->query()->with([
            'admin:id,name,username,avatar',
            'media',
            'tags:id,name',
            'comments' => function ($query) {
                $query->approved()->parent()->with(['user:id,name,username,avatar', 'admin:id,name,username,avatar', 'replies' => function ($query) {
                    $query->approved()->with(['user:id,name,username,avatar', 'admin:id,name,username,avatar']);
                }])->orderBy('created_at', 'desc');
            }
        ])
            ->where('slug', $slug)
            ->firstOr(function () {
                throw new PostException('Post not found.');
            });
    }




    /**
     * Create a post
     * 
     * @param array $data
     * @param \App\Models\Admin $admin
     * @return void
     */
    public function createPost(array $data, Admin $admin): void
    {
        DB::transaction(function () use ($data, $admin) {
            $post = $this->model->create([
                'title' => $data['title'],
                'content' => $data['content'],
                'is_published' => $data['published'] === 'published' ? true : false,
                'admin_id' => $admin->id,
            ]);
            $post->tags()->sync($data['tags'] ?? []);
            $this->uploadMedia($post, $data['images'] ?? [], StorageDiskType::LOCAL, 'public/post', 640, 480);
            // Set featured image when post has media with the first image
            if ($post->media->count() > 0) {
                $post->update([
                    'featured_image_id' => $post->media->first()->id,
                ]);
            }
        });
    }

    /**
     * Update a post
     * 
     * @param string $slug
     * @param array $data
     */
    public function updatePost(string $slug, array $data): void
    {
        DB::transaction(function () use ($slug, $data) {
            $post = $this->model->where('slug', $slug)->firstOr(function () {
                throw new PostException('Post not found.');
            });
            $post->update([
                'title' => $data['title'],
                'content' => $data['content'],
                'is_published' => $data['published'] === 'published' ? true : false,
            ]);
            $post->tags()->sync($data['tags'] ?? []);
        });
    }

    /**
     * Delete a post
     * 
     * @param string $slug
     */
    public function deletePost(string $slug): void
    {
        $post = $this->model->where('slug', $slug)->firstOr(function () {
            throw new PostException('Post not found.');
        });

        // Delete all media related to this post
        $post->media->each(function ($media) {
            $this->deleteMediaFile($media);
        });

        $post->delete();
    }
}
