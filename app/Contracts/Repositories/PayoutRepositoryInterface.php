<?php

namespace App\Contracts\Repositories;

use App\Models\User;

interface PayoutRepositoryInterface
{
    /**
     * Get user payment 
     * @description User can see the payment they want to make a payout for
     * 
     * @param \App\Models\User $user
     * @param string $txnId
     * @return \App\Models\Payment
     */
    public function getUserPayment(User $user, string $txnId): \App\Models\Payment;
}