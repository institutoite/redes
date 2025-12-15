<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Modalidad;
use App\Models\Ventaja;
use App\Models\Material;
use App\Models\Contenido;
use App\Models\Dia;

class DactilografiaSeeder extends Seeder
{
    public function run(): void
    {
        // Producto: usar el existente si es 'Dactilografía' (ProductSeeder) o crear/completar
        $product = Product::where('nombre', 'Dactilografía')->first();
        if (!$product) {
            $product = Product::firstOrCreate([
                'nombre' => 'Dactilografía Computarizada',
            ], [
                'imagen' => 'dactilografia.jpg',
                'price' => 200.00,
                'clicks' => 0,
                'categories_id' => \DB::table('categories')->where('description', 'DACTILOGRAFIA')->value('id')
                    ?? \DB::table('categories')->where('description', 'COMPUTACION')->value('id')
                    ?? 1,
            ]);
        }

        // Modalidades con días
        $modalidadesData = [
            [
                'modalidad' => 'Tres Veces por Semana',
                'inversion' => 200,
                'descripcion' => 'Práctica guiada 3x/semana con métricas de velocidad y precisión.',
                'dias' => ['Lunes','Miércoles','Viernes'],
            ],
            [
                'modalidad' => 'Lunes a Viernes',
                'inversion' => 420,
                'descripcion' => 'Entrenamiento diario con progresión por niveles y reportes.',
                'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes'],
            ],
            [
                'modalidad' => 'Solo Sábados',
                'inversion' => 250,
                'descripcion' => 'Sesión extendida con evaluación semanal y correcciones.',
                'dias' => ['Sábado'],
            ],
        ];

        $modalidades = [];
        $ordenModalidad = Modalidad::where('product_id', $product->id)->max('orden') ?? 0;
        foreach ($modalidadesData as $md) {
            $ordenModalidad++;
            $m = Modalidad::firstOrCreate([
                'product_id' => $product->id,
                'modalidad' => $md['modalidad'],
            ], [
                'descripcion' => $md['descripcion'],
                'inversion' => $md['inversion'],
                'estado' => true,
                'orden' => $ordenModalidad,
            ]);
            $modalidades[] = $m;

            if (!empty($md['dias'])) {
                $diaIds = [];
                foreach ($md['dias'] as $diaNombre) {
                    $dia = Dia::firstOrCreate(['dias' => $diaNombre]);
                    $diaIds[] = $dia->id;
                }
                $m->dias()->syncWithoutDetaching($diaIds);
            }
        }

        // Ventajas por modalidad
        foreach ($modalidades as $m) {
            $items = [
                ['ventaja' => 'Velocidad de escritura', 'detalle' => 'Mejora WPM con técnicas y rutinas diarias.'],
                ['ventaja' => 'Precisión y postura', 'detalle' => 'Corrección de errores y ergonomía al teclear.'],
                ['ventaja' => 'Metodología por niveles', 'detalle' => 'Avance estructurado con metas semanales y pruebas.'],
            ];
            foreach ($items as $v) {
                Ventaja::firstOrCreate([
                    'modalidad_id' => $m->id,
                    'ventaja' => $v['ventaja'],
                ], ['detalle' => $v['detalle'], 'estado' => true]);
            }
        }

        // Materiales
        $materiales = [
            ['nombre' => 'PC con teclado', 'descripcion' => 'Teclado cómodo y funcional para práctica intensiva.'],
            ['nombre' => 'Software de práctica', 'descripcion' => 'Herramientas online/desktop para medición de WPM y precisión.'],
            ['nombre' => 'Guía de ergonomía', 'descripcion' => 'Referencias de postura y cuidado de muñecas.'],
        ];
        $orden = 1;
        foreach ($materiales as $mat) {
            Material::firstOrCreate([
                'product_id' => $product->id,
                'nombre' => $mat['nombre'],
            ], [
                'descripcion' => $mat['descripcion'],
                'estado' => true,
                'orden' => $orden++,
            ]);
        }

        // Contenidos detallados
        $contenidos = [
            ['subnivel' => 'Básico', 'titulo' => 'Posición de manos y filas', 'descripcion' => 'Home row, dedos asignados, postura y ritmo inicial.', 'orden' => 1],
            ['subnivel' => 'Básico', 'titulo' => 'Filas superior e inferior', 'descripcion' => 'Secuencias graduadas para memorizar ubicaciones sin mirar.', 'orden' => 2],
            ['subnivel' => 'Intermedio', 'titulo' => 'Símbolos y números', 'descripcion' => 'Dominio de teclas especiales, números y combinaciones frecuentes.', 'orden' => 3],
            ['subnivel' => 'Intermedio', 'titulo' => 'Entrenamiento de precisión', 'descripcion' => 'Rutinas de corrección de errores y consistencia de ritmo.', 'orden' => 4],
            ['subnivel' => 'Intermedio', 'titulo' => 'Aumentar WPM', 'descripcion' => 'Drills de velocidad con textos progresivos y control de fatiga.', 'orden' => 5],
            ['subnivel' => 'Proyecto', 'titulo' => 'Evaluación y certificado', 'descripcion' => 'Prueba final con metas de WPM/precisión y entrega de reporte.', 'orden' => 6],
        ];
        foreach ($contenidos as $c) {
            $maxOrden = Contenido::where('product_id', $product->id)->max('orden') ?? 0;
            Contenido::firstOrCreate([
                'product_id' => $product->id,
                'titulo' => $c['titulo'],
            ], [
                'subnivel' => $c['subnivel'],
                'descripcion' => $c['descripcion'],
                'orden' => $maxOrden + 1,
                'estado' => true,
            ]);
        }
    }
}
