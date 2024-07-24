<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        ]);
    }
}
