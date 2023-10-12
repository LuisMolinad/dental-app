<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //aca se agregan los seeders que quiero que corran 
        $this->call([RolesAndPermissionSeeder::class]);
        $this->call([SuperAdminSeeder::class]);
    }
}
