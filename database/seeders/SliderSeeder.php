<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        $sliders = [
            [
                'judul' => 'Selamat Datang di Puskesmas',
                'deskripsi' => 'Melayani dengan sepenuh hati untuk kesehatan Anda',
                'gambar' => 'slider1.jpg',
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'judul' => 'Pelayanan Kesehatan Terpadu',
                'deskripsi' => 'Fasilitas lengkap dan tenaga medis berpengalaman',
                'gambar' => 'slider2.jpg',
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'judul' => 'Kesehatan Anda Prioritas Kami',
                'deskripsi' => 'Buka setiap hari untuk melayani Anda',
                'gambar' => 'slider3.jpg',
                'urutan' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::create($slider);
        }
    }
}
