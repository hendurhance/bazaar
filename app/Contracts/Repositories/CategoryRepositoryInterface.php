<?php

namespace App\Contracts\Repositories;

interface CategoryRepositoryInterface
{
    /**
     * Get the categories with sub categories.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCategoriesWithSubCategories();
}