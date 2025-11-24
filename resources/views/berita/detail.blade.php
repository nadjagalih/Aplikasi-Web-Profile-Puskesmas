@extends('layouts.main')

@section('content')

<style>
    /* Main News Title (h1) */
    h1 {
        color: #000;
        /* Set the main news title to black */
        text-align: left;
        /* Keep the title left-aligned */
        font-weight: 700;
        /* Bold font weight */
        font-size: 2.2rem;
        /* Larger font size for prominence */
        line-height: 1.3;
        margin-bottom: 1rem;
        /* Space below the title */
    }

    /* Main News Body Content (paragraphs within .card-body) */
    .card-body p {
        text-align: justify;
        /* Justify text (rata kanan-kiri) */
        line-height: 1.8;
        /* Improved readability */
        color: #333;
        /* Dark gray for body text */
        margin-bottom: 1rem;
        /* Space between paragraphs */
    }

    /* Breadcrumbs/Navigation Links */
    .card-body p a {
        color: #007bff;
        /* Bootstrap primary blue for links */
        text-decoration: none;
        /* No underline */
        font-weight: 500;
    }

    .card-body p a:hover {
        text-decoration: underline;
        /* Underline on hover */
    }

    /* News Meta Info (Date, Author, Views) */
    .news-date {
        font-size: 0.9rem;
        /* Smaller font for meta info */
        color: #777;
        /* Lighter gray for meta info */
        margin-bottom: 1.5rem;
        /* Space below this block */
        display: block;
        /* Ensure it takes full width */
    }

    .news-date span {
        display: inline-block;
        /* Allows side-by-side display */
        margin-right: 0.75rem;
        /* Space between each item */
    }

    /* Featured Image */
    .card-body img.img-fluid {
        border-radius: 8px;
        /* Slightly rounded corners */
        margin-bottom: 2rem;
        /* More space below the image */
        object-fit: cover;
        /* Ensures image fills the space and looks good */
    }

    /* Tag Button */
    .btn-secondary.btn-sm {
        background-color: #6c757d;
        /* Bootstrap secondary color */
        border-color: #6c757d;
        color: #fff;
        font-size: 0.8rem;
        padding: 0.25rem 0.75rem;
        border-radius: 0.25rem;
    }

    /* Sidebar - Berita Populer & Kategori */
    .sidebar .card {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        /* Lighter shadow for sidebar cards */
        border-radius: 8px;
        margin-bottom: 1.5rem;
    }

    .sidebar .card-body h4 {
        color: #333;
        /* Dark gray for sidebar headings */
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 1.25rem;
        border-bottom: 1px solid #eee;
        /* Subtle separator */
        padding-bottom: 0.75rem;
    }

    .sidebar .populer-post img {
        border-radius: 4px;
        object-fit: cover;
    }

    .sidebar .populer-post h6 {
        font-size: 0.95rem;
        font-weight: 500;
        line-height: 1.4;
        color: #333;
    }

    .sidebar .populer-post a {
        text-decoration: none;
    }

    .sidebar .populer-post a:hover h6 {
        color: #007bff;
        /* Change color on hover */
    }

    .sidebar ul {
        list-style: none;
        /* Remove default list bullets */
        padding: 0;
        margin: 0;
    }

    .sidebar ul p {
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
    }

    .sidebar ul p i {
        margin-right: 0.5rem;
        color: #666;
    }

    .sidebar ul p a {
        color: #444;
        text-decoration: none;
    }

    .sidebar ul p a:hover {
        color: #007bff;
    }

    /* Overall Section/Container Padding */
    .counts.section-bg {
        padding-top: 3rem;
        padding-bottom: 3rem;
        background-color: #f9fafb;
    }
</style>

<section class="counts section-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-12 mb-5">
                        <div class="card">
                            <div class="card-body">
                                <p>Berita >> <a href="{{ $berita->slug }}">{{ $berita->judul }}</a></p>
                                <h1>{{ $berita->judul }}</h1>

                                <div class="news-date mb-4">
                                    <span class="mr-3"> <i class="bi bi-stopwatch-fill"></i> {{ $berita->created_at->diffForHumans() }}</span> |
                                    <span class="mr-3"><i class="bi bi-person-circle"> {{ $berita->user->name }}</i></span> |
                                    <span><i class="bi bi-fire">Dibaca {{ $berita->views }} Kali</i></span>
                                </div>

                                @if($berita->gambar && file_exists(storage_path('app/public/' . $berita->gambar)))
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Andalan" class="img-fluid rounded mb-5" style="height: 450px; width: 100%; object-fit: cover;">
                                @else
                                    <img src="https://via.placeholder.com/800x450/0d6efd/ffffff?text=Gambar+Tidak+Tersedia" alt="Gambar Andalan" class="img-fluid rounded mb-5" style="height: 450px; width: 100%; object-fit: cover;">
                                @endif
                                <p>{!! $berita->body !!}</p>

                                <i class="bi bi-tags"></i> <a href="#" type="button" class="btn btn-secondary btn-sm my-2">{{ $berita->kategori->kategori }}</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="card">
                        <div class="card-body">
                            <h4>Berita Populer</h4>
                            <div class="populer-post mb-5">
                                @foreach ($beritaPopuler as $berita)
                                <div class="row mt-3">
                                    <div class="col-md-5">
                                        @if($berita->gambar && file_exists(storage_path('app/public/' . $berita->gambar)))
                                            <img src="{{ asset('storage/' . $berita->gambar) }}" width="100%" height="100%" style="border-radius: 5px; object-fit: cover;">
                                        @else
                                            <img src="https://via.placeholder.com/200x150/0d6efd/ffffff?text=No+Image" width="100%" height="100%" style="border-radius: 5px; object-fit: cover;">
                                        @endif
                                    </div>
                                    <div class="col-md-7 mt-2">
                                        <a href="/berita/{{ $berita->slug }}" style="color: inherit;">
                                            <h6>{{ $berita->judul }}</h6>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="card my-3">
                        <div class="card-body">
                            <h4>Kategori</h4>
                            <div class="populer-post mb-5">
                                <div class="row mt-3">
                                    <div class="col">
                                        @foreach ($kategories as $kategori)
                                        <ul>
                                            <p><i class="bi bi-hash"></i> <a href="/kategori/{{ $kategori->slug }}" style="color: inherit;">{{ $kategori->kategori }}</a></p>
                                        </ul>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection