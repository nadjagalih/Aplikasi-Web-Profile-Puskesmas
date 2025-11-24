<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ $nm_puskesmas ?? 'Puskesmas Suruh' }}</title>
  <meta content="{{ $nm_puskesmas ?? 'Puskesmas Suruh' }} - Layanan Kesehatan Masyarakat" name="description">
  <meta content="puskesmas, {{ strtolower($nm_puskesmas ?? 'suruh') }}, kesehatan, layanan kesehatan" name="keywords">

  <!-- Favicons - Multiple sizes for better compatibility -->
  <link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico?v=2">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon-32x32.png?v=2">
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicon-16x16.png?v=2">
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/apple-touch-icon.png?v=2">
  <link rel="manifest" href="/assets/img/site.webmanifest?v=2">

  <!-- Google Fonts (Local) -->
  <link href="/vendor/fonts/fonts.css" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/assets/css/style.css" rel="stylesheet">

  <!-- Chart.js (Local) -->
  <script src="/vendor/chartjs/chart.umd.min.js"></script>
</head>

<body>

  @include('partials.header')

  <main id="main">

    @yield('content')

  </main><!-- End #main -->

  @include('partials.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="/assets/vendor/aos/aos.js"></script>
  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/assets/js/main.js"></script>

  <!-- Sweet Alert 2 (Local) -->
  <script src="/vendor/sweetalert2/sweetalert2.all.min.js"></script>
  @include('sweetalert::alert')
  
  <script>
    // Delete confirmation with SweetAlert
    document.addEventListener('DOMContentLoaded', function() {
      const deleteForms = document.querySelectorAll('.swal-confirm');
      
      deleteForms.forEach(button => {
        button.addEventListener('click', function(e) {
          e.preventDefault();
          const formId = this.getAttribute('data-form');
          const form = document.getElementById(formId);
          
          if (form) {
            Swal.fire({
              title: 'Hapus Data Ini?',
              text: "Anda tidak akan dapat mengembalikan data yang dihapus!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Ya, hapus!',
              cancelButtonText: 'Batal'
            }).then((result) => {
              if (result.isConfirmed) {
                form.submit();
              }
            });
          }
        });
      });
    });
  </script>

</body>

</html>