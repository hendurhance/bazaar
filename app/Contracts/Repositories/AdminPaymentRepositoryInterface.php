<?php

namespace App\Contracts\Repositories;

interface AdminPaymentRepositoryInterface
{
    /**
     * Get all payments
     * 
     * @param int $limit
     * @param string $type = 'all' <all|pending|failed|success>
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllPayments(int $limit = 10, string $type = 'all', array $filters = null): \Illuminate\Contracts\Pagination\LengthAwarePaginator;
}