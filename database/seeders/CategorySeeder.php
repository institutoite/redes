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
            ['description' => 'Technology', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Health', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Sports', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Education', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Entertainment', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
