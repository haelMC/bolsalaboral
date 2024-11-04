<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Verificar y crear permisos si no existen
        Permission::firstOrCreate(['name' => 'view postulations']);
        Permission::firstOrCreate(['name' => 'edit postulations']);
        Permission::firstOrCreate(['name' => 'delete postulations']);

        // Verificar y crear roles si no existen
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'empresa']);
        Role::firstOrCreate(['name' => 'usuario']);

        // Asignar permisos a roles
        $adminRole = Role::where('name', 'admin')->first();
        $empresaRole = Role::where('name', 'empresa')->first();
        $usuarioRole = Role::where('name', 'usuario')->first();

        // Sincronizar permisos a los roles
        $adminRole->syncPermissions(['view postulations', 'edit postulations', 'delete postulations']);
        $empresaRole->syncPermissions(['view postulations', 'edit postulations']);
        $usuarioRole->syncPermissions(['view postulations']);
    }
}
