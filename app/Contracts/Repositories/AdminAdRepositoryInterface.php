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

    /**
     * Get ad by slug
     * 
     * @param string $slug
     * @return \App\Models\Ad
     */
    public function getAdBySlug(string $adSlug) : \App\Models\Ad;

    /**
     * Update ad by slug
     * 
     * @param string $slug
     * @param array $data
     * @return void
     */
    public function updateAd(string $slug, array $data) : void;
}