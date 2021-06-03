<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">

	<title>cashTF</title>
	
	<!-- Main CSS file -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> 
	<link rel="stylesheet" type="text/css" href="{{asset('css/admin/responsive.min.css')}}"><!-- Responsive Tables -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/admin/bootstrap.min.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('css/admin/owl.carousel.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('css/admin/magnific-popup.css')}}" />
	<link rel="stylesheet" type="text/css" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('css/admin/responsive.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('css/admin/drawer.min.css')}}"><!-- Menu Hamburguer -->
	<link rel="stylesheet" type="text/css" href="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.css" />
	<link rel="stylesheet" type="text/css" href="{{asset('css/admin/datepicker.min.css')}}" /><!-- Datas -->
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"> <!-- Toggle Bootstrap -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/admin/component.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('css/admin/topo.css')}}" />
</head>
<style type="text/css">
	.rodape{
		background-color: #ffffff;
		box-shadow: 1px 0px #000000;
		color: #9b9b9b;
		padding-top: 20px; 
		padding-bottom: 20px;
    	bottom: 0;
    	width: 100%;
		z-index: 9999;
		-webkit-box-shadow: 0px -6px 5px -4px rgba(240,240,240,1);
		-moz-box-shadow: 0px -6px 5px -4px rgba(240,240,240,1);
		box-shadow: 0px -6px 5px -4px rgba(240,240,240,1);
	}
	@media (max-width: 768px){
		.rodape{
			background-color: #ffffff; 
			color: #9b9b9b; 
			padding-top: 20px; 
			padding-bottom: 20px;
	    	position: initial;
	    	bottom: 0;
	    	width: 100%;
	    	text-align: center;
		}
	}
	.mt60{
		margin-top: 60px;
	}
</style>
<body class="drawer drawer--right">
		<header class="drawer-navbar barra_topo" role="banner">
			<div class="container-fluid fluid-person">
				<div class="row">
					<div class="col-xs-12 col-sm-9 col-md-6 col-lg-6">
						<div class="col-md-12">
							<a href="index.php">
								<img src="{{asset('images/usuarios')}}/{{Auth::user()->imagem}}" class="imagem_usuario">
							</a>
							<label style="margin-top: 12px;" class="menu_nome">{{Auth::user()->name}}</label><br>			
						</div>
					</div>
					<button type="button" class="drawer-toggle drawer-hamburger">
						<span class="sr-only">toggle navigation</span>
						<span class="drawer-hamburger-icon"></span>
					</button>
					<div class="col-xs-1 col-sm-5 col-md-6 col-lg-6">
						<nav class="drawer-nav" role="navigation">
							<ul class="drawer-menu drawer-menu--right">	
								<li><a href="{{route('admin.index')}}" target="_self" class="link_topo_menu"><i class="fa fa-home"></i></a></li>
								<li><a href="{{route('admin.solicitacoes')}}" target="_self" class="link_topo_menu"><i class="fa fa-check-circle"></i></a></li>			
								<li><a href="{{route('admin.clientes')}}" target="_self" class="link_topo_menu"><i class="fa fa-user"></i></a></li>			
								<li><a href="{{route('admin.perfil')}}" target="_self" class="link_topo_menu"><i class="fa fa-cog"></i></a></li>
								<a href="{{ url('/logout') }}" title="Sair" target="_self" title="Sair" class="link_topo_menu" onclick="event.preventDefault();
                                  	document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i>
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
							</ul>
						</nav>
					</div>
				</div>
			</div>
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
		
		<div class="rodape">
			<div class="container-fluid fluid-person">
				<div class="row">
					<div class="col-md-7 hidden-xs hidden-sm" style="color: #7c7c7c; font-size: 13px;">
						©Copyright 2019 <b style="font-size: 12px;">cashTF</b> - Todos os Direitos Reservados
					</div>
					<div class="col-md-7 hidden-md hidden-lg text-center" style="color: #7c7c7c; font-size: 13px;">
						©Copyright 2019 <b style="font-size: 12px;"><br>cashTF</b><br>Todos os Direitos Reservados
					</div>
					<div class="col-md-5 text-center hidden-md hidden-lg">
						<b style="color: #7c7c7c; font-weight: 400; font-size: 10.8px;">
							<i>Desenvolvido por</i> 
						<a href="http://www.peexell.com" target="_blank">
							<img src="{{asset('images/footer_peexell_logo.png')}}" class="logo_rodape">
						</a></b>
					</div>
					<div class="col-md-5 text-right hidden-xs hidden-sm">
						<b style="color: #7c7c7c; font-weight: 400; font-size: 10.8px;">
							<i>Desenvolvido por</i> 
						<a href="http://www.peexell.com" target="_blank">
							<img src="{{asset('images/footer_peexell_logo.png')}}" class="logo_rodape" style="margin-left: 10px;">
						</a></b>
					</div>
				</div>
			</div>
		</div>

		<!-- JS -->
		<script type="text/javascript" src="{{asset('js/admin/jquery.min.js')}}"></script><!-- jQuery -->
		<script type="text/javascript" src="{{asset('js/admin/bootstrap.min.js')}}"></script><!-- Bootstrap -->
		<script type="text/javascript" src="{{asset('js/admin/jquery.parallax.js')}}"></script><!-- Parallax -->
		<script type="text/javascript" src="{{asset('js/admin/masonry.pkgd.min.js')}}"></script><!-- masonry -->
		<script type="text/javascript" src="{{asset('js/admin/jquery.fitvids.js')}}"></script><!-- fitvids -->
		<script type="text/javascript" src="{{asset('js/admin/owl.carousel.min.js')}}"></script><!-- Owl-Carousel -->
		<script type="text/javascript" src="{{asset('js/admin/jquery.counterup.min.js')}}"></script><!-- CounterUp -->
		<script type="text/javascript" src="{{asset('js/admin/jquery.isotope.min.js')}}"></script><!-- isotope -->
		<script type="text/javascript" src="{{asset('js/admin/jquery.magnific-popup.min.js')}}"></script><!-- magnific-popup -->
		<script src="//code.jquery.com/jquery-latest.js"></script><!-- jquery-latest.js -->
		<script src="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script><!-- featherlight.min.js -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.js"></script>
		<script type="text/javascript" src="{{asset('js/admin/drawer.min.js')}}"></script><!-- Menu Mobile -->
		<script type="text/javascript" src="{{asset('js/admin/scripts.js')}}"></script><!-- Scripts -->
		<script type="text/javascript" src="{{asset('js/admin/responsive.min.js')}}"></script><!-- Responsive Tables -->
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script type="text/javascript" src="{{asset('js/admin/datepicker.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/admin/datepicker.pt-BR.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/admin/angular-locale_pt-br.js')}}"></script>
		<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> <!-- Toogle Bootstrap -->
		<script type="text/javascript" src="{{asset('js/admin/custom-file-input.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/admin/jquery-v1.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/admin/jquery.custom-file-input.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/admin/mask.min.js')}}"></script><!-- Responsive Tables -->

		<script type="text/javascript">
			$(document).ready(function() {
				$('.drawer').drawer();
			});
			
			$(".clickable-row").click(function() {
				window.location = $(this).data("href");
			});

			$(window).load(function() {
				$(".btnremover").click(function(){
					var link = $(this).attr("data-href");
					$('#modal_confirmacao').show();
					$('#link_sim').attr('action', link);
					return false;
				});
				$("#fecha_modal").click(function(){
					$('#modal_confirmacao').hide();
				})
				$("#fecha_modal2").click(function(){
					$('#modal_retorno').hide();
				})
			});

			$(document).ready(function(){
				//$('.codigo_procedimento').mask('0.00.0000-0');
				$('.data').mask('00/00/0000');
				$('.time').mask('00:00');
				$('.cep').mask('00000-000');
				$('.phone').mask('0000-0000');
				$('.phone_with_ddd').mask('(00) 00000-0000');
				$('.cpf').mask('000.000.000-00', {reverse: true});
				$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
			});
			$('.porcentagem').mask('#.##0.00', {reverse: true});

			function moeda(z){
				v = z.value;
				v=v.replace(/\D/g,"");
				v=v.replace(/[0-9]{12}/,"inválido");
				v=v.replace(/(\d{1})(\d{8})$/,"$1.$2");
				v=v.replace(/(\d{1})(\d{5})$/,"$1.$2");
				v=v.replace(/(\d{1})(\d{1,2})$/,"$1,$2");
				z.value = v;
			}
		</script>

		<script>
			// bind a click-handler to the 'tr' elements with the 'header' class-name:
			$('tr.header').click(function(){
				/* get all the subsequent 'tr' elements until the next 'tr.header',
				set the 'display' property to 'none' (if they're visible), to 'table-row'
				if they're not: */
				$(this).nextUntil('tr.header').css('display', function(i,v){
					return this.style.display === 'table-row' ? 'none' : 'table-row';
				});
			});
		</script>

		<script>
		$(function() {
			$('#toggle-event').change(function() {
			$('#console-event').html('Toggle: ' + $(this).prop('checked'));
			});
		});
		</script>

		<script>
			// Get the modal
			var modal = document.getElementById("myModal");

			// Get the button that opens the modal
			var btn = document.getElementById("myBtn");

			// Get the <span> element that closes the modal
			var span = document.getElementsByClassName("close")[0];

			// When the user clicks the button, open the modal 
			btn.onclick = function() {
			modal.style.display = "block";
			}

			// When the user clicks on <span> (x), close the modal
			span.onclick = function() {
			modal.style.display = "none";
			}

			// When the user clicks anywhere outside of the modal, close it
			window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
			}
		</script>
	</body>
</html>


