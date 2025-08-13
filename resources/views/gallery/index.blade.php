@extends('layouts.main')

@section('content')

<style>
    /* Styling for the main section title "Galeri Wisata Di Panggul" */
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

    /* Styling for gallery images */
    .img-thumbnail {
        border: 1px solid #ddd;
        /* Subtle border for the thumbnail */
        padding: 4px;
        /* Padding inside the border */
        background-color: #fff;
        /* White background */
        border-radius: 8px;
        /* Rounded corners */
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        /* Light shadow for depth */
        transition: transform 0.2s ease-in-out;
        /* Smooth hover effect */
    }

    .img-thumbnail:hover {
        transform: translateY(-5px);
        /* Lift effect on hover */
    }

    /* Styling for the gallery item captions */
    .text-center.fw-bold {
        color: #000;
        /* Sets the caption text color to black */
        text-align: center;
        /* Ensures the caption is centered */
        font-weight: 600;
        /* Slightly less bold than the main title, but still strong */
        font-size: 1.1rem;
        /* Good size for captions */
        margin-top: 0.75rem;
        /* Space between image and caption */
    }

    /* Styling for pagination links */
    .paginate .pagination {
        justify-content: center;
        /* Centers the pagination links */
        margin-top: 2rem;
        /* Space above pagination */
    }

    .paginate .page-link {
        border-radius: 5px;
        /* Slightly rounded pagination buttons */
        margin: 0 3px;
    }

    /* General section padding and background */
    .counts.section-bg {
        padding-top: 3rem;
        padding-bottom: 3rem;
        background-color: #f9fafb;
    }
</style>

<section class="counts section-bg">
    <div class="section-title">
        <h2>Galeri Wisata Di Panggul</h2>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($galerrys as $gallery)
            <div class="col-lg-3 mb-4">
                <a href="{{ route('galeri.show', $gallery->id) }}" style="text-decoration: none; color: inherit;">
                    <picture>
                        <img src="{{ asset('storage/' . $gallery->gambar) }}" class="img-fluid img-thumbnail"
                            alt="Gallery" style="width: 100%; height: 200px; object-fit: cover;">
                        <p class="mt-2 text-center fw-bold">{{ $gallery->keterangan }}</p>
                    </picture>
                </a>
            </div>
            @endforeach
        </div>
        <div class="paginate my-3 text-center">
            {{ $galerrys->links() }}
        </div>
    </div>
</section>
@endsection