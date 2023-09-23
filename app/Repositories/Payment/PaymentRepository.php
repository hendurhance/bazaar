<?php

namespace App\Repositories\Payment;

use App\Abstracts\BaseCrudRepository;
use App\Models\Payment;
use App\Contracts\Repositories\PaymentRepositoryInterface;
use App\Enums\PaymentGateway;
use App\Exceptions\PaymentException;
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

    /**
     * Pay for an ad
     * 
     * @param string $bid
     * @param \App\Models\User $user
     * @param string $paymentMethod
     * @return void
     */
    public function pay(string $bid, User $user, string $paymentMethod): void
    {
        $bid = app(BidRepository::class)->findBy('id', $bid, function () {
            abort(404);
        });

        if ($bid->user_id !== $user->id) {
            abort(403);
        }

        if ($bid->paid()) {
            throw new PaymentException('Bid has already been paid for.');
        }
        // Begin transaction, then perform payment
        $this->model->getConnection()->beginTransaction();
        try {
            $this->createPayment($bid, $user, $paymentMethod);

            #TODO: Perform payment using payment service here
            
            $this->model->getConnection()->commit();
        } catch (\Exception $e) {
            $this->model->getConnection()->rollBack();
            throw new PaymentException('Payment failed.');
        }
    }

    /**
     * Create payment
     * 
     * @param \App\Models\Bid $bid
     * @param \App\Models\User $user
     * @param string $paymentMethod
     * @return \App\Models\Payment
     */
    protected function createPayment(\App\Models\Bid $bid, User $user, string $paymentMethod): Payment
    {
        return $this->model->create([
            'bid_id' => $bid->id,
            'user_id' => $user->id,
            'amount' => $bid->amount,
            'gateway' => PaymentGateway::from($paymentMethod),
        ]);
    }
}
