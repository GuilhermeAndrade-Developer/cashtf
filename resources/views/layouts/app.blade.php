<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{env('APP_NAME')}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/base_login.css') }}" />
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}"> 
    <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
</head>
    <body>
        @yield('content')
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <label class="copyright_login">
                            ©Copyright {{date('Y')}}<b> {{env('APP_NAME')}} </b>Todos os Direitos Reservados
                        </label>
                    </div>
                </div>
            </div>
        </footer>
        <!-- JS -->
        <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script><!-- jQuery -->
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script><!-- Bootstrap -->
        <script type="text/javascript" src="{{ asset('js/jquery.parallax.js') }}"></script><!-- Parallax -->
        <!--<script type="text/javascript" src="{{ asset('js/smoothscroll.js') }}"></script> Smooth Scroll -->
        <script type="text/javascript" src="{{ asset('js/masonry.pkgd.min.js') }}"></script><!-- masonry -->
        <script type="text/javascript" src="{{ asset('js/jquery.fitvids.js') }}"></script><!-- fitvids -->
        <script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script><!-- Owl-Carousel -->
        <script type="text/javascript" src="{{ asset('js/jquery.counterup.min.js') }}"></script><!-- CounterUp -->
        <script type="text/javascript" src="{{ asset('js/waypoints.min.js') }}"></script><!-- CounterUp -->
        <script type="text/javascript" src="{{ asset('js/jquery.isotope.min.js') }}"></script><!-- isotope -->
        <script type="text/javascript" src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script><!-- magnific-popup -->
        <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script><!-- Scripts -->
        <script src="//code.jquery.com/jquery-latest.js"></script><!-- jquery-latest.js -->
        <script src="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script><!-- featherlight.min.js -->
    </body>
</html>
