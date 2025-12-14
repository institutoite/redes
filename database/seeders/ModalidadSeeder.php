<?php

namespace Database\Seeders;

use App\Models\Modalidad;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $modalidadesBase = [
            [
                'modalidad' => 'Hora Libre',
                'inversion' => 50,
                'descripcion' => 'Flexibilidad total por hora. Carga horaria: 1 h (Bs 50/hora).',
                'estado' => 1,
            ],
            [
                'modalidad' => 'Semana 3 Veces',
                'inversion' => 200,
                'descripcion' => 'Clases 3 veces por semana (LMV/MJS/SÁBADOS). Carga horaria: 5 h (Bs 40/hora).',
                'estado' => 1,
            ],
            [
                'modalidad' => 'Semana Lunes a Viernes',
                'inversion' => 260,
                'descripcion' => 'Clases diarias Lunes a Viernes. Carga horaria: 7.5 h (Bs 34.66/hora).',
                'estado' => 1,
            ],
            [
                'modalidad' => 'Quincena 3 Veces',
                'inversion' => 300,
                'descripcion' => 'Quincena 3 veces por semana. Carga horaria: 10 h (Bs 30/hora).',
                'estado' => 1,
            ],
            [
                'modalidad' => 'Quincena Lunes a Viernes',
                'inversion' => 420,
                'descripcion' => 'Quincena Lunes a Viernes. Carga horaria: 15 h (Bs 28/hora).',
                'estado' => 1,
            ],
            [
                'modalidad' => 'Mes 3 Veces',
                'inversion' => 450,
                'descripcion' => 'Mes 3 veces por semana. Carga horaria: 20 h (Bs 22.5/hora).',
                'estado' => 1,
            ],
            [
                'modalidad' => 'Mes Lunes a Viernes',
                'inversion' => 650,
                'descripcion' => 'Mes Lunes a Viernes. Carga horaria: 30 h (Bs 21.66/hora).',
                'estado' => 1,
            ],
            [
                'modalidad' => '2 Meses 3 Veces',
                'inversion' => 800,
                'descripcion' => '2 Meses 3 veces por semana. Carga horaria: 40 h (Bs 20/hora).',
                'estado' => 1,
            ],
            [
                'modalidad' => '2 Meses Lunes a Viernes',
                'inversion' => 1150,
                'descripcion' => '2 Meses Lunes a Viernes. Carga horaria: 60 h (Bs 19.16/hora).',
                'estado' => 1,
            ],
            [
                'modalidad' => '3 Meses 3 Veces',
                'inversion' => 1140,
                'descripcion' => '3 Meses 3 veces por semana. Carga horaria: 60 h (Bs 19/hora).',
                'estado' => 1,
            ],
            [
                'modalidad' => '3 Meses Lunes a Viernes',
                'inversion' => 1620,
                'descripcion' => '3 Meses Lunes a Viernes. Carga horaria: 90 h (Bs 18/hora).',
                'estado' => 1,
            ],
        ];

        $products = Product::all();
        foreach ($products as $product) {
            $orden = 1;
            foreach ($modalidadesBase as $m) {
                $m['product_id'] = $product->id;
                $m['orden'] = $orden;
                Modalidad::create($m);
                $orden++;
            }
        }
    }
}
