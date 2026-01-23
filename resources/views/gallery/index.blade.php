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
        <h2>Album Galeri Puskesmas</h2>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($albums as $album)
            <div class="col-lg-3 mb-4">
                <a href="{{ route('galeri.show', $album->id) }}" style="text-decoration: none; color: inherit;">
                    <div class="position-relative">
                        <img src="{{ asset('storage/' . $album->cover_image) }}" class="img-fluid img-thumbnail"
                            alt="{{ $album->judul }}" style="width: 100%; height: 200px; object-fit: cover;">
                        <div class="position-absolute bottom-0 start-0 w-100 p-2" 
                             style="background: rgba(0,0,0,0.6); color: white;">
                            <small><i class="bi bi-images"></i> {{ $album->images->count() }} foto</small>
                        </div>
                    </div>
                    <p class="mt-2 text-center fw-bold">{{ $album->judul }}</p>
                    @if($album->deskripsi)
                        <p class="text-center text-muted small">{{ Str::limit($album->deskripsi, 60) }}</p>
                    @endif
                </a>
            </div>
            @endforeach
        </div>
        <div class="paginate my-3 text-center">
            {{ $albums->links() }}
        </div>
    </div>
</section>
@endsection