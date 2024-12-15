<?php

namespace Database\Seeders;

use App\Models\Ventaja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VentajaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ventaja::create([
            'ventaja' => 'Accesible',
            'detalle' => 'Horarios flexibles para todos',
            'estado' => true,
            'modalidad_id' => 1, // Presencial - Cubo Rubik
        ]);

        Ventaja::create([
            'ventaja' => 'Práctico',
            'detalle' => 'Materiales incluidos en la inscripción',
            'estado' => true,
            'modalidad_id' => 1, // Presencial - Cubo Rubik
        ]);

        Ventaja::create([
            'ventaja' => 'Dinámico',
            'detalle' => 'Clases interactivas con ejercicios',
            'estado' => true,
            'modalidad_id' => 2, // Virtual - Cubo Rubik
        ]);

        Ventaja::create([
            'ventaja' => 'Económico',
            'detalle' => 'Precios ajustados al mercado',
            'estado' => true,
            'modalidad_id' => 3, // Híbrido - Ajedrez
        ]);

        Ventaja::create([
            'ventaja' => 'Exclusivo',
            'detalle' => 'Acceso a contenido premium',
            'estado' => true,
            'modalidad_id' => 4, // Presencial - Computación
        ]);

        Ventaja::create([
            'ventaja' => 'Certificado',
            'detalle' => 'Certificado avalado por ITE',
            'estado' => true,
            'modalidad_id' => 4, // Presencial - Computación
        ]);

        Ventaja::create([
            'ventaja' => 'Rápido',
            'detalle' => 'Métodos eficaces para aprender',
            'estado' => true,
            'modalidad_id' => 5, // Virtual - Diseño gráfico
        ]);

        Ventaja::create([
            'ventaja' => 'Soporte',
            'detalle' => 'Asistencia técnica durante el curso',
            'estado' => true,
            'modalidad_id' => 5, // Virtual - Diseño gráfico
        ]);
    }
}
