<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('pacientes')->insert([
                'nombre' => $faker->firstName,
                'apellido' => $faker->lastName,
                'fecha_nacimiento' => $faker->date,
                'telefono' => $faker->phoneNumber,
                'correo_electronico' => $faker->email,
                'nombre_contacto_emergencia' => $faker->firstName,
                'contacto_emergencia' => $faker->phoneNumber,
            ]);
        }
    }
}
