<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Worklog;
use App\Models\User;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProject>
 */
class WorklogFactory extends Factory
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
            'issue_type' => ['Task', 'Bug_Customer', 'Bug', 'Sub_Task'][array_rand(['Task', 'Bug_Customer', 'Bug', 'Sub_Task'])],
            'issue_estimate' => fake()->randomFloat(1, 1, 5),
            'hours' => fake()->randomFloat(1, 1, 5),
            'issue_type' => Arr::random(['Bug', 'Bug_Customer', 'Change Request', 'Epic', 'Feedback', 'Improvement', 'Leakage', 'Q&A', 'Sub-Task', 'Task', 'New Feature']),
            'work_date' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d')
        ];
    }
}
