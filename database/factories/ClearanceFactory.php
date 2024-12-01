<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clearance>
 */
class ClearanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'student_id' => '',
            'school_personnel_id' => fake()->numberBetween(1, 50),
            'quarter_id' => fake()->randomElement([1, 2, 3, 4]),
            'description' => fake()->sentence(2),
            'task' => fake()->sentence(),
            'cleared_at' => fake()->randomElement([null, fake()->date()]),
            'due_date' => fake()->dateTimeThisYear(),
        ];
    }
}
