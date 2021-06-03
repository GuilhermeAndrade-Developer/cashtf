@extends('layouts.topo_en')
@section('content')
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>

	<div ng-controller="myCtrl">
		<section class="slider_show">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<div class="active invest_img">
					<div class="container box_invest">
						<div class="row text-right">
							<div class="col-md-12">
								<p class="banner_title_invest">Your Investment is here!</p>
								<p class="subtitle_banner">Know the best way to invest in the Brazilian market.</p>
								<div class="mt30"> 
									<a class="invest_button" href="#invest_contato">INVEST NOW</a>
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
						<p class="invest_title" style="color: #00A7FF;">For all types of investors</p>
						<p class="subtitle_text mb40" style="color: #313131;">Start to invest with the experience of people who has many years in the financial Market.</p>
					</div>
					<div class="col-md-3">
						<div class="square_1">
							<p class="square_title">STARTER</p>
							<p class="square_emph">130% <br /> of CDI</p>
							<p class="square_text">For investments from <br /> R$ 1 to R$ 29 thousand</p> 
						</div>
					</div>
					<div class="col-md-3">
						<div class="square_2">
							<p class="square_title">PRO</p>
							<p class="square_emph">150% <br /> of CDI</p>
							<p class="square_text">For investments from <br /> R$ 30 to R$ 99 thousand</p> 
						</div>
					</div>
					<div class="col-md-3">
						<div class="square_3">
							<p class="square_title">ELITE</p>
							<p class="square_emph">170% <br /> of CDI</p>
							<p class="square_text">For investments <br /> from R$ 100 thousand</p> 
						</div>
					</div>
					<div class="col-md-3">
						<div class="square_4">
							<p class="square_title">PREMIUM</p>
							<p class="square_emph">200% <br /> of CDI</p>
							<p class="square_text">For investments <br /> from R$ 1 million</p> 
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
						
						<p class="subtitle_text" style="color: #313131; margin-bottom: -15px">Why invest with CashTF?</p>
						<p class="invest_title" style="color: #F11070;">Here you will find the best financial return.</p>
					</div>
				</div>
			</div>
			<!-- <div class="space_for_graph">
			falta a parte do gráfico 
				<h5 style="text-align: center; font-size: 50px; color: #fff; padding: 150px;">

					GRÁFICOS

				</h5>
			</div> -->
		</section> 
		
		<!-- INVESTIR AGORA -->
		<section id="investir" class="blue_bckg">
			<div class="container mb100">
				<div class="row justify_center mb50 margins_bckg">
					<div class="col-md-6">
						<p class="invest_session">Your money </br> <strong> yield more </strong> </p>
						<p class="invest_text margR">Here you invest in fixed income, with a minimum stay of only 6 months and liquidity in 30 days. </p>
						<div class="mt50 butAlMob"> 
							<a class="invest_button" href="#invest_contato">INVEST NOW</a>
						</div>
					</div>
					<div class="col-md-6 img_flex" style="position: relative">
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
					<div class="col-md-5">
						<p class="invest_session margR_open" style="color: #00BEF6;"> Your investment paying off <strong> in a few steps </strong> </p>
						<p class="invest_text margR_open" style="color: #313131;"> One of the best fixed income investments at your disposal, easily. </p>
						<div class="butAlMob">
							<img class="cadastro_img" src="images/invest/cadastre_se_agora_icn@2x.png" alt="">
							<span class="invest_text" style="display: inline-grid; color: #313131;"> Register now <br />  <span style="font-weight: bold;"> FREE. </span> </span>
						</div>
						<div class="mt50 butAlMob"> 
							<a class="invest_button" style="padding: 15px 35px;" href="#invest_contato">REGISTER</a>
						</div>
					</div>
					<div class="col-md-7 flex_column">
						<span class="subtitle_text" style="color: #313131;">Register with cashTF</span>
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
										<img src="images/invest/passos_slider_1_en_img.jpg" class="img-responsive d-block first_slide_invest">
									</div>
								</div>
								<div class="item">
									<div style="padding: 30px;">
										<img src="images/invest/passos_slider_2_en_img.jpg" class="img-responsive d-block second_slide_invest">
									</div>
								</div>
								<div class="item">
									<div style="padding: 30px;">
										<img src="images/invest/passos_slider_3_en_img.jpg" class="img-responsive d-block third_slide_invest">
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
						<p class="invest_title mb50 mt50" style="color: #00A7FF;">FAQ (Frequently asked questions)</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 mb80">
						<div class="row">
							@foreach ($duvidas_en as $k => $d)
								<div class="col-md-6" onclick="togglePergunta('{{$k}}')">
									<div class="div-pergunta QandA">
										<span>{{$d['titulo']}}</span>
										<img id="setaB{{$k}}" class="seta_baixo" src="images/invest/seta_faq_icn.png" alt="">
										<img id="setaC{{$k}}" class="seta_cima" src="images/invest/seta_faq_recolher_icn.png" alt="" style="display: none;">
									</div>
									<div class="div-conteudo item-conteudo{{$k}}" style="display: none;">
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
						<div class="col-md-12 invest_title mb20" style="color: #F11070;"><p>INVEST NOW</p></div>
						<div class="col-md-11 col-xs-12 text-center div_mobile">
							<div class="row div_mobile flex_center colMob">
								<div class="col-md-4 text-right">
									<label for="nome">Name* </label>
								</div>
								<div class="col-md-8">
									<input autocomplete="<?=date('ymdhis')?>" onkeyup="atualizaCampo('nome')" type="text" name="nome" id="nome" required="" class="form-control input_default" placeholder="Digite o nome ...">
								</div>
							</div>						
							<div class="row div_mobile flex_center colMob">
								<div class="col-md-4 text-right">
									<label for="email">Email* </label>
								</div>
								<div class="col-md-8">
									<input autocomplete="<?=date('ymdhis')?>" onkeyup="atualizaCampo('email')" type="email" name="email" id="email" required="" class="form-control input_default" placeholder="Digite o e-mail..." pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
								</div>
							</div>						
							<div class="row div_mobile flex_center colMob">
								<div class="col-md-4 text-right">
									<label for="tel">Telephone </label>
								</div>
								<div class="col-md-8">
									<input autocomplete="<?=date('ymdhis')?>" onkeyup="atualizaCampo('tel')" type="text" name="tel" id="tel" class="form-control input_default phone_with_ddd" placeholder="Digite o telefone...">
								</div>
							</div>						
							<div class="row div_mobile flex_center colMob">
								<div class="col-md-4 text-right">
									<label for="investimento">Investment </label>
								</div>
								<div class="col-md-8">
									<input autocomplete="<?=date('ymdhis')?>" onkeyup="atualizaCor()" type="text" name="investimento" id="m_prefix_pt_br" class="form-control input_default" placeholder="Quanto deseja investir...">
								</div>
							</div>						
							<div class="row div_mobile colMob">
								<div class="col-md-12 col-sm-12 col-xs-12 text-left hidden-sm hidden-xs text-right">
									<p class="tag_required">*Required Fields</p>
								</div>
							</div>											
							<div class="mt20 text-center">
								<button type="submit" name="enviar_form" class="btn btn-default btn_custom">SEND</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>


	<script>

		$("input[data-type='currency']").on({
		keyup: function() {
		formatCurrency($(this));
		},
		blur: function() { 
		formatCurrency($(this), "blur");
		}
		});

		function formatNumber(n) {
		// format number 1000000 to 1,234,567
		return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
		}

		function formatCurrency(input, blur) {
		// appends $ to value, validates decimal side
		// and puts cursor back in right position.
		
		// get input value
		var input_val = input.val();
		
		// don't validate empty input
		if (input_val === "") { return; }
		
		// original length
		var original_len = input_val.length;

		// initial caret position 
		var caret_pos = input.prop("selectionStart");
			
		// check for decimal
		if (input_val.indexOf(".") >= 0) {

			// get position of first decimal
			// this prevents multiple decimals from
			// being entered
			var decimal_pos = input_val.indexOf(".");

			// split number by decimal point
			var left_side = input_val.substring(0, decimal_pos);
			var right_side = input_val.substring(decimal_pos);

			// add commas to left side of number
			left_side = formatNumber(left_side);

			// validate right side
			right_side = formatNumber(right_side);
			
			// On blur make sure 2 numbers after decimal
			if (blur === "blur") {
			right_side += "00";
			}
			
			// Limit decimal to only 2 digits
			right_side = right_side.substring(0, 2);

			// join number by .
			input_val = "R$ " + left_side + "." + right_side;

		} else {
			// no decimal entered
			// add commas to number
			// remove all non-digits
			input_val = formatNumber(input_val);
			input_val = "R$ " + input_val;
			
			// final formatting
			if (blur === "blur") {
			input_val += ".00";
			}
		}
		
		// send updated string to input
		input.val(input_val);

		// put caret back in the right position
		var updated_len = input_val.length;
		caret_pos = updated_len - original_len + caret_pos;
		input[0].setSelectionRange(caret_pos, caret_pos);
		}

	</script>




    @endsection

