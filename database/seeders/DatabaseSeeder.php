<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Company;
use App\Models\Graduate;
use App\Models\Institution;
use App\Models\Joboffer;
use App\Models\Monitoring;
use App\Models\Monitoringdetail;
use App\Models\Postulation;
use App\Models\Teacher;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call(UserSeeder::class);
        // Crear registros para Company
        Company::factory()->count(5)->create();

        Institution::factory()->count(5)->create();
        // Crear registros para Graduate
        Graduate::factory()->count(10)->create();

        // Crear registros para Teacher
        Teacher::factory()->count(5)->create();

        // Crear registros para JobOffer
        Monitoring::factory()->count(20)->create();
        Monitoringdetail::factory()->count(20)->create();
        Category::factory()->count(10)->create();
        $this->call(JobofferSeeder::class);
        // Crear registros para Recommendation
        Postulation::factory()->count(10)->create();

        // Crear registros para Institution
    }
}
