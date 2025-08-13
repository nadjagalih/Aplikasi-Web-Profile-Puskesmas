@extends('layouts.main')

@section('content')
<style>
    /* Styling for the main section title "Anggaran Kecamatan" */
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

    /* Styles for Anggaran Section cards */
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
    }

    .news-card .card-body {
        padding: 1.5rem;
        /* Padding inside the card body */
        flex-grow: 1;
        /* Allows body to grow and push footer down */
        display: flex;
        flex-direction: column;
        justify-content: center;
        /* Vertically center content if space allows */
    }

    .news-card .card-title {
        font-size: 1.25rem;
        /* Size for anggaran titles */
        font-weight: 600;
        margin-bottom: 0;
        /* No bottom margin, as button is separate */
        color: #333;
        /* Dark gray for anggaran titles */
        text-align: center;
        /* Center the title within the card */
    }

    .news-card .btn.btn-primary {
        background-color: #007bff;
        /* Bootstrap primary blue */
        border-color: #007bff;
        font-weight: 600;
        margin-top: auto;
        /* Pushes the button to the bottom */
        display: block;
        /* Make button take full width in card-footer */
        width: calc(100% - 2rem);
        /* Account for mx-3 padding */
        text-align: center;
        padding: 0.75rem 1rem;
        border-radius: 0.3rem;
    }

    .news-card .btn.btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
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
            <h2>Anggaran Kecamatan</h2>
        </div>
        <div class="row">
            @foreach ($anggarans as $anggaran)
            <div class="col-lg-4 col-md-6 mb-3" data-aos="fade-up">
                <div class="count-box news-card">
                    <div class="card">
                        <img src="{{ asset('storage/' . $anggaran->gambar) }}" alt="gambar anggaran"
                            class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><b>{{ $anggaran->judul }}</b></h5>
                        </div>
                        <a class="btn btn-primary mx-3 mb-3" href="/apbdesa/{{ $anggaran->slug }}" role="button"><i
                                class="bi bi-eye"></i>&nbsp; Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="paginate my-3" style="text-align: center">
            {{ $anggarans->links() }}
        </div>
    </div>
</section>
@endsection