<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Authentication - {{ $situs->nm_puskesmas ?? 'Puskesmas' }}</title>
  <!-- Favicons - Multiple sizes for better compatibility -->
  <link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico?v=2">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon-32x32.png?v=2">
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicon-16x16.png?v=2">
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/apple-touch-icon.png?v=2">
  <link rel="manifest" href="/assets/img/site.webmanifest?v=2">
  <!-- Bootstrap CSS (Local) -->
  <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('admin/assets/css/styles.min.css') }}" />
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">

          @yield('auth')

        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- Bootstrap JS (Local) -->
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
</body>

</html>