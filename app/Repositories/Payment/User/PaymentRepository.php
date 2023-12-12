<?php

namespace App\Repositories\Payment\User;

use App\Abstracts\BaseCrudRepository;
use App\Models\Payment;
use App\Contracts\Repositories\PaymentRepositoryInterface;
use App\Enums\PaymentGateway;
use App\Enums\PaymentStatus;
use App\Exceptions\PaymentException;
use App\Models\User;
use App\Notifications\Payment\BidPaymentNotification;
use App\Repositories\Bid\User\BidRepository;
use App\Services\Payment\PaymentGatewayService;
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
     * @param string $type <payer_id|payee_id>
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUserPayments(User $user, string $type, int $limit = 10, array $filters = null): LengthAwarePaginator
    {
        return $this->model->query()->with([
            'ad:id,title,slug',
        ])->where($type, $user->id)
            ->when($filters, function ($query) use ($filters) {
                $query->when(isset($filters['status']), function ($query) use ($filters) {
                    $query->where('status', PaymentStatus::from($filters['status']));
                })->when(isset($filters['gateway']), function ($query) use ($filters) {
                    $query->where('gateway', PaymentGateway::from($filters['gateway']));
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($limit)
            ->appends([
                'status' => $filters['status'] ?? null,
                'gateway' => $filters['gateway'] ?? null,
            ]);
    }

    /**
     * Get user payment
     * 
     * @param \App\Models\User $user
     * @param string $txnId
     * @return \App\Models\Payment
     */
    public function getUserPayment(User $user, string $txnId): \App\Models\Payment
    {
        return $this->model->query()->with(['ad:id,title,slug', 'bid'])->where('payer_id', $user->id)
            ->where('txn_id', $txnId)
            ->firstOr(function () {
                throw new PaymentException('Payment not found.');
            });
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
            throw new PaymentException('Bid not found.');
        });

        if ($bid->user_id !== $user->id) {
            throw new PaymentException('You cannot pay for this bid.');
        }

        // Check if there's a pending payment for this bid and user.
        $pendingPayment = $this->model->query()->where('bid_id', $bid->id)
            ->where('payer_id', $user->id)
            ->where('status', PaymentStatus::PENDING)
            ->first();
        if ($pendingPayment) {
            $pendingPayment->update(['txn_id' => generate_txn_id('BZR')]);

            $response = (new PaymentGatewayService($pendingPayment->gateway))->pay($pendingPayment);

            return $response;
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
            throw new PaymentException('Payment failed. Please try again.');
        }
    }

    /**
     * Confirm payment
     * 
     * @param string $txnId
     * @param string $transactionID
     * @return void
     */
    public function confirm(string $txnId, string $transactionID = null): string
    {
        $payment = $this->findBy('txn_id', $txnId, function () {
            throw new PaymentException('Payment not found.');
        });

        if ($payment->paid()) {
            throw new PaymentException('Payment has already been confirmed.');
        }

        $this->model->getConnection()->beginTransaction();
        try {
            $response = (new PaymentGatewayService($payment->gateway))->confirm($payment->txn_id, $transactionID);

            $payment->update([
                ...$response,
                'status' => PaymentStatus::SUCCESS,
            ]);

            $this->model->getConnection()->commit();
            
            $payment->payee->notify(new BidPaymentNotification($payment, true));
            $payment->payer->notify(new BidPaymentNotification($payment, false));

            return $payment->bid_id;
        } catch (\Exception $e) {
            $this->model->getConnection()->rollBack();
            throw new PaymentException('Payment confirmation failed. Please try again.');
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
            'payer_id' => $user->id,
            'payee_id' => $bid->ad->user_id,
            'amount' => $bid->amount,
            'gateway' => PaymentGateway::from($paymentMethod),
        ]);
    }
}
