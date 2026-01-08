<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Modalidad;
use App\Models\Ventaja;
use App\Models\Material;
use App\Models\Contenido;
use App\Models\Dia;

class LecturaEscrituraSeeder extends Seeder
{
    public function run(): void
    {
        $product = Product::firstOrCreate([
            'nombre' => 'Lectura y Escritura',
        ], [
            'imagen' => 'lectura_escritura.jpg',
            'price' => 55.00,
            'clicks' => 0,
            'categories_id' => \DB::table('categories')->where('description', 'INICIAL')->value('id')
                ?? \DB::table('categories')->where('description', 'INSTITUTOS')->value('id')
                ?? 1,
        ]);

        $modalidadesData = [
            ['modalidad' => 'Tres Veces por Semana', 'inversion' => 200.00, 'descripcion' => 'Sesiones 3x/semana con enfoque fonético y práctica guiada.', 'dias' => ['Lunes','Miércoles','Viernes']],
            ['modalidad' => 'Lunes a Viernes', 'inversion' => 260.00, 'descripcion' => 'Entrenamiento diario con actividades graduadas y seguimiento.', 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            ['modalidad' => 'Solo Sábados', 'inversion' => 150.00, 'descripcion' => 'Sesión extendida de refuerzo, evaluación y tareas para casa.', 'dias' => ['Sábado']],
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
                ['ventaja' => 'Conciencia fonológica', 'detalle' => 'Reconocimiento de sonidos y unión de sílabas.'],
                ['ventaja' => 'Comprensión lectora', 'detalle' => 'Estrategias para entender textos cortos y responder preguntas.'],
                ['ventaja' => 'Producción escrita', 'detalle' => 'Trazos, palabras y oraciones con corrección guiada.'],
            ] as $v) {
                Ventaja::firstOrCreate(['modalidad_id' => $m->id, 'ventaja' => $v['ventaja']], ['detalle' => $v['detalle'], 'estado' => true]);
            }
        }

        $materiales = [
            ['nombre' => 'Cuaderno de trazos', 'descripcion' => 'Guías de grafomotricidad y letras.'],
            ['nombre' => 'Tarjetas de sílabas', 'descripcion' => 'Material fonético para formar palabras.'],
            ['nombre' => 'Lecturas graduadas', 'descripcion' => 'Textos simples para niños y adultos principiantes.'],
        ];
        $orden = 1;
        foreach ($materiales as $mat) {
            Material::firstOrCreate(['product_id' => $product->id, 'nombre' => $mat['nombre']], ['descripcion' => $mat['descripcion'], 'estado' => true, 'orden' => $orden++]);
        }

        $contenidos = [
            // Niños 5-7 años
            ['subnivel' => 'Niños', 'titulo' => 'Grafomotricidad y trazos', 'descripcion' => 'Líneas, curvas y trazos base para letras; postura y agarre del lápiz.', 'orden' => 1],
            ['subnivel' => 'Niños', 'titulo' => 'Conciencia fonológica', 'descripcion' => 'Sonidos iniciales/finales, rimas y segmentación de sílabas.', 'orden' => 2],
            ['subnivel' => 'Niños', 'titulo' => 'Sílabas y palabras', 'descripcion' => 'Unión de sílabas para formar palabras; lectura en voz alta guiada.', 'orden' => 3],
            ['subnivel' => 'Niños', 'titulo' => 'Oraciones simples', 'descripcion' => 'Construcción de oraciones cortas con sujeto/verbo/objeto.', 'orden' => 4],
            ['subnivel' => 'Niños', 'titulo' => 'Comprensión de textos', 'descripcion' => 'Lecturas cortas con preguntas de comprensión y vocabulario.', 'orden' => 5],
            // Adultos principiantes
            ['subnivel' => 'Adultos', 'titulo' => 'Reconocimiento de letras', 'descripcion' => 'Asociación letra-sonido y lectura de sílabas frecuentes.', 'orden' => 6],
            ['subnivel' => 'Adultos', 'titulo' => 'Lectura funcional', 'descripcion' => 'Lectura de carteles, formularios y instrucciones básicas.', 'orden' => 7],
            ['subnivel' => 'Adultos', 'titulo' => 'Escritura práctica', 'descripcion' => 'Firma, datos personales y redacción de oraciones útiles.', 'orden' => 8],
            ['subnivel' => 'Adultos', 'titulo' => 'Comprensión y vocabulario', 'descripcion' => 'Textos cortos con actividades de comprensión y ampliación de vocabulario.', 'orden' => 9],
            // Proyecto
            ['subnivel' => 'Proyecto', 'titulo' => 'Evaluación y seguimiento', 'descripcion' => 'Pruebas de lectura y escritura con plan de refuerzo personalizado.', 'orden' => 10],
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
