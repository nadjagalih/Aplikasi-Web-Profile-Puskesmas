<?php

namespace Database\Seeders;

use App\Models\Sambutan;
use Illuminate\Database\Seeder;

class SambutanSeeder extends Seeder
{
    public function run(): void
    {
        Sambutan::create([
            'nama_pejabat' => 'dr. Ahmad Budiman, M.Kes',
            'jabatan' => 'Kepala Puskesmas Sehat Sentosa',
            'isi_sambutan' => '<p>Assalamu\'alaikum Warahmatullahi Wabarakatuh,</p>
                <p>Puji syukur kita panjatkan kehadirat Allah SWT yang telah memberikan rahmat dan karunia-Nya kepada kita semua.</p>
                <p>Selamat datang di website resmi Puskesmas Sehat Sentosa. Melalui website ini, kami berharap dapat memberikan informasi yang lengkap mengenai profil, layanan kesehatan, program, dan kegiatan yang kami laksanakan.</p>
                <p>Kami senantiasa berupaya memberikan pelayanan kesehatan yang berkualitas dan profesional kepada seluruh masyarakat. Kepuasan dan kesehatan Anda adalah prioritas utama kami.</p>
                <p>Semoga website ini dapat bermanfaat dan menjadi sarana komunikasi yang efektif antara puskesmas dengan masyarakat.</p>
                <p>Wassalamu\'alaikum Warahmatullahi Wabarakatuh</p>',
            'foto' => 'kepala-puskesmas.jpg',
        ]);
    }
}
