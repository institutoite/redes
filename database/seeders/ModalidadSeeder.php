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
            'modalidad' => 'TTVIN018 Trimestral (MA-JU-SA)',
            'inversion' => 1050,
            'descripcion' => 'Compromiso educativo de tres meses con 60 horas de apoyo académico a un ritmo equilibrado.',
            'estado' => 1,
            'product_id' => 1, // Apoyo escolar Inicial
        ]);
        
        Modalidad::create([
            'modalidad' => 'TLVIN019 Trimestral (LU A VI)',
            'inversion' => 1420,
            'descripcion' => 'Programa premium de 3 meses con clases diarias y una carga horaria total de 90 horas.',
            'estado' => 1,
            'product_id' => 1, // Apoyo escolar Inicial
        ]);
        /*%%%%%%%%%%%%%%%%%%%%% primaria %%%%%%%%%%%%%%%%%%%%%%%%*/
        /* %%%%%%%%%%%%%% PRIMARIA %%%%%%%%%%%%%%%%%%*/
        Modalidad::create([
            'modalidad' => 'HLVPR020 HORA LIBRE',
            'inversion' => 40,
            'descripcion' => 'Flexibilidad total para resolver dudas puntuales. Reserve por hora y aproveche el tiempo al máximo.',
            'estado' => 1,
            'product_id' => 2, // Apoyo escolar Primaria
        ]);

        Modalidad::create([
            'modalidad' => 'HLVPR021 HORA LIBRE 1.5H',
            'inversion' => 60,
            'descripcion' => 'Sesiones cortas y enfocadas de 1.5 horas para reforzar conceptos clave de manera efectiva.',
            'estado' => 1,
            'product_id' => 2, // Apoyo escolar Primaria
        ]);

        Modalidad::create([
            'modalidad' => 'HLVPR022 HORA LIBRE 2H',
            'inversion' => 75,
            'descripcion' => 'Sesiones completas de 2 horas para brindar apoyo académico intensivo y resultados visibles.',
            'estado' => 1,
            'product_id' => 2, // Apoyo escolar Primaria
        ]);

        Modalidad::create([
            'modalidad' => 'STVPR023 SEMANA (LU-MI-VI)',
            'inversion' => 165,
            'descripcion' => 'Ideal para un refuerzo constante. Clases 3 veces por semana con carga horaria de 5 horas.',
            'estado' => 1,
            'product_id' => 2, // Apoyo escolar Primaria
        ]);

        Modalidad::create([
            'modalidad' => 'STVPR024 SEMANA (MA-JU-SA)',
            'inversion' => 165,
            'descripcion' => 'Programa con horarios flexibles, perfecto para avanzar de forma ordenada con 5 horas semanales.',
            'estado' => 1,
            'product_id' => 2, // Apoyo escolar Primaria
        ]);

        Modalidad::create([
            'modalidad' => 'SLVPR025 SEMANA (LU A VI)',
            'inversion' => 220,
            'descripcion' => 'Clases diarias para asegurar un progreso constante con una carga horaria total de 7.5 horas.',
            'estado' => 1,
            'product_id' => 2, // Apoyo escolar Primaria
        ]);

        Modalidad::create([
            'modalidad' => 'SLSPR026 SEMANAL (LUN A SAB)',
            'inversion' => 150,
            'descripcion' => 'Sesiones intensivas de lunes a sábado, brindando 9 horas de aprendizaje efectivo en la semana.',
            'estado' => 1,
            'product_id' => 2, // Apoyo escolar Primaria
        ]);

        Modalidad::create([
            'modalidad' => 'QTVPR027 QUINCENA (LU-MI-VI)',
            'inversion' => 265,
            'descripcion' => 'Refuerzo académico durante dos semanas consecutivas con 10 horas de carga horaria efectiva.',
            'estado' => 1,
            'product_id' => 2, // Apoyo escolar Primaria
        ]);

        Modalidad::create([
            'modalidad' => 'QTVPR028 QUINCENA (MA-JU-SA)',
            'inversion' => 265,
            'descripcion' => 'Refuerzo académico durante dos semanas consecutivas con 10 horas de carga horaria efectiva.',
            'estado' => 1,
            'product_id' => 2, // Apoyo escolar Primaria
        ]);

        Modalidad::create([
            'modalidad' => 'QLVPR029 QUINCENA (LUN A VIE)',
            'inversion' => 350,
            'descripcion' => 'Clases intensivas por dos semanas consecutivas, con una carga horaria total de 15 horas.',
            'estado' => 1,
            'product_id' => 2, // Apoyo escolar Primaria
        ]);

        Modalidad::create([
            'modalidad' => 'MTVPR030 MES (LU-MI-VI)',
            'inversion' => 420,
            'descripcion' => 'Apoyo educativo durante todo un mes, con clases 3 veces por semana y 20 horas de contenido.',
            'estado' => 1,
            'product_id' => 2, // Apoyo escolar Primaria
        ]);

        Modalidad::create([
            'modalidad' => 'MTVPR031 MES (MA-JU-SA)',
            'inversion' => 420,
            'descripcion' => 'Apoyo educativo durante todo un mes, con clases 3 veces por semana y 20 horas de contenido.',
            'estado' => 1,
            'product_id' => 2, // Apoyo escolar Primaria
        ]);

        Modalidad::create([
            'modalidad' => 'MLVPR032 MES (LU A VI)',
            'inversion' => 550,
            'descripcion' => 'Programa intensivo mensual con clases de lunes a viernes. Carga horaria de 30 horas.',
            'estado' => 1,
            'product_id' => 2, // Apoyo escolar Primaria
        ]);

        Modalidad::create([ 
            'modalidad' => 'BTVPR033 BIMESTRAL (LU-MI-VI)',
            'inversion' => 750,
            'descripcion' => 'Acompañamiento completo durante dos meses con 40 horas de aprendizaje estructurado.',
            'estado' => 1,
            'product_id' => 2, // Apoyo escolar Primaria
        ]);

        Modalidad::create([
            'modalidad' => 'BTVPR034 BIMESTRAL (MA-JU-SA',
            'inversion' => 750,
            'descripcion' => 'Acompañamiento completo durante dos meses con 40 horas de aprendizaje estructurado.',
            'estado' => 1,
            'product_id' => 2, // Apoyo escolar Primaria
        ]);

        Modalidad::create([
            'modalidad' => 'BLVPR035 BIMESTRAL (LU A VI)',
            'inversion' => 750,
            'descripcion' => 'Dos meses de clases diarias para garantizar el éxito escolar con 60 horas de contenido educativo.',
            'estado' => 1,
            'product_id' => 2, // Apoyo escolar Primaria
        ]);

        Modalidad::create([
            'modalidad' => 'TTVPR036 TRIMESTRAL (LU-MI-VI)',
            'inversion' => 1050,
            'descripcion' => 'Compromiso educativo de tres meses con 60 horas de apoyo académico a un ritmo equilibrado.',
            'estado' => 1,
            'product_id' => 2, // Apoyo escolar Primaria
        ]);

        Modalidad::create([
            'modalidad' => 'TTVPR037 TRIMESTRAL (MA-JU-SA)',
            'inversion' => 1050,
            'descripcion' => 'Compromiso educativo de tres meses con 60 horas de apoyo académico a un ritmo equilibrado.',
            'estado' => 1,
            'product_id' => 2, // Apoyo escolar Primaria
        ]);

        Modalidad::create([
            'modalidad' => 'TLVPR038 TRIMESTRAL (LUN A VIE)',
            'inversion' => 1420,
            'descripcion' => 'Programa premium de 3 meses con clases diarias y una carga horaria total de 90 horas.',
            'estado' => 1,
            'product_id' => 2, // Apoyo escolar Primaria
        ]);

        /*%%%%%%%%%%%%%%%%%% SECUNDARIA %%%%%%%%%%%%%%%%%%%%%%%%%*/

        Modalidad::create([
            'modalidad' => 'HLVSE039 Hora Libre',
            'inversion' => 42,
            'descripcion' => 'Sesiones individuales por hora para resolver dudas específicas y avanzar rápidamente.',
            'estado' => 1,
            'product_id' => 3, // Apoyo escolar Secundaria
        ]);

        Modalidad::create([
            'modalidad' => 'HLVSE040 Hora Libre 1.5',
            'inversion' => 65,
            'descripcion' => 'Clases rápidas de 1.5 horas para abordar temas clave de forma eficiente.',
            'estado' => 1,
            'product_id' => 3, // Apoyo escolar Secundaria
        ]);

        Modalidad::create([
            'modalidad' => 'HLVSE041 Hora Libre 2H',
            'inversion' => 80,
            'descripcion' => 'Sesiones completas de 2 horas para un aprendizaje intensivo y efectivo.',
            'estado' => 1,
            'product_id' => 3, // Apoyo escolar Secundaria
        ]);

        Modalidad::create([
            'modalidad' => 'STVSE042 Semanal (LU-MI-VI)',
            'inversion' => 175,
            'descripcion' => 'Clases 3 veces por semana para reforzar conocimientos de manera constante.',
            'estado' => 1,
            'product_id' => 3, // Apoyo escolar Secundaria
        ]);

        Modalidad::create([
            'modalidad' => 'STVSE043 Semanal (MA-JU-SA)',
            'inversion' => 175,
            'descripcion' => 'Programa semanal flexible con clases 3 veces por semana.',
            'estado' => 1,
            'product_id' => 3, // Apoyo escolar Secundaria
        ]);

        Modalidad::create([
            'modalidad' => 'SLVSE044 Semanal (LU A VI)',
            'inversion' => 230,
            'descripcion' => 'Clases diarias de lunes a viernes para garantizar un progreso constante.',
            'estado' => 1,
            'product_id' => 3, // Apoyo escolar Secundaria
        ]);

        Modalidad::create([
            'modalidad' => 'SSVSE045 Semanal Solo Sábado',
            'inversion' => 160,
            'descripcion' => 'Sesiones intensivas los sábados para maximizar el aprendizaje en un solo día.',
            'estado' => 1,
            'product_id' => 3, // Apoyo escolar Secundaria
        ]);

        Modalidad::create([
            'modalidad' => 'QTVSE046 2 Semanas (LU-MI-VI)',
            'inversion' => 280,
            'descripcion' => 'Refuerzo intensivo durante dos semanas con clases 3 veces por semana.',
            'estado' => 1,
            'product_id' => 3, // Apoyo escolar Secundaria
        ]);

        Modalidad::create([
            'modalidad' => 'QTVSE047 2 Semanas (MA-JU-SA)',
            'inversion' => 280,
            'descripcion' => 'Clases estructuradas durante dos semanas para fortalecer conocimientos.',
            'estado' => 1,
            'product_id' => 3, // Apoyo escolar Secundaria
        ]);

        Modalidad::create([
            'modalidad' => 'QLVSE048 2 Semanas (LU A VI)',
            'inversion' => 370,
            'descripcion' => 'Clases intensivas de lunes a viernes durante dos semanas consecutivas.',
            'estado' => 1,
            'product_id' => 3, // Apoyo escolar Secundaria
        ]);

        Modalidad::create([
            'modalidad' => 'MTVSE049 Mensual (LU-MI-VI)',
            'inversion' => 440,
            'descripcion' => 'Programa mensual con clases 3 veces por semana para un avance continuo.',
            'estado' => 1,
            'product_id' => 3, // Apoyo escolar Secundaria
        ]);

        Modalidad::create([
            'modalidad' => 'MTVSE050 Mensual (MA-JU-SA)',
            'inversion' => 440,
            'descripcion' => 'Clases 3 veces por semana durante un mes para consolidar aprendizajes.',
            'estado' => 1,
            'product_id' => 3, // Apoyo escolar Secundaria
        ]);

        Modalidad::create([
            'modalidad' => 'MLVSE051 Mensual (LU A VI)',
            'inversion' => 580,
            'descripcion' => 'Clases diarias durante todo un mes para un progreso académico sólido.',
            'estado' => 1,
            'product_id' => 3, // Apoyo escolar Secundaria
        ]);

        Modalidad::create([
            'modalidad' => 'BTVSE052 Bimestral (LU-MI-VI)',
            'inversion' => 770,
            'descripcion' => 'Acompañamiento académico durante dos meses con clases 3 veces por semana.',
            'estado' => 1,
            'product_id' => 3, // Apoyo escolar Secundaria
        ]);

        Modalidad::create([
            'modalidad' => 'BTVSE053 Bimestral (MA-JU-SA)',
            'inversion' => 770,
            'descripcion' => 'Clases bimestrales estructuradas con horarios flexibles.',
            'estado' => 1,
            'product_id' => 3, // Apoyo escolar Secundaria
        ]);

        Modalidad::create([
            'modalidad' => 'BLVSE054 Bimestral (LU A VI)',
            'inversion' => 800,
            'descripcion' => 'Clases diarias durante dos meses para garantizar resultados exitosos.',
            'estado' => 1,
            'product_id' => 3, // Apoyo escolar Secundaria
        ]);

        Modalidad::create([
            'modalidad' => 'TTVSE055 Trimestral (LU-MI-VI)',
            'inversion' => 1100,
            'descripcion' => 'Programa trimestral con clases 3 veces por semana para un avance equilibrado.',
            'estado' => 1,
            'product_id' => 3, // Apoyo escolar Secundaria
        ]);

        Modalidad::create([
            'modalidad' => 'TTVSE056 Trimestral (MA-JU-SA)',
            'inversion' => 1100,
            'descripcion' => 'Compromiso educativo de tres meses con clases estructuradas.',
            'estado' => 1,
            'product_id' => 3, // Apoyo escolar Secundaria
        ]);

        Modalidad::create([
            'modalidad' => 'TLVSE057 Trimestral (LU A VI)',
            'inversion' => 1500,
            'descripcion' => 'Clases diarias durante tres meses para maximizar el rendimiento académico.',
            'estado' => 1,
            'product_id' => 3, // Apoyo escolar Secundaria
        ]);

        /* %%%%%%%%%%%%%%%%%%%  P R E U N I V E R S I T A R I O %%%%%%%%%%%%%%%%%%% */
        Modalidad::create([
            'modalidad' => 'HLVPR058 Hora Libre',
            'inversion' => 45, // Aumento del 12.5% sobre 40
            'descripcion' => 'Flexibilidad total para resolver dudas puntuales. Reserve por hora y aproveche el tiempo al máximo.',
            'estado' => 1,
            'product_id' => 4, // Apoyo escolar Preuniversitario
        ]);
        
        Modalidad::create([
            'modalidad' => 'HLVPR059 Hora Libre 1.5',
            'inversion' => 67, // Aumento del 12% sobre 60
            'descripcion' => 'Sesiones cortas y enfocadas de 1.5 horas para reforzar conceptos clave de manera efectiva.',
            'estado' => 1,
            'product_id' => 4, // Apoyo escolar Preuniversitario
        ]);
        
        Modalidad::create([
            'modalidad' => 'HLVPR060 Hora Libre 2H',
            'inversion' => 80, // Aumento del 11.5% sobre 75
            'descripcion' => 'Sesiones completas de 2 horas para brindar apoyo académico intensivo y resultados visibles.',
            'estado' => 1,
            'product_id' => 4, // Apoyo escolar Preuniversitario
        ]);
        
        Modalidad::create([
            'modalidad' => 'STVPR061 Semanal (LU-MI-VI)',
            'inversion' => 172, // Aumento del 11% sobre 165
            'descripcion' => 'Ideal para un refuerzo constante. Clases 3 veces por semana con carga horaria de 5 horas.',
            'estado' => 1,
            'product_id' => 4, // Apoyo escolar Preuniversitario
        ]);
        
        Modalidad::create([
            'modalidad' => 'STVPR062 Semanal (MA-JU-SA)',
            'inversion' => 172, // Aumento del 10.5% sobre 165
            'descripcion' => 'Programa con horarios flexibles, perfecto para avanzar de forma ordenada con 5 horas semanales.',
            'estado' => 1,
            'product_id' => 4, // Apoyo escolar Preuniversitario
        ]);
        
        Modalidad::create([
            'modalidad' => 'SLVPR063 Semanal (LU A VI)',
            'inversion' => 227, // Aumento del 10% sobre 220
            'descripcion' => 'Clases diarias para asegurar un progreso constante con una carga horaria total de 7.5 horas.',
            'estado' => 1,
            'product_id' => 4, // Apoyo escolar Preuniversitario
        ]);
        
        Modalidad::create([
            'modalidad' => 'SSSPR064 Semanal Solo Sábado',
            'inversion' => 157, // Aumento del 9.5% sobre 150
            'descripcion' => 'Sesiones intensivas de lunes a sábado, brindando 9 horas de aprendizaje efectivo en la semana.',
            'estado' => 1,
            'product_id' => 4, // Apoyo escolar Preuniversitario
        ]);
        
        Modalidad::create([
            'modalidad' => 'QTVPR065 2 Semanas (LU-MI-VI)',
            'inversion' => 274, // Aumento del 9% sobre 265
            'descripcion' => 'Refuerzo académico durante dos semanas consecutivas con 10 horas de carga horaria efectiva.',
            'estado' => 1,
            'product_id' => 4, // Apoyo escolar Preuniversitario
        ]);
        
        Modalidad::create([
            'modalidad' => 'QTVPR066 2 Semanas (MA-JU-SA)',
            'inversion' => 274, // Aumento del 8.5% sobre 265
            'descripcion' => 'Refuerzo académico durante dos semanas consecutivas con 10 horas de carga horaria efectiva.',
            'estado' => 1,
            'product_id' => 4, // Apoyo escolar Preuniversitario
        ]);
        
        Modalidad::create([
            'modalidad' => 'QLVPR067 2 Semanas (LU A VI)',
            'inversion' => 362, // Aumento del 8% sobre 350
            'descripcion' => 'Clases intensivas por dos semanas consecutivas, con una carga horaria total de 15 horas.',
            'estado' => 1,
            'product_id' => 4, // Apoyo escolar Preuniversitario
        ]);
        
        Modalidad::create([
            'modalidad' => 'MTVPR068 Mensual (LU-MI-VI)',
            'inversion' => 442, // Aumento del 7.5% sobre 420
            'descripcion' => 'Apoyo educativo durante todo un mes, con clases 3 veces por semana y 20 horas de contenido.',
            'estado' => 1,
            'product_id' => 4, // Apoyo escolar Preuniversitario
        ]);
        
        Modalidad::create([
            'modalidad' => 'MTVPR069 Mensual (MA-JU-SA)',
            'inversion' => 442, // Aumento del 7% sobre 420
            'descripcion' => 'Apoyo educativo durante todo un mes, con clases 3 veces por semana y 20 horas de contenido.',
            'estado' => 1,
            'product_id' => 4, // Apoyo escolar Preuniversitario
        ]);
        
        Modalidad::create([
            'modalidad' => 'MLVPR070 Mensual (LU A VI)',
            'inversion' => 578, // Aumento del 6.5% sobre 550
            'descripcion' => 'Programa intensivo mensual con clases de lunes a viernes. Carga horaria de 30 horas.',
            'estado' => 1,
            'product_id' => 4, // Apoyo escolar Preuniversitario
        ]);
        
        Modalidad::create([
            'modalidad' => 'BTVPR071 Bimestral (LU-MI-VI)',
            'inversion' => 799, // Aumento del 6% sobre 750
            'descripcion' => 'Acompañamiento completo durante dos meses con 40 horas de aprendizaje estructurado.',
            'estado' => 1,
            'product_id' => 4, // Apoyo escolar Preuniversitario
        ]);
        
        Modalidad::create([
            'modalidad' => 'BTVPR072 Bimestral (MA-JU-SA)',
            'inversion' => 799, // Aumento del 5.5% sobre 750
            'descripcion' => 'Acompañamiento completo durante dos meses con 40 horas de aprendizaje estructurado.',
            'estado' => 1,
            'product_id' => 4, // Apoyo escolar Preuniversitario
        ]);
        
        Modalidad::create([
            'modalidad' => 'BLVPR073 Bimestral (LU A VI)',
            'inversion' => 788, // Aumento del 5% sobre 750
            'descripcion' => 'Dos meses de clases diarias para garantizar el éxito escolar con 60 horas de contenido educativo.',
            'estado' => 1,
            'product_id' => 4, // Apoyo escolar Preuniversitario
        ]);
        
        Modalidad::create([
            'modalidad' => 'TTVPR074 Trimestral (LU-MI-VI)',
            'inversion' => 1092, // Aumento del 4.5% sobre 1050
            'descripcion' => 'Compromiso educativo de tres meses con 60 horas de apoyo académico a un ritmo equilibrado.',
            'estado' => 1,
            'product_id' => 4, // Apoyo escolar Preuniversitario
        ]);
        
        Modalidad::create([
            'modalidad' => 'TTVPR075 Trimestral (MA-JU-SA)',
            'inversion' => 1092, // Aumento del 4% sobre 1050
            'descripcion' => 'Compromiso educativo de tres meses con 60 horas de apoyo académico a un ritmo equilibrado.',
            'estado' => 1,
            'product_id' => 4, // Apoyo escolar Preuniversitario
        ]);
        
        Modalidad::create([
            'modalidad' => 'TLVPR076 Trimestral (LU A VI)',
            'inversion' => 1477, // Aumento del 3.5% sobre 1420
            'descripcion' => 'Programa premium de 3 meses con clases diarias y una carga horaria total de 90 horas.',
            'estado' => 1,
            'product_id' => 4, // Apoyo escolar Preuniversitario
        ]);

        /* %%%%%%%%%%%%%%%%%%%%%%%%%%%  I N S T I T U T O S %%%%%%%%%%%%%%%*/

        Modalidad::create([
            'modalidad' => 'HLVPR077 Hora Libre',
            'inversion' => 47.5, // Aumento del 12.5% sobre 40
            'descripcion' => 'Flexibilidad total para resolver dudas puntuales. Reserve por hora y aproveche el tiempo al máximo.',
            'estado' => 1,
            'product_id' => 4, // Apoyo escolar Preuniversitario
        ]);
        
        Modalidad::create([
            'modalidad' => 'HLVPR078 Hora Libre 1.5',
            'inversion' => 71.25, // Aumento del 12% sobre 60
            'descripcion' => 'Sesiones cortas y enfocadas de 1.5 horas para reforzar conceptos clave de manera efectiva.',
            'estado' => 1,
            'product_id' => 4, // Apoyo escolar Preuniversitario
        ]);
        
        Modalidad::create([
            'modalidad' => 'HLVPR079 Hora Libre 2H',
            'inversion' => 90, // Aumento del 11.5% sobre 75
            'descripcion' => 'Sesiones completas de 2 horas para brindar apoyo académico intensivo y resultados visibles.',
            'estado' => 1,
            'product_id' => 4, // Apoyo escolar Preuniversitario
        ]);
        

        Modalidad::create([
            'modalidad' => 'STVIT080 Semanal (LU-MI-VI)',
            'inversion' => 181.44, // Base: 165 + 9.96% = 181.44
            'descripcion' => 'Ideal para un refuerzo constante. Clases 3 veces por semana con carga horaria de 5 horas.',
            'estado' => 1,
            'product_id' => 5, // Apoyo escolar Instituto
        ]);

        Modalidad::create([
            'modalidad' => 'STVIT081 Semanal (MA-JU-SA)',
            'inversion' => 181.01, // Base: 165 + 9.7% = 181.01
            'descripcion' => 'Programa con horarios flexibles, perfecto para avanzar de forma ordenada con 5 horas semanales.',
            'estado' => 1,
            'product_id' => 5, // Apoyo escolar Instituto
        ]);

        Modalidad::create([
            'modalidad' => 'SLVIT082 Semanal (LU A VI)',
            'inversion' => 237.6, // Base: 220 + 8% = 237.6
            'descripcion' => 'Clases diarias para asegurar un progreso constante con una carga horaria total de 7.5 horas.',
            'estado' => 1,
            'product_id' => 5, // Apoyo escolar Instituto
        ]);

        Modalidad::create([
            'modalidad' => 'SSVIT083 Semanal Solo Sábado',
            'inversion' => 160.5, // Base: 150 + 7% = 160.5
            'descripcion' => 'Sesiones intensivas de lunes a sábado, brindando 9 horas de aprendizaje efectivo en la semana.',
            'estado' => 1,
            'product_id' => 5, // Apoyo escolar Instituto
        ]);

        Modalidad::create([
            'modalidad' => 'QTVIT084 2 Semanas (LU-MI-VI)',
            'inversion' => 280.08, // Base: 265 + 5.7% = 280.08
            'descripcion' => 'Refuerzo académico durante dos semanas consecutivas con 10 horas de carga horaria efectiva.',
            'estado' => 1,
            'product_id' => 5, // Apoyo escolar Instituto
        ]);

        Modalidad::create([
            'modalidad' => 'QTVIT085 2 Semanas (MA-JU-SA)',
            'inversion' => 280.08, // Base: 265 + 5.7% = 280.08
            'descripcion' => 'Refuerzo académico durante dos semanas consecutivas con 10 horas de carga horaria efectiva.',
            'estado' => 1,
            'product_id' => 5, // Apoyo escolar Instituto
        ]);

        Modalidad::create([
            'modalidad' => 'QLVIT086 2 Semanas (LU A VI)',
            'inversion' => 364.56, // Base: 350 + 4.16% = 364.56
            'descripcion' => 'Clases intensivas por dos semanas consecutivas, con una carga horaria total de 15 horas.',
            'estado' => 1,
            'product_id' => 5, // Apoyo escolar Instituto
        ]);

        Modalidad::create([
            'modalidad' => 'MTVIT087 Mensual (LU-MI-VI)',
            'inversion' => 437.64, // Base: 420 + 4.2% = 437.64
            'descripcion' => 'Apoyo educativo durante todo un mes, con clases 3 veces por semana y 20 horas de contenido.',
            'estado' => 1,
            'product_id' => 5, // Apoyo escolar Instituto
        ]);

        Modalidad::create([
            'modalidad' => 'MTVIT088 Mensual (MA-JU-SA)',
            'inversion' => 437.64, // Base: 420 + 4.2% = 437.64
            'descripcion' => 'Apoyo educativo durante todo un mes, con clases 3 veces por semana y 20 horas de contenido.',
            'estado' => 1,
            'product_id' => 5, // Apoyo escolar Instituto
        ]);

        Modalidad::create([
            'modalidad' => 'MLVIT089 Mensual (LU A VI)',
            'inversion' => 572.4, // Base: 550 + 4.08% = 572.4
            'descripcion' => 'Programa intensivo mensual con clases de lunes a viernes. Carga horaria de 30 horas.',
            'estado' => 1,
            'product_id' => 5, // Apoyo escolar Instituto
        ]);
    }
}
