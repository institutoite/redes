<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Beneficio;
use App\Models\Product;

class BeneficioSeeder extends Seeder
{
    public function run(): void
    {
        $product = Product::first();
        if (!$product) {
            return;
        }

        Beneficio::updateOrCreate([
            'product_id' => $product->id,
            'titulo' => 'Soporte 24/7',
        ], [
            'detalle' => 'Atención permanente para estudiantes.',
            'estado' => true,
            'priority' => 1,
        ]);

        Beneficio::updateOrCreate([
            'product_id' => $product->id,
            'titulo' => 'Acceso de por vida',
        ], [
            'detalle' => 'Material disponible sin caducidad.',
            'estado' => true,
            'priority' => 2,
        ]);
    }
}
