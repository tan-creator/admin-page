<?php

namespace Database\Factories;

use App\Models\Certification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CertificationUser>
 */
class CertificationUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'certification_id' => Certification::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id
        ];
    }
}
