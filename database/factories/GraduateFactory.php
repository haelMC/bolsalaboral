<?php

namespace Database\Factories;

use App\Models\Institution;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Graduate>
 */
class GraduateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'code' => $this->faker->unique()->randomNumber(),
            'specialty' => $this->faker->word,
            'academic_level' => $this->faker->randomElement(['Bachelor', 'Master', 'PhD']),
            'user_id'=>User::all()->random()->id,
            'institution_id'=>Institution::all()->random()->id,
        ];
    }
}
