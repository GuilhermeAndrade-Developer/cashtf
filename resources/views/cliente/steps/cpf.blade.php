<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>cashTF - Cliente</title>
		
		<!-- Main CSS file -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> 
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}" />
		<link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}" />
		<link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
		<link rel="stylesheet" href="{{asset('css/style.css')}}" />
		<link rel="stylesheet" href="{{asset('css/responsive.css')}}" />
		<link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">	
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
	</head>
	<body>
		<style type="text/css">
			::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
				color: #fff !important;
				opacity: 1; /* Firefox */
			}

			:-ms-input-placeholder { /* Internet Explorer 10-11 */
				color: #fff !important;
			}

			::-ms-input-placeholder { /* Microsoft Edge */
				color: #fff !important;
			}
			input:-webkit-autofill,
			input:-webkit-autofill:hover,
			input:-webkit-autofill:focus,
			input:-webkit-autofill:active {
				transition: background-color 5000s ease-in-out 0s;
				-webkit-text-fill-color: #fff !important;
			}
			.pr0{
				padding-right: 0px;
			}

			.link_esqueci{
				font-size: 11px;
				text-decoration: underline;
				color: #fff;
				font-weight: normal;
			}

			.icon_plus{
				font-size: 18px; margin-top: 1px;
			}
			.banner_home{
				background-image: url('../images/banner.jpg');
				background-repeat: no-repeat;
				background-size: cover;
				padding-top: 70px;
				padding-bottom: 70px;
			}
			.titulo_banner{
				font-size: 22px;
				text-transform: uppercase;
				color: #fff;
				line-height: 28px;
			}
			.subtitulo_banner{
				line-height: 42px;
				font-size: 36px;
				text-transform: uppercase;
				color: #fff;
			}
			body{
				background-image: url('{{asset('images/Grupo 4578.jpg')}}');
				background-size: cover;
				background-repeat: no-repeat;
				height: 100%;
			}
			html{
				height: 100%;
			}
			.title_style {
				font-size: 65px;
				color: #fff;
			}
			.rodape{
				background-color: #e0e0e0; color: #9b9b9b; padding-top: 20px; padding-bottom: 20px; position: absolute; bottom: 0; width: 100%;
			}
			.padding-form{
				padding-top: 20px;
				padding-bottom: 20px;
			}
			.input_padrao, .input_padrao > i{
				border-color: #fff !important;
				color: #fff !important;
				outline: initial;
			}
			
			.button_pink{
				background-color: transparent;
				border-color: #fff;
				color: #fff;
				border-radius: 0px;
				outline: initial !important;
			}
			.button_pink:hover, .button_pink:active, .button_pink:focus{
				background-color: #f11070;
				border-color: #f11070;
				color: #ffffff;
				border-radius: 0px;
			}
			.button_pink_active{
				background-color: #f11070;
				border-color: #f11070;
				color: #ffffff !important;
				border-radius: 0px;
				border: none !important;
			}
			.mt20{margin-top: 20px;}
			.texto_login{
				color: #fff;
				font-size: 26px;
				line-height: 26px;
			}
			.texto_login b{
				font-style: italic;
			}
			.copyright_login{
				color: #fff;
				font-size: 12px;
			}
			.mt60{
				margin-top: 60px;
			}
			.logo_login{
				width: 240px;
			}
			.div_geral_login{
				display: flex;
				justify-content: center;
				align-items: center;
				flex-direction: column;
				height: 100%;
			}
			.primeira_div{
				display: flex;
				justify-content: center;
				align-items: center;
				flex: 1;
			}
			.segunda_div{
				display: flex;
				justify-content: center;
				align-items: center;
				height: 100px;
			}
			.erro_cpf{
				margin-left: 15px;
				color: white;
			}
			@media (max-width: 768px){
				.rodape{
					position: static; width: 100%;
				}
				.padding-form{
					padding-top: 20px;
					padding-bottom: 20px;
				}
				.mt60{
					margin-top: 20px;
				}
				.logo_login{
					width: 180px;
				}
			}
		</style>
		
		<div class="div_geral_login" ng-app="myApp" ng-controller="myCtrl">
			<div class="primeira_div container padding-form">
            <form method="post" action="{{route('register.add.cpf')}}">
				@csrf
				<div class="row">
					<div class="col-md-12 text-center mb50">
						<img src="{{asset('images/logo_white.png')}}" style="width: 200px;">
					</div>
					<div class="col-md-offset-3 col-md-6">
						@php
							if(isset($error) && $error == 1){
								echo '<div id="erro" class="text-center font-weight-bold" style="background-color: #f11070; margin-top: 25px; margin-bottom: -10px; padding: 5px; color: #fff;">CPF inválido.</div>';
							}
							if(isset($error) && $error == 2){
								echo '<div id="erro" class="text-center font-weight-bold" style="background-color: #f11070; margin-top: 25px; margin-bottom: -10px; padding: 5px; color: #fff;">CNPJ inválido.</div>';
							}
							if(isset($error) && $error == 3){
								echo '<div id="erro" class="text-center font-weight-bold" style="background-color: #f11070; margin-top: 25px; margin-bottom: -10px; padding: 5px; color: #fff;">CPF ou CNPJ em uso.</div>';
							}
						@endphp
						<div class="row">
							<div class="col-md-12 mt20">
								<div class="input-group">
									<span class="input-group-addon input_padrao pr0"><i class="fa fa-user"></i></span>
									<input type="text" value="" name="cpf" class="form-control campo_quadrado input_padrao cpf" placeholder="Digite o seu cpf..." autocomplete="off" required data-toggle="tooltip" data-placement="top" title="CPF do sócio ou procurador">
								</div>
							</div>
							<div class="col-md-12 mt50">
								<div class="input-group">
									<span class="input-group-addon input_padrao pr0"><i class="fa fa-file"></i></span>
									<input type="text" value="" name="cnpj" class="form-control campo_quadrado input_padrao cnpj" placeholder="Digite o seu cnpj..." autocomplete="off" required data-toggle="tooltip" data-placement="top" title="CNPJ da empresa solicitante">
									<input type="hidden" value="{{$telefone}}" name="telefone">
									<input type="hidden" value="{{$id}}" name="id">
								</div>
							</div>
							<div class="col-md-12 mt40">
								<button ng-click="verificaDados()" class="btn btn-block button_pink" name="botao_cadastrar">PRÓXIMO</button>
							</div>
						</div>
					</div>
				</div>
				</form>
			</div>

			<div class="segunda_div container">
				<div class="row">
					<div class="col-md-12 text-center">
						<label class="copyright_login">
							©Copyright 2019<b> cashTF </b>Todos os Direitos Reservados
						</label>
					</div>
				</div>
			</div>
		</div>

		<!-- JS -->
		<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script><!-- jQuery -->
		<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script><!-- Bootstrap -->
		<script type="text/javascript" src="{{asset('js/jquery.parallax.js')}}"></script><!-- Parallax -->
		<script type="text/javascript" src="{{asset('js/smoothscroll.js')}}"></script><!-- Smooth Scroll -->
		<script type="text/javascript" src="{{asset('js/masonry.pkgd.min.js')}}"></script><!-- masonry -->
		<script type="text/javascript" src="{{asset('js/jquery.fitvids.js')}}"></script><!-- fitvids -->
		<script type="text/javascript" src="{{asset('js/owl.carousel.min.js')}}"></script><!-- Owl-Carousel -->
		<script type="text/javascript" src="{{asset('js/jquery.counterup.min.js')}}"></script><!-- CounterUp -->
		<script type="text/javascript" src="{{asset('js/waypoints.min.js')}}"></script><!-- CounterUp -->
		<script type="text/javascript" src="{{asset('js/jquery.isotope.min.js')}}"></script><!-- isotope -->
		<script type="text/javascript" src="{{asset('js/jquery.magnific-popup.min.js')}}"></script><!-- magnific-popup -->
		<script src="//code.jquery.com/jquery-latest.js"></script><!-- jquery-latest.js -->
		<script src="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script><!-- featherlight.min.js -->
		<script type="text/javascript" src="{{asset('js/scripts.js')}}"></script><!-- Scripts -->
		<script type="text/javascript" src="{{asset('js/mask.min.js')}}"></script><!-- Scripts -->


		<script>
			$('.cpf').mask('000.000.000-00', {reverse: true});
  			$('.cnpj').mask('00.000.000/0000-00', {reverse: true});

			setTimeout(function() {
    			$('#erro').fadeOut('slow');
			}, 2000);
		</script>
	</body>
</html>