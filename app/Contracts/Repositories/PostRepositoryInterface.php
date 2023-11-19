<?php

namespace App\Contracts\Repositories;

interface PostRepositoryInterface
{
    /**
     * Get all posts
     * 
     * @param int $limit
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllPosts(int $limit = 10, array $filters = null): \Illuminate\Pagination\LengthAwarePaginator;

    /**
     * Get all posts for admin
     * 
     * @param int $limit
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllPostsForAdmin(int $limit = 10, array $filters = null): \Illuminate\Pagination\LengthAwarePaginator;


    /**
     * Get a post by slug
     * 
     * @param string $slug
     * @return \App\Models\Post
     */
    public function getPost(string $slug): \App\Models\Post;

    /**
     * Get a post for admin
     * 
     * @param string $slug
     * @return \App\Models\Post
     */
    public function getPostForAdmin(string $slug): \App\Models\Post;

    /**
     * Create a post
     * 
     * @param array $data
     * @param \App\Models\Admin $admin
     * @return void
     */
    public function createPost(array $data, \App\Models\Admin $admin): void;

    /**
     * Update a post
     * 
     * @param string $slug
     * @param array $data
     * @return void
     */
    public function updatePost(string $slug, array $data): void;

    /**
     * Delete a post
     * 
     * @param string $slug
     */
    public function deletePost(string $slug): void;
}
