<?php

namespace Database\Seeders;

use App\Models\StrukturOrganisasi;
use Illuminate\Database\Seeder;

class StrukturOrganisasiSeeder extends Seeder
{
    public function run(): void
    {
        $strukturs = [
            ['nama' => 'dr. Ahmad Budiman', 'jabatan' => 'Kepala Puskesmas', 'foto' => 'kepala.jpg', 'urutan' => 1],
            ['nama' => 'dr. Siti Nurhaliza', 'jabatan' => 'Koordinator Pelayanan Medis', 'foto' => 'koordinator.jpg', 'urutan' => 2],
            ['nama' => 'Rina Wijaya, S.KM', 'jabatan' => 'Kepala Tata Usaha', 'foto' => 'tata-usaha.jpg', 'urutan' => 3],
            ['nama' => 'Budi Santoso, AMK', 'jabatan' => 'Koordinator Keperawatan', 'foto' => 'keperawatan.jpg', 'urutan' => 4],
            ['nama' => 'Dewi Lestari, S.Farm', 'jabatan' => 'Koordinator Farmasi', 'foto' => 'farmasi.jpg', 'urutan' => 5],
        ];

        foreach ($strukturs as $struktur) {
            StrukturOrganisasi::create($struktur);
        }
    }
}
