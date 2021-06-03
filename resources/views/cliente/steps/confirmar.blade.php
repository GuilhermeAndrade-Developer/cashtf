@extends('layouts.cliente.topo')
@section('content')
	<style>
		input[type=text]{   
        	text-transform: uppercase;
    	}
    	.upper-select{
        	text-transform: uppercase;
    	}
		.texto_formulario{
			margin-top: 5px;
			}
		.rodape{
			position: absolute ;
		}
		.drawer-navbar{
			display: none !important;
		}
		.mb100 {
			margin-bottom: 100px;
		}
		body {
			min-height: 100vh !important;
		}
		.topo-default-div{
			display: none !important;
		}
		.drawer-hamburger{
			display: none;
		}
		.fonteproximo{
			cursor: pointer;
		}
		@media (max-height: 850px) {
			.rodape {
				display: none;
			}
		}
	</style>

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
	<div ng-controller="myCtrl" ng-app="myApp" ng-cloak ng-init="verificaCpf()">
		<div ng-show="step==1">@include('partials.dados_do_socio')</div>
		<div ng-show="step==2">@include('partials.dados_da_empresa')</div>
		<div ng-show="step==3">@include('partials.cadastre_conta_bancaria')</div>
		<div ng-show="showModal == 1 && admin == false">@include('partials.modals.cadastro_finalizado')</div>
		<div ng-show="showModal == 1 && admin == true">@include('partials.modals.sucesso')</div>
		<div class="fundorodapesteps">
			<div class="container-fluid alinhaconteudo">
				<div class="flexpai">
					<div class="dflexaligncenter">
						<i class="fa fa-caret-left iconeproximo" ng-show="step > 1"></i>
						<span class="fonteproximo" ng-show="step > 1" ng-click="mudaStep(step-1)">VOLTAR</span>
					</div>
					<div class="flexbolinhas">
						<div ng-class="step == 1?'bolinhapreenchida':'bolinhapreenchida'" class=""></div>  
						<div ng-class="step >= 2?'bolinhapreenchida':'bolinhavazia'" class="mh10"></div>
						<div ng-class="step == 3?'bolinhapreenchida':'bolinhavazia'" class=""></div>
					</div>
					<div ng-show="step != 3" class="divflexend">
						<span class="fonteproximo" ng-click="avancaStep()">PRÓXIMO</span>
						<i class="fa fa-caret-right iconeproximo"></i>
					</div>
					<div ng-show="step == 3" class="divflexend">
					<div ng-show="step == 3 && (contas.length > 0 && contas[0].agencia != '' && contas[0].conta != '' && contas[0].digito != '' && contas[0].banco != '')" class="divflexend">
						<span class="fonteproximo final" ng-click="avancaStep()">FINALIZAR <img src="{{asset('/images/proximo_icn.png')}}"></span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="{{asset('js/cliente/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/cliente/mask.min.js')}}"></script>
		
	<script>
		var app = angular.module('myApp', []);
			app.config(function($interpolateProvider) {
				$interpolateProvider.startSymbol('<%');
				$interpolateProvider.endSymbol('%>');
			});
		app.directive('fileModel', ['$parse', function($parse) {
			return {
				restrict: 'A',
				link: function(scope, element, attrs) {
					var model = $parse(attrs.fileModel);
					var modelSetter = model.assign;
					element.bind('change', function() {
						scope.$apply(function() {
							modelSetter(scope, element[0].files[0]);
						});
					});
				}
			};
		}]);

		app.service('fileUpload', ['$http', function($http) {
			this.uploadFileToUrl = function(file, uploadUrl) {
				var fd = new FormData();
				fd.append('file',file);
				$http.post(uploadUrl, fd, {
						transformRequest: angular.identity,
						headers: {
							'Content-Type': undefined
						}
					})
					.success(function() {})
					.error(function() {});
			}
			this.uploadMultipleFileToUrl = function(files, uploadUrl) {
				var fd = new FormData();
				for(let i in files){
					fd.append('item_file[]', files[i]);
				}
				$http.post(uploadUrl, fd, {
						transformRequest: angular.identity,
						headers: {
							'Content-Type': undefined
						}
					})
					.success(function() {})
					.error(function() {});
			}
		}]);

		app.controller('myCtrl', ['$scope', '$http', 'fileUpload', function($scope, $http, fileUpload) {
			$scope.step = "{{$cliente->etapa}}";
			$scope.socios = [];
			$scope.contas = [];
			$scope.dados = [];
			$scope.dataPessoaFisica = {};
			$scope.dataPessoaJuridica = {};
			$scope.enderecoFisica = {};
			$scope.enderecoJuridica = {};
			$scope.contratoSocial = [];
			$scope.faturamento = [];
			$scope.alteracoesContratuais = [];
			$scope.cpfSocio = 0;
			$scope.cpfInvalido = []
			$scope.docCliente = []
			$scope.procCliente = []
			$scope.myFile = []
			$scope.idcliente = "{{$cliente->id}}";
			$scope.showModal = 3;
			$scope.admin 	= "{{$admin}}";

			//Conferir rotas e funções
			var contasGet = "<?=route('cliente.contas','id='.$cliente->id)?>";
			$http.get(contasGet)
			.success(function(data) {
				$scope.contas = data;
				if($scope.contas.length == 0){
					$scope.contas.push({});
					console.log($scope.admin);
				}
			})

			//Conferir rotas e funções
			var sociosGet = "<?=route('cliente.socios','id='.$cliente->id)?>";
			$http.get(sociosGet)
			.success(function(data) {
				$scope.socios = data;
			})

			$scope.verificaCpf = function() {
				$scope.cpf = "{{$cliente->cpf}}";
				$scope.cnpj = "{{$cliente->cnpj}}";

				$http.post("<?=route('register.step1',['type' => 'cpf','id' => $cliente->id])?>").success(function(data) {
					if (data.Result[0].BasicData.Age) {
						$scope.dataPessoaFisica = data.Result[0].BasicData;
						$scope.pegarEnderecoFisica();
						$scope.dataPessoaFisica.email = "{{$cliente->email}}";
						$scope.dataPessoaFisica.BirthDate = $scope.dataPessoaFisica.BirthDate ? moment($scope.dataPessoaFisica.BirthDate).add(1, 'day').format('DD/MM/YYYY') : ''
						if($scope.dataPessoaFisica.Gender == 'M'){
            				$scope.dataPessoaFisica.Gender = "masculino";
        				} else{
							$scope.dataPessoaFisica.Gender = "feminino";
						}
					} else {
						console.log('CPF não existente');
					}
				});
				$scope.verificaCnpj();
				$scope.pegarEnderecoJuridica();
			}

			$scope.verificaCnpj = function() {
				$http.post("<?=route('register.step1',['type' => 'cnpj','id' => $cliente->id])?>").success(function(data) {
					if (data.Result[0].BasicData.TaxIdNumber) {
						console.log(data);
						$scope.dataPessoaJuridica = data.Result[0].BasicData;
						$scope.dataPessoaJuridica.ClosedDate = $scope.dataPessoaJuridica.ClosedDate ? moment($scope.dataPessoaJuridica.ClosedDate).add(1, 'day').format('DD/MM/YYYY') : ''
						$scope.dataPessoaJuridica.FoundedDate = $scope.dataPessoaJuridica.FoundedDate ? moment($scope.dataPessoaJuridica.FoundedDate).add(1, 'day').format('DD/MM/YYYY') : ''
						$scope.dataPessoaJuridica.CreationDate = $scope.dataPessoaJuridica.CreationDate ? moment($scope.dataPessoaJuridica.CreationDate).add(1, 'day').format('DD/MM/YYYY') : ''
						$scope.dataPessoaJuridica.LastUpdateDate = $scope.dataPessoaJuridica.LastUpdateDate ? moment($scope.dataPessoaJuridica.LastUpdateDate).add(1, 'day').format('DD/MM/YYYY') : ''
						for(var i=0; i < $scope.dataPessoaJuridica.Activities.length; i++){
							if($scope.dataPessoaJuridica.Activities[i].IsMain){
								$scope.dataPessoaJuridica.mainActivity = $scope.dataPessoaJuridica.Activities[i].Activity;
							} else{
								$scope.dataPessoaJuridica.secondActivity = $scope.dataPessoaJuridica.Activities[i].Activity;
							}
						}
					} else {
						console.log('CNPJ não existente');
					}
				});

			}

			$scope.consultaCNPJUser = function(){
				var cnpj = $scope.cnpj;
				if(cnpj.length == 18){
					console.log(cnpj);
					var consulta 		= "<?=route('register.consultaCnpj')?>";
					$http.post(consulta, {
						'cnpj': cnpj
					}).success(function(data) {
						if (data.Result[0].BasicData.TaxIdNumber) {
						console.log(data);
						$scope.dataPessoaJuridica = data.Result[0].BasicData;
						$scope.dataPessoaJuridica.ClosedDate = $scope.dataPessoaJuridica.ClosedDate ? moment($scope.dataPessoaJuridica.ClosedDate).add(1, 'day').format('DD/MM/YYYY') : ''
						$scope.dataPessoaJuridica.FoundedDate = $scope.dataPessoaJuridica.FoundedDate ? moment($scope.dataPessoaJuridica.FoundedDate).add(1, 'day').format('DD/MM/YYYY') : ''
						$scope.dataPessoaJuridica.CreationDate = $scope.dataPessoaJuridica.CreationDate ? moment($scope.dataPessoaJuridica.CreationDate).add(1, 'day').format('DD/MM/YYYY') : ''
						$scope.dataPessoaJuridica.LastUpdateDate = $scope.dataPessoaJuridica.LastUpdateDate ? moment($scope.dataPessoaJuridica.LastUpdateDate).add(1, 'day').format('DD/MM/YYYY') : ''
						for(var i=0; i < $scope.dataPessoaJuridica.Activities.length; i++){
							if($scope.dataPessoaJuridica.Activities[i].IsMain){
								$scope.dataPessoaJuridica.mainActivity = $scope.dataPessoaJuridica.Activities[i].Activity;
							} else{
								$scope.dataPessoaJuridica.secondActivity = $scope.dataPessoaJuridica.Activities[i].Activity;
							}
						}
						} else {
							console.log('CNPJ não existente');
						}
					});
				}
			}

			$scope.consultaCPFConjuge = function(){
				var cpf = $scope.dataPessoaFisica.conjuge_cpf;
				if(cpf.length == 14){
					console.log(cpf);
					var consulta 		= "<?=route('register.consultaCpf')?>";
					$http.post(consulta, {
						'cpf': cpf
					}).success(function(data) {
						if (data.Result[0].BasicData.Age) {
							console.log(data);
							$scope.dataPessoaFisica.conjuge_rg = data.Result[0].BasicData.AlternativeIdNumbers.RGSP;
							$scope.dataPessoaFisica.conjuge_nome = data.Result[0].BasicData.Name;
							$scope.dataPessoaFisica.conjuge_nationality = data.Result[0].BasicData.BirthCountry;
						} else {
							console.log('CPF não encontrado');
						}
					});
				}
			}

			$scope.consultaCPFSocio = function(index){
				var cpf = $scope.socios[index].cpf;
				if(cpf.length == 14){
					console.log(cpf);
					var consulta 		= "<?=route('register.consultaCpf')?>";
					$http.post(consulta, {
						'cpf': cpf
					}).success(function(data) {
						if (data.Result[0].BasicData.Age) {
							console.log(data);
							$scope.socios[index].rg = data.Result[0].BasicData.AlternativeIdNumbers.RGSP;
							$scope.socios[index].nome = data.Result[0].BasicData.Name;
							$scope.socios[index].nationality = data.Result[0].BasicData.BirthCountry;
							$scope.socios[index].birthDate = data.Result[0].BasicData.BirthDate ? moment(data.Result[0].BasicData.BirthDate).add(1, 'day').format('DD/MM/YYYY') : '';
							if(data.Result[0].BasicData.Gender == 'M'){
								$scope.socios[index].gender = "masculino";
							} else{
								$scope.socios[index].gender = "feminino";
							}
							$scope.pegarEnderecoSocio(index);
						} else {
							console.log('CPF não encontrado');
						}
					});
				}
			}

			$scope.consultaCPFUser = function(){
				var cpf = $scope.cpf;
				if(cpf.length == 14){
					console.log(cpf);
					var consulta 		= "<?=route('register.consultaCpf')?>";
					$http.post(consulta, {
						'cpf': cpf
					}).success(function(data) {
						if (data.Result[0].BasicData.Age) {
							console.log(data);
							$scope.dataPessoaFisica.Name = data.Result[0].BasicData.Name;
							$scope.dataPessoaFisica.BirthCountry = data.Result[0].BasicData.BirthCountry;
							$scope.dataPessoaFisica.BirthDate = data.Result[0].BasicData.BirthDate ? moment(data.Result[0].BasicData.BirthDate).add(1, 'day').format('DD/MM/YYYY') : '';
							if(data.Result[0].BasicData.Gender == 'M'){
								$scope.dataPessoaFisica.Gender = "masculino";
							} else{
								$scope.dataPessoaFisica.Gender = "feminino";
							}
							$scope.pegarEnderecoFisica();
						} else {
							console.log('CPF não encontrado');
						}
					});
				}
			}

			$scope.consultaCPFConjugeSocio = function(index){
				var cpf = $scope.socios[index].conjuge_cpf;
				if(cpf.length == 14){
					console.log(cpf);
					var consulta 		= "<?=route('register.consultaCpf')?>";
					$http.post(consulta, {
						'cpf': cpf
					}).success(function(data) {
						if (data.Result[0].BasicData.Age) {
							console.log(data);
							$scope.socios[index].conjuge_rg = data.Result[0].BasicData.AlternativeIdNumbers.RGSP;
							$scope.socios[index].conjuge_nome = data.Result[0].BasicData.Name;
							$scope.socios[index].conjuge_nationality = data.Result[0].BasicData.BirthCountry;
						} else {
							console.log('CPF não encontrado');
						}
					});
				}
			}

			$scope.cepCliente = function() {
				$http.get('https://viacep.com.br/ws/'+ $scope.dataPessoaFisica.Address.ZipCode + '/json/').success(function(data){
					$scope.dataPessoaFisica.Address.AddressMain = data.logradouro;
					$scope.dataPessoaFisica.Address.Complement = data.complemento;
					$scope.dataPessoaFisica.Address.Neighborhood = data.bairro;
					$scope.dataPessoaFisica.Address.City = data.localidade;
					$scope.dataPessoaFisica.Address.State = data.uf;
					$scope.dataPessoaFisica.Address.Country = 'Brazil';
				});
			}

			$scope.cepEmpresa = function() {
				$http.get('https://viacep.com.br/ws/'+ $scope.dataPessoaJuridica.Address.ZipCode + '/json/').success(function(data){
					$scope.dataPessoaJuridica.Address.AddressMain = data.logradouro;
					$scope.dataPessoaJuridica.Address.Complement = data.complemento;
					$scope.dataPessoaJuridica.Address.Neighborhood = data.bairro;
					$scope.dataPessoaJuridica.Address.City = data.localidade;
					$scope.dataPessoaJuridica.Address.State = data.uf;
					$scope.dataPessoaJuridica.Address.Country = 'BRASIL';
				});
			}

			$scope.cepSocio = function(index) {
				$http.get('https://viacep.com.br/ws/'+ $scope.socios[index].Address.ZipCode + '/json/').success(function(data){
					$scope.socios[index].Address.AddressMain = data.logradouro;
					$scope.socios[index].Address.Complement = data.complemento;
					$scope.socios[index].Address.Neighborhood = data.bairro;
					$scope.socios[index].Address.City = data.localidade;
					$scope.socios[index].Address.State = data.uf;
					$scope.socios[index].Address.Country = 'Brazil';
				});
			}

			$scope.mudaStep = function(v) {
				$scope.step = v;
			}
			
			//Passo a Passo
			$scope.avancaStep = function() {
				if ($scope.step == 1) {
					//validação do email
					if(!this.myForm.$error.pattern){
						// verificacao de preenchimento dos campos
						if(this.myForm.$valid){
							if($(".fileprocuracao")[0].files.length == 0 && $scope.dataPessoaFisica.tipo == 'procurador' || $(".filecliente")[0].files.length == 0){
								if($(".fileprocuracao")[0].files.length == 0 && $scope.dataPessoaFisica.tipo == 'procurador'){
									alert('Insira arquivo de procuração.');
									return false
								}else if($(".filecliente")[0].files.length == 0){
									alert('Insira arquivo de documentação (CNH/RG/CPF).');
									return false;
								}else{
									alert('Preencha documentos obrigatórios.');
									return false;
								}
							}else{
							//Dados de Socio/Proc - Sócios - Conjuges - Endereços
							var register = "<?=route('register.novo.cliente')?>";
							
								$http.post(register, {
									'fisica': $scope.dataPessoaFisica,
									'juridica': $scope.dataPessoaJuridica,
									'cpf': $scope.cpf,
									'cnpj': $scope.cnpj,
									'idcliente': $scope.idcliente
								}).success(function(data) {
									var docCliente		= $scope.docCliente;
									var uploadUrl = "<?=route('register.upload.arquivo','tipo=documentoBase&id='.$cliente->id)?>";
									const documentos = $(".filecliente")[0].files;
									fileUpload.uploadMultipleFileToUrl(documentos, uploadUrl);

									var procCliente 	= $scope.procCliente;
									var uploadUrl = "<?=route('register.upload.arquivo','tipo=procuracao&id='.$cliente->id)?>";
									const procuracao = $(".fileprocuracao")[0].files;
									fileUpload.uploadMultipleFileToUrl(procuracao, uploadUrl);
										$scope.socios.map((v) => {
											var registerSocios 		= "<?=route('register.socios')?>";
											$http.post(registerSocios, {
											'socios': v,
											'idcliente': $scope.idcliente
										}).success(function(data) {
												if(v.documento != undefined){
													var uploadUrl = "<?=route('register.upload.arquivo','tipo=documento_socio&idSocio=')?>"+data;
													fileUpload.uploadFileToUrl(v.documento, uploadUrl);
												}
												console.log(data);
											})
										})
										$http.get(sociosGet)
										.success(function(data) {
											$scope.socios = data;
										})
									})
								console.log("Fim do Step 1");
								}
						} else {
							alert('Preencha todos os campos obrigatórios.');
							return false;
						}
					} else {
						alert("Verifique a validade dos e-mails inseridos.");
						return false;
					}
				}

				if ($scope.step == 2) {
					if(this.myForm2.$valid){
						//Dados Juridicos
						if ($scope.contratoSocial.length != 0 && $scope.faturamento.length != 0){
							var register = "<?=route('register.novo.empresa')?>";
							$http.post(register, {
								'juridica': $scope.dataPessoaJuridica,
								'cnpj': $scope.cnpj,
								'idcliente': $scope.idcliente
							}).success(function(data) {
						
								if ($scope.contratoSocial != undefined || $scope.faturamento != undefined || $scope.alteracoesContratuais != undefined) {
									var uploadUrl = "<?=route('register.upload.arquivo','tipo=contrato_social&id='.$cliente->id)?>";
									const contrato = $(".filecontratoSocial")[0].files;
									fileUpload.uploadMultipleFileToUrl(contrato, uploadUrl);

									var uploadUrl = "<?=route('register.upload.arquivo','tipo=faturamento&id='.$cliente->id)?>";
									const faturamento = $(".filefaturamento")[0].files;
									fileUpload.uploadMultipleFileToUrl(faturamento, uploadUrl);

									var uploadUrl = "<?=route('register.upload.arquivo','tipo=alteracao_contrato&id='.$cliente->id)?>";
									const alteracoes = $(".filealteracoesContratuais")[0].files;
									fileUpload.uploadMultipleFileToUrl(alteracoes, uploadUrl);
								}
								
								console.log('Atualizado com sucesso');
							})
							
							console.log('Fim do Step 2');
						}else{
							if($scope.contratoSocial.length == 0){
								alert('Insira arquivo de contrato social.');
								return false
							}else if($scope.faturamento.length == 0){
								alert('Insira arquivo de faturamento.');
								return false;
							}else{
								alert('Preencha documentos obrigatórios.');
								return false;
							}
							
						}
					} else {
						alert('Preencha todos os campos obrigatórios.');
						return false;
					}
				}

				if ($scope.step == 3) {
					if(this.myForm3.$valid){
						var updateConta = "<?=route('cliente.update.contas')?>";
						console.log($scope.idcliente);
						$http.post(updateConta, {
							'contas': $scope.contas,
							'idcliente': $scope.idcliente
						}).success(function(data) {
							console.log("Fim do Step 3");
						});
						$scope.showModal = 1;
					}else{
						alert('Preencha todos os campos obrigatórios.');
						return false;
					}
				}

				if ($scope.step < 3) {
					$scope.step++;
				}
			}

			$scope.pegarEnderecoFisica = function() {
				var endereco = "<?=route('teste.endereco')?>";
				$http.post(endereco, { 'doc': $scope.cpf, 'idcliente': $scope.idcliente }).success(function(data) {
					//console.log(data);
					$scope.dataPessoaFisica.Address = data.Result[0].Addresses[0];
					console.log($scope.dataPessoaFisica);
				});
			}

			$scope.pegarEnderecoJuridica = function() {
				var endereco = "<?=route('api.endereco.juridica.fields')?>";
				$http.post(endereco, { 'doc': $scope.cnpj, 'idcliente': $scope.idcliente }).success(function(data) {
					$scope.dataPessoaJuridica.Address = data.Result[0].ExtendedAddresses.Addresses[0];
					console.log($scope.dataPessoaJuridica.Address);
					
				});
			}

			$scope.pegarEnderecoSocio = function(index) {
				var endereco = "<?=route('teste.endereco')?>";
				$http.post(endereco, { 'doc': $scope.socios[index].cpf}).success(function(data) {
					console.log(data);
					$scope.socios[index].Address = data.Result[0].Addresses[0];
				});
			}

			$scope.appendClonedSocio = function() {
				$scope.socios.push({
					id: '',
					cpf: '',
					rg: '',
					orgaoEmissor:'',
					nome: '',
					nationality: '',
					passport: '',
					documentoSocio: '',
					birthDate: '',
					gender: '',
					email: '',
					estadoCivil: ''
				});
			}

			$scope.removeCloneSocio = function(index) {
				if ($scope.socios[index].id != '') {
					var remove = "<?=route('socios.remove')?>";
					$http.post(remove, { 'id': $scope.socios[index].id})
						.success(function(data) {

						})
				}
				$scope.socios.splice(index, 1)
			}

			$scope.appendClonedConta = function() {
				$scope.contas.push({
					id: '',
					agencia: '',
					conta: '',
					digito: '',
					banco: ''
				});
			}

			$scope.removeCloneConta = function(index) {
				if ($scope.contas[index].id != '') {
					var remove = "<?=route('contas.remove')?>";
					$http.post(remove, { 'id': $scope.contas[index].id})
						.success(function(data) {

						})
				}
				$scope.contas.splice(index, 1)
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
		$('.date').mask('00/00/0000');
		$('.cep').mask('00000-000');
	</script>
@endsection

