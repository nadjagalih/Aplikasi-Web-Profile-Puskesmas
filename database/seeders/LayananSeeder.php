<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $layanans = [
            [
                'nama_layanan' => 'Rawat Jalan',
                'deskripsi' => '<p>Pelayanan kesehatan untuk pasien yang tidak memerlukan perawatan inap. Melayani pemeriksaan umum, konsultasi, dan pengobatan.</p>',
                'persyaratan' => '<ul><li>Kartu identitas (KTP/SIM/Paspor)</li><li>Kartu BPJS (jika ada)</li><li>Kartu berobat puskesmas (jika sudah pernah berobat)</li></ul>',
                'waktu_layanan' => 'Senin - Jumat: 08.00 - 14.00 WIB',
                'icon' => 'fas fa-user-md',
            ],
            [
                'nama_layanan' => 'UGD (Unit Gawat Darurat)',
                'deskripsi' => '<p>Pelayanan kesehatan untuk kasus-kasus darurat yang memerlukan penanganan segera.</p>',
                'persyaratan' => '<ul><li>Tidak ada persyaratan khusus</li><li>Langsung datang ke UGD</li></ul>',
                'waktu_layanan' => '24 Jam',
                'icon' => 'fas fa-ambulance',
            ],
            [
                'nama_layanan' => 'Imunisasi',
                'deskripsi' => '<p>Pelayanan imunisasi untuk bayi, balita, dan anak sekolah sesuai jadwal imunisasi nasional.</p>',
                'persyaratan' => '<ul><li>Buku KIA (Kesehatan Ibu dan Anak)</li><li>Kartu identitas orang tua</li></ul>',
                'waktu_layanan' => 'Senin, Rabu, Jumat: 08.00 - 12.00 WIB',
                'icon' => 'fas fa-syringe',
            ],
            [
                'nama_layanan' => 'KB (Keluarga Berencana)',
                'deskripsi' => '<p>Pelayanan konseling dan alat kontrasepsi untuk program keluarga berencana.</p>',
                'persyaratan' => '<ul><li>Kartu identitas</li><li>Kartu BPJS (jika ada)</li></ul>',
                'waktu_layanan' => 'Selasa - Kamis: 08.00 - 14.00 WIB',
                'icon' => 'fas fa-users',
            ],
            [
                'nama_layanan' => 'Laboratorium',
                'deskripsi' => '<p>Pelayanan pemeriksaan laboratorium untuk mendukung diagnosis penyakit.</p>',
                'persyaratan' => '<ul><li>Surat pengantar dari dokter</li><li>Puasa (untuk pemeriksaan tertentu)</li></ul>',
                'waktu_layanan' => 'Senin - Jumat: 08.00 - 11.00 WIB',
                'icon' => 'fas fa-flask',
            ],
            [
                'nama_layanan' => 'Farmasi',
                'deskripsi' => '<p>Pelayanan obat dan konseling farmasi untuk pasien.</p>',
                'persyaratan' => '<ul><li>Resep dari dokter</li></ul>',
                'waktu_layanan' => 'Senin - Jumat: 08.00 - 14.00 WIB',
                'icon' => 'fas fa-pills',
            ],
        ];

        foreach ($layanans as $layanan) {
            Layanan::create($layanan);
        }
    }
}
