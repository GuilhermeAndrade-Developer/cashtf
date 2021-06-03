@extends('layouts.topo')
@section('content')
<style>
	.in {
        background-color: inherit !important;
        background-image: none !important;
    }
</style>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>

	<div ng-controller="myCtrl">
		<section class="slider_show">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<div class="active invest_img">
					<div class="container box_invest">
						<div class="row text-right">
							<div class="col-md-12">
								<p class="banner_title_invest">Seu Investimento está aqui!</p>
								<p class="subtitle_banner">Conheça a melhor forma de investir do mercado.</p>
								<div class="mt30"> 
									<a class="invest_button" href="#invest_contato">INVESTIR AGORA</a>
								</div>
							</SSSSdiv>
						</div>
					</div>
				</div>
			</div>
		</section> 
		
		<!-- TODOS OS PERFIS -->
		<section id="perfis">
			<div class="container">
				<div class="row justify_center mb50">
					<div class="col-md-12">
						<p class="invest_title" style="color: #00A7FF;">Para todos os perfis de investidores</p>
						<p class="subtitle_text mb40" style="color: #313131;">Comece a investir com a experiência de quem possui anos de mercado financeiro.</p>
					</div>
					<div class="col-md-3">
						<div class="square_1">
							<p class="square_title">STARTER</p>
							<p class="square_emph">130% <br /> do CDI</p>
							<p class="square_text">Para investimentos de <br /> R$ 1 mil a R$ 29 mil</p> 
						</div>
					</div>
					<div class="col-md-3">
						<div class="square_2">
							<p class="square_title">PRO</p>
							<p class="square_emph">150% <br /> do CDI</p>
							<p class="square_text">Para investimentos de <br /> R$ 30 mil a R$ 99 mil</p> 
						</div>
					</div>
					<div class="col-md-3">
						<div class="square_3">
							<p class="square_title">ELITE</p>
							<p class="square_emph">170% <br /> do CDI</p>
							<p class="square_text">Para investimentos a <br /> partir de R$ 100 mil</p> 
						</div>
					</div>
					<div class="col-md-3">
						<div class="square_4">
							<p class="square_title">PREMIUM</p>
							<p class="square_emph">200% <br /> do CDI</p>
							<p class="square_text">Para investimentos a <br /> partir de R$ 1 milhão</p> 
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- POR QUE INVESTIR -->
		<section id="simulation" class="mb7">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						
						<p class="subtitle_text" style="color: #313131; margin-bottom: -15px">Por que investir com a CashTF?</p>
						<p class="invest_title" style="color: #F11070;">Aqui você encontra o melhor retorno.</p>
					</div>
				</div>
			</div>
			<!--<div class="space_for_graph">
			falta a parte do gráfico 
				<h5 style="text-align: center; font-size: 50px; color: #fff;">

					GRÁFICOS

				</h5>
			</div> -->
		</section> 
		
		<!-- INVESTIR AGORA -->
		<section id="investir" class="blue_bckg">
			<div class="container mb100">
				<div class="row justify_center mb50 margins_bckg">
					<div class="col-md-6 col-xs-12">
						<p class="invest_session">O seu dinheiro </br> <strong> rende mais </strong> </p>
						<p class="invest_text margR">Aqui você investe em renda fixa, com permanência mínima de apenas 6 meses e liquidez em 30 dias. </p>
						<div class="mt50 butAlMob"> 
							<a class="invest_button" href="#invest_contato">INVESTIR AGORA</a>
						</div>
					</div>
					<div class="col-md-6 col-xs-12 img_flex" style="position: relative">
						<img class="experience_img" src="images/invest/o-seu_dinheiro_rende_mais_img@2x.jpg" alt="investir_agora">
						<div style="position: absolute; top: -40px; left: -40px;">
						<img class="frame" src="images/invest/o-seu_dinheiro_rende_mais_simbolos_img@2x.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- ABRA SUA CONTA --> 
		<section id="open_account">
			<div class="container">
				<div class="row justify_base">
					<div class="col-md-5 padMob">
						<p class="invest_session margR_open" style="color: #00BEF6;"> Seu investimento rendendo <strong> em poucos passos </strong> </p>
						<p class="invest_text margR_open" style="color: #313131;"> Um dos melhores investimentos em renda fixa à sua disposição, de forma fácil. </p>
						<div class="butAlMob">
							<img class="cadastro_img" src="images/invest/cadastre_se_agora_icn@2x.png" alt="">
							<span class="invest_text" style="display: inline-grid; color: #313131;"> Cadastre-se agora <br />  <span style="font-weight: bold;"> gratuitamente. </span> </span>
						</div>
						<div class="mt50 butAlMob"> 
							<a class="invest_button" style="padding: 15px 35px;" href="#invest_contato">ABRA SUA CONTA</a>
						</div>
					</div>
					<div class="col-md-7 flex_column noShow">
						<span class="subtitle_text" style="color: #313131;">Faça seu cadastro na cashTF</span>
						<div id="investCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
							<!-- indicators --> 
							<div class="carousel-indicators">
								<div data-target="#investCarousel" data-slide-to="0" class="active numberDflex one"><span>1</span></div>
								<div data-target="#investCarousel" data-slide-to="1" class="numberDflex two"><span>2</span></div>
								<div data-target="#investCarousel" data-slide-to="2" class="numberDflex three"><span>3</span></div>
							</div>
							<div class="carousel-inner">
								<img class="ehsse" src="images/invest/simbolo_cash_tf.png" alt="">
								<div class="item active">
									<div style="padding: 30px;">
										<img src="images/invest/passos_slider_1_img.jpg" class="img-responsive d-block first_slide_invest">
									</div>
								</div>
								<div class="item">
									<div style="padding: 30px;">
										<img src="images/invest/passos_slider_2_img.jpg" class="img-responsive d-block second_slide_invest">
									</div>
								</div>
								<div class="item">
									<div style="padding: 30px;">
										<img src="images/invest/passos_slider_3_img.jpg" class="img-responsive d-block third_slide_invest">
									</div>
								</div>
							</div>
						</div>
						<!-- controls -->
						<a class="left carousel-control first-left" href="#investCarousel" data-slide="prev">
							<img src="images/invest/seta_esquerda_slider_icn.png">
						</a>
						<a class="right carousel-control first-right" href="#investCarousel" data-slide="next">
							<img src="images/invest/seta_direita_slider_icn.png">
						</a> 
						<!-- end controls -->
					</div>
				</div>
			</div>
		</section>
		<!-- PERGUNTAS E RESPOSTAS -->
		<section id="respostas" class="back_color_Q">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p class="invest_title mb50 mt50" style="color: #00A7FF;">Dúvidas Frequentes</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 mb80">
						<div class="row d-flex-wrap">
							@foreach ($duvidas as $k => $d)
								<div class="col-md-6" onclick="togglePergunta('{{$k}}')">
									<div class="div-pergunta QandA">
										<span>{{$d['titulo']}}</span>
										<img id="setaB{{$k}}" class="seta_baixo" src="images/invest/seta_faq_icn.png" alt="">
										<img id="setaC{{$k}}" class="seta_cima" src="images/invest/seta_faq_recolher_icn.png" alt="" style="display: none;">
									</div>
									<div class="div-conteudo fade item-conteudo{{$k}}" style="display: none;">
										<span>{{$d['descricao']}}</span>	
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<!-- FORMULÁRIO INVISTA AGORA -->
	<section id="invest_contato">
		<div class="container">
			<div class="row">
				<form autocomplete="false" class="col-md-offset-2 col-md-8" method="POST" action="{{route('formcontato')}}">
					{{csrf_field()}}
					<div class="row adjust_size">
						<div class="col-md-12 invest_title mb20" style="color: #F11070;"><p>INVISTA AGORA</p></div>
						<div class="col-md-11 col-xs-12 text-center div_mobile">
							<div class="row div_mobile flex_center colMob">
								<div class="col-md-4 text-right">
									<label for="nome">Nome* </label>
								</div>
								<div class="col-md-8">
									<input autocomplete="<?=date('ymdhis')?>" onkeyup="atualizaCampo('nome')" type="text" name="nome" id="nome" required="" class="form-control input_default" placeholder="Digite o nome ...">
								</div>
							</div>						
							<div class="row div_mobile flex_center colMob">
								<div class="col-md-4 text-right">
									<label for="email">E-mail* </label>
								</div>
								<div class="col-md-8">
									<input autocomplete="<?=date('ymdhis')?>" onkeyup="atualizaCampo('email')" type="email" name="email" id="email" required="" class="form-control input_default" placeholder="Digite o e-mail..." pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
								</div>
							</div>						
							<div class="row div_mobile flex_center colMob">
								<div class="col-md-4 text-right">
									<label for="tel">Telefone </label>
								</div>
								<div class="col-md-8">
									<input autocomplete="<?=date('ymdhis')?>" onkeyup="atualizaCampo('tel')" type="text" name="tel" id="tel" class="form-control input_default phone_with_ddd" placeholder="Digite o telefone...">
								</div>
							</div>						
							<div class="row div_mobile flex_center colMob">
								<div class="col-md-4 text-right">
									<label for="investimento">Investimento </label>
								</div>
								<div class="col-md-8">
									<input autocomplete="<?=date('ymdhis')?>" onkeyup="atualizaCor()" type="text" name="investimento" id="m_prefix_pt_br" class="form-control input_default" placeholder="Quanto deseja investir...">
								</div>
							</div>						
							<div class="row div_mobile colMob">
								<div class="col-md-12 col-sm-12 col-xs-12 text-left hidden-sm hidden-xs text-right">
									<p class="tag_required">*Campos obrigatórios</p>
								</div>
							</div>											
							<div class="mt20 text-center">
								<button type="submit" name="enviar_form" class="btn btn-default btn_custom">ENVIAR</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		@if(session('modal'))
			@include('partials.modals.modal_interesse')
			<script>
				$(function() {
					$('#modalInteresse').modal('show');
				});
			</script>
		@endif
	</section>
@endsection
