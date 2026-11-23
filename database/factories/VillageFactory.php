<?php

namespace Database\Factories;

use App\Models\Village;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Village>
 */
class VillageFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => fake()->unique()->slug(),
            'name' => fake()->word().' Village',
            'tagline' => fake()->sentence(3),
            'chairperson' => fake()->name(),
            'chairperson_message' => fake()->paragraph(),
            'body_html' => '<p>'.fake()->paragraph().'</p>',
            'map_image' => null,
            'gallery_images' => [],
            'card_image' => null,
            'sort_order' => fake()->numberBetween(1, 100),
        ];
    }
}
