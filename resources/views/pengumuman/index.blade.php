@extends('layouts.main')

@section('content')

<style>
    /* Styling for the main section title "Pengumuman" */
    .section-title h2 {
        color: #000;
        /* Sets the title color to black */
        text-align: center;
        /* Keeps the main section title centered */
        font-weight: 700;
        /* Bold font weight */
        font-size: 2rem;
        /* Font size for the title */
        margin-bottom: 1.5rem;
        /* Space below the title */
    }

    /* Styling for the announcement cards */
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Subtle shadow for cards */
        border-radius: 8px;
        /* Rounded corners for cards */
        border: none;
        /* Remove default card border if present */
    }

    /* Styling for the announcement card body */
    .card-body {
        padding: 1.5rem;
        /* Adjust padding inside the card */
    }

    /* Styling for the announcement title within the card */
    .card-title {
        font-size: 1.25rem;
        /* Size for announcement titles */
        color: #333;
        /* Dark gray for announcement titles */
        margin-bottom: 0.75rem;
        /* Space below card title */
    }

    /* Styling for the excerpt/paragraph text in announcements */
    .card-body p {
        text-align: justify;
        /* Makes paragraph text justified (rata kanan-kiri) */
        line-height: 1.8;
        /* Improves readability with more line spacing */
        color: #555;
        /* Slightly lighter gray for body text */
        margin-top: 1rem;
        /* Space above excerpt text */
    }

    /* Styling for the "Selengkapnya" link */
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

    /* Styling for the date/time information */
    .card-body span {
        font-size: 0.85rem;
        /* Smaller font for date/time */
        color: #777;
        /* Lighter gray for date/time */
        display: block;
        /* Ensures it takes full width and new line */
    }

    /* Styling for pagination links */
    .paginate .pagination {
        justify-content: center;
        /* Centers the pagination links */
        margin-top: 2rem;
    }

    .paginate .page-link {
        border-radius: 5px;
        /* Slightly rounded pagination buttons */
        margin: 0 3px;
    }
</style>

<section class="counts section-bg">
    <div class="section-title">
        <h2>Pengumuman</h2>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($pengumumans as $pengumuman)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body p-3">
                        <h5 class="card-title mb-3"><b>{{ $pengumuman->judul }}</b></h5>
                        <span><i class="bi bi-stopwatch-fill"></i>
                            {{ $pengumuman->created_at->diffForHumans() }}</span>
                        <p class="mt-3">{!! $pengumuman->excerpt !!} <a
                                href="/pengumuman/{{ $pengumuman->slug }}">Selengkapnya</a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="paginate my-3" style="text-align: center">
            {{ $pengumumans->links() }}
        </div>
    </div>
</section>
@endsection