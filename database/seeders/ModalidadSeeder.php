<?php

namespace Database\Seeders;

use App\Models\Modalidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

// Modalidad 1: Tres veces por semana (Lunes, Miércoles, Viernes)
Modalidad::create([
    'modalidad' => 'Tres veces por semana (Lun-Mie-Vie)',
    'inversion' => 150.00,
    'descripcion' => 'Clases tres veces por semana en bloques matutinos o vespertinos.',
    'estado' => 1,
    'product_id' => 1, // Apoyo escolar Inicial
]);

// Modalidad 2: Tres veces por semana (Mar-Jue-Sáb)
Modalidad::create([
    'modalidad' => 'Tres veces por semana (Mar-Jue-Sáb)',
    'inversion' => 150.00,
    'descripcion' => 'Clases tres veces por semana en horarios flexibles.',
    'estado' => 1,
    'product_id' => 1, // Apoyo escolar Inicial
]);

// Modalidad 3: Todos los días de lunes a viernes
Modalidad::create([
    'modalidad' => 'Lunes a Viernes',
    'inversion' => 250.00,
    'descripcion' => 'Clases todos los días laborales con opciones de horario matutino o vespertino.',
    'estado' => 1,
    'product_id' => 1, // Apoyo escolar Inicial
]);

// Modalidad 4: Plan por Hora Libre
Modalidad::create([
    'modalidad' => 'Hora Libre',
    'inversion' => 20.00,
    'descripcion' => 'Reservas por hora según disponibilidad en horarios establecidos.',
    'estado' => 1,
    'product_id' => 1, // Apoyo escolar Inicial
]);

// Modalidad 5: Plan Semanal
Modalidad::create([
    'modalidad' => 'Plan Semanal',
    'inversion' => 100.00,
    'descripcion' => 'Acceso ilimitado durante una semana completa.',
    'estado' => 1,
    'product_id' => 1, // Apoyo escolar Inicial
]);

// Modalidad 6: Plan 2 Semanas
Modalidad::create([
    'modalidad' => 'Plan 2 Semanas',
    'inversion' => 180.00,
    'descripcion' => 'Acceso durante dos semanas consecutivas.',
    'estado' => 1,
    'product_id' => 1, // Apoyo escolar Inicial
]);

// Modalidad 7: Plan Mensual
Modalidad::create([
    'modalidad' => 'Plan Mensual',
    'inversion' => 350.00,
    'descripcion' => 'Clases durante todo un mes con horarios flexibles.',
    'estado' => 1,
    'product_id' => 1, // Apoyo escolar Inicial
]);

// Modalidad 8: Plan Bimestral
Modalidad::create([
    'modalidad' => 'Plan Bimestral',
    'inversion' => 600.00,
    'descripcion' => 'Programa educativo extendido por dos meses.',
    'estado' => 1,
    'product_id' => 1, // Apoyo escolar Inicial
]);

// Modalidad 9: Plan Trimestral
Modalidad::create([
    'modalidad' => 'Plan Trimestral',
    'inversion' => 900.00,
    'descripcion' => 'Acceso durante tres meses completos.',
    'estado' => 1,
    'product_id' => 1, // Apoyo escolar Inicial
]);


        Modalidad::create([
            'modalidad' => 'Híbrido',
            'inversion' => 120.00,
            'descripcion' => 'Combina clases virtuales con sesiones presenciales opcionales.',
            'estado' => 1,
            'product_id' => 2, // Ajedrez
        ]);

        Modalidad::create([
            'modalidad' => 'Presencial',
            'inversion' => 200.00,
            'descripcion' => 'Incluye materiales y acceso a las mejores técnicas de aprendizaje.',
            'estado' => 1,
            'product_id' => 3, // Computación
        ]);

        Modalidad::create([
            'modalidad' => 'Virtual',
            'inversion' => 180.00,
            'descripcion' => 'Acceso a clases grabadas y soporte virtual.',
            'estado' => 1,
            'product_id' => 4, // Diseño gráfico
        ]);

        Modalidad::create([
            
            'modalidad' => 'Presencial',
            'inversion' => 250.00,
            'descripcion' => 'Entrenamiento personalizado con instructores expertos.',
            'estado' => 1,
            'product_id' => 5, // Dactilografía
        ]);
    }
}
