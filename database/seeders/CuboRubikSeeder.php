<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Modalidad;
use App\Models\Ventaja;
use App\Models\Material;
use App\Models\Contenido;
use App\Models\Dia;

class CuboRubikSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener producto 'Cubo Rubik' creado por ProductSeeder
        $product = Product::where('nombre', 'Cubo Rubik')->first();
        if (!$product) {
            // Fallback: crear si no existe
            $catId = \DB::table('categories')->where('description', 'CUBO RUBIK')->value('id') ?? 1;
            $product = Product::firstOrCreate([
                'nombre' => 'Cubo Rubik',
            ], [
                'imagen' => 'cubo_rubik.jpg',
                'price' => 250,
                'clicks' => 0,
                'categories_id' => $catId,
            ]);
        }

        // Modalidades básicas para entrenamiento (curso básico)
        $modalidadesData = [
            [
                'modalidad' => 'Entrenamiento 3 Veces por Semana',
                'inversion' => 350,
                'descripcion' => 'Curso regular: 3 veces por semana (LMV/MJS). Método principiante y fundamentos CFOP.',
                'dias' => ['Lunes','Miércoles','Viernes'],
            ],
            [
                'modalidad' => 'Entrenamiento Lunes a Viernes',
                'inversion' => 450,
                'descripcion' => 'Curso intensivo L-V: teoría + práctica guiada + tiempos.',
                'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes'],
            ],
            [
                'modalidad' => 'Entrenamiento Solo Sábados',
                'inversion' => 250,
                'descripcion' => 'Curso sesión extendida los sábados: repaso y corrección técnica.',
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

        // Ventajas
        foreach ($modalidades as $m) {
            $items = [
                ['ventaja' => 'Método CFOP progresivo', 'detalle' => 'Cross, F2L, OLL y PLL por etapas con guías.'],
                ['ventaja' => 'Entrenamiento de tiempos', 'detalle' => 'Cronometrado, promedio de 5/12, análisis de splits.'],
                ['ventaja' => 'Corrección técnica', 'detalle' => 'Finger tricks, rotaciones eficientes y planificación de soluciones.'],
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
            ['nombre' => 'Cubo 3x3', 'descripcion' => 'Cubo de buena calidad (speedcube) para práctica.'],
            ['nombre' => 'Lubricante', 'descripcion' => 'Mejora el giro y la consistencia del cubo.'],
            ['nombre' => 'Timer', 'descripcion' => 'Cronómetro (app o físico) para registrar tiempos.'],
            ['nombre' => 'Mat', 'descripcion' => 'Tapete de práctica para estabilidad y protección.'],
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

        // Contenidos del curso básico (3x3) + cubos adicionales (Pyraminx, 2x2, 4x4) con mayor detalle
        $contenidos = [
            // 3x3 básico (método principiante)
            ['subnivel' => '3x3 Básico', 'titulo' => 'Notación y giros', 'descripcion' => 'R, L, U, D, F, B; dobles/primos; rotaciones (x, y, z). Cómo leer algoritmos y evitar rotaciones innecesarias.', 'orden' => 1],
            ['subnivel' => '3x3 Básico', 'titulo' => 'Cruz y primera capa', 'descripcion' => 'Planificación de la cruz en 2-4 movimientos, seguimiento de colores; inserción de esquinas con casos tipo y control de orientación.', 'orden' => 2],
            ['subnivel' => '3x3 Básico', 'titulo' => 'Segunda capa', 'descripcion' => 'Inserción de aristas por capa: casos izquierda/derecha, detección de piezas mal orientadas y correcciones rápidas.', 'orden' => 3],
            ['subnivel' => '3x3 Básico', 'titulo' => 'Última capa (OLL/PLL básicos)', 'descripcion' => 'Orientación de última capa (OLL) con 3-4 casos del método principiante; permutación (PLL) con 2-3 algoritmos frecuentes; reconocimiento visual.', 'orden' => 4],
            ['subnivel' => '3x3 Básico', 'titulo' => 'Finger tricks esenciales', 'descripcion' => 'Técnicas de dedos (U, R, F turn), control de agarre, reducción de pausas; práctica de fluidez con conteo de TPS.', 'orden' => 5],
            ['subnivel' => '3x3 Básico', 'titulo' => 'Drills y tiempos', 'descripcion' => 'Rutinas: cruz-only, F2L lento controlado, OLL/PLL spam; registrar Ao5/Ao12, análisis de splits y mejora por sección.', 'orden' => 6],

            // Pyraminx básico
            ['subnivel' => 'Pyraminx Básico', 'titulo' => 'Notación y centros', 'descripcion' => 'Notación U/L/R/B; orientación de puntas y centros; orden óptimo de pasos para evitar deshacer avances.', 'orden' => 7],
            ['subnivel' => 'Pyraminx Básico', 'titulo' => 'Aristas y casos', 'descripcion' => 'Resolución de aristas con 1-2 algoritmos base; reconocimiento de casos por colores y orientación; consejos de tiempos.', 'orden' => 8],

            // 2x2 básico
            ['subnivel' => '2x2 Básico', 'titulo' => 'Ortega/CLL básico', 'descripcion' => 'Método Ortega: primer bloque, OLL y PLL de 2x2; introducción a CLL sencillo; reconocimiento de patrones y ejecución limpia.', 'orden' => 9],

            // 4x4 básico
            ['subnivel' => '4x4 Básico', 'titulo' => 'Centros', 'descripcion' => 'Construcción de centros por pares, control de colores opuestos, mantener simetría para facilitar el pareado.', 'orden' => 10],
            ['subnivel' => '4x4 Básico', 'titulo' => 'Emparejar aristas', 'descripcion' => 'Pareado de aristas con técnicas básicas (3-2-3); prevención de desparejos y manejo de casos especiales.', 'orden' => 11],
            ['subnivel' => '4x4 Básico', 'titulo' => 'Paridad', 'descripcion' => 'Detección de paridades (OLL/PLL) tras reducción a 3x3; algoritmos estándar y recomendaciones de ejecución.', 'orden' => 12],
            // Mantenimiento y lubricación
            ['subnivel' => 'General', 'titulo' => 'Mantenimiento del cubo', 'descripcion' => 'Ajuste de tensiones, limpieza y lubricación básica; cómo mejorar estabilidad y velocidad sin comprometer control.', 'orden' => 13],
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
