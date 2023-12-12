<?php

namespace App\Jobs;

use App\Enums\AdStatus;
use App\Models\Ad;
use App\Notifications\Bid\BidAcceptedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessHighestBidder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Get all ads their expired_at is less or equal to now, 
        $ads = Ad::query()->where('expired_at', '<=', now())->active()->get();

        // Loop through each ad and get the highest bidder
        foreach ($ads as $ad) {
            $highestBidder = $ad->bids()->orderBy('amount', 'desc')->first();

            // If there is no highest bidder, mark the ad as rejected
            if (!$highestBidder) {
                $ad->update(['status' => AdStatus::REJECTED]);
                continue;
            }

            // Mark the ad as expired, update the highest bidder as accepted and notify the highest bidder 
            $ad->update(['status' => AdStatus::EXPIRED]);
            $highestBidder->update(['is_accepted' => true]);
            $highestBidder->user->notify(new BidAcceptedNotification($ad, $highestBidder));
        }
    }
}
