<?php

namespace Database\Seeders;

use App\Models\AlurPelayanan;
use Illuminate\Database\Seeder;

class AlurPelayananSeeder extends Seeder
{
    public function run(): void
    {
        $alurs = [
            [
                'judul' => 'Pendaftaran',
                'deskripsi' => 'Pasien melakukan pendaftaran di loket',
                'gambar' => 'alur1.jpg',
                'urutan' => 1,
            ],
            [
                'judul' => 'Pemeriksaan',
                'deskripsi' => 'Pasien menunggu dipanggil untuk pemeriksaan',
                'gambar' => 'alur2.jpg',
                'urutan' => 2,
            ],
            [
                'judul' => 'Pengobatan',
                'deskripsi' => 'Pasien mendapat resep dan pengobatan',
                'gambar' => 'alur3.jpg',
                'urutan' => 3,
            ],
            [
                'judul' => 'Farmasi',
                'deskripsi' => 'Pasien mengambil obat di apotik',
                'gambar' => 'alur4.jpg',
                'urutan' => 4,
            ],
            [
                'judul' => 'Pembayaran',
                'deskripsi' => 'Pasien melakukan pembayaran (jika ada)',
                'gambar' => 'alur5.jpg',
                'urutan' => 5,
            ],
        ];

        foreach ($alurs as $alur) {
            AlurPelayanan::create($alur);
        }
    }
}
