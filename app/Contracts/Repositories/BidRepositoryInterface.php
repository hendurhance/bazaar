<?php

namespace App\Contracts\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface BidRepositoryInterface
{
     /**
     * Bid on an ad
     * 
     * @param string $ad
     * @param User $user
     * @param array $data
     * @return void
     */
    public function bid(string $ad, User $user, array $data): void;

    /**
     * Get user bids
     * 
     * @param User $user
     * @param int $limit
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUserBids(User $user, int $limit = 10, array $filters = null): Collection|LengthAwarePaginator;

    /**
     * Get user bid
     * 
     * @param string $ad
     * @param User $user
     * @return \App\Models\Bid
     */
    public function getUserBid(string $ad, User $user): \App\Models\Bid;
}