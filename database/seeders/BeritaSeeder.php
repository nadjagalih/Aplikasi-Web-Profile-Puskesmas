<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $beritas = [
            [
                'judul' => 'Imunisasi Massal untuk Balita',
                'slug' => 'imunisasi-massal-untuk-balita',
                'isi' => '<p>Puskesmas mengadakan program imunisasi massal untuk balita. Program ini bertujuan untuk meningkatkan kesehatan anak-anak di wilayah kerja puskesmas.</p>',
                'gambar' => 'berita1.jpg',
                'user_id' => 1,
                'post_status_id' => 2,
                'kategori_id' => 3,
            ],
            [
                'judul' => 'Pelayanan 24 Jam Mulai Bulan Depan',
                'slug' => 'pelayanan-24-jam-mulai-bulan-depan',
                'isi' => '<p>Dalam rangka meningkatkan pelayanan kesehatan kepada masyarakat, puskesmas akan membuka layanan 24 jam mulai bulan depan.</p>',
                'gambar' => 'berita2.jpg',
                'user_id' => 1,
                'post_status_id' => 2,
                'kategori_id' => 2,
            ],
            [
                'judul' => 'Tips Hidup Sehat di Musim Pancaroba',
                'slug' => 'tips-hidup-sehat-di-musim-pancaroba',
                'isi' => '<p>Musim pancaroba rentan terhadap berbagai penyakit. Berikut tips untuk menjaga kesehatan di musim pancaroba.</p>',
                'gambar' => 'berita3.jpg',
                'user_id' => 2,
                'post_status_id' => 2,
                'kategori_id' => 5,
            ],
        ];

        foreach ($beritas as $berita) {
            Berita::create($berita);
        }
    }
}
