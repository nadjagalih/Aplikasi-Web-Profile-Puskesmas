<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'menu_id' => 3, // Tentang Kami
                'title' => 'Tentang Kami',
                'slug' => 'tentang-kami',
                'content' => '<h2>Sejarah Puskesmas</h2><p>Puskesmas Sehat Sentosa didirikan pada tahun 1985...</p>',
                'banner' => 'tentang-banner.jpg',
                'meta_description' => 'Informasi lengkap tentang Puskesmas Sehat Sentosa',
                'meta_keywords' => 'puskesmas, sejarah, tentang kami',
                'is_active' => true,
            ],
            [
                'menu_id' => 4, // Visi Misi
                'title' => 'Visi & Misi',
                'slug' => 'visi-misi',
                'content' => '<h2>Visi</h2><p>Menjadi puskesmas terdepan...</p>',
                'banner' => 'visi-misi-banner.jpg',
                'meta_description' => 'Visi dan Misi Puskesmas Sehat Sentosa',
                'meta_keywords' => 'visi, misi, puskesmas',
                'is_active' => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
