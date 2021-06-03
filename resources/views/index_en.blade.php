@extends('layouts.topo_en')
@section('content')
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>

	<div ng-controller="myCtrl">
		<section class="slider_show hidden-xs">
			<div id="myCarousel" class="carousel slide top_slider" data-ride="carousel" style="">
				<!-- <ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li> -->
					<!-- <li data-target="#myCarousel" data-slide-to="2"></li> 
				</ol>-->
				<div class="carousel-inner">
					<div class="item active first_img">
						<div class="container box_into_banner">
							<div class="row text-right">
								<div class="col-md-12">
									<p class="banner_title">cash To Flow</p>
									<p class="banner_text">A easy, fast and secure way<br> for receivables anticipation.</p>
									<div class="mt40">
										<a class="sign_button links_rodape" href="#simulation">SIMULATE NOW</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- <a class="left carousel-control first-left" href="#myCarousel" data-slide="prev">
					<img src="images/banner_arrow_left.png">
				</a>
				<a class="right carousel-control first-right" href="#myCarousel" data-slide="next">
					<img src="images/banner_arrow_right.png">
				</a> -->
				<a href="#how_works" class="links_rodape wow bounceInUp">
					<img class="button_scroll animated infinite bounce" src="images/scroll_icn.png" alt="">
				</a>
			</div>
		</section> <!--/#main-slider-->

		<section class="visible-xs back_mobile text-center">
			<!-- <div style="height: 100%; width: 100%; overflow: hidden;">
				<img src="images/background_smart.jpg" alt="back" width="100%">
			</div> -->
			<p class="banner_title">cash to Flow</p>
			<p class="banner_text float_banner_mobile">A easy way, fast and security for receivables anticipation.</p>
			<div class="mt40 float_banner_mobile">
				<a class="sign_button sign_button_banner links_rodape" href="#simulation">SIMULATION</a>
			</div>
			<a href="#how_works" class="links_rodape wow bounceInUp">
				<img class="button_scroll animated infinite bounce" src="images/scroll_icn.png" alt="">
			</a>
		</section>
		
		<!-- SERVICES -->
		<section id="how_works">
			<div class="container">
				<div class="row justify_center">
					<div class="col-md-12 text-center">
						<h2 class="quemsomostitle">HOW IT WORKS</h2>
					</div>
				</div>
			</div>
		</section>

		<!-- BANNER DESK -->
		<section class="mb60 hidden-xs">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<img class="img_banner" src="images/how_it_works@2x.png" alt="banner" width="100%">
					</div>
				</div>
			</div>
		</section>

		<!-- BANNER MOBILE -->
		<section class="mb60 visible-xs">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<img class="img_banner" src="images/how_it_works_responsive.png" alt="banner" width="100%">
					</div>
				</div>
			</div>
		</section>

		<!-- SERVICES DESCRIPTION -->
		<section id="benefits" style="background-color: #FF3189;">
			<div class="container">
				<div class="row" style="padding-bottom: 35px;" >
					<div class="col-md-12 text-center mb20">
						<h2 class="partners_title">EASY AND FAST</h2>
					</div>
					<div class="col-md-4 text-center mt40 mb40">
						<img class="size_block" src="images/cadastro_simplificado_icn.png" alt="company">
						<h5 class="title_partiners_icons mt20">Easy register</h5>
					</div>
					<div class="col-md-4 text-center mt40 mb40" >
						<img class="size_block" src="images/envie_solicitacao_icn.png" alt="company">
						<h5 class="title_partiners_icons mt20">Send your solicitation</h5>
					</div>
					<div class="col-md-4 text-center mt40 mb40" >
						<img class="size_block" src="images/confirmacao_em_segundos_icn.png" alt="company">
						<h5 class="title_partiners_icons mt20">Confirmation in minutes</h5>
					</div>
				</div>
			</div>
		</section>

		<!-- SERVICES -->
		<section id="simulation" ng-cloak>
			<div class="container">
				<div class="row justify_center">
					<div class="col-md-12 text-center">
						<h2 class="quemsomostitle">SIMULATE NOW</h2>
					</div>
					<div class="col-md-12 text-center mt20" style="font-size: 21px; font-weight: 400;">
						<div class="div_botoes_switch">
							<div class="div_fundo_switch">
								<div class="botoes_switch" ng-click="trocaTipoSimulacao(1)" ng-class="tipo_simulacao == 1?'ativo':''">AUTOMATIC</div>
								<div class="botoes_switch" ng-click="trocaTipoSimulacao(2)" ng-class="tipo_simulacao == 2?'ativo':''">MANUAL</div>
							</div>
						</div>
					</div>
					<div>
						<div class="col-md-12 text-center mt40">
							<p ng-show="tipo_simulacao == 1"><strong>SELECT</strong> A <strong>.XML</strong> FILE TO SIMULATE</p>
							<p ng-show="tipo_simulacao == 2"><strong>FILL</strong> THE <strong>INFORMATION</strong> TO SIMULATE</p>
						</div>
						<div class="col-md-12 mt30" ng-show="tipo_simulacao == 1">
							<div class="row">
								<div class="col-md-offset-3 col-md-6">
									<input type="file" file-model="myFile" class="input_default form-control">
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-12 mt20" ng-show="tipo_simulacao == 2">
						<div class="row">
							<div class="col-md-offset-2 col-md-8">
								<div class="col-md-4">
									<label>Inicial Installment</label>
									<input type="text" class="input_default form-control data_padrao" ng-model="vencimento_inicial">
								</div>
								<div class="col-md-4">
									<label>Value</label>
									<input type="text" class="input_default form-control" onkeyup="moeda(this)" ng-model="valor">
								</div>
								<div class="col-md-4">
									<label>Number of Installments</label>
									<input type="number" class="input_default form-control" ng-model="quantidade_parcela">
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-12 text-center">
						<div class="mt20 mb20" ng-show="tipo_simulacao == 1"> 
							<button class="sign_button_simulation" ng-click="carregarArquivo()" style="padding: 5px 57px; border: 1px solid #FF4393;">SIMULAR</button>
						</div>
						<div class="mt20 mb20" ng-show="tipo_simulacao == 2"> 
							<button class="sign_button_simulation" ng-click="carregaInformacoes()" style="padding: 5px 57px; border: 1px solid #FF4393;">SIMULAR</button>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- SERVICES -->
		<section id="" ng-show="arquivo != ''" ng-cloak>
			<div class="text-center div_diferentes" ng-if="dados.totalGeral.valorOriginalNota != dados.totalGeral.valorSoma">
				<i class="fa fa-exclamation-triangle"></i> <b>Attention,</b> the value of the installments is different from the total of the note!
			</div>
			<form action="" class="text-center">
				<table data-table-list>
					<thead>
						<tr>
							<th style="width: 20%" class="text-center">INSTALLMENTS</th>
							<th style="width: 20%" class="text-center">EXPIRING DATE</th>
							<th style="width: 20%" class="text-center hidden-xs">INSTALLMENT VALUE</th>
							<th style="width: 20%" class="text-center hidden-xs">INTEREST VALUE</th>
							<th style="width: 20%" class="text-center">VALUE TO RECEIVE</th>
						</tr>
					</thead>
					<tbody>
						<tr class="clickable-row" ng-repeat="d in dados.cobr">	
							<td style="width: 20%" class="text-center funtabsolic"><% d.nDup %></td>
							<td style="width: 20%" class="text-center funtabsolic"><% d.dVenc %></td>
							<td style="width: 20%" class="text-center funtabsolic hidden-xs">R$ <% d.vDup %></td>
							<td style="width: 20%" class="text-center funtabsolic hidden-xs">R$ <% d.vJurosReal %></td>
							<td style="width: 20%" class="text-center funtabsolic">R$ <% d.vTotal %></td>		
						</tr>
					</tbody>
				</table>
				
				<table data-table-list>
					<thead class="second_table">
						<tr>
							<th style="width: 20%" class="col_tab hidden-xs" scope="col"></th>
							<th style="width: 20%" class="col_tab hidden-xs" scope="col"></th>
							<th style="width: 20%" class="col_tab hidden-xs" scope="col"></th>
							<th style="width: 20%" class="text-center ttu bold_style">TOTAL INTEREST</th>
							<th style="width: 20%" class="text-center bold_style">TOTAL TO RECEIVE</th>
						</tr>
					</thead>
					<tbody class="second_back_color">
						<tr class="clickable-row" data-href=""> 
							<td style="width: 20%" class="col_tab hidden-xs" scope="col"></td>
							<td style="width: 20%" class="col_tab hidden-xs" scope="col"></td>
							<td style="width: 20%" class="col_tab hidden-xs" scope="col"></td>
							<td style="width: 20%" class="text-center bold_style_size" scope="col">1.99 %</td>
							<td style="width: 20%" class="text-center bold_style_size" scope="col">R$ <%dados.totalGeral.totalGeralJuros%></td>
						</tr>
					</tbody>
				</table>
			</form>
		</section>

		<!-- SERVICES -->
		<section id="sign_up">
			<div class="container">
				<div class="row justify_center">
					<div class="col-md-12 text-center">
						<h2 class="quemsomostitle sign_title">SAVE TIME</h2>
						<p class="sign_title">make your register and anticipate your receivables!</p>
						<div class="mt50"> 
							<a class="sign_button" href="{{route('register')}}">SIGN UP</a>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<section id="question" class="mt80 mb60">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<h2 class="quemsomostitle" style="color: #00A7FF;">Commom Questions</h2>
				</div>
			</div>
			<div class="row mt20" >
				@foreach ($all_questions_en as $k => $d)
					<div class="col-md-6" onclick="togglePergunta('{{$k}}')">
						<div class="div-pergunta QandA">
							<span>{{$d['quest']}}</span>
							<img id="setaB{{$k}}" class="seta_baixo" src="images/invest/seta_faq_icn.png" alt="">
							<img id="setaC{{$k}}" class="seta_cima" src="images/invest/seta_faq_recolher_icn.png" alt="" style="display: none;">
						</div>
						<div class="div-conteudo fade item-conteudo{{$k}}" style="display: none;">
							<span>{{$d['answer']}}</span>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>

	<script>
		var app = angular.module('myApp', []);
        app.config(function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
		});
		
		app.directive('fileModel', ['$parse', function ($parse) { 
			return { 
				restrict: 'A', 
				link: function(scope, element, attrs) {
					var model = $parse(attrs.fileModel); 
					var modelSetter = model.assign;
					element.bind('change', function(){ 
						scope.$apply(function(){
						modelSetter(scope, element[0].files[0]);
						}); 
					}); 
				} 
			}; 
		}]);

		app.service('fileUpload', ['$http', function ($http) {
			this.uploadFileToUrl = function(file, uploadUrl){
				var fd = new FormData();
				fd.append('file', file);
				$http.post(uploadUrl, fd, {
					transformRequest: angular.identity,
					headers: {'Content-Type': undefined}
				})
				.success(function(d){
					$scope.caminho_arquivo = d;
				})
				.error(function(){
				});
			}
		}]);

		app.controller('myCtrl', ['$scope', '$http', 'fileUpload', function($scope, $http, fileUpload){
			$scope.etapa 				= 1;
			$scope.arquivo 				= 0;
			$scope.dados                = [];
			$scope.solicitacao          = {};
			$scope.arquivo_caminho  	= '';
			$scope.arquivo_erro  		= 0;
			$scope.tipo_simulacao  		= 1;

			$scope.vencimento_inicial	= '';
			$scope.valor				= '';
			$scope.quantidade_parcela	= ''; 
			
			$scope.carregarArquivo = function(){
				if($scope.myFile != undefined){
					$scope.arquivo          = 0;
					$scope.arquivo_erro     = 0;
					var file 				= $scope.myFile;
					var uploadUrl 			= "<?=route('sobexml')?>";
					
					var fd = new FormData();
					fd.append('file', file);
					$http.post(uploadUrl, fd, {
						transformRequest: angular.identity,
						headers: {'Content-Type': undefined}
					}).success(function(d){
						if(d.cobr && d.cobr.length > 0){
							$scope.arquivo          	= 1;
							$scope.dados = d;
						}else{
							$scope.tipo_simulacao       = 2;
						}
					});
				}
			}

			$scope.carregaInformacoes = function(){
				if($scope.vencimento_inicial != '' && $scope.valor != '' && $scope.quantidade_parcela != ''){
					$http.post('<?=route('parcelas')?>',{
						'vencimento_inicial': $scope.vencimento_inicial,
						'valor': $scope.valor,
						'quantidade_parcela': $scope.quantidade_parcela,
					}).success(function(data){
						$scope.arquivo 				= 1;
						$scope.arquivo_erro 		= 0;
						$scope.dados 				= data;
					});  
				}
			}

			$scope.trocaTipoSimulacao = function(v){
				$scope.tipo_simulacao = v;
			}
		}]);
	</script>
@endsection

