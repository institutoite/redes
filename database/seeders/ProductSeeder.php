<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'nombre' => 'Producto 1',
                'imagen' => 'imagen1.jpg',
                'price' => 100.00,
                'categories_id' => 1, // Asegúrate de que exista una categoría con este ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Producto 2',
                'imagen' => 'imagen2.jpg',
                'price' => 150.50,
                'categories_id' => 2, // Asegúrate de que exista una categoría con este ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Producto 3',
                'imagen' => 'imagen3.jpg',
                'price' => 200.75,
                'categories_id' => 1, // Asegúrate de que exista una categoría con este ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Puedes agregar más productos aquí
        ]);
    }
}
