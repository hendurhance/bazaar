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
}