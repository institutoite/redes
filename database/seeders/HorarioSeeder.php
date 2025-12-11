<?php

namespace Database\Seeders;

use App\Models\Horario;
use App\Models\Product;
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

        // Asignar horarios base a TODOS los productos existentes
        $productos = Product::all(['id']);
        foreach ($productos as $producto) {
            foreach ($horarios as $horario) {
                Horario::firstOrCreate([
                    'product_id' => $producto->id,
                    'horario' => $horario,
                ], [
                    'estado' => 1,
                ]);
            }
        }
    }
}
