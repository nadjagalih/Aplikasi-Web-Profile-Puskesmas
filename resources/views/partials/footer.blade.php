<style>
  #footer {
    background: #0F8A4C !important;
    padding: 0 0 30px 0 !important;
  }

  #footer .footer-top {
    background: #0F8A4C !important;
    border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
    padding: 60px 0 30px 0 !important;
  }

  #footer .container {
    max-width: 1320px !important;
    margin: 0 auto !important;
  }

  #footer .footer-info h3 {
    color: white !important;
    font-size: 24px !important;
    margin: 0 0 20px 0 !important;
    font-weight: 700 !important;
  }

  #footer .footer-info p {
    color: rgba(255, 255, 255, 0.9) !important;
    font-size: 14px !important;
    line-height: 24px !important;
  }

  #footer .footer-links h4 {
    color: white !important;
    font-size: 16px !important;
    font-weight: 700 !important;
    margin-bottom: 15px !important;
  }

  #footer .footer-links ul {
    list-style: none !important;
    padding: 0 !important;
    margin: 0 !important;
  }

  #footer .footer-links ul li {
    padding: 5px 0 !important;
  }

  #footer .footer-links ul li a {
    color: rgba(255, 255, 255, 0.85) !important;
    text-decoration: none !important;
    transition: 0.3s !important;
  }

  #footer .footer-links ul li a:hover {
    color: white !important;
    padding-left: 5px !important;
  }

  #footer .footer-links ul li i {
    color: rgba(255, 255, 255, 0.7) !important;
    font-size: 12px !important;
    margin-right: 8px !important;
  }

  #footer .copyright {
    color: rgba(255, 255, 255, 0.9) !important;
    border-top: 1px solid rgba(255, 255, 255, 0.2) !important;
    padding-top: 30px !important;
    text-align: center !important;
    font-size: 14px !important;
  }

  #footer .footer-links a img:hover {
    transform: scale(1.1);
  }
</style>

<!-- ======= Footer ======= -->
<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row">

        <div class="col-lg-4 col-md-6 footer-info">
          <img src="{{ asset('storage/' . $logo->logo) }}" class="mb-2" alt="Logo" width="250">
          <h3>{{ $nm_puskesmas }}</h3>
          <p>
            Kecamatan {{ $kecamatan }}, Kabupaten {{ $kabupaten }}, <br> Provinsi {{ $provinsi }}, Kode Pos {{ $kode_pos }}<br>
            <strong>Nomor HP :</strong> {{ $no_hp }}<br>
            <strong>Email :</strong> {{ $email }}<br>
          </p>
          
          <!-- Map Section -->
          <div class="mt-3">
            @if($kontak->map_url)
            <iframe
              width="100%"
              height="200"
              frameborder="0"
              style="border:0; border-radius: 8px;"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              src="{{ $kontak->map_url }}">
            </iframe>
            @else
            <iframe
              width="100%"
              height="200"
              frameborder="0"
              style="border:0; border-radius: 8px;"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d252760.86139202642!2d111.47004833973135!3d-8.163560447044588!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e791ad33bad6389%3A0x19f173f90f85d9be!2sTrenggalek%2C%20Kabupaten%20Trenggalek%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1762759569624!5m2!1sid!2sid">
            </iframe>
            @endif
          </div>
        </div>

        <div class="col-lg-2 col-md-6 footer-links">
          <h4>Menu Utama</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="/">Beranda</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-6 footer-links">
          <h4>Informasi</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="/berita">Berita</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="/pengumuman">Pengumuman</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="/agenda">Agenda</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="/gallery">Galeri</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="/berkas">Berkas</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-6 footer-links">
          <h4>Profil & Layanan</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="/sambutan">Sambutan</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="/profil">Profil Puskesmas</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="/visi-misi">Visi & Misi</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="/struktur-organisasi">Struktur Organisasi</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="/alur-pelayanan">Alur Pelayanan</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-6 footer-links">
          <h4>Hubungi Kami</h4>
          <div class="d-flex gap-3 mt-3">
            <a href="https://wa.me/62{{ $kontak->no_hp }}" target="_blank" class="text-decoration-none" title="WhatsApp">
              <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" width="40" height="40" style="transition: transform 0.3s;">
            </a>
            <a href="#" 
               class="text-decoration-none email-contact-link" 
               data-email="{{ base64_encode($kontak->email) }}"
               onclick="event.preventDefault(); window.location.href='mailto:'+atob(this.dataset.email);"
               title="Gmail">
              <img src="https://upload.wikimedia.org/wikipedia/commons/4/4e/Gmail_Icon.png" alt="Gmail" width="40" height="40" style="transition: transform 0.3s;">
            </a>
            <a href="{{ $kontak->instagram_url }}" target="_blank" class="text-decoration-none" title="Instagram">
              <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram" width="40" height="40" style="transition: transform 0.3s;">
            </a>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="container">
    <div class="copyright">
      <strong>2025 &copy;</strong> Dinas Komunikasi dan Informatika Kab. Trenggalek</a>
    </div>
  </div>
</footer><!-- End Footer -->