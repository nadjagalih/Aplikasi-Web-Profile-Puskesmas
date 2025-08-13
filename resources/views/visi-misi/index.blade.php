@extends('layouts.main')

@section('content')

<style>
    /* Styling for the main section title "Visi & Misi" */
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

    /* Styling for the Visi and Misi sub-headings */
    .visi-misi h4 {
        color: #333;
        /* Dark gray color for sub-headings */
        text-align: left;
        /* Keep sub-headings left-aligned */
        font-weight: 600;
        /* Slightly less bold than main title */
        font-size: 1.5rem;
        /* Appropriate size for sub-headings */
        margin-top: 2rem;
        /* Space above each section (Visi/Misi) */
        margin-bottom: 0.75rem;
        /* Space below sub-heading */
    }

    /* Styling for the Visi and Misi content paragraphs */
    .visi-misi p {
        text-align: justify;
        /* Makes paragraph text justified (rata kanan-kiri) */
        line-height: 1.8;
        /* Improves readability with more line spacing */
        color: #333;
        /* Sets text color to a dark gray */
        margin-bottom: 1rem;
        /* Space between paragraphs (if any within visi/misi) */
    }

    /* General styling for the container and spacing */
    .counts.section-bg {
        padding-top: 4rem;
        /* Top padding for the section */
        padding-bottom: 4rem;
        /* Bottom padding for the section */
        background-color: #f9fafb;
        /* Consistent background color */
    }

    .col-lg-10 {
        /* General styling for the content column */
        margin-top: 1.5rem;
        /* Space below main title before content starts */
    }
</style>

<section class="counts section-bg">
    <div class="container">
        <div class="section-title">
            <h2>Visi & Misi</h2>
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto p-3">
                <div class="visi-misi">
                    <div class="visi mb-3">
                        <h4>Visi</h4>
                        <p>{!! $visiMisi->visi !!}</p>
                    </div>
                    <div class="misi mb-3">
                        <h4>Misi</h4>
                        <p>{!! $visiMisi->misi !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection