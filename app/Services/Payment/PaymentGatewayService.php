<?php

namespace App\Services\Payment;

use App\Contracts\Services\PaymentGatewayServiceInterface;
use App\Enums\PaymentGateway;
use App\Models\Payment;

class PaymentGatewayService implements PaymentGatewayServiceInterface
{
    protected $service;

    /**
     * Initialize payment gateway
     */
    public function __construct(protected PaymentGateway $gateway)
    {
        $this->service = match ($this->gateway) {
            PaymentGateway::PAYSTACK => new PayWithPaystack(),
            PaymentGateway::FLUTTERWAVE => new PayWithFlutterwave(),
        };
    }

    /**
     * Pay for an ad
     * 
     * @param \App\Models\Payment $payment
     * @return string
     */
    public function pay(Payment $payment): string
    {
        return $this->service->pay($payment);
    }

    /**
    * Confirm payment
    * 
    * @param string $txnId
    * @return array
    */
   public function confirm(string $txnId): array
    {
         return $this->service->confirm($txnId);
    }
}