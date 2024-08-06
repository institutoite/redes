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
            'company_name' => 'ITE',
            'logo' => 'logo.png',
            'slogan' => 'Facilitamos tu educación',
            'description' => 'ITE es el lugar donde tu aprendizaje cobra vida. Ofrecemos cursos innovadores en programación, matemáticas y más, con docentes expertos para impulsar tu éxito. ¡Descubre todo lo que podemos hacer por ti! ',
            'address' => 'Villa 1 de mayo calle 16 oeste #9',
            'code' => '591',
            'phone' => '71039910',
        ]);
    }
}
