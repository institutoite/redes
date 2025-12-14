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
             ['nombre' => 'Nivel Inicial', 'imagen' => 'apoyo_inicial.png', 'price' => 40.00,
     "descripcion" => "Dificultades tempranas en letras y números pueden marcar su futuro. Refuerza hoy las bases antes de que el retraso sea mayor."
    ],

    ['nombre' => 'Nivel primaria', 'imagen' => 'apoyo_primaria.png', 'price' => 40.00,
     "descripcion" => "Tareas interminables, frustración y malas notas no son normales. Apoyo escolar que devuelve la seguridad y el rendimiento."
    ],

    ['nombre' => 'Nivel secundaria', 'imagen' => 'apoyo_secundaria.png', 'price' => 40.00,
     "descripcion" => "Materias acumuladas y estrés constante pueden terminar en aplazo. Refuerza ahora y evita repetir el año."
    ],

    ['nombre' => 'PREUNIVERSITARIOS', 'imagen' => 'apoyo_preuniversitario.png', 'price' => 45.00,
     "descripcion" => "Un examen define tu ingreso a la universidad. No arriesgues tu futuro por falta de preparación."
    ],

    ['nombre' => 'NIVEL INSTITUTOS', 'imagen' => 'apoyo_instituto.png', 'price' => 48.00,
     "descripcion" => "Si hoy no entiendes, mañana será peor. Domina tus materias y evita perder tiempo y dinero."
    ],

    ['nombre' => 'NIVEL UNIVERSITARIO', 'imagen' => 'apoyo_universitario.png', 'price' => 50.00,
     "descripcion" => "La universidad no perdona vacíos académicos. Aprende bien hoy o cargarás el problema toda la carrera."
    ],

    ['nombre' => 'Computación', 'imagen' => 'computacion.png', 'price' => 120.00,
     "descripcion" => "El mundo es digital y quedarse atrás cuesta caro. Aprende computación y aumenta tus oportunidades."
    ],

    ['nombre' => 'Cubo Rubik', 'imagen' => 'cubo_rubik.png', 'price' => 50.00,
     "descripcion" => "Más que un juego: desarrolla concentración, lógica y paciencia mientras entrenas la mente."
    ],

    ['nombre' => 'Ajedrez', 'imagen' => 'ajedrez.png', 'price' => 70.00,
     "descripcion" => "Cada decisión importa. Aprende a pensar estratégicamente y a anticiparte a los problemas."
    ],

    ['nombre' => 'Diseño Gráfico', 'imagen' => 'diseno_grafico.png', 'price' => 150.00,
     "descripcion" => "Las ideas sin diseño no venden. Convierte tu creatividad en una habilidad profesional."
    ],

    ['nombre' => 'Dactilografía', 'imagen' => 'dactilografia.png', 'price' => 80.00,
     "descripcion" => "Escribir lento te hace perder horas cada semana. Aprende a escribir rápido y sin errores."
    ],

    ['nombre' => 'Oratoria', 'imagen' => 'oratoria.png', 'price' => 100.00,
     "descripcion" => "Tener ideas y no saber expresarlas es perder oportunidades. Habla con seguridad y convence."
    ],

    ['nombre' => 'Lectura y Escritura', 'imagen' => 'lectura_escritura.png', 'price' => 90.00,
     "descripcion" => "Si no entiende lo que lee, todo será difícil. Mejora la comprensión y el aprendizaje."
    ],

    ['nombre' => 'Super Memoria', 'imagen' => 'super_memoria.png', 'price' => 110.00,
     "descripcion" => "Estudiar y olvidar todo no es normal. Aprende técnicas para recordar más y estudiar menos."
    ],

    ['nombre' => 'Robótica', 'imagen' => 'robotica.png', 'price' => 200.00,
     "descripcion" => "El futuro necesita creadores, no espectadores. Aprende a construir y programar tecnología."
    ],

    ['nombre' => 'Programación', 'imagen' => 'programacion.png', 'price' => 250.00,
     "descripcion" => "Quien no programa depende de otros. Aprende a crear soluciones y abre puertas laborales."
    ],

    ['nombre' => 'Inteligencia Artificial', 'imagen' => 'inteligencia_artificial.png', 'price' => 300.00,
     "descripcion" => "Crea e integra soluciones con IA aplicadas a sistemas, apps y automatización real."
    ],

    ['nombre' => 'Creación de Contenido', 'imagen' => 'creacion_contenido.png', 'price' => 180.00,
     "descripcion" => "Publicar sin estrategia es perder tiempo. Aprende a crear contenido que crece y vende."
    ],

    ['nombre' => 'Impresión 3D', 'imagen' => 'impresion3d.png', 'price' => 220.00,
     "descripcion" => "Las ideas que no se materializan no valen nada. Diseña, imprime y crea productos reales."
    ],
        ];

        // Crear los productos en la base de datos con 'orden' secuencial único
        $orden = 1;
        foreach ($products as $product) {
            Product::create([
                'nombre' => $product['nombre'],
                'imagen' => $product['imagen'],
                'price' => $product['price'],
                'descripcion' => $product['descripcion'],
                'clicks' => 0, // Inicializamos clicks en 0
                'categories_id' => 1, // Relación con la categoría
            ]);
            $orden++;
        }
    }
}
