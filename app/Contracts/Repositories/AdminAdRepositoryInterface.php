<?php

namespace App\Contracts\Repositories;

interface AdminAdRepositoryInterface
{
    /**
     * Get all ads
     * 
     * @param int $limit
     * @param string $type = 'all' <all|active|upcoming|pending|expired|rejected>
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAds(int $limit = 10, string $type, array $filters = null): \Illuminate\Contracts\Pagination\LengthAwarePaginator;
}