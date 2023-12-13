<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'content' => collect($this->faker->paragraphs(20))
                    ->map(fn ($paragraph) => "<p>{$paragraph}</p>")
                    ->push('<p><br></p>')
                    ->implode(''),
            'is_published' => true,
        ];
    }
}
