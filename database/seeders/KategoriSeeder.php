<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            ['kategori' => 'Kesehatan', 'slug' => 'kesehatan', 'user_id' => 1],
            ['kategori' => 'Informasi Umum', 'slug' => 'informasi-umum', 'user_id' => 1],
            ['kategori' => 'Program Kesehatan', 'slug' => 'program-kesehatan', 'user_id' => 1],
            ['kategori' => 'Kegiatan Puskesmas', 'slug' => 'kegiatan-puskesmas', 'user_id' => 1],
            ['kategori' => 'Edukasi', 'slug' => 'edukasi', 'user_id' => 1],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}
