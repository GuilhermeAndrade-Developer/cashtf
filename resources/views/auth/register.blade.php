<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>cashTF - Cliente</title>
		
		<!-- Main CSS file -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> 
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/owl.carousel.css" />
		<link rel="stylesheet" href="css/magnific-popup.css" />
		<link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/responsive.css" />
		<link rel="shortcut icon" href="images/favicon.ico">	
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
				background-image: url('images/banner.jpg');
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
				background-image: url('images/Grupo 4578.jpg');
				background-size: cover;
				background-repeat: no-repeat;
				background-position: center;
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
			.modal{
				display: flex;
				justify-content: center;
				align-items: center;
				flex: 1;
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

		<div class="div_geral_login">
			<div class="primeira_div container padding-form">
				<div class="row">
					<div class="col-md-12 text-center mb40">
						<img src="{{asset('images/logo_white.png')}}" style="width: 200px;">
					</div>
					<div class="col-md-offset-3 col-md-6 plr100">
						@php
							if(isset($_GET['error']) && $_GET['error'] == 1){
								echo '<div class="text-center font-weight-bold erro_cpf" style="background-color: #f11070; margin-top: 15px; margin-bottom: -10px; padding: 5px; color: #fff;">
										Oops, usuário já existente em nosso sistema.
									</div>';
							};
						@endphp
						<form class="login_form" method="post" onsubmit="return ValidaCadastro()" action="{{route('register.add')}}">
							@csrf
							<div class="row">
								<div class="col-md-12 mt20">
									<div class="input-group">
										<span class="input-group-addon input_padrao pr0"><i class="fa fa-envelope"></i></span>
										<input type="email" name="email" value="{{isset($_GET['email']) ? $_GET['email'] : '' }}" class="form-control campo_quadrado input_padrao" placeholder="Digite a seu e-mail..." autocomplete="off" required>
									</div>
								</div>
								<div class="col-md-12 mt30">
									<div class="input-group">
										<span class="input-group-addon input_padrao pr0"><i class="fa fa-lock"></i></span>
										<input type="password" name="password" id="senha" class="form-control campo_quadrado input_padrao" placeholder="Digite a sua senha..." autocomplete="off" required>
									</div>
								</div>
								<div class="col-md-12 mt30">
									<div class="input-group">
										<span class="input-group-addon input_padrao pr0"><i class="fa fa-lock"></i></span>
										<input type="password" name="txtloginsenharepete" id="repete_senha" class="form-control campo_quadrado input_padrao" placeholder="Confirme a sua senha..." autocomplete="off" required>
									</div>
								</div>
								<div class="col-md-12 mt30">
									<div class="input-group">
										<span class="input-group-addon input_padrao pr0"><i class="fa fa-phone"></i></span>
										<input type="text" name="telefone" class="form-control campo_quadrado input_padrao telefone" placeholder="Digite seu telefone..." autocomplete="off" required>
									</div>
								</div>
								<!-- Hidden input for socialmedia_ids if exists -->
								<input type="hidden" id="linkedin_id" name="linkedin_id" value="{{isset($_GET['linkedin_id']) ? $_GET['linkedin_id'] : '' }}">
								<input type="hidden" id="facebook_id" name="facebook_id" value="{{isset($_GET['facebook_id']) ? $_GET['facebook_id'] : '' }}">
								<input type="hidden" id="google_id" name="google_id" value="{{isset($_GET['google_id']) ? $_GET['google_id'] : '' }}">
								<div class="col-md-12 mt30">
									<div class="input-group accept" style="color: #fff;">
										<label class="content">
											<input type="checkbox" required>Li e Concordo com os <b><a href="{{URL::to('/')}}/termos" target="_blank">Termos e Condições</a></b>.
											<span class="checkmark"></span>
										</label>
										<!-- <input class="checkbox" type="checkbox" required /> Li e Concordo com os <b><a href="{{URL::to('/')}}/termos" target="_blank">Termos e Condições</a></b>. -->
									</div>
								</div>
								<div class="col-md-12 mt30">
									<input type="submit" class="btn btn-block button_pink" name="botao_cadastrar" value="CRIAR CONTA">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="segunda_div container">
				<div class="row">
					<div class="col-md-12 text-center">
						<label class="copyright_login">
							©Copyright {{date('Y')}}<b style="text-transform: uppercase;"> cashTF </b>Todos os Direitos Reservados
						</label>
					</div>
				</div>
			</div>
			@if(isset($_GET['modal']))
				@include('partials.modals.confirm_email')
			@endif
		</div>

		<!-- JS -->
		<script type="text/javascript" src="js/jquery.min.js"></script><!-- jQuery -->
		<script type="text/javascript" src="js/bootstrap.min.js"></script><!-- Bootstrap -->
		<script type="text/javascript" src="js/jquery.parallax.js"></script><!-- Parallax -->
		<script type="text/javascript" src="js/smoothscroll.js"></script><!-- Smooth Scroll -->
		<script type="text/javascript" src="js/masonry.pkgd.min.js"></script><!-- masonry -->
		<script type="text/javascript" src="js/jquery.fitvids.js"></script><!-- fitvids -->
		<script type="text/javascript" src="js/owl.carousel.min.js"></script><!-- Owl-Carousel -->
		<script type="text/javascript" src="js/jquery.counterup.min.js"></script><!-- CounterUp -->
		<script type="text/javascript" src="js/waypoints.min.js"></script><!-- CounterUp -->
		<script type="text/javascript" src="js/jquery.isotope.min.js"></script><!-- isotope -->
		<script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script><!-- magnific-popup -->
		<script src="//code.jquery.com/jquery-latest.js"></script><!-- jquery-latest.js -->
		<script src="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script><!-- featherlight.min.js -->
		<script type="text/javascript" src="js/scripts.js"></script><!-- Scripts -->
		<script type="text/javascript" src="js/mask.min.js"></script><!-- Scripts -->


		<script>
			var SPMaskBehavior = function (val) {
				return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
			},
			spOptions = {
			onKeyPress: function(val, e, field, options) {
				field.mask(SPMaskBehavior.apply({}, arguments), options);
				}
			};

			$('.telefone').mask(SPMaskBehavior, spOptions);

			function ValidaCadastro(){
				if($("#senha").val() != '' && $("#repete_senha").val() != '' && $("#senha").val() === $("#repete_senha").val() != ''){
					return true;
				}else{
					alert('Oops, as senhas não são iguais!');
					return false;
				}
			}
		</script>
	</body>
</html>