@extends('layouts.topo')
@section('content')
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>

	<div ng-controller="myCtrl">
		<section class="slider_show">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<div class="item active about_img">
					<div class="container box_about">
						<div class="row text-right">
							<div class="col-md-12">
								<p class="banner_title_about">Quem Somos</p>
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
						<h2 class="about_title">EXPERIÊNCIA </br> DE MERCADO</h2>
						<p class="about_text">Nossos fundadores têm a experiência de terem ao longo de sua caminhada, mais de uma empresa nos setores da indústria, comércio e serviços, além de terem trabalhado nos maiores bancos comerciais do país, assim vendo qual é a necessidade que os empreendedores têm para manter seus negócios, principalmente em tempos de turbulência. </p>
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
						<h2 class="about_title" style="color: #00A7FF">O NEGÓCIO</h2>
						<p class="about_text">A CashTF visa resolver problemas atuais; nesse momento de pandemia, as altas taxas de capital de giro, acesso reduzido ao crédito corporativo e a baixa oferta de serviços financeiros digitais para micro e pequenas empresas, acabam dificultando a manutenção de empregos e a renda das empresas.</p>  <p class="about_text">Nosso core business é a compra de recebíveis de nossos clientes, uma das melhores estratégias financeiras para micro e pequenas empresas que têm dificuldade em acessar crédito através de instituições bancárias, sem burocracia e com fácil entendimento, através do canal de distribuição totalmente online, ágil e seguro, com menores taxas de juros, sem impostos e tarifas para os clientes. </p>
					</div>
				</div>
			</div>
		</section>

		<!-- NEGÓCIO MOBILE -->
		<section id="negocio_mob" class="mb7">
			<div class="container">
				<div class="row">
					<div class="col-md-6 margins_exp">
					<h2 class="about_title" style="color: #00A7FF">O NEGÓCIO</h2>
						<p class="about_text">A CashTF visa resolver problemas atuais; nesse momento de pandemia, as altas taxas de capital de giro, acesso reduzido ao crédito corporativo e a baixa oferta de serviços financeiros digitais para micro e pequenas empresas, acabam dificultando a manutenção de empregos e a renda das empresas.</p>  <p class="about_text">Nosso core business é a compra de recebíveis de nossos clientes, uma das melhores estratégias financeiras para micro e pequenas empresas que têm dificuldade em acessar crédito através de instituições bancárias, sem burocracia e com fácil entendimento, através do canal de distribuição totalmente online, ágil e seguro, com menores taxas de juros, sem impostos e tarifas para os clientes. </p>
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
						<h2 class="about_title mb50" style="text-align: center">NOSSO TIME</h2>
					</div>
					<div class="col-md-12 banner_team flex_center mb30">
						<div class="col-md-4 text_box_members">
							<img class="foto" src="images/about/rodrigo_img.png" alt="Rodrigo" width="70%">
						</div>
						<div class="col-md-8 bShadowMobile">
							<h4 class="member_name" style="color: #00A7FF">Rodrigo Zamprogna <span style="color: #BFBFBF">|</span><span style="color: #333333"> CEO</span> </h4>
							<p class="member_text">Administrador de empresas. 15 anos de experiência no mercado financeiro. Experiência em bancos tradicionais (concursado Banco do Brasil e Banrisul). Experiência empresarial nas indústrias e comércio de moda, energias renováveis, automotivo e imobiliário. Perfil e visão empreendedora, foco total em ampliar o conhecimento para geração de novos negócios, comunicação objetiva e dinâmica, espírito de liderança, pró-atividade e expertise em negociação. Aprimoramento de conhecimentos bancários e negociais no exterior. </p>
							<div class="flex_center_mob">
								<a href="https://br.linkedin.com/in/rodrigo-zamprogna-42a510102" target="_blank" class="btn btn-linkedin"><img class="icon_linke" src="images/about/linkedin_icn.png">Linkedin</a>
							</div>
						</div>	
					</div>
					<div class="col-md-12 banner_team flex_center mb30">
					<div class="col-md-4 text_box_members">
							<img class="foto" src="images/about/ed_img@2x.png" alt="Eduardo" width=70%">
						</div>
						<div class="col-md-8 bShadowMobile">
							<h4 class="member_name" style="color: #00A7FF">Eduardo Seminari<span style="color: #BFBFBF">|</span><span style="color: #333333"> CTO</span> </h4>
							<p class="member_text">Mais de vinte e cinco anos de experiência profissional nas áreas de UX / UI, TI e Marketing, trabalhando em gerenciamento de projetos e pessoas, telecomunicações, estratégia, inovação, programação, design, gráficos, multimídia, criação, interfaces de design, usabilidade, experiência do usuário e comunicação em geral. Experiência no desenvolvimento de novos negócios, criando estratégias inovadoras com base em tecnologia, marketing e necessidades do mercado, avaliando e gerenciando projetos como um todo e alinhando constantemente com equipes multidisciplinares. </p>
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
							<p class="member_text">Graduada em Comércio Internacional, 18 anos de experiência em gestão comercial no mercado interno e externo. Fluência em Inglês e Espanhol, expertise em desenvolvimento de produtos, marketing e negociação com grandes redes varejistas nacionais e internacionais. Experiência em importação e exportação de produtos. Desenvolvimento e liderança de equipe de vendas. Gestão estratégica de custos, comprometimento, criatividade e com ampla facilidade nos relacionamentos pessoais. </p>
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

