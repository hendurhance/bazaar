<?php

namespace App\Repositories\Payout\Admin;

use App\Abstracts\BaseCrudRepository;
use App\Models\PayoutMethod;
use App\Contracts\Repositories\AdminPayoutMethodRepositoryInterface;
use App\Exceptions\PayoutException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use PDO;

class AdminPayoutMethodRepository extends BaseCrudRepository implements AdminPayoutMethodRepositoryInterface
{
    public function __construct(PayoutMethod $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all payout methods
     * 
     * @param int $limit
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPayoutMethods(int $limit = 10, array $filters = null): LengthAwarePaginator
    {
        return $this->model->query()->with(['user:id,name,email', 'country:id,name,emoji'])
            ->when($filters, function ($query) use ($filters) {
                $query->when(isset($filters['country_id']), function ($query) use ($filters) {
                    $query->where('country_id', $filters['country_id']);
                })
                    ->when(isset($filters['bank_code']), function ($query) use ($filters) {
                    })
                    ->when(isset($filters['date_from']) && isset($filters['date_to']), function ($query) use ($filters) {
                        $query->whereBetween('created_at', [$filters['date_from'], $filters['date_to']]);
                    })
                    ->when(isset($filters['user_id']), function ($query) use ($filters) {
                        $query->where('user_id', $filters['user_id']);
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($limit)
            ->appends([
                'country_id' => $filters['country_id'] ?? null,
                'bank_code' => $filters['bank_code'] ?? null,
                'date_from' => $filters['date_from'] ?? null,
                'date_to' => $filters['date_to'] ?? null,
                'user_id' => $filters['user_id'] ?? null,
            ]);
    }

    /**
     * Get payout method by id
     * 
     * @param string $id
     * @return \App\Models\PayoutMethod
     */
    public function getPayoutMethod(string $id): \App\Models\PayoutMethod
    {
        return $this->model->query()->with(['user:id,name,email', 'country:id,name,iso2,iso3,emoji', 'payouts:id,user_id,payout_method_id,payment_id,amount,fee'])
            ->where('id', $id)
            ->firstOr(function () {
                throw new PayoutException('Payout method not found.');
            });
    }
}
