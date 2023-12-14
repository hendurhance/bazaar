<?php

namespace App\Observers;

use App\Jobs\TieUserToAds;
use App\Models\User;
use App\Notifications\User\UserVerificationNotification;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    /**
     * Handle the User "creating" event.
     */
    public function creating(User $user): void
    {
        $user->email_verification_token = generate_verify_token($user->email);
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $user->notify(new UserVerificationNotification($user));

        // Tie the user to the ads.
        dispatch(new TieUserToAds($user));
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
