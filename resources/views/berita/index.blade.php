@extends('layouts.main')

@section('content')

<style>
  /* Styling for the main section title "Berita Kecamatan" */
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

  /* Styles for Berita Section cards */
  .news-card .card {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    border: none;
    display: flex;
    flex-direction: column;
    height: 100%;
    padding: 0 !important;
    margin: 0 !important;
  }

  /* Image wrapper link */
  .news-card .card > a {
    display: block !important;
    width: 100% !important;
    height: 250px !important;
    overflow: hidden !important;
    padding: 0 !important;
    margin: 0 !important;
    line-height: 0 !important;
    font-size: 0 !important;
    background: #f0f0f0;
    border: none !important;
    flex-shrink: 0;
  }

  .news-card .card-img-top {
    height: 250px !important;
    min-height: 250px !important;
    max-height: 250px !important;
    object-fit: cover !important;
    object-position: center !important;
    width: 100% !important;
    display: block !important;
    margin: 0 !important;
    padding: 0 !important;
    border: none !important;
    border-radius: 0 !important;
    vertical-align: top !important;
    transition: transform 0.3s ease-in-out;
  }

  /* Add hover effect to the image when wrapped in a link */
  .news-card .card a:hover .card-img-top {
    transform: scale(1.05);
  }

  .news-card .card-body {
    padding: 1.5rem !important;
    flex-grow: 1;
    margin: 0 !important;
  }

  .news-card .card-title {
    font-size: 1.25rem;
    /* Size for news titles */
    font-weight: 600;
    margin-bottom: 0.75rem;
    /* Space below title */
    color: #000;
    /* Sets the news title to black */
  }

  .news-card .news-date {
    font-size: 0.85rem;
    /* Smaller font for date */
    color: #777;
    /* Lighter gray for date */
    margin-bottom: 0.5rem;
    /* Space below date */
  }

  /* Styling for the news excerpt/paragraph text */
  .news-card .card-text {
    text-align: justify;
    /* Makes excerpt text justified (rata kanan-kiri) */
    font-size: 0.95rem;
    /* Font size for excerpt */
    color: #555;
    /* Darker gray for excerpt text */
    line-height: 1.6;
    /* Improved line height for readability */
    height: 75px;
    /* Fixed height for excerpt to ensure consistent card heights */
    overflow: hidden;
    /* Hides overflowing text */
    text-overflow: ellipsis;
    /* Adds ellipsis for truncated text */
  }

  .news-card .card-footer {
    background-color: white;
    /* White background for the footer */
    border-top: 1px solid #eee;
    /* Light border at the top */
    padding: 1rem 1.5rem;
    /* Padding in the footer */
  }

  .news-card .btn-link {
    font-size: 0.95rem;
    font-weight: 500;
    color: #007bff;
    /* Bootstrap primary blue */
    text-decoration: none;
  }

  .news-card .btn-link:hover {
    text-decoration: underline;
    /* Underline on hover */
  }

  /* Styling for pagination links */
  .pagination {
    justify-content: center;
    /* Centers the pagination links */
    margin-top: 2rem;
    /* Space above pagination */
  }

  .page-link {
    border-radius: 5px;
    /* Rounded pagination buttons */
    margin: 0 3px;
  }
</style>

<section class="counts section-bg">
  <div class="container">
    <div class="section-title">
      <h2>Berita Puskesmas</h2>
    </div>

    <div class="row">
      @foreach ($beritas as $berita)
      <div class="col-lg-4 col-md-6 mb-3" data-aos="fade-up">
        <div class="count-box news-card">
          <div class="card">
            {{-- Wrap the image with an anchor tag to link to the detail page --}}
            <a href="/berita/{{ $berita->slug }}">
              @if($berita->gambar && file_exists(storage_path('app/public/' . $berita->gambar)))
                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="card-img-top">
              @else
                <img src="https://via.placeholder.com/400x250/0d6efd/ffffff?text=Gambar+Tidak+Tersedia" alt="Gambar Berita" class="card-img-top">
              @endif
            </a>
            <div class="card-body">
              {{-- Also make the title clickable for a better user experience --}}
              <h5 class="card-title">
                <a href="/berita/{{ $berita->slug }}" style="text-decoration: none; color: inherit;">
                  {{ $berita->judul }}
                </a>
              </h5>
              <div class="news-date">{{ $berita->created_at->diffForHumans() }}</div>
              <p class="card-text">{{ $berita->excerpt }}</p>
            </div>
            <div class="card-footer">
              <a href="/berita/{{ $berita->slug }}" type="button" class="btn btn-link float-end">Selengkapnya</a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    {{ $beritas->links() }}

  </div>
</section>
@endsection