@extends('layouts.main')

@section('content')
<style>
    /* Styling for the main section title "UMKM Kecamatan Panggul" */
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

    /* Styles for UMKM product cards */
    .news-card .card {
        border-radius: 12px;
        /* Rounded corners for the card */
        overflow: hidden;
        /* Ensures content respects border-radius */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        /* Soft shadow */
        border: none;
        /* Removes default card border */
        display: flex;
        /* Use flexbox for layout */
        flex-direction: column;
        /* Stack items vertically */
        height: 100%;
        /* Ensure cards take full height of column */
    }

    .news-card .card-img-top {
        height: 200px;
        /* Fixed height for consistent image size */
        object-fit: cover;
        /* Ensures images cover the area without distortion */
        width: 100%;
        transition: transform 0.3s ease-in-out;
        /* Smooth hover effect for the image */
    }

    /* Add hover effect to the image when wrapped in a link */
    .news-card .card-img-top:hover {
        transform: scale(1.05);
        /* Slightly enlarge image on hover */
    }

    .news-card .card-body {
        padding: 1.5rem;
        /* Padding inside the card body */
        flex-grow: 1;
        /* Allows body to grow and push buttons down */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        /* Distribute space for title/price */
    }

    .news-card .card-title {
        font-size: 1.25rem;
        /* Size for product names */
        font-weight: 600;
        margin-bottom: 0.5rem;
        /* Space below title */
        color: #333;
        /* Dark gray for product titles */
        text-align: left;
        /* Keep product title left-aligned */
    }

    .news-card .card-text {
        font-size: 1.1rem;
        /* Size for price */
        color: #555;
        /* Darker gray for price */
        margin-bottom: 1rem;
        /* Space below price */
        text-align: left;
        /* Keep price left-aligned */
    }

    .news-card .btn {
        margin-top: 0.5rem;
        /* Space between buttons and content */
        display: block;
        /* Make buttons take full width */
        width: calc(100% - 2rem);
        /* Account for mx-3 padding */
        text-align: center;
        padding: 0.75rem 1rem;
        border-radius: 0.3rem;
    }

    .news-card .btn-success {
        background-color: #28a745;
        /* Bootstrap green for success */
        border-color: #28a745;
        font-weight: 600;
        color: #fff;
    }

    .news-card .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .news-card .btn-warning {
        background-color: #ffc107;
        /* Bootstrap yellow for warning */
        border-color: #ffc107;
        font-weight: 600;
        color: #212529;
        /* Dark text for contrast */
    }

    .news-card .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
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
        /* Rounded pagination buttons */
        margin: 0 3px;
    }
</style>

<section class="counts section-bg">
    <div class="container">
        <div class="section-title">
            <h2>UMKM Kecamatan Panggul</h2>
        </div>
        <div class="row">
            @foreach ($umkms as $umkm)
            <div class="col-lg-4 col-md-6 mb-3" data-aos="fade-up">
                <div class="count-box news-card">
                    <div class="card">
                        {{-- Wrap the image with an anchor tag to link to the detail page --}}
                        <a href="/umkm/{{ $umkm->slug }}" class="d-block">
                            <img src="{{ asset('storage/' . $umkm->foto) }}" alt="Foto UMKM" class="card-img-top">
                        </a>
                        <div class="card-body">
                            {{-- Consider also making the title clickable for consistency --}}
                            <h5 class="card-title">
                                <a href="/umkm/{{ $umkm->slug }}" style="text-decoration: none; color: inherit;">
                                    <b>{{ $umkm->produk }}</b>
                                </a>
                            </h5>
                            <p class="card-text"><i class="bi bi-tag"></i>&nbsp; Rp {{ number_format($umkm->harga, 0, ',', '.') }}</p>
                        </div>
                        <a class="btn btn-success mx-3 my-1" href="https://wa.me/+62{{ $umkm->no_hp }}" role="button"><i class="bi bi-whatsapp"></i>&nbsp; Hubungi Penjual</a>
                        <a class="btn btn-warning mx-3 mb-3" href="/umkm/{{ $umkm->slug }}" role="button"><i class="bi bi-eye"></i>&nbsp; Detail Produk</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="paginate my-3" style="text-align: center">
            {{ $umkms->links() }}
        </div>
    </div>
</section>
@endsection