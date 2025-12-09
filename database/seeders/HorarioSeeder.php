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
        // Seeder para asignar horarios a cada servicio (producto)
        $horarios = [
            '07:30 - 09:00',
            '09:00 - 10:30',
            '10:30 - 12:00',
            '14:00 - 15:30',
            '15:30 - 17:00',
            '17:00 - 18:30',
        ];

        // Asignar mismos horarios base a los primeros N productos
        $totalProductos = 5; // ajustar según cantidad real

        for ($productId = 1; $productId <= $totalProductos; $productId++) {
            foreach ($horarios as $horario) {
                Horario::create([
                    'horario' => $horario,
                    'estado' => 1,
                    'product_id' => $productId,
                ]);
            }
        }
    }
}
