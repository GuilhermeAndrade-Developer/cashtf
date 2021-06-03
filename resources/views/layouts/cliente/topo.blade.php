<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">

	<title>cashTF</title>
	
	<!-- Main CSS file -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> 
	<link rel="stylesheet" type="text/css" href="{{asset('css/cliente/responsive.min.css')}}"><!-- Responsive Tables -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/cliente/bootstrap.min.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('css/cliente/owl.carousel.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('css/cliente/magnific-popup.css')}}" />
	<link rel="stylesheet" type="text/css" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('css/cliente/style.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('css/cliente/responsive.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('css/cliente/drawer.min.css')}}"><!-- Menu Hamburguer -->
	<link rel="stylesheet" type="text/css" href="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.css" />
	<link rel="stylesheet" type="text/css" href="{{asset('css/cliente/datepicker.min.css')}}" /><!-- Datas -->
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"> <!-- Toggle Bootstrap -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/cliente/component.css')}}" />
	<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{asset('css/cliente/topo.css')}}" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
</head>
<style type="text/css">
	
</style>
<div class="topo_default">
	<div class="container-fluid fluid-person">
		<div class="topo-default-div">
			<div class="topo-default-imagem"> 
			  <div>
				<img src="{{isset(Auth::user()->imagem) ? asset('images/usuarios/'.Auth::user()->imagem) : asset('images/place_holder_avatar.jpg')}}" class="imagem_perfil_menu_cliente">
			  </div>
			  <div class="fonte_nome_e_empresa">
				<div>{{isset(Auth::user()->name) ? Auth::user()->name : 'USUARIO'}}</div>
				<div>{{ App\Http\Controllers\ClienteController::getEmpresa() }}</div>
			  </div>
			</div>
			<div class="topo-default-menus">
			  	<div class="{{ Request::is('cliente/index') ? 'active' : 'inactive' }}">
					<a href="{{route('cliente.index')}}" target="_self">
						<i class="fa fa-home icones"></i>
						<span class="posicao_fonte">Dashboard</span>
					</a>
			  	</div>
				<div class="{{ Request::is('cliente/solicitacoes') ? 'active' : 'inactive' }}">
					<a href="{{route('cliente.solicitacoes')}}" target="_self">
						<i class="las la-list-alt icones"></i>
						<span class="posicao_fonte">Borderôs</span>
					</a>
				</div>
				<div class="{{ Request::is('cliente/perfil') ? 'active' : 'inactive' }}">
					<a href="{{route('cliente.perfil')}}" target="_self">
						<i class="fa fa-cog icones"></i>
						<span class="posicao_fonte">Minha Conta</span>  
					</a>
				</div>
				<div class="inactive">
					<a href="{{ url('/logout') }}" title="Sair" target="_self" title="Sair" onclick="event.preventDefault();
					document.getElementById('logout-form').submit();">
						<i class="fa fa-sign-out icones"></i>
						<span class="posicao_fonte">Sair</span> 
					</a>
					<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				</div>
			</div>
		  </div>
		</div>  
	</div>
</div>

<button type="button" class="drawer-toggle drawer-hamburger">
	<span class="sr-only">toggle navigation</span>
	<span class="drawer-hamburger-icon"></span>
</button>
	<!-- <nav class="drawer-nav" role="navigation">
		<div class="col-xs-1 col-sm-5 col-md-6 col-lg-6">
			<div class="div_pai_menu_topo_clientes">
				<div class="dflex1 cor_hover_topo">
					<i class="fa fa-home tamanho_icones_menu"></i>
					<span>dashboard</span>
				</div>
				<div style="display: flex; justify-content: center; align-items: center; flex: 1;">
					<i class="fa fa-home" style="color: #fff; font-size: 25px;"></i>
					<span style="color: #fff;">dashboard</span>
				</div>
				<div style="display: flex; justify-content: center; align-items: center; flex: 1;">
					<i class="fa fa-home" style="color: #fff; font-size: 25px;"></i>
					<span style="color: #fff;">dashboard</span>
				</div>
				<div style="display: flex; justify-content: center; align-items: center; flex: 1;">
					<i class="fa fa-home" style="color: #fff; font-size: 25px;"></i>
					<span style="color: #fff;">dashboard</span>
				</div>
			</div>
		</div>
	</nav> -->
	
	<!-- <div class="col-xs-1 col-sm-5 col-md-6 col-lg-6">
			<nav class="drawer-nav" role="navigation">
			<ul class="drawer-menu drawer-menu--right">	
				<li><a href="{{route('cliente.index')}}" target="_self" class="link_topo_menu"><i class="fa fa-home"></i></a></li>
				<li><a href="{{route('cliente.solicitacoes.novo')}}" target="_self" class="link_topo_menu"><i class="fa fa-plus-square"></i></a></li>
				<li><a href="{{route('cliente.solicitacoes')}}" target="_self" class="link_topo_menu"><i class="fa fa-check-circle"></i></a></li>			
				<li><a href="{{route('cliente.perfil')}}" target="_self" class="link_topo_menu"><i class="fa fa-cog"></i></a></li>
				<a href="{{ url('/logout') }}" title="Sair" target="_self" title="Sair" class="link_topo_menu" onclick="event.preventDefault();
					document.getElementById('logout-form').submit();">
					<i class="fa fa-sign-out"></i>
				</a>
				<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
					{{ csrf_field() }}
				</form>
			</ul>
		</nav> 
	</div> -->
	<!-- Modal -->
		<div class="modal fade" id="logout" role="dialog">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-body">
						<p>Tem certeza que deseja sair?</p>
						</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<a href="logout.php" class="btn btn-danger">Sair</a>
					</div>
				</div>
			</div>
		</div>
		@yield('content')
		<!--<footer>
            <div class="rodape_socio_procurador">
                <div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="displayflex">
								<div class="dflex1">
									<span class="copyright_etapas">
										©Copyright {{date('Y')}}<b> {{env('APP_NAME')}} </b>Todos os Direitos Reservados
									</span>
								</div>
								<div class="dflex1 text-right">
									<span class="copyright_etapas"><i>Desenvolvido por</i></span>
									<img src="{{asset('images/footer_peexell_logo.png')}}" class="footer_peexell">
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </footer>-->
		<!-- JS -->
		<script type="text/javascript" src="{{asset('js/cliente/jquery.min.js')}}"></script><!-- jQuery -->
		<script type="text/javascript" src="{{asset('js/cliente/bootstrap.min.js')}}"></script><!-- Bootstrap -->
		<script type="text/javascript" src="{{asset('js/cliente/jquery.parallax.js')}}"></script><!-- Parallax -->
		<script type="text/javascript" src="{{asset('js/cliente/masonry.pkgd.min.js')}}"></script><!-- masonry -->
		<script type="text/javascript" src="{{asset('js/cliente/jquery.fitvids.js')}}"></script><!-- fitvids -->
		<script type="text/javascript" src="{{asset('js/cliente/owl.carousel.min.js')}}"></script><!-- Owl-Carousel -->
		<script type="text/javascript" src="{{asset('js/cliente/jquery.counterup.min.js')}}"></script><!-- CounterUp -->
		<script type="text/javascript" src="{{asset('js/cliente/jquery.isotope.min.js')}}"></script><!-- isotope -->
		<script type="text/javascript" src="{{asset('js/cliente/jquery.magnific-popup.min.js')}}"></script><!-- magnific-popup -->
		<script src="//code.jquery.com/jquery-latest.js"></script><!-- jquery-latest.js -->
		<script src="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script><!-- featherlight.min.js -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.js"></script>
		<script type="text/javascript" src="{{asset('js/cliente/drawer.min.js')}}"></script><!-- Menu Mobile -->
		<script type="text/javascript" src="{{asset('js/cliente/scripts.js')}}"></script><!-- Scripts -->
		<script type="text/javascript" src="{{asset('js/cliente/responsive.min.js')}}"></script><!-- Responsive Tables -->
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/cliente/datepicker.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/cliente/datepicker.pt-BR.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/cliente/angular-locale_pt-br.js')}}"></script>
		<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> <!-- Toogle Bootstrap -->
		<script type="text/javascript" src="{{asset('js/cliente/custom-file-input.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/cliente/jquery-v1.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/cliente/jquery.custom-file-input.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/cliente/mask.min.js')}}"></script><!-- Responsive Tables -->
		<script type="text/javascript" src="https://unpkg.com/moment" /></script><!-- Datas -->

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
				$('.data_padrao').mask('00/00/0000');
				$('.time').mask('00:00');
				$('.cep').mask('00000-000');
				$('.phone').mask('0000-0000');
				$('.phone_with_ddd').mask('(00) 00000-0000');
				$('.cpf').mask('000.000.000-00', {reverse: true});
				$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
			});
			$('.data_padrao').mask('00/00/0000');

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
</html>




