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
            'modalidad' => 'HLIN001 Hora Libre',
            'inversion' => 40,
            'descripcion' => 'Flexibilidad total para resolver dudas puntuales. Reserve por hora y aproveche el tiempo al máximo.',
            'estado' => 1,
            'product_id' => 1, // Apoyo escolar Inicial
        ]);
        
        Modalidad::create([
            'modalidad' => 'HLIN002 Hora Libre 1.5',
            'inversion' => 60,
            'descripcion' => 'Sesiones cortas y enfocadas de 1.5 horas para reforzar conceptos clave de manera efectiva.',
            'estado' => 1,
            'product_id' => 1, // Apoyo escolar Inicial
        ]);
        
        Modalidad::create([
            'modalidad' => 'HLIN003 Hora Libre 2H',
            'inversion' => 75,
            'descripcion' => 'Sesiones completas de 2 horas para brindar apoyo académico intensivo y resultados visibles.',
            'estado' => 1,
            'product_id' => 1, // Apoyo escolar Inicial
        ]);
        
        Modalidad::create([
            'modalidad' => 'STVIN004 Semanal (LU-MI-VI)',
            'inversion' => 165,
            'descripcion' => 'Ideal para un refuerzo constante. Clases 3 veces por semana con carga horaria de 5 horas.',
            'estado' => 1,
            'product_id' => 1, // Apoyo escolar Inicial
        ]);
        
        Modalidad::create([
            'modalidad' => 'STVIN005 Semanal (MA-JU-SA)',
            'inversion' => 165,
            'descripcion' => 'Programa con horarios flexibles, perfecto para avanzar de forma ordenada con 5 horas semanales.',
            'estado' => 1,
            'product_id' => 1, // Apoyo escolar Inicial
        ]);
        
        Modalidad::create([
            'modalidad' => 'SLVIN006 Semanal (LU A VI)',
            'inversion' => 220,
            'descripcion' => 'Clases diarias para asegurar un progreso constante con una carga horaria total de 7.5 horas.',
            'estado' => 1,
            'product_id' => 1, // Apoyo escolar Inicial
        ]);
        
        Modalidad::create([
            'modalidad' => 'SSSIN007 Semanal Solo Sábado',
            'inversion' => 150,
            'descripcion' => 'Sesiones intensivas de lunes a sábado, brindando 9 horas de aprendizaje efectivo en la semana.',
            'estado' => 1,
            'product_id' => 1, // Apoyo escolar Inicial
        ]);
        
        Modalidad::create([
            'modalidad' => 'QTVIN008 2Semanas (LU-MI-VI) ',
            'inversion' => 265,
            'descripcion' => 'Refuerzo académico durante dos semanas consecutivas con 10 horas de carga horaria efectiva.',
            'estado' => 1,
            'product_id' => 1, // Apoyo escolar Inicial
        ]);
        
        Modalidad::create([
            'modalidad' => 'QTVIN009 2 Semanas (MA-JU-SA)',
            'inversion' => 265,
            'descripcion' => 'Refuerzo académico durante dos semanas consecutivas con 10 horas de carga horaria efectiva.',
            'estado' => 1,
            'product_id' => 1, // Apoyo escolar Inicial
        ]);
        
        Modalidad::create([
            'modalidad' => 'QLVIN010 2 Semanas (LU A VI)',
            'inversion' => 350,
            'descripcion' => 'Clases intensivas por dos semanas consecutivas, con una carga horaria total de 15 horas.',
            'estado' => 1,
            'product_id' => 1, // Apoyo escolar Inicial
        ]);
        
        Modalidad::create([
            'modalidad' => 'MTVIN011 Mensual (LU-MI-VI)',
            'inversion' => 420,
            'descripcion' => 'Apoyo educativo durante todo un mes, con clases 3 veces por semana y 20 horas de contenido.',
            'estado' => 1,
            'product_id' => 1, // Apoyo escolar Inicial
        ]);
        Modalidad::create([
            'modalidad' => 'MTVIN012 Mensual (MA-JU-SA)',
            'inversion' => 420,
            'descripcion' => 'Apoyo educativo durante todo un mes, con clases 3 veces por semana y 20 horas de contenido.',
            'estado' => 1,
            'product_id' => 1, // Apoyo escolar Inicial
        ]);
        
        Modalidad::create([
            'modalidad' => 'MLVIN013 Mensual (LU A VI)',
            'inversion' => 550,
            'descripcion' => 'Programa intensivo mensual con clases de lunes a viernes. Carga horaria de 30 horas.',
            'estado' => 1,
            'product_id' => 1, // Apoyo escolar Inicial
        ]);
        
        Modalidad::create([
            'modalidad' => 'BTVIN014 Bimestral (LU-MI-VI)',
            'inversion' => 750,
            'descripcion' => 'Acompañamiento completo durante dos meses con 40 horas de aprendizaje estructurado.',
            'estado' => 1,
            'product_id' => 1, // Apoyo escolar Inicial
        ]);
        Modalidad::create([
            'modalidad' => 'BTVIN015 Bimestral (MA-JU-SA)',
            'inversion' => 750,
            'descripcion' => 'Acompañamiento completo durante dos meses con 40 horas de aprendizaje estructurado.',
            'estado' => 1,
            'product_id' => 1, // Apoyo escolar Inicial
        ]);
        
        Modalidad::create([
            'modalidad' => 'BLVIN016 Bimestral (LU a VI)',
            'inversion' => 750,
            'descripcion' => 'Dos meses de clases diarias para garantizar el éxito escolar con 60 horas de contenido educativo.',
            'estado' => 1,
            'product_id' => 1, // Apoyo escolar Inicial
        ]);
        
        Modalidad::create([
            'modalidad' => 'TTVIN017 Trimestral (LU-MI-VI)',
            'inversion' => 1050,
            'descripcion' => 'Compromiso educativo de tres meses con 60 horas de apoyo académico a un ritmo equilibrado.',
            'estado' => 1,
            'product_id' => 1, // Apoyo escolar Inicial
        ]);

        Modalidad::create([
            'modalidad' => 'TTV018 Trimestral (MA-JU-SA)',
            'inversion' => 1050,
            'descripcion' => 'Compromiso educativo de tres meses con 60 horas de apoyo académico a un ritmo equilibrado.',
            'estado' => 1,
            'product_id' => 1, // Apoyo escolar Inicial
        ]);
        
        Modalidad::create([
            'modalidad' => 'TLV019 Trimestral (LU A VI)',
            'inversion' => 1420,
            'descripcion' => 'Programa premium de 3 meses con clases diarias y una carga horaria total de 90 horas.',
            'estado' => 1,
            'product_id' => 1, // Apoyo escolar Inicial
        ]);
        
    }
}
