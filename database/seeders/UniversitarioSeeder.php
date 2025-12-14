<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Modalidad;
use App\Models\Ventaja;
use App\Models\Material;
use App\Models\Contenido;
use App\Models\Dias;

class UniversitarioSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener producto 'NIVEL UNIVERSITARIO' creado por ProductSeeder
        $product = Product::where('nombre', 'NIVEL UNIVERSITARIO')->first();
        if (!$product) {
            // Fallback si no existe
            $catId = \DB::table('categories')->where('description', 'Institutos')->value('id') ?? 1;
            $product = Product::firstOrCreate([
                'nombre' => 'NIVEL UNIVERSITARIO',
            ], [
                'imagen' => 'universitario.jpg',
                'price' => 50.00,
                'clicks' => 0,
                'categories_id' => $catId,
            ]);
        }

        // Modalidades e inversiones (idénticas a Institutos)
        $modalidadesData = [
            ['modalidad' => 'Hora Libre', 'inversion' => 60.00, 'carga' => 1, 'por_hora' => 60.00, 'dias' => []],
            ['modalidad' => 'Semana Lunes a Viernes', 'inversion' => 312.00, 'carga' => 7.5, 'por_hora' => 42.00, 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            ['modalidad' => 'Quincena Lunes a Viernes', 'inversion' => 504.00, 'carga' => 15, 'por_hora' => 34.00, 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            ['modalidad' => 'Mes Lunes a Viernes', 'inversion' => 780.00, 'carga' => 30, 'por_hora' => 26.00, 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            ['modalidad' => '2 Meses Lunes a Viernes', 'inversion' => 1380.00, 'carga' => 60, 'por_hora' => 23.00, 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            ['modalidad' => '3 Meses Lunes a Viernes', 'inversion' => 1944.00, 'carga' => 90, 'por_hora' => 22.00, 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            ['modalidad' => 'Semana 3 Veces', 'inversion' => 240.00, 'carga' => 5, 'por_hora' => 48.00, 'dias' => ['Lunes','Miércoles','Viernes']],
            ['modalidad' => 'Quincena 3 Veces', 'inversion' => 360.00, 'carga' => 10, 'por_hora' => 36.00, 'dias' => ['Lunes','Miércoles','Viernes']],
            ['modalidad' => 'Mes 3 Veces', 'inversion' => 540.00, 'carga' => 20, 'por_hora' => 27.00, 'dias' => ['Lunes','Miércoles','Viernes']],
            ['modalidad' => '2 Meses 3 Veces', 'inversion' => 960.00, 'carga' => 40, 'por_hora' => 24.00, 'dias' => ['Lunes','Miércoles','Viernes']],
            ['modalidad' => '3 Meses 3 Veces', 'inversion' => 1368.00, 'carga' => 60, 'por_hora' => 23.00, 'dias' => ['Lunes','Miércoles','Viernes']],
        ];

        $modalidades = [];
        foreach ($modalidadesData as $md) {
            $descripcion = sprintf(
                '%s. Carga horaria: %s h (Bs %.2f/hora).',
                (stripos($md['modalidad'], 'Hora Libre') !== false) ? 'Flexibilidad total por hora' : 'Plan académico universitario',
                $md['carga'],
                $md['por_hora']
            );

            $m = Modalidad::firstOrCreate([
                'product_id' => $product->id,
                'modalidad' => $md['modalidad'],
            ], [
                'descripcion' => $descripcion,
                'inversion' => $md['inversion'],
                'estado' => true,
            ]);
            $modalidades[] = $m;

            if (!empty($md['dias'])) {
                $diaIds = [];
                foreach ($md['dias'] as $diaNombre) {
                    $dia = Dias::firstOrCreate(['dia' => $diaNombre]);
                    $diaIds[] = $dia->id;
                }
                $m->dias()->syncWithoutDetaching($diaIds);
            }
        }

        foreach ($modalidades as $m) {
            $nombre = $m->modalidad;
            $items = [
                ['ventaja' => 'Clases personalizadas', 'detalle' => 'Orientadas a planes y evaluaciones universitarias.'],
                ['ventaja' => 'Consultas al profesor', 'detalle' => 'Resolución de prácticos, laboratorios y tareas.'],
                ['ventaja' => 'Plan de estudio', 'detalle' => 'Organización por unidades y calendarios de examen.'],
            ];

            if (stripos($nombre, 'Hora Libre') !== false) {
                $items[] = ['ventaja' => 'Dudas puntuales', 'detalle' => 'Sesiones ágiles para temas inmediatos.'];
            } elseif (stripos($nombre, 'Semana') !== false) {
                if (stripos($nombre, '3 Veces') !== false) {
                    $items[] = ['ventaja' => 'Refuerzo regular', 'detalle' => 'Práctica sostenida varias veces por semana.'];
                } else {
                    $items[] = ['ventaja' => 'Refuerzo intensivo L-V', 'detalle' => 'Cobertura diaria de materias exigentes.'];
                }
            } elseif (stripos($nombre, 'Quincena') !== false) {
                $items[] = ['ventaja' => 'Preparación de parciales', 'detalle' => 'Enfoque en exámenes y trabajos extensos.'];
            } elseif (stripos($nombre, 'Mes') !== false && stripos($nombre, '2 Meses') === false && stripos($nombre, '3 Meses') === false) {
                $items[] = ['ventaja' => 'Consolidación mensual', 'detalle' => 'Fortalece bases y hábitos de estudio.'];
            } elseif (stripos($nombre, '2 Meses') !== false) {
                $items[] = ['ventaja' => 'Avance sostenido', 'detalle' => 'Aborda múltiples unidades con profundidad.'];
            } elseif (stripos($nombre, '3 Meses') !== false) {
                $items[] = ['ventaja' => 'Cobertura trimestral', 'detalle' => 'Acompañamiento completo del periodo.'];
            }

            foreach ($items as $v) {
                Ventaja::firstOrCreate([
                    'modalidad_id' => $m->id,
                    'ventaja' => $v['ventaja'],
                ], ['detalle' => $v['detalle'], 'estado' => true]);
            }
        }

        // Materiales mínimos
        $materiales = [
            ['nombre' => 'Cuaderno', 'descripcion' => 'Apuntes y ejercicios universitarios.'],
            ['nombre' => 'Lápiz y borrador', 'descripcion' => 'Material básico de escritura.'],
            ['nombre' => 'Contenido universitario', 'descripcion' => 'Temarios, guías y prácticos de la carrera.'],
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

        // Contenidos genéricos (detallados)
        $contenidos = [
            [
                'subnivel' => 'General',
                'titulo' => 'Matemática universitaria',
                'descripcion' => 'Álgebra lineal (vectores, matrices, sistemas) y cálculo diferencial/integral aplicado a problemas de ingeniería y ciencias.',
                'orden' => 1,
            ],
            [
                'subnivel' => 'General',
                'titulo' => 'Física aplicada',
                'descripcion' => 'Cinemática y dinámica de partículas, trabajo y energía, leyes de Newton; prácticas de laboratorio y análisis de datos.',
                'orden' => 2,
            ],
            [
                'subnivel' => 'General',
                'titulo' => 'Química general',
                'descripcion' => 'Estructura atómica, enlace químico, estequiometría y termodinámica básica; reacciones y propiedades de la materia.',
                'orden' => 3,
            ],
            [
                'subnivel' => 'General',
                'titulo' => 'Metodología de estudio',
                'descripcion' => 'Técnicas de organización, toma de apuntes, planificación de parciales y uso de recursos bibliográficos y digitales.',
                'orden' => 4,
            ],
            [
                'subnivel' => 'General',
                'titulo' => 'Comunicación académica',
                'descripcion' => 'Redacción de informes, normas de citación, presentaciones efectivas y trabajo colaborativo con herramientas modernas.',
                'orden' => 5,
            ],
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
