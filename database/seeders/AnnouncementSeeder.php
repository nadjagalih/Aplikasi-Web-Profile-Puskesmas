<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $announcements = [
            [
                'judul' => 'Libur Hari Raya Idul Fitri',
                'isi' => 'Puskesmas libur pada tanggal 10-12 April 2024. Pelayanan darurat tetap buka.',
                'user_id' => 1,
            ],
            [
                'judul' => 'Pendaftaran Online Sudah Tersedia',
                'isi' => 'Masyarakat kini dapat melakukan pendaftaran secara online melalui website puskesmas.',
                'user_id' => 1,
            ],
        ];

        foreach ($announcements as $announcement) {
            Announcement::create($announcement);
        }
    }
}
