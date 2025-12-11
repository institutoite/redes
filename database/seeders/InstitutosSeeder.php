<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Modalidad;
use App\Models\Ventaja;
use App\Models\Material;
use App\Models\Contenido;
use App\Models\Dias;

class InstitutosSeeder extends Seeder
{
    public function run(): void
    {
        // Crear/obtener producto Institutos (alineado con ProductSeeder: "NIVEL INSTITUTOS")
        $product = Product::where('nombre', 'NIVEL INSTITUTOS')->first();
        if (!$product) {
            // Fallback: si no existe el producto creado por ProductSeeder, crear uno
            $catId = \DB::table('categories')->where('description', 'Institutos')->value('id') ?? 1;
            $product = Product::firstOrCreate([
                'nombre' => 'NIVEL INSTITUTOS',
            ], [
                'imagen' => 'institutos.jpg',
                'price' => 60.00,
                'clicks' => 0,
                'categories_id' => $catId,
            ]);
        }

        // Modalidades según datos provistos (L-V y 3 Veces)
        $modalidadesData = [
            // Lunes a Viernes
            ['modalidad' => 'Hora Libre', 'inversion' => 60.00, 'carga' => 1, 'por_hora' => 60.00, 'dias' => []],
            ['modalidad' => 'Semana Lunes a Viernes', 'inversion' => 312.00, 'carga' => 7.5, 'por_hora' => 42.00, 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            ['modalidad' => 'Quincena Lunes a Viernes', 'inversion' => 504.00, 'carga' => 15, 'por_hora' => 34.00, 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            ['modalidad' => 'Mes Lunes a Viernes', 'inversion' => 780.00, 'carga' => 30, 'por_hora' => 26.00, 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            ['modalidad' => '2 Meses Lunes a Viernes', 'inversion' => 1380.00, 'carga' => 60, 'por_hora' => 23.00, 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            ['modalidad' => '3 Meses Lunes a Viernes', 'inversion' => 1944.00, 'carga' => 90, 'por_hora' => 22.00, 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            // 3 veces por semana
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
                (stripos($md['modalidad'], 'Hora Libre') !== false) ? 'Flexibilidad total por hora' : 'Plan académico de refuerzo',
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

            // Asociar días
            if (!empty($md['dias'])) {
                $diaIds = [];
                foreach ($md['dias'] as $diaNombre) {
                    $dia = Dias::firstOrCreate(['dia' => $diaNombre]);
                    $diaIds[] = $dia->id;
                }
                $m->dias()->syncWithoutDetaching($diaIds);
            }
        }

        // Ventajas genéricas por modalidad
        foreach ($modalidades as $m) {
            $nombre = $m->modalidad;
            $items = [
                ['ventaja' => 'Clases personalizadas', 'detalle' => 'Atención según objetivos del instituto.'],
                ['ventaja' => 'Consultas al profesor', 'detalle' => 'Resolución de dudas y prácticos del instituto.'],
                ['ventaja' => 'Plan de estudio', 'detalle' => 'Organización por unidades y evaluaciones del programa.'],
            ];

            if (stripos($nombre, 'Hora Libre') !== false) {
                $items[] = ['ventaja' => 'Ideal para dudas puntuales', 'detalle' => 'Sesión rápida para preparar tareas o exámenes inmediatos.'];
            } elseif (stripos($nombre, 'Semana') !== false) {
                if (stripos($nombre, '3 Veces') !== false) {
                    $items[] = ['ventaja' => 'Refuerzo regular', 'detalle' => 'Buen equilibrio entre práctica y teoría cada semana.'];
                } else {
                    $items[] = ['ventaja' => 'Refuerzo intensivo L-V', 'detalle' => 'Cobertura diaria para materias con mayor carga.'];
                }
            } elseif (stripos($nombre, 'Quincena') !== false) {
                $items[] = ['ventaja' => 'Preparación evaluaciones', 'detalle' => 'Tiempo útil para parciales y trabajos extensos.'];
            } elseif (stripos($nombre, 'Mes') !== false && stripos($nombre, '2 Meses') === false && stripos($nombre, '3 Meses') === false) {
                $items[] = ['ventaja' => 'Consolidación de contenidos', 'detalle' => 'Fortalece bases y prepara evaluaciones mensuales.'];
            } elseif (stripos($nombre, '2 Meses') !== false) {
                $items[] = ['ventaja' => 'Avance sostenido', 'detalle' => 'Permite abordar varias unidades con profundidad.'];
            } elseif (stripos($nombre, '3 Meses') !== false) {
                $items[] = ['ventaja' => 'Cobertura trimestral', 'detalle' => 'Plan completo para el trimestre del instituto.'];
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
            ['nombre' => 'Cuaderno', 'descripcion' => 'Para apuntes y ejercicios del instituto.'],
            ['nombre' => 'Lápiz y borrador', 'descripcion' => 'Material de escritura básico.'],
            ['nombre' => 'Contenido del instituto', 'descripcion' => 'Temarios, guías y prácticos provistos por el instituto.'],
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

        // Contenidos genéricos
        $contenidos = [
            ['subnivel' => 'General', 'titulo' => 'Matemática aplicada', 'descripcion' => 'Álgebra y cálculo básico según programa del instituto.', 'orden' => 1],
            ['subnivel' => 'General', 'titulo' => 'Física y laboratorio', 'descripcion' => 'Cinemática, dinámica y prácticas de laboratorio.', 'orden' => 2],
            ['subnivel' => 'General', 'titulo' => 'Química general', 'descripcion' => 'Estructura de la materia y reacciones químicas.', 'orden' => 3],
        ];
        foreach ($contenidos as $c) {
            Contenido::firstOrCreate([
                'product_id' => $product->id,
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
