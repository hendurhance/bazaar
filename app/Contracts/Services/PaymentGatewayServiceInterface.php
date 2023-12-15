<?php

namespace App\Contracts\Services;

use App\Models\Payment;

interface PaymentGatewayServiceInterface
{
    /**
     * Pay for an ad
     * 
     * @param \App\Models\Payment $payment
     * @return string
     */
    public function pay(Payment $payment): string;

    /**
     * Confirm payment
     * 
     * @param string $txnId
     * @param string $transactionID
     * @return array
     */
    public function confirm(string $txnId, string $transactionID = null): array;

    /**
     * Create a transfer recipient
     * 
     * @param \App\Models\PayoutMethod $paymentMethod
     * @return array
     */
    public function createRecipient(\App\Models\PayoutMethod $paymentMethod): array;

    /**
     * Transfer funds to a recipient
     * 
     * @param \Illuminate\Database\Eloquent\Collection<Payout> $payouts
     * @return array
     */
    public function transfers(\Illuminate\Database\Eloquent\Collection $payouts): array;
}
