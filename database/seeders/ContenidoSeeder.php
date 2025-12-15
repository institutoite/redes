<?php

namespace Database\Seeders;

use App\Models\Contenido;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ContenidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Solo asignar estos contenidos al producto "Preescolar" (ajusta el nombre según corresponda)
        $producto = Product::where('nombre', 'Preescolar')->first();
        if ($producto) {
            $items = [
                // Prekínder
                ['subnivel' => 'Prekínder', 'titulo' => 'Motricidad fina', 'descripcion' => 'Trazos, ensartar, plastilina y pinzas para fortalecer dedos.'],
                ['subnivel' => 'Prekínder', 'titulo' => 'Motricidad gruesa', 'descripcion' => 'Saltos, equilibrio, coordinación y circuitos motrices.'],
                ['subnivel' => 'Prekínder', 'titulo' => 'Lenguaje y comunicación', 'descripcion' => 'Vocabulario, rimas, canciones y expresión oral.'],
                ['subnivel' => 'Prekínder', 'titulo' => 'Reconocimiento de colores y formas', 'descripcion' => 'Clasificación, seriación y juegos de asociación.'],
                ['subnivel' => 'Prekínder', 'titulo' => 'Hábitos y autonomía', 'descripcion' => 'Rutinas, normas y autocuidado básico.'],

                // Kinder
                ['subnivel' => 'Kinder', 'titulo' => 'Prelectura', 'descripcion' => 'Conciencia fonológica, rimas y discriminación auditiva.'],
                ['subnivel' => 'Kinder', 'titulo' => 'Preescritura', 'descripcion' => 'Direccionalidad, grafomotricidad y trazos básicos.'],
                ['subnivel' => 'Kinder', 'titulo' => 'Pensamiento lógico-matemático', 'descripcion' => 'Conteo, correspondencia uno a uno y seriaciones.'],
                ['subnivel' => 'Kinder', 'titulo' => 'Ciencia y exploración', 'descripcion' => 'Observación del entorno, experimentos simples y preguntas.'],
                ['subnivel' => 'Kinder', 'titulo' => 'Socioemocional', 'descripcion' => 'Manejo de emociones, juego cooperativo y empatía.'],
            ];

            $maxOrden = Contenido::where('product_id', $producto->id)->max('orden') ?? 0;
            $orden = $maxOrden + 1;
            foreach ($items as $i) {
                Contenido::updateOrCreate([
                    'product_id' => $producto->id,
                    'titulo' => $i['titulo'],
                ], [
                    'subnivel' => $i['subnivel'],
                    'descripcion' => $i['descripcion'],
                    'estado' => true,
                    'orden' => $orden,
                ]);
                $orden++;
            }
        }
    }
}
