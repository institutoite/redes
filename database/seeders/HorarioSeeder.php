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
        // Seeder para asignar horarios a cada modalidad
        $horarios = [
            '07:30 - 09:00',
            '09:00 - 10:30',
            '10:30 - 12:00',
            '14:00 - 15:30',
            '15:30 - 17:00',
            '17:00 - 18:30',
        ];

        // Total de modalidades (18 modalidades creadas previamente)
        $totalModalidades = 89;

        for ($modalidadId = 1; $modalidadId <= $totalModalidades; $modalidadId++) {
            foreach ($horarios as $horario) {
                Horario::create([
                    'horario' => $horario,
                    'estado' => 1,
                    'modalidad_id' => $modalidadId,
                ]);
            }
        }
    }
}
