<?php

namespace Database\Factories;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Video>
 */
class VideoFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'url' => 'https://www.youtube.com/watch?v='.fake()->lexify('???????????'),
            'sort_order' => fake()->numberBetween(1, 100),
        ];
    }
}
