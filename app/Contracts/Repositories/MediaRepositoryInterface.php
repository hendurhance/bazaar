<?php

namespace App\Contracts\Repositories;

use App\Models\Media;
use App\Models\User;

interface MediaRepositoryInterface
{
    /**
     * Get all media for admin.
     * 
     * @param int $limit
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllMediaForAdmin(int $limit = 10, array $filters = null): \Illuminate\Contracts\Pagination\LengthAwarePaginator;

    /**
     * Create a media file.
     * 
     * @param ?User $user|null
     * @param array $data
     * @return Media
     */
    public function create(?User $user, array $data): Media;

    /**
     * Get media for admin.
     * 
     * @param string $id
     * @return Media
     */
    public function getMediaForAdmin(string $id): Media;

    /**
     * Delete media.
     * 
     * @param string $id
     * @return void
     */
    public function deleteMedia(string $id): void;

}