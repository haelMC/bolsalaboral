<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         User::create([
            'name'=>'Rafael',
            'paternal_last_name'=>'Mamani ',
            'maternal_last_name'=>'Callata',
            'dni'=>'75374289',
            'birth_date'=>'2004-07-30 ',
            'phone'=>'991387322',
            'email'=>'rafael@gmail.com',
            'password'=>bcrypt('12345678'),
        ]);
        User::factory(5)->create();
    }
}
