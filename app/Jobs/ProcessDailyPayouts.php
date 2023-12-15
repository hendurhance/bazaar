<?php

namespace App\Jobs;

use App\Enums\PaymentGateway;
use App\Enums\PayoutGateway;
use App\Enums\PayoutStatus;
use App\Models\Payout;
use App\Services\Payment\PaymentGatewayService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessDailyPayouts implements ShouldQueue
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
        try {
            $this->processPayouts();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }

    /**
     * Process payouts.
     */
    protected function processPayouts(): void
    {
        $pendingPayouts = Payout::query()->pending()
            ->where('created_at', '<', now()->startOfDay())
            ->get();

        if ($pendingPayouts->count() > 0) {
            // @note: Forced to use paystack as the default payout gateway.
            $response = (new PaymentGatewayService(PaymentGateway::PAYSTACK))->transfers($pendingPayouts);

            Log::info('Payouts processed: ' . json_encode($response));

            // Update the payout status.
            $pendingPayouts->each(function ($payout) {
                $payout->update([
                    'status' => PayoutStatus::PROCESSING,
                ]);
            });
        }
    }
}
