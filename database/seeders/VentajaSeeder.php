<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Ventaja;
use Illuminate\Database\Seeder;

class VentajaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sembramos ventajas para todas las modalidades del producto "Nivel Inicial"
        $inicial = Product::where('nombre', 'Nivel Inicial')->first();
        if (!$inicial) {
            return; // Si no existe el producto, no hacemos nada
        }

        // Ventajas por modalidad para Nivel Inicial (descripciones específicas)
        $modalidades = $inicial->modalidades()->get();
        foreach ($modalidades as $m) {
            $nombre = $m->modalidad;
            $items = [
                ['ventaja' => 'Clases personalizadas', 'detalle' => 'Adaptación al ritmo y necesidades de cada niño/a.'],
                ['ventaja' => 'Comunicación con familias', 'detalle' => 'Reporte de avances y recomendaciones por WhatsApp.'],
                ['ventaja' => 'Material didáctico', 'detalle' => 'Recursos lúdicos y fichas para aprender jugando.'],
            ];

            if (stripos($nombre, 'Hora Libre') !== false) {
                $items[] = ['ventaja' => 'Aclaración de dudas', 'detalle' => 'Resolver actividades puntuales y explicar conceptos concretos.'];
            } elseif (stripos($nombre, 'Semana') !== false) {
                if (stripos($nombre, '3 Veces') !== false) {
                    $items[] = ['ventaja' => 'Preparación de exposición', 'detalle' => 'Ideal para exámenes o presentaciones próximas.'];
                    $items[] = ['ventaja' => 'Para avance regular', 'detalle' => 'Recomendado si atiende y sigue instrucciones.'];
                } else {
                    $items[] = ['ventaja' => 'Refuerzo diario', 'detalle' => 'L-V para fortalecer áreas con mayor dificultad.'];
                    $items[] = ['ventaja' => 'Recuperación intensiva', 'detalle' => 'Si peligra el trimestre/año, tomar L-V todos los días.'];
                }
            } elseif (stripos($nombre, 'Quincena') !== false) {
                if (stripos($nombre, '3 Veces') !== false) {
                    $items[] = ['ventaja' => 'Prácticas extendidas', 'detalle' => 'Tiempo para actividades y proyectos más largos.'];
                    $items[] = ['ventaja' => 'Para base aceptable', 'detalle' => 'Adecuado si mantiene atención y ritmo.'];
                } else {
                    $items[] = ['ventaja' => 'Refuerzo sostenido', 'detalle' => 'L-V para varias áreas a la vez.'];
                    $items[] = ['ventaja' => 'Avance acelerado', 'detalle' => 'Mejora más rápida en temas rezagados.'];
                }
            } elseif (stripos($nombre, 'Mes') !== false && stripos($nombre, '2 Meses') === false && stripos($nombre, '3 Meses') === false) {
                if (stripos($nombre, '3 Veces') !== false) {
                    $items[] = ['ventaja' => 'Nivelación 1–2 áreas', 'detalle' => 'Tiempo para consolidar hasta dos materias.'];
                    $items[] = ['ventaja' => 'Para avance regular', 'detalle' => 'Ritmo adecuado si practica en casa.'];
                } else {
                    $items[] = ['ventaja' => 'Nivelación intensiva', 'detalle' => 'L-V para consolidar contenidos más rápido.'];
                    $items[] = ['ventaja' => 'Mejor si está rezagado', 'detalle' => 'Recomendado si peligra el trimestre/año.'];
                }
            } elseif (stripos($nombre, '2 Meses') !== false) {
                if (stripos($nombre, '3 Veces') !== false) {
                    $items[] = ['ventaja' => 'Hasta 3 áreas', 'detalle' => 'Plan para trabajar hasta tres materias con profundidad.'];
                    $items[] = ['ventaja' => 'Progreso sostenido', 'detalle' => 'Tiempo para hábitos y resolución de dudas.'];
                } else {
                    $items[] = ['ventaja' => 'Recuperación de varias áreas', 'detalle' => 'L-V ideal si está por reprobar múltiples áreas.'];
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
    }
}
