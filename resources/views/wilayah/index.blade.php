@extends('layouts.main')

@section('content')

<style>
    /* Styling untuk judul section */
    .section-title h2 {
        color: #000;
        /* Warna hitam untuk judul */
        text-align: center;
        /* Tetap rata tengah untuk judul utama section */
        font-weight: 700;
        /* Ketebalan font */
        font-size: 2rem;
        /* Ukuran font judul */
        margin-bottom: 1.5rem;
        /* Jarak bawah judul */
    }

    /* Styling untuk konten dinamis dari $wilayah->body */
    .col-lg-10 p {
        text-align: justify;
        /* Deskripsi rata kanan-kiri (justified) */
        line-height: 1.8;
        /* Tinggi baris untuk keterbacaan */
        color: #333;
        /* Warna teks deskripsi, abu-abu gelap */
        margin-bottom: 1rem;
        /* Jarak antar paragraf */
    }

    /* Styling tambahan untuk elemen HTML yang mungkin ada di $wilayah->body */
    .col-lg-10 h1,
    .col-lg-10 h2,
    .col-lg-10 h3,
    .col-lg-10 h4,
    .col-lg-10 h5,
    .col-lg-10 h6 {
        color: #333;
        /* Pastikan judul di dalam body juga gelap */
        text-align: left;
        /* Judul di dalam body tetap rata kiri */
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }

    .col-lg-10 ul,
    .col-lg-10 ol {
        text-align: left;
        /* Daftar tetap rata kiri */
        margin-left: 20px;
        margin-bottom: 1rem;
    }

    .col-lg-10 img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 1rem auto;
        /* Pusatkan gambar jika ingin */
        border-radius: 8px;
    }
</style>

<section class="counts section-bg">
    <div class="container">
        <div class="section-title">
            <h2>{{ $wilayah->judul }}</h2>
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                {!! $wilayah->body !!}
            </div>
        </div>
    </div>
</section>

@endsection