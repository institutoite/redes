<?php

namespace Database\Seeders;

use App\Models\Beneficio;
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

            // Inserción en la tabla pivote product_modalidad_dia deshabilitada temporalmente
            // if (!empty($md['dias'])) {
            //     $diaIds = [];
            //     foreach ($md['dias'] as $diaNombre) {
            //         $dia = Dia::firstOrCreate(['dias' => $diaNombre]);
            //         $diaIds[] = $dia->id;
            //     }
            //     $m->dias()->syncWithoutDetaching($diaIds);
            // }
        }

        // Ventajas
        foreach ($modalidades as $m) {
            $items = [
                ['titulo' => 'No es solo un juego', 'detalle' => 'Cada movimiento fortalece su lógica, paciencia y concentración.', 'priority' => 1],
                ['titulo' => 'Confianza que se nota', 'detalle' => 'Resolver el cubo le demuestra que sí puede lograr cosas difíciles.', 'priority' => 2],
                ['titulo' => 'Evita vacíos de aprendizaje', 'detalle' => 'Refuerza habilidades clave que luego impactan en matemáticas y ciencias.', 'priority' => 3],
                ['titulo' => 'Disciplina sin presión', 'detalle' => 'Aprende constancia y orden mental sin sentirse obligado.', 'priority' => 4],
                ['titulo' => 'Orgullo como padre o madre', 'detalle' => 'Verlo resolver el cubo solo es una satisfacción real.', 'priority' => 5],
                ['titulo' => 'Tiempo bien invertido', 'detalle' => 'Cada clase reemplaza el ocio improductivo por crecimiento mental.', 'priority' => 6],
                ['titulo' => 'Pensar antes de rendirse', 'detalle' => 'Aprende a intentar, equivocarse y volver a intentar.', 'priority' => 7],
                ['titulo' => 'Preparación para el colegio', 'detalle' => 'Habilidades que hoy aprende jugando, mañana las usará en clase.', 'priority' => 8],
                ['titulo' => 'Una decisión que suma', 'detalle' => 'Un curso que aporta hoy y deja huella para el futuro.', 'priority' => 9]
            ];
            foreach ($items as $v) {
                Beneficio::firstOrCreate([
                    'product_id' => $product->id,
                    'titulo' => $v['titulo'],
                ], [
                    'detalle' => $v['detalle'],
                    'estado' => true,
                    'priority' => $v['priority'],
                ]);
            }
        }

        // Materiales
        $materiales = [
            ['nombre' => 'Cubo Rubik 3x3', 'descripcion' => 'Cubo de buena calidad, suave y resistente para facilitar el aprendizaje.'],
            ['nombre' => 'Cuaderno de apoyo', 'descripcion' => 'Para anotar pasos, patrones y avances del niño.'],
            ['nombre' => 'Guía didáctica', 'descripcion' => 'Material visual y sencillo adaptado a la edad del estudiante.'],
            ['nombre' => 'Lápiz o lapicero', 'descripcion' => 'Para escribir, marcar avances y reforzar la memoria.'],
            ['nombre' => 'Cronómetro (opcional)', 'descripcion' => 'Ayuda a motivar y medir el progreso sin presión.'],
            ['nombre' => 'Mochila o estuche', 'descripcion' => 'Para cuidar y transportar el cubo y materiales.'],
            ['nombre' => 'Ganas de aprender', 'descripcion' => 'La actitud más importante para avanzar y disfrutar el proceso.']
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
            ['subnivel' => '3x3 Básico', 'titulo' => 'Conociendo el cubo', 'descripcion' => 'Partes del cubo: centros, aristas y esquinas. Cómo funciona realmente y por qué siempre tiene solución.', 'orden' => 1],

            ['subnivel' => '3x3 Básico', 'titulo' => 'Notación y giros', 'descripcion' => 'R, L, U, D, F, B; giros simples y primos. Leer movimientos sin confusión.', 'orden' => 2],

            ['subnivel' => '3x3 Básico', 'titulo' => 'La cruz blanca', 'descripcion' => 'Construcción de la cruz blanca entendiendo colores y posiciones, no memorizando.', 'orden' => 3],

            ['subnivel' => '3x3 Básico', 'titulo' => 'Esquinas blancas', 'descripcion' => 'Colocar las esquinas correctamente usando lógica y secuencias cortas.', 'orden' => 4],

            ['subnivel' => '3x3 Básico', 'titulo' => 'Segunda capa', 'descripcion' => 'Resolver la capa del medio paso a paso sin desarmar lo ya logrado.', 'orden' => 5],

            ['subnivel' => '3x3 Básico', 'titulo' => 'Cruz amarilla', 'descripcion' => 'Formar la cruz amarilla reconociendo patrones simples.', 'orden' => 6],

            ['subnivel' => '3x3 Básico', 'titulo' => 'Orientación de esquinas', 'descripcion' => 'Girar esquinas amarillas manteniendo todo en su lugar.', 'orden' => 7],

            ['subnivel' => '3x3 Básico', 'titulo' => 'Permutación final', 'descripcion' => 'Mover piezas para completar el cubo por primera vez.', 'orden' => 8],

            ['subnivel' => '3x3 Básico', 'titulo' => 'Resolver sin ayuda', 'descripcion' => 'Repetición guiada hasta lograr armar el cubo de forma autónoma.', 'orden' => 9],

            ['subnivel' => '3x3 Intermedio', 'titulo' => 'Optimizar movimientos', 'descripcion' => 'Reducir pasos innecesarios y mejorar fluidez en la resolución.', 'orden' => 10],

            ['subnivel' => '3x3 Intermedio', 'titulo' => 'Memoria de algoritmos', 'descripcion' => 'Aprender algoritmos clave usando lógica y asociaciones simples.', 'orden' => 11],

            ['subnivel' => '3x3 Intermedio', 'titulo' => 'Introducción al tiempo', 'descripcion' => 'Resolver el cubo en menos tiempo sin estrés ni presión.', 'orden' => 12],

            ['subnivel' => '3x3 Avanzado', 'titulo' => 'Eficiencia y control', 'descripcion' => 'Mejorar precisión, control de giros y planificación previa.', 'orden' => 13],

            ['subnivel' => '3x3 Avanzado', 'titulo' => 'Retos y desafíos', 'descripcion' => 'Resoluciones cronometradas, retos guiados y motivación constante.', 'orden' => 14],

            ['subnivel' => '3x3 Avanzado', 'titulo' => 'Confianza y demostración', 'descripcion' => 'Resolver el cubo frente a otros fortaleciendo seguridad y autoestima.', 'orden' => 15],


            // Pyraminx básico
            ['subnivel' => 'Pyraminx Básico', 'titulo' => 'Conociendo el Pyraminx', 'descripcion' => 'Qué es el Pyraminx, cómo gira y por qué es más sencillo de lo que parece.', 'orden' => 1],

            ['subnivel' => 'Pyraminx Básico', 'titulo' => 'Puntas y centros', 'descripcion' => 'Identificar y orientar las puntas y centros sin afectar el resto del cubo.', 'orden' => 2],

            ['subnivel' => 'Pyraminx Básico', 'titulo' => 'Notación y giros', 'descripcion' => 'Movimientos básicos: R, L, U, B y sus variaciones. Leer secuencias simples.', 'orden' => 3],

            ['subnivel' => 'Pyraminx Básico', 'titulo' => 'Primera cara', 'descripcion' => 'Construcción de una cara completa entendiendo colores y posiciones.', 'orden' => 4],

            ['subnivel' => 'Pyraminx Básico', 'titulo' => 'Última capa', 'descripcion' => 'Resolver las piezas finales sin desarmar lo ya resuelto.', 'orden' => 5],

            ['subnivel' => 'Pyraminx Básico', 'titulo' => 'Resolver sin ayuda', 'descripcion' => 'Repetición guiada hasta lograr resolver el Pyraminx de forma autónoma.', 'orden' => 6],

            ['subnivel' => 'Pyraminx Intermedio', 'titulo' => 'Reducir movimientos', 'descripcion' => 'Aprender a resolver usando menos pasos y mayor fluidez.', 'orden' => 7],

            ['subnivel' => 'Pyraminx Intermedio', 'titulo' => 'Algoritmos clave', 'descripcion' => 'Secuencias cortas para resolver la última capa con seguridad.', 'orden' => 8],

            ['subnivel' => 'Pyraminx Intermedio', 'titulo' => 'Introducción al tiempo', 'descripcion' => 'Resolver más rápido sin presión, enfocándose en precisión.', 'orden' => 9],

            ['subnivel' => 'Pyraminx Avanzado', 'titulo' => 'Control y eficiencia', 'descripcion' => 'Mejorar giros, anticipar movimientos y evitar errores comunes.', 'orden' => 10],

            ['subnivel' => 'Pyraminx Avanzado', 'titulo' => 'Retos y desafíos', 'descripcion' => 'Desafíos guiados que motivan y fortalecen la confianza.', 'orden' => 11],

            ['subnivel' => 'Pyraminx Avanzado', 'titulo' => 'Demostración final', 'descripcion' => 'Resolver el Pyraminx frente a otros reforzando seguridad y autoestima.', 'orden' => 12],


            // 2x2 básico
            ['subnivel' => '2x2 Básico', 'titulo' => 'Conociendo el cubo 2x2', 'descripcion' => 'Cómo funciona el cubo 2x2, diferencias con el 3x3 y por qué es ideal para empezar.', 'orden' => 1],
            ['subnivel' => '2x2 Básico', 'titulo' => 'Piezas y colores', 'descripcion' => 'Identificar esquinas y relaciones de color para evitar confusiones.', 'orden' => 2],
            ['subnivel' => '2x2 Básico', 'titulo' => 'Notación y giros', 'descripcion' => 'Movimientos básicos R, L, U, F y giros primos. Leer secuencias simples.', 'orden' => 3],
            ['subnivel' => '2x2 Básico', 'titulo' => 'Primera cara', 'descripcion' => 'Construir una cara completa entendiendo posiciones, no memorizando.', 'orden' => 4],
            ['subnivel' => '2x2 Básico', 'titulo' => 'Última capa', 'descripcion' => 'Resolver el cubo completando las esquinas finales paso a paso.', 'orden' => 5],
            ['subnivel' => '2x2 Básico', 'titulo' => 'Resolver sin ayuda', 'descripcion' => 'Práctica guiada hasta lograr resolver el cubo de forma autónoma.', 'orden' => 6],
            ['subnivel' => '2x2 Intermedio', 'titulo' => 'Optimizar movimientos', 'descripcion' => 'Reducir pasos innecesarios y mejorar fluidez.', 'orden' => 7],
            ['subnivel' => '2x2 Intermedio', 'titulo' => 'Algoritmos clave', 'descripcion' => 'Secuencias cortas para resolver la última capa con seguridad.', 'orden' => 8],
            ['subnivel' => '2x2 Intermedio', 'titulo' => 'Introducción al tiempo', 'descripcion' => 'Resolver más rápido sin presión ni estrés.', 'orden' => 9],
            ['subnivel' => '2x2 Avanzado', 'titulo' => 'Control y precisión', 'descripcion' => 'Mejorar exactitud de giros y planificación.', 'orden' => 10],
            ['subnivel' => '2x2 Avanzado', 'titulo' => 'Retos y desafíos', 'descripcion' => 'Desafíos guiados que fortalecen la confianza.', 'orden' => 11],
            ['subnivel' => '2x2 Avanzado', 'titulo' => 'Demostración final', 'descripcion' => 'Resolver el cubo frente a otros reforzando seguridad y autoestima.', 'orden' => 12],


            // 4x4 básico
            ['subnivel' => '4x4x4 Básico', 'titulo' => 'Conociendo el cubo 4x4x4', 'descripcion' => 'Diferencias clave con el 3x3, piezas adicionales y cómo funciona.', 'orden' => 1],
            ['subnivel' => '4x4x4 Básico', 'titulo' => 'Centros y estructura', 'descripcion' => 'Comprender centros móviles y cómo formarlos correctamente.', 'orden' => 2],
            ['subnivel' => '4x4x4 Básico', 'titulo' => 'Notación y giros', 'descripcion' => 'Movimientos de capas internas, dobles giros y lectura de algoritmos.', 'orden' => 3],
            ['subnivel' => '4x4x4 Básico', 'titulo' => 'Construcción de centros', 'descripcion' => 'Formar los seis centros sin desarmar lo ya logrado.', 'orden' => 4],
            ['subnivel' => '4x4x4 Básico', 'titulo' => 'Emparejar aristas', 'descripcion' => 'Unir aristas dobles para convertir el cubo en un 3x3 virtual.', 'orden' => 5],
            ['subnivel' => '4x4x4 Básico', 'titulo' => 'Resolver como 3x3', 'descripcion' => 'Aplicar el método 3x3 una vez reducidas las piezas.', 'orden' => 6],
            ['subnivel' => '4x4x4 Intermedio', 'titulo' => 'Paridades básicas', 'descripcion' => 'Entender por qué aparecen y cómo resolverlas sin frustración.', 'orden' => 7],
            ['subnivel' => '4x4x4 Intermedio', 'titulo' => 'Paridad OLL', 'descripcion' => 'Resolver el caso de la cruz imposible en la última capa.', 'orden' => 8],
            ['subnivel' => '4x4x4 Intermedio', 'titulo' => 'Paridad PLL', 'descripcion' => 'Corregir el intercambio final de aristas.', 'orden' => 9],
            ['subnivel' => '4x4x4 Avanzado', 'titulo' => 'Optimizar reducción', 'descripcion' => 'Reducir movimientos y mejorar fluidez en centros y aristas.', 'orden' => 10],
            ['subnivel' => '4x4x4 Avanzado', 'titulo' => 'Control y precisión', 'descripcion' => 'Mejorar exactitud de giros y anticipación de errores.', 'orden' => 11],
            ['subnivel' => '4x4x4 Avanzado', 'titulo' => 'Reto final', 'descripcion' => 'Resolver el 4x4x4 de forma autónoma y con confianza.', 'orden' => 12],

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
