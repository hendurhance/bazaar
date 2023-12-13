<?php

namespace Database\Factories;

use App\Enums\PaymentGateway;
use App\Enums\PayoutStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payout>
 */
class PayoutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(PayoutStatus::all());
        return [
            'gateway' => $this->faker->randomElement(PaymentGateway::all()),
            'description' => $this->faker->sentence,
            'currency' => config('payment.currencies.default'),
            'status' => $status,
            'paid_at' => $status === PayoutStatus::SUCCESS ? now() : null,
        ];
    }
}
