<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Modalidad;
use App\Models\Ventaja;
use App\Models\Material;
use App\Models\Contenido;
use App\Models\Dias;

class Impresion3DSeeder extends Seeder
{
    public function run(): void
    {
        // Usar el producto existente 'Impresión 3D'
        $product = Product::where('nombre', 'Impresión 3D')->first();
        if (!$product) {
            $catId = \DB::table('categories')->where('description', 'COMPUTACION')->value('id')
                ?? \DB::table('categories')->where('description', 'INSTITUTOS')->value('id')
                ?? 1;
            $product = Product::firstOrCreate([
                'nombre' => 'Impresión 3D',
            ], [
                'imagen' => 'impresion_3d.jpg',
                'price' => 220.00,
                'clicks' => 0,
                'categories_id' => $catId,
            ]);
        }

        // Modalidades
        $modalidadesData = [
            ['modalidad' => 'Tres Veces por Semana', 'inversion' => 260.00, 'descripcion' => 'Fundamentos de impresión 3D FDM y práctica guiada (3x/semana).', 'dias' => ['Lunes','Miércoles','Viernes']],
            ['modalidad' => 'Lunes a Viernes', 'inversion' => 320.00, 'descripcion' => 'Entrenamiento diario: modelado básico, slicing, calibración y proyecto.', 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            ['modalidad' => 'Solo Sábados', 'inversion' => 220.00, 'descripcion' => 'Sesión extendida de laboratorio con impresión de piezas útiles.', 'dias' => ['Sábado']],
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
            // Días
            $diaIds = [];
            foreach ($md['dias'] as $diaNombre) {
                $dia = Dias::firstOrCreate(['dia' => $diaNombre]);
                $diaIds[] = $dia->id;
            }
            $m->dias()->syncWithoutDetaching($diaIds);
        }

        // Ventajas por modalidad
        foreach ($modalidades as $m) {
            foreach ([
                ['ventaja' => 'Habilidad práctica', 'detalle' => 'Diseñar, preparar y imprimir piezas útiles con seguridad.'],
                ['ventaja' => 'Mantenimiento y calibración', 'detalle' => 'Ajustes de primera capa, temperatura y flujo para calidad.'],
                ['ventaja' => 'Proyecto aplicado', 'detalle' => 'Diseño propio, documentación y mejora continua.'],
            ] as $v) {
                Ventaja::firstOrCreate(['modalidad_id' => $m->id, 'ventaja' => $v['ventaja']], ['detalle' => $v['detalle'], 'estado' => true]);
            }
        }

        // Materiales
        $materiales = [
            ['nombre' => 'Impresora 3D FDM', 'descripcion' => 'Equipo básico (ej. cama caliente, extrusor) para prácticas.'],
            ['nombre' => 'Filamentos (PLA/PETG/TPU)', 'descripcion' => 'Materiales comunes con usos y ajustes distintos.'],
            ['nombre' => 'Calibrador (caliper)', 'descripcion' => 'Medición de piezas y tolerancias.'],
            ['nombre' => 'Herramientas', 'descripcion' => 'Espátula, llaves Allen, boquillas, agujas de limpieza.'],
            ['nombre' => 'Adhesivos de cama', 'descripcion' => 'Cinta, pegamento o superficies específicas.'],
            ['nombre' => 'Software slicer', 'descripcion' => 'Cura/PrusaSlicer para preparar G-code.'],
            ['nombre' => 'Software CAD básico', 'descripcion' => 'Tinkercad/Fusion (noción) para modelado sencillo.'],
            ['nombre' => 'Guía de seguridad', 'descripcion' => 'Buenas prácticas de uso y cuidado del equipo.'],
        ];
        $ordenM = 1;
        foreach ($materiales as $mat) {
            Material::firstOrCreate([
                'product_id' => $product->id,
                'nombre' => $mat['nombre'],
            ], [
                'descripcion' => $mat['descripcion'],
                'estado' => true,
                'orden' => $ordenM++,
            ]);
        }

        // Contenidos numerados 1..13 con subtemas 1.x
        $c = [];
        $o = 1;

        // 1. Entorno y primeras pruebas
        $c[] = ['subnivel' => '1. Entorno y pruebas', 'titulo' => '1. Entorno y primeras pruebas', 'descripcion' => 'Panorama FDM y primer acercamiento a la impresión.', 'orden' => $o++];
        $c[] = ['subnivel' => '1. Entorno y pruebas', 'titulo' => '1.1 Instalación de slicer (Cura/PrusaSlicer)', 'descripcion' => 'Descarga, instalación y perfiles iniciales.', 'orden' => $o++];
        $c[] = ['subnivel' => '1. Entorno y pruebas', 'titulo' => '1.2 Partes de una impresora FDM', 'descripcion' => 'Cama, hotend, extrusor, ejes y electrónica (noción).', 'orden' => $o++];
        $c[] = ['subnivel' => '1. Entorno y pruebas', 'titulo' => '1.3 Seguridad básica', 'descripcion' => 'Temperaturas, ventilación y prevención.', 'orden' => $o++];
        $c[] = ['subnivel' => '1. Entorno y pruebas', 'titulo' => '1.4 Filamentos comunes', 'descripcion' => 'PLA, PETG, ABS/TPU: usos y cuidados.', 'orden' => $o++];
        $c[] = ['subnivel' => '1. Entorno y pruebas', 'titulo' => '1.5 Primer print (calibration cube)', 'descripcion' => 'Preparar y imprimir un cubo de calibración.', 'orden' => $o++];

        // 2. Modelos 3D básicos
        $c[] = ['subnivel' => '2. Modelos 3D', 'titulo' => '2. Modelos 3D básicos', 'descripcion' => 'Mallas, formatos (STL/OBJ) y nociones de modelado.', 'orden' => $o++];
        $c[] = ['subnivel' => '2. Modelos 3D', 'titulo' => '2.1 Tinkercad (noción)', 'descripcion' => 'Modelado simple por geometrías.', 'orden' => $o++];
        $c[] = ['subnivel' => '2. Modelos 3D', 'titulo' => '2.2 Escala y unidades', 'descripcion' => 'Milímetros, escala y ajuste a realidad.', 'orden' => $o++];
        $c[] = ['subnivel' => '2. Modelos 3D', 'titulo' => '2.3 Orientación y tolerancias', 'descripcion' => 'Pensar en orientación y holguras.', 'orden' => $o++];
        $c[] = ['subnivel' => '2. Modelos 3D', 'titulo' => '2.4 Exportar STL', 'descripcion' => 'Preparar el modelo para el slicer.', 'orden' => $o++];
        $c[] = ['subnivel' => '2. Modelos 3D', 'titulo' => '2.5 Repositorios de modelos', 'descripcion' => 'Buscar modelos (noción) y evaluar calidad.', 'orden' => $o++];

        // 3. Slicing fundamental
        $c[] = ['subnivel' => '3. Slicing', 'titulo' => '3. Slicing fundamental', 'descripcion' => 'Parámetros clave y previsualización.', 'orden' => $o++];
        $c[] = ['subnivel' => '3. Slicing', 'titulo' => '3.1 Altura de capa', 'descripcion' => 'Relación entre detalle y tiempo.', 'orden' => $o++];
        $c[] = ['subnivel' => '3. Slicing', 'titulo' => '3.2 Paredes y relleno', 'descripcion' => 'Shells y porcentajes de infill.', 'orden' => $o++];
        $c[] = ['subnivel' => '3. Slicing', 'titulo' => '3.3 Velocidad y temperatura', 'descripcion' => 'Ajustes para materiales comunes.', 'orden' => $o++];
        $c[] = ['subnivel' => '3. Slicing', 'titulo' => '3.4 Soportes', 'descripcion' => 'Cuándo y cómo generarlos.', 'orden' => $o++];
        $c[] = ['subnivel' => '3. Slicing', 'titulo' => '3.5 Previsualización', 'descripcion' => 'Revisar capas y detectar problemas.', 'orden' => $o++];

        // 4. Adhesión y nivelación
        $c[] = ['subnivel' => '4. Adhesión y nivelación', 'titulo' => '4. Adhesión y nivelación', 'descripcion' => 'Primera capa perfecta y trucos de adherencia.', 'orden' => $o++];
        $c[] = ['subnivel' => '4. Adhesión y nivelación', 'titulo' => '4.1 Nivelación de cama', 'descripcion' => 'Manual/automática y pruebas.', 'orden' => $o++];
        $c[] = ['subnivel' => '4. Adhesión y nivelación', 'titulo' => '4.2 Superficies de cama', 'descripcion' => 'Tipos y mantenimiento.', 'orden' => $o++];
        $c[] = ['subnivel' => '4. Adhesión y nivelación', 'titulo' => '4.3 Primera capa', 'descripcion' => 'Altura, extrusión y temperatura.', 'orden' => $o++];
        $c[] = ['subnivel' => '4. Adhesión y nivelación', 'titulo' => '4.4 Brim/Raft', 'descripcion' => 'Cuándo usar y cómo configurar.', 'orden' => $o++];
        $c[] = ['subnivel' => '4. Adhesión y nivelación', 'titulo' => '4.5 Retiro de piezas', 'descripcion' => 'Seguridad y limpieza del equipo.', 'orden' => $o++];

        // 5. Materiales
        $c[] = ['subnivel' => '5. Materiales', 'titulo' => '5. Materiales', 'descripcion' => 'PLA, PETG, ABS y TPU: propiedades y ajustes.', 'orden' => $o++];
        $c[] = ['subnivel' => '5. Materiales', 'titulo' => '5.1 PLA', 'descripcion' => 'Fácil uso y aplicaciones comunes.', 'orden' => $o++];
        $c[] = ['subnivel' => '5. Materiales', 'titulo' => '5.2 PETG', 'descripcion' => 'Resistencia y adherencia.', 'orden' => $o++];
        $c[] = ['subnivel' => '5. Materiales', 'titulo' => '5.3 ABS', 'descripcion' => 'Ventilación y warping (noción).', 'orden' => $o++];
        $c[] = ['subnivel' => '5. Materiales', 'titulo' => '5.4 TPU', 'descripcion' => 'Flexibilidad y velocidades bajas.', 'orden' => $o++];
        $c[] = ['subnivel' => '5. Materiales', 'titulo' => '5.5 Almacenamiento y secado', 'descripcion' => 'Evitar humedad y mejorar calidad.', 'orden' => $o++];

        // 6. Mantenimiento
        $c[] = ['subnivel' => '6. Mantenimiento', 'titulo' => '6. Mantenimiento de la impresora', 'descripcion' => 'Rutinas para asegurar impresión consistente.', 'orden' => $o++];
        $c[] = ['subnivel' => '6. Mantenimiento', 'titulo' => '6.1 Limpieza de boquilla', 'descripcion' => 'Agujas y cambios de nozzle.', 'orden' => $o++];
        $c[] = ['subnivel' => '6. Mantenimiento', 'titulo' => '6.2 Extrusor y engranajes', 'descripcion' => 'Desarme básico y cuidado.', 'orden' => $o++];
        $c[] = ['subnivel' => '6. Mantenimiento', 'titulo' => '6.3 Correas y ejes', 'descripcion' => 'Tensión y lubricación básica.', 'orden' => $o++];
        $c[] = ['subnivel' => '6. Mantenimiento', 'titulo' => '6.4 Firmware (noción)', 'descripcion' => 'Actualizaciones y precauciones.', 'orden' => $o++];
        $c[] = ['subnivel' => '6. Mantenimiento', 'titulo' => '6.5 Checklist semanal', 'descripcion' => 'Lista de verificación rápida.', 'orden' => $o++];

        // 7. Calibraciones
        $c[] = ['subnivel' => '7. Calibraciones', 'titulo' => '7. Calibraciones prácticas', 'descripcion' => 'Pruebas para ajustar parámetros.', 'orden' => $o++];
        $c[] = ['subnivel' => '7. Calibraciones', 'titulo' => '7.1 Torre de temperatura', 'descripcion' => 'Elegir temperatura óptima.', 'orden' => $o++];
        $c[] = ['subnivel' => '7. Calibraciones', 'titulo' => '7.2 Retracción', 'descripcion' => 'Evitar stringing y mejorar acabados.', 'orden' => $o++];
        $c[] = ['subnivel' => '7. Calibraciones', 'titulo' => '7.3 Flujo/Extrusión', 'descripcion' => 'Ajuste de flow rate.', 'orden' => $o++];
        $c[] = ['subnivel' => '7. Calibraciones', 'titulo' => '7.4 E-steps (noción)', 'descripcion' => 'Relación pasos-extrusión.', 'orden' => $o++];
        $c[] = ['subnivel' => '7. Calibraciones', 'titulo' => '7.5 XYZ cube', 'descripcion' => 'Revisión de dimensiones y precisión.', 'orden' => $o++];

        // 8. Resolución de problemas
        $c[] = ['subnivel' => '8. Problemas', 'titulo' => '8. Resolución de problemas comunes', 'descripcion' => 'Diagnóstico y soluciones rápidas.', 'orden' => $o++];
        $c[] = ['subnivel' => '8. Problemas', 'titulo' => '8.1 Warping', 'descripcion' => 'Causas y mitigación.', 'orden' => $o++];
        $c[] = ['subnivel' => '8. Problemas', 'titulo' => '8.2 Stringing', 'descripcion' => 'Filamentos finos entre piezas.', 'orden' => $o++];
        $c[] = ['subnivel' => '8. Problemas', 'titulo' => '8.3 Layer shift', 'descripcion' => 'Desplazamiento de capas y tensiones.', 'orden' => $o++];
        $c[] = ['subnivel' => '8. Problemas', 'titulo' => '8.4 Sub/Over extrusión', 'descripcion' => 'Falta/exceso de material.', 'orden' => $o++];
        $c[] = ['subnivel' => '8. Problemas', 'titulo' => '8.5 Superficies pobres', 'descripcion' => 'Mejorar acabados visibles.', 'orden' => $o++];

        // 9. Diseño para impresión
        $c[] = ['subnivel' => '9. Diseño', 'titulo' => '9. Diseño para impresión 3D', 'descripcion' => 'Conceptos para piezas funcionales.', 'orden' => $o++];
        $c[] = ['subnivel' => '9. Diseño', 'titulo' => '9.1 Tolerancias y holguras', 'descripcion' => 'Ajustes para encajes y movimiento.', 'orden' => $o++];
        $c[] = ['subnivel' => '9. Diseño', 'titulo' => '9.2 Orientación óptima', 'descripcion' => 'Reducir soportes y mejorar resistencia.', 'orden' => $o++];
        $c[] = ['subnivel' => '9. Diseño', 'titulo' => '9.3 Soporte-friendly', 'descripcion' => 'Diseñar pensando en el slicer.', 'orden' => $o++];
        $c[] = ['subnivel' => '9. Diseño', 'titulo' => '9.4 Parametrización (noción)', 'descripcion' => 'Modelos ajustables y reutilizables.', 'orden' => $o++];
        $c[] = ['subnivel' => '9. Diseño', 'titulo' => '9.5 Validación y iteración', 'descripcion' => 'Prototipado rápido y mejora.', 'orden' => $o++];

        // 10. Ensambles
        $c[] = ['subnivel' => '10. Ensambles', 'titulo' => '10. Ensambles y piezas múltiples', 'descripcion' => 'Juntas y fijaciones básicas.', 'orden' => $o++];
        $c[] = ['subnivel' => '10. Ensambles', 'titulo' => '10.1 Tornillos y insertos', 'descripcion' => 'Insertos roscados y tornillería.', 'orden' => $o++];
        $c[] = ['subnivel' => '10. Ensambles', 'titulo' => '10.2 Roscas impresas', 'descripcion' => 'Diseño de roscas (noción).', 'orden' => $o++];
        $c[] = ['subnivel' => '10. Ensambles', 'titulo' => '10.3 Encastres y press-fit', 'descripcion' => 'Encajes a presión y tolerancias.', 'orden' => $o++];
        $c[] = ['subnivel' => '10. Ensambles', 'titulo' => '10.4 Pegado y unión', 'descripcion' => 'Cianoacrilato y alternativas.', 'orden' => $o++];
        $c[] = ['subnivel' => '10. Ensambles', 'titulo' => '10.5 Piezas grandes en secciones', 'descripcion' => 'Dividir y unir impresiones grandes.', 'orden' => $o++];

        // 11. Técnicas avanzadas
        $c[] = ['subnivel' => '11. Técnicas avanzadas', 'titulo' => '11. Técnicas avanzadas', 'descripcion' => 'Vase mode, ironing y capas adaptativas.', 'orden' => $o++];
        $c[] = ['subnivel' => '11. Técnicas avanzadas', 'titulo' => '11.1 Vase mode', 'descripcion' => 'Pared única para objetos decorativos.', 'orden' => $o++];
        $c[] = ['subnivel' => '11. Técnicas avanzadas', 'titulo' => '11.2 Ironing', 'descripcion' => 'Suavizado de superficies superiores.', 'orden' => $o++];
        $c[] = ['subnivel' => '11. Técnicas avanzadas', 'titulo' => '11.3 Capas adaptativas', 'descripcion' => 'Detalle donde importa, ahorrar tiempo.', 'orden' => $o++];
        $c[] = ['subnivel' => '11. Técnicas avanzadas', 'titulo' => '11.4 TPU y flexibles', 'descripcion' => 'Ajustes para materiales flexibles.', 'orden' => $o++];
        $c[] = ['subnivel' => '11. Técnicas avanzadas', 'titulo' => '11.5 Pausa para multicolor', 'descripcion' => 'Insertar cambios de filamento.', 'orden' => $o++];

        // 12. Seguridad y responsabilidad
        $c[] = ['subnivel' => '12. Seguridad', 'titulo' => '12. Seguridad y responsabilidad', 'descripcion' => 'Uso seguro y responsable del equipo.', 'orden' => $o++];
        $c[] = ['subnivel' => '12. Seguridad', 'titulo' => '12.1 Ventilación y calor', 'descripcion' => 'Riesgos térmicos y ventilación adecuada.', 'orden' => $o++];
        $c[] = ['subnivel' => '12. Seguridad', 'titulo' => '12.2 Riesgo eléctrico', 'descripcion' => 'Cables, fuentes y cuidados.', 'orden' => $o++];
        $c[] = ['subnivel' => '12. Seguridad', 'titulo' => '12.3 Materiales y salud', 'descripcion' => 'Emisiones y precauciones básicas.', 'orden' => $o++];
        $c[] = ['subnivel' => '12. Seguridad', 'titulo' => '12.4 Respeto a propiedad intelectual', 'descripcion' => 'Evitar copias indebidas y reconocer autores.', 'orden' => $o++];
        $c[] = ['subnivel' => '12. Seguridad', 'titulo' => '12.5 Buenas prácticas', 'descripcion' => 'Listas y hábitos seguros.', 'orden' => $o++];

        // 13. Proyecto final
        $c[] = ['subnivel' => '13. Proyecto', 'titulo' => '13. Proyecto final', 'descripcion' => 'Diseñar, laminar e imprimir una pieza funcional.', 'orden' => $o++];
        $c[] = ['subnivel' => '13. Proyecto', 'titulo' => '13.1 Diseño propio', 'descripcion' => 'Modelar una pieza sencilla útil.', 'orden' => $o++];
        $c[] = ['subnivel' => '13. Proyecto', 'titulo' => '13.2 Slicing y preparación', 'descripcion' => 'Configurar parámetros y previsualizar.', 'orden' => $o++];
        $c[] = ['subnivel' => '13. Proyecto', 'titulo' => '13.3 Impresión', 'descripcion' => 'Ejecutar la impresión con control.', 'orden' => $o++];
        $c[] = ['subnivel' => '13. Proyecto', 'titulo' => '13.4 Post-proceso', 'descripcion' => 'Retirar soportes y acabado básico.', 'orden' => $o++];
        $c[] = ['subnivel' => '13. Proyecto', 'titulo' => '13.5 Documentación y compartir', 'descripcion' => 'Registrar parámetros y publicar resultados.', 'orden' => $o++];

        foreach ($c as $row) {
            $maxOrden = Contenido::where('product_id', $product->id)->max('orden') ?? 0;
            Contenido::firstOrCreate([
                'product_id' => $product->id,
                'titulo' => $row['titulo'],
            ], [
                'subnivel' => $row['subnivel'],
                'descripcion' => $row['descripcion'],
                'orden' => $maxOrden + 1,
                'estado' => true,
            ]);
        }
    }
}
