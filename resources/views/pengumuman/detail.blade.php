@extends('layouts.main')

@section('content')

<style>
    /* Styling for the announcement title on the detail page */
    h1.mb-3 {
        color: #000;
        /* Sets the title color to black */
        text-align: left;
        /* Keeps the title left-aligned on the detail page */
        font-weight: 700;
        /* Bold font weight */
        font-size: 2.2rem;
        /* Slightly larger font size for the main title */
        line-height: 1.3;
    }

    /* Styling for the main content paragraph (isi_pengumuman) */
    .card-body p {
        text-align: justify;
        /* Makes paragraph text justified (rata kanan-kiri) */
        line-height: 1.8;
        /* Improves readability with more line spacing */
        color: #333;
        /* Sets text color to a dark gray */
        margin-bottom: 1rem;
        /* Space between paragraphs */
    }

    /* Styling for the breadcrumbs/navigation links */
    .card-body p a {
        color: #007bff;
        /* Bootstrap primary blue color for links */
        text-decoration: none;
        /* Remove underline */
        font-weight: 500;
    }

    .card-body p a:hover {
        text-decoration: underline;
        /* Underline on hover for links */
    }

    /* Styling for the news date/author/views info */
    .news-date {
        font-size: 0.9rem;
        /* Smaller font for meta info */
        color: #777;
        /* Lighter gray for meta info */
        margin-bottom: 1.5rem;
        /* Space below this block */
    }

    .news-date span {
        display: inline-block;
        /* Allows spacing between elements */
        margin-right: 0.75rem;
        /* Space between each item */
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
        /* Consistent background color */
    }
</style>

<section class="counts section-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="row">
                    <div class="col-md-12 mb-5">
                        <div class="card p-3"> {{-- The p-3 here applies Bootstrap padding --}}
                            <div class="card-body">
                                <p><a href="/pengumuman">Pengumuman</a> >> <a
                                        href="{{ $pengumuman->slug }}">{{ $pengumuman->judul }}</a></p>

                                <h1 class="mb-3">{{ $pengumuman->judul }}</h1>

                                <div class="news-date mb-4">
                                    <span class="mr-3"> <i class="bi bi-stopwatch-fill"></i>
                                        {{ $pengumuman->created_at->diffForHumans() }}</span> |
                                    <span class="mr-3"><i class="bi bi-person-circle">
                                            {{ $pengumuman->user->name }}</i></span> |
                                    <span><i class="bi bi-fire">Dibaca {{ $pengumuman->views }} Kali</i></span>
                                </div>

                                {{-- This paragraph tag directly wraps the dynamic content --}}
                                <p>{!! $pengumuman->isi_pengumuman !!}</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection