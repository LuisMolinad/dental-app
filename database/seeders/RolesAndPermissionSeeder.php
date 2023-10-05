<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
//
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // TODO usuarios
        Permission::create(['name' => 'ver-Usuarios']);
        Permission::create(['name' => 'editar-Usuarios']);
        Permission::create(['name' => 'crear-Usuarios']);
        Permission::create(['name' => 'borrar-Usuarios']);

        // TODO Roles
        Permission::create(['name' => 'ver-rol']);
        Permission::create(['name' => 'editar-rol']);
        Permission::create(['name' => 'crear-rol']);
        Permission::create(['name' => 'borrar-rol']);


        // TODO PACIENTES
        Permission::create(['name' => 'ver-paciente']);
        Permission::create(['name' => 'editar-paciente']);
        Permission::create(['name' => 'crear-paciente']);
        Permission::create(['name' => 'borrar-paciente']);

        //Se crea el rol asistente

        Role::create(['name' => 'Administrador'])->givePermissionTo(Permission::all());
    }
}
