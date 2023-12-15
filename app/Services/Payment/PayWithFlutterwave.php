<?php

namespace App\Services\Payment;

use App\Contracts\Services\PaymentGatewayServiceInterface;
use App\Exceptions\PaymentException;
use App\Models\Payment;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;
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
                        'user_id' => $payment->payer_id,
                        'ad_id' => $payment->bid->ad_id,
                    ],
                    'customer' => [
                        'email' => $payment->payer->email,
                        'phoneNumber' => $payment->payer->mobile,
                        'name' => $payment->payer->name,
                    ],
                    'customizations' => [
                        'title' => config('app.name'),
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

    /**
     * Confirm payment
     * 
     * @param string $txnId
     * @param string $transactionID
     * @return array
     */
    public function confirm(string $txnId, string $transactionID = null): array
    {
        $response = $this->client->get(
            $this->baseUrl . 'transactions/' . $transactionID . '/verify',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->secretKey,
                    'Content-Type' => 'application/json',
                ]
            ]
        );

        $result = json_decode($response->getBody()->getContents(), true);

        if (!$result['status'] === 'success') {
            Log::error('Flutterwave payment error: ' . $result['message']);
            throw new PaymentException('Unable to confirm payment.');
        }

        // return $result['data'];
        return [
            'currency' => $result['data']['currency'] ?? $this->currency,
            'payer_email' => $result['data']['customer']['email'] ?? null,
            'client_ip' => $result['data']['ip'] ?? null,
            'token' => $result['data']['card']['token'] ?? null,
            'card_last4' => $result['data']['card']['last_4digits'] ?? null,
            'method' => $result['data']['payment_type'] ?? null,
        ];
    }

    /**
     * Create a transfer recipient
     * 
     * @param \App\Models\PayoutMethod $paymentMethod
     * @return array
     */
    public function createRecipient(\App\Models\PayoutMethod $paymentMethod): array
    {
        Log::info('Flutterwave payout error: Flutterwave does not support payout recipient creation.');
        throw new PaymentException('Flutterwave does not support payout recipient creation.');
        return [];
    }

    /**
     * Transfer funds to a recipient
     * 
     * @param Collection<Payout> $payouts
     * @return array
     */
    public function transfers(Collection $payouts): array
    {
        $response = $this->client->request(
            'POST',
            $this->baseUrl . 'bulk-transfers',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->secretKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'title' => 'Bulk Transfer to ' . count($payouts) . ' recipients at ' . now()->toDateTimeString(),
                    'bulk_data' => collect($payouts)->map(function ($payout) {
                        return [
                            'bank_code' => $payout->payoutMethod->bank_code,
                            'account_number' => $payout->paymentMethod->account_number,
                            'amount' => $payout->amount,
                            'currency' => $this->currency,
                            'narration' => $payout->description,
                            'reference' => $payout->pyt_token,
                            'meta' => [
                                'first_name' => $payout->payee->first_name,
                                'last_name' => $payout->payee->last_name,
                                'email' => $payout->payee->email,
                                'mobile_number' => $payout->payee->mobile,
                                'recipient_address' => $payout->payee->address ?? null,
                            ],
                        ];
                    })->toArray(),
                ]
            ]
        );

        $result = json_decode($response->getBody()->getContents(), true);

        if (!$result['status'] === 'success') {
            Log::error('Flutterwave payout error: ' . $result['message']);
            throw new PaymentException('Unable to process payout.');
        }

        return $result['data'];
    }
}
