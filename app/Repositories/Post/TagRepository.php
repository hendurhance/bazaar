<?php

namespace App\Repositories\Post;

use App\Abstracts\BaseCrudRepository;
use App\Models\Tag;
use App\Contracts\Repositories\TagRepositoryInterface;

class TagRepository extends BaseCrudRepository implements TagRepositoryInterface
{
    public function __construct(Tag $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all tags
     * 
     * @param bool $withCount
     * @return \Illuminate\Database\Eloquent\Collection<\App\Models\Tag>
     */
    public function getAllTags($withCount = false)
    {
        return $this->model->query()->select('id', 'name')
            ->when($withCount, function ($query) {
                $query->withCount('posts')
                    ->having('posts_count', '>', 0)
                    ->orderBy('posts_count', 'desc');
            })
            ->get();
    }
}
