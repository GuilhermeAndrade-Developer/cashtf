@extends('layouts.topo_en')
@section('content')
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>

	<div ng-controller="myCtrl">
		<section class="slider_show">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<div class="item active about_img">
					<div class="container box_about">
						<div class="row text-right">
							<div class="col-md-12">
								<p class="banner_title_about">Who we are</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section> 
		
		<!-- EXPERIÊNCIA -->
		<section id="experiencia">
			<div class="container">
				<div class="row justify_center mb50">
					<div class="col-md-6 margins_exp">
						<h2 class="about_title">MARKET </br> EXPERIENCE</h2>
						<p class="about_text">Our founders have the experience throughout their journey on working in many companies on the industrial sectors, commerce and services, beyond working in one of the greatest commercial banks of the country, because of this they are can what is the necessities that the entrepreneurs have to maintain their business mainly in these times of turbulence. </p>
					</div>
					<div class="col-md-6 img_flex">
						<img class="experience" src="images/about/experiencia_de_mercado_todo.png" alt="experiencia">
					</div>
				</div>
			</div>
		</section>

		<!-- NEGÓCIO DESK -->
		<section id="negocio" class="mb7">
			<div class="container">
				<div class="row">
					<div class="col-md-6 img_flex">
						<img class="business" src="images/about/o_negocio_img.png" alt="negocio">
					</div>
					<div class="col-md-6 margins_exp">
						<h2 class="about_title" style="color: #00A7FF">THE BUSINESS</h2>
						<p class="about_text">The cashTF look forward to solve the current issues, at this pandemic period, the high rates of the working capital, the restricted access to the corporate credit, and the low digital financial services supply for the micro and small businesses, end up making it difficult the Jobs maintenance and the companies income.</p>  <p class="about_text">Our core business is the buying of receivables from our clients, one of the best financial strategies to the micro and small businesses that have problems with reaching their credit through the bank institutions, without paperwork and with an easy type of understanding throughout our distribution channel completely online, safe and fast, with the lowest interest rates, without taxes or fees to our clients.</p>
					</div>
				</div>
			</div>
		</section>

		<!-- NEGÓCIO MOBILE -->
		<section id="negocio_mob" class="mb7">
			<div class="container">
				<div class="row">
					<div class="col-md-6 margins_exp">
					<h2 class="about_title" style="color: #00A7FF">THE BUSINESS</h2>
					<p class="about_text">TThe cashTF look forward to solve the current issues, at this pandemic period, the high rates of the working capital, the restricted access to the corporate credit, and the low digital financial services supply for the micro and small businesses, end up making it difficult the Jobs maintenance and the companies income.</p>  <p class="about_text">Our core business is the buying of receivables from our clients, one of the best financial strategies to the micro and small businesses that have problems with reaching their credit through the bank institutions, without paperwork and with an easy type of understanding throughout our distribution channel completely online, safe and fast, with the lowest interest rates, without taxes or fees to our clients. </p>
					</div>
					<div class="col-md-6 img_flex">
						<img class="business" src="images/about/o_negocio_img.png" alt="negocio" width="7%">
					</div>
				</div>
			</div>
		</section>
		
		<!-- NOSSO TIME -->
		<section id="time">
			<div class="container mt60">
				<div class="row justify_center mb80">
					<div class="col-md-12 text-center">
						<h2 class="about_title mb50" style="text-align: center">OUR TEAM</h2>
					</div>
					<div class="col-md-12 banner_team flex_center mb30">
						<div class="col-md-4 text_box_members">
							<img class="foto" src="images/about/rodrigo_img.png" alt="Rodrigo" width="70%">
						</div>
						<div class="col-md-8 bShadowMobile">
							<h4 class="member_name" style="color: #00A7FF">Rodrigo Zamprogna <span style="color: #BFBFBF">|</span><span style="color: #333333"> CEO</span> </h4>
							<p class="member_text">Company administrator. 15 years of experience in the financial Market. Experience in traditional banks. (Banco do Brasil e Banrisul). Professional experience in the industries and fashion trade, renewable energy, automotive, and real estate. Profile and entrepreneurial vision, total focus on amplifying the knowledgement featuring new business, dynamic and objective view, leadership spirit, proactivity, and trading expertise. Improvement of banking and business knowledge abroad. </p>
							<div class="flex_center_mob">
								<a href="https://br.linkedin.com/in/rodrigo-zamprogna-42a510102" target="_blank" class="btn btn-linkedin"><img class="icon_linke" src="images/about/linkedin_icn.png">Linkedin</a>
							</div>
						</div>	
					</div>
					<div class="col-md-12 banner_team flex_center mb30">
					<div class="col-md-4 text_box_members">
							<img class="foto" src="images/about/ed_img@2x.png" alt="Eduardo" width=70%>
						</div>
						<div class="col-md-8 bShadowMobile">
							<h4 class="member_name" style="color: #00A7FF">Eduardo Seminari<span style="color: #BFBFBF">|</span><span style="color: #333333"> CTO</span> </h4>
							<p class="member_text">More than twenty-five years of professional experience in the fields of UI/UX, TI, and Marketing, working in the management of people and projects, telecommunications, strategy, innovation, programming, graphic design, multimedia, creation, interface design, usability, user and communication experience in general. Experience in the field of developing new business, creating new strategies based on technology, marketing, and market needs. Rating and managing projects as a whole and normally working with multidisciplinary teams.</p>
							<div class="flex_center_mob">
								<a href="https://br.linkedin.com/in/eduardoseminari/pt-br" target="_blank" class="btn btn-linkedin"><img class="icon_linke" src="images/about/linkedin_icn.png">Linkedin</a>
							</div>
						</div>	
					</div>
					<div class="col-md-12 banner_team flex_center mb30">
					<!-- <div class="col-md-4 text_box_members">
							<img class="foto" src="images/about/rosana_img@2x.png" alt="Rosana" width=70%">
						</div>
						<div class="col-md-8 bShadowMobile">
							<h4 class="member_name" style="color: #00A7FF">Rosana Inês Miotto<span style="color: #BFBFBF">|</span><span style="color: #333333"> CCO</span> </h4>
							<p class="member_text">Graduated in International Trade 18 years of experience in commercial management in the domestic and foreign Market. Fluent in English and Spanish, expertise in product development, marketing and trading with national and international large retail companies. Experience in importing and exporting products. Development and leadership of sales teams. Strategic cost management, commitment, creativity and with great ease in personal relationships. </p>
							<div class="flex_center_mob">
								<a href="https://br.linkedin.com/in/rosana-miotto-4a396462" target="_blank" class="btn btn-linkedin"><img class="icon_linke" src="images/about/linkedin_icn.png">Linkedin</a>
							</div>
						</div>	
					</div> -->
				</div>
			</div>
		</section>
	</div>

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

