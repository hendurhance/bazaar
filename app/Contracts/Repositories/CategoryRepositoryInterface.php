<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    /**
     * Get the categories with sub categories.
     * 
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSubCategories(string $slug): Collection;

    /**
     * Get primary categories.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPrimaryCategories(): Collection;
}