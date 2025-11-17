@extends('layouts.main')

@section('content')

@if(config('app.env') !== 'production')
<!-- Tailwind CDN for Development Only -->
<script src="https://cdn.tailwindcss.com"></script>
@endif
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

  :root {
    --primary-color: #007bff;
    --primary-dark: #0056b3;
    --secondary-color: #17a2b8;
    --accent-color: #007bff;
    --text-dark: #2c3e50;
    --text-light: #6c757d;
    --bg-light: #f8f9fa;
    --bg-white: #ffffff;
  }

  html,
  body {
    height: 99%;
    margin: 0;
    padding: 0;
  }

  body {
    font-family: 'Poppins', sans-serif;
    background-color: var(--bg-light);
    color: var(--text-dark);
  }

  /* Container with side spacing like Puskesmas Setiabudi */
  section .container {
    max-width: 1320px;
    padding-left: 2rem;
    padding-right: 2rem;
    margin-left: auto;
    margin-right: auto;
  }

  @media (max-width: 768px) {
    section .container {
      padding-left: 1rem;
      padding-right: 1rem;
    }
  }

  /* Section Titles */
  .section-title {
    text-align: center;
    margin-bottom: 3rem;
  }

  .section-title h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
    position: relative;
    display: inline-block;
  }

  .section-title h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    border-radius: 2px;
  }

  .section-title p {
    font-size: 1.1rem;
    color: var(--text-light);
    margin-top: 1rem;
  }

  /* Button Styles - Simple like Puskesmas Setiabudi */
  .btn-view-all {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: transparent;
    color: var(--primary-color);
    border: 2px solid var(--primary-color);
    padding: 0.65rem 1.75rem;
    font-weight: 600;
    font-size: 0.95rem;
    border-radius: 5px;
    text-decoration: none;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .btn-view-all:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.25);
  }

  .btn-view-all i {
    font-size: 1rem;
    transition: transform 0.3s ease;
  }

  .btn-view-all:hover i {
    transform: translateX(3px);
  }

  /* Berita Card Styles - Puskesmas Setiabudi Style */
  .berita-card {
    background: white;
    border-radius: 0;
    overflow: hidden;
    box-shadow: none;
    border: 1px solid #e0e0e0;
    height: 100%;
    display: flex;
    flex-direction: column;
  }

  .berita-image-wrapper {
    position: relative;
    height: 280px;
    overflow: hidden;
    border-radius: 0;
  }

  .berita-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .berita-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255, 255, 255, 0.95);
    color: #333;
    padding: 0.4rem 1rem;
    border-radius: 25px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    z-index: 3;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }

  .berita-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
    z-index: 2;
    transition: background 0.3s ease;
  }

  .berita-card:hover .berita-overlay {
    background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.8) 100%);
  }

  .berita-meta {
    display: flex;
    justify-content: space-between;
    padding: 1rem 1.5rem;
    background: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
  }

  .meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8rem;
    color: #666;
  }

  .meta-item i {
    color: var(--primary-color);
    font-size: 0.9rem;
  }

  .berita-content {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
  }

  .berita-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1rem;
    line-height: 1.4;
  }

  .berita-title a {
    color: var(--text-dark);
    text-decoration: none;
    transition: color 0.3s ease;
  }

  .berita-title a:hover {
    color: var(--primary-color);
  }

  .berita-description {
    font-size: 0.9rem;
    color: var(--text-light);
    line-height: 1.6;
    margin-bottom: 1.5rem;
    flex-grow: 1;
  }

  .btn-baca {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--primary-color);
    font-weight: 700;
    font-size: 0.85rem;
    text-decoration: none;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
  }

  .btn-baca:hover {
    gap: 0.75rem;
    color: var(--primary-dark);
  }

  .btn-baca i {
    transition: transform 0.3s ease;
  }

  .btn-baca:hover i {
    transform: translateX(3px);
  }

  /* Sambutan Section */
  #sambutan {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    padding: 5rem 0;
  }

  #sambutan .sambutan-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    padding: 0;
  }

  #sambutan .sambutan-image {
    position: relative;
    height: 100%;
    min-height: 450px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    background: #f8f9fa;
  }

  #sambutan .sambutan-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    border-radius: 8px;
  }

  #sambutan .sambutan-content {
    padding: 3rem;
  }

  #sambutan .sambutan-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
  }

  #sambutan .sambutan-position {
    font-size: 1.1rem;
    color: var(--primary-color);
    font-weight: 600;
    margin-bottom: 1.5rem;
  }

  #sambutan .sambutan-text {
    font-size: 1rem;
    color: var(--text-light);
    line-height: 1.8;
    text-align: justify;
  }

  @media (max-width: 991px) {
    #sambutan .sambutan-image {
      min-height: 350px;
      padding: 1.5rem;
    }
    
    #sambutan .sambutan-content {
      padding: 2rem;
    }
  }

  @media (max-width: 767px) {
    #sambutan .sambutan-image {
      min-height: 300px;
      padding: 1rem;
    }
  }

  .skm-summary-box {
    background-color: #ffffff;
    /* White background */
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    /* Soft shadow */
    padding: 2.5rem 2rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1.5rem;
    /* Space between elements */
  }

  .skm-score-circle {
    width: 120px;
    /* Diameter */
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    /* Blue gradient */
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2.5rem;
    /* For score number */
    font-weight: 700;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    /* Shadow for the circle */
  }

  .skm-score-circle span {
    display: block;
    /* Ensure score number is on its own line */
  }

  .skm-progress-indicator {
    height: 8px;
    /* Thinner progress bar */
    border-radius: 4px;
    background-color: #e0e0e0;
    overflow: hidden;
    width: 100%;
  }

  .skm-progress-fill {
    height: 100%;
    border-radius: 4px;
    background: linear-gradient(90deg, #28a745 0%, #218838 100%);
    /* Green gradient for fill */
    transition: width 0.5s ease-out;
    width: var(--skm-progress-width, 0%);
    /* Variabel CSS untuk lebar */
  }

  /* Specific styles for SKM Detail Cards */
  .skm-detail-card {
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  .skm-detail-card-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
  }

  .skm-detail-card-header i {
    font-size: 1.8rem;
    color: #007bff;
    /* Blue icon */
  }

  .skm-detail-card-header h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #343a40;
  }

  .skm-data-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
  }

  .skm-data-item span:first-child {
    font-size: 0.9rem;
    color: #6c757d;
  }

  .skm-data-item span:last-child {
    font-size: 0.95rem;
    font-weight: 500;
    color: #343a40;
  }

  .skm-icon-square {
    width: 45px;
    height: 45px;
    border-radius: 8px;
    background-color: #e6f2ff;
    /* Light blue background for icon square */
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .skm-icon-square i {
    font-size: 1.5rem;
    color: #007bff;
    /* Blue color for icons */
  }

  .skm-total-box {
    background-color: #f8f9fa;
    /* Light gray background */
    border-radius: 8px;
    padding: 1rem;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }

  .skm-total-box .number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #343a40;
    margin-top: 0.5rem;
  }

  .skm-total-box .label {
    font-size: 0.8rem;
    color: #6c757d;
    margin-top: 0.25rem;
  }

  .skm-total-box .sub-label {
    font-size: 0.7rem;
    color: #adb5bd;
  }

  /* Button Isi Survey */
  .btn-isi-survey {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: #17a2b8;
    color: white;
    padding: 0.75rem 2rem;
    font-weight: 600;
    font-size: 0.95rem;
    border-radius: 5px;
    text-decoration: none;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
  }

  .btn-isi-survey:hover {
    background: #138496;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(23, 162, 184, 0.4);
  }

  .btn-isi-survey i {
    font-size: 1.1rem;
  }

  /* --- END SKM Section Styles --- */


  /* --- START HERO Section Styles --- */
  #hero {
    width: 100%;
    height: calc(90vh - 0px);
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding: 0;
    margin-top: 0;
  }

  #hero .hero-container {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
  }

  #heroCarousel.carousel {
    width: 100%;
    height: 100%;
  }

  #hero .carousel-inner {
    width: 100%;
    height: 100%;
  }

  #hero .carousel-item {
    width: 100%;
    height: 100%;
    position: relative;
  }

  #hero .carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
  }

  #hero .carousel-overlay {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.3);
    z-index: 1;
  }

  /* Carousel Indicators */
  #hero-carousel-indicators {
    bottom: 20px;
    z-index: 2;
  }

  #hero-carousel-indicators li {
    background-color: rgba(255, 255, 255, 0.5);
    border: none;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    margin: 0 5px;
  }

  #hero-carousel-indicators li.active {
    background-color: #fff;
  }

  /* Carousel Controls */
  #heroCarousel .carousel-control-prev,
  #heroCarousel .carousel-control-next {
    width: 5%;
    z-index: 2;
  }

  #heroCarousel .carousel-control-prev-icon,
  #heroCarousel .carousel-control-next-icon {
    font-size: 30px;
  }

  /* Carousel Caption Custom - Bottom */
  .carousel-caption-custom {
    position: absolute;
    bottom: 80px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 3;
    text-align: center;
    width: 90%;
    max-width: 800px;
  }

  .carousel-caption-custom h2 {
    color: white;
    font-size: 2.5rem;
    font-weight: 700;
    text-align: center;
    margin: 0;
    line-height: 1.3;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
  }

  /* Responsive Adjustments for Hero */
  @media (max-width: 991px) {
    #hero {
      height: calc(60vh - 0px);
    }

    .carousel-caption-custom {
      bottom: 60px;
    }

    .carousel-caption-custom h2 {
      font-size: 2rem;
    }
  }

  @media (max-width: 767px) {
    #hero {
      height: calc(50vh - 0px);
    }

    #heroCarousel .carousel-control-prev,
    #heroCarousel .carousel-control-next {
      width: 10%;
    }

    .carousel-caption-custom {
      bottom: 50px;
    }

    .carousel-caption-custom h2 {
      font-size: 1.5rem;
    }
  }

  /* --- END HERO Section Styles --- */

  /* Styles for section titles */
  .section-title {
    background-color: #f9fafb;
    /* Set section title background to match body */
    padding-top: 2rem;
    /* Add some padding if needed for visual separation */
    padding-bottom: 1rem;
    margin-bottom: 2rem;
    /* Space below the title */
  }

  .section-title h2 {
    text-align: center;
    font-size: 2rem;
    /* Example font size, adjust as needed */
    font-weight: 700;
    color: #333;
    position: relative;
    display: inline-block;
    /* To allow padding/margin for pseudo-elements if desired */
    width: 100%;
    /* Ensure it takes full width for centering */
  }
</style>


<section id="hero">
  <div class="hero-container">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
      <div class="carousel-inner" role="listbox">
        @foreach ($sliders as $key => $slider)
        <div class="{{ $key === 0 ? 'carousel-item active' : 'carousel-item' }}">
          <img src="{{ asset('storage/' . $slider->img_slider) }}" class="d-block w-100" alt="Slider {{ $key + 1 }}" loading="{{ $key === 0 ? 'eager' : 'lazy' }}">
          <div class="carousel-overlay"></div>
          <div class="carousel-caption-custom">
            <h2>Selamat Datang di Web Resmi<br>{{ $nm_puskesmas ?? 'Puskesmas' }}</h2>
          </div>
        </div>
        @endforeach
      </div>
      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>
      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>
    </div>
  </div>
</section>

{{-- ======= Sambutan Kepala Puskesmas Section ======= --}}
@if($sambutan)
<section id="sambutan">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2>Sambutan Kepala Puskesmas</h2>
      <p>Pesan dari pimpinan Puskesmas</p>
    </div>
    <div class="sambutan-card">
      <div class="row g-0">
        <div class="col-lg-4" data-aos="fade-right">
          <div class="sambutan-image">
            @if($sambutan->foto)
              <img src="{{ asset('storage/' . $sambutan->foto) }}" alt="{{ $sambutan->nama }}" loading="lazy">
            @else
              <img src="{{ asset('assets/img/default-avatar.png') }}" alt="{{ $sambutan->nama }}" loading="lazy">
            @endif
          </div>
        </div>
        <div class="col-lg-8" data-aos="fade-left">
          <div class="sambutan-content">
            <h3 class="sambutan-title">{{ $sambutan->nama }}</h3>
            <p class="sambutan-position">{{ $sambutan->jabatan }}</p>
            <div class="sambutan-text">
              {!! nl2br(e($sambutan->isi_sambutan)) !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endif

{{-- ======= Berita Section ======= --}}
<section id="berita" class="services py-5" style="background: white;">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2>Berita</h2>
      <p>Informasi terkini seputar kegiatan dan layanan Puskesmas</p>
    </div>
    <div class="row">
      @foreach ($beritas as $berita)
      <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
        <div class="berita-card">
          <div class="berita-image-wrapper">
            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="berita-img" loading="lazy">
            <span class="berita-badge">{{ $berita->kategori->nama_kategori ?? 'Umum' }}</span>
            <div class="berita-overlay"></div>
          </div>
          <div class="berita-meta">
            <div class="meta-item">
              <i class="bi bi-calendar3"></i>
              <span>{{ $berita->created_at->format('d M Y H:i:s') }}</span>
            </div>
            <div class="meta-item">
              <i class="bi bi-chat-dots"></i>
              <span>{{ $berita->comments_count ?? 0 }} Comments</span>
            </div>
          </div>
          <div class="berita-content">
            <h5 class="berita-title">
              <a href="/berita/{{ $berita->slug }}">
                {{ $berita->judul }}
              </a>
            </h5>
            <p class="berita-description">{{ Str::limit(strip_tags($berita->excerpt), 120) }}</p>
            <a href="/berita/{{ $berita->slug }}" class="btn-baca">
              BACA SELENGKAPNYA <i class="bi bi-chevron-right"></i>
            </a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="text-center mt-5">
      <a class="btn-view-all" href="/berita">
        Lihat Selengkapnya <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </div>
</section>
      </div>
    </div>
  </div>
</section>

{{-- ======= Layanan Kesehatan Section ======= --}}
<section id="layanan">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2>Layanan</h2>
      <p>Berbagai layanan kesehatan yang tersedia di Puskesmas</p>
    </div>
    
    <div class="row g-4 justify-content-center">
      <!-- Left Side - Grid Item (50%) -->
      <div class="col-lg-5 col-md-6">
        <div class="fasilitas-grid">
          @foreach ($layanans as $index => $layanan)
          <div class="fasilitas-item {{ $index === 0 ? 'active' : '' }}" 
               onclick="changeFasilitas(this)"
               data-title="{{ $layanan->nama_layanan }}"
               data-desc="{{ htmlspecialchars($layanan->deskripsi) }}"
               data-persyaratan="{{ htmlspecialchars($layanan->persyaratan ?? '') }}"
               data-biaya="{{ htmlspecialchars($layanan->biaya ?? '') }}"
               data-status="{{ $layanan->status }}"
               data-img="{{ $layanan->gambar && file_exists(storage_path('app/public/' . $layanan->gambar)) ? asset('storage/' . $layanan->gambar) : asset('assets/img/default-layanan.png') }}">
            <div class="fasilitas-icon">
              @if($layanan->gambar && file_exists(storage_path('app/public/' . $layanan->gambar)))
                <img src="{{ asset('storage/' . $layanan->gambar) }}" alt="{{ $layanan->nama_layanan }}">
              @else
                <i class="bi bi-heart-pulse"></i>
              @endif
            </div>
            <h5>{{ $layanan->nama_layanan }}</h5>
          </div>
          @endforeach
        </div>
      </div>
      
      <!-- Right Side - Detail Besar (50%) -->
      <div class="col-lg-5 col-md-6">
        <div class="fasilitas-detail">
          <div class="fasilitas-detail-img">
            <img id="fasilitasImg" 
                 src="{{ $layanans->first()->gambar && file_exists(storage_path('app/public/' . $layanans->first()->gambar)) ? asset('storage/' . $layanans->first()->gambar) : asset('assets/img/default-layanan.png') }}" 
                 alt="Fasilitas">
          </div>
          <div class="fasilitas-detail-text">
            <h3 id="fasilitasTitle">{{ $layanans->first()->nama_layanan }}</h3>
            <div id="fasilitasDesc">{!! $layanans->first()->deskripsi !!}</div>
            
            @if($layanans->first()->persyaratan)
            <div class="fasilitas-detail-info">
              <h5 class="fasilitas-info-label">Persyaratan:</h5>
              <div id="fasilitasPersyaratan">{!! $layanans->first()->persyaratan !!}</div>
            </div>
            @endif
            
            <div class="fasilitas-detail-info">
              <div class="fasilitas-biaya-status">
                <div>
                  <h5 class="fasilitas-info-label">Biaya:</h5>
                  <p id="fasilitasBiaya">{{ $layanans->first()->biaya ?? '-' }}</p>
                </div>
                <div class="fasilitas-status-badge">
                  <span id="fasilitasStatus" class="badge bg-{{ $layanans->first()->status == 'Tersedia' ? 'success' : 'danger' }}">
                    {{ $layanans->first()->status }}
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  /* Layanan Section - Simplified Version */
  #layanan {
    background: #f8f9fa;
    padding: 2rem 0;
  }
  
  #layanan .container {
    max-width: 1100px;
  }

  /* Grid 2 Kolom untuk Fasilitas */
  .fasilitas-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
    max-height: 420px;
    overflow-y: auto;
    padding-right: 8px;
  }

  /* Custom Scrollbar */
  .fasilitas-grid::-webkit-scrollbar {
    width: 6px;
  }

  .fasilitas-grid::-webkit-scrollbar-track {
    background: #e9ecef;
    border-radius: 3px;
  }

  .fasilitas-grid::-webkit-scrollbar-thumb {
    background: #adb5bd;
    border-radius: 3px;
  }

  .fasilitas-grid::-webkit-scrollbar-thumb:hover {
    background: #6c757d;
  }

  /* Item Fasilitas - Dengan Gambar Bundar */
  .fasilitas-item {
    background: #ffffff;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 16px 18px;
    display: flex;
    align-items: center;
    gap: 14px;
    cursor: pointer;
    transition: background 0.3s ease, border-color 0.3s ease;
    min-height: 90px;
  }
  
  /* Gambar Bundar Icon */
  .fasilitas-icon {
    width: 50px;
    height: 50px;
    min-width: 50px;
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    border: 2px solid #e0e0e0;
    transition: background 0.3s ease, border-color 0.3s ease;
  }
  
  .fasilitas-icon img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  
  .fasilitas-icon i {
    font-size: 24px;
    color: #6c757d;
    transition: color 0.3s ease;
  }

  /* Hover Effect - Background Merah */
  .fasilitas-item:hover {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    border-color: #dc3545;
  }
  
  .fasilitas-item:hover h5 {
    color: #ffffff;
  }
  
  .fasilitas-item:hover .fasilitas-icon {
    border-color: #ffffff;
    background: rgba(255, 255, 255, 0.2);
  }
  
  .fasilitas-item:hover .fasilitas-icon i {
    color: #ffffff;
  }

  /* Item Aktif - Background Merah */
  .fasilitas-item.active {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    border-color: #dc3545;
  }

  .fasilitas-item.active h5 {
    color: #ffffff;
    font-weight: 700;
  }
  
  .fasilitas-item.active .fasilitas-icon {
    border-color: #ffffff;
    background: rgba(255, 255, 255, 0.2);
  }
  
  .fasilitas-item.active .fasilitas-icon i {
    color: #ffffff;
  }

  /* Nama Fasilitas - Lebih Compact */
  .fasilitas-item h5 {
    margin: 0;
    font-size: 0.9rem;
    font-weight: 700;
    color: #2c3e50;
    line-height: 1.4;
    transition: color 0.3s ease;
    flex: 1;
    text-align: left;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  /* Detail Box Kanan - Background Menyatu */
  .fasilitas-detail {
    background: transparent;
    border: none;
    border-radius: 0;
    overflow: visible;
    height: 100%;
    min-height: 420px;
  }

  /* Gambar Tanpa Card */
  .fasilitas-detail-img {
    width: 100%;
    height: 260px;
    overflow: hidden;
    background: transparent;
    border-radius: 0;
    box-shadow: none;
    margin-bottom: 1.2rem;
  }

  .fasilitas-detail-img img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: opacity 0.3s ease;
    padding: 0;
  }

  /* Text Detail - No Border Top */
  .fasilitas-detail-text {
    padding: 0;
    background: transparent;
  }

  #fasilitasTitle {
    font-size: 1.3rem;
    font-weight: 800;
    color: #2c3e50;
    margin-bottom: 0.8rem;
    line-height: 1.3;
  }

  #fasilitasDesc {
    font-size: 0.8rem;
    color: #6c757d;
    line-height: 1.5;
    text-align: justify;
    margin: 0 0 0.8rem 0;
    max-height: none;
    overflow: visible;
  }
  
  /* Info Detail - Biaya dan Persyaratan */
  .fasilitas-detail-info {
    margin-top: 0.8rem;
    padding-top: 0.8rem;
    border-top: 1px solid #e0e0e0;
  }
  
  .fasilitas-info-label {
    font-size: 0.85rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.3rem;
  }
  
  #fasilitasBiaya {
    font-size: 0.8rem;
    color: #6c757d;
    margin: 0;
    line-height: 1.4;
  }
  
  #fasilitasPersyaratan {
    font-size: 0.8rem;
    color: #6c757d;
    line-height: 1.4;
  }
  
  #fasilitasPersyaratan ul,
  #fasilitasPersyaratan ol {
    margin: 0.5rem 0 0 1.5rem;
    padding: 0;
  }
  
  #fasilitasPersyaratan li {
    margin-bottom: 0.3rem;
  }
  
  /* Biaya dan Status Layout */
  .fasilitas-biaya-status {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 1rem;
  }
  
  .fasilitas-biaya-status > div:first-child {
    flex: 1;
  }
  
  .fasilitas-status-badge {
    display: flex;
    align-items: flex-start;
  }
  
  .fasilitas-status-badge .badge {
    font-size: 0.75rem;
    padding: 0.35rem 0.6rem;
    white-space: nowrap;
  }
  
  /* Modal Styles */
  .modal-header {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
    border-bottom: none;
  }

  .modal-title {
    font-weight: 600;
  }
  
  .modal-title i {
    font-size: 1.2rem;
  }

  .modal-body {
    padding: 2rem;
  }

  .detail-section {
    margin-bottom: 1.5rem;
  }

  .detail-section h6 {
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    font-size: 1.1rem;
  }

  .detail-section h6 i {
    margin-right: 0.5rem;
    color: var(--primary-color);
    font-size: 1.2rem;
  }

  .detail-content {
    color: var(--text-light);
    line-height: 1.8;
    text-align: justify;
    font-size: 0.95rem;
  }

  .detail-content ul,
  .detail-content ol {
    margin-left: 1.5rem;
  }
  
  .detail-content .badge {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
  }

  /* Responsive */
  @media (max-width: 1199px) {
    .fasilitas-grid {
      max-height: 400px;
    }
    
    .fasilitas-detail {
      min-height: 400px;
    }
    
    .fasilitas-detail-img {
      height: 240px;
    }
    
    .fasilitas-icon {
      width: 48px;
      height: 48px;
      min-width: 48px;
    }
  }

  @media (max-width: 991px) {
    #layanan {
      padding: 2rem 0;
    }
    
    .fasilitas-grid {
      max-height: 380px;
      margin-bottom: 20px;
    }
    
    .fasilitas-item {
      min-height: 85px;
      padding: 14px 12px;
      gap: 10px;
    }
    
    .fasilitas-icon {
      width: 45px;
      height: 45px;
      min-width: 45px;
    }
    
    .fasilitas-icon i {
      font-size: 22px;
    }
    
    .fasilitas-item h5 {
      font-size: 0.85rem;
    }
    
    .fasilitas-detail {
      min-height: 380px;
    }
    
    .fasilitas-detail-img {
      height: 240px;
    }
    
    .fasilitas-detail-text {
      padding: 0;
    }
    
    #fasilitasTitle {
      font-size: 1.2rem;
    }
    
    #fasilitasDesc {
      font-size: 0.88rem;
    }
  }

  @media (max-width: 767px) {
    #layanan {
      padding: 1.5rem 0;
    }
    
    .fasilitas-grid {
      grid-template-columns: 1fr;
      max-height: 320px;
      gap: 10px;
    }
    
    .fasilitas-item {
      min-height: 80px;
      padding: 12px 10px;
      gap: 8px;
    }
    
    .fasilitas-icon {
      width: 40px;
      height: 40px;
      min-width: 40px;
    }
    
    .fasilitas-icon i {
      font-size: 20px;
    }
    
    .fasilitas-item h5 {
      font-size: 0.8rem;
    }
    
    .fasilitas-detail {
      min-height: 320px;
    }
    
    .fasilitas-detail-img {
      height: 200px;
    }
    
    .fasilitas-detail-text {
      padding: 0;
    }
    
    #fasilitasTitle {
      font-size: 1.1rem;
    }
    
    #fasilitasDesc {
      font-size: 0.85rem;
    }
  }
</style>

<script>
  function changeFasilitas(element) {
    // Hapus active dari semua
    document.querySelectorAll('.fasilitas-item').forEach(item => {
      item.classList.remove('active');
    });
    
    // Tambah active ke yang diklik
    element.classList.add('active');
    
    // Ambil data
    const title = element.getAttribute('data-title');
    const desc = element.getAttribute('data-desc');
    const persyaratan = element.getAttribute('data-persyaratan');
    const biaya = element.getAttribute('data-biaya');
    const status = element.getAttribute('data-status');
    const img = element.getAttribute('data-img');
    
    // Update gambar dengan fade
    const imgEl = document.getElementById('fasilitasImg');
    if (imgEl) {
      imgEl.style.opacity = '0';
      setTimeout(() => {
        imgEl.src = img;
        imgEl.alt = title;
        imgEl.style.opacity = '1';
      }, 200);
    }
    
    // Update text
    const titleEl = document.getElementById('fasilitasTitle');
    if (titleEl) titleEl.textContent = title;
    
    const descEl = document.getElementById('fasilitasDesc');
    if (descEl) {
      // Decode HTML entities and display as HTML
      const textarea = document.createElement('textarea');
      textarea.innerHTML = desc;
      descEl.innerHTML = textarea.value;
    }
    
    // Update biaya
    const biayaEl = document.getElementById('fasilitasBiaya');
    const biayaContainer = biayaEl ? biayaEl.closest('.fasilitas-detail-info') : null;
    if (biayaEl && biaya) {
      biayaEl.textContent = biaya;
      if (biayaContainer) biayaContainer.style.display = 'block';
    } else if (biayaContainer) {
      biayaContainer.style.display = 'none';
    }
    
    // Update persyaratan
    const persyaratanEl = document.getElementById('fasilitasPersyaratan');
    const persyaratanContainer = persyaratanEl ? persyaratanEl.closest('.fasilitas-detail-info') : null;
    if (persyaratanEl && persyaratan) {
      const textarea2 = document.createElement('textarea');
      textarea2.innerHTML = persyaratan;
      persyaratanEl.innerHTML = textarea2.value;
      if (persyaratanContainer) persyaratanContainer.style.display = 'block';
    } else if (persyaratanContainer) {
      persyaratanContainer.style.display = 'none';
    }
    
    // Update status
    const statusEl = document.getElementById('fasilitasStatus');
    if (statusEl) {
      statusEl.textContent = status;
      statusEl.className = 'badge bg-' + (status === 'Tersedia' ? 'success' : 'danger');
    }
  }
</script>

{{-- ======= Galeri Section ======= --}}
<section id="galeri" class="services py-5" style="background: white;">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2>Galeri</h2>
      <p>Dokumentasi kegiatan dan fasilitas Puskesmas</p>
    </div>
    
    <div class="galeri-carousel-wrapper position-relative">
      {{-- Desktop Carousel: 3 items per slide --}}
      <div id="galeriCarouselDesktop" class="carousel slide d-none d-md-block" data-bs-ride="carousel">
        <div class="carousel-inner">
          @php
            $desktopChunks = $galleries->chunk(3);
          @endphp
          
          @foreach ($desktopChunks as $chunkIndex => $chunk)
          <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
            <div class="row g-4">
              @foreach ($chunk as $gallery)
              <div class="col-md-4">
                <div class="gallery-card">
                  <div class="gallery-image">
                    <img src="{{ asset('storage/' . $gallery->gambar) }}" alt="{{ $gallery->judul }}" class="d-block w-100" loading="lazy">
                    <div class="gallery-overlay">
                      <div class="overlay-content">
                        <h5>{{ $gallery->judul }}</h5>
                        @if($gallery->deskripsi)
                        <p>{{ Str::limit($gallery->deskripsi, 80) }}</p>
                        @endif
                        <a href="{{ route('galeri.show', $gallery->id) }}" class="btn-view">
                          <i class="bi bi-eye"></i> Lihat Detail
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          @endforeach
        </div>
        
        {{-- Desktop Controls --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#galeriCarouselDesktop" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#galeriCarouselDesktop" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      
      {{-- Mobile Carousel: 1 item per slide --}}
      <div id="galeriCarouselMobile" class="carousel slide d-block d-md-none" data-bs-ride="carousel">
        <div class="carousel-inner">
          @foreach ($galleries as $mobileIndex => $gallery)
          <div class="carousel-item {{ $mobileIndex === 0 ? 'active' : '' }}">
            <div class="row justify-content-center">
              <div class="col-12">
                <div class="gallery-card">
                  <div class="gallery-image">
                    <img src="{{ asset('storage/' . $gallery->gambar) }}" alt="{{ $gallery->judul }}" class="d-block w-100" loading="lazy">
                    <div class="gallery-overlay">
                      <div class="overlay-content">
                        <h5>{{ $gallery->judul }}</h5>
                        @if($gallery->deskripsi)
                        <p>{{ Str::limit($gallery->deskripsi, 80) }}</p>
                        @endif
                        <a href="{{ route('galeri.show', $gallery->id) }}" class="btn-view">
                          <i class="bi bi-eye"></i> Lihat Detail
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        
        {{-- Mobile Controls --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#galeriCarouselMobile" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#galeriCarouselMobile" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    
    <div class="text-center mt-5">
      <a class="btn-view-all" href="/gallery">
        Lihat Semua Galeri <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </div>
</section>

<style>
  /* Gallery Section with Carousel - 3 items per slide */
  #galeri {
    background: white;
    padding: 5rem 0;
  }

  .galeri-carousel-wrapper {
    position: relative;
    padding: 0;
    margin: 0 80px;
  }

  #galeri .gallery-card {
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 100%;
  }

  #galeri .gallery-card:hover {
    box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
  }

  #galeri .gallery-image {
    position: relative;
    overflow: hidden;
    height: 280px;
  }

  #galeri .gallery-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
  }

  #galeri .gallery-card:hover .gallery-image img {
    transform: scale(1.1);
  }

  #galeri .gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.85) 100%);
    display: flex;
    align-items: flex-end;
    padding: 1.5rem;
    opacity: 0;
    transition: opacity 0.3s ease;
  }

  #galeri .gallery-card:hover .gallery-overlay {
    opacity: 1;
  }

  #galeri .overlay-content {
    width: 100%;
  }

  #galeri .overlay-content h5 {
    color: white;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
  }

  #galeri .overlay-content p {
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.85rem;
    margin-bottom: 1rem;
    line-height: 1.4;
  }

  #galeri .btn-view {
    background: var(--primary-color);
    color: white;
    padding: 0.5rem 1.25rem;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.85rem;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    transition: all 0.3s ease;
  }

  #galeri .btn-view:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
  }

  /* Carousel Controls - Outside positioning */
  .galeri-carousel-wrapper .carousel-control-prev,
  .galeri-carousel-wrapper .carousel-control-next {
    width: 55px;
    height: 55px;
    background: var(--primary-color);
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
    opacity: 1;
    transition: all 0.3s ease;
    z-index: 10;
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
  }

  .galeri-carousel-wrapper .carousel-control-prev {
    left: -80px;
  }

  .galeri-carousel-wrapper .carousel-control-next {
    right: -80px;
  }

  .galeri-carousel-wrapper .carousel-control-prev:hover,
  .galeri-carousel-wrapper .carousel-control-next:hover {
    background: var(--primary-dark);
    transform: translateY(-50%) scale(1.1);
  }

  .galeri-carousel-wrapper .carousel-control-prev-icon,
  .galeri-carousel-wrapper .carousel-control-next-icon {
    width: 24px;
    height: 24px;
  }

  /* Responsive */
  @media (max-width: 991px) {
    .galeri-carousel-wrapper {
      margin: 0 70px;
    }
    
    .galeri-carousel-wrapper .carousel-control-prev {
      left: -70px;
    }

    .galeri-carousel-wrapper .carousel-control-next {
      right: -70px;
    }
  }

  @media (max-width: 767px) {
    .galeri-carousel-wrapper {
      margin: 0 60px;
    }

    #galeri .gallery-image {
      height: 220px;
    }

    .galeri-carousel-wrapper .carousel-control-prev,
    .galeri-carousel-wrapper .carousel-control-next {
      width: 45px;
      height: 45px;
    }
    
    .galeri-carousel-wrapper .carousel-control-prev {
      left: -60px;
    }

    .galeri-carousel-wrapper .carousel-control-next {
      right: -60px;
    }

    #galeri .overlay-content h5 {
      font-size: 1rem;
    }

    #galeri .overlay-content p {
      font-size: 0.8rem;
    }
  }
</style>

{{-- SKM Section --}}
<section id="skm" class="py-5" style="background: #f8f9fa;">
  <div class="container">
    <div class="section-title">
      <h2>SURVEI KEPUASAN MASYARAKAT</h2>
    </div>

    @if ($skm)
    
    {{-- Main Container --}}
    <div class="skm-wrapper">
      <h4 class="skm-period-title">Hasil Survei kepuasan Periode : {{ $skm['periode_survey'] ?? 'N/A' }}</h4>
      
      {{-- 3 Columns Layout --}}
      <div class="row g-3">
        {{-- Left Column: Timeline + Jenis Kelamin --}}
        <div class="col-lg-3">
          {{-- Timeline Stats --}}
          <div class="skm-stats-card">
            <div class="skm-timeline">
              {{-- Jumlah Survei --}}
              <div class="skm-timeline-item">
                <div class="skm-timeline-dot"></div>
                <div class="skm-timeline-content">
                  <p class="skm-label">Jumlah Survei</p>
                  <div class="skm-value-badge">
                    {{ $skm['total_responden'] }} Responden
                  </div>
                </div>
              </div>

              {{-- Jenis Kelamin - Simple Text Version --}}
              <div class="skm-jk-card">
                <h6 class="skm-jk-title">Jenis Kelamin Responden</h6>
                
                @php
                $total_jk = $skm['jk_pria'] + $skm['jk_wanita'];
                $persen_pria = $total_jk > 0 ? ($skm['jk_pria'] / $total_jk * 100) : 0;
                $persen_wanita = $total_jk > 0 ? ($skm['jk_wanita'] / $total_jk * 100) : 0;
                @endphp

                <div class="skm-jk-simple-item">
                  <span class="skm-jk-simple-label">Pria</span>
                  <span class="skm-jk-simple-value">{{ $skm['jk_pria'] }} ({{ number_format($persen_pria, 2) }}%)</span>
                </div>

                <div class="skm-jk-simple-item">
                  <span class="skm-jk-simple-label">Wanita</span>
                  <span class="skm-jk-simple-value">{{ $skm['jk_wanita'] }} ({{ number_format($persen_wanita, 2) }}%)</span>
                </div>
              </div>

              {{-- Nilai Rata-Rata --}}
              <div class="skm-timeline-item">
                <div class="skm-timeline-dot"></div>
                <div class="skm-timeline-content">
                  <p class="skm-label">Nilai Rata-Rata</p>
                  <div class="skm-value-badge">
                    {{ number_format($skm['total_skor'], 2) }}
                  </div>
                </div>
              </div>

              {{-- Grade --}}
              <div class="skm-timeline-item">
                <div class="skm-timeline-dot"></div>
                <div class="skm-timeline-content">
                  <p class="skm-label">Grade</p>
                  <div class="skm-value-badge">
                    {{ $skm['grade'] }} - {{ strtoupper($skm['keterangan']) }}
                  </div>
                </div>
              </div>

              {{-- Tombol Isi Survey (tanpa dot) --}}
              @php
                $skmConfig = \App\Models\SkmConfig::first();
              @endphp
              @if($skmConfig && $skmConfig->login_url)
              <div class="skm-timeline-button">
                <a href="{{ $skmConfig->login_url }}" target="_blank" class="btn-skm-survey-timeline">
                  <i class="bi bi-clipboard-check"></i> Isi Survey
                </a>
              </div>
              @endif
            </div>
          </div>
        </div>

        {{-- Middle Column: Pendidikan --}}
        <div class="col-lg-5">
          <div class="skm-compact-card">
            <h6 class="skm-compact-title">Tingkat Pendidikan Responden</h6>
            
            @php
            $total_pendidikan = array_sum(array_column($skm['pendidikan'], 'value'));
            @endphp

            @foreach($skm['pendidikan'] as $edu)
              @php
              $persen = $total_pendidikan > 0 ? ($edu['value'] / $total_pendidikan * 100) : 0;
              $persenFormatted = number_format($persen, 2);
              @endphp
              <div class="skm-compact-item">
                <div class="skm-compact-label">
                  <span class="skm-compact-name">{{ $edu['name'] }}</span>
                  <span class="skm-compact-count">({{ $edu['value'] }} orang)</span>
                </div>
                <div class="skm-compact-bar-wrapper">
                  <div class="skm-compact-bar" style="--bar-width: {{ $persenFormatted }}%; width: var(--bar-width);"></div>
                  <span class="skm-compact-percent">{{ $persenFormatted }}%</span>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        {{-- Right Column: Pekerjaan --}}
        <div class="col-lg-4">
          <div class="skm-compact-card">
            <h6 class="skm-compact-title">Pekerjaan Responden</h6>
            
            @php
            $total_pekerjaan = array_sum(array_column($skm['pekerjaan'], 'value'));
            @endphp

            @foreach($skm['pekerjaan'] as $job)
              @php
              $persen = $total_pekerjaan > 0 ? ($job['value'] / $total_pekerjaan * 100) : 0;
              $persenFormatted = number_format($persen, 2);
              @endphp
              <div class="skm-compact-item">
                <div class="skm-compact-label">
                  <span class="skm-compact-name">{{ $job['name'] }}</span>
                  <span class="skm-compact-count">({{ $job['value'] }} orang)</span>
                </div>
                <div class="skm-compact-bar-wrapper">
                  <div class="skm-compact-bar" style="--bar-width: {{ $persenFormatted }}%; width: var(--bar-width);"></div>
                  <span class="skm-compact-percent">{{ $persenFormatted }}%</span>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>

    @else
    <p class="text-danger text-center mt-5 py-4">Data SKM tidak tersedia untuk ditampilkan.</p>
    @endif
  </div>
</section>

<style>
/* SKM Section - Refined Styling */
#skm {
  background: #f8f9fa;
  padding: 4rem 0;
}

.skm-wrapper {
  background: transparent;
  border-radius: 0;
  padding: 0;
  box-shadow: none;
}

.skm-period-title {
  font-size: 1rem;
  font-weight: 500;
  color: #4a5568;
  margin-bottom: 2.5rem;
  padding-bottom: 0;
  border-bottom: none;
}

/* Left Stats Card - Vertical Timeline */
.skm-stats-card {
  background: transparent;
  border-radius: 0;
  padding: 0 0 1rem 0;
  box-shadow: none;
}

.skm-timeline {
  position: relative;
  padding-left: 2.8rem;
}

.skm-timeline::before {
  content: '';
  position: absolute;
  left: 12px;
  top: 12px;
  bottom: 12px;
  width: 2px;
  background: #cbd5e0;
  z-index: 0;
}

.skm-timeline-item {
  position: relative;
  margin-bottom: 1.2rem;
}

.skm-timeline-item:last-child {
  margin-bottom: 0;
}

.skm-timeline-dot {
  position: absolute;
  left: -2.8rem;
  top: 0;
  width: 26px;
  height: 26px;
  background: #3b82f6;
  border-radius: 50%;
  box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);
  z-index: 1;
}

.skm-timeline-content {
  text-align: left;
}

.skm-label {
  font-size: 0.75rem;
  color: #718096;
  margin-bottom: 0.5rem;
  font-weight: 400;
  line-height: 1.3;
}

.skm-value-badge {
  background: #3b82f6;
  color: white;
  padding: 0.5rem 1.2rem;
  border-radius: 4px;
  font-weight: 600;
  font-size: 0.85rem;
  display: inline-block;
  box-shadow: 0 2px 4px rgba(59, 130, 246, 0.25);
}

/* Tombol Isi Survey di Timeline */
.skm-timeline-button {
  margin-top: 1.2rem;
  padding-left: 0;
}

.btn-skm-survey-timeline {
  display: inline-flex;
  align-items: center;
  gap: 0.4rem;
  background: #0F8A4C;
  color: white;
  padding: 0.55rem 1.3rem;
  font-weight: 600;
  font-size: 0.8rem;
  border-radius: 5px;
  text-decoration: none;
  transition: all 0.3s ease;
  box-shadow: 0 2px 8px rgba(15, 138, 76, 0.3);
  border: none;
}

.btn-skm-survey-timeline:hover {
  background: #0d7540;
  color: white;
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(15, 138, 76, 0.4);
}

.btn-skm-survey-timeline i {
  font-size: 0.95rem;
}

/* Jenis Kelamin Card - Simple Text Only Version */
.skm-jk-card {
  background: transparent;
  padding: 0;
  border-radius: 0;
  margin-top: 1.2rem;
  margin-bottom: 1.2rem;
  padding-left: 0;
}

.skm-jk-title {
  font-size: 0.75rem;
  font-weight: 600;
  color: #495057;
  margin-bottom: 0.6rem;
  padding-bottom: 0.4rem;
  border-bottom: 1px solid #e5e7eb;
}

.skm-jk-simple-item {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  gap: 0.6rem;
  padding: 0.4rem 0;
  border-bottom: 1px solid #f3f4f6;
}

.skm-jk-simple-item:last-child {
  border-bottom: none;
}

.skm-jk-simple-label {
  font-size: 0.72rem;
  font-weight: 500;
  color: #4b5563;
  min-width: 55px;
}

.skm-jk-simple-value {
  font-size: 0.72rem;
  font-weight: 600;
  color: #3b82f6;
}

/* Compact Card for Pendidikan & Pekerjaan - New Style */
.skm-compact-card {
  background: transparent;
  padding: 0 25px 0 0;
  border-radius: 0;
}

.skm-compact-title {
  font-size: 0.85rem;
  font-weight: 600;
  color: #495057;
  margin-bottom: 0.75rem;
  padding-bottom: 0.5rem;
  border-bottom: 1px solid #e5e7eb;
}

.skm-compact-item {
  margin-bottom: 0.75rem;
}

.skm-compact-item:last-child {
  margin-bottom: 0;
}

.skm-compact-label {
  display: flex;
  align-items: center;
  gap: 0.35rem;
  margin-bottom: 0.3rem;
}

.skm-compact-name {
  font-size: 0.8rem;
  font-weight: 500;
  color: #4b5563;
}

.skm-compact-count {
  font-size: 0.75rem;
  color: #9ca3af;
}

.skm-compact-bar-wrapper {
  position: relative;
  background: #e5e7eb;
  height: 6px;
  border-radius: 3px;
  overflow: visible;
  margin-right: 45px;
}

.skm-compact-bar {
  height: 100%;
  background: #3b82f6;
  border-radius: 3px;
  transition: width 0.8s ease;
}

.skm-compact-percent {
  position: absolute;
  right: -45px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 0.65rem;
  font-weight: 600;
  color: #343a40;
  background: #e5e7eb;
  padding: 0.15rem 0.4rem;
  border-radius: 2px;
  white-space: nowrap;
}

/* Right Questions Card */
.skm-demographics-card {
  background: transparent;
  border-radius: 0;
  padding: 0;
  box-shadow: none;
  max-height: none;
  overflow-y: visible;
  height: 100%;
}

/* Progress Bar List */
ul.progress-bar {
  list-style: none;
  padding: 0;
  margin: 0;
  height: 100%;
}

ul.progress-bar.margin-top-33 {
  margin-top: 0;
}

ul.progress-bar.clearfix::after {
  content: "";
  display: table;
  clear: both;
}

li.single-bar {
  margin-bottom: 0.75rem;
  position: relative;
  background: transparent;
  padding: 0.5rem 1rem 0.5rem 0;
  min-height: auto;
  display: block;
}

li.single-bar.section-header {
  background: transparent;
  padding: 0 0 0.5rem 0;
  margin-bottom: 0.75rem;
  margin-top: 1.5rem;
  min-height: auto;
}

li.single-bar.section-header:first-child {
  padding-top: 0;
  margin-top: 0;
}

li.single-bar.section-header .bar-label {
  font-size: 15px;
  font-weight: 600;
  color: #495057;
  text-align: left;
}

.bar-label {
  display: block;
  text-align: left;
  font-size: 13px;
  color: #5a6c7d;
  margin-bottom: 0.35rem;
  font-weight: 500;
  line-height: 1.2;
}

span.bar.animated-element {
  display: block;
  height: 8px;
  background: #3b82f6;
  border-radius: 0;
  transition: width 0.8s ease;
  position: relative;
  max-width: 100%;
  margin-top: 0.2rem;
  margin-bottom: 0.15rem;
}

.bar-label-units {
  position: absolute;
  right: 0;
  top: 50%;
  transform: translateY(-50%);
  background: #343a40;
  color: white;
  padding: 0.35rem 0.75rem;
  border-radius: 3px;
  font-size: 0.8rem;
  font-weight: 600;
  white-space: nowrap;
  line-height: 1;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
}

/* Single Bar Progress */
.single-bar {
  flex: 1;
  position: relative;
  height: 28px;
  background: #e2e8f0;
  border-radius: 0;
  overflow: hidden;
}

.bar-fill {
  height: 100%;
  background: #3b82f6;
  border-radius: 0;
  transition: width 0.8s ease;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  padding-right: 0.5rem;
}

.bar.animated-element.progress {
  height: 100%;
  background: #3b82f6;
  border-radius: 0;
  transition: width 0.8s ease;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  padding-right: 0.5rem;
}

.bar-percent {
  color: white;
  font-size: 0.75rem;
  font-weight: 600;
}

.bar-fill {
  height: 100%;
  background: #3b82f6;
  border-radius: 0;
  transition: width 0.8s ease;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  padding-right: 0.5rem;
}

.bar.animated-element.progress {
  height: 100%;
  background: #3b82f6;
  border-radius: 0;
  transition: width 0.8s ease;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  padding-right: 0.5rem;
}

.bar-percent {
  color: white;
  font-size: 0.75rem;
  font-weight: 600;
}

/* Bottom Data Cards */
.skm-data-card {
  background: white;
  border-radius: 8px;
  padding: 1.5rem;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  height: 100%;
}

.skm-card-title {
  font-size: 0.95rem;
  font-weight: 600;
  color: #1f2937;
  margin-bottom: 1.25rem;
}

.skm-scrollable {
  max-height: 280px;
  overflow-y: auto;
  padding-right: 0.5rem;
}

.skm-scrollable::-webkit-scrollbar {
  width: 5px;
}

.skm-scrollable::-webkit-scrollbar-track {
  background: #f3f4f6;
  border-radius: 3px;
}

.skm-scrollable::-webkit-scrollbar-thumb {
  background: #d1d5db;
  border-radius: 3px;
}

.skm-data-item {
  margin-bottom: 1rem;
}

.skm-data-item:last-child {
  margin-bottom: 0;
}

.skm-data-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.5rem;
}

.skm-data-label {
  font-size: 0.875rem;
  color: #4b5563;
}

.skm-data-value {
  background: #1f2937;
  color: white;
  padding: 0.2rem 0.6rem;
  border-radius: 10px;
  font-weight: 600;
  font-size: 0.8rem;
}

.skm-data-progress {
  height: 6px;
  background: #e5e7eb;
  border-radius: 3px;
  overflow: hidden;
}

.skm-data-bar {
  height: 100%;
  background: #3b82f6;
  border-radius: 3px;
  transition: width 0.6s ease;
}

/* Survey Button */
.btn-skm-survey {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  background: #3b82f6;
  color: white;
  padding: 0.75rem 2rem;
  font-weight: 600;
  font-size: 0.95rem;
  border-radius: 6px;
  text-decoration: none;
  transition: all 0.3s ease;
  border: none;
  box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
}

.btn-skm-survey:hover {
  background: #2563eb;
  color: white;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
}

/* Responsive */
@media (max-width: 991px) {
  .skm-wrapper {
    padding: 0;
  }

  .skm-period-title {
    font-size: 0.95rem;
    margin-bottom: 2rem;
  }

  .skm-timeline {
    padding-left: 2.5rem;
  }

  .skm-timeline-dot {
    left: -33px;
    width: 28px;
    height: 28px;
  }

  .skm-timeline::before {
    left: 13px;
  }

  .skm-timeline-item {
    margin-bottom: 2.25rem;
  }

  .skm-label {
    font-size: 0.8rem;
  }

  .skm-value-badge {
    font-size: 0.85rem;
    padding: 0.6rem 1.2rem;
  }

  .skm-jk-title {
    font-size: 0.8rem;
  }

  .skm-jk-simple-label,
  .skm-jk-simple-value {
    font-size: 0.75rem;
  }

  .skm-compact-title {
    font-size: 0.8rem;
  }

  .skm-compact-name {
    font-size: 0.75rem;
  }

  .skm-compact-count {
    font-size: 0.7rem;
  }

  .skm-compact-percent {
    font-size: 0.65rem;
    right: -42px;
  }

  li.single-bar {
    margin-bottom: 0.6rem;
    padding: 0.4rem 0.8rem 0.4rem 0;
  }

  .bar-label {
    font-size: 12px;
    margin-bottom: 0.3rem;
  }

  .bar-label-units {
    font-size: 0.75rem;
    padding: 0.3rem 0.65rem;
  }
}

@media (max-width: 767px) {
  #skm {
    padding: 2.5rem 0;
  }

  .skm-period-title {
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
  }

  .skm-timeline {
    padding-left: 2rem;
  }

  .skm-timeline-item {
    margin-bottom: 2rem;
  }

  .skm-timeline-dot {
    left: -30px;
    width: 28px;
    height: 28px;
  }

  .skm-timeline::before {
    left: 13px;
  }

  .skm-label {
    font-size: 0.75rem;
    margin-bottom: 0.5rem;
  }

  .skm-value-badge {
    font-size: 0.8rem;
    padding: 0.5rem 1rem;
  }

  .skm-stats-card {
    padding: 0 0 1.5rem 0;
    margin-bottom: 0;
  }

  .skm-jk-card {
    margin-top: 1rem;
  }

  .skm-jk-title {
    font-size: 0.75rem;
    margin-bottom: 0.6rem;
    padding-bottom: 0.4rem;
  }

  .skm-jk-simple-item {
    padding: 0.4rem 0;
  }

  .skm-jk-simple-label,
  .skm-jk-simple-value {
    font-size: 0.7rem;
  }

  .skm-compact-title {
    font-size: 0.75rem;
    margin-bottom: 0.6rem;
    padding-bottom: 0.4rem;
  }

  .skm-compact-name {
    font-size: 0.7rem;
  }

  .skm-compact-count {
    font-size: 0.65rem;
  }

  .skm-compact-bar-wrapper {
    height: 5px;
  }

  .skm-compact-percent {
    font-size: 0.6rem;
    right: -38px;
    padding: 0.15rem 0.4rem;
  }

  li.single-bar {
    margin-bottom: 0.5rem;
    padding: 0.35rem 0.6rem 0.35rem 0;
  }

  li.single-bar.section-header {
    padding: 0 0 0.4rem 0;
    margin-bottom: 0.6rem;
    margin-top: 1.2rem;
  }

  li.single-bar.section-header:first-child {
    margin-top: 0;
  }

  li.single-bar.section-header .bar-label {
    font-size: 13px;
  }

  .bar-label {
    font-size: 11px;
    margin-bottom: 0.25rem;
  }

  span.bar.animated-element {
    height: 7px;
  }

  .bar-label-units {
    font-size: 0.7rem;
    padding: 0.25rem 0.55rem;
  }
  
  .skm-question-score {
    font-size: 0.75rem;
    padding: 0.2rem 0.5rem;
  }
  
  .skm-data-card {
    padding: 1rem;
  }
  
  .skm-card-title {
    font-size: 0.875rem;
  }
  
  .btn-skm-survey {
    padding: 0.65rem 1.5rem;
    font-size: 0.875rem;
  }
}
</style>

@endsection