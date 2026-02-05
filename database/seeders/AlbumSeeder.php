<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    public function run(): void
    {
        $albums = [
            [
                'judul' => 'Kegiatan Posyandu 2024',
                'deskripsi' => 'Dokumentasi kegiatan posyandu tahun 2024',
                'cover_image' => 'album1-cover.jpg',
                'user_id' => 1,
            ],
            [
                'judul' => 'Fasilitas Puskesmas',
                'deskripsi' => 'Foto-foto fasilitas yang tersedia di puskesmas',
                'cover_image' => 'album2-cover.jpg',
                'user_id' => 1,
            ],
            [
                'judul' => 'Imunisasi Massal',
                'deskripsi' => 'Dokumentasi program imunisasi massal',
                'cover_image' => 'album3-cover.jpg',
                'user_id' => 1,
            ],
        ];

        foreach ($albums as $album) {
            Album::create($album);
        }
    }
}
