<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Modalidad;
use App\Models\Ventaja;
use App\Models\Material;
use App\Models\Contenido;
use App\Models\Dias;

class ComputacionSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener producto 'Computación' creado por ProductSeeder
        $product = Product::where('nombre', 'Computación')->first();
        if (!$product) {
            // Fallback: crear si no existe
            $catId = \DB::table('categories')->where('description', 'COMPUTACION')->value('id') ?? 1;
            $product = Product::firstOrCreate([
                'nombre' => 'Computación',
            ], [
                'imagen' => 'computacion.jpg',
                'price' => 200,
                'clicks' => 0,
                'categories_id' => $catId,
            ]);
        }

        // Modalidades del curso (duración 5 meses)
        $modalidadesData = [
            [
                'modalidad' => 'Tres Veces por Semana',
                'inversion' => 200.00, // por materia
                'descripcion' => 'Duración: 10 meses. Clases 3 veces por semana (LMV/MJS). Inversión por materia: Bs 200.',
                'dias' => ['Lunes','Miércoles','Viernes'],
            ],
            [
                'modalidad' => 'Lunes a Viernes',
                'inversion' => 200.00, // por materia
                'descripcion' => 'Duración: 5 meses. Clases de lunes a viernes. Inversión por materia: Bs 200.',
                'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes'],
            ],
            [
                'modalidad' => 'Solo Sábados',
                'inversion' => 200.00, // por materia
                'descripcion' => 'Duración: 10 meses. Clases sólo los sábados. Inversión por materia: Bs 200.',
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

        // Ventajas del curso
        foreach ($modalidades as $m) {
            $items = [
                ['ventaja' => 'Aprendizaje práctico', 'detalle' => 'Enfoque en proyectos y ejercicios reales.'],
                ['ventaja' => 'Plan por módulos', 'detalle' => 'Organización por temas: ofimática, diseño, programación.'],
                ['ventaja' => 'Material digital', 'detalle' => 'Guías y recursos para práctica en casa.'],
            ];
            foreach ($items as $v) {
                Ventaja::firstOrCreate([
                    'modalidad_id' => $m->id,
                    'ventaja' => $v['ventaja'],
                ], ['detalle' => $v['detalle'], 'estado' => true]);
            }
        }

        // Materiales mínimos
        $materiales = [
            ['nombre' => 'Cuaderno', 'descripcion' => 'Apuntes y ejercicios de computación.'],
            ['nombre' => 'Memoria USB', 'descripcion' => 'Guardar trabajos y proyectos.'],
            ['nombre' => 'Acceso a PC', 'descripcion' => 'Equipo para prácticas durante y fuera de clase.'],
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

        // Contenidos del curso (materias)
        $contenidos = [
            // Materias exactas solicitadas, con descripciones detalladas
            ['subnivel' => 'Materias', 'titulo' => 'Windows', 'descripcion' => 'Desde cero: encender/apagar la PC, uso de teclado y mouse, escritorio y barra de tareas, explorador de archivos, creación/organización de carpetas y configuraciones básicas.', 'orden' => 1],
            ['subnivel' => 'Materias', 'titulo' => 'Word', 'descripcion' => 'Formato de texto y párrafo, estilos profesionales, tablas e imágenes, encabezados/pies, índices y referencias, y exportación a PDF.', 'orden' => 2],
            ['subnivel' => 'Materias', 'titulo' => 'Excel', 'descripcion' => 'Fundamentos de hoja de cálculo, fórmulas/funciones (SUMA, SI, PROMEDIO), tablas y filtros, gráficos básicos y validación de datos.', 'orden' => 3],
            ['subnivel' => 'Materias', 'titulo' => 'Power Point', 'descripcion' => 'Diseño de diapositivas desde plantillas, principios de presentación, animaciones y transiciones, inserción de multimedia y técnicas para exponer.', 'orden' => 4],
            ['subnivel' => 'Materias', 'titulo' => 'Publisher', 'descripcion' => 'Maquetación de folletos y trípticos, composición visual y tipografía, preparación de archivos para exportación e impresión.', 'orden' => 5],
            ['subnivel' => 'Materias', 'titulo' => 'Internet', 'descripcion' => 'Navegación segura, búsquedas eficaces, correo electrónico, almacenamiento en la nube y trabajo colaborativo con herramientas web.', 'orden' => 6],
            ['subnivel' => 'Materias', 'titulo' => 'Dactilografia', 'descripcion' => 'Mecanografía desde cero: postura y técnica, colocación de dedos, ejercicios guiados para precisión y velocidad.', 'orden' => 7],
            ['subnivel' => 'Materias', 'titulo' => 'Office Avanzado', 'descripcion' => 'Funciones avanzadas en Word/Excel/PowerPoint: plantillas, correspondencia, funciones anidadas y automatización básica.', 'orden' => 8],
            ['subnivel' => 'Materias', 'titulo' => 'Utilidades Ofimaticas', 'descripcion' => 'Herramientas complementarias: creación/edición de PDF, compresión y conversión de archivos, capturas de pantalla y productividad.', 'orden' => 9],
            // Materia final ajustada a conveniencia del curso
            ['subnivel' => 'Materias', 'titulo' => 'Seguridad Informatica Basica', 'descripcion' => 'Buenas prácticas: contraseñas seguras, antivirus y actualizaciones, copias de seguridad, phishing y privacidad en línea.', 'orden' => 10],
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
