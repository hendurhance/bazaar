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

    /**
     * Get payment by id
     * 
     * @param string $txnId
     * @return \App\Models\Payment
     */
    public function getPayment(string $txnId): \App\Models\Payment;

    /**
     * Update payment status
     * 
     * @param string $txnId
     * @param string $status
     * @return void
     */
    public function updatePaymentStatus(string $txnId, string $status): void;
}