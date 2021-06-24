<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @livewireStyles
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- Font Awesome CSS --}}
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome-4.7/css/font-awesome.css') }}">
    
    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/venobox/venobox.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">
    
</head>
<body style="background-color: #fff">
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        @yield('header-nav')
    </header><!-- End Header -->

    <div class="container-fluid">
        @yield('content')
    </div>
    
    
    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-6 text-lg-left text-center">
                    <div class="copyright">
                        &copy; Copyright <strong>BITC</strong>. All Rights Reserved
                    </div>
                    <div class="credits">
                        Designed by <a href="#">AHAAAY</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="footer-links text-lg-right text-center pt-2 pt-lg-0">
                    </nav>
                </div>
            </div>
        </div>
    </footer><!-- End Footer -->

    @livewireScripts

    <!-- Vendor JS Files -->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
    <script src="{{asset('assets/vendor/waypoints/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('assets/vendor/counterup/counterup.min.js')}}"></script>
    <script src="{{asset('assets/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/vendor/venobox/venobox.min.js')}}"></script>
    <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>

    {{-- <script src="{{asset('js/jQuery-Form.min.js')}}"></script> --}}
    
    <!-- Template Main JS File -->
    <script src="{{asset('assets/js/main.js')}}"></script>
    
    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('scripts')
</body>
</html>