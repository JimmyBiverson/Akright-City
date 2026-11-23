<?php

namespace Database\Factories;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AuditLog>
 */
class AuditLogFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null,
            'action' => fake()->randomElement(['created', 'updated', 'deleted']),
            'subject_type' => fake()->word(),
            'subject_id' => fake()->numberBetween(1, 100),
            'description' => fake()->sentence(),
        ];
    }
}
