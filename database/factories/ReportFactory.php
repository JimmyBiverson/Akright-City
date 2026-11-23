<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Report>
 */
class ReportFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'year' => fake()->year(),
            'category' => 'Financial Reports',
            'title' => fake()->sentence(3).'.pdf',
            'path' => null,
            'sort_order' => fake()->numberBetween(1, 100),
        ];
    }
}
