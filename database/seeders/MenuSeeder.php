<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Main Menus
        $beranda = Menu::create([
            'parent_id' => null,
            'title' => 'Beranda',
            'slug' => 'beranda',
            'url' => '/',
            'type' => 'internal',
            'target' => '_self',
            'icon' => 'fas fa-home',
            'order' => 1,
            'position' => 'header',
            'is_active' => true,
        ]);

        $profil = Menu::create([
            'parent_id' => null,
            'title' => 'Profil',
            'slug' => 'profil',
            'url' => '#',
            'type' => 'dropdown',
            'target' => '_self',
            'icon' => 'fas fa-building',
            'order' => 2,
            'position' => 'header',
            'is_active' => true,
        ]);

        // Submenu Profil
        Menu::create([
            'parent_id' => $profil->id,
            'title' => 'Tentang Kami',
            'slug' => 'tentang-kami',
            'url' => '/profil/tentang-kami',
            'type' => 'internal',
            'target' => '_self',
            'icon' => null,
            'order' => 1,
            'position' => 'header',
            'is_active' => true,
        ]);

        Menu::create([
            'parent_id' => $profil->id,
            'title' => 'Visi & Misi',
            'slug' => 'visi-misi',
            'url' => '/profil/visi-misi',
            'type' => 'internal',
            'target' => '_self',
            'icon' => null,
            'order' => 2,
            'position' => 'header',
            'is_active' => true,
        ]);

        Menu::create([
            'parent_id' => $profil->id,
            'title' => 'Struktur Organisasi',
            'slug' => 'struktur-organisasi',
            'url' => '/profil/struktur-organisasi',
            'type' => 'internal',
            'target' => '_self',
            'icon' => null,
            'order' => 3,
            'position' => 'header',
            'is_active' => true,
        ]);

        Menu::create([
            'parent_id' => null,
            'title' => 'Layanan',
            'slug' => 'layanan',
            'url' => '/layanan',
            'type' => 'internal',
            'target' => '_self',
            'icon' => 'fas fa-hospital',
            'order' => 3,
            'position' => 'header',
            'is_active' => true,
        ]);

        Menu::create([
            'parent_id' => null,
            'title' => 'Berita',
            'slug' => 'berita',
            'url' => '/berita',
            'type' => 'internal',
            'target' => '_self',
            'icon' => 'fas fa-newspaper',
            'order' => 4,
            'position' => 'header',
            'is_active' => true,
        ]);

        Menu::create([
            'parent_id' => null,
            'title' => 'Galeri',
            'slug' => 'galeri',
            'url' => '/galeri',
            'type' => 'internal',
            'target' => '_self',
            'icon' => 'fas fa-images',
            'order' => 5,
            'position' => 'header',
            'is_active' => true,
        ]);

        Menu::create([
            'parent_id' => null,
            'title' => 'Kontak',
            'slug' => 'kontak',
            'url' => '/kontak',
            'type' => 'internal',
            'target' => '_self',
            'icon' => 'fas fa-envelope',
            'order' => 6,
            'position' => 'header',
            'is_active' => true,
        ]);
    }
}
