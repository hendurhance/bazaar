<?php

namespace App\Repositories\Payment;

use App\Abstracts\BaseCrudRepository;
use App\Models\Payment;
use App\Contracts\Repositories\PaymentRepositoryInterface;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PaymentRepository extends BaseCrudRepository implements PaymentRepositoryInterface
{
    public function __construct(Payment $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all user payments
     * 
     * @param \App\Models\User $user
     * @param int $limit
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUserPayments(User $user, int $limit = 10, array $filters = null): LengthAwarePaginator
    {
        return $this->model->query()->with([
            'ad:id,title,slug',
        ])->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
    }
}
