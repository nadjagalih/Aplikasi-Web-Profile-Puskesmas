@extends('layouts.main')

@section('title', 'Struktur Organisasi')

@section('content')

<style>
  /* Styling for the main section title */
  .section-title h2 {
    color: #000;
    text-align: center;
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 1.5rem;
  }

  .counts.section-bg {
    padding: 4rem 0;
    background-color: #f9fafb;
  }

  /* Card styling for image display */
  .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
  }
</style>

<section class="counts section-bg">
  <div class="container">

    <div class="section-title" data-aos="fade-up">
      <h2>Struktur Organisasi Puskesmas</h2>
      <p class="text-muted">Susunan Kepegawaian dan Struktur Organisasi Puskesmas</p>
    </div>

    @if($gambarStruktur && $gambarStruktur->gambar_struktur)
      {{-- Tampilan Gambar Struktur Organisasi --}}
      <div class="row justify-content-center" data-aos="fade-up">
        <div class="col-lg-10 col-xl-9">
          <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
              <div class="text-center">
                <img src="{{ asset('storage/' . $gambarStruktur->gambar_struktur) }}" 
                     class="img-fluid rounded" 
                     alt="Struktur Organisasi Puskesmas"
                     style="max-width: 100%; height: auto;">
              </div>
            </div>
          </div>
        </div>
      </div>
    @else
      {{-- Tampilan jika belum ada gambar --}}
      <div class="row justify-content-center" data-aos="fade-up">
        <div class="col-lg-8">
          <div class="alert alert-info text-center py-5">
            <i class="bi bi-info-circle" style="font-size: 3rem;"></i>
            <h5 class="mt-3 mb-2"><strong>Informasi</strong></h5>
            <p class="mb-0">Gambar struktur organisasi belum tersedia. Silakan hubungi administrator.</p>
          </div>
        </div>
      </div>
    @endif

  </div>
</section>
@endsection