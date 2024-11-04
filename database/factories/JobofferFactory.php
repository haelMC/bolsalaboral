<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Joboffer>
 */
class JobofferFactory extends Factory
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
            'title' =>$this->faker->sentence,
            'description' =>$this->faker->paragraph,
            'type' =>$this->faker->randomElement(['Full-time', 'Part-time', 'Contract']),
            'location' =>$this->faker->city,
            'salary' =>$this->faker->randomFloat(2, 1000, 10000),
            'start_date' =>$this->faker->date,
            'end_date' =>$this->faker->optional()->date,
            'experience_required' =>$this->faker->randomElement(['Entry level', 'Intermediate', 'Senior']),
            'contact_details' =>$this->faker->name . ' - ' .$this->faker->phoneNumber,
            'status' =>$this->faker->randomElement(['Active', 'Inactive']),
            'category_id'=>Category::all()->random()->id,
            'company_id' =>Company::all()->random()->id,


        ];
    }
}
