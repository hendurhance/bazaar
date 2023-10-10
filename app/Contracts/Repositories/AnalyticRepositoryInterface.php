<?php

namespace App\Contracts\Repositories;

interface AnalyticRepositoryInterface
{
    /**
     * Get major metrics
     * @description Get major metrics
     *      - Total users
     *      - Total ads
     *      - Winning users
     *      - Total bids
     * 
     * @return array
     */
    public function getMajorMetrics(): array;
}