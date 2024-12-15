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
        Modalidad::create([
            'modalidad' => 'Presencial',
            'inversion' => 150.00,
            'descripcion' => 'Clases en nuestras instalaciones con todo el equipo necesario.',
            'estado' => 1,
            'product_id' => 1, // Cubo Rubik
        ]);

        Modalidad::create([
            'modalidad' => 'Virtual',
            'inversion' => 100.00,
            'descripcion' => 'Clases a través de nuestra plataforma virtual.',
            'estado' => 1,
            'product_id' => 1, // Cubo Rubik
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
