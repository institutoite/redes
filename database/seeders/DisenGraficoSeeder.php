<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Modalidad;
use App\Models\Ventaja;
use App\Models\Material;
use App\Models\Contenido;
use App\Models\Dias;

class DisenGraficoSeeder extends Seeder
{
    public function run(): void
    {
        $product = Product::where('nombre', 'Diseño Gráfico')->first();
        if (!$product) {
            $catId = \DB::table('categories')->where('description', 'DISEÑO GRAFICO')->value('id')
                ?? \DB::table('categories')->where('description', 'COMPUTACION')->value('id')
                ?? 1;
            $product = Product::firstOrCreate([
                'nombre' => 'Diseño Gráfico',
            ], [
                'imagen' => 'diseno-grafico.jpg',
                'price' => 70.00,
                'clicks' => 0,
                'categories_id' => $catId,
            ]);
        }

        $modalidadesData = [
            [
                'modalidad' => 'Tres Veces por Semana',
                'inversion' => 250.00,
                'descripcion' => 'Clases 3 veces por semana: edición y diseño aplicado.',
                'dias' => ['Lunes','Miércoles','Viernes'],
            ],
            [
                'modalidad' => 'Lunes a Viernes',
                'inversion' => 300.00,
                'descripcion' => 'Entrenamiento diario L-V: proyectos cortos y feedback continuo.',
                'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes'],
            ],
            [
                'modalidad' => 'Solo Sábados',
                'inversion' => 180.00,
                'descripcion' => 'Sesión extendida de práctica guiada y revisión de portafolio.',
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
                    $dia = Dias::firstOrCreate(['dia' => $diaNombre]);
                    $diaIds[] = $dia->id;
                }
                $m->dias()->syncWithoutDetaching($diaIds);
            }
        }

        foreach ($modalidades as $m) {
            $items = [
                ['ventaja' => 'Edición efectiva', 'detalle' => 'Flujo de trabajo ágil para imágenes y video.'],
                ['ventaja' => 'Branding visual', 'detalle' => 'Composición, tipografía y paletas de color aplicadas.'],
                ['ventaja' => 'Portafolio inicial', 'detalle' => 'Proyectos prácticos exportables para mostrar habilidades.'],
            ];
            foreach ($items as $v) {
                Ventaja::firstOrCreate([
                    'modalidad_id' => $m->id,
                    'ventaja' => $v['ventaja'],
                ], ['detalle' => $v['detalle'], 'estado' => true]);
            }
        }

        $materiales = [
            ['nombre' => 'PC con software', 'descripcion' => 'Photoshop, Illustrator y CapCut instalados.'],
            ['nombre' => 'Recursos de práctica', 'descripcion' => 'Pack de imágenes, íconos y clips de entrenamiento.'],
            ['nombre' => 'Cuaderno/Notas', 'descripcion' => 'Bocetos, ideas y checklist de exportación.'],
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

        $contenidos = [
            // Photoshop (desde cero a intermedio)
            ['subnivel' => 'Photoshop', 'titulo' => 'Interfaz, capas y flujo', 'descripcion' => 'Paneles, atajos, capas y máscaras; ajustes (Curves/Levels) y flujo no destructivo con objetos inteligentes.', 'orden' => 1],
            ['subnivel' => 'Photoshop', 'titulo' => 'Selección y retoque', 'descripcion' => 'Herramientas de selección (pen/quick/magic), recorte avanzado, corrección de color, limpieza de piel con técnicas básicas.', 'orden' => 2],
            ['subnivel' => 'Photoshop', 'titulo' => 'Composición y mockups', 'descripcion' => 'Blending modes, sombras y luces, montaje de elementos y aplicación en mockups realistas.', 'orden' => 3],
            ['subnivel' => 'Photoshop', 'titulo' => 'Exportación y color', 'descripcion' => 'Formatos, perfiles de color, resolución y presets de exportación para web e impresión.', 'orden' => 4],
            // Illustrator (vector y branding aplicado)
            ['subnivel' => 'Illustrator', 'titulo' => 'Vector y trazados', 'descripcion' => 'Pluma, formas, pathfinder, alineación, capas y organización de documentos.', 'orden' => 5],
            ['subnivel' => 'Illustrator', 'titulo' => 'Logo y tipografía', 'descripcion' => 'Construcción de logotipos, manejo de fuentes, kerning/tracking, jerarquía visual y uso de grids.', 'orden' => 6],
            ['subnivel' => 'Illustrator', 'titulo' => 'Paletas y exportación', 'descripcion' => 'Paletas de color, estilos gráficos, empaquetado y exportación para diferentes medios.', 'orden' => 7],
            // CapCut (edición ágil para redes)
            ['subnivel' => 'CapCut', 'titulo' => 'Timeline y cortes', 'descripcion' => 'Edición básica: cortes, transiciones, control de velocidad y sincronización musical.', 'orden' => 8],
            ['subnivel' => 'CapCut', 'titulo' => 'Texto, overlays y color', 'descripcion' => 'Títulos, subtítulos, overlays gráficos, corrección de color y efectos esenciales.', 'orden' => 9],
            ['subnivel' => 'CapCut', 'titulo' => 'Exportación y formatos', 'descripcion' => 'Resoluciones, bitrate, aspect ratios y formatos optimizados para redes sociales.', 'orden' => 10],
            // Proyecto integrador con entregables
            ['subnivel' => 'Proyecto', 'titulo' => 'Campaña multiformato', 'descripcion' => 'Poster en AI, ajuste final en PS y video corto en CapCut con lineamientos de entrega.', 'orden' => 11],
            ['subnivel' => 'Proyecto', 'titulo' => 'Checklist de entrega', 'descripcion' => 'Criterios: tamaño/formatos, color, exportación y organización de archivos para portafolio.', 'orden' => 12],
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
