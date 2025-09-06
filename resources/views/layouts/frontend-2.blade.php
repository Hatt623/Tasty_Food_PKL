<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Tasty Food</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{asset('assets/frontend/img/favicon.png')}}" rel="icon">
  <link href="{{asset('assets/frontend/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/frontend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/frontend/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/frontend/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('assets/frontend/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/frontend/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  @yield('styles')

  <!-- Main CSS File -->
  <link href="{{asset('assets/frontend/css/main.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Yummy
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">
  
  {{-- Navbar --}}
  @include('layouts.components-frontend.navbar-2')
  {{-- akhir navbar --}}

  {{-- Content --}}
  @yield('content')
  {{-- Akhir content --}}

  {{-- Footer --}}
  @include('layouts.components-frontend.footer')
  {{-- Akhir Footer --}}
  

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/frontend/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('assets/frontend/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('assets/frontend/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('assets/frontend/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('assets/frontend/vendor/swiper/swiper-bundle.min.js')}}"></script>

  <!-- Main JS File -->
  <script src="{{asset('assets/frontend/js/main.js')}}"></script>
  @stack('scripts')


  {{-- JS baru --}}
  @yield('js')
  @yield('scripts')
  @include('sweetalert::alert')

</body>

</html>