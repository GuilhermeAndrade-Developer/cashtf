<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>cashTF - Cliente</title>
		
		<!-- Main CSS file -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> 
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/owl.carousel.css" />
		<link rel="stylesheet" href="../css/magnific-popup.css" />
		<link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
		<link rel="stylesheet" href="../css/style.css" />
		<link rel="stylesheet" href="../css/responsive.css" />
		<link rel="shortcut icon" href="images/favicon.ico">	
		<link rel="stylesheet" type="text/css" href="{{asset('../css/cliente/responsive.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('../css/cliente/bootstrap.min.css')}}"/>
		<link rel="stylesheet" type="text/css" href="{{asset('../css/cliente/style.css')}}" />
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
				background-image: url('/images/Grupo 4578.jpg');
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

		<!-- Modal Sucesso -->
		<div style="display: show;" id="modal-reset-password">
			<div class="overlay"></div>
			<div class="div_modal_absolute">
				<div class="col-12">
					<a type="button" href="/login" id="close-modal" class="close mr-2" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
                    </a>
				</div>

				<div class="text-center">
					{{-- <div><i class="fa fa-exclamation-circle" style="font-size: 100px; color: #f11070;"></i></div> --}}

					<h4 class="font-weight-bold" style="font-weight: 500; font-size: 24px;">NOVA SENHA</h4>
					<div class="h5">Escolha sua nova senha para?<br>acessar o CashTF</div>
				</div>
				<div class="text-center col-12">
					<div style="text-align: center;">

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ isset($token)?$token:'' }}">

                            <div class="form-group row" hidden>
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6" >
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" >

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="nova a senha" autofocus>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="comfirme a senha" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="text-center">
                                    <div style="text-align: center;">
                                        <a type="submit" id="enviar" class="botao_sim btn-verificar pt-3">
                                            {{ __('CONFIRMAR E ENTRAR') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
					</div>
				</div>
			</div>
		</div>

		<!-- JS -->
		<script type="text/javascript" src="../s/jquery.min.js"></script><!-- jQuery -->
		<script type="text/javascript" src="../js/bootstrap.min.js"></script><!-- Bootstrap -->
		<script type="text/javascript" src="../js/jquery.parallax.js"></script><!-- Parallax -->
		<script type="text/javascript" src="../js/smoothscroll.js"></script><!-- Smooth Scroll -->
		<script type="text/javascript" src="../js/masonry.pkgd.min.js"></script><!-- masonry -->
		<script type="text/javascript" src="../js/jquery.fitvids.js"></script><!-- fitvids -->
		<script type="text/javascript" src="../js/owl.carousel.min.js"></script><!-- Owl-Carousel -->
		<script type="text/javascript" src="../js/jquery.counterup.min.js"></script><!-- CounterUp -->
		<script type="text/javascript" src="vjs/waypoints.min.js"></script><!-- CounterUp -->
		<script type="text/javascript" src="../js/jquery.isotope.min.js"></script><!-- isotope -->
		<script type="text/javascript" src="../js/jquery.magnific-popup.min.js"></script><!-- magnific-popup -->
		<script src="//code.jquery.com/jquery-latest.js"></script><!-- jquery-latest.js -->
		<script src="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script><!-- featherlight.min.js -->
		<script type="text/javascript" src="../js/scripts.js"></script><!-- Scripts -->
		<script>
            $('#enviar').click(function () {
                $('form').submit();
            });
        </script>
	</body>

</html>