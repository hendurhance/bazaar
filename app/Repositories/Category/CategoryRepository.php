<?php

namespace App\Repositories\Category;

use App\Abstracts\BaseCrudRepository;
use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Models\Category;

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
    public function getCategoriesWithSubCategories()
    {
        return $this->model->with('subCategories')->get();
    }
}