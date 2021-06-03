@extends('layouts.cliente.topo')
@section('content')

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
   <div ng-controller="myCtrl" ng-app="myApp" ng-cloak class="container-fluid">
        <div class="flex_pai_perfil_cliente_salvar">
            <div ng-click="salvarTudo()" class="botao_salvar">
                <i class="fa fa-floppy-o" aria-hidden="true"></i>
               <span class="ml10">SALVAR</span> 
            </div>
        </div>
        <div class="div_pai_analisar_fichas mt50">
            <div class="flexauto">
                <div ng-click="step=1" ng-class="step == 1?'background_azul':'background_cinza'"> 
                    <span ng-class="step == 1?'fonte_branca':'fonte_cinza'"> 
                        MEUS DADOS
                    </span>
                </div>
            </div>
            <div class="ph5"></div>
            <div class="flexauto">
                <div ng-click="step=2" ng-class="step == 2?'background_azul':'background_cinza'">
                    <span ng-class="step == 2?'fonte_branca':'fonte_cinza'">
                        DADOS DA EMPRESA
                    </span>
                </div>
            </div>
            <div class="ph5"></div>
            <div class="flexauto">
                <div ng-click="step=3" ng-class="step == 3?'background_azul':'background_cinza'">
                    <span ng-class="step == 3?'fonte_branca':'fonte_cinza'">
                        SÓCIOS E CÔNJUGES
                    </span>
                </div>
            </div>
            <div class="ph5"></div>
            <div class="flexauto">
                <div ng-click="step=4" ng-class="step == 4?'background_azul':'background_cinza'"> 
                    <span ng-class="step == 4?'fonte_branca':'fonte_cinza'"> 
                        CONTAS BANCÁRIAS
                    </span>
                </div>
            </div>
        </div>
        <div class="div_linha_azul_analisar">
		</div> 
		@if($user->redeSocial==1)
			<div ng-show="step==1">@include('partials.perfil_cliente_meus_dados')</div>
			<div ng-show="modalDesvincular==1">@include('partials.modals.redes_sociais')</div>
			<div ng-show="modalDesvincular==2">@include('partials.modals.adicionar_email')</div>
			<div ng-show="modalDesvincular==3">@include('partials.modals.adicionar_senha')</div>
		@else
			<div ng-show="step==1">@include('partials.perfil_cliente_mudar_senha')</div>
		@endif
		<div ng-show="step==2">@include('partials.perfil_cliente_dados_empresa')</div>
		<div ng-show="step==3">@include('partials.perfil_cliente_socios_conjuges')</div>
		<div ng-show="step==4">@include('partials.perfil_cliente_contas_bancarias')</div>


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
			$scope.step = 1;
			$scope.modalDesvincular= 0;
			$scope.idSocial = '';
			$scope.empresa = {};
			$scope.mainSocio = {};
			$scope.contas = [];
			$scope.socios = [];
			$scope.user= {};

			var userGet = "<?=route('cliente.user')?>";
			$http.get(userGet)
			.success(function(data) {
				$scope.user = data;
			})

			var empresaGet = "<?=route('cliente.empresa')?>";
			$http.get(empresaGet)
			.success(function(data) {
				$scope.empresa = data;
			})

			var mainSocioGet = "<?=route('cliente.mainSocio')?>";
			$http.get(mainSocioGet)
			.success(function(data) {
				$scope.mainSocio = data;
			})

			var contasGet = "<?=route('cliente.contas')?>";
			$http.get(contasGet)
			.success(function(data) {
				$scope.contas = data;
			})

			var sociosGet = "<?=route('cliente.socios')?>";
			$http.get(sociosGet)
			.success(function(data) {
				$scope.socios = data;
			})

			$scope.cepEmpresa = function() {
				$http.get('https://viacep.com.br/ws/'+ $scope.empresa.Address.Endereco_CEP + '/json/').success(function(data){
					$scope.empresa.Address.Endereco_Lgr = data.logradouro;
					$scope.empresa.Address.Endereco_Complemento = data.complemento;
					$scope.empresa.Address.Endereco_Bairro = data.bairro;
					$scope.empresa.Address.Endereco_Mun = data.localidade;
					$scope.empresa.Address.Endereco_UF = data.uf;
					$scope.empresa.Address.Endereco_Pais = 'Brasil';
				});
			}

			$scope.cepCliente = function() {
				$http.get('https://viacep.com.br/ws/'+ $scope.mainSocio.Address.Endereco_CEP + '/json/').success(function(data){
					$scope.mainSocio.Address.Endereco_Lgr = data.logradouro;
					$scope.mainSocio.Address.Endereco_Complemento = data.complemento;
					$scope.mainSocio.Address.Endereco_Bairro = data.bairro;
					$scope.mainSocio.Address.Endereco_Mun = data.localidade;
					$scope.mainSocio.Address.Endereco_UF = data.uf;
					$scope.mainSocio.Address.Endereco_Pais = 'Brasil';
				});
			}

			$scope.cepSocio = function(index) {
				$http.get('https://viacep.com.br/ws/'+ $scope.socios[index].Address.Endereco_CEP + '/json/').success(function(data){
					$scope.socios[index].Address.Endereco_Lgr = data.logradouro;
					$scope.socios[index].Address.Endereco_Complemento = data.complemento;
					$scope.socios[index].Address.Endereco_Bairro = data.bairro;
					$scope.socios[index].Address.Endereco_Mun = data.localidade;
					$scope.socios[index].Address.Endereco_UF = data.uf;
					$scope.socios[index].Address.Endereco_Pais = 'Brasil';
				});
			}
			
			$scope.salvarTudo = function() {
				if($scope.step==1){
					var uploadUrl = "<?=route('cliente.perfil.imagem','tipo=imagem')?>";
					const imagem = $(".fileimagem")[0].files;
					fileUpload.uploadMultipleFileToUrl(imagem, uploadUrl);
					alert('Foto de perfil atualizada.');
				}
				
				//Dados Juridicos
				if($scope.step==2){
					var atualizaEmpresa = "<?=route('cliente.atualiza.juridica')?>";
					$http.post(atualizaEmpresa, {
						'juridica': $scope.empresa
					}).success(function(data) {
						if ($scope.contratoSocial != undefined){
							var uploadUrl = "<?=route('register.upload.arquivo','tipo=contrato_social&id='.$cliente->id)?>";
							const contrato = $(".filecontratoSocial")[0].files;
							fileUpload.uploadMultipleFileToUrl(contrato, uploadUrl);
						} 
						if ($scope.faturamento != undefined){
							var uploadUrl = "<?=route('register.upload.arquivo','tipo=faturamento&id='.$cliente->id)?>";
							const faturamento = $(".filefaturamento")[0].files;
							fileUpload.uploadMultipleFileToUrl(faturamento, uploadUrl);
						}
						if ($scope.alteracoesContratuais != undefined) {
							var uploadUrl = "<?=route('register.upload.arquivo','tipo=alteracao_contrato&id='.$cliente->id)?>";
							const alteracoes = $(".filealteracoesContratuais")[0].files;
							fileUpload.uploadMultipleFileToUrl(alteracoes, uploadUrl);
						}
						alert("Dados da empresa atualizados");
						console.log(data);
					})
				}

				if($scope.step==3){
					if(!this.formSocios.$error.pattern){
						$scope.socios.map((v) => {
							var atualizaSocios 		= "<?=route('cliente.atualiza.socios')?>";
							$http.post(atualizaSocios, {
							'socios': v
						}).success(function(data) {
								var uploadUrl = "<?=route('register.upload.arquivo','tipo=documento_socio&idSocio=')?>"+data;
								fileUpload.uploadFileToUrl(v.documento, uploadUrl);

								console.log("Socios Atualizados");
								console.log(data);
							})
						})

						var atualizaCliente = "<?=route('cliente.atualiza.cliente')?>";
						$http.post(atualizaCliente, {
							'mainSocio': $scope.mainSocio
						}).success(function(data) {
							if ($scope.docCliente != undefined){
								var uploadUrl = "<?=route('register.upload.arquivo','tipo=documentoBase&id='.$cliente->id)?>";
								const documentos = $(".filecliente")[0].files;
								fileUpload.uploadMultipleFileToUrl(documentos, uploadUrl);
							} 
							if ($scope.procCliente != undefined) {
								var uploadUrl = "<?=route('register.upload.arquivo','tipo=procuracao&id='.$cliente->id)?>";
								const procuracao = $(".fileprocuracao")[0].files;
								fileUpload.uploadMultipleFileToUrl(procuracao, uploadUrl);
							}
							alert("Dados do cliente e sócios atualizados.");
							console.log(data);
						})
					} else{
						alert("Verifique a validade dos e-mails inseridos.");
						return false;
					}
				}

				if($scope.step==4){
					var atualizaConta 		= "<?=route('cliente.atualiza.contas')?>";
					$http.post(atualizaConta, {
						'contas': $scope.contas
					}).success(function(data) {
						alert("Contas atualizadas.");
						console.log(data);
					});
				}
			}

			$scope.alteraSenha = function(){
				if($scope.novaSenha.length < 8){
					alert("Senha muito curta. Mínimo 8 caracteres.");
					return false;
				}

				if($scope.novaSenha != $scope.confirmarSenha){
					alert("Senhas não coincidem.");
					return false;
				}

				var atualizaUser = "<?=route('cliente.perfil.update')?>";
				$http.post(atualizaUser, {
					'user': $scope.user,
					'novaSenha': $scope.novaSenha,
					'confirmarSenha': $scope.confirmarSenha
				}).success(function(data) {
					alert("Senha atualizada com sucesso.");
					console.log(data);
				})
			}

			$scope.clickDesvincular = function(id){
				$scope.modalDesvincular = 1;
				$scope.idSocial = id;
			}

			$scope.authFacebook = function(){
				this.desvincular();
				window.location.href = "<?=route('auth.facebook')?>";
			}

			$scope.authLinkedin = function(){
				this.desvincular();
				window.location.href = "<?=route('auth.linkedin')?>";
			}

			$scope.authGoogle = function(){
				this.desvincular();
				window.location.href = "<?=route('auth.google')?>";
			}

			$scope.verificaEmail = function(){
				if(!this.formUser.$error.pattern){
					var verifica = "<?=route('cliente.verifica.email')?>";
					$http.post(verifica, {
						'user': $scope.user
					}).success(function(data) {
						if(data == 'novo'){
							alert("Atenção, será necessário verificar seu e-mail e fazer login novamente para validar o novo e-mail.");
							$scope.modalDesvincular = 3;
						} else if(data == 'existe'){
							alert("E-mail já cadastrado no sistema.");
						} else {
							$scope.modalDesvincular = 3;
						}
					})
				} else{
					alert("Verifique a validade do e-mail inserido.");
					return false;
				}
			}

			$scope.finalizaDesvincular = function(){
				if($scope.novaSenha.length < 8){
					alert("Senha muito curta. Mínimo 8 caracteres.");
					return false;
				}

				if($scope.novaSenha != $scope.confirmarSenha){
					alert("Senhas não coincidem.");
					return false;
				}

				var atualizaUser = "<?=route('cliente.perfil.update')?>";
				$http.post(atualizaUser, {
					'user': $scope.user,
					'novaSenha': $scope.novaSenha,
					'confirmarSenha': $scope.confirmarSenha
				}).success(function(data) {
					console.log("Email e senha atualizados");
					console.log(data);

					this.desvincular();
				})
				window.location.reload();
			}

			$scope.desvincular = function(){
				var desvincula 		= "<?=route('remove.social')?>";
				$http.post(desvincula, {
					'id_social': $scope.idSocial
				}).success(function(retorno) {
					console.log("Conta desvinculada.");
					console.log(retorno);
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
				if(index == 0){
					if ($scope.contas[1].id == '') {
						alert("É necessário manter ao menos uma conta cadastrada. Cadastre e salve uma nova conta. Depois será possível excluir essa.");
						return false;
					} else{
						if ($scope.contas[index].id != '') {
							var remove = "<?=route('contas.remove')?>";
							$http.post(remove, { 'id': $scope.contas[index].id})
								.success(function(data) {
								})
						}
					}
				} else {
					if ($scope.contas[index].id != '') {
						var remove = "<?=route('contas.remove')?>";
						$http.post(remove, { 'id': $scope.contas[index].id})
							.success(function(data) {
							})
					}
				}
				$scope.contas.splice(index, 1)
			}

			$scope.validaEmail = function(e) {
				var email = e.target.value;
				alert(email);
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