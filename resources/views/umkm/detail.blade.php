@extends('layouts.main')

@section('content')
<style>
    /* Styling for the main section title "Detail Produk" */
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

    /* Styling for the product title within the card */
    .card-body h2.card-title {
        color: #000;
        /* Sets the product title to black */
        font-weight: 700;
        /* Bold font weight */
        font-size: 2.2rem;
        /* Larger font size for prominence */
        margin-bottom: 1.5rem;
        /* Space below the title */
    }

    /* Styling for the product description */
    .card-body td:last-child {
        text-align: justify;
        /* Justify text for the description */
        line-height: 1.8;
        /* Improve readability */
        color: #333;
        /* Dark gray color for the description text */
    }

    /* General card styling */
    .card {
        border-radius: 12px;
        /* Rounded corners for the card */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        /* Soft shadow */
        border: none;
        /* Remove default card border */
    }

    /* Styling for the product image */
    .card img {
        border-radius: 8px;
        /* Rounded corners for the image */
        object-fit: cover;
        /* Ensures image fills the space nicely */
        width: 100%;
        /* Ensure image takes full width of its container */
        height: 400px;
        /* Set a consistent height for the image */
        display: block;
        /* Remove extra space below image */
        margin-bottom: 2rem;
        /* Add space below the image */
    }

    /* Table styling */
    .table {
        margin-bottom: 1.5rem;
        /* Space below the table */
    }

    .table td {
        padding: 0.75rem;
        /* Padding for table cells */
        vertical-align: top;
        /* Align content to the top */
        border-top: none;
        /* Remove default table top border */
    }

    .table td:first-child {
        font-weight: 600;
        /* Bold for labels like 'Harga', 'Deskripsi' */
        color: #555;
        width: 100px;
        /* Give a fixed width to the label column */
    }

    /* Styling for the WhatsApp button */
    .btn-success {
        background-color: #28a745;
        /* Bootstrap green for success */
        border-color: #28a745;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 0.3rem;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    /* General section padding and background */
    .counts.section-bg {
        padding-top: 3rem;
        padding-bottom: 3rem;
        background-color: #f9fafb;
    }
</style>

<section class="counts section-bg">
    <div class="container">
        <div class="section-title">
            <h2>Detail Produk</h2>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-4"> {{-- Changed p-4 from row to card-body for unified padding --}}
                        <div class="text-center mb-4"> {{-- Centering image with text-center utility --}}
                            <img src="{{ asset('storage/' . $umkm->foto) }}" alt="Gambar produk" class="img-fluid">
                        </div>

                        <h2 class="card-title text-center"><b>{{ $umkm->produk }}</b></h2> {{-- Centered product title --}}

                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Harga</td>
                                    <td>:</td>
                                    <td>Rp. {{ number_format($umkm->harga, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td>:</td>
                                    <td>{!! $umkm->deskripsi !!}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="text-center"> {{-- Centering the button --}}
                            <a href="https://wa.me/+62{{ $umkm->no_hp }}" class="btn btn-success mt-3" role="button"><i class="bi bi-whatsapp"></i> Hubungi Penjual</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection