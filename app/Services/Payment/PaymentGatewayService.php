<?php

namespace App\Services\Payment;

use App\Contracts\Services\PaymentGatewayServiceInterface;
use App\Enums\PaymentGateway;
use App\Models\Payment;
use App\Models\Payout;
use App\Models\PayoutMethod;
use Illuminate\Database\Eloquent\Collection;

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
     * @param string $transactionID
     * @return array
     */
    public function confirm(string $txnId, string $transactionID = null): array
    {
        return $this->service->confirm($txnId, $transactionID);
    }

    /**
     * Create a transfer recipient
     * 
     * @param \App\Models\PayoutMethod $paymentMethod
     * @return array
     */
    public function createRecipient(PayoutMethod $paymentMethod): array
    {
        return $this->service->createRecipient($paymentMethod);
    }

    /**
     * Transfer funds to a recipient
     * 
     * @param Collection<Payout> $payouts
     * @return array
     */
    public function transfers(Collection $payouts): array
    {
        return $this->service->transfers($payouts);
    }
}
