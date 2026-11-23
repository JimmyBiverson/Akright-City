<?php

namespace Database\Factories;

use App\Models\NewsPost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<NewsPost>
 */
class NewsPostFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => fake()->unique()->slug(),
            'title' => fake()->sentence(4),
            'published_at' => fake()->date(),
            'image' => null,
            'excerpt' => fake()->sentence(),
            'body_html' => '<p>'.fake()->paragraph().'</p>',
            'link' => null,
            'link_label' => 'Read More →',
            'sort_order' => fake()->numberBetween(1, 100),
        ];
    }
}
