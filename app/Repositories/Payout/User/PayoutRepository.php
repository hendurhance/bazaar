<?php

namespace App\Repositories\Payout\User;

use App\Abstracts\BaseCrudRepository;
use App\Models\Payout;
use App\Contracts\Repositories\PayoutRepositoryInterface;
use App\Exceptions\PayoutException;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\Payout\PayoutRequestNotification;

class PayoutRepository extends BaseCrudRepository implements PayoutRepositoryInterface
{
    public function __construct(Payout $model)
    {
        parent::__construct($model);
    }

    /**
     * Get user payment 
     * @description User can see the payment they want to make a payout for
     * 
     * @param string $txnId
     * @return \App\Models\Payment
     */
    public function getUserPayment(User $user, string $txnId): \App\Models\Payment
    {
        return Payment::query()->with(['ad:id,title,slug,price,description,status,started_at,price,expired_at', 'ad.media', 'bid:id,ad_id,user_id,amount', 'payee:id','payer:id,name', 'payout:id,payment_id,payout_method_id,amount,fee,pyt_token,status,created_at,updated_at', 'payout.payoutMethod:id,bank_name,account_name,account_number'])
            ->where('txn_id', $txnId)->where('payee_id', $user->id)->firstOr(function () {
                throw new PayoutException('Payment not found.');
            });
    }
    
    /**
     * Request payout
     * @description User can request a payout for a payment
     * 
     * @param \App\Models\User $user
     * @param string $txnId
     * @param array<string, mixed> $data
     * @return void
     */
    public function request(User $user, string $txnId, array $data): void
    {
        $payment = Payment::query()->where('txn_id', $txnId)->where('payee_id', $user->id)->firstOr(function () {
            throw new PayoutException('Payment not found.');
        });
        if ($payment->payout) {
            throw new PayoutException('Payout request already exists for this payment');
        }

        $payoutCalc = $this->calculatePayout($payment->amount);
        
        # Create payout request
        try {
            $this->model->getConnection()->beginTransaction();

            $payout = $this->model->create([
                'user_id' => $user->id,
                'payment_id' => $payment->id,
                'payout_method_id' => $data['payment_method'],
                'amount' => $payoutCalc['amount'],
                'fee' => $payoutCalc['fee'],
                'description' => $data['description'] ?? null,
                'currency' => $payment->currency ?? config('payment.currencies.default'),
            ]);

            $this->model->getConnection()->commit();

            $user->notify(new PayoutRequestNotification($payout));
        } catch (\Throwable $th) {
            $this->model->getConnection()->rollBack();
            throw new PayoutException('Payout request failed. Please try again.');
        }
    }

    /**
     * Calculate payout
     * 
     * @param float $amount
     * @return array<string, float>
     */
    protected function calculatePayout(float $amount): array
    {
        $fee = $amount * (config('payment.payout.fee') / 100);
        $amount = $amount - $fee;

        return compact('fee', 'amount');
    }
}
