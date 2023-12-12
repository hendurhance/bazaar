<?php

namespace App\Repositories\Payout\Admin;

use App\Abstracts\BaseCrudRepository;
use App\Models\Payout;
use App\Contracts\Repositories\AdminPayoutRepositoryInterface;
use App\Enums\PriceRange;
use App\Exceptions\PayoutException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AdminPayoutRepository extends BaseCrudRepository implements AdminPayoutRepositoryInterface
{
    public function __construct(Payout $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all payouts
     * 
     * @param int $limit
     * @param string $type = 'all' <all|pending|failed|success>
     * @param array $query
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllPayouts(int $limit = 10, string $type = 'all', array $filters = null): LengthAwarePaginator
    {
        return $this->model->query()->with(['user:id,name,username,avatar', 'payment:id,payee_id,payer_id,amount', 'payoutMethod:id,bank_name,account_name,account_number'])
            ->when(
                match ($type) {
                    'pending' => fn ($query) => $query->pending(),
                    'failed' => fn ($query) => $query->failed(),
                    'success' => fn ($query) => $query->success(),
                    'all' => fn ($query) => $query,
                }
            )
            ->when($filters, function ($query) use ($filters) {
                $query->when(isset($filters['search']), function ($query) use ($filters) {
                    $query->where(function ($query) use ($filters) {
                        $query->where('pyt_token', $filters['search'])
                            ->orWhereHas('user', function ($query) use ($filters) {
                                $query->where('name', 'like', '%' . $filters['search'] . '%')
                                    ->orWhere('username', 'like', '%' . $filters['search'] . '%')
                                    ->orWhere('id', $filters['search']);
                            });
                    });
                })
                    ->when(isset($filters['date_from']) && isset($filters['date_to']), function ($query) use ($filters) {
                        $query->whereBetween('created_at', [$filters['date_from'], $filters['date_to']]);
                    })
                    ->when(isset($filters['payout_method']), function ($query) use ($filters) {
                        $query->where(function ($query) use ($filters) {
                            $query->where('payout_method_id', $filters['payout_method'])
                                ->orWhereHas('payoutMethod', function ($query) use ($filters) {
                                    $query->where('bank_name', $filters['payout_method'])
                                        ->orWhere('account_name', $filters['payout_method'])
                                        ->orWhere('account_number', $filters['payout_method']);
                                });
                        });
                    })
                    ->when(isset($filters['price_range']), function ($query) use ($filters) {
                        $query->whereBetween('amount', PriceRange::range($filters['price_range']));
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($limit)
            ->appends([
                'search' => $filters['search'] ?? null,
                'date_from' => $filters['date_from'] ?? null,
                'date_to' => $filters['date_to'] ?? null,
                'payout_method' => $filters['payout_method'] ?? null,
                'price_range' => isset($filters['amount_from']) ? PriceRange::range($filters['price_range']) : null,
            ]);
    }


    /**
     * Get a payout by pyt_token
     * 
     * @param string $pyt_token
     * @return \App\Models\Payout
     */
    public function getPayout(string $pyt_token): \App\Models\Payout
    {
        return $this->model->query()->with(['user:id,name,username,avatar', 'payment:id,payee_id,payer_id,amount,txn_id', 'payoutMethod:id,bank_name,account_name,account_number'])
            ->where('pyt_token', $pyt_token)
            ->firstOr(function () {
                throw new PayoutException('Payout not found.');
            });
    }
}
