<?php

namespace Database\Factories;

use App\Models\Graduate;
use App\Models\Joboffer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Postulation>
 */
class PostulationFactory extends Factory
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
            'cv' => $this->faker->sentence,
            'score' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->randomElement(['pending', 'accepted', 'rejected']),
            'graduate_id' => Graduate::all()->random()->id,
            'joboffer_id' => Joboffer::all()->random()->id,

        ];
    }
}
