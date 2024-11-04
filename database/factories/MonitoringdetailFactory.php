<?php

namespace Database\Factories;

use App\Models\Monitoring;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Monitoringdetail>
 */
class MonitoringdetailFactory extends Factory
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
            'recommendation' => $this->faker->word,
            'description' => $this->faker->sentence,
            'date_monitoring' => $this->faker->date,
            'monitoring_id'=>Monitoring::all()->random()->id,
        ];
    }
}

