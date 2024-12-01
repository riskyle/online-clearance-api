<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $section = $this->section();

        return [
            'user_id' => User::factory(state: ['role_id' => 3]),
            'lrn' => fake()->numberBetween(123456789, 987654321),
            'student_firstname' => fake()->firstName(),
            'student_middlename' => fake()->lastName(),
            'student_lastname' => fake()->lastName(),
            'student_year_level' => fake()->randomElement([7, 8, 9, 10, 11, 12]),
            'student_mobile_number' => fake()->phoneNumber(),
            'student_address' => fake()->address(),
            'student_sex' => fake()->randomElement(['Male', 'Female']),
            'student_age' => fake()->numberBetween(13, 18),
            'student_birthdate' => fake()->date(),
            'student_religion' => "Catholic",
            'student_civil_status' => fake()->randomElement(['Single', 'Widowed', 'Married']),
            'student_father_name' => fake()->firstName() . " " . fake()->lastName(),
            'student_mother_name' => fake()->firstName() . " " . fake()->lastName(),
            'student_guardian_name' => fake()->firstName() . " " . fake()->lastName(),
            'student_section' => fake()->randomElement($section),
            'student_type' => fake()->randomElement(['jhs', 'shs']),
        ];
    }

    protected function section(): array
    {
        return [
            'Mango',
            'Apple',
            'Orange',
        ];
    }
}
