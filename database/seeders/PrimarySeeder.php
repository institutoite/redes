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

class PrimarySeeder extends Seeder
{
    public function run(): void
    {
        // Crear/obtener producto de nivel Primaria (usa estructura de products)
        $catId = \DB::table('categories')->where('description', 'Apoyo escolar primaria')->value('id') ?? 1;
        $product = Product::firstOrCreate([
            'nombre' => 'Nivel primaria',
        ], [
            'imagen' => 'apoyo_primaria.png',
            'price' => 40.00,
            'clicks' => 0,
            'categories_id' => $catId,
        ]);

  

        // Modalidades idénticas a Nivel Inicial (misma carga horaria e inversión)
        $modalidadesData = [
            [
                'modalidad' => 'Hora Libre',
                'inversion' => 50.00,
                'descripcion' => 'Ideal para evaluar el nivel y empezar de inmediato. Útil como apoyo puntual, aclarar dudas pero los avances reales se logran con continuidad semanal.',
                //'dias' => [],
            ],
            [
                'modalidad' => 'Semana 3 Veces',
                'inversion' => 200.00,
                'descripcion' => 'Ideal para reforzar contenidos. Permite trabajar una materia con constancia. Para resultados más rápidos, lo ideal es pasar a clases diarias toda la semana.',
                //'dias' => ['Lunes','Miércoles','Viernes'],
            ],
            [
                'modalidad' => 'Semana Lunes a Viernes',
                'inversion' => 260.00,
                'descripcion' => 'Refuerzo diario que evita olvidos entre clases. Ideal cuando el niño ya muestra dificultades. Para consolidar de verdad, se recomienda continuar al menos dos semanas.',
                //'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes'],
            ],
            [
                'modalidad' => '2 Semanas 3 Veces',
                'inversion' => 300.00,
                'descripcion' => 'Dos semanas de trabajo constante que empiezan a cerrar vacíos reales. Aun así, el progreso se acelera notablemente con clases de lunes a viernes.',
                //'dias' => ['Lunes','Miércoles','Viernes'],
            ],
            [
                'modalidad' => '2 Semanas Lunes a Viernes',
                'inversion' => 420.00,
                'descripcion' => 'Carga ideal para ver cambios visibles en comprensión y tareas. Permite reforzar hasta dos materias. Para bases firmes, lo más recomendado es un plan mensual.',
                //'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes'],
            ],
            [
                'modalidad' => 'Mes 3 Veces',
                'inversion' => 450.00,
                'descripcion' => 'Un mes da estabilidad y seguimiento. Se refuerza una materia con mayor profundidad. Si el objetivo es avanzar más rápido o tiene alguna urgencia, conviene pasar a lunes a viernes.',
                //'dias' => ['Lunes','Miércoles','Viernes'],
            ],
            [
                'modalidad' => 'Mes Lunes a Viernes',
                'inversion' => 650.00,
                'descripcion' => 'Plan recomendado para resultados reales. Permite trabajar tres materias, crear hábito de estudio y recuperar confianza. Para cambios duraderos, lo ideal es extender a dos meses.',
                //'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes'],
            ],
            [
                'modalidad' => '2 Meses 3 Veces',
                'inversion' => 800.00,
                'descripcion' => 'Proceso más sólido que evita retrocesos. Ideal para reforzar contenidos acumulados. Para un avance más completo y continuo, se recomienda lunes a viernes.',
                //'dias' => ['Lunes','Miércoles','Viernes'],
            ],
            [
                'modalidad' => '2 Meses Lunes a Viernes',
                'inversion' => 1150.00,
                'descripcion' => 'Refuerzo profundo y constante. Permite trabajar varias materias, mejorar notas y reducir el estrés en casa. Para bases realmente firmes, el plan de 3 meses es el más efectivo.',
                //'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes'],
            ],
            [
                'modalidad' => '3 Meses 3 Veces',
                'inversion' => 1140.00,
                'descripcion' => 'Proceso largo que ayuda a sostener avances en una hasta tres materias. Sin embargo, el mayor progreso académico se logra con acompañamiento diario.',
                //'dias' => ['Lunes','Miércoles','Viernes'],
            ],
            [
                'modalidad' => '3 Meses Lunes a Viernes',
                'inversion' => 1620.00,
                'descripcion' => 'El plan más completo y recomendado. Bases sólidas, varias materias reforzadas, hábitos de estudio y tranquilidad total para los padres. Máximos resultados.',
                //'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes'],
            ]
        ];


        $modalidades = [];
        $ordenModalidad = Modalidad::where('product_id', $product->id)->max('orden') ?? 0;
        $i = 0;
        foreach ($modalidadesData as $md) {
            $i++;
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
                'orden' => $ordenModalidad + $i,
            ]);
            $m->update(['estado' => !$esMenorQueUnMes, 'orden' => $ordenModalidad + $i]);
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

        // Ventajas por modalidad (Primaria)
        foreach ($modalidades as $m) {
            $nombre = $m->modalidad;
               // Beneficios generales para el producto 'Nivel primaria'
            $beneficios = [
                ['titulo' => 'Que no se quede atrás', 'detalle' => 'Mientras otros avanzan, un niño con vacíos sufre en silencio. Aquí lo acompañamos a tiempo.', 'priority' => 1],
                ['titulo' => 'Volver a entender', 'detalle' => 'No es que no pueda, es que nadie se lo explicó como necesitaba.', 'priority' => 2],
                ['titulo' => 'Notas que dejan de doler', 'detalle' => 'Cada avance reduce el miedo a exámenes y tareas.', 'priority' => 3],
                ['titulo' => 'Confianza que se nota en casa', 'detalle' => 'Cuando entiende, levanta la mano, pregunta y vuelve a creer en sí mismo.', 'priority' => 4],
                ['titulo' => 'Menos peleas, más tranquilidad', 'detalle' => 'Las tareas dejan de ser un momento de tensión diaria.', 'priority' => 5],
                ['titulo' => 'El tiempo pasa rápido', 'detalle' => 'Hoy es primaria, mañana será más difícil si no se refuerza ahora.', 'priority' => 6],
                ['titulo' => 'Acompañamiento real', 'detalle' => 'No está solo frente a sus dudas; hay alguien que lo guía paso a paso.', 'priority' => 7],
                ['titulo' => 'Base firme para el futuro', 'detalle' => 'Un niño que entiende hoy, sufre menos mañana.', 'priority' => 8],
                ['titulo' => 'Verlo avanzar da alivio', 'detalle' => 'Pocas cosas tranquilizan más que ver a tu hijo progresar.', 'priority' => 9],
                ['titulo' => 'Invertir en calma', 'detalle' => 'No es solo estudio, es paz mental para toda la familia.', 'priority' => 10],
            ];
            foreach ($beneficios as $b) {
                \App\Models\Beneficio::firstOrCreate([
                    'product_id' => $product->id,
                    'titulo' => $b['titulo'],
                ], [
                    'detalle' => $b['detalle'],
                    'priority' => $b['priority'],
                    'estado' => true,
                ]);
            }

            if (stripos($nombre, 'Hora Libre') !== false) {

                $items[] = ['ventaja' => 'Salva la tarea de hoy', 'detalle' => 'Ideal para dudas urgentes, tareas puntuales o un tema que se le trabó.'];
                $items[] = ['ventaja' => 'Diagnóstico rápido', 'detalle' => 'Detectamos el vacío exacto para saber qué reforzar de verdad.'];
                $items[] = ['ventaja' => 'Mejor como primer paso', 'detalle' => 'Para avances reales, lo mejor es pasar a un plan semanal con continuidad.'];

            } elseif (stripos($nombre, 'Semana') !== false) {

                if (stripos($nombre, '3 Veces') !== false) {

                    $items[] = ['ventaja' => 'Rutina sin saturar', 'detalle' => '3 días por semana para reforzar una materia con constancia.'];
                    $items[] = ['ventaja' => 'Sube rendimiento en poco tiempo', 'detalle' => 'Ayuda a mejorar tareas y evaluaciones sin improvisar en casa.'];
                    $items[] = ['ventaja' => 'Escalón inteligente', 'detalle' => 'Si está bajando notas, L-V acelera el progreso y evita retrocesos.'];

                } else {

                    $items[] = ['ventaja' => 'Avance rápido y continuo', 'detalle' => 'Todos los días: menos olvido entre clases y más seguridad en tareas.'];
                    $items[] = ['ventaja' => 'Hasta 2 materias', 'detalle' => 'Ideal para nivelar dos áreas a la vez (ej. matemática y lenguaje).'];
                    $items[] = ['ventaja' => 'Resultados más visibles', 'detalle' => 'La intensidad semanal es buena, pero en quincena se consolida de verdad.'];

                }

            } elseif (stripos($nombre, 'Quincena') !== false) {

                if (stripos($nombre, '3 Veces') !== false) {

                    $items[] = ['ventaja' => 'Empieza a cerrar vacíos', 'detalle' => 'Dos semanas con seguimiento real para mejorar comprensión.'];
                    $items[] = ['ventaja' => 'Mejor preparación de evaluaciones', 'detalle' => 'Tiempo suficiente para prácticos, tareas largas y repaso.'];
                    $items[] = ['ventaja' => 'Siguiente nivel recomendado', 'detalle' => 'En L-V el avance se duplica y se puede cubrir más de una materia.'];

                } else {

                    $items[] = ['ventaja' => 'Cambio visible en 15 días', 'detalle' => 'Clases diarias que recuperan ritmo, hábito y confianza.'];
                    $items[] = ['ventaja' => 'Hasta 2 materias sin estrés', 'detalle' => 'Refuerzo paralelo para no dejar huecos que luego se vuelven enormes.'];
                    $items[] = ['ventaja' => 'Puente al plan mensual', 'detalle' => 'Para que no vuelva a caer, el mes completo da bases firmes.'];

                }

            } elseif (stripos($nombre, 'Mes') !== false && stripos($nombre, '2 Meses') === false && stripos($nombre, '3 Meses') === false) {

                if (stripos($nombre, '3 Veces') !== false) {

                    $items[] = ['ventaja' => 'Seguimiento real', 'detalle' => 'Un mes permite corregir hábitos y reforzar una materia con calma.'];
                    $items[] = ['ventaja' => 'Mejora sostenida', 'detalle' => 'Se nota en tareas, exámenes y participación en clase.'];
                    $items[] = ['ventaja' => 'Mejor opción para acelerar', 'detalle' => 'Si quieres resultados más rápidos, L-V permite avanzar mucho más.'];

                } else {

                    $items[] = ['ventaja' => 'Plan recomendado', 'detalle' => 'La mejor combinación entre intensidad y resultados visibles.'];
                    $items[] = ['ventaja' => 'Hasta 2 materias sólidas', 'detalle' => 'Permite nivelar dos áreas con práctica diaria y seguimiento.'];
                    $items[] = ['ventaja' => 'Para que no vuelva a caer', 'detalle' => 'Dos meses aseguran bases y evitan recaídas a mitad de trimestre.'];

                }

            } elseif (stripos($nombre, '2 Meses') !== false) {

                if (stripos($nombre, '3 Veces') !== false) {

                    $items[] = ['ventaja' => 'Progreso sostenido', 'detalle' => 'Tiempo suficiente para mejorar comprensión y hábito de estudio.'];
                    $items[] = ['ventaja' => 'Hasta 2–3 materias', 'detalle' => 'Plan ideal para cubrir varias áreas sin correr.'];
                    $items[] = ['ventaja' => 'Más completo en L-V', 'detalle' => 'Si el rezago es fuerte, L-V acelera y consolida mucho más.'];

                } else {

                    $items[] = ['ventaja' => 'Recuperación profunda', 'detalle' => 'Dos meses diarios para levantar rendimiento en varias materias.'];
                    $items[] = ['ventaja' => 'Hábitos y disciplina', 'detalle' => 'Se forma rutina: tareas a tiempo, menos olvido y más seguridad.'];
                    $items[] = ['ventaja' => 'Camino a bases firmes', 'detalle' => 'En 3 meses el avance se vuelve estable y se nota todo el año.'];

                }

            } elseif (stripos($nombre, '3 Meses') !== false) {

                if (stripos($nombre, '3 Veces') !== false) {

                    $items[] = ['ventaja' => 'Acompañamiento por trimestre', 'detalle' => 'Seguimiento continuo con metas por unidad y repaso constante.'];
                    $items[] = ['ventaja' => 'Base sólida', 'detalle' => 'Corrige vacíos de fondo para que el colegio deje de costar tanto.'];
                    $items[] = ['ventaja' => 'Más avance en L-V', 'detalle' => 'Si hay rezago serio, el formato diario es el que más resultados da.'];

                } else {

                    $items[] = ['ventaja' => 'Máximos resultados', 'detalle' => 'El plan más completo: comprensión, práctica y hábito sostenido.'];
                    $items[] = ['ventaja' => 'Cobertura de varias materias', 'detalle' => 'Ideal para nivelar y avanzar en paralelo sin dejar huecos.'];
                    $items[] = ['ventaja' => 'Tranquilidad total en casa', 'detalle' => 'Menos peleas por tareas y más seguridad en el rendimiento escolar.'];

                }

            }


            foreach ($items as $v) {
                    Ventaja::firstOrCreate([
                    'modalidad_id' => $m->id,
                    'ventaja' => $v['ventaja'],
                ], [
                    'detalle' => $v['detalle'],
                    'estado' => true
                ]);
            }
        }

        // Materiales mínimos solicitados
        $materiales = [
            ['nombre' => 'Marcador acrílico', 'descripcion' => 'Para escribir en el pizarrón.'],
            ['nombre' => 'Cuaderno', 'descripcion' => 'Un espacio propio donde su hijo ordena ideas y ve su progreso.'],
            ['nombre' => 'Lápiz y borrador', 'descripcion' => 'Para equivocarse sin miedo y volver a intentar.'],
            ['nombre' => 'Colores', 'descripcion' => 'Ayudan a entender mejor y mantener la atención.'],
            ['nombre' => 'Útiles del colegio', 'descripcion' => 'Los mismos que usa en clase, para reforzar exactamente lo que ve en la escuela.'],
            ['nombre' => 'Ganas de aprender', 'descripcion' => 'Lo único que no se compra, pero aquí se despierta.']
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

        // Contenidos por niveles (1º a 6º de Primaria)
        $contenidos = [
            // 1º Primaria
            ['subnivel' => '1º Primaria', 'titulo' => 'Lectura inicial', 'descripcion' => 'Reconocimiento de letras, sílabas y palabras simples.', 'orden' => 1],
            ['subnivel' => '1º Primaria', 'titulo' => 'Escritura básica', 'descripcion' => 'Trazos, dictado corto y escritura de palabras.', 'orden' => 2],
            ['subnivel' => '1º Primaria', 'titulo' => 'Operaciones básicas', 'descripcion' => 'Suma y resta con números naturales hasta 100.', 'orden' => 3],
            ['subnivel' => '1º Primaria', 'titulo' => 'Comprensión matemática', 'descripcion' => 'Resolver problemas simples con apoyo visual.', 'orden' => 4],

            // 2º Primaria
            ['subnivel' => '2º Primaria', 'titulo' => 'Lectura comprensiva', 'descripcion' => 'Comprensión de textos cortos y respuestas orales.', 'orden' => 5],
            ['subnivel' => '2º Primaria', 'titulo' => 'Escritura y ortografía', 'descripcion' => 'Oraciones, uso correcto de mayúsculas y signos.', 'orden' => 6],
            ['subnivel' => '2º Primaria', 'titulo' => 'Suma y resta avanzada', 'descripcion' => 'Operaciones con llevadas hasta 1.000.', 'orden' => 7],
            ['subnivel' => '2º Primaria', 'titulo' => 'Problemas matemáticos', 'descripcion' => 'Planteamiento y resolución de situaciones cotidianas.', 'orden' => 8],

            // 3º Primaria
            ['subnivel' => '3º Primaria', 'titulo' => 'Comprensión lectora', 'descripcion' => 'Lectura fluida y análisis de textos breves.', 'orden' => 9],
            ['subnivel' => '3º Primaria', 'titulo' => 'Producción escrita', 'descripcion' => 'Redacción de párrafos cortos con coherencia.', 'orden' => 10],
            ['subnivel' => '3º Primaria', 'titulo' => 'Multiplicación y división', 'descripcion' => 'Tablas y divisiones exactas.', 'orden' => 11],
            ['subnivel' => '3º Primaria', 'titulo' => 'Resolución de problemas', 'descripcion' => 'Aplicación lógica de operaciones.', 'orden' => 12],

            // 4º Primaria
            ['subnivel' => '4º Primaria', 'titulo' => 'Lectura crítica', 'descripcion' => 'Identificar ideas principales y secundarias.', 'orden' => 13],
            ['subnivel' => '4º Primaria', 'titulo' => 'Ortografía y redacción', 'descripcion' => 'Textos más largos con reglas ortográficas.', 'orden' => 14],
            ['subnivel' => '4º Primaria', 'titulo' => 'Fracciones', 'descripcion' => 'Concepto, comparación y operaciones simples.', 'orden' => 15],
            ['subnivel' => '4º Primaria', 'titulo' => 'Problemas matemáticos', 'descripcion' => 'Problemas de varios pasos.', 'orden' => 16],

            // 5º Primaria
            ['subnivel' => '5º Primaria', 'titulo' => 'Comprensión avanzada', 'descripcion' => 'Análisis de textos narrativos e informativos.', 'orden' => 17],
            ['subnivel' => '5º Primaria', 'titulo' => 'Redacción estructurada', 'descripcion' => 'Inicio, desarrollo y cierre de textos.', 'orden' => 18],
            ['subnivel' => '5º Primaria', 'titulo' => 'Fracciones y decimales', 'descripcion' => 'Operaciones y equivalencias.', 'orden' => 19],
            ['subnivel' => '5º Primaria', 'titulo' => 'Problemas complejos', 'descripcion' => 'Estrategias para resolver situaciones reales.', 'orden' => 20],

            // 6º Primaria
            ['subnivel' => '6º Primaria', 'titulo' => 'Lectura analítica', 'descripcion' => 'Interpretación y opinión sobre textos.', 'orden' => 21],
            ['subnivel' => '6º Primaria', 'titulo' => 'Escritura formal', 'descripcion' => 'Cartas, resúmenes y textos argumentativos.', 'orden' => 22],
            ['subnivel' => '6º Primaria', 'titulo' => 'Operaciones combinadas', 'descripcion' => 'Cálculos con fracciones, decimales y enteros.', 'orden' => 23],
            ['subnivel' => '6º Primaria', 'titulo' => 'Preparación para secundaria', 'descripcion' => 'Refuerzo integral para el cambio de nivel.', 'orden' => 24],

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
