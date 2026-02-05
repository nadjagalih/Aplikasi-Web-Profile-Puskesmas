<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            KategoriSeeder::class,
            PostStatusSeeder::class,
            BeritaSeeder::class,
            AnnouncementSeeder::class,
            SliderSeeder::class,
            GallerySeeder::class,
            ProfilSeeder::class,
            VisiMisiSeeder::class,
            StrukturOrganisasiSeeder::class,
            KontakSeeder::class,
            SitusSeeder::class,
            MenuSeeder::class,
            PageSeeder::class,
            AgendaSeeder::class,
            AlbumSeeder::class,
            AlbumImageSeeder::class,
            AlurPelayananSeeder::class,
            BerkasSeeder::class,
            LayananSeeder::class,
            SambutanSeeder::class,
            GambarStrukturOrganisasiSeeder::class,
            SkmConfigSeeder::class,
        ]);
    }
}
