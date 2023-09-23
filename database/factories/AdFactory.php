<?php

namespace Database\Factories;

use App\Enums\AdStatus;
use App\Models\Category;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ad>
 */
class AdFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $parent = Category::whereNull('parent_id')->inRandomOrder()->first();
        $country = Country::inRandomOrder()->first();
        $state = $country->states()->inRandomOrder()->first();
        return [
            'category_id' => $parent->id,
            'sub_category_id' => $parent?->subCategories()->inRandomOrder()->first()->id ?? null,
            'title' => $this->faker->realText(50),
            'description' => $this->faker->paragraph(10),
            'price' => $this->faker->numberBetween(10000, 100000),
            'is_negotiable' => $this->faker->boolean,
            'video_url' => $this->faker->url,
            'seller_name' => $this->faker->name,
            'seller_email' => $this->faker->email,
            'seller_mobile' => $this->faker->e164PhoneNumber,
            'seller_address' => $this->faker->address,
            'views' => $this->faker->numberBetween(0, 1000),
            'status' => $this->faker->randomElement(AdStatus::all()),
            'started_at' => $startedAt = $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'expired_at' => $this->faker->dateTimeBetween($startedAt, '+1 month'),
            'country_id' => $country->id,
            'state_id' => $state->id ?? null,
            'city_id' => $state?->cities()->inRandomOrder()->first()->id ?? null,
        ];
    }
}
