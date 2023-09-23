<?php

namespace App\Repositories\Payment;

use App\Abstracts\BaseCrudRepository;
use App\Models\Payment;
use App\Contracts\Repositories\PaymentRepositoryInterface;
use App\Enums\PaymentGateway;
use App\Enums\PaymentStatus;
use App\Exceptions\PaymentException;
use App\Models\User;
use App\Repositories\Bid\BidRepository;
use App\Services\Payment\PaymentGatewayService;
use App\Services\Payment\PayWithFlutterwave;
use App\Services\Payment\PayWithPaystack;
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
     * @return string
     */
    public function pay(string $bid, User $user, string $paymentMethod): string
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
            $payment = $this->createPayment($bid, $user, $paymentMethod);

            $response = (new PaymentGatewayService(PaymentGateway::from($paymentMethod)))->pay($payment);

            $this->model->getConnection()->commit();

            return $response;
        } catch (\Exception $e) {
            $this->model->getConnection()->rollBack();
            // throw new PaymentException('Payment failed. Please try again.');
            throw $e;
        }
    }

    /**
     * Confirm payment
     * 
     * @param string $txnId
     * @return void
     */
    public function confirm(string $txnId): string
    {
        $payment = $this->findBy('txn_id', $txnId, function () {
            throw new PaymentException('Payment not found.');
        });

        if ($payment->paid()) {
            throw new PaymentException('Payment has already been confirmed.');
        }

        $this->model->getConnection()->beginTransaction();
        try {
            $response = (new PaymentGatewayService($payment->gateway))->confirm($payment->txn_id);

            $payment->update([
                ...$response,
                'status' => PaymentStatus::SUCCESS,
            ]);

            $this->model->getConnection()->commit();

            return $payment->bid_id;
        } catch (\Exception $e) {
            $this->model->getConnection()->rollBack();
            // throw new PaymentException('Payment confirmation failed. Please try again.');
            throw $e;
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
            'ad_id' => $bid->ad_id,
            'user_id' => $user->id,
            'amount' => $bid->amount,
            'gateway' => PaymentGateway::from($paymentMethod),
        ]);
    }
}
