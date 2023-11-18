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
        $media = Media::factory()->create();
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraphs(5, true),
            'featured_image_id' => $media->id,
            'is_published' => true,
        ];
    }
}
