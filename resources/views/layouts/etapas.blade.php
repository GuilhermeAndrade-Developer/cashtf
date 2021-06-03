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
            <div class="rodape_socio_procurador">
                <div class="container-fluid">
                    <div class="displayflex">
                        <div class="dflex1">
                            <span class="copyright_etapas">
                                ©Copyright {{date('Y')}}<b> {{env('APP_NAME')}} </b>Todos os Direitos Reservados
                            </span>
                        </div>
                        <div class="dflex1 text-right">
                            <!--<span class="copyright_etapas"><i>Desenvolvido por</i></span>
                            <img src="{{asset('images/footer_peexell_logo.png')}}" class="footer_peexell">-->
                        </div>
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
        <script type="text/javascript" src="{{ asset('js/jquery.mask.js') }}"></script><!-- Mask -->
        <script type="text/javascript" src="{{ asset('js/jquery.isotope.min.js') }}"></script><!-- isotope -->
        <script type="text/javascript" src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script><!-- magnific-popup -->
        <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script><!-- Scripts -->
        <script src="//code.jquery.com/jquery-latest.js"></script><!-- jquery-latest.js -->
        <script src="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script><!-- featherlight.min.js -->
    </body>
</html>

<script>
    $(document).ready(function(){
    $('.date').mask('00/00/0000');
    $('.time').mask('00:00:00');
    $('.date_time').mask('00/00/0000 00:00:00');
    $('.cep').mask('00000-000');
    $('.phone').mask('0000-0000');
    $('.phone_with_ddd').mask('(00) 0000-00000');
    $('.phone_us').mask('(000) 000-0000');
    $('.mixed').mask('AAA 000-S0S');
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
    $('.money2').mask("#.##0,00", {reverse: true});
    $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
        translation: {
        'Z': {
            pattern: /[0-9]/, optional: true
        }
        }
    });
    $('.ip_address').mask('099.099.099.099');
    $('.percent').mask('##0,00%', {reverse: true});
    $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
    $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
    $('.fallback').mask("00r00r0000", {
        translation: {
            'r': {
            pattern: /[\/]/,
            fallback: '/'
            },
            placeholder: "__/__/____"
        }
        });
    $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
    });
</script>