<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
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
        'name' =>$this->faker->company,
        'description' =>$this->faker->paragraph,
        'location' =>$this->faker->city,
        'email' => $this->faker->email,
        'address' => $this->faker->address,
        'phone' => $this->faker->phoneNumber,
        'industry_sector' => $this->faker->randomElement(['Technology', 'Finance', 'Healthcare', 'Education', null]),
        'years_of_activity' => $this->faker->numberBetween(1, 50),
        'user_id'=>User::all()->random()->id,
        ];
    }
}
