<?php

namespace App\Contracts\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface PaymentRepositoryInterface
{
    /**
     * Get all user payments
     * 
     * @param \App\Models\User $user
     * @param int $limit
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUserPayments(User $user, int $limit = 10, array $filters = null): LengthAwarePaginator;

    /**
     * Pay for an ad
     * 
     * @param string $bid
     * @param \App\Models\User $user
     * @param string $method
     * @return void
     */
    public function pay(string $bid, User $user, string $method): string;

    /**
     * Confirm payment
     * 
     * @param string $txnId
     * @return string
     */
    public function confirm(string $txnId): string;
}