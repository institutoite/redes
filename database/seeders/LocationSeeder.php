<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('locations')->insert([
            [
                'titulo' => 'ITE CENTRAL',
                'latitud'  => '-17.802003',
                'longitud' => '-63.136256',
                'zoom' => 15,
                'direccion' => 'Villa 1 de mayo calle 16 oeste #9',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'SUCURSAL VILLA 1 DE MAYO',
                'latitud' => '-17.801778',
                'longitud' => '-63.135519',
                'zoom' => 15,
                'direccion' => 'Villa 1 de mayo calle 16 oeste #9',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'SUCURSAL PLAN 3000',
                'latitud' => '-17.816530',
                'longitud' => '-63.139487',
                'zoom' => 15,
                'direccion' => 'Av. Che guevara #4454',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Puedes agregar más ubicaciones aquí
        ]);
    }
    
}
