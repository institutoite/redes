<?php

namespace Database\Seeders;

use App\Models\Modalidad;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            ModalidadSeeder::class,
            HorarioSeeder::class,
            VentajaSeeder::class,
            DiaSeeder::class,
            SocialSeeder::class,
            LocationSeeder::class,
            UserSeeder::class,
            InfoSeeder::class,
        ]);
    }
}
