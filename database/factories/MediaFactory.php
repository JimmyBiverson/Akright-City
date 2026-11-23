<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Media>
 */
class MediaFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'path' => 'media/'.fake()->uuid().'.jpg',
            'original_name' => fake()->word().'.jpg',
            'mime' => 'image/jpeg',
            'size' => fake()->numberBetween(1024, 1048576),
            'alt_text' => fake()->sentence(3),
            'uploaded_by' => null,
        ];
    }
}
