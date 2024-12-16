<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['description' => 'Apoyo escolar Inicial', 
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['description' => 'Apoyo escolar primaria', 
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['description' => 'Apoyo escolar Secundaria', 
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['description' => 'PSA Y CUP PREUNIVERSITARIO', 
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['description' => 'CUBO RUBIK', 
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['description' => 'COMPUTACION', 
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['description' => 'AJEDREZ', 
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['description' => 'DACTILOGRAFIA', 
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['description' => 'ORATORIA', 
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['description' => 'LECTURA Y ESCRITURA', 
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['description' => 'SUPER MEMORIA', 
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['description' => 'ROBOTICA', 
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['description' => 'PROGRAMCION', 
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['description' => 'INTELIGENCIA ARTIFICIAL', 
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['description' => 'CREACION DE CONTENIDO', 
            'created_at' => now(), 
            'updated_at' => now()
            ],
        ]);
    }
}
