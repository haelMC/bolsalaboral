<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Joboffer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobofferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $joboffers=Joboffer::factory(0)->create();
        foreach($joboffers as $joboffer){
            Image::factory(1)->create([
                'imageable_id'=>$joboffer->id,
                'imageable_type'=>Joboffer::class
            ]);
        }

    }
}
