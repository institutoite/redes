<?php

namespace Database\Seeders;

use App\Models\Product;
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
        $products = [
            ['nombre' => 'Nivel Inicial', 'imagen' => 'apoyo_inicial.jpg', 'price' => 40.00],
            ['nombre' => 'Nivel primaria', 'imagen' => 'apoyo_primaria.jpg', 'price' => 40.00],
            ['nombre' => 'Nivel secundaria', 'imagen' => 'apoyo_secundaria.jpg', 'price' => 40.00],
            ['nombre' => 'PREUNIVERSITARIOS', 'imagen' => 'psa.jpg', 'price' => 45.00],
            ['nombre' => 'NIVEL INSTITUTOS', 'imagen' => 'psa.jpg', 'price' => 48.00],
            ['nombre' => 'NIVEL UNIVERSITARIO', 'imagen' => 'psa.jpg', 'price' => 50.00],
            ['nombre' => 'Computación', 'imagen' => 'computacion.jpg', 'price' => 120.00],
            ['nombre' => 'Cubo Rubik', 'imagen' => 'cubo_rubik.jpg', 'price' => 50.00],
            ['nombre' => 'Ajedrez', 'imagen' => 'ajedrez.jpg', 'price' => 70.00],
            ['nombre' => 'Diseño Gráfico', 'imagen' => 'diseno_grafico.jpg', 'price' => 150.00],
            ['nombre' => 'Dactilografía', 'imagen' => 'dactilografia.jpg', 'price' => 80.00],
            ['nombre' => 'Oratoria', 'imagen' => 'oratoria.jpg', 'price' => 100.00],
            ['nombre' => 'Lectura y Escritura', 'imagen' => 'lectura_escritura.jpg', 'price' => 90.00],
            ['nombre' => 'Super Memoria', 'imagen' => 'super_memoria.jpg', 'price' => 110.00],
            ['nombre' => 'Robótica', 'imagen' => 'robotica.jpg', 'price' => 200.00],
            ['nombre' => 'Programación', 'imagen' => 'programacion.jpg', 'price' => 250.00],
            ['nombre' => 'Inteligencia Artificial', 'imagen' => 'ia.jpg', 'price' => 300.00],
            ['nombre' => 'Creación de Contenido', 'imagen' => 'creacion_contenido.jpg', 'price' => 180.00],
            ['nombre' => 'Impresión 3D', 'imagen' => 'impresion_3d.jpg', 'price' => 220.00],
        ];

        // Crear los productos en la base de datos
        foreach ($products as $product) {
            Product::create([
                'nombre' => $product['nombre'],
                'imagen' => $product['imagen'],
                'price' => $product['price'],
                'clicks' => 0, // Inicializamos clicks en 0
                'categories_id' => 1, // Relación con la categoría
            ]);
        }
    }
}
