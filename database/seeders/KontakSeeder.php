<?php

namespace Database\Seeders;

use App\Models\Kontak;
use Illuminate\Database\Seeder;

class KontakSeeder extends Seeder
{
    public function run(): void
    {
        Kontak::create([
            'alamat' => 'Jl. Kesehatan No. 123, Kota Sehat, 12345',
            'telepon' => '(021) 12345678',
            'email' => 'info@puskesmas-sehatsentosa.id',
            'fax' => '(021) 87654321',
            'maps' => '<iframe src="https://www.google.com/maps/embed?pb=..." width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>',
        ]);
    }
}
