<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Modalidad;
use App\Models\Ventaja;
use App\Models\Material;
use App\Models\Contenido;
use App\Models\Dias;

class OratoriaSeeder extends Seeder
{
    public function run(): void
    {
        $product = Product::firstOrCreate([
            'nombre' => 'Oratoria',
        ], [
            'imagen' => 'oratoria.jpg',
            'price' => 65.00,
            'clicks' => 0,
            'categories_id' => \DB::table('categories')->where('description', 'INSTITUTOS')->value('id')
                ?? \DB::table('categories')->where('description', 'CURSOS')->value('id')
                ?? 1,
        ]);

        $modalidadesData = [
            ['modalidad' => 'Tres Veces por Semana', 'inversion' => 220.00, 'descripcion' => 'Práctica de voz, cuerpo y estructura 3x/semana.', 'dias' => ['Lunes','Miércoles','Viernes']],
            ['modalidad' => 'Lunes a Viernes', 'inversion' => 280.00, 'descripcion' => 'Entrenamiento diario con presentaciones y feedback continuo.', 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            ['modalidad' => 'Solo Sábados', 'inversion' => 170.00, 'descripcion' => 'Sesión extendida con preparación de discursos y performance.', 'dias' => ['Sábado']],
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
            $diaIds = [];
            foreach ($md['dias'] as $diaNombre) {
                $dia = Dias::firstOrCreate(['dia' => $diaNombre]);
                $diaIds[] = $dia->id;
            }
            $m->dias()->syncWithoutDetaching($diaIds);
        }

        foreach ($modalidades as $m) {
            foreach ([
                ['ventaja' => 'Confianza al hablar', 'detalle' => 'Respiración, proyección de voz y manejo del nervio.'],
                ['ventaja' => 'Estructura clara', 'detalle' => 'Introducción, cuerpo y cierre con storytelling.'],
                ['ventaja' => 'Presentación efectiva', 'detalle' => 'Uso de apoyos visuales y lenguaje corporal convincente.'],
            ] as $v) {
                Ventaja::firstOrCreate(['modalidad_id' => $m->id, 'ventaja' => $v['ventaja']], ['detalle' => $v['detalle'], 'estado' => true]);
            }
        }

        $materiales = [
            ['nombre' => 'Cuaderno', 'descripcion' => 'Guiones, ideas y estructura de presentaciones.'],
            ['nombre' => 'Apoyos visuales', 'descripcion' => 'Slides o láminas para prácticas y evaluaciones.'],
            ['nombre' => 'Micrófono (opcional)', 'descripcion' => 'Práctica de proyección con micrófono.'],
        ];
        $orden = 1;
        foreach ($materiales as $mat) {
            Material::firstOrCreate(['product_id' => $product->id, 'nombre' => $mat['nombre']], ['descripcion' => $mat['descripcion'], 'estado' => true, 'orden' => $orden++]);
        }

        $contenidos = [
            ['subnivel' => 'Básico', 'titulo' => 'Respiración y voz', 'descripcion' => 'Técnicas de respiración, proyección y articulación.', 'orden' => 1],
            ['subnivel' => 'Básico', 'titulo' => 'Lenguaje corporal', 'descripcion' => 'Postura, gestos, contacto visual y desplazamiento.', 'orden' => 2],
            ['subnivel' => 'Intermedio', 'titulo' => 'Estructura del discurso', 'descripcion' => 'Introducción, cuerpo, cierre; storytelling y ejemplos.', 'orden' => 3],
            ['subnivel' => 'Intermedio', 'titulo' => 'Apoyos visuales', 'descripcion' => 'Diseño de diapositivas claras y efectivas.', 'orden' => 4],
            ['subnivel' => 'Intermedio', 'titulo' => 'Control del tiempo y Q&A', 'descripcion' => 'Cronometrar, manejar preguntas y objeciones.', 'orden' => 5],
            ['subnivel' => 'Proyecto', 'titulo' => 'Presentación final', 'descripcion' => 'Discurso preparado y evaluado con criterios de impacto.', 'orden' => 6],
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
