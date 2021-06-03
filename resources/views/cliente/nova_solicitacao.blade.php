@extends('layouts.cliente.topo')
@section('content')
<style>
	.texto_formulario{
		margin-top: 5px;
		}
	.rodape{
		position: absolute ;
	}
	.mb100 {
		margin-bottom: 100px;
	}
	body {
		min-height: 100vh !important;
	}
	.topo_default{
		display: none !important;
	}
	.fonteproximo{
		cursor: pointer;
	}
</style>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
	<div class="container-fluid" ng-app="myApp" ng-controller="myCtrl" style="padding-top: 10px; padding-bottom: 30px;" ng-cloak>
		<div ng-show="etapa==0">@include('partials.solicitar_arquivos')</div>
		<div ng-show="etapa==1 && arquivo==1" class="nfe">@include('partials.nfe18')</div>
		<div ng-show="etapa==2 && arquivo==1">@include('partials.resumo_bordero')</div>
		<div ng-show="etapa==3 && arquivo==1">@include('partials.conta_recebimento')</div>
		<div ng-show="showModal == 1">@include('partials.modals.solicitacao_enviada')</div>
	
		<div class="fundorodapesteps" ng-show="etapa >= 0">
			<div class="container-fluid alinhaconteudo">
				<div class="flexpai">
					<div class="dflexaligncenter" ng-show="etapa >= 0">
						<i class="fa fa-caret-left iconeproximo"></i>
						<span class="fonteproximo" ng-click="mudaStep(etapa-1)">VOLTAR</span>
					</div>
					<div class="flexbolinhas" style="gap: 10px;">
						<div class="bolinhapreenchida"></div>
						<div ng-class="etapa >= 1?'bolinhapreenchida':'bolinhavazia'" class=""></div>    
						<div ng-class="etapa >= 2?'bolinhapreenchida':'bolinhavazia'" class=""></div>  
						<div ng-class="etapa == 3?'bolinhapreenchida':'bolinhavazia'" class=""></div>
					</div>
					<div ng-show="etapa != 3 && arquivo == 1" class="divflexend">
						<span class="fonteproximo" ng-click="avancaStep()">PRÓXIMO</span>
						<i class="fa fa-caret-right iconeproximo"></i>
					</div>
					<div ng-show="etapa != 3 && arquivo == 0" class="divflexend">
						<span class="fonteproximo" ng-click="alertArquivo()">PRÓXIMO</span>
						<i class="fa fa-caret-right iconeproximo"></i>
					</div>
					<div ng-show="etapa == 3" class="divflexend">
						<div ng-show="etapa == 3 && (contas.length > 0 && contas[0].agencia != '' && contas[0].conta != '' && contas[0].digito != '' && contas[0].banco != '')" class="divflexend">
							<span class="fonteproximo final" ng-click="enviaSolicitacao()">FINALIZAR <img src="{{asset('/images/proximo_icn.png')}}"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="{{asset('js/cliente/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/cliente/mask.min.js')}}"></script>
	
	<script>
		var app = angular.module('myApp', []);

		app.directive("fileInput", function($parse){
			return{
				link: function($scope, element, attrs){
					element.on("change", function(event){
						var files = event.target.files;
						$parse(attrs.fileInput).assign($scope, element[0].files);
						$scope.$apply();
						angular.element(this).scope().uploadXML();
					});
				}
			}
		});

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
				for (var i = 0; i < $scope.myFile; i++) {
					formData.append('file' + i, $scope.myFile[i]);
				}
				console.log(file);
				//fd.append('file', file);
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
			$scope.etapa 				= 0;
			$scope.arquivo 				= 0;
			$scope.dados                = [];
			$scope.solicitacao          = {};
			$scope.arquivo_caminho  	= '';
			$scope.contas 				= [1];
			$scope.contaSelecionada  	= '';
			$scope.tipo_simulacao  		= 1;
			$scope.exibe_tabela  		= 1;
			$scope.showModal			= 0;
			$scope.ativo				= 0;
			$scope.vencimento_inicial	= '';
			$scope.valor				= '';
			$scope.quantidade_parcela	= '';
			$scope.totalAntecipado		= 0; 
			$scope.admin				= 0;
			$scope.mail					= 0;		

			$http.get("<?=route('cliente.contas','id='.$id)?>")
			.success(function(data){
				$scope.contas = data;
				$scope.contaSelecionada = data[0].id;
				$scope.dados.id_cliente_conta =  data[0].id;
				console.log($scope.admin);
			})

			$scope.uploadXML = function(){
				var form_data = new FormData();
				var uploadUrl 			= "<?=route('sobexmlinterno')?>";
				angular.forEach($scope.myFile, function(file){
					form_data.append('file[]', file);
				});
				$http.post(uploadUrl, form_data,{
					transformRequest: angular.identity,
					headers: {'Content-Type': undefined,'Process-Data': false}
				}).success(function(response){
					if($scope.dados.length == 0){
						$scope.dados = response;
					}else{
						angular.forEach(response, function(r){
							$scope.dados.push(r);
						});
					}
					if($scope.dados && $scope.dados > 0){
						$scope.arquivo          	= 1;
						$scope.tipo_simulacao       = 1;
						$scope.exibe_tabela       	= 1;
					}else{
						$scope.arquivo          	= 1;
						$scope.tipo_simulacao       = 2;
						$scope.exibe_tabela       	= 0;
					}
					$scope.carregaInformacoes();
				});
			}	

			$scope.mudaStep = function(v) {
				if(v == -1){
					if($scope.admin == true){
						window.location.href = "<?=route('admin.solicitacoes');?>";
					}else{
						window.location.href = "<?=route('cliente.index')?>";
					}
					
				}	
				$scope.etapa = v;
			}

			$scope.trocaAtivo = function(v) {
				$scope.ativo = v;
			}

			$scope.atualizaValorConta = function(v){
				$scope.contaSelecionada = v;
				$scope.dados.id_cliente_conta = v;
				console.log(v,$scope.contaSelecionada);
			}

			$scope.carregarArquivo = function(){
				var file 				= $scope.myFile;
				var uploadUrl 			= "<?=route('sobexmlinterno')?>";
				var fd = new FormData();
				fd.append('file', file);
				$http.post(uploadUrl, fd, {
					transformRequest: angular.identity,
					headers: {'Content-Type': undefined}
				}).success(function(d){
					$scope.dados = d;
					$scope.arquivo_nome = d['totalGeral']['xml_file'];
						if(d.cobr && d.cobr.length > 0){
							$scope.arquivo          	= 1;
							$scope.tipo_simulacao       = 1;
							$scope.exibe_tabela       	= 1;
						}else{
							$scope.tipo_simulacao       = 2;
							$scope.exibe_tabela       	= 0;
							$scope.arquivo 			  = 1;
						}
					}
				);
			}

			$scope.carregaInformacoes = function(){
				angular.forEach($scope.dados, function(d){
					if(d.cobr){
						$scope.tipo_simulacao 		= 2;
						$scope.exibe_tabela 		= 1;
					}else{
						$http.post("<?=route('parcelasInterna')?>",{
							'vencimento_inicial': <?= date('d/m/Y')?>,
							'valor': d.totalGeral.valorSoma,
							'quantidade_parcela': 1,
							'arquivo_nome': d.totalGeral.xml_file
						}).success(function(data){
							d.cobr = data.cobr;
							d.totalGeral = data.totalGeral;
							$scope.tipo_simulacao 		= 2;
							$scope.exibe_tabela 		= 1;
							$new 	= data.totalGeral.totalGeralJuros.replace('.', '');
							$new 	= $new.replace(',', '.');
							$scope.totalAntecipado 	= $new*1 + $scope.totalAntecipado*1;
						}); 
					}
				});
			}

			$scope.avancaStep = function() {
				if ($scope.etapa == 0) {
					if($scope.myFile){
						$scope.arquivo          = 1;
					}else{
						alert ('Insira um Arquivo XML');
						return false;
					}
				}
				if ($scope.etapa == 1) {
					$scope.arquivo          = 1;
					$scope.totalAntecipado	= 0;
					angular.forEach($scope.dados, function(d){
						$scope.jurosSub		= 0;
						d.totalGeral.tacSoma = 0;
						angular.forEach(d.cobr, function(c){
							$a 		= moment(c.dVenc,'DD/MM/YYYY');
							$b		= moment();
							d.diff 	= $a.diff($b,'days');
							d.diff 	+= 1;
							d.diff  = Math.round(d.diff/d.cobr.length);
							$new 	= c.vJurosReal.replace('.', '');
							$new 	= $new.replace(',', '.');
							$scope.jurosSub += $new*1;
							d.totalGeral.jurosTotal = c.vJuros;
							$tacsoma 	  =	d.totalGeral.tac.replace('.','');
							$tacsoma 	  =	$tacsoma.replace(',','.');
							d.totalGeral.tacSoma 	  += $tacsoma*1;
							console.log(d.totalGeral.tacSoma);
							console.log($scope.jurosSub);
							console.log(d.totalGeral.jurosTotal);
						});
						//Cálculo de Total Antecipado para a página de resumo de borderô
						$new 	= d.totalGeral.totalGeralJuros.replace('.', '');
						$new 	= $new.replace(',', '.');
						$scope.totalAntecipado 	+= $new*1;
						console.log($scope.totalAntecipado);

						$scope.jurosSub = parseFloat($scope.jurosSub.toFixed(2))
						$scope.jurosSub	= $scope.jurosSub.toLocaleString('pt-br', {minimumFractionDigits: 2});
						
						d.totalGeral.tacSoma = parseFloat(d.totalGeral.tacSoma.toFixed(2))
						d.totalGeral.tacSoma	= d.totalGeral.tacSoma.toLocaleString('pt-br', {minimumFractionDigits: 2});
						d.jurosSub 		= $scope.jurosSub;
					});
					$scope.totalAntecipado 	= new Intl.NumberFormat('BRL', { maximumSignificantDigits: 8 }).format($scope.totalAntecipado);
					console.log('Etapa 1 ');
				}

				if ($scope.etapa == 2) {
					$scope.arquivo          = 1;
					console.log('Etapa 2');
				}

				if ($scope.etapa == 3) {
					$scope.arquivo          = 1;
					console.log('Etapa 3');
				}

				if ($scope.etapa < 3) {
					$scope.etapa++;
				}
			}

			$scope.formataMoeda = function(z){      
				v = z;    
				v = v.replace(/\D/g,"");  
				v = v.replace(/[0-9]{12}/,"inválido"); 
				v = v.replace(/(\d{1})(\d{8})$/,"$1.$2");  
				v = v.replace(/(\d{1})(\d{5})$/,"$1.$2");
				v = v.replace(/(\d{1})(\d{1,2})$/,"$1,$2"); 
				return v 
			}

			$scope.calculo = function(p,f){
				$scope.dados[p].cobr[f].vDup = $scope.formataMoeda($scope.dados[p].cobr[f].vDup);
				$scope.total 		= 0;
				$scope.totalJuros	= 0;
				$a 		= moment($scope.dados[p].cobr[f].dVenc,'DD/MM/YYYY');
				$b		= moment();
				$diff 	= $a.diff($b,'days');
				$validate = validateDate($scope.dados[p].cobr[f].dVenc);
				console.log('Tratamento 1',$diff < 0,$scope.dados[p].cobr[f].dVenc == 10);
				console.log('Tratamento 2',$validate,$scope.dados[p].cobr[f].dVenc.length == 10);
				if($diff < 0 && $scope.dados[p].cobr[f].dVenc.length == 10 || $validate == false && $scope.dados[p].cobr[f].dVenc.length == 10){
					alert('Data de vencimento inválida');
					$b.locale('pt-br');
					$scope.dados[p].cobr[f].dVenc = $b.format('DD/MM/YYYY');
					$scope.calculo(p,f);
					return false;
				}else{
					angular.forEach($scope.dados[p].cobr, function(d){
						//Calculo de Total Antecipado (Soma do valor de todas as parcelas do xml)
						$string 	  =	d.vDup.replace('.','');
						$string 	  =	$string.replace(',','.');
						$scope.total += $string*1;
					});
					//Calculo de Juros baseado na data de vencimento
					$a 		= moment($scope.dados[p].cobr[f].dVenc,'DD/MM/YYYY');
					$b		= moment();
					$diff 	= $a.diff($b,'days');
					$string 	  =	$scope.dados[p].cobr[f].vDup.replace('.','');
					$string 	  =	$string.replace(',','.');
					$stringtac 	  =	$scope.dados[p].totalGeral.tac.replace('.','');
					$stringtac 	  =	$stringtac.replace(',','.');
					$string		  = $string-$stringtac; 	
					console.log($diff);
					$scope.dados[p].cobr[f].vJuros	 	= ($scope.dados[p].totalGeral.jurosAplicado/30)*($diff+1);
					console.log('juros 100%',$scope.dados[p].cobr[f].vJuros);
					console.log($string);
					$valorDosJuros						= ($scope.dados[p].cobr[f].vJuros/100)*($string*1);
					$valorComJuros						= $string*1 - $valorDosJuros;
					console.log('Valor com juros', $valorDosJuros)

					$valorDosJuros = parseFloat($valorDosJuros.toFixed(2))
					$valorComJuros = parseFloat($valorComJuros.toFixed(2))

					$scope.dados[p].cobr[f].vJurosReal	= $valorDosJuros.toLocaleString('pt-br', {minimumFractionDigits: 2});
					$scope.dados[p].cobr[f].vTotal		= $valorComJuros.toLocaleString('pt-br', {minimumFractionDigits: 2});
					angular.forEach($scope.dados[p].cobr, function(d){
						//Calculo de Total Antecipado (Soma do valor de todas as parcelas do xml)
						$string 	  =	d.vTotal.replace('.','');
						$string 	  =	$string.replace(',','.');
						$scope.totalJuros += $string*1;
					});
					$scope.total = parseFloat($scope.total.toFixed(2))
					$scope.totalJuros = parseFloat($scope.totalJuros.toFixed(2))
					$scope.dados[p].totalGeral.totalGeralSimples = $scope.total.toLocaleString('pt-br', {minimumFractionDigits: 2});
					$scope.dados[p].totalGeral.totalGeralJuros = $scope.totalJuros.toLocaleString('pt-br', {minimumFractionDigits: 2});
					console.log($scope.dados[p]);
				}
			}

			$scope.enviaSolicitacao = function(){
				angular.forEach($scope.dados, function(d){
					if($scope.contaSelecionada != ''){
						$http.post("<?=route('api.cadastraXml')?>",{
							'dados': d,
							'conta': $scope.contaSelecionada
						}).success(function(data){
							if($scope.mail == 0){
								$http.post("<?=route('email.sucesso')?>",{
									'dados': d
								}).success(function(data){
									if(data.retorno == 'sucesso'){
										$scope.mail = 1;
									}else{
										$scope.mail = 1;
									}
								})
							}

							$scope.mail = 1;
							
							if(data.retorno == 'erro'){
								alert('Verifique os dados de conta bancária/parcelas e tente novamente.');
								return false;
							}		
						})
					}else{
						alert('Verifique os dados de conta bancária/parcelas e tente novamente.');
						return false;
					}
				});
				$scope.showModal = 1;
			}

			$scope.removeParcela = function(p,f) {

				if(angular.isDefined($scope.dados[p].cobr[f].vTotal)){

					$scope.subtraiValor(p,f);

					for($i = f; $i<$scope.dados[p].cobr.length; $i++){
						$scope.dados[p].cobr[$i].nDup = '0' + $i;
					}
					// //Total sem descontos
					// $new = $scope.dados.totalGeral.totalGeralSimples.replace('.', '');
					// $new = $new.replace(',', '.');
					// $new2 = $scope.dados[p].cobr[f].vDup.replace('.', '');
					// $new2 = $new2.replace(',', '.');
					// $novo = $new - $new2;
					// $scope.dados.totalGeral.totalGeralSimples = new Intl.NumberFormat('BRL', { maximumSignificantDigits: 6 }).format($novo);

					// //Total com descontos
					// $new = $scope.dados.totalGeral.totalGeralJuros.replace('.', '');
					// $new = $new.replace(',', '.');
					// $new2 = $scope.dados[p].cobr[f].vTotal.replace('.', '');
					// $new2 = $new2.replace(',', '.');
					// $novo = $new - $new2;
					// $scope.dados.totalGeral.totalGeralJuros = new Intl.NumberFormat('BRL', { maximumSignificantDigits: 6 }).format($novo);
				}

				$scope.dados[p].cobr.splice(f, 1);
			}

			$scope.adicionaParcela = function(v){
				if(	$scope.dados[v].cobr[$scope.dados[v].cobr.length - 1].vDup == undefined || 
					$scope.dados[v].cobr[$scope.dados[v].cobr.length - 1].dVenc == undefined||
					$scope.dados[v].cobr[$scope.dados[v].cobr.length - 1].vDup == '0,00'){
					alert('Finalize o preenchimento das parcelas anteriores antes de adicionar uma nova');
					return false;
				}else{
					$scope.dados[v].cobr.push({});
					$m = moment($scope.dados[v].cobr[$scope.dados[v].cobr.length - 2].dVenc,'DD/MM/YYYY');
					console.log('momento antes dos 30',$m);
					$scope.dados[v].cobr[$scope.dados[v].cobr.length - 1].dVenc = moment($scope.dados[v].cobr[$scope.dados[v].cobr.length - 2].dVenc,'DD/MM/YYYY').add(1,'M').format('DD/MM/YYYY');
					console.log('MOMENTO depois dos 30',$scope.dados[v].cobr[$scope.dados[v].cobr.length - 1]);
					$scope.dados[v].cobr[$scope.dados[v].cobr.length - 1].vDup = $scope.dados[v].cobr[$scope.dados[v].cobr.length - 2].vDup;
					$scope.calculo(v,$scope.dados[v].cobr.length - 1);
				}
			}

			$scope.removeDados = function(v){
				$scope.dados.splice(v, 1);
				if($scope.dados.length < 1){
					$scope.arquivo = 0;
				}
			}

			$scope.atualizaValores = function(p,f) {
				//console.log($scope.dados[p].cobr[f].vDup.replace(/\D+/g, '')/100);
				$scope.vdupAnterior = $scope.dados[p].cobr[f].vDup;
				$scope.dados[p].cobr[f].vDup = $scope.dados[p].cobr[f].vDup
				//console.log($scope.dados[p].cobr[f].vDup);
				$http.post("<?=route('atualiza.parcelas')?>",{
					'data_venc': $scope.dados[p].cobr[f].dVenc,
					'valor': $scope.dados[p].cobr[f].vDup,
					'total': $scope.dados[p].totalGeral.totalGeralSimples,
					'total_juros': $scope.dados[p].totalGeral.totalGeralJuros
				}).success(function(data){
					if(data.erro){
						alert('Verifique as informações de data de vencimento e valor da parcela e preencha novamente');
						$scope.dados[p].cobr[f].vDup = 0;
						return false;
					}else{
						$scope.dados[p].totalGeral.totalGeralSimples = data.vTotal;
						$scope.dados[p].totalGeral.totalGeralJuros = data.vTotalJuros;
						$var = f+1;
						$scope.dados[p].cobr[f].nDup = '0' + $var;
						$scope.dados[p].cobr[f].vTotal = data.vJuros;
						$scope.dados[p].cobr[f].vJurosReal = data.juros;
						$scope.dados[p].cobr[f].diffDias = data.dias;
						$scope.dados[p].cobr[f].vJuros = data.porcJuros;
						$scope.dados[p].cobr[f].vDup = data.vDupForm;
					}
				})
			}

			$scope.alertArquivo = function() {
				alert('Insira um Arquivo XMLx');
				return false;
			}

			$scope.subtraiValor = function(p,f){
				$validate = validateDate($scope.dados[p].cobr[f].dVenc);
				if($validate == false){
					alert('Preencha a data de vencimento da parcela');
					return false;
				}else{
					console.log($scope.dados[p].cobr[f]);
					$http.post("<?=route('remove.parcela')?>",{
						'valor': $scope.dados[p].cobr[f].vDup,
						'valor_parcela': $scope.dados[p].cobr[f].vTotal,
						'total': $scope.dados[p].totalGeral.totalGeralSimples,
						'total_juros': $scope.dados[p].totalGeral.totalGeralJuros
					}).success(function(data){
						if(data.erro){
							console.log(data.erro);
							return false;
						}else{
							$scope.dados[p].totalGeral.totalGeralSimples = data.vTotal;
							$scope.dados[p].totalGeral.totalGeralJuros = data.vTotalJuros;
						}
						
					})
				}
			}

			$scope.cepCliente = function() {
				$http.get('https://viacep.com.br/ws/'+ $scope.dados.dest.CEP + '/json/').success(function(data){
					$scope.dados.dest.xLgr = data.logradouro;
					$scope.dados.dest.xCpl = data.complemento;
					$scope.dados.dest.xBairro = data.bairro;
					$scope.dados.dest.xMun = data.localidade;
					$scope.dados.dest.UF = data.uf;
				});
			}

			$scope.isChecked = function(a,b){
				if (a == 0){
					return true;
				}else{
					return false;
				}
			}
		}]);
	</script>	

	<script>
		$('.cpf').mask('000.000.000-00', {
			reverse: true
		});
		$('.cnpj').mask('00.000.000/0000-00', {
			reverse: true
		});
		$('.fone').mask('(00) 00000-0000');
		$('.date').mask('00/00/0000');
		$('.cep').mask('00000-000');
		$('.money').mask('000.000,00', {reverse: true});
	</script>
	<script>
	function validateDate(data) {
        // Ex: 10/01/1985
		console.log(data);

        var regex = "\\d{2}/\\d{2}/\\d{4}";
        var dtArray = data.split("/");

        if (dtArray == null)
            return false;

        // Checks for dd/mm/yyyy format.
        var dtDay= dtArray[0];
        var dtMonth = dtArray[1];
        var dtYear = dtArray[2];
		if(dtDay.length < 2 || dtMonth.length < 2 || dtYear.length < 4){
			return false;
		}
        if (dtMonth < 1 || dtMonth > 12)
            return false;
        else if (dtDay < 1 || dtDay> 31)
            return false;
        else if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31)
            return false;
        else if (dtMonth == 2)
        {
            var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
            if (dtDay> 29 || (dtDay ==29 && !isleap))
                return false;
        }
        return true;
    }

	var isValidDate = function(str) {
    return str == 'dd/mm/yyyy' || 
           ( /^\d{2}\/\d{2}\/\d{4}$/.test(str) && new Date(str).getTime() );
	}
	</script>

@endsection