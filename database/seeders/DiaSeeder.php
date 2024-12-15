<?php

namespace Database\Seeders;

use App\Models\Dias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dias::create([
            'dia' => 'Lunes',
            'modalidad_id' => 1, // Presencial - Cubo Rubik
        ]);

        Dias::create([
            'dia' => 'Miércoles',
            'modalidad_id' => 1, // Presencial - Cubo Rubik
        ]);

        Dias::create([
            'dia' => 'Viernes',
            'modalidad_id' => 1, // Presencial - Cubo Rubik
        ]);

        // Días para la modalidad 2 - Virtual Cubo Rubik
        Dias::create([
            'dia' => 'Martes',
            'modalidad_id' => 2, // Virtual - Cubo Rubik
        ]);

        Dias::create([
            'dia' => 'Jueves',
            'modalidad_id' => 2, // Virtual - Cubo Rubik
        ]);

        // Días para la modalidad 3 - Híbrido Ajedrez
        Dias::create([
            'dia' => 'Sábado',
            'modalidad_id' => 3, // Híbrido - Ajedrez
        ]);

        Dias::create([
            'dia' => 'Domingo',
            'modalidad_id' => 3, // Híbrido - Ajedrez
        ]);

        // Días para la modalidad 4 - Presencial Computación
        Dias::create([
            'dia' => 'Lunes',
            'modalidad_id' => 4, // Presencial - Computación
        ]);

        Dias::create([
            'dia' => 'Miércoles',
            'modalidad_id' => 4, // Presencial - Computación
        ]);

        Dias::create([
            'dia' => 'Viernes',
            'modalidad_id' => 4, // Presencial - Computación
        ]);
    }
}
