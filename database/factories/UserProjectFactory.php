<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Projects;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProject>
 */
class UserProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'project_id' => Projects::inRandomOrder()->first()->id,
        ];
    }
}
