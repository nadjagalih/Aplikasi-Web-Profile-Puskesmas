@extends('layouts.main')

@section('content')

<style>
  /* Styling for the main section title "Perangkat Kecamatan Panggul" */
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

  /*
     * No other styles are explicitly changed here as per your request.
     * Ensure any existing styles for .member, .pic, .member-info, etc.,
     * are defined elsewhere in your CSS (e.g., in layouts/main.blade.php
     * or a separate CSS file) if they are not already.
     */
</style>

<section class="counts section-bg">
  <div class="container">

    <div class="section-title">
      <h2>Perangkat Kecamatan Panggul</h2>
    </div>

    <div class="row">
      @foreach ($perangkatDesa as $perangkat)
      <div class="col-xl-3 my-3" data-aos="fade-up">
        <div class="member">
          <div class="pic"><img src="{{ asset('storage/' . $perangkat->foto) }}" class="img-fluid" alt=""></div>
          <div class="member-info">
            <h4>{{ $perangkat->nama }}</h4>
            <span>{{ $perangkat->jabatan }}</span>
          </div>
        </div>
      </div>
      @endforeach
    </div>

  </div>
</section>
@endsection