@extends('layouts.main')

@section('content')

<style>
    /* Main Anggaran Title (h1) */
    h1 {
        color: #000;
        /* Set the main anggaran title to black */
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

    /* Main Anggaran Body Content (paragraphs within .card-body) */
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

    /* Meta Info (Posted by) */
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

    /* General card and container styling */
    .card {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        /* Subtle shadow for the card */
        border-radius: 10px;
        /* More rounded corners for the card */
        border: none;
        /* Remove default card border */
    }

    .card-body {
        padding: 2rem;
        /* Generous padding inside the card */
    }

    .counts.section-bg {
        padding-top: 3rem;
        /* Top padding for the section */
        padding-bottom: 3rem;
        /* Bottom padding for the section */
        background-color: #f9fafb;
    }
</style>

<section class="counts section-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="row">
                    <div class="col-md-12 mb-5">
                        <div class="card p-3">
                            <div class="card-body">
                                <p><a href="/apbdesa">Anggaran</a> >> <a
                                        href="{{ $anggaran->slug }}">{{ $anggaran->judul }}</a></p>

                                <h1 class="mb-3">{{ $anggaran->judul }}</h1>

                                <div class="news-date mb-4">
                                    <span class="mr-3"><i class="bi bi-person-circle">
                                            Diposting oleh : {{ $anggaran->user->name }}</i></span>
                                </div>

                                <img src="{{ asset('storage/' . $anggaran->gambar) }}" alt="Gambar Andalan"
                                    class="img-fluid rounded mb-5" style="height: 450px; width: 100%;">

                                <p>{!! $anggaran->keterangan !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection