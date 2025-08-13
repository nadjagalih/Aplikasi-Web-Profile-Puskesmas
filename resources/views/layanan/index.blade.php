@extends('layouts.main')

@section('content')

<style>
    /* Styling for the main section title "Layanan Kecamatan Panggul" */
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

    /* Styling for the accordion items */
    .accordion-item {
        border: 1px solid rgba(0, 0, 0, 0.125);
        /* Default Bootstrap border */
        border-radius: 0.25rem;
        /* Default Bootstrap border-radius */
        margin-bottom: 1rem;
        /* Space between accordion items */
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        /* Subtle shadow */
    }

    .accordion-button {
        font-weight: 600;
        /* Bold for the service name */
        color: #333;
        /* Dark gray for service names */
        background-color: #f8f9fa;
        /* Light background for button */
        padding: 1rem 1.25rem;
    }

    .accordion-button:not(.collapsed) {
        color: #007bff;
        /* Blue color when expanded */
        background-color: #e9f5ff;
        /* Lighter blue background when expanded */
        box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.125);
    }

    .accordion-body {
        padding: 1.25rem;
        /* Padding inside the accordion body */
        color: #444;
        /* Darker gray for content */
    }

    /* Styling for the content within the accordion body (persyaratan) */
    .accordion-body p {
        text-align: justify;
        /* Justify text for the requirements */
        line-height: 1.8;
        /* Improve readability */
        margin-bottom: 1rem;
        /* Space between paragraphs if multiple */
    }

    .accordion-body ul,
    .accordion-body ol {
        text-align: justify;
        /* Justify lists as well */
        margin-left: 1.5rem;
        /* Indent lists */
        margin-bottom: 1rem;
        line-height: 1.8;
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
        <h2>Layanan Kecamatan Panggul</h2>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($layanans as $layanan)
            <div class="col-lg-4">
                <div class="accordion" id="accordionExample{{ $layanan->id }}">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $layanan->id }}" aria-expanded="true"
                                aria-controls="collapse{{ $layanan->id }}">
                                {{ $layanan->layanan }}
                            </button>
                        </h2>
                        <div id="collapse{{ $layanan->id }}" class="accordion-collapse collapse show"
                            data-bs-parent="#accordionExample{{ $layanan->id }}">
                            <div class="accordion-body">
                                {!! $layanan->persyaratan !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection