<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Contenido;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('socials')->insert([
            [
                'social' => 'Facebook',
                'color' => '#3b5998',
                'icon' => 'fab fa-facebook-f',
                'link' => 'https://www.facebook.com/ite.educabol',
                'priority' => '1',
                'state' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'social' => 'Instagram',
                'color' => '#e1306c',
                'icon' => 'fab fa-instagram',
                'link' => 'https://www.instagram.com/ite.educabol/',
                'priority' => '3',
                'state' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'social' => 'WhatsApp',
                'color' => '#25d366',
                'icon' => 'fab fa-whatsapp',
                'link' => 'https://wa.me/59171039910',
                'priority' => '5',
                'state' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'social' => 'TikTok',
                'color' => '#010101',
                'icon' => 'fab fa-tiktok',
                'link' => 'https://www.tiktok.com/@ite_educabol',
                'priority' => '7',
                'state' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'social' => 'WhatsApp',
                'color' => '#25d366',
                'icon' => 'fab fa-whatsapp',
                'link' => 'https://wa.me/59171324941',
                'priority' => '9',
                'state' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'social' => 'WhatsApp',
                'color' => '#25d366',
                'icon' => 'fab fa-whatsapp',
                'link' => 'https://wa.me/59175553338',
                'priority' => '11',
                'state' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        // Eliminar bloque de contenidos, no corresponde a este seeder
    }
}
