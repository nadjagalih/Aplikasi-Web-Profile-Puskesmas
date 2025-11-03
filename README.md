<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Website Sistem Informasi Puskesmas



Website Sistem Informasi Puskesmas adalah sebuah website yang dibangun menggunakan framework Laravel. Website ini dapat digunakan oleh puskesmas untuk mengelola berbagai informasi layanan kesehatan, kegiatan puskesmas, artikel kesehatan, dan layanan kepada masyarakat. Website ini dikembangkan sebagai pengganti website PKM Suruh (https://pkm-suruh.trenggalekkab.go.id/). Berikut adalah beberapa fitur dan komponen utama yang ada dalam aplikasi berbasis web Laravel ini:


###
composer install
npm install
npm run build

# Fitur Utama
1. **Beranda/Landing Page**
   - Slider informasi
   - Sambutan Kepala Puskesmas
   - Berita & Kegiatan Terbaru
   - Survei Kepuasan Masyarakat (SKM)
   
2. **Profil Puskesmas**
   - Sambutan Kepala Puskesmas
   - Sejarah Puskesmas
   - Visi & Misi
   - Struktur Organisasi
   - Data Tenaga Medis (Dokter, Perawat, Bidan, dll)
   - Poliklinik & Fasilitasi
   - Lokasi & Peta Puskesmas
   
3. **Layanan Kesehatan**
   - Informasi Layanan Kesehatan
   - Jadwal Praktek Dokter
   - Alur Pelayanan
   - Persyaratan Layanan
   
4. **Berita & Informasi**
   - Berita Kesehatan
   - Kegiatan Puskesmas
   - Pengumuman
   - Artikel Kesehatan
   - Gallery Kegiatan
   
5. **Data & Statistik**
   - Survei Kepuasan Masyarakat (SKM)
   - Data Kunjungan Pasien
   - Grafik & Statistik Kesehatan
   
6. **Kontak & Pengaduan**
   - Informasi Kontak
   - Form Pengaduan Online
   - Lokasi Maps



## Teknologi

Aplikasi Sistem Informasi Puskesmas dibangun menggunakan beberapa Teknologi diantaranya :

- Laravel - The PHP Framework for Web Artisans
- JavaScript - JavaScript, often abbreviated as JS, is a programming language that is one of the core technologies of the World Wide Web, alongside HTML and CSS.
- Bootstrap - Bootstrap is a free and open-source CSS framework directed at responsive, mobile-first front-end web development. 



## Installasi

Lakukan Clone Project/Unduh manual .

Aktifkan Xampp Control Panel, lalu akses ke http://localhost/phpmyadmin/.

Buat database dengan nama 'DESA-LARAVEL' atau gunakan database yang sudah ada.

Jika melakukan Clone Project, rename file .env.example dengan env dan hubungkan
database nya dengan mengisikan nama database, 'DB_DATABASE=DESA-LARAVEL'.


Kemudian, Ketik pada terminal :
```sh
php artisan migrate
```

Lalu ketik juga

```sh
php artisan migrate:fresh --seed
```

Jalankan aplikasi 

```sh
php artisan serve
```

Akses Aplikasi di Web browser 
```sh
127.0.0.1:8000
```

Demo Login :
1. Admin
    - email     : admin@gmail.com
    - password  : rahasia123
