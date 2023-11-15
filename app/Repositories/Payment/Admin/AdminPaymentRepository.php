<?php

namespace App\Repositories\Payment\Admin;

use App\Abstracts\BaseCrudRepository;
use App\Models\Payment;
use App\Contracts\Repositories\AdminPaymentRepositoryInterface;
use App\Enums\PriceRange;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AdminPaymentRepository extends BaseCrudRepository implements AdminPaymentRepositoryInterface
{
    public function __construct(Payment $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all payments
     * 
     * @param int $limit
     * @param string $type = 'all' <all|pending|failed|success>
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllPayments(int $limit = 10, string $type = 'all', array $filters = null): LengthAwarePaginator
    {
        return $this->model->query()->with(['payee:id,name,username,avatar', 'payer:id,name,username,avatar', 'payout:id,user_id,payout_method_id,payment_id,amount,fee'])
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
                    $query->where('txn_id', $filters['search'])
                        ->orWhereHas('payee', function ($query) use ($filters) {
                            $query->where('name', 'like', '%' . $filters['search'] . '%')
                                ->orWhere('username', 'like', '%' . $filters['search'] . '%')
                                ->orWhere('id', $filters['search']);
                        })
                        ->orWhereHas('payer', function ($query) use ($filters) {
                            $query->where('name', 'like', '%' . $filters['search'] . '%')
                                ->orWhere('username', 'like', '%' . $filters['search'] . '%')
                                ->orWhere('id', $filters['search']);
                        });
                })
                ->when(isset($filters['date_from']) && isset($filters['date_to']), function ($query) use ($filters) {
                    $query->whereBetween('created_at', [$filters['date_from'], $filters['date_to']]);
                })
                ->when(isset($filters['gateway']), function ($query) use ($filters) {
                    $query->where('gateway', $filters['gateway']);
                })
                ->when(isset($filters['price_range']), function ($query) use ($filters) {
                    $query->whereBetween('amount', PriceRange::range($filters['price_range']));
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($limit)
            ->appends(['search' => $filters['search'] ?? null]);
    }
}
