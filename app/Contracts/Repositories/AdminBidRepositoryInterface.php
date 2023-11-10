<?php

namespace App\Contracts\Repositories;

interface AdminBidRepositoryInterface
{
    /**
     * Get all bids
     * 
     * @param int $limit
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getBids(int $limit = 10, array $filters = null):  \Illuminate\Contracts\Pagination\LengthAwarePaginator;

    /**
     * Get bid by id
     * 
     * @param string $id
     * @return \App\Models\Bid
     */
    public function getBid(string $id): \App\Models\Bid;
}