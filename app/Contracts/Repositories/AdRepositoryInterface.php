<?php

namespace App\Contracts\Repositories;

use App\Models\Ad;
use App\Models\User;

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
}