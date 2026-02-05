<?php

namespace Database\Seeders;

use App\Models\Profil;
use Illuminate\Database\Seeder;

class ProfilSeeder extends Seeder
{
    public function run(): void
    {
        Profil::create([
            'nama_puskesmas' => 'Puskesmas Sehat Sentosa',
            'sejarah' => '<p>Puskesmas Sehat Sentosa didirikan pada tahun 1985 dengan tujuan memberikan pelayanan kesehatan terbaik kepada masyarakat.</p>',
            'alamat' => 'Jl. Kesehatan No. 123, Kota Sehat',
            'telepon' => '(021) 12345678',
            'email' => 'info@puskesmas-sehatsentosa.id',
            'logo' => 'logo.png',
        ]);
    }
}
