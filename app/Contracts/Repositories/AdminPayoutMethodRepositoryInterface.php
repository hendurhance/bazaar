<?php

namespace App\Contracts\Repositories;

interface AdminPayoutMethodRepositoryInterface
{
    /**
     * Get all payout methods
     * 
     * @param int $limit
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPayoutMethods(int $limit = 10, array $filters = null): \Illuminate\Contracts\Pagination\LengthAwarePaginator;

    /**
     * Get payout method by id
     * 
     * @param string $id
     * @return \App\Models\PayoutMethod
     */
    public function getPayoutMethod(string $id): \App\Models\PayoutMethod;
}
