<?php

namespace App\Contracts\Repositories;

interface UserRepositoryInterface
{
    /**
     * Get users for admin
     * 
     * @param int $limit
     * @param array $filters
     * @return \App\Models\User
     */
    public function getUsersForAdmin(int $limit = 10, array $filters = []): \Illuminate\Contracts\Pagination\LengthAwarePaginator;

    /**
     * Get user for admin
     * 
     * @param string $id
     * @return \App\Models\User
     */
    public function getUserForAdmin(string $id): \App\Models\User;

    /**
     * Delete a user
     * 
     * @param string $id
     * @return void
     */
    public function deleteUser(string $id): void;

    /**
     * Send password reset link
     * 
     * @param string $id
     */
    public function sendPasswordResetLink(string $id): void;

    /**
     * Get user for profile
     * 
     * @param array $data
     * @return void
     */
    public function createUser($data): void;

    /**
     * Update user
     * 
     * @param string $id
     * @param array $data
     * @return void
     */
    public function updateUser(string $id, array $data): void;
}
