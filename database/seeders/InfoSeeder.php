<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('infos')->insert([
            'company_name' => 'IFE Educabol',
            'logo' => 'images/logo-ife-educabol-ofical-instituto-de-formacion-educabol.png',
            'slogan' => 'Formación que transforma',
            'description' => 'IFE Educabol es el lugar donde tu aprendizaje cobra vida. Ofrecemos formación práctica y acompañamiento cercano para impulsar tu desarrollo académico y tecnológico.',
            'address' => 'Villa 1 de mayo calle 16 oeste #9',
            'code' => '591',
            'phone' => '75553338',
        ]);
    }
}
