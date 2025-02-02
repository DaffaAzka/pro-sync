<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_member_id' => 24,
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'priority' => $this->faker->randomElement(['important', 'routine']),
            'status' => $this->faker->randomElement(['ongoing', 'completed']),
            'due_date' => $this->faker->dateTimeBetween('2025-06-01', '2025-06-31'),
        ];
    }
}
