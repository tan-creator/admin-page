<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fullname' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password', // password
            'remember_token' => Str::random(10),
            'code' => rand(1005, 9999),
            'area_code' => '+84',
            'phone_number' => rand(100000000, 999999999),
            'day_of_birth' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'address' => fake()->address(),
            'roles' => Arr::random(['Other','Sub-DM', 'TL', 'PM', 'Members']),
            'levels' => Arr::random(['Other', 'Level 1', 'Level 2', 'Level 3', 'Level 4', 'Level 5']),
            'status' => Arr::random(['Inactive', 'Active', 'Left']),
            'types'=>Arr::random(['Other', 'Official', 'Probationary', 'Apprenticeship', 'Fresher', 'Intern', 'Onsite']),
            'department_id' => rand(1, 5),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
