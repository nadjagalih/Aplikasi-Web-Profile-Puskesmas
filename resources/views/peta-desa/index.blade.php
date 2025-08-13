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

  /* Additional styling for the map container for better visual presentation */
  .col-lg-10.mx-auto.p-3 {
    /* You might want to add a box-shadow or border to the map frame */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    /* Subtle shadow for the map */
    border-radius: 8px;
    /* Slightly rounded corners for the map container */
    overflow: hidden;
    /* Ensures anything extending beyond the border-radius is clipped */
  }

  /* Ensure the iframe itself takes full width of its parent and has appropriate height */
  #gmap_canvas {
    display: block;
    /* Removes extra space below the iframe */
    border: none;
    /* Removes default iframe border */
  }
</style>

<section class="counts section-bg">
  <div class="container">

    <div class="section-title">
      <h2>{{ $petaDesa->judul }}</h2>
    </div>

    <div class="row">
      <div class="col-lg-10 mx-auto p-3">
        {{-- The iframe's src needs to be corrected if it's meant to be a direct Google Maps embed --}}
        {{-- The provided URL structure `https://maps.google.com/maps?width=520&height=400&hl=en&q=` looks incorrect for standard Google Maps embeds. --}}
        {{-- It should typically be `https://maps.google.com/maps?q=...` --}}
        <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas"
          src="https://maps.google.com/maps?q={{ urlencode($petaDesa->alamat) }}&t=h&z=13&ie=UTF8&iwloc=B&output=embed"></iframe>
      </div>
    </div>
  </div>
</section>
@endsection