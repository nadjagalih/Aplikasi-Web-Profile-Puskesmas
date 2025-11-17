@extends('layouts.main')

@section('content')

<style>
  /* Styling for the main section title "Kontak Kami" */
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

  /* No other styles are changed here as per your request. */
</style>

<section id="contact" class="contact">
  <div class="container py-5" data-aos="fade-up">

    <div class="section-title text-center mb-5">
      <h2>Kontak Kami</h2>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="row row-cols-1 row-cols-md-2 g-4">

          <div class="col">
            <div class="card h-100 shadow text-center">
              <div class="card-body p-0">
                @if($kontak->map_url)
                <iframe
                  width="100%"
                  height="300"
                  frameborder="0"
                  style="border:0;"
                  allowfullscreen=""
                  loading="lazy"
                  referrerpolicy="no-referrer-when-downgrade"
                  id="gmap_canvas"
                  src="{{ $kontak->map_url }}">
                </iframe>
                @else
                <iframe
                  width="100%"
                  height="300"
                  frameborder="0"
                  style="border:0;"
                  allowfullscreen=""
                  loading="lazy"
                  referrerpolicy="no-referrer-when-downgrade"
                  id="gmap_canvas"
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d252760.86139202642!2d111.47004833973135!3d-8.163560447044588!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e791ad33bad6389%3A0x19f173f90f85d9be!2sTrenggalek%2C%20Kabupaten%20Trenggalek%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1762759569624!5m2!1sid!2sid">
                </iframe>
                @endif
              </div>
            </div>
          </div>

          <div class="col">
            <a href="https://wa.me/62{{ $kontak->no_hp }}" target="_blank" class="text-decoration-none text-dark h-100 d-block">
              <div class="card h-100 shadow text-center d-flex flex-column justify-content-center py-4">
                <div class="card-body">
                  <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" width="60" class="mx-auto mb-3">
                  <h5>WhatsApp</h5>
                  <p>Submit your conversation</p>
                  <span class="btn btn-success btn-sm rounded-pill px-3 mt-2">
                    Hubungi via WA
                  </span>
                </div>
              </div>
            </a>
          </div>

          <div class="col">
            <a href="#" 
               class="text-decoration-none text-dark h-100 d-block email-contact-link" 
               data-email="{{ base64_encode($kontak->email) }}"
               onclick="event.preventDefault(); window.location.href='mailto:'+atob(this.dataset.email);">
              <div class="card h-100 shadow text-center d-flex flex-column justify-content-center py-4">
                <div class="card-body">
                  <img src="https://upload.wikimedia.org/wikipedia/commons/4/4e/Gmail_Icon.png" alt="Gmail" width="60" class="mx-auto mb-3">
                  <h5>Gmail</h5>
                  <p>Submit your questions</p>
                  <span class="btn btn-danger btn-sm rounded-pill px-3 mt-2">
                    Kirim Email
                  </span>
                </div>
              </div>
            </a>
          </div>

          <div class="col">
            <a href="{{ $kontak->instagram_url }}" target="_blank" class="text-decoration-none text-dark h-100 d-block">
              <div class="card h-100 shadow text-center d-flex flex-column justify-content-center py-4">
                <div class="card-body">
                  <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram" width="60" class="mx-auto mb-3">
                  <h5>Instagram</h5>
                  <p>Connect & follow information</p>
                  <span class="btn btn-sm rounded-pill px-3 mt-2" style="background-color: #C13584; color: white;">
                    Lihat Instagram
                  </span>
                </div>
              </div>
            </a>
          </div>

        </div>
      </div>
    </div>

  </div>
</section>
@endsection