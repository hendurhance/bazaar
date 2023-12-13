<?php

namespace App\Observers;

use App\Models\Ad;
use App\Notifications\Ad\AdCreatedNotification;
use App\Notifications\Ad\AdStatusUpdatedNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class AdObserver
{
    /**
     * Handle the Ad "created" event.
     */
    public function created(Ad $ad): void
    {
        // if($ad->user->exists) {
        //     $ad->user?->notify(new AdCreatedNotification($ad));
        // } else {
        //     Notification::route('mail', $ad->seller_email)->notify(new AdCreatedNotification($ad));
        // }
    }

    /**
     * Handle the Ad "updated" event.
     */
    public function updated(Ad $ad): void
    {
        // Log::info('Updated');
        // if($ad->isDirty('status') && $ad->user->exists) {
        //     $ad->user?->notify(new AdStatusUpdatedNotification($ad));
        // } elseif($ad->isDirty('status') && !$ad->user->exists) {
        //     Notification::route('mail', $ad->seller_email)->notify(new AdStatusUpdatedNotification($ad));
        // }
    }

    /**
     * Handle the Ad "deleted" event.
     */
    public function deleted(Ad $ad): void
    {
        // $ad->media()->delete();
    }

    /**
     * Handle the Ad "restored" event.
     */
    public function restored(Ad $ad): void
    {
        //
    }

    /**
     * Handle the Ad "force deleted" event.
     */
    public function forceDeleted(Ad $ad): void
    {
        //
    }
}
