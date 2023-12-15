<?php

namespace App\Observers;

use App\Jobs\CreateTransferRecipient;
use App\Models\PayoutMethod;

class PayoutMethodObserver
{
    /**
     * Handle the PayoutMethod "created" event.
     */
    public function created(PayoutMethod $payoutMethod): void
    {
        dispatch(new CreateTransferRecipient($payoutMethod));
    }

    /**
     * Handle the PayoutMethod "updated" event.
     */
    public function updated(PayoutMethod $payoutMethod): void
    {
        if ($payoutMethod->isDirty(['account_number', 'account_name'])) {
            dispatch(new CreateTransferRecipient($payoutMethod));
        }
    }

    /**
     * Handle the PayoutMethod "deleted" event.
     */
    public function deleted(PayoutMethod $payoutMethod): void
    {
        //
    }

    /**
     * Handle the PayoutMethod "restored" event.
     */
    public function restored(PayoutMethod $payoutMethod): void
    {
        //
    }

    /**
     * Handle the PayoutMethod "force deleted" event.
     */
    public function forceDeleted(PayoutMethod $payoutMethod): void
    {
        //
    }
}
