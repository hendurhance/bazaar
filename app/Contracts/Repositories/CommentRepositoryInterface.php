<?php

namespace App\Contracts\Repositories;

interface CommentRepositoryInterface
{
    /**
     * Get all comments
     * 
     * @param int $limit
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllCommentsForAdmin(int $limit = 10, array $filters = null): \Illuminate\Contracts\Pagination\LengthAwarePaginator;


    /**
     * Get comment
     * 
     * @param int $id
     * @return \App\Models\Comment
     */
    public function getComment(int $id): \App\Models\Comment;

    /**
     * Update comment
     * 
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateComment(array $data, int $id): void;

    /**
     * Store a comment
     * 
     * @param array $data
     * @param string $slug
     * @param \App\Models\User|\App\Models\Admin $user
     * @return void
     */
    public function storeComment(array $data, string $slug, \App\Models\User|\App\Models\Admin $user): void;

    /**
     * Delete a comment
     * 
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;
}