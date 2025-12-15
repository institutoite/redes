<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Modalidad;
use App\Models\Ventaja;
use App\Models\Material;
use App\Models\Contenido;
use App\Models\Dia;

class AjedrezSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener producto 'Ajedrez' creado por ProductSeeder
        $product = Product::where('nombre', 'Ajedrez')->first();
        if (!$product) {
            // Fallback: crear si no existe
            $catId = \DB::table('categories')->where('description', 'AJEDREZ')->value('id') ?? 1;
            $product = Product::firstOrCreate([
                'nombre' => 'Ajedrez',
            ], [
                'imagen' => 'ajedrez.jpg',
                'price' => 250,
                'clicks' => 0,
                'categories_id' => $catId,
            ]);
        }

        // Modalidades del curso de Ajedrez
        $modalidadesData = [
            [
                'modalidad' => 'Tres Veces por Semana',
                'inversion' => 350.00,
                'descripcion' => 'Clases 3 veces por semana (LMV/MJS). Fundamentos, táctica y práctica guiada.',
                'dias' => ['Lunes','Miércoles','Viernes'],
            ],
            [
                'modalidad' => 'Lunes a Viernes',
                'inversion' => 450.00,
                'descripcion' => 'Entrenamiento diario L-V: teoría, ejercicios y partidas comentadas.',
                'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes'],
            ],
            [
                'modalidad' => 'Solo Sábados',
                'inversion' => 250.00,
                'descripcion' => 'Sesión extendida los sábados: revisión semanal y torneos internos.',
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

        // Ventajas del curso de Ajedrez
        foreach ($modalidades as $m) {
            $items = [
                ['ventaja' => 'Pensamiento crítico', 'detalle' => 'Evaluación de posiciones y toma de decisiones.'],
                ['ventaja' => 'Cálculo y visualización', 'detalle' => 'Análisis de variantes y tácticas.'],
                ['ventaja' => 'Planificación estratégica', 'detalle' => 'Comprender planes a corto y largo plazo.'],
            ];
            foreach ($items as $v) {
                Ventaja::firstOrCreate([
                    'modalidad_id' => $m->id,
                    'ventaja' => $v['ventaja'],
                ], ['detalle' => $v['detalle'], 'estado' => true]);
            }
        }

        // Materiales necesarios
        $materiales = [
            ['nombre' => 'Tablero y piezas', 'descripcion' => 'Juego estándar para práctica presencial.'],
            ['nombre' => 'Reloj de ajedrez', 'descripcion' => 'Control de tiempo y ritmo de juego.'],
            ['nombre' => 'Cuaderno', 'descripcion' => 'Registro de partidas, posiciones y tareas.'],
            ['nombre' => 'Acceso a plataformas online', 'descripcion' => 'Lichess/Chess.com para ejercicios y partidas.'],
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

        // Contenidos del curso (básico a intermedio) con mayor detalle
        $contenidos = [
            // Fundamentos y reglas
            ['subnivel' => 'Básico', 'titulo' => 'Reglas y notación', 'descripcion' => 'Movimiento de piezas, valor relativo, enroque, captura al paso, tablas; notación algebraica y registro de partidas.', 'orden' => 1],
            ['subnivel' => 'Básico', 'titulo' => 'Mate en 1 y patrones', 'descripcion' => 'Patrones de mate: fila 8, pasillo, back rank, mate del pastor y del loco; ejercicios progresivos.', 'orden' => 2],
            // Aperturas y principios
            ['subnivel' => 'Básico', 'titulo' => 'Principios de apertura', 'descripcion' => 'Desarrollo rápido, control del centro, seguridad del rey, coordinación y tiempos; errores comunes a evitar.', 'orden' => 3],
            ['subnivel' => 'Intermedio', 'titulo' => 'Sistemas de apertura', 'descripcion' => 'Conceptos por sistemas: Italiano/Española, Siciliana (ideas), Francesa, Caro-Kann; planes típicos sin memorización de líneas.', 'orden' => 4],
            // Táctica y cálculo
            ['subnivel' => 'Básico', 'titulo' => 'Táctica esencial', 'descripcion' => 'Clavadas, dobles, descubiertas, jaques intermedios, rayos X; motivos tácticos y trampas frecuentes.', 'orden' => 5],
            ['subnivel' => 'Intermedio', 'titulo' => 'Cálculo de variantes', 'descripcion' => 'Método de candidatos, árboles de variantes, visualización; ejercicios de cálculo con incremento de dificultad.', 'orden' => 6],
            // Estrategia y planes
            ['subnivel' => 'Intermedio', 'titulo' => 'Estrategia y estructuras', 'descripcion' => 'Estructuras de peones (aislado, colgantes, mayorías), piezas buenas/malas, casillas débiles, cambios favorables.', 'orden' => 7],
            ['subnivel' => 'Intermedio', 'titulo' => 'Transiciones y planes', 'descripcion' => 'Cuándo simplificar, transición a finales, creación de planes y mejoras de la peor pieza.', 'orden' => 8],
            // Finales
            ['subnivel' => 'Intermedio', 'titulo' => 'Finales fundamentales I', 'descripcion' => 'Rey y peón vs rey, oposición, triangulación, regla del cuadrado.', 'orden' => 9],
            ['subnivel' => 'Intermedio', 'titulo' => 'Finales fundamentales II', 'descripcion' => 'Finales de torres básicos, cortes del rey, técnica de jaques laterales; finales menores típicos.', 'orden' => 10],
            // Práctica y competición
            ['subnivel' => 'Intermedio', 'titulo' => 'Uso del reloj y ritmos', 'descripcion' => 'Clásico, rápido y blitz; manejo del tiempo, pre-move responsable, protocolo y fair play.', 'orden' => 11],
            ['subnivel' => 'Intermedio', 'titulo' => 'Análisis post-partida', 'descripcion' => 'Revisión con notas, detección de errores (blunders), extracción de lecciones y planes de mejora.', 'orden' => 12],
            // Cultura ajedrecística
            ['subnivel' => 'Intermedio', 'titulo' => 'Partidas clásicas comentadas', 'descripcion' => 'Estudio guiado de partidas modelo (Morphy, Capablanca, Tal, Kasparov) para reforzar conceptos.', 'orden' => 13],
            // Entrenamiento estructurado
            ['subnivel' => 'Intermedio', 'titulo' => 'Plan semanal de estudio', 'descripcion' => 'Rutina sugerida: táctica diaria, estrategia 2x/semana, finales 1x/semana, partidas y análisis.', 'orden' => 14],
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
