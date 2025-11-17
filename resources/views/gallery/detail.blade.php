@extends('layouts.main')

@section('content')

<style>
    /* Styling for the main section title "Detail Galeri Wisata" */
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

    /* Styling for the image and its caption (optional, but good for consistency) */
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
        /* Light shadow */
    }

    .fw-bold {
        color: #333;
        /* Dark gray for the caption text */
        font-size: 1.1rem;
        /* Slightly larger font for readability */
        margin-top: 1.5rem;
        /* Space above the caption */
        margin-bottom: 1.5rem;
        /* Space below the caption */
    }

    /* Styling for the "Kembali" button */
    .btn-primary {
        background-color: #007bff;
        /* Bootstrap primary blue */
        border-color: #007bff;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 0.3rem;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
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
        <h2>Detail Galeri</h2>
    </div>
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <img src="{{ asset('storage/' . $gallery->gambar) }}" alt="Galeri Detail"
                    class="img-fluid img-thumbnail"
                    style="width: 100%; max-height: 500px; object-fit: cover;">
                <p class="mt-3 fw-bold">{{ $gallery->keterangan }}</p>
                <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">← Kembali</a>
            </div>
        </div>
    </div>
</section>
@endsection