<?php

namespace Database\Factories;

use App\Models\Institution;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
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
            'academic_degree' =>$this->faker->sentence,
            'specialty' =>$this->faker->word,
            'email' =>$this->faker->unique()->safeEmail,
            'user_id' =>User::all()->random()->id,
            'institution_id'=>Institution::all()->random()->id,
        ];
    }
}
