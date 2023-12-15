<?php

namespace App\Handler;

use App\Enums\PayoutStatus;
use App\Models\Payout;
use Illuminate\Support\Facades\Log;

class ProcessPaystackPayout
{
    protected array $data;

    protected string $eventType;

    protected $handler;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->eventType = $data[0]['event'];
    }

    /**
     * Execute the payout.
     */
    public function execute(): void
    {
        match ($this->eventType) {
            'transfer.success' => $this->handlePayout(PayoutStatus::SUCCESS),
            'transfer.failed' => $this->handlePayout(PayoutStatus::FAILED),
            'transfer.reversed' => $this->handlePayout(PayoutStatus::REVERSED),
            default => Log::info('Unknown event type: ' . $this->eventType),
        };
    }

    /**
     * Update payout status.
     * 
     * @param PayoutStatus $status
     */
    protected function handlePayout(PayoutStatus $status): void
    {
        try {
            $this->updatePayoutStatus($status);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    protected function updatePayoutStatus(PayoutStatus $status): void
    {
        Log::info($status . ' payout: ' . json_encode($this->data));

        $reference = $this->data[0]['data']['reference'];

        $payout = $this->getPayout($reference);

        $payout->update([
            'status' => $status,
            'paid_at' => now(),
            'meta' => json_encode($this->data),
        ]);
    }

    /**
     * Get payout.
     * 
     * @param string $reference
     * @return Payout
     */
    protected function getPayout(string $reference): Payout
    {
        return Payout::query()->where('pyt_token', $reference)->firstOr(function () use ($reference) {
            Log::info('Payout not found: ' . $reference);
        });
    }
}
