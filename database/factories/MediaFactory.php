<?php

namespace Database\Factories;

use App\Enums\MediaType;
use App\Enums\StorageDiskType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
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
            'type' => MediaType::IMAGE,
            'path' => $this->faker->imageUrl(),
            'url' => $this->faker->imageUrl(),
            'extension' => 'jpg',
            'mime_type' => 'image/jpeg',
            'size' => $this->faker->numberBetween(1024, 3072),
            'storage' => StorageDiskType::LOCAL,
            'is_featured' => false,
        ];
    }
}
