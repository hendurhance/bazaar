<?php

namespace Database\Seeders;

use App\Enums\PaymentStatus;
use App\Models\Payment;
use App\Models\Payout;
use App\Models\PayoutMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PayoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // process successful payments in chunks
        Payment::query()->success()->chunk(200, function ($successfulPayments) {
            foreach ($successfulPayments as $payment) {
                $this->processPayment($payment);
            }
        });
    }

    /**
     * Process a single payment and create the associated payout.
     *
     * @param \App\Models\Payment $payment
     */
    private function processPayment(Payment $payment): void
    {
        $payeeId = $payment->payee_id;

        // Check if a PayoutMethod already exists for the payee
        $payoutMethod = PayoutMethod::where('user_id', $payeeId)->first();

        if (!$payoutMethod) {
            // If no PayoutMethod exists, create a new one
            $payoutMethod = PayoutMethod::factory()->create(['user_id' => $payeeId]);
        }

        $payout = Payout::factory()->make([
            'user_id' => $payeeId,
            'payout_method_id' => $payoutMethod->id,
            'payment_id' => $payment->id,
            'amount' => $this->calculatePayoutAmount($payment)['amount'],
            'fee' => $this->calculatePayoutAmount($payment)['fee'],
        ]);

        $payout->save();
    }


    /**
     * Calculate payout amount and fee.
     *
     * @param \App\Models\Payment $payment
     *
     * @return array
     */
    private function calculatePayoutAmount(Payment $payment): array
    {
        $fee = $payment->amount * (config('payment.payout.fee') / 100);
        $amount = $payment->amount - $fee;

        return [
            'amount' => $amount,
            'fee' => $fee,
        ];
    }
}
