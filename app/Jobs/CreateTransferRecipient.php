<?php

namespace App\Jobs;

use App\Enums\PaymentGateway;
use App\Models\PayoutMethod;
use App\Services\Payment\PaymentGatewayService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateTransferRecipient implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected PayoutMethod $payoutMethod)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try{
            $this->createRecipient();
        } catch (\Exception $e) {
            // Log the error.
            Log::error($e->getMessage());
        }
        
    }

    /**
     * Create a transfer recipient.
     */
    protected function createRecipient(): void
    {
        // Create a transfer recipient.
        $process = (new PaymentGatewayService(PaymentGateway::PAYSTACK))
            ->createRecipient($this->payoutMethod);
        
        // Update the payout method with the recipient code.
        $this->payoutMethod->update([
            'meta' => [
                'recipient_code' => $process['data']['recipient_code'],
                'recipient_id' => $process['data']['id'],
            ],
        ]);
    }
}
