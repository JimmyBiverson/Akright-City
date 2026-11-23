<?php

namespace Database\Factories;

use App\Models\PageContent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PageContent>
 */
class PageContentFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => fake()->unique()->slug(),
            'title' => fake()->sentence(3),
            'subtitle' => fake()->sentence(),
            'hero_image' => null,
            'body_html' => '<p>'.fake()->paragraph().'</p>',
            'meta_description' => fake()->sentence(),
        ];
    }
}
