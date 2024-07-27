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
                'titulo' => 'Ubicación 1',
                'latitud'  => '-17.8145454',
                'longitud' => '-63.1359615',
                'direccion' => 'Av. Tres pasos al frente #4710',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Ubicación 2',
                'latitud' => '-17.8022476',
                'longitud' => '-63.1359682',
                'direccion' => 'Villa 1 de mayo calle 16 oeste #9',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Ubicación 3',
                'latitud' => '-17.8158112',
                'longitud' => '-63.138866',
                'direccion' => 'Av. Che guevara #4454',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Puedes agregar más ubicaciones aquí
        ]);
    }
    
}
