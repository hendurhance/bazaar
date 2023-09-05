<?php

namespace App\Repositories\Category;

use App\Abstracts\BaseCrudRepository;
use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository extends BaseCrudRepository implements CategoryRepositoryInterface
{
    /**
     * The fields that should be filtered.
     * 
     * @var array
     */
    protected array $filterable = [
        'name',
        'slug',
    ];

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    /**
     * Get the categories with sub categories.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSubCategories(string $slug): Collection
    {
        return $this->model->where('slug', $slug)->with('subCategories')->get();
    }

    /**
     * Get primary categories.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPrimaryCategories(): Collection
    {
        return $this->model->whereNull('parent_id')->select('id', 'name', 'slug', 'icon', 'image')->get();
    }

    /**
     * Find a category by slug.
     * 
     * @param string $slug
     * @return \App\Models\Category
     */
    public function findBySlug(string $slug): Category
    {
        return $this->findBy('slug', $slug, function () {
            throw new \Exception('Category not found.');
        });
    }
}