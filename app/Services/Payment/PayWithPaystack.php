<?php

namespace App\Services\Payment;

use App\Contracts\Services\PaymentGatewayServiceInterface;
use App\Exceptions\PaymentException;
use App\Models\Payment;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class PayWithPaystack implements PaymentGatewayServiceInterface
{
    protected string $secretKey;
    protected string $publicKey;
    protected string $baseUrl;
    protected string $currency;
    // protected string $cancelUrl;
    protected $client;
    /**
     * Initialize paystack
     */
    public function __construct()
    {
        $this->secretKey = config('payment.paystack.secret_key');
        $this->publicKey = config('payment.paystack.public_key');
        $this->baseUrl = config('payment.paystack.base_url');
        $this->currency = config('payment.currencies.default');
        // $this->cancelUrl = config('payment.paystack.redirect_url');
        $this->client = new Client();
    }

    /**
     * Pay for an ad
     * 
     * @param \App\Models\Payment $payment
     * @return string
     */
    public function pay(Payment $payment): string
    {
        $response = $this->client->post(
            $this->baseUrl . 'transaction/initialize',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->secretKey,
                    'Cache-Control' => 'no-cache',
                ],
                'form_params' => [
                    'amount' => $payment->amount,
                    'currency' => $this->currency,
                    'email' => $payment->user->email,
                    'reference' => $payment->txn_id,
                    'callback_url' => route('user.confirm-payment', $payment->txn_id),
                    'metadata' => [
                        'bid_id' => $payment->bid_id,
                        'user_id' => $payment->user_id,
                        'ad_id' => $payment->bid->ad_id,
                        'cancel_action' => route('user.listing-bids.show', $payment->bid_id),
                    ],
                ],
            ]
        );
        $result = json_decode($response->getBody()->getContents(), true);
        Log::info($result);
        if (!$result['status']) {
            Log::error('Paystack payment error: ' . $result['message']);
            throw new PaymentException('Unable to initialize payment.');
        }

        return $result['data']['authorization_url'];
    }
}
