<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $galleries = [
            [
                'judul' => 'Kegiatan Posyandu',
                'deskripsi' => 'Kegiatan posyandu rutin setiap bulan',
                'gambar' => 'gallery1.jpg',
            ],
            [
                'judul' => 'Ruang Tunggu Puskesmas',
                'deskripsi' => 'Ruang tunggu yang nyaman untuk pasien',
                'gambar' => 'gallery2.jpg',
            ],
            [
                'judul' => 'Fasilitas Laboratorium',
                'deskripsi' => 'Laboratorium dengan peralatan modern',
                'gambar' => 'gallery3.jpg',
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }
}
