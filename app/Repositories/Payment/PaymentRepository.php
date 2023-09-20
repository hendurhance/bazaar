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
     * Get all accepted bids for the user, (paid and unpaid)
     * 
     * @param int $userId
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAcceptedBids(User $user, int $limit = 10): LengthAwarePaginator
    {
        return $user->bids()->with(['ad:id,title,slug,price', 'user:id,name,avatar,username', 'payment:id,bid_id,amount,transaction_id'])
            ->where('is_accepted', true)
            ->paginate($limit);
    }
}
