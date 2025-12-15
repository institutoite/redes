<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Dia;

class ProductDiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buscar el producto ejemplo (ajusta el nombre si es necesario)
        $producto = Product::where('nombre', 'Secundaria')->first();
        if (!$producto) {
            $producto = Product::create([
                'nombre' => 'Secundaria',
                // Agrega otros campos requeridos si es necesario
            ]);
        }

        // Obtener los IDs de las combinaciones de días
        $dias = Dia::whereIn('dias', [
            'Lunes Miércoles Viernes',
            'Martes Jueves Sábado',
            'Sábado',
        ])->get();

        foreach ($dias as $dia) {
            \App\Models\ProductDia::updateOrCreate([
                'product_id' => $producto->id,
                'dia_id' => $dia->id,
            ]);
        }
    }
}
