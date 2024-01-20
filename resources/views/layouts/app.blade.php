<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Socialprise</title>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Fontfaces CSS-->
  <link href="{{ asset('assets/css/font-face.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('assets/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('assets/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('assets/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
    media="all">

  <!-- Bootstrap CSS-->
  <link href="{{ asset('assets/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

  <!-- Vendor CSS-->
  <link href="{{ asset('assets/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet"
    media="all">
  <link href="{{ asset('assets/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('assets/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('assets/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('assets/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

  <!-- Main CSS-->
  <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet" media="all">

  <!-- Animation -->
  <link rel="stylesheet" href="{{ asset('assets/css/animation.css') }}">

  <!-- Custom -->
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body class="animsition">
  <div class="page-wrapper">
    @include('layouts._mobile_menu')

    @include('layouts._sidebar')

    <!-- PAGE CONTAINER-->
    <div class="page-container">
      @include('layouts._header')

      <!-- MAIN CONTENT-->
      <div class="main-content">
        <div class="section__content section__content--p30 px-1">
          <div class="container-fluid">
            @include('layouts._alert')

            @yield('content')
          </div>
        </div>
      </div>
      <!-- END MAIN CONTENT-->
    </div>
    <!-- END PAGE CONTAINER-->
  </div>

  <!-- Jquery JS-->
  <script src="{{ asset('assets/vendor/jquery-3.2.1.min.js') }}"></script>
  <!-- Bootstrap JS-->
  <script src="{{ asset('assets/vendor/bootstrap-4.1/popper.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
  <!-- Vendor JS       -->
  <script src="{{ asset('assets/vendor/slick/slick.min.js') }}">
  </script>
  <script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/animsition/animsition.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
  </script>
  <script src="{{ asset('assets/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/counter-up/jquery.counterup.min.js') }}">
  </script>
  <script src="{{ asset('assets/vendor/circle-progress/circle-progress.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/select2/select2.min.js') }}">
  </script>

  <!-- Main JS-->
  <script src="{{ asset('assets/js/main.js') }}"></script>

  @yield('scripts')
</body>

</html>