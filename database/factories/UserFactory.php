<?php

namespace Database\Factories;

use App\Enums\Gender;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $country = Country::inRandomOrder()->first();
        $state = $country->states()->inRandomOrder()->first();
        return [
            'name' => fake()->name(),
            'email' => $email = fake()->unique()->safeEmail(),
            'username' => fake()->unique()->userName(),
            'mobile' => fake()->unique()->e164PhoneNumber(),
            'gender' => fake()->randomElement(Gender::all()),
            'avatar' => get_random_avatar(),
            'email_verified_at' => now(),
            'email_verification_token' => generate_verify_token($email),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'country_id' => $country->id,
            'state_id' => $state?->id ?? null,
            'city_id' => $state?->cities()->inRandomOrder()->first()->id ?? null,
            'address' => fake()->address(),
            'zip_code' => fake()->postcode(),
            'timezone_id' => $country->timezones()->inRandomOrder()->first()->id ?? null,
            'created_at' => $this->faker->dateTimeBetween('-2 weeks', 'now'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the model's email address should be verified.
     */
    public function verified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => now(),
            'email_verification_token' => null,
        ]);
    }

    /**
     * Indicate that the model's gender should be 
     */
    public function gender(Gender $gender): static
    {
        return $this->state(fn (array $attributes) => [
            'gender' => $gender,
        ]);
    }
}
