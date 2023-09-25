<?php

namespace App\Repositories\Payout;

use App\Abstracts\BaseCrudRepository;
use App\Models\Payout;
use App\Contracts\Repositories\PayoutRepositoryInterface;
use App\Models\Payment;
use App\Models\User;

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
                abort(404);
            });
    }
}
