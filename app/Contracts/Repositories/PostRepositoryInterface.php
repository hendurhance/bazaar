<?php

namespace App\Contracts\Repositories;

interface PostRepositoryInterface
{
    /**
     * Get all posts
     * 
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllPosts(int $limit = 10): \Illuminate\Pagination\LengthAwarePaginator;

    /**
     * Get a post by slug
     * 
     * @param string $slug
     * @return \App\Models\Post
     */
    public function getPost(string $slug): \App\Models\Post;
}