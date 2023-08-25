<?php

namespace App\Observers;

use App\Models\User;
use App\Services\Avatar\UIAvatar;

class UserObserver
{
    /**
     * Handle the User "creating" event.
     */
    public function creating(User $user): void
    {
        $user->avatar = (new UIAvatar($user->name))->getUrl();
        $user->email_verification_token = generate_verify_token($user->email);
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Send email verification notification
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
