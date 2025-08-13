@extends('layouts.main')

@section('content')

<style>
  /* Styling for the main section title */
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

  /* Styling for the dynamic content ($sejarah->body) */
  .col-lg-10 p {
    text-align: justify;
    /* Makes paragraph text justified (rata kanan-kiri) */
    line-height: 1.8;
    /* Improves readability with more line spacing */
    color: #333;
    /* Sets text color to a dark gray */
    margin-bottom: 1rem;
    /* Space between paragraphs */
  }

  /* Additional styling for other HTML elements that might be in $sejarah->body */
  .col-lg-10 h1,
  .col-lg-10 h2,
  .col-lg-10 h3,
  .col-lg-10 h4,
  .col-lg-10 h5,
  .col-lg-10 h6 {
    color: #333;
    /* Ensures headings within the body are also dark gray */
    text-align: left;
    /* Keeps headings within the body left-aligned */
    margin-top: 1.5rem;
    margin-bottom: 1rem;
  }

  .col-lg-10 ul,
  .col-lg-10 ol {
    text-align: left;
    /* Keeps lists left-aligned */
    margin-left: 20px;
    /* Indents list items */
    margin-bottom: 1rem;
  }

  .col-lg-10 img {
    max-width: 100%;
    /* Ensures images are responsive */
    height: auto;
    /* Maintains aspect ratio */
    display: block;
    /* Prevents extra space below images */
    margin: 1rem auto;
    /* Centers images and adds vertical space */
    border-radius: 8px;
    /* Slightly rounded corners for images */
  }

  /* The .p-3 class from Bootstrap or Tailwind already handles padding */
  /* You can adjust the padding via the class directly in the HTML if needed */
</style>

<section class="counts section-bg">
  <div class="container">
    <div class="section-title">
      <h2>{{ $sejarah->judul }}</h2>
    </div>

    <div class="row">
      <div class="col-lg-10 mx-auto p-3">
        {!! $sejarah->body !!}
      </div>
    </div>
  </div>
</section>

@endsection