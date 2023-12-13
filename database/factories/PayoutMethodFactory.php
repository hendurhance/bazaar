<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PayoutMethod>
 */
class PayoutMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $country = Country::pluck('id')->toArray();
        return [
            'bank_name' => $this->faker->company,
            'bank_code' => $this->faker->randomNumber(5),
            'account_name' => $this->faker->name,
            'account_number' => $this->faker->bankAccountNumber,
            'swift_code' => $this->faker->swiftBicNumber,
            'iban' => $this->faker->iban('US'),
            'routing_number' => $this->faker->bankRoutingNumber,
            'country_id' => $this->faker->randomElement($country),
        ];
    }
}
