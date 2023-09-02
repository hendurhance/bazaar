<?php

namespace App\Contracts\Repositories;

use App\Models\Media;
use App\Models\User;

interface MediaRepositoryInterface
{
    /**
     * Create a media file.
     * 
     * @param ?User $user|null
     * @param array $data
     * @return Media
     */
    public function create(?User $user, array $data): Media;
}