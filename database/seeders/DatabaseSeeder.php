<?php

namespace Database\Seeders;

use App\Models\Modalidad;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            ModalidadSeeder::class,
            ContenidoSeeder::class,
            MaterialSeeder::class,
            HorarioSeeder::class,
            VentajaSeeder::class,
            DiaSeeder::class,
            SocialSeeder::class,
            LocationSeeder::class,
            UserSeeder::class,
            InfoSeeder::class,
            PrimarySeeder::class,
            SecondarySeeder::class,
            InstitutosSeeder::class,
            UniversitarioSeeder::class,
            ComputacionSeeder::class,
            CuboRubikSeeder::class,
            AjedrezSeeder::class,
            DisenGraficoSeeder::class,
            CreacionContenidoSeeder::class,
            DactilografiaSeeder::class,
            OratoriaSeeder::class,
            Impresion3DSeeder::class,
            RoboticaSeeder::class,
            LecturaEscrituraSeeder::class,
            SuperMemoriaSeeder::class,
            ProgramacionSeeder::class,
            InteligenciaArtificialSeeder::class,
            InteligenciaArtificialUsuarioSeeder::class,
        ]);
    }
}
