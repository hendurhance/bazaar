<?php

namespace App\Contracts\Repositories;

interface AdminPayoutRepositoryInterface
{
    /**
     * Get all payouts
     * 
     * @param int $limit
     * @param string $type = 'all' <all|pending|failed|success>
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllPayouts(int $limit = 10, string $type = 'all', array $filters = null): \Illuminate\Contracts\Pagination\LengthAwarePaginator;


    /**
     * Get a payout by pyt_token
     * 
     * @param string $pyt_token
     * @return \App\Models\Payout
     */
    public function getPayout(string $pyt_token): \App\Models\Payout;
}