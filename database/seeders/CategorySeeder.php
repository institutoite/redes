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
            ['description' => 'primaria', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'secundaria', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'rubik', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'ejedrez', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'robotica', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'computacion', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'programacion', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
