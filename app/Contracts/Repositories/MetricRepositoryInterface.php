<?php

namespace App\Contracts\Repositories;

interface MetricRepositoryInterface
{

    /**
     * Get metrics for admin
     * 
     * @return array<string, int>
     */
    public function getMetricsForAdmin(): array;
}