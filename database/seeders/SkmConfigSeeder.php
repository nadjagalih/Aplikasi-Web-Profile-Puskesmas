<?php

namespace Database\Seeders;

use App\Models\SkmConfig;
use Illuminate\Database\Seeder;

class SkmConfigSeeder extends Seeder
{
    public function run(): void
    {
        SkmConfig::create([
            'nama_puskesmas' => 'Puskesmas Sehat Sentosa',
            'api_url' => 'https://skm.kemkes.go.id/api',
            'kode_organisasi' => 'PKM001',
            'status' => 'active',
            'keterangan' => 'Konfigurasi untuk integrasi Survei Kepuasan Masyarakat (SKM)',
            'login_url' => 'https://skm.kemkes.go.id/login',
        ]);
    }
}
