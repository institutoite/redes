<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contenido;
use App\Models\Product;

class ContenidoInicialSeeder extends Seeder
{
    public function run(): void
    {
        $producto = Product::where('nombre', 'Nivel Inicial')->first();
        if (!$producto) {
            return;
        }

        $contenidos = [
            [
                'subnivel' => 'Prekínder',
                'titulo' => 'Motricidad fina',
                'descripcion' => 'Trazos, ensartar, plastilina y pinzas para fortalecer dedos.',
                'orden' => 1,
            ],
            [
                'subnivel' => 'Prekínder',
                'titulo' => 'Motricidad gruesa',
                'descripcion' => 'Saltos, equilibrio, coordinación y circuitos motrices.',
                'orden' => 2,
            ],
            [
                'subnivel' => 'Prekínder',
                'titulo' => 'Lenguaje y comunicación',
                'descripcion' => 'Vocabulario, rimas, canciones y expresión oral.',
                'orden' => 3,
            ],
            [
                'subnivel' => 'Prekínder',
                'titulo' => 'Reconocimiento de colores y formas',
                'descripcion' => 'Clasificación, seriación y juegos de asociación.',
                'orden' => 4,
            ],
            [
                'subnivel' => 'Prekínder',
                'titulo' => 'Hábitos y autonomía',
                'descripcion' => 'Rutinas, normas y autocuidado básico.',
                'orden' => 5,
            ],
            [
                'subnivel' => 'Kinder',
                'titulo' => 'Prelectura',
                'descripcion' => 'Conciencia fonológica, rimas y discriminación auditiva.',
                'orden' => 6,
            ],
            [
                'subnivel' => 'Kinder',
                'titulo' => 'Preescritura',
                'descripcion' => 'Direccionalidad, grafomotricidad y trazos básicos.',
                'orden' => 7,
            ],
            [
                'subnivel' => 'Kinder',
                'titulo' => 'Pensamiento lógico-matemático',
                'descripcion' => 'Conteo, correspondencia uno a uno y seriaciones.',
                'orden' => 8,
            ],
            [
                'subnivel' => 'Kinder',
                'titulo' => 'Ciencia y exploración',
                'descripcion' => 'Observación del entorno, experimentos simples y preguntas.',
                'orden' => 9,
            ],
            [
                'subnivel' => 'Kinder',
                'titulo' => 'Socioemocional',
                'descripcion' => 'Manejo de emociones, juego cooperativo y empatía.',
                'orden' => 10,
            ],
        ];

        foreach ($contenidos as $c) {
            Contenido::updateOrCreate([
                'product_id' => $producto->id,
                'titulo' => $c['titulo'],
            ], [
                'subnivel' => $c['subnivel'],
                'descripcion' => $c['descripcion'],
                'orden' => $c['orden'],
                'estado' => true,
            ]);
        }
    }
}
