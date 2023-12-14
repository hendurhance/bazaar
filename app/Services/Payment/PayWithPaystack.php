<?php

namespace App\Services\Payment;

use App\Contracts\Services\PaymentGatewayServiceInterface;
use App\Exceptions\PaymentException;
use App\Models\Payment;
use App\Models\Payout;
use App\Models\PayoutMethod;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class PayWithPaystack implements PaymentGatewayServiceInterface
{
    protected string $secretKey;
    protected string $publicKey;
    protected string $baseUrl;
    protected string $currency;
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
                    'amount' => $payment->amount * 100,
                    'currency' => $this->currency,
                    'email' => $payment->payer->email,
                    'reference' => $payment->txn_id,
                    'callback_url' => route('user.confirm-payment', $payment->txn_id),
                    'metadata' => [
                        'bid_id' => $payment->bid_id,
                        'user_id' => $payment->payer_id,
                        'ad_id' => $payment->bid->ad_id,
                        'cancel_action' => route('user.listing-bids.show', $payment->bid_id),
                    ],
                ],
            ]
        );
        $result = json_decode($response->getBody()->getContents(), true);

        if (!$result['status']) {
            Log::error('Paystack payment error: ' . $result['message']);
            throw new PaymentException('Unable to initialize payment.');
        }

        return $result['data']['authorization_url'];
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
            $this->baseUrl . 'transaction/verify/' . $txnId,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->secretKey,
                    'Cache-Control' => 'no-cache',
                ],
            ]
        );

        $result = json_decode($response->getBody()->getContents(), true);

        if (!$result['status']) {
            Log::error('Paystack payment error: ' . $result['message']);
            throw new PaymentException('Unable to confirm payment.');
        }

        return [
            'currency' => $result['data']['currency'] ?? $this->currency,
            'payer_email' => $result['data']['customer']['email'] ?? null,
            'client_ip' => $result['data']['ip_address'] ?? null,
            'card_id' => $result['data']['authorization']['authorization_code'] ?? null,
            'card_last4' => $result['data']['authorization']['last4'] ?? null,
        ];
    }

    /**
     * Create a transfer recipient
     * 
     * @param \App\Models\PayoutMethod $paymentMethod
     * @return array
     */
    public function createRecipient(PayoutMethod $paymentMethod): array
    {
        $response = $this->client->post(
            $this->baseUrl . 'transferrecipient',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->secretKey,
                    'Cache-Control' => 'no-cache',
                ],
                'form_params' => [
                    'type' => 'nuban',
                    'name' => $paymentMethod->account_name,
                    'account_number' => $paymentMethod->account_number,
                    'bank_code' => $paymentMethod->bank_code,
                    'currency' => $this->currency,
                ],
            ]
        );

        $result = json_decode($response->getBody()->getContents(), true);

        if (!$result['status']) {
            Log::error('Paystack failed to create transfer recipient: ' . $result['message']);
            throw new PaymentException('Unable to create recipient.');
        }

        return [
            'recipient_code' => $result['data']['recipient_code'],
            'recipient_id' => $result['data']['id'],
        ];
    }

    /**
     * Transfer funds to a recipient
     * 
     * @param Collection<Payout> $payouts
     * @return array
     */
    public function transfers(Collection $payouts): array
    {
        $response = $this->client->post(
            $this->baseUrl . 'transfer/bulk',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->secretKey,
                    'Cache-Control' => 'no-cache',
                ],
                'form_params' => [
                    'currency' => $this->currency,
                    'source' => 'balance',
                    'transfers' => collect($payouts)->map(function ($payout) {
                        return [
                            'amount' => $payout->amount * 100,
                            'recipient' => $payout->payoutMethod->meta['recipient_code'],
                            'reference' => $payout->pyt_token,
                            'reason' => $payout->description ?? 'Payout from ' . config('app.name'),
                        ];
                    })->toArray(),
                ],
            ]
        );

        $result = json_decode($response->getBody()->getContents(), true);

        if (!$result['status']) {
            Log::error('Paystack failed to transfer funds: ' . $result['message']);
            throw new PaymentException('Unable to transfer funds.');
        }

        return $result['data'];
    }
}
