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
                'latitud' => '34.0522',
                'longitud' => '-118.2437',
                'zoom' => '10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Ubicación 2',
                'latitud' => '40.7128',
                'longitud' => '-74.0060',
                'zoom' => '12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Ubicación 3',
                'latitud' => '51.5074',
                'longitud' => '-0.1278',
                'zoom' => '8',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Puedes agregar más ubicaciones aquí
        ]);
    }
    
}
