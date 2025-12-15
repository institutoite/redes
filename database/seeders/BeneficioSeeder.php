<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Beneficio;
use App\Models\Product;

class BeneficioSeeder extends Seeder
{
    public function run(): void
    {
        $producto = Product::where('nombre', 'Nivel Inicial')->first();
        if (!$producto) {
            return;
        }

        $beneficios = [
            [
                'titulo' => 'Atención personalizada',
                'detalle' => 'Seguimiento individual para cada niño y familia.',
                'priority' => 1,
            ],
            [
                'titulo' => 'Material didáctico exclusivo',
                'detalle' => 'Recursos adaptados a la etapa inicial para potenciar el aprendizaje.',
                'priority' => 2,
            ],
            [
                'titulo' => 'Comunicación constante',
                'detalle' => 'Informes y contacto directo con los padres sobre avances y necesidades.',
                'priority' => 3,
            ],
            [
                'titulo' => 'Ambiente seguro y motivador',
                'detalle' => 'Espacios y dinámicas pensadas para el desarrollo integral.',
                'priority' => 4,
            ],
        ];

        foreach ($beneficios as $b) {
            Beneficio::updateOrCreate([
                'product_id' => $producto->id,
                'titulo' => $b['titulo'],
            ], [
                'detalle' => $b['detalle'],
                'estado' => true,
                'priority' => $b['priority'],
            ]);
        }
    }
}
