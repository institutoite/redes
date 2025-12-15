<?php

namespace Database\Seeders;

use App\Models\Dia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Combinaciones de días
        $dias = [
            [
                'dias' => 'Lunes Miércoles Viernes',
                'abreviatura' => 'Lu-Mi-Vi',
            ],
            [
                'dias' => 'Martes Jueves Sábado',
                'abreviatura' => 'Ma-Ju-Sa',
            ],
            [
                'dias' => 'Sábado',
                'abreviatura' => 'Sa',
            ],
        ];
        foreach ($dias as $d) {
            Dia::updateOrCreate(
                ['dias' => $d['dias']],
                ['abreviatura' => $d['abreviatura']]
            );
        }
    }
}
