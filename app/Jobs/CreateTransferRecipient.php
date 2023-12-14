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
        // @note: Transfer recipients is only available for paystack.
        // @link: https://paystack.com/docs/api/transfer-recipient/#create
        $process = (new PaymentGatewayService(PaymentGateway::PAYSTACK))
            ->createRecipient($this->payoutMethod);
        Log::info('Created transfer recipient: ' . $process['recipient_code']. 'TTT'. $process['recipient_id']);
        // Update the payout method with the recipient code.
        $this->payoutMethod->update([
            'meta' => [
                'recipient_code' => $process['recipient_code'],
                'recipient_id' => $process['recipient_id'],
            ],
        ]);
    }
}
