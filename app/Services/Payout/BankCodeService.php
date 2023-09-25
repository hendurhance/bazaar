<?php

namespace App\Services\Payout;

use App\Contracts\Services\BankCodeServiceInterface;
use App\Exceptions\PayoutMethodException;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class BankCodeService implements BankCodeServiceInterface
{
    protected string $secretKey;
    protected string $publicKey;
    protected string $baseUrl;
    protected string $currency;
    protected string $cacheKey;
    protected array $fieldKeys;
    protected $client;

    /**
     * Initialize new instance of the service.
     */
    public function __construct()
    {
        $this->secretKey = config('payment.paystack.secret_key');
        $this->publicKey = config('payment.paystack.public_key');
        $this->baseUrl = config('payment.paystack.base_url');
        $this->currency = config('payment.currencies.default');
        $this->client = new Client();
        $this->cacheKey = 'bank_codes';
        $this->fieldKeys = ['name', 'code', 'longcode', 'gateway', 'pay_with_bank', 'active', 'is_deleted', 'country', 'currency', 'type', 'id'];
    }

    /**
     * List Bank Codes
     * 
     * @param array $fields
     * @return \Illuminate\Support\Collection
     */
    public function listBankCodes(array $fields = []): \Illuminate\Support\Collection
    {
        if (Cache::has($this->cacheKey)) {
            $cached = Cache::get($this->cacheKey);

            $fields = empty($fields) ? $this->fieldKeys : $fields;

            return Collection::make($cached)->map(function ($item) use ($fields) {
                return collect($item)->only($fields)->toArray();
            });
        }

        try {
            $response = $this->client->get(
                $this->baseUrl . 'bank',
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->secretKey,
                        'Cache-Control' => 'no-cache',
                    ]
                ]
            );

            $response = json_decode($response->getBody()->getContents());

            if (!$response->status) {
                throw new PayoutMethodException();
            }

            $cached =  Cache::rememberForever($this->cacheKey, function () use ($response) {
                return Collection::make($response->data);
            });

            $fields = empty($fields) ? $this->fieldKeys : $fields;
            return Collection::make($cached)->map(function ($item) use ($fields) {
                return collect($item)->only($fields)->toArray();
            });
        } catch (\Exception $e) {
            throw new PayoutMethodException($e->getMessage());
        }
    }

    /**
     * Resolve bank code
     * 
     * @param string $code
     * @return array
     */
    public function resolveBankCode(string $code): array
    {
        return $this->listBankCodes()->where('code', $code)->first();
    }

    /**
     * List all banks code
     * 
     * @return string
     */
    public function listAllBanksCode(): string
    {
        return $this->listBankCodes(['code'])->implode('code', ',');
    }

    /**
     * Resolve Bank Account
     * 
     * @param string $accountNumber
     * @param string $bankCode
     * @return object<string, string>
     */
    public function resolveBankAccount(string $accountNumber, string $bankCode): object
    {
        try {
            $response = $this->client->get(
                $this->baseUrl . 'bank/resolve?account_number=' . $accountNumber . '&bank_code=' . $bankCode,
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->secretKey,
                        'Cache-Control' => 'no-cache',
                    ]
                ]
            );

            $response = json_decode($response->getBody()->getContents());

            if (!$response->status) {
                throw new PayoutMethodException('An error occurred while resolving bank account');
            }

            return $response->data;
        } catch (\Throwable $th) {
            throw new PayoutMethodException($th->getMessage());
        }
    }
}
