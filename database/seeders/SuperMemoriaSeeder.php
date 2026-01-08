<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Modalidad;
use App\Models\Ventaja;
use App\Models\Material;
use App\Models\Contenido;
use App\Models\Dia;

class SuperMemoriaSeeder extends Seeder
{
    public function run(): void
    {
        // Usar el producto existente 'Super Memoria' (ProductSeeder) o crearlo si no existe
        $product = Product::where('nombre', 'Super Memoria')->first();
        if (!$product) {
            $product = Product::firstOrCreate([
                'nombre' => 'Super Memoria',
            ], [
                'imagen' => 'super_memoria.jpg',
                'price' => 110.00,
                'clicks' => 0,
                'categories_id' => \DB::table('categories')->where('description', 'INSTITUTOS')->value('id')
                    ?? \DB::table('categories')->where('description', 'CURSOS')->value('id')
                    ?? 1,
            ]);
        }

        $modalidadesData = [
            ['modalidad' => 'Tres Veces por Semana', 'inversion' => 240.00, 'descripcion' => 'Entrenamiento 3x/semana en técnicas de memoria y estudio.', 'dias' => ['Lunes','Miércoles','Viernes']],
            ['modalidad' => 'Lunes a Viernes', 'inversion' => 300.00, 'descripcion' => 'Rutina diaria con práctica guiada y seguimiento.', 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            ['modalidad' => 'Solo Sábados', 'inversion' => 180.00, 'descripcion' => 'Sesiones extendidas de práctica y simulación de exposición.', 'dias' => ['Sábado']],
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
            // $diaIds = [];
            // foreach ($md['dias'] as $diaNombre) {
            //     $dia = Dia::firstOrCreate(['dias' => $diaNombre]);
            //     $diaIds[] = $dia->id;
            // }
            // $m->dias()->syncWithoutDetaching($diaIds);
        }

        foreach ($modalidades as $m) {
            foreach ([
                ['ventaja' => 'Memoria eficiente', 'detalle' => 'Aplicación de mnemotecnia y repasos espaciados.'],
                ['ventaja' => 'Método de estudio', 'detalle' => 'Estrategias activas (PQ4R, Feynman) y planificación.'],
                ['ventaja' => 'Exposición segura', 'detalle' => 'Estructura clara, control del tiempo y manejo del nervio.'],
            ] as $v) {
                Ventaja::firstOrCreate(['modalidad_id' => $m->id, 'ventaja' => $v['ventaja']], ['detalle' => $v['detalle'], 'estado' => true]);
            }
        }

        $materiales = [
            ['nombre' => 'Cuaderno de estudio', 'descripcion' => 'Mapas mentales, resúmenes y planificación semanal.'],
            ['nombre' => 'Tarjetas (flashcards)', 'descripcion' => 'Sistema de repasos espaciados (Anki o papel).'],
            ['nombre' => 'Rúbrica de exposición', 'descripcion' => 'Checklist de apertura, cuerpo, cierre y Q&A.'],
        ];
        $orden = 1;
        foreach ($materiales as $mat) {
            Material::firstOrCreate(['product_id' => $product->id, 'nombre' => $mat['nombre']], ['descripcion' => $mat['descripcion'], 'estado' => true, 'orden' => $orden++]);
        }

        $contenidos = [
            // 1. Fundamentos de un cerebro más rápido
            ['subnivel' => 'Fundamentos', 'titulo' => 'Cómo funciona la memoria', 'descripcion' => 'Codificación, almacenamiento y recuperación; tipos de memoria y errores comunes.', 'orden' => 1],
            ['subnivel' => 'Fundamentos', 'titulo' => 'Hábitos que fortalecen el cerebro', 'descripcion' => 'Rutinas de estudio, descanso y foco; evitar multitarea y distractores.', 'orden' => 2],
            ['subnivel' => 'Fundamentos', 'titulo' => 'Enfoque, energía, memoria, aprendizaje', 'descripcion' => 'Cuatro pilares mentales y cómo entrenarlos de forma práctica.', 'orden' => 3],

            // 2. Mentalidad y creencias
            ['subnivel' => 'Mentalidad', 'titulo' => 'Reemplazar creencias limitantes', 'descripcion' => 'Reencuadre y pruebas de realidad para “no soy bueno aprendiendo”.', 'orden' => 4],
            ['subnivel' => 'Mentalidad', 'titulo' => 'Mentalidad de crecimiento', 'descripcion' => 'Error como feedback, esfuerzo deliberado y práctica distribuida.', 'orden' => 5],
            ['subnivel' => 'Mentalidad', 'titulo' => 'Rutinas mentales diarias', 'descripcion' => 'Priming matutino: intención, foco y planificación breve.', 'orden' => 6],

            // 3. Técnicas de concentración y enfoque
            ['subnivel' => 'Enfoque', 'titulo' => 'Atención sostenida', 'descripcion' => 'Entrenamiento de foco, intervalos y recuperación de atención.', 'orden' => 7],
            ['subnivel' => 'Enfoque', 'titulo' => 'Evitar distracciones', 'descripcion' => 'Protocolos anti-distracciones, higiene digital y control de notificaciones.', 'orden' => 8],
            ['subnivel' => 'Enfoque', 'titulo' => 'Entorno óptimo para estudiar', 'descripcion' => 'Iluminación, postura, temperatura, ruido y organización del espacio.', 'orden' => 9],

            // 4. Lectura rápida (Speed Reading)
            ['subnivel' => 'Lectura', 'titulo' => 'Corregir hábitos de lectura lentos', 'descripcion' => 'Subvocalización, regresiones y fijaciones; prácticas para reducirlas.', 'orden' => 10],
            ['subnivel' => 'Lectura', 'titulo' => 'Expansión del campo visual', 'descripcion' => 'Ejercicios de amplitud de visión y bloques de lectura.', 'orden' => 11],
            ['subnivel' => 'Lectura', 'titulo' => 'Velocidad con comprensión', 'descripcion' => 'Incrementar WPM sin perder comprensión; técnicas y límites seguros.', 'orden' => 12],
            ['subnivel' => 'Lectura', 'titulo' => 'Estrategias de retención', 'descripcion' => 'Prelectura, objetivos, preguntas guía y revisión activa.', 'orden' => 13],

            // 5. Memoria acelerada
            ['subnivel' => 'Memoria', 'titulo' => 'Palacio de la memoria', 'descripcion' => 'Crear loci, rutas y anclajes visuales para listas y conceptos.', 'orden' => 14],
            ['subnivel' => 'Memoria', 'titulo' => 'Asociación creativa y encadenamiento', 'descripcion' => 'Historias mentales y pegs para números, nombres y secuencias.', 'orden' => 15],
            ['subnivel' => 'Memoria', 'titulo' => 'Aplicaciones prácticas', 'descripcion' => 'Memorizar números, nombres y vocabulario con ejercicios guiados.', 'orden' => 16],

            // 6. Aprendizaje acelerado
            ['subnivel' => 'Aprendizaje', 'titulo' => 'Aprender más rápido', 'descripcion' => 'Aprendizaje activo y práctica deliberada; ciclos de feedback.', 'orden' => 17],
            ['subnivel' => 'Aprendizaje', 'titulo' => 'Repetición espaciada', 'descripcion' => 'Diseño de intervalos y tarjetas; recordatorio activo.', 'orden' => 18],
            ['subnivel' => 'Aprendizaje', 'titulo' => 'Mapas mentales', 'descripcion' => 'Estructurar y sintetizar información con mapas efectivos.', 'orden' => 19],

            // 7. Energía mental y salud del cerebro
            ['subnivel' => 'Energía', 'titulo' => 'Sueño y descanso', 'descripcion' => 'Rutinas de sueño, siestas estratégicas y recuperación.', 'orden' => 20],
            ['subnivel' => 'Energía', 'titulo' => 'Movimiento y oxigenación', 'descripcion' => 'Ejercicios breves para foco y memoria; pausas activas.', 'orden' => 21],
            ['subnivel' => 'Energía', 'titulo' => 'Nutrición para el cerebro', 'descripcion' => 'Principios generales de alimentación que favorecen el desempeño cognitivo.', 'orden' => 22],

            // 8. Productividad inteligente
            ['subnivel' => 'Productividad', 'titulo' => 'Organizar el tiempo', 'descripcion' => 'Bloques, Pomodoro, planificación semanal y metas claras.', 'orden' => 23],
            ['subnivel' => 'Productividad', 'titulo' => 'Reducir la sobrecarga', 'descripcion' => 'Captura, clarificación y listas; evitar el overwhelm.', 'orden' => 24],
            ['subnivel' => 'Productividad', 'titulo' => 'Trabajo con claridad', 'descripcion' => 'Definir resultados, siguientes acciones y revisión periódica.', 'orden' => 25],

            // 9. Aplicación práctica diaria
            ['subnivel' => 'Aplicación', 'titulo' => 'Rutina de estudio', 'descripcion' => 'Secuencia diaria: lectura, prácticas, repasos y síntesis.', 'orden' => 26],
            ['subnivel' => 'Aplicación', 'titulo' => 'Rutina de trabajo', 'descripcion' => 'Enfoque por bloques, control de interrupciones y checklist.', 'orden' => 27],
            ['subnivel' => 'Aplicación', 'titulo' => 'Memorizar y retener más', 'descripcion' => 'Protocolos para memorizar información importante y mantenerla.', 'orden' => 28],
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
