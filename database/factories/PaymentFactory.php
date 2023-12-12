<?php

namespace Database\Factories;

use App\Enums\PaymentGateway;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->numberBetween(10000, 1000000),
            'gateway' => $this->faker->randomElement(PaymentGateway::all()),
            'status' => $this->faker->randomElement(PaymentStatus::all()),
            'currency' => config('payment.currencies.default'),
            'card_last4' => $this->faker->randomNumber(4),
            'card_id' => 'AUTH_' . $this->faker->randomAscii(10),
            'client_ip' => $this->faker->ipv4,
            'payer_email' => $this->faker->email,
            'description' => $this->faker->sentence,
        ];
    }
}
