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

        // Crear días base si no existen
        $diaIds = [];
        foreach ($diasSemana as $nombreDia) {
            $dia = \App\Models\Dias::firstOrCreate(['dia' => $nombreDia]);
            $diaIds[$nombreDia] = $dia->id;
        }
        
        // Grupos de días por opción
        $opcionLMV = ['Lunes', 'Miércoles', 'Viernes'];
        $opcionMJS = ['Martes', 'Jueves', 'Sábado'];
        $opcionLAV = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];

        // Asignar días a modalidades personalizadas (tres veces por semana)
        // Asignar opciones a modalidades: ejemplo
        // Semanal 3 Veces -> dos opciones (LMV y MJS)
        $idsSemanal3Veces = \App\Models\Modalidad::where('modalidad', 'like', '%Semanal 3 Veces%')->pluck('id');
        foreach ($idsSemanal3Veces as $modalidadId) {
            \DB::table('dia_modalidad')->insertOrIgnore(
                collect($opcionLMV)->map(fn($d) => [
                    'dias_id' => $diaIds[$d],
                    'modalidad_id' => $modalidadId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ])->toArray()
            );
            \DB::table('dia_modalidad')->insertOrIgnore(
                collect($opcionMJS)->map(fn($d) => [
                    'dias_id' => $diaIds[$d],
                    'modalidad_id' => $modalidadId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ])->toArray()
            );
        }

        // Semanal lunes a viernes -> una opción LAV
        $idsLunesAViernes = \App\Models\Modalidad::where('modalidad', 'like', '%Lunes a Viernes%')->pluck('id');
        foreach ($idsLunesAViernes as $modalidadId) {
            \DB::table('dia_modalidad')->insertOrIgnore(
                collect($opcionLAV)->map(fn($d) => [
                    'dias_id' => $diaIds[$d],
                    'modalidad_id' => $modalidadId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ])->toArray()
            );
        }
    }
}
