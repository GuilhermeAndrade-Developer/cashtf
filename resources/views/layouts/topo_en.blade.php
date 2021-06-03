<!DOCTYPE html>
<html lang="pt-br" ng-app="myApp">
<head>
	<meta charset="UTF-8">

	<title>CASHTF</title>

	<!-- Main CSS file -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.min.css') }}"><!-- Responsive Tables -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/magnific-popup.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/topo.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/drawer.min.css') }}"><!-- Menu Hamburguer -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/datepicker.min.css') }}" /><!-- Datas -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/component.css') }}" />
	<link rel="stylesheet" type="text/css" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.css" />
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"> <!-- Toggle Bootstrap -->

	<!-- Favicon -->
	<link rel="shortcut icon" href="{{ asset('/images/favicon.png')}}">
	<script src="js/jssor.slider-27.5.0.min.js" type="text/javascript"></script><!--SLIDER THUMB-->

  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{ asset('js/jquery.mask.js') }}"></script><!-- Responsive Tables -->

  	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-150900980-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-150900980-1');
	</script>
	<style>
		html {
			scroll-behavior: smooth;
		}
	</style>
</head>
<body class="drawer drawer--right">
<header id="header">	
		<nav class="navfixed">
			<div class="primeiro_topo hidden-xs hidden-sm">
				<div class="container navfixed">
					<div class="row">
						<div class="col-md-12 text-right">
							<a href="https://www.linkedin.com/company/cash-top-flow/" target="_blank">
								<img src="{{asset('images/linkedin_icn.png')}}" class="icones_padrao"> 
							</a>
							<a href="https://api.whatsapp.com/send?phone=5554999341799" title="Whatsapp" target="_blank">
								<img src="{{asset('/images/whatsapp_icn.png')}}" class="icones_padrao"> 
							</a>
							<a href="https://www.facebook.com/cashtfcombr-2373233199575105/" target="_blank">
								<img src="{{asset('/images/facebook_icn.png')}}" class="icones_padrao"> 
							</a>
							<a href="https://www.instagram.com/cashtf.com.br/?hl=pt-br" target="_blank">
								<img src="{{asset('/images/instagram_icn.png')}}" class="icones_padrao"> 
							</a>
							<a href="?i=pt" id="langPt" class="link_id" style="color: #FFF;">
								<span class="{{session('idioma') == 'pt' || session('idioma') == ''?'active':''}}">PT</span>
							</a>
							<a href="?i=en" id="langEn" class="link_id" style="color: #FFF">
								<span class="{{session('idioma') == 'en'?'active':''}}">EN</span>
							</a>
						</div>  
					</div>                
				</div>
			</div>	
			@php $path = Request::path(); @endphp
			<div class="second_top">
				<div class="container customed">
					<div class="navbar-header">
						<!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#st-navbar-collapse"> -->
						<button type="button" class="navbar-toggle collapsed" onclick="openNav()">
							<i class="fa fa-bars icone_menu" style="color: #151515; margin-top: 10px;"></i>
						</button>
						<a class="logo zindex_logo_fix" href="{{route('home')}}">
							<img src="images/logo_white.png" class="logo_colorido" alt="" style="width:150px;">
						</a>
						<a class="logo2 zindex_logo_fix" href="{{route('home')}}">
							<img src="images/logo_white.png" class="logo_colorido2" alt="" style="width:150px;">
						</a>
					</div> 
					<!--{{ $path == 'quem_somos'? route('home') : ''}}-->
					<div class="collapse navbar-collapse" id="st-navbar-collapse">
						<ul class="nav navbar-nav navbar-right link_menu">
							<li><a href="{{route('home')}}#how_works" class="links_rodape" style="margin-right: 0px; font-weight: bold;">HOW IT WORKS</a></li>
							<li class="quem"><a href="{{route('about')}}" class="links_rodape {{$page == 'about'?'active':''}}" style="margin-right: 0px; font-weight: bold;">ABOUT US</a></li>					
							<li><a href="{{route('home')}}#benefits" class="links_rodape" style="margin-right: 0px; font-weight: bold;">ADVANTAGES</a></li>
							<li><a href="{{route('home')}}#simulation" class="links_rodape" style="margin-right: 0px; font-weight: bold;">SIMULATION</a></li>
							<li><a href="{{route('invest')}}" class="links_rodape {{$page == 'invest'?'active':''}}" style="margin-right: 0px; font-weight: bold;">INVEST</a></li>
							<li><a href="{{route('login')}}" class="links_rodape" style="margin-right: 0px; font-weight: bold;"> <span class="button_nav_2">SIGN IN</span></a></li>
							<!-- <li><a href="{{route('register')}}" class="links_rodape" style="margin-right: 0px; font-weight: bold;"><span class="button_nav_2">CADASTRAR</span></a></li> -->
							<li class="just_fixed">
								<a href="?i=pt" id="langPt" class="link_id" style="color: #FFF;">
								<span class="{{session('idioma') == 'pt' || session('idioma') == ''?'active':''}}">PT</span>
							</a>
							<a href="?i=en" id="langEn" class="link_id" style="color: #FFF">
								<span class="{{session('idioma') == 'en'?'active':''}}">EN</span>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container -->
			</div><!-- SECOND -->

			<!-- OVERLAY NAV -->

			<div id="myNav" class="overlay">
				<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
				<div class="overlay-content">
					<ul class="list_overlay">
						<li><a href="{{ $path == 'quem_somos'? route('home') : ''}}#how_works" class="links_rodape" style="margin-right: 0px; font-weight: bold;" onclick="closeNav()">COMO FUNCIONA</a></li>
						<li class="quem"><a href="{{route('about')}}" class="links_rodape {{$page == 'about'?'active':''}}" style="margin-right: 0px; font-weight: bold;">QUEM SOMOS</a></li>	
						<li><a href="{{ $path == 'quem_somos'? route('home') : ''}}#benefits" class="links_rodape" style="margin-right: 0px; font-weight: bold;" onclick="closeNav()">VANTAGENS</a></li>
						<li><a href="{{ $path == 'quem_somos'? route('home') : ''}}#simulation" class="links_rodape" style="margin-right: 0px; font-weight: bold;" onclick="closeNav()">SIMULAÇÃO</a></li>
						<li><a href="{{route('invest')}}" class="links_rodape {{$page == 'invest'?'active':''}}" style="margin-right: 0px; font-weight: bold;">INVISTA</a></li>
						<li><a href="{{route('login')}}" class="links_rodape" style="margin-right: 0px; font-weight: bold;" onclick="closeNav()"> <span class="button_nav_2">ACESSAR</span></a></li>
						<!--<li><a href="{{route('register')}}" class="links_rodape" style="margin-right: 0px; font-weight: bold;" onclick="closeNav()"><span class="button_nav_2">CADASTRAR</span></a></li>-->
						<li class="into_li_flex">
							<a href="?i=pt" id="langPt" class="link_id" style="color: #FFF;">
								<span class="{{session('idioma') == 'pt' || session('idioma') == ''?'active':''}}">PT</span>
							</a>
							<a href="?i=en" id="langEn" class="link_id" style="color: #FFF">
								<span class="{{session('idioma') == 'en'?'active':''}}">EN</span>
							</a>
						</li>
						<li class="into_li_flex">
							<a href="https://www.linkedin.com/company/cash-top-flow/" target="_blank">
								<img src="{{asset('images/linkedin_icn.png')}}" class="icones_padrao"> 
							</a>
							<a href="https://api.whatsapp.com/send?phone=5554999929993" title="Whatsapp" target="_blank">
								<img src="{{asset('images/whatsapp_icn.png')}}" class="icones_padrao"> 
							</a>
							<a href="https://www.facebook.com//cashtfcombr-2373233199575105" target="_blank">
								<img src="{{asset('images/facebook_icn.png')}}" class="icones_padrao"> 
							</a>
							<a href="https://www.instagram.com/cashtf.com.br/?hl=pt-br" target="_blank">
								<img src="{{asset('images/instagram_icn.png')}}" class="icones_padrao"> 
							</a>
						</li>
					</ul>
				</div>
			</div>
			

		</nav>
	</header>
	<!-- Modal -->
	<div class="modal fade" id="logout" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-body">
					<p>Tem certeza que deseja sair?</p>
					</div>
					<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<a href="{{route('logout')}}" class="btn btn-danger">Sair</a>
				</div>
			</div>
		</div>
	</div>

    @yield('content')
	@extends('layouts.rodape_en')
	@section('content')

	<!-- JS -->
	<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script><!-- jQuery -->
	<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script><!-- Bootstrap -->
	<script type="text/javascript" src="{{ asset('js/jquery.parallax.js') }}"></script><!-- Parallax -->
	<script type="text/javascript" src="{{ asset('js/masonry.pkgd.min.js') }}"></script><!-- masonry -->
	<script type="text/javascript" src="{{ asset('js/jquery.fitvids.js') }}"></script><!-- fitvids -->
	<script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script><!-- Owl-Carousel -->
	<script type="text/javascript" src="{{ asset('js/jquery.counterup.min.js') }}"></script><!-- CounterUp -->
	<script type="text/javascript" src="{{ asset('js/jquery.isotope.min.js') }}"></script><!-- isotope -->
	<script type="text/javascript" src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script><!-- magnific-popup -->
	<script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script><!-- Scripts -->
	<script src="//code.jquery.com/jquery-latest.js"></script><!-- jquery-latest.js -->
	<script src="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script><!-- featherlight.min.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> <!-- Toogle Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
	
	<script type="text/javascript">

		$(function(){
			$('.link_id').filter(function(){return this.href==location.href}).parent().addClass('active').siblings().removeClass('active')
			$('.link_id').click(function(){
				$(this).parent().addClass('active').siblings().removeClass('active')	
			})
		})

	</script>

	<script>
		function openNav() {
			document.getElementById("myNav").style.width = "100%";
		}

		function closeNav() {
			document.getElementById("myNav").style.width = "0%";
		}

		$(document).ready(function(){
			$('.date').mask('00/00/0000');
			$('.time').mask('00:00:00');
			$('.date_time').mask('00/00/0000 00:00:00');
			$('.cep').mask('00000-000');
			$('.phone').mask('0000-0000');
			$('.phone_with_ddd').mask('(00) 0000-0000');
			$('.phone_us').mask('(000) 000-0000');
			$('.mixed').mask('AAA 000-S0S');
			$('.cpf').mask('000.000.000-00', {reverse: true});
			$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
			$('.money').mask('000.000.000.000.000,00', {
				prefix: 'R$ ',
				reverse: true
			});
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
	</script><!-- Laravel Charts -->


</body>
</html>