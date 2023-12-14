<?php

namespace App\Handler;

use Illuminate\Support\Facades\Log;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;

class ProcessPaystackWebhook extends ProcessWebhookJob
{
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Webhook request: ' . json_encode($this->webhookCall->payload));

        return (new ProcessPaystackPayout($this->webhookCall->payload))->execute();
    }
}