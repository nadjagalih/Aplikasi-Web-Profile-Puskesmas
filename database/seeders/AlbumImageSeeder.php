<?php

namespace Database\Seeders;

use App\Models\AlbumImage;
use Illuminate\Database\Seeder;

class AlbumImageSeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            // Album 1 - Kegiatan Posyandu
            ['album_id' => 1, 'gambar' => 'posyandu1.jpg'],
            ['album_id' => 1, 'gambar' => 'posyandu2.jpg'],
            ['album_id' => 1, 'gambar' => 'posyandu3.jpg'],
            
            // Album 2 - Fasilitas
            ['album_id' => 2, 'gambar' => 'fasilitas1.jpg'],
            ['album_id' => 2, 'gambar' => 'fasilitas2.jpg'],
            ['album_id' => 2, 'gambar' => 'fasilitas3.jpg'],
            
            // Album 3 - Imunisasi
            ['album_id' => 3, 'gambar' => 'imunisasi1.jpg'],
            ['album_id' => 3, 'gambar' => 'imunisasi2.jpg'],
        ];

        foreach ($images as $image) {
            AlbumImage::create($image);
        }
    }
}
