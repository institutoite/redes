<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('users')->insert([
            'name' => 'DAVID',
            'email' => 'informaciones.ite@gmail.com',
            'password' => Hash::make('lobacude13'), // Cambia 'password' por una contraseña segura
        ]);
    }
}
