<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Projects>
 */
class ProjectsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'types' => Arr::random(['Other', 'Fixed Price', 'Body Shopping']),
            'status' => Arr::random(['Other', 'Coming', 'On-going', 'Closed', 'Pending']),
            'begin_date' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'finish_date' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'customer_name' => fake()->name(),
            'note' => Str::random(10),
            'mm' => fake()->randomFloat(3, 10000, 99999),
        ];
    }
}
