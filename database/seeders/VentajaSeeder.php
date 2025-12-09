<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Ventaja;
use Illuminate\Database\Seeder;

class VentajaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sembramos ventajas para todas las modalidades del producto "Nivel Inicial"
        $inicial = Product::where('nombre', 'Nivel Inicial')->first();
        if (!$inicial) {
            return; // Si no existe el producto, no hacemos nada
        }

        // Ventajas generales para el nivel (no específicas por modalidad)
        $primeraModalidad = $inicial->modalidades()->first();
        if (!$primeraModalidad) {
            return;
        }

        $generales = [
            [
                'ventaja' => 'Clases personalizadas',
                'detalle' => 'Atención individual y adaptación al ritmo de cada niño/a.',
            ],
            [
                'ventaja' => 'Cantidad reducida de estudiantes',
                'detalle' => 'Grupos pequeños para favorecer la participación y seguimiento.',
            ],
            [
                'ventaja' => 'Docentes especializados',
                'detalle' => 'Equipo con experiencia en Nivel Inicial y primera infancia.',
            ],
            [
                'ventaja' => 'Material didáctico incluido',
                'detalle' => 'Juegos, fichas y recursos lúdicos para aprender haciendo.',
            ],
            [
                'ventaja' => 'Comunicación con familias',
                'detalle' => 'Reporte de avances y recomendaciones vía WhatsApp.',
            ],
            [
                'ventaja' => 'Ambiente seguro y lúdico',
                'detalle' => 'Espacios adecuados para explorar, experimentar y divertirse.',
            ],
        ];

        foreach ($generales as $v) {
            Ventaja::create([
                'ventaja' => $v['ventaja'],
                'detalle' => $v['detalle'],
                'estado' => true,
                'modalidad_id' => $primeraModalidad->id,
            ]);
        }
    }
}
