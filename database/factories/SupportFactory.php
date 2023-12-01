<?php

namespace Database\Factories;

use App\Enums\SupportStatusEnum;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Support>
 */
class SupportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => 'support@' . $this->faker->safeEmailDomain,
            'phone' => $this->faker->phoneNumber,
            'subject' => $this->faker->sentence,
            'message' => collect($this->faker->paragraphs(20))
                ->map(fn ($paragraph) => "<p>{$paragraph}</p>")
                ->push('<p><br></p>')
                ->implode(''),
            'status' => $this->faker->randomElement(SupportStatusEnum::class),
            'assigned_to' => $this->faker->randomElement([null, Admin::query()->inRandomOrder()->first()->id]),
            'response' => collect($this->faker->paragraphs(5))
                ->map(fn ($paragraph) => "<p>{$paragraph}</p>")
                ->push('<p><br></p>')
                ->implode(''),
        ];
    }
}
