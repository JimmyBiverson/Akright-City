<?php

namespace Database\Factories;

use App\Models\TeamMember;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TeamMember>
 */
class TeamMemberFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'group' => 'executive',
            'name' => fake()->name(),
            'role' => fake()->jobTitle(),
            'location' => null,
            'photo' => null,
            'sort_order' => fake()->numberBetween(1, 100),
        ];
    }
}
