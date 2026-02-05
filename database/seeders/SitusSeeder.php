<?php

namespace Database\Seeders;

use App\Models\Situs;
use Illuminate\Database\Seeder;

class SitusSeeder extends Seeder
{
    public function run(): void
    {
        Situs::create([
            'nama_situs' => 'Puskesmas Sehat Sentosa',
            'tagline' => 'Melayani Dengan Sepenuh Hati',
            'deskripsi' => 'Website resmi Puskesmas Sehat Sentosa yang menyediakan informasi layanan kesehatan dan berita terkini.',
            'logo' => 'logo.png',
            'favicon' => 'favicon.ico',
        ]);
    }
}
