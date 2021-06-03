<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>cashTF - Cliente</title>
		
		<!-- Main CSS file -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> 
		<!--<link rel="stylesheet" href="css/bootstrap.min.css" />-->
		<link rel="stylesheet" href="css/owl.carousel.css" />
		<link rel="stylesheet" href="css/magnific-popup.css" />
		<link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
		<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/responsive.css" />
		<link rel="shortcut icon" href="images/favicon.png">
		<link rel="stylesheet" type="text/css" href="{{asset('css/cliente/bootstrap.min.css')}}"/>
		<link rel="stylesheet" type="text/css" href="{{asset('css/cliente/style.css')}}" />
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
			.error-sign{
				background-color: none;
				border: none;
				margin: 15px;
			}
			.forgot-password{
				width: 100%;
				margin: 10px 0px;
				cursor: pointer;
				color: white;
			}
			.erro_cpf{
				color: #856404;
				background-color: #fff3cd;
				text-align: center;
				padding: 10px;
				margin-top: 15px;
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
	
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				//alert('teste');
				const openmodal = document.getElementById('open-modal');
				const closemodal =  document.getElementById('close-modal');
				const modal = document.getElementById('modal-reset-password');

				const mudaDisplay = (display, modal) => { modal.style.display = display }

				openmodal.addEventListener('click', () => mudaDisplay('block', modal));
				
				closemodal.addEventListener('click', () => mudaDisplay('none', modal));

				
			});
		</script>

		<!-- <div class="jumbotron">
			<a class="btn btn-large btn-success"  data-toggle="modal" data-target="#modal-solicitacao-enviada">Show me how</a>
		</div>   -->
		<div class="div_geral_login">
			<div class="primeira_div container padding-form">
				<div class="row mobile_custom">
					<div class="col-md-12 text-center mb40">
						<img src="{{asset('images/logo_white.png')}}" style="width: 200px;">
					</div>
					
					<div class="col-md-offset-3 col-md-6 bg-none plr100">
						@if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
						@endif
						<form class="login_form" method="POST" action="{{ route('login') }}">
                    	@csrf
							<div class="row">
								<div class="col-md-12 mt20">
									<div class="input-group">
										<span class="input-group-addon input_padrao pr0"><i class="fa fa-envelope"></i></span>
										<input id="email-reset-password" type="email" class="form-control campo_quadrado input_padrao @error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus placeholder="Digite o seu e-mail...">
									</div>
								</div>
								<div class="col-md-12 mt30">
									<div class="input-group">
										<span class="input-group-addon input_padrao pr0"><i class="fa fa-lock"></i></span>
										<input id="password" type="password" class="form-control campo_quadrado input_padrao @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Digite a sua senha...">
										<span class="input-group-addon input_padrao pr0"><i class="fa fa-question-circle" id="open-modal" data-toggle="tooltip" data-placement="bottom" title="Recuperar senha"></i></span>
									</div>
									@error('email')
									<div class="text-right alerts invisible" data-toggle="tooltip" data-placement="bottom" title="Oops, credenciais de acesso incorretas. Tente novamente." invisible>
										<span class="invalid-feedback" role="alert">
											{{ $message }}
										</span>
									</div>
									@enderror
									@error('password')
										<div class="text-right alerts invisible" data-toggle="tooltip" data-placement="bottom" title="Oops, senha incorreta. Tente novamente." invisible>
											<span class="invalid-feedback" role="alert">
												{{ $message }}
											</span>
										</div>
									@enderror
								</div>
								<div class="col-md-12 mt30">
									<input type="submit" class="btn btn-block button_pink" name="botao_login" value="ENTRAR">
								</div>
								<div class="col-md-12 mt20">
									<a href="{{route('register')}}" class="btn btn-block button_pink_active">CRIAR CONTA</a>
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-offset-3 col-md-6 bg-none plr100 mt20">
						<h2 class="title">ENTRAR COM</h2>
						<a href="{{route('auth.facebook')}}">
						<label for="face" class="log_btn mt10 face">
							<i class="lab la-facebook-square"></i>
							<span>Facebook</span>
						</label>
						</a>
						<a href="{{route('auth.linkedin')}}">
						<label for="linkedin" class="log_btn mt10 linkedin">
							<i class="lab la-linkedin"></i>
							<span>Linkedin</span>
						</label>
						</a>
						<a href="{{route('auth.google')}}">
						<label for="google" class="log_btn mt10 google">
							<img src="{{asset('images/google.png')}}" style="width: 22px;">
							<span>Google</span>
						</label>
						</a>
					</div>
				</div>
			</div>

			<div class="segunda_div container">
				<div class="row">
					<div class="col-md-12 text-center">
						<label class="copyright_login">
							©Copyright {{date('Y')}}<b> cashTF </b>Todos os Direitos Reservados
						</label>
					</div>
				</div>
			</div>
		</div>


		<!-- Modal -->
		<div style="display: none;" id="modal-reset-password">
			<div class="overlay"></div>
			<div class="div_modal_absolute">
				<div class="col-md-12 mobile">
					<button type="button" id="close-modal" class="close mr-2" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				
				<div class="text-center">
					{{-- <div><i class="fa fa-exclamation-circle" style="font-size: 100px; color: #f11070;"></i></div> --}}
					
					<h4 class="font-weight-bold" style="font-weight: 500; font-size: 24px;">RECUPERAÇÃO DE SENHA</h4>
					<div class="h5 mt30 mb30 title_modal">
						Digite abaixo seu e-mail de cadastro e receba um link<br>para criar uma nova senha.
					</div>
				</div>
				<div class="text-center col-md-12 mobile father">
					<div class="text-center div_form">
						<form method="POST" action="{{ route('reset.email') }}">
							@csrf

							<div class="form-group row">
								<div class="col-md-12">
									<div class="input-group mb10">
										<span class="input-group-addon input_padrao pr0"><i class="fa fa-envelope"></i></span>
										<input id="email-reset-password" type="email" class="form-control campo_quadrado input_padrao @error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus placeholder="Digite o seu e-mail...">
									</div>
								</div>
							</div>

							<div class="text-center">
								<div class="text-center">
									<button type="submit" class="btn btn-block button_pink">
										{{ __('ENVIAR') }}
									</button>
								</div>
							</div>

							<div class="text-center talk_us mt20">
								<a href="mailto:contato@cashtf.com"><span>Fale Conosco</span></a>
							</div>

						</form>
					</div>		
				</div>
			</div>
		</div>	

		<!-- @include('partials.modals.confirm_email') -->     <!-- Modal de confirmacao de e-mail -->
		<!--  @include('partials.modals.cadastro_finalizado') -->  <!-- Modal verde de cadastro finalizado -->
		<!--  @include('partials.modals.gerar_boletos') -->  		<!-- Modal rosa de gerar boletos -->
		<!--  @include('partials.modals.boletos_enviados') -->		<!-- Modal verde de boletos enviados -->
		<!--  @include('partials.modals.redes_sociais')  -->		<!-- Modal redes sociais --> 
        <!-- @include('partials.modals.adicionar_email')   -->		<!-- Modal adicionar e-mail -->
		<!-- @include('partials.modals.adicionar_senha')   --> 	<!-- Modal adicionar senha -->
		<!-- @include('partials.modals.solicitacao_enviada') -->   <!-- Modal verde solicitacao enviada -->



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
		
	</body>
	
</html>