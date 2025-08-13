@extends('layouts.main')

@section('content')

<script src="https://cdn.tailwindcss.com"></script>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

  html,
  body {
    height: 99%;
    margin: 0;
    padding: 0;
  }

  body {
    font-family: 'Poppins', sans-serif;
    background-color: #f9fafb;
    /* Mengubah warna latar belakang body menjadi setara dengan Tailwind's bg-gray-50 */
  }

  .icon-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 80px;
    height: 80px;
    background-color: #ffffff;
    border-radius: 50%;
    text-decoration: none;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    transition: background-color 0.3s ease, transform 0.2s ease;
  }

  .icon-link:hover {
    background-color: #e2e6ea;
    transform: scale(1.05);
  }

  .icon-link:active {
    background-color: #ced4da;
    transform: scale(0.97);
  }

  .icon-link i {
    transform: translateY(-6px);
  }

  .news-card .card {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
  }

  .news-card .card-img-top {
    height: 200px;
    object-fit: cover;
  }

  .news-card .card-body {
    padding: 1.5rem;
  }

  .news-card .card-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
  }

  .news-card .card-text {
    font-size: 0.95rem;
    color: #6c757d;
    line-height: 1.6;
    height: 75px;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .news-card .news-date {
    font-size: 0.85rem;
    color: #999;
    margin-top: 1rem;
  }

  .news-card .card-footer {
    background-color: white;
    border-top: 1px solid #eee;
    padding: 1rem 1.5rem;
  }

  .news-card .btn-link {
    font-size: 0.95rem;
    font-weight: 500;
    color: #0d6efd;
    text-decoration: none;
  }

  .news-card .btn-link:hover {
    text-decoration: underline;
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

  /* --- END SKM Section Styles --- */


  /* --- START HERO Section Styles --- */
  #hero {
    width: 100%;
    /* Menggunakan calc untuk menyesuaikan jika ada navbar tetap */
    /* Ganti '0px' dengan tinggi navbar Anda, misal '70px' */
    height: calc(100vh - 0px);
    /* <<< Adjusted height, assumes 0px for no fixed navbar */
    position: relative;
    display: flex;
    align-items: center;
    /* Pusatkan konten carousel secara vertikal */
    justify-content: center;
    /* Pusatkan konten carousel secara horizontal */
    overflow: hidden;
    /* Pastikan tidak ada overflow dari gambar */
    padding: 0;
    /* Pastikan tidak ada padding yang mendorong ke bawah */
    margin-top: 0;
    /* Pastikan tidak ada margin-top yang mendorong ke bawah */
  }

  #hero .hero-container {
    width: 100%;
    height: 100%;
    /* Hero container harus mengisi tinggi hero section */
    position: absolute;
    /* Posisikan absolut agar mengisi penuh #hero */
    top: 0;
    left: 0;
  }

  #heroCarousel.carousel {
    /* Target the specific carousel ID */
    width: 100%;
    height: 100%;
    /* Carousel harus mengisi hero-container */
  }

  #hero .carousel-inner {
    width: 100%;
    height: 100%;
    /* Inner carousel harus mengisi carousel */
  }

  #hero .carousel-item {
    width: 100%;
    height: 100%;
    /* Item carousel harus mengisi tinggi penuh dari carousel-inner */
    background-size: cover;
    /* Pastikan gambar mengisi seluruh area item */
    background-position: center;
    /* Pusatkan gambar */
    position: relative;
    display: flex;
    /* Untuk memposisikan konten di tengah */
    align-items: center;
    justify-content: center;
  }

  #hero .carousel-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4);
    z-index: 0;
  }

  #hero .carousel-container {
    /* Ini adalah div yang membungkus konten teks */
    position: relative;
    /* Kembali ke relative atau hapus jika display flex di .carousel-item sudah cukup */
    z-index: 1;
    /* Di atas overlay */
    padding: 20px;
    /* Tambahkan padding agar teks tidak terlalu menempel ke tepi */
    width: 100%;
    /* Memastikan lebarnya penuh agar container berfungsi */
    max-width: 900px;
    /* Batasi lebar konten untuk keterbacaan */
    margin: 0 auto;
    /* Pusatkan horizontal */
  }

  #hero .carousel-content {
    text-align: center;
    color: #fff;
    padding: 40px 30px;
    background: rgba(0, 0, 0, 0.6);
    /* Sedikit lebih gelap agar teks lebih terbaca */
    border-radius: 8px;
    width: 100%;
    /* Pastikan mengisi max-width dari parent */
  }

  #hero .carousel-content h2 {
    color: #fff;
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 20px;
    line-height: 1.2;
  }

  #hero .carousel-content p {
    font-size: 18px;
    width: 80%;
    margin: 0 auto 30px auto;
    color: #fff;
    line-height: 1.6;
  }

  #hero .btn-get-started {
    font-size: 16px;
    padding: 12px 30px;
    border-radius: 50px;
    border: 2px solid #fff;
    color: #fff;
    transition: all 0.3s ease-in-out;
    display: inline-block;
    /* Pastikan bisa diterapkan padding/margin dengan baik */
  }

  #hero .btn-get-started:hover {
    background: #007bff;
    border-color: #007bff;
    text-decoration: none;
  }


  /* Carousel Indicators */
  #hero-carousel-indicators {
    bottom: 20px;
    /* Sesuaikan posisi indikator */
    z-index: 2;
    /* Pastikan di atas overlay dan konten */
  }

  #hero-carousel-indicators li {
    background-color: rgba(255, 255, 255, 0.5);
    border: none;
  }

  #hero-carousel-indicators li.active {
    background-color: #fff;
  }

  /* Carousel Controls */
  #heroCarousel .carousel-control-prev,
  #heroCarousel .carousel-control-next {
    width: 5%;
    /* Sesuaikan lebar area klik */
    z-index: 2;
    /* Pastikan di atas overlay */
  }

  #heroCarousel .carousel-control-prev-icon,
  #heroCarousel .carousel-control-next-icon {
    font-size: 30px;
    /* Ukuran ikon */
  }


  /* Responsive Adjustments for Hero */
  @media (max-width: 991px) {

    /* Untuk tablet */
    #hero {
      height: calc(70vh - 0px);
      /* Adjusted height for responsive */
    }

    #hero .carousel-content h2 {
      font-size: 38px;
    }

    #hero .carousel-content p {
      font-size: 16px;
    }

    #hero .carousel-content {
      padding: 30px 25px;
    }
  }

  @media (max-width: 767px) {

    /* Untuk mobile */
    #hero {
      height: calc(60vh - 0px);
      /* Adjusted height for responsive */
    }

    #hero .carousel-content h2 {
      font-size: 28px;
      margin-bottom: 15px;
    }

    #hero .carousel-content p {
      font-size: 14px;
      width: 90%;
      margin: 0 auto 20px auto;
    }

    #hero .carousel-content {
      padding: 20px 15px;
    }

    #hero .btn-get-started {
      padding: 8px 20px;
      font-size: 14px;
    }

    #heroCarousel .carousel-control-prev,
    #heroCarousel .carousel-control-next {
      width: 10%;
      /* Lebih lebar area klik di mobile */
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
        @php
        $bgImage = asset('storage/' . $slider->img_slider);
        @endphp
        <div class="{{ $key === 0 ? 'carousel-item active' : 'carousel-item' }}"
          style="background-image: url('{{ $bgImage }}');">
          <div class="carousel-container">
            <div class="carousel-content container">
              <h2 class="animate__animated animate__fadeInDown">{{ $slider->judul }}</h2>
              <p class="animate__animated animate__fadeInUp">{{ $slider->deskripsi }}</p>
              <a href="{{ $slider->link_btn }}"
                class="btn-get-started animate__animated animate__fadeInUp scrollto">Baca Selengkapnya</a>
            </div>
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

<section id="services" class="services">
  <div class="container" data-aos="fade-up">
    <div class="row text-center">
      <div class="col-lg-3 col-md-6 icon-box" data-aos="fade-up">
        <a href="/data-desa" class="d-inline-flex align-items-center justify-content-center rounded-circle mb-2 icon-link">
          <i class="bi bi-bar-chart-line-fill fs-4 text-primary"></i>
        </a>
        <h4 class="title mt-2">Data Penduduk</h4>
      </div>
      <div class="col-lg-3 col-md-6 icon-box" data-aos="fade-up">
        <a href="/peta-desa" class="d-inline-flex align-items-center justify-content-center rounded-circle mb-2 icon-link">
          <i class="bi bi-globe-asia-australia fs-4 text-success"></i>
        </a>
        <h4 class="title mt-2">Peta Kecamatan</h4>
      </div>
      <div class="col-lg-3 col-md-6 icon-box" data-aos="fade-up">
        <a href="/umkm" class="d-inline-flex align-items-center justify-content-center rounded-circle mb-2 icon-link">
          <i class="bi bi-shop fs-4 text-warning"></i>
        </a>
        <h4 class="title mt-2">UMKM</h4>
      </div>
      <div class="col-lg-3 col-md-6 icon-box" data-aos="fade-up">
        <a href="/kontak" class="d-inline-flex align-items-center justify-content-center rounded-circle mb-2 icon-link">
          <i class="bi bi-telephone-forward fs-4 text-danger"></i>
        </a>
        <h4 class="title mt-2">Hubungi Kami</h4>
      </div>
    </div>
  </div>
</section>

{{-- ======= Video Section ======= --}}
<section id="video" class="services mx-4">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2>Video Profile</h2>
    </div>
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <iframe width="100%" height="500" src="{{ $videoProfil->url_video }}" frameborder="0" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</section>

{{-- ======= Instagram Section ======= --}}
<section id="instagram-feed" class="my-5">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2>Instagram Feed</h2>
    </div>
    <div class="row">
      <div class="col-12">
        <!-- SociableKIT Instagram Feed -->
        <div class='sk-instagram-feed' data-embed-id='25586001'></div>
        <script src='https://widgets.sociablekit.com/instagram-feed/widget.js' defer></script>
      </div>
    </div>
  </div>
</section>


{{-- ======= Berita Section ======= --}}
<section id="berita" class="services mx-4">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2>Berita Kecamatan</h2>
    </div>
    <div class="row">
      @foreach ($beritas as $berita)
      <div class="col-lg-4 col-md-6 mb-3" data-aos="fade-up">
        <div class="count-box news-card">
          <div class="card">
            {{-- Make the image clickable and add hover animation --}}
            <a href="/berita/{{ $berita->slug }}" class="d-block" style="overflow: hidden;">
              <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="card-img-top" style="transition: transform 0.3s ease-in-out;">
            </a>
            <div class="card-body">
              {{-- Also make the title clickable for a better user experience --}}
              <h5 class="card-title">
                <a href="/berita/{{ $berita->slug }}" style="text-decoration: none; color: inherit;">
                  {{ $berita->judul }}
                </a>
              </h5>
              <p class="card-text">{{ $berita->excerpt }}</p>
              <div class="news-date">{{ $berita->created_at->diffForHumans() }}</div>
            </div>
            <div class="card-footer">
              <a href="/berita/{{ $berita->slug }}" type="button" class="btn btn-link float-end">Selengkapnya</a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      <div class="button" style="text-align: center">
        <a class="btn btn-primary mx-auto" href="/berita" role="button">Lihat Semua</a>
      </div>
    </div>
  </div>
</section>

<style>
  /* Styling for the main section title "Berita Kecamatan" */
  .section-title h2 {
    color: #000;
    text-align: center;
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 1.5rem;
  }

  /* Styles for Berita Section cards */
  .news-card .card {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    border: none;
    display: flex;
    flex-direction: column;
    height: 100%;
  }

  .news-card .card-img-top {
    height: 200px;
    object-fit: cover;
    width: 100%;
    /* The transition is now inline on the image itself */
  }

  /* Hover effect for the image */
  .news-card .card-img-top:hover {
    transform: scale(1.05);
    /* Slightly enlarge image on hover */
  }

  .news-card .card-body {
    padding: 1.5rem;
    flex-grow: 1;
  }

  .news-card .card-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    color: #000;
    /* Ensuring title is black */
  }

  .news-card .news-date {
    font-size: 0.85rem;
    color: #777;
    margin-bottom: 0.5rem;
  }

  .news-card .card-text {
    text-align: justify;
    font-size: 0.95rem;
    color: #555;
    line-height: 1.6;
    height: 75px;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .news-card .card-footer {
    background-color: white;
    border-top: 1px solid #eee;
    padding: 1rem 1.5rem;
  }

  .news-card .btn-link {
    font-size: 0.95rem;
    font-weight: 500;
    color: #007bff;
    text-decoration: none;
  }

  .news-card .btn-link:hover {
    text-decoration: underline;
  }
</style>

{{-- SKM Section --}}
<section id="skm" class="px-4 pt-12 pb-8 bg-gray-50"> {{-- py-8 diubah menjadi pt-12 dan pb-8 --}}
  {{-- Container for overall content centering and max-width --}}
  <div class="container mx-auto max-w-7xl">
    {{-- Header asli diubah menjadi section-title --}}
    <div class="section-title">
      <h2>SURVEI KEPUASAN MASYARAKAT</h2> {{-- Mengubah h1 menjadi h2 agar konsisten dengan section-title lainnya --}}
    </div>

    @if ($skm)
    {{-- SKM Summary Box --}}
    <div class="skm-summary-box mx-auto mb-12 max-w-4xl">
      {{-- H2 untuk unit_kerja sekarang ada di dalam card ini --}}
      <h2 class="text-xl md:text-2xl font-semibold text-gray-700 mb-6 text-center w-full">{{ $skm['unit_kerja'] ?? 'Unit Kerja' }}</h2>
      <div class="skm-score-circle">
        <span>{{ number_format($skm['total_skor'], 2) }}</span>
      </div>
      <div class="text-center mt-4">
        <h3 class="text-2xl font-semibold text-gray-800 mb-1">{{ strtoupper($skm['keterangan']) }}</h3>
        <p class="text-lg text-gray-600">Grade: <span class="font-medium">{{ $skm['grade'] }}</span></p>
      </div>
      <div class="skm-progress-indicator mt-4">
        <div class="skm-progress-fill"
          style="--skm-progress-width: {{ number_format($skm['total_skor'], 2) }}%;"></div>
      </div>
      <p class="text-sm text-gray-500 mt-3 mb-4">Nilai Indeks Kepuasan Masyarakat</p>
      <span class="font-semibold text-gray-700">Periode Survei</span>
      <span class="text-gray-600">{{ $skm['periode_survey'] ?? 'N/A' }}</span>
    </div>

    {{-- Data Responden Card --}}
    <div class="skm-detail-card mx-auto mb-12 max-w-4xl">
      <div class="skm-detail-card-header mb-4">
        <div class="skm-icon-square">
          <i class="bi bi-people-fill"></i>
        </div>
        <h3 class="mt-2">Data Responden</h3>
      </div>
      <div class="skm-total-box mb-6">
        <p class="label">Total Responden</p>
        <p class="number">{{ $skm['total_responden'] }}</p>
        <p class="sub-label">Orang</p>
      </div>
      <div class="mt-4">
        <h4 class="text-lg font-semibold text-gray-700 mb-3">Jenis Kelamin</h4>
        @php
        $total_jk = ($skm['jk_pria'] ?? 0) + ($skm['jk_wanita'] ?? 0);
        @endphp
        <div class="space-y-3">
          <div class="skm-data-item">
            <span>Laki-laki</span>
            @php
            $persen_pria = $total_jk > 0 ? (($skm['jk_pria'] ?? 0) / $total_jk) * 100 : 0;
            @endphp
            <span>{{ $skm['jk_pria'] ?? 0 }} ({{ number_format($persen_pria, 1) }}%)</span>
          </div>
          <div class="skm-progress-indicator mt-1">
            <div class="skm-progress-fill"
              style="--skm-progress-width: {{ number_format($persen_pria, 1) }}%;"></div>
          </div>
          <div class="skm-data-item mt-3">
            <span>Perempuan</span>
            @php
            $persen_wanita = $total_jk > 0 ? (($skm['jk_wanita'] ?? 0) / $total_jk) * 100 : 0;
            @endphp
            <span>{{ $skm['jk_wanita'] ?? 0 }} ({{ number_format($persen_wanita, 1) }}%)</span>
          </div>
          <div class="skm-progress-indicator mt-1">
            <div class="skm-progress-fill"
              style="--skm-progress-width: {{ number_format($persen_wanita, 1) }}%;"></div>
          </div>
        </div>
      </div>
    </div>

    {{-- Tingkat Pendidikan Card --}}
    <div class="skm-detail-card mx-auto mb-12 max-w-4xl">
      <div class="skm-detail-card-header mb-4">
        <div class="skm-icon-square">
          <i class="bi bi-mortarboard-fill"></i>
        </div>
        <h3 class="mt-2">Tingkat Pendidikan Responden</h3>
      </div>
      <div class="space-y-4 pt-4">
        @php
        $total_pendidikan = array_sum(array_column($skm['pendidikan'] ?? [], 'value'));
        @endphp
        @forelse ($skm['pendidikan'] ?? [] as $item)
        <div class="mb-3">
          <div class="skm-data-item">
            <span>{{ $item['name'] }}</span>
            @php
            $persen_pendidikan = $total_pendidikan > 0 ? ($item['value'] / $total_pendidikan) * 100 : 0;
            @endphp
            <span>{{ $item['value'] }} Orang ({{ number_format($persen_pendidikan, 1) }}%)</span>
          </div>
          <div class="skm-progress-indicator mt-1">
            <div class="skm-progress-fill"
              style="--skm-progress-width: {{ number_format($persen_pendidikan, 1) }}%;"></div>
          </div>
        </div>
        @empty
        <p class="text-gray-500 text-center py-4">Data pendidikan tidak tersedia.</p>
        @endforelse
      </div>
    </div>

    {{-- Pekerjaan Responden Card --}}
    <div class="skm-detail-card mx-auto mb-12 max-w-4xl">
      <div class="skm-detail-card-header mb-4">
        <div class="skm-icon-square">
          <i class="bi bi-briefcase-fill"></i>
        </div>
        <h3 class="mt-2">Pekerjaan Responden</h3>
      </div>
      <div class="space-y-4 pt-4">
        @php
        $total_pekerjaan = array_sum(array_column($skm['pekerjaan'] ?? [], 'value'));
        @endphp
        @forelse ($skm['pekerjaan'] ?? [] as $item)
        <div class="mb-3">
          <div class="skm-data-item">
            <span>{{ $item['name'] }}</span>
            @php
            $persen_pekerjaan = $total_pekerjaan > 0 ? ($item['value'] / $total_pekerjaan) * 100 : 0;
            @endphp
            <span>{{ $item['value'] }} Orang ({{ number_format($persen_pekerjaan, 1) }}%)</span>
          </div>
          <div class="skm-progress-indicator mt-1">
            <div class="skm-progress-fill"
              style="--skm-progress-width: {{ number_format($persen_pekerjaan, 1) }}%;"></div>
          </div>
        </div>
        @empty
        <p class="text-gray-500 text-center py-4">Data pekerjaan tidak tersedia.</p>
        @endforelse
      </div>
    </div>

    @else
    <p class="text-red-500 text-center text-lg mt-8 py-6">Data SKM tidak tersedia untuk ditampilkan.</p>
    @endif
  </div>
</section>
@endsection