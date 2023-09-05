<?php

namespace App\Contracts\Repositories;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface AdRepositoryInterface
{
    /**
     * Create a new ad
     *
     * @param  \App\Models\User|null  $user
     * @param  array  $data
     * @return \App\Models\Ad
     */
    public function create(?User $user, array $data): Ad;

    /**
     * Get latest active|upcoming ads
     * 
     * @param int $limit
     * @param string $type = 'active' <active|upcoming>
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getLatestAds(int $limit = 10, string $type = 'active', array $filters = null): Collection|LengthAwarePaginator;
}