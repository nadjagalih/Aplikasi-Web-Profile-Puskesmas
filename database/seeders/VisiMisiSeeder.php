<?php

namespace Database\Seeders;

use App\Models\VisiMisi;
use Illuminate\Database\Seeder;

class VisiMisiSeeder extends Seeder
{
    public function run(): void
    {
        VisiMisi::create([
            'visi' => 'Menjadi puskesmas terdepan dalam pelayanan kesehatan masyarakat yang berkualitas dan terpercaya.',
            'misi' => '<ol><li>Memberikan pelayanan kesehatan yang berkualitas dan terjangkau</li><li>Meningkatkan derajat kesehatan masyarakat</li><li>Mengembangkan SDM kesehatan yang profesional</li><li>Menjalin kerjasama dengan berbagai pihak</li></ol>',
        ]);
    }
}
