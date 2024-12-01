<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SchoolPersonnel>
 */
class SchoolPersonnelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(state: ['role_id' => fake()->randomElement([1, 2])]),
            'sp_firstname' => fake()->firstName(),
            'sp_middlename' => fake()->lastName(),
            'sp_lastname' => fake()->lastName(),
            'sp_mobile_number' => fake()->phoneNumber(),
            'sp_address' => fake()->address(),
            'sp_sex' => fake()->randomElement(['Male', 'Female']),
            'sp_birthdate' => fake()->date(),
            'sp_age' => fake()->numberBetween(25, 59),
            'sp_religion' => 'Catholic',
            'sp_civil_status' => fake()->randomElement(['Single', 'Married', 'Widowed']),
        ];
    }
}
