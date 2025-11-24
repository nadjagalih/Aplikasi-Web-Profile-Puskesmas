<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Dashboard Admin') - Puskesmas</title>
  <!-- Favicons - Multiple sizes for better compatibility -->
  <link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico?v=2">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon-32x32.png?v=2">
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicon-16x16.png?v=2">
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/apple-touch-icon.png?v=2">
  <link rel="manifest" href="/assets/img/site.webmanifest?v=2">
  <link rel="stylesheet" href="/admin/assets/css/styles.min.css" />

  <!-- jQuery (Local) -->
  <script src="/vendor/jquery/jquery-3.7.1.min.js"></script>

  <!-- Datatable CSS (Local) -->
  <link rel="stylesheet" href="/vendor/datatables/css/dataTables.bootstrap5.min.css">

  <!-- Bootstrap Icon (Local) -->
  <link rel="stylesheet" href="/vendor/bootstrap-icons/bootstrap-icons.min.css">

  <!-- CKEditor 5 (Local) -->
  <script src="/vendor/ckeditor5/ckeditor.js"></script>

  <!-- Appex -->
  <script src="/admin/assets/libs/apexcharts/dist/apexcharts.min.js"></script>

  @stack('styles')
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    @include('admin.partials.sidebar')
    <div class="body-wrapper">
      @include('admin.partials.header')
      <div class="container-fluid">
        @yield('content')
        @include('admin.partials.footer')
      </div>
    </div>
  </div>
  <script src="/admin/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="/admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables (Local) -->
  <script src="/vendor/datatables/js/jquery.dataTables.min.js"></script>
  <script src="/vendor/datatables/js/dataTables.bootstrap5.min.js"></script>
  <script src="/admin/assets/js/sidebarmenu.js"></script>
  <script src="/admin/assets/js/app.min.js"></script>
  <script src="/admin/assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="/admin/assets/js/dashboard.js"></script>
  <!-- Sweet Alert 2 (Local) -->
  <script src="/vendor/sweetalert2/sweetalert2.all.min.js"></script>
  @include('sweetalert::alert')
  <script>
    $(".swal-confirm").click(function(e) {
      e.preventDefault();
      var form = $(this).parents('form');
      Swal.fire({
        title: 'Apakah Kamu Yakin ?',
        text: "Data Akan Dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      })
    });
  </script>
  
  <!-- CKEditor & SweetAlert Diagnostic -->
  <script>
    // Verify local libraries loaded
    if (typeof ClassicEditor === 'undefined') {
      console.error('❌ CKEditor gagal load dari lokal!');
    } else {
      console.log('✅ CKEditor loaded successfully (local)');
    }
    
    if (typeof Swal === 'undefined') {
      console.error('❌ SweetAlert2 gagal load dari lokal!');
    } else {
      console.log('✅ SweetAlert2 loaded successfully (local)');
    }
  </script>
  
  @stack('scripts')
</body>

</html>
