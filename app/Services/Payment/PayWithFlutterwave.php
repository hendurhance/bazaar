<?php

namespace App\Services\Payment;

use App\Contracts\Services\PaymentGatewayServiceInterface;
use App\Exceptions\PaymentException;
use App\Models\Payment;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class PayWithFlutterwave implements PaymentGatewayServiceInterface
{
    protected string $secretKey;
    protected string $publicKey;
    protected string $baseUrl;
    protected string $currency;
    // protected string $cancelUrl;
    protected $client;
    /**
     * Initialize flutterwave
     */
    public function __construct()
    {
        $this->secretKey = config('payment.flutterwave.secret_key');
        $this->publicKey = config('payment.flutterwave.public_key');
        $this->baseUrl = config('payment.flutterwave.base_url');
        $this->currency = config('payment.currencies.default');
        // $this->cancelUrl = config('payment.flutterwave.redirect_url');
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
        $response = $this->client->request(
            'POST',
            $this->baseUrl . 'payments',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->secretKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'amount' => $payment->amount,
                    'currency' => $this->currency,
                    'tx_ref' => $payment->txn_id,
                    'redirect_url' => route('user.confirm-payment', $payment->txn_id),
                    'meta' => [
                        'bid_id' => $payment->bid_id,
                        'user_id' => $payment->user_id,
                        'ad_id' => $payment->bid->ad_id,
                    ],
                    'customer' => [
                        'email' => $payment->user->email,
                        'phoneNumber' => $payment->user->mobile,
                        'name' => $payment->user->name,
                    ],
                    'customizations' => [
                        'title' => 'Payment for ad: ' . $payment->bid->ad->title,
                    ]
                ],
            ]
        );

        $result = json_decode($response->getBody()->getContents(), true);
        Log::info($result);
        if (!$result['status'] === 'success') {
            Log::error('Flutterwave payment error: ' . $result['message']);
            throw new PaymentException('Unable to initialize payment.');
        }

        return $result['data']['link'];
    }
}
