<?php

namespace Database\Factories;

use App\Models\DirectoryEntry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DirectoryEntry>
 */
class DirectoryEntryFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category' => 'Services & Retail',
            'name' => fake()->company(),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->companyEmail(),
            'website' => fake()->url(),
            'details' => null,
            'sort_order' => fake()->numberBetween(1, 100),
        ];
    }
}
