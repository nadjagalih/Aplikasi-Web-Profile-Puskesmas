<?php

namespace Database\Seeders;

use App\Models\GambarStrukturOrganisasi;
use Illuminate\Database\Seeder;

class GambarStrukturOrganisasiSeeder extends Seeder
{
    public function run(): void
    {
        GambarStrukturOrganisasi::create([
            'judul' => 'Struktur Organisasi Puskesmas Sehat Sentosa 2024',
            'gambar' => 'struktur-organisasi.png',
        ]);
    }
}
