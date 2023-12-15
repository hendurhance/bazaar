<?php

namespace App\Jobs;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class TieUserToAds implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected User $user)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $this->tieUserToAds();
        } catch (\Exception $e) {
            Log::error('Error tying user to ads: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }

    /**
     * Tie the user to the ads.
     */
    protected function tieUserToAds(): void
    {
        // Get all the ads that are not tied to any user, but have the same email as the seller_email.
        $ads = Ad::where('seller_email', $this->user->email)
            ->whereNull('user_id')
            ->get();


        // Tie the user to the ads.
        if ($ads->isNotEmpty()) {
            $ads->each(function ($ad) {
                $ad->update(['user_id' => $this->user->id]);
            });

            Log::info('Tied user to ads: ' . $this->user->id);
        }
    }
}
