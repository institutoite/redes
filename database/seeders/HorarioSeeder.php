<?php

namespace Database\Seeders;

use App\Models\Horario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Horario::create([
            'horario' => 'Lunes a Viernes: 08:00 - 10:00 AM',
            'estado' => 1,
            'modalidad_id' => 1, // Presencial - Cubo Rubik
        ]);

        Horario::create([
            'horario' => 'Sábados: 10:00 - 12:00 PM',
            'estado' => 1,
            'modalidad_id' => 1, // Presencial - Cubo Rubik
        ]);

        Horario::create([
            'horario' => 'Lunes a Miércoles: 07:00 - 09:00 PM',
            'estado' => 1,
            'modalidad_id' => 2, // Virtual - Cubo Rubik
        ]);

        Horario::create([
            'horario' => 'Martes y Jueves: 06:00 - 08:00 PM',
            'estado' => 1,
            'modalidad_id' => 3, // Híbrido - Ajedrez
        ]);

        Horario::create([
            'horario' => 'Viernes: 05:00 - 07:00 PM',
            'estado' => 1,
            'modalidad_id' => 3, // Híbrido - Ajedrez
        ]);

        Horario::create([
            'horario' => 'Sábados: 09:00 - 11:00 AM',
            'estado' => 1,
            'modalidad_id' => 4, // Presencial - Computación
        ]);

        Horario::create([
            'horario' => 'Lunes a Viernes: 07:00 - 09:00 PM',
            'estado' => 1,
            'modalidad_id' => 5, // Virtual - Diseño gráfico
        ]);

        Horario::create([
            'horario' => 'Domingos: 10:00 AM - 12:00 PM',
            'estado' => 1,
            'modalidad_id' => 6, // Presencial - Dactilografía
        ]);
    }
}
