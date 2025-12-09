<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Product;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inicial = Product::where('nombre', 'Nivel Inicial')->first();
        if (!$inicial) {
            return;
        }

        $items = [
            ['nombre' => 'Borrador', 'descripcion' => 'Suave, no mancha.', 'orden' => 1],
            ['nombre' => 'Cuaderno', 'descripcion' => '100 hojas, rayado o cuadriculado.', 'orden' => 2],
            ['nombre' => 'Lápiz grafito HB', 'descripcion' => null, 'orden' => 3],
            ['nombre' => 'Colores', 'descripcion' => 'Set básico de 12.', 'orden' => 4],
            ['nombre' => 'Tijera punta roma', 'descripcion' => 'Segura para niños.', 'orden' => 5],
            ['nombre' => 'Pegamento', 'descripcion' => 'En barra, no tóxico.', 'orden' => 6],
            ['nombre' => 'Carpeta o folder', 'descripcion' => 'Tamaño carta.', 'orden' => 7],
            ['nombre' => 'Toallitas húmedas', 'descripcion' => 'Para limpieza rápida.', 'orden' => 8],
        ];

        foreach ($items as $i) {
            Material::create([
                'product_id' => $inicial->id,
                'nombre' => $i['nombre'],
                'descripcion' => $i['descripcion'],
                'estado' => true,
                'orden' => $i['orden'],
            ]);
        }
    }
}
