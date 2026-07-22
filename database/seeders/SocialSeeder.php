<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('socials')->insert([
            [
                'social' => 'TikTok',
                'color' => '#375F7A',
                'icon' => 'fab fa-tiktok',
                'link' => 'https://www.tiktok.com/@ife_educabol',
                'priority' => '1',
                'state' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'social' => 'Facebook',
                'color' => '#375F7A',
                'icon' => 'fab fa-facebook-f',
                'link' => 'https://www.facebook.com/ife.educabol',
                'priority' => '2',
                'state' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'social' => 'YouTube',
                'color' => '#26BAA5',
                'icon' => 'fab fa-youtube',
                'link' => 'https://www.youtube.com/@ife_educabol',
                'priority' => '3',
                'state' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'social' => 'Instagram',
                'color' => '#26BAA5',
                'icon' => 'fab fa-instagram',
                'link' => 'https://www.instagram.com/ife_educabol',
                'priority' => '4',
                'state' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
