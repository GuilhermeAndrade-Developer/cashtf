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

		<div class="div_geral_login">
			<div class="primeira_div container padding-form">
				<div class="row">
					<div class="col-md-12 text-center">
						<img src="{{asset('images/logo_white.png')}}" style="width: 200px;">
					</div>
					<div class="col-md-12 bg-none" style="color: white;">
                        <h1 class="text-center">Pol??tica de privacidade para <a href='http://cashtf.com'>CashTF</a></h1>
                        <b><p>Todas as suas informa????es pessoais recolhidas, ser??o usadas para o ajudar a tornar a sua visita no nosso site o mais produtiva e agrad??vel poss??vel.</p>
                        <p>A garantia da confidencialidade dos dados pessoais dos utilizadores do nosso site ?? importante para o CashTF.</p>
                        <p>Todas as informa????es pessoais relativas a membros, assinantes, clientes ou visitantes que usem o CashTF ser??o tratadas em concord??ncia com a Lei da Prote????o de Dados Pessoais de 26 de outubro de 1998 (Lei n.?? 67/98).</p><p>A informa????o pessoal recolhida pode incluir o seu nome, e-mail, n??mero de telefone e/ou telem??vel, morada, data de nascimento e/ou outros.</p>
                        <p>O uso do CashTF pressup??e a aceita????o deste Acordo de privacidade</a>. 
                        A equipa do CashTF reserva-se ao direito de alterar este acordo sem aviso pr??vio. Deste modo, recomendamos que consulte a nossa pol??tica de privacidade com regularidade de forma a estar sempre atualizado.</p>
                        </b>
                        <h1>Os an??ncios</h1>
                        <b><p>Tal como outros websites, coletamos e utilizamos informa????o contida nos an??ncios. A informa????o contida nos an??ncios, inclui o seu endere??o IP (Internet Protocol), o seu ISP (Internet Service Provider, como o Sapo, Clix, ou outro), o browser que utilizou ao visitar o nosso website (como o Internet Explorer ou o Firefox), o tempo da sua visita e que p??ginas visitou dentro do nosso website.</p>
                        </b>
                        <h1>Os Cookies e Web Beacons</h1>
                        <b><p>Utilizamos cookies para armazenar informa????o, tais como as suas prefer??ncias pessoas quando visita o nosso website. Isto poder?? incluir um simples popup, ou uma liga????o em v??rios servi??os que providenciamos, tais como f??runs.</p>
                        <p>Em adi????o tamb??m utilizamos publicidade de terceiros no nosso website para suportar os custos de manuten????o. Alguns destes publicit??rios, poder??o utilizar tecnologias como os cookies e/ou web beacons quando publicitam no nosso website, o que far?? com que esses publicit??rios (como o Google atrav??s do Google AdSense) tamb??m recebam a sua informa????o pessoal, como o endere??o IP, o seu ISP, o seu browser, etc. Esta fun????o ?? geralmente utilizada para geotargeting (mostrar publicidade de Lisboa apenas aos leitores oriundos de Lisboa por ex.) ou apresentar publicidade direcionada a um tipo de utilizador (como mostrar publicidade de restaurante a um utilizador que visita sites de culin??ria regularmente, por ex.).</p>
                        <p>Voc?? det??m o poder de desligar os seus cookies, nas op????es do seu browser, ou efetuando altera????es nas ferramentas de programas Anti-Virus, como o Norton Internet Security. No entanto, isso poder?? alterar a forma como interage com o nosso website, ou outros websites. Isso poder?? afetar ou n??o permitir que fa??a logins em programas, sites ou f??runs da nossa e de outras redes.</p>
                        </b>
                        <h1>Liga????es a Sites de terceiros</h1>
                        <b><p>O CashTF possui liga????es para outros sites, os quais, a nosso ver, podem conter informa????es / ferramentas ??teis para os nossos visitantes. A nossa pol??tica de privacidade n??o ?? aplicada a sites de terceiros, pelo que, caso visite outro site a partir do nosso dever?? ler a politica de privacidade do mesmo.</p>
                        <p>N??o nos responsabilizamos pela pol??tica de privacidade ou conte??do presente nesses mesmos sites.</p>
                        </b>
                    </div>
				</div>
			</div>

			<div class="segunda_div container">
				<div class="row">
					<div class="col-md-12 text-center">
						<label class="copyright_login">
							??Copyright 2019<b> cashTF </b>Todos os Direitos Reservados
						</label>
					</div>
				</div>
			</div>
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
	</body>
</html>
