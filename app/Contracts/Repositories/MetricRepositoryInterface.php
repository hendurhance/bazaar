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

    /**
     * Search for a query
     * 
     * @param string $query
     */
    public function search(string $query): array;
}