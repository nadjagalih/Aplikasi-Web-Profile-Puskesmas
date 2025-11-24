<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Admin - Kecamatan Panggul</title>
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
    // jQuery-based delete confirmation for backward compatibility
    $(document).ready(function() {
      // Handle swal-confirm buttons with data-form attribute
      $(document).on('click', '.swal-confirm', function(e) {
        e.preventDefault();
        var formId = $(this).attr('data-form') || $(this).data('form');
        
        if (formId) {
          var form = $('#' + formId);
          
          if (form.length > 0) {
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
        }
      });
      
      // Handle delete-form class (for menu.blade.php and others)
      $(document).on('submit', '.delete-form', function(e) {
        e.preventDefault();
        var form = $(this);
        
        Swal.fire({
          title: 'Hapus Data Ini?',
          text: "Data ini akan dihapus permanen!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya, Hapus!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            // Remove event handler to prevent infinite loop, then submit
            form.off('submit').submit();
          }
        });
      });
      
      // Handle inline confirm (for berkas, agenda, alur-pelayanan)
      $('form[onsubmit*="confirm"]').each(function() {
        var form = $(this);
        var originalOnsubmit = form.attr('onsubmit');
        
        // Remove inline onsubmit
        form.removeAttr('onsubmit');
        
        // Add SweetAlert handler
        form.on('submit', function(e) {
          e.preventDefault();
          
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
              form.off('submit').submit();
            }
          });
        });
      });
    });
  </script>
  
  <!-- CKEditor & SweetAlert loaded from local files -->
  <script>
    console.log('CKEditor loaded:', typeof ClassicEditor !== 'undefined');
    console.log('SweetAlert loaded:', typeof Swal !== 'undefined');
  </script>
  
  @stack('scripts')
</body>

</html>