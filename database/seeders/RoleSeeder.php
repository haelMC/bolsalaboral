<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear los roles manualmente
        DB::table('roles')->insert([
            ['name' => 'usuario'],
            ['name' => 'empresa'],
            ['name' => 'admin'],  // Si necesitas un rol de administrador
        ]);
    }
}
