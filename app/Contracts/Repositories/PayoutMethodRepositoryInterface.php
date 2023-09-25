<?php

namespace App\Contracts\Repositories;

interface PayoutMethodRepositoryInterface
{
    /**
     * Get user payout methods
     * 
     * @param \App\Models\User $user
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserPayoutMethods(\App\Models\User $user, int $limit = 10): \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator;

    /**
     * Get user payout method
     * 
     * @param \App\Models\User $user
     * @param string $id
     * @return \App\Models\PayoutMethod
     */
    public function getUserPayoutMethod(\App\Models\User $user, string $id): \App\Models\PayoutMethod;

    /**
     * Create user payout method
     * 
     * @param \App\Models\User $user
     * @param array $data
     * @return void
     */
    public function createUserPayoutMethod(\App\Models\User $user, array $data): void;

    /**
     * Update user payout method
     * 
     * @param \App\Models\User $user
     * @param string $id
     * @param array $data
     * @return void
     */
    public function updateUserPayoutMethod(\App\Models\User $user, string $id, array $data): void;

    /**
     * Delete user payout method
     * 
     * @param \App\Models\User $user
     * @param string $id
     * @return bool
     */
    public function deleteUserPayoutMethod(\App\Models\User $user, string $id): void;
}