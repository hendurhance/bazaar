<?php

namespace App\Contracts\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface PaymentRepositoryInterface
{
    /**
     * Get all accepted bids for the user, (paid and unpaid)
     * 
     * @param \App\Models\User $user
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAcceptedBids(User $user, int $limit = 10): Collection|LengthAwarePaginator;
}