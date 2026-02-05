<?php

namespace Database\Seeders;

use App\Models\Berkas;
use Illuminate\Database\Seeder;

class BerkasSeeder extends Seeder
{
    public function run(): void
    {
        $berkas = [
            [
                'judul' => 'Formulir Pendaftaran Pasien Baru',
                'deskripsi' => 'Formulir yang harus diisi oleh pasien baru',
                'file' => 'formulir-pendaftaran.pdf',
                'tipe' => 'pdf',
            ],
            [
                'judul' => 'Persyaratan Layanan Kesehatan',
                'deskripsi' => 'Dokumen persyaratan untuk berbagai layanan kesehatan',
                'file' => 'persyaratan-layanan.pdf',
                'tipe' => 'pdf',
            ],
            [
                'judul' => 'Jadwal Pelayanan',
                'deskripsi' => 'Jadwal pelayanan puskesmas',
                'file' => 'jadwal-pelayanan.xlsx',
                'tipe' => 'xlsx',
            ],
        ];

        foreach ($berkas as $item) {
            Berkas::create($item);
        }
    }
}
