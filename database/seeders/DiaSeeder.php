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
        // Días de la semana
        $diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        
        // Modalidades con días personalizados
        $diasPersonalizados = [
            4 => ['Lunes', 'Miércoles', 'Viernes'], // Tres veces por semana (Lun-Mie-Vie)
            5 => ['Martes', 'Jueves', 'Sábado'],   // Tres veces por semana (Mar-Jue-Sab)
            8 => ['Lunes', 'Miércoles', 'Viernes'], // Plan 2 semanas (Lun-Mie-Vie)
            9 => ['Martes', 'Jueves', 'Sábado'],   // Plan 2 semanas (Mar-Jue-Sab)
            11 => ['Lunes', 'Miércoles', 'Viernes'], // Plan Mensual (Lun-Mie-Vie)
            12 => ['Martes', 'Jueves', 'Sábado'],   // Plan Mensual (Mar-Jue-Sab)
            14 => ['Lunes', 'Miércoles', 'Viernes'], // Plan Bimestral (Lun-Mie-Vie)
            15 => ['Martes', 'Jueves', 'Sábado'],   // Plan Bimestral (Mar-Jue-Sab)
            17 => ['Lunes', 'Miércoles', 'Viernes'], // Plan Trimestral (Lun-Mie-Vie)
            18 => ['Martes', 'Jueves', 'Sábado'],   // Plan Trimestral (Mar-Jue-Sab)
        ];

        // Modalidades de lunes a viernes
        $modalidadesLunesAViernes = [6, 10, 13, 16, 19]; // IDs de modalidades lunes a viernes
        
        // Modalidades de lunes a sábado
        $modalidadesLunesASabado = [7]; // ID de modalidades lunes a sábado

        // Asignar días a modalidades personalizadas (tres veces por semana)
        foreach ($diasPersonalizados as $modalidadId => $dias) {
            foreach ($dias as $dia) {
                Dias::create([
                    'dia' => $dia,
                    'modalidad_id' => $modalidadId,
                ]);
            }
        }

        // Asignar días lunes a viernes
        foreach ($modalidadesLunesAViernes as $modalidadId) {
            foreach (array_slice($diasSemana, 0, 5) as $dia) { // Lunes a Viernes
                Dias::create([
                    'dia' => $dia,
                    'modalidad_id' => $modalidadId,
                ]);
            }
        }

        // Asignar días lunes a sábado
        foreach ($modalidadesLunesASabado as $modalidadId) {
            foreach ($diasSemana as $dia) { // Lunes a Sábado
                Dias::create([
                    'dia' => $dia,
                    'modalidad_id' => $modalidadId,
                ]);
            }
        }
    }
}
