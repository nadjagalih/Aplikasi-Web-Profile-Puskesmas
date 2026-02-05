<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AgendaSeeder extends Seeder
{
    public function run(): void
    {
        $agendas = [
            [
                'judul' => 'Posyandu Balita',
                'deskripsi' => 'Kegiatan posyandu rutin untuk balita',
                'tanggal_mulai' => Carbon::now()->addDays(7)->setTime(8, 0),
                'tanggal_selesai' => Carbon::now()->addDays(7)->setTime(12, 0),
                'lokasi' => 'Balai Desa',
                'user_id' => 1,
            ],
            [
                'judul' => 'Penyuluhan Kesehatan',
                'deskripsi' => 'Penyuluhan tentang pola hidup sehat',
                'tanggal_mulai' => Carbon::now()->addDays(14)->setTime(9, 0),
                'tanggal_selesai' => Carbon::now()->addDays(14)->setTime(11, 0),
                'lokasi' => 'Aula Puskesmas',
                'user_id' => 1,
            ],
            [
                'judul' => 'Imunisasi Anak',
                'deskripsi' => 'Imunisasi untuk anak usia 0-5 tahun',
                'tanggal_mulai' => Carbon::now()->addDays(21)->setTime(8, 0),
                'tanggal_selesai' => Carbon::now()->addDays(21)->setTime(14, 0),
                'lokasi' => 'Puskesmas',
                'user_id' => 1,
            ],
        ];

        foreach ($agendas as $agenda) {
            Agenda::create($agenda);
        }
    }
}
