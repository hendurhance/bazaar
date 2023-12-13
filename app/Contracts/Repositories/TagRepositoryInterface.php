<?php

namespace App\Contracts\Repositories;

interface TagRepositoryInterface
{
    /**
     * Get all tags
     * 
     * @param bool $withCount = false
     * @return \Illuminate\Database\Eloquent\Collection<\App\Models\Tag>
     */
    public function getAllTags($withCount = false);
}