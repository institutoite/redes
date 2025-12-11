<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Modalidad;
use App\Models\Ventaja;
use App\Models\Material;
use App\Models\Contenido;
use App\Models\Dias;

class RoboticaSeeder extends Seeder
{
    public function run(): void
    {
        $product = Product::firstOrCreate([
            'nombre' => 'Robótica',
        ], [
            'imagen' => 'robotica.jpg',
            'price' => 80.00,
            'clicks' => 0,
            'categories_id' => \DB::table('categories')->where('description', 'INSTITUTOS')->value('id')
                ?? \DB::table('categories')->where('description', 'CURSOS')->value('id')
                ?? 1,
        ]);

        $modalidadesData = [
            ['modalidad' => 'Tres Veces por Semana', 'inversion' => 300.00, 'descripcion' => 'Construcción de auto básico 3x/semana: chasis, ejes, ruedas y circuito simple.', 'dias' => ['Lunes','Miércoles','Viernes']],
            ['modalidad' => 'Lunes a Viernes', 'inversion' => 360.00, 'descripcion' => 'Entrenamiento diario orientado a proyecto: ensamble y pruebas continuas.', 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            ['modalidad' => 'Solo Sábados', 'inversion' => 220.00, 'descripcion' => 'Sesión extendida para construcción, cableado y testeo del auto.', 'dias' => ['Sábado']],
        ];

        $modalidades = [];
        foreach ($modalidadesData as $md) {
            $m = Modalidad::firstOrCreate([
                'product_id' => $product->id,
                'modalidad' => $md['modalidad'],
            ], [
                'descripcion' => $md['descripcion'],
                'inversion' => $md['inversion'],
                'estado' => true,
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
                ['ventaja' => 'Pensamiento STEM', 'detalle' => 'Integración de ciencia, tecnología, ingeniería y matemáticas.'],
                ['ventaja' => 'Prototipado práctico', 'detalle' => 'Construcción, pruebas y mejora de diseños.'],
                ['ventaja' => 'Circuitos básicos', 'detalle' => 'Cableado simple con interruptor, LED + resistencia y batería 9V.'],
            ] as $v) {
                Ventaja::firstOrCreate(['modalidad_id' => $m->id, 'ventaja' => $v['ventaja']], ['detalle' => $v['detalle'], 'estado' => true]);
            }
        }

        $materiales = [
            ['nombre' => 'Chasis/base', 'descripcion' => 'Impreso en 3D o recortado en cartón resistente.'],
            ['nombre' => 'Ejes (palitos chinos)', 'descripcion' => 'Palitos chinos usados como ejes para las ruedas.'],
            ['nombre' => 'Ruedas', 'descripcion' => 'Impresas en 3D o fabricadas en cartón.'],
            ['nombre' => 'Motoreductor', 'descripcion' => 'Motor con reducción para mover el auto.'],
            ['nombre' => 'Interruptor', 'descripcion' => 'Control simple de encendido/apagado del circuito.'],
            ['nombre' => 'Batería 9V + portabaterías', 'descripcion' => 'Alimentación del circuito del auto.'],
            ['nombre' => 'LEDs + resistencias', 'descripcion' => 'Iluminación del auto con protección adecuada.'],
            ['nombre' => 'Cables y conectores', 'descripcion' => 'Para realizar el cableado entre componentes.'],
            ['nombre' => 'Herramientas básicas', 'descripcion' => 'Tijeras, pegamento, cinta, destornilladores.'],
        ];
        $orden = 1;
        foreach ($materiales as $mat) {
            Material::firstOrCreate(['product_id' => $product->id, 'nombre' => $mat['nombre']], ['descripcion' => $mat['descripcion'], 'estado' => true, 'orden' => $orden++]);
        }

        $contenidos = [
            ['subnivel' => 'Básico', 'titulo' => 'Componentes electrónicos con LEDs', 'descripcion' => 'Listado y función: LED, resistencia adecuada, batería 9V, interruptor y cables; prueba de circuito simple.', 'orden' => 1],
            ['subnivel' => 'Básico', 'titulo' => 'Seguridad y nociones de electrónica', 'descripcion' => 'Normas básicas, polaridad, corriente/tensión y uso seguro de batería 9V.', 'orden' => 2],
            ['subnivel' => 'Básico', 'titulo' => 'Chasis: 3D o cartón', 'descripcion' => 'Diseño y construcción del chasis/base impreso en 3D o recortado en cartón.', 'orden' => 3],
            ['subnivel' => 'Básico', 'titulo' => 'Ejes con palitos chinos', 'descripcion' => 'Montaje de ejes utilizando palitos chinos y fijación al chasis.', 'orden' => 4],
            ['subnivel' => 'Básico', 'titulo' => 'Ruedas 3D o cartón', 'descripcion' => 'Fabricación/impresión y equilibrado de ruedas; montaje en ejes.', 'orden' => 5],
            ['subnivel' => 'Básico', 'titulo' => 'Motoreductor: instalación', 'descripcion' => 'Ubicación y fijación del motoreductor para tracción.', 'orden' => 6],
            ['subnivel' => 'Básico', 'titulo' => 'Circuito con interruptor', 'descripcion' => 'Cableado simple: batería 9V, interruptor y motoreductor.', 'orden' => 7],
            ['subnivel' => 'Básico', 'titulo' => 'LEDs con resistencia', 'descripcion' => 'Conexión de LEDs con resistencias para iluminación segura.', 'orden' => 8],
            ['subnivel' => 'Básico', 'titulo' => 'Pruebas y ajustes', 'descripcion' => 'Testeo de rodaje, corrección de fricción y mejora de estabilidad.', 'orden' => 9],
            ['subnivel' => 'Proyecto', 'titulo' => 'Auto básico funcional', 'descripcion' => 'Entrega del auto con chasis, ejes, ruedas, motoreductor, interruptor y LEDs funcionando.', 'orden' => 10],
        ];
        foreach ($contenidos as $c) {
            Contenido::firstOrCreate(['product_id' => $product->id, 'titulo' => $c['titulo']], ['subnivel' => $c['subnivel'], 'descripcion' => $c['descripcion'], 'orden' => $c['orden'], 'estado' => true]);
        }
    }
}
