<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//Librerias para el llenado 
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $usuario = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        //se le asigna el rol
        $usuario->assignRole('Administrador');
    }
}
