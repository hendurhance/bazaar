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
}
