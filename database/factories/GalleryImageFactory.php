<?php

namespace Database\Factories;

use App\Models\GalleryImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GalleryImage>
 */
class GalleryImageFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'year' => fake()->year(),
            'category' => 'Community',
            'title' => fake()->sentence(2),
            'path' => fake()->imageUrl(),
            'alt_text' => fake()->sentence(3),
            'sort_order' => fake()->numberBetween(1, 100),
        ];
    }
}
