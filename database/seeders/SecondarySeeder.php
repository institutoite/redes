<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Modalidad;
use App\Models\Horario;
use App\Models\Ventaja;
use App\Models\Material;
use App\Models\Contenido;
use App\Models\Dias;

class SecondarySeeder extends Seeder
{
    public function run(): void
    {
        $catId = \DB::table('categories')->where('description', 'Apoyo escolar Secundaria')->value('id') ?? 1;
        $product = Product::firstOrCreate([
            'nombre' => 'Nivel secundaria',
        ], [
            'imagen' => 'apoyo_secundaria.png',
            'price' => 40.00,
            'clicks' => 0,
            'categories_id' => $catId,
        ]);
        // Modalidades (idénticas a Inicial)
        $modalidadesData = [
            ['modalidad' => 'Hora Libre', 'inversion' => 50.00, 'descripcion' => 'Flexibilidad total por hora. Carga horaria: 1 h (Bs 50/hora).', 'dias' => []],
            ['modalidad' => 'Semana 3 Veces', 'inversion' => 200.00, 'descripcion' => 'Clases 3 veces por semana (LMV/MJS/SÁBADOS). Carga horaria: 5 h (Bs 40/hora).', 'dias' => ['Lunes','Miércoles','Viernes']],
            ['modalidad' => 'Semana Lunes a Viernes', 'inversion' => 260.00, 'descripcion' => 'Clases diarias Lunes a Viernes. Carga horaria: 7.5 h (Bs 34.66/hora).', 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            ['modalidad' => 'Quincena 3 Veces', 'inversion' => 300.00, 'descripcion' => 'Quincena 3 veces por semana. Carga horaria: 10 h (Bs 30/hora).', 'dias' => ['Lunes','Miércoles','Viernes']],
            ['modalidad' => 'Quincena Lunes a Viernes', 'inversion' => 420.00, 'descripcion' => 'Quincena Lunes a Viernes. Carga horaria: 15 h (Bs 28/hora).', 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            ['modalidad' => 'Mes 3 Veces', 'inversion' => 450.00, 'descripcion' => 'Mes 3 veces por semana. Carga horaria: 20 h (Bs 22.5/hora).', 'dias' => ['Lunes','Miércoles','Viernes']],
            ['modalidad' => 'Mes Lunes a Viernes', 'inversion' => 650.00, 'descripcion' => 'Mes Lunes a Viernes. Carga horaria: 30 h (Bs 21.66/hora).', 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            ['modalidad' => '2 Meses 3 Veces', 'inversion' => 800.00, 'descripcion' => '2 Meses 3 veces por semana. Carga horaria: 40 h (Bs 20/hora).', 'dias' => ['Lunes','Miércoles','Viernes']],
            ['modalidad' => '2 Meses Lunes a Viernes', 'inversion' => 1150.00, 'descripcion' => '2 Meses Lunes a Viernes. Carga horaria: 60 h (Bs 19.16/hora).', 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            ['modalidad' => '3 Meses 3 Veces', 'inversion' => 1140.00, 'descripcion' => '3 Meses 3 veces por semana. Carga horaria: 60 h (Bs 19/hora).', 'dias' => ['Lunes','Miércoles','Viernes']],
            ['modalidad' => '3 Meses Lunes a Viernes', 'inversion' => 1620.00, 'descripcion' => '3 Meses Lunes a Viernes. Carga horaria: 90 h (Bs 18/hora).', 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
        ];

        $modalidades = [];
        foreach ($modalidadesData as $md) {
            $nombre = $md['modalidad'];
            $esMenorQueUnMes = (
                (
                    stripos($nombre, 'Hora Libre') !== false ||
                    stripos($nombre, 'Semana') !== false ||
                    stripos($nombre, 'Quincena') !== false
                )
                && stripos($nombre, 'Mes') === false
            );
            $m = Modalidad::firstOrCreate([
                'product_id' => $product->id,
                'modalidad' => $md['modalidad'],
            ], [
                'descripcion' => $md['descripcion'],
                'inversion' => $md['inversion'],
                'estado' => !$esMenorQueUnMes,
            ]);
            $m->update(['estado' => !$esMenorQueUnMes]);
            $modalidades[] = $m;
            if (!empty($md['dias'])) {
                $diaIds = [];
                foreach ($md['dias'] as $diaNombre) {
                    $dia = Dias::firstOrCreate(['dias' => $diaNombre]);
                    $diaIds[] = $dia->id;
                }
                $m->dias()->syncWithoutDetaching($diaIds);
            }
        }

        // Ventajas por modalidad (descripciones específicas)
        foreach ($modalidades as $m) {
            $nombre = $m->modalidad;
            $items = [
                ['ventaja' => 'Clases personalizadas', 'detalle' => 'Atención individual según necesidades académicas.'],
                ['ventaja' => 'Consultas al profesor', 'detalle' => 'Puedes consultar al profesor cuando lo necesites.'],
                ['ventaja' => 'Acceso a aplicaciones', 'detalle' => 'Tienen acceso a las apps que creamos y recomendamos.'],
            ];

            if (stripos($nombre, 'Hora Libre') !== false) {
                $items[] = ['ventaja' => 'Ideal para dudas concretas', 'detalle' => 'Resolver ejercicios puntuales o aclaraciones inmediatas.'];
            } elseif (stripos($nombre, 'Semana') !== false) {
                // Diferenciar 3 veces vs Lunes a Viernes
                if (stripos($nombre, '3 Veces') !== false) {
                    $items[] = ['ventaja' => 'Preparación de evaluación', 'detalle' => 'Buena para preparar exámenes o exposiciones próximas.'];
                    $items[] = ['ventaja' => 'Para estudiantes regulares', 'detalle' => 'Recomendado si atiende bien y sigue el ritmo.'];
                } else {
                    $items[] = ['ventaja' => 'Recuperación intensiva', 'detalle' => 'Si está por perder el trimestre/año, tomar L-V.'];
                    $items[] = ['ventaja' => 'Cobertura por materias', 'detalle' => 'L-V según cantidad de materias y temas pendientes.'];
                }
            } elseif (stripos($nombre, 'Quincena') !== false) {
                if (stripos($nombre, '3 Veces') !== false) {
                    $items[] = ['ventaja' => 'Prácticos y exposiciones', 'detalle' => 'Permite abordar prácticos y exposiciones más largas.'];
                    $items[] = ['ventaja' => 'Para estudiantes regulares', 'detalle' => 'Adecuado si tiene base aceptable.'];
                } else {
                    $items[] = ['ventaja' => 'Refuerzo sostenido', 'detalle' => 'Formato L-V para reforzar varias áreas a la vez.'];
                    $items[] = ['ventaja' => 'Recuperación acelerada', 'detalle' => 'Sugerido si el avance está muy rezagado.'];
                }
            } elseif (stripos($nombre, 'Mes') !== false && stripos($nombre, '2 Meses') === false && stripos($nombre, '3 Meses') === false) {
                if (stripos($nombre, '3 Veces') !== false) {
                    $items[] = ['ventaja' => 'Nivelación en 1–2 materias', 'detalle' => 'Tiempo suficiente para nivelar hasta dos materias.'];
                    $items[] = ['ventaja' => 'Para estudiantes regulares', 'detalle' => 'Ritmo adecuado si atiende y practica.'];
                } else {
                    $items[] = ['ventaja' => 'Nivelación intensiva', 'detalle' => 'Formato L-V para consolidar contenidos más rápido.'];
                    $items[] = ['ventaja' => 'Mejor opción si está rezagado', 'detalle' => 'Recomendado si peligra el trimestre o el año.'];
                }
            } elseif (stripos($nombre, '2 Meses') !== false) {
                if (stripos($nombre, '3 Veces') !== false) {
                    $items[] = ['ventaja' => 'Hasta 3 materias', 'detalle' => 'Plan para trabajar hasta tres materias con profundidad.'];
                    $items[] = ['ventaja' => 'Progreso sostenido', 'detalle' => 'Tiempo para hábitos y resolución de dudas.'];
                } else {
                    $items[] = ['ventaja' => 'Recuperación de varias materias', 'detalle' => 'L-V ideal si está por reprobar múltiples áreas.'];
                    $items[] = ['ventaja' => 'Avance intensivo', 'detalle' => 'Mayor carga horaria para resultados visibles.'];
                }
            } elseif (stripos($nombre, '3 Meses') !== false) {
                if (stripos($nombre, '3 Veces') !== false) {
                    $items[] = ['ventaja' => 'Plan trimestral', 'detalle' => 'Acompañamiento continuo con metas por unidad.'];
                    $items[] = ['ventaja' => 'Base sólida', 'detalle' => 'Construye fundamentos y prepara evaluaciones.'];
                } else {
                    $items[] = ['ventaja' => 'Mejor para casos críticos', 'detalle' => 'Si peligra el año, tomar L-V todos los días.'];
                    $items[] = ['ventaja' => 'Cobertura completa', 'detalle' => 'Permite abordar materias y temas extensos.'];
                }
            }

            foreach ($items as $v) {
                Ventaja::firstOrCreate([
                    'modalidad_id' => $m->id,
                    'ventaja' => $v['ventaja'],
                ], ['detalle' => $v['detalle'], 'estado' => true]);
            }
        }

        // Materiales solicitados para Secundaria
        $materiales = [
            ['nombre' => 'Marcador acrílico', 'descripcion' => 'Para escribir en el pizarrón.'],
            ['nombre' => 'Cuaderno con hojas blancas', 'descripcion' => 'Suficientes hojas blancas para ejercicios.'],
            ['nombre' => 'Lápiz', 'descripcion' => 'Grafito HB para escritura.'],
            ['nombre' => 'Borrador', 'descripcion' => 'Para corregir ejercicios.'],
            ['nombre' => 'Contenido del colegio (opcional)', 'descripcion' => 'Llevar material del colegio si lo tienen.'],
            ['nombre' => 'Tareas Prácticos Temas', 'descripcion' => 'Traer tareas o prácticos de los temas a reforzar.'],
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

        // Contenidos mínimos para Secundaria
        $contenidos = [
            ['subnivel' => 'General', 'titulo' => 'Álgebra básica', 'descripcion' => 'Expresiones, ecuaciones y factorización.', 'orden' => 1],
            ['subnivel' => 'General', 'titulo' => 'Física introductoria', 'descripcion' => 'Magnitudes, movimiento y fuerzas.', 'orden' => 2],
            ['subnivel' => 'General', 'titulo' => 'Química básica', 'descripcion' => 'Materia, mezclas y reacciones simples.', 'orden' => 3],
            ['subnivel' => 'General', 'titulo' => 'Comprensión lectora avanzada', 'descripcion' => 'Análisis de textos y argumentación.', 'orden' => 4],
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
