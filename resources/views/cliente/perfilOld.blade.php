@extends('layouts.cliente.topo')
@section('content')
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>

	<div class="container-fluid fluid-person pb60 padding_top_default" ng-app="myApp" ng-controller="myCtrl">
		@php
			/*if($retorno == 1){
				echo '
				<div class="alert alert-success alerta_sucesso fade in alert-dismissible" style="margin-top: 0px;">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
				    <strong>Sucesso!</strong> Operação realizada.
				</div>
				';
			}
			if($retorno == 2){
				echo '
				<div class="alert alert-danger alerta_erro fade in alert-dismissible" style="margin-top: 0px;">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
				    <strong>Ops!</strong> Ocorreu algum erro.
				</div>
				';
			}

			$imgPerfil = $usuario['imagem'];

			if (file_exists('images/usuarios/'.$usuario['imagem']) == false){
				$imgPerfil = '';
			}*/
		@endphp
			<div class="mt40">
			<div class="row mt60">
					<div class="col-md-6 text-left">
						<h3 class="title_page">DADOS DA EMPRESA</h3>
					</div>
					<!--<div class="col-md-6 text-right">
						<button ng-click="salvarSocios()" class="botao_salvar ml35" name="botao_salvar">
							<i class="fa fa-save"></i> SALVAR DADOS
						</button>
					</div>-->
				</div>

				<!-- SÓCIOS -->
				<div id="div_contas mt20">
					<div class="dflex" id="div_conta" >
						<div class="flex1">
							<label class="texto_formulario">RAZÃO SOCIAL</label>
							<input type="text" class="form-control input_default" value="{{$empresa->OfficialName}}" placeholder="--------" ng-readonly="c.id != ''"/>
						</div>
						<div class="flex1">
							<label class="texto_formulario">NOME FANTASIA</label>
							<input type="text" class="form-control input_default" value="{{$empresa->TradeName}}" placeholder="--------" ng-readonly="c.id != ''"/>
						</div>
						<div class="flex1">
							<label class="texto_formulario">FUNDAÇÃO</label>
							<input type="text" class="form-control input_default" value="{{$empresa->CreationDate}}" placeholder="--------" ng-readonly="c.id != ''"/>
						</div>
						<div class="flex1">
							<label class="texto_formulario">ENCERRAMENTO</label>
							<input type="text" class="form-control input_default" value="{{$empresa->ClosedDate}}" placeholder="--------" ng-readonly="c.id != ''"/>
						</div>
						<div class="flex1">
							<label class="texto_formulario">EMPRESA SEDE</label>
							<!--<select class="form-control input_default" style="border-color: #ccc;" value="{{$empresa->IsHeadquarter}}">
							<option value="0">Não</option>
							<option value="1" >Sim</option>
						</select>-->
						<input type="text" class="form-control input_default" value="{{$empresa->IsHeadquarter}}" placeholder="--------" ng-readonly="c.id != ''"/>
						</div>
						<div class="flex1">
							<label class="texto_formulario">UF DA SEDE</label>
							<input type="text" class="form-control input_default" value="{{$empresa->HeadquarterState}}" placeholder="--------" ng-readonly="c.id != ''"/>
						</div>
					</div>
				</div>
				<div id="div_contas mt20">
					<div class="dflex" id="div_conta" >
						<div class="flex1">
							<label class="texto_formulario">STATUS DO DOCUMENTO RELACIONADO</label>
							<input type="text" class="form-control input_default" value="{{$empresa->TaxIdStatus}}" placeholder="--------" ng-readonly="c.id != ''"/>
						</div>
						<div class="flex1">
							<label class="texto_formulario">ORIGEM DO DOCUMENTO RELACIONADO</label>
							<input type="text" class="form-control input_default" value="{{$empresa->TaxIdOrigin}}" placeholder="--------" ng-readonly="c.id != ''"/>
						</div>
						<div class="flex1">
							<label class="texto_formulario">REGIME TRIBUTÁRIO</label>
							<input type="text" class="form-control input_default" value="{{$empresa->TaxRegime}}" placeholder="--------" ng-readonly="c.id != ''"/>
						</div>
					</div>
				</div>
				<div id="div_contas mt20">
					<div class="dflex" id="div_conta" >
						<div class="flex1">
							<label class="texto_formulario">ATIVIDADE DA EMPRESA</label>
							<input type="text" class="form-control input_default" value="{{$empresa->Activities}}" placeholder="--------" ng-readonly="c.id != ''"/>
						</div>
						<div class="flex1">
						<label class="texto_formulario">É A ATIVIDADE PRINCIPAL?</label>
						<!--select class="form-control input_default" style="border-color: #ccc;" value="{{$empresa->ActivitiesIsMain}}">
							<option value="0">Não</option>
							<option value="1" >Sim</option>
						</select>-->
						<input type="text" class="form-control input_default" value="{{$empresa->ActivitiesIsMain}}" placeholder="--------" ng-readonly="c.id != ''"/>
					</div>
						<div class="flex1">
							<label class="texto_formulario">CÓDIGO</label>
							<input type="text" class="form-control input_default" value="{{$empresa->LegalNatureCode}}" placeholder="--------" ng-readonly="c.id != ''"/>
						</div>
					</div>
				</div>
				<div id="div_contas mt20">* Para editar os dados da empresa, entre em contato conosco.</div>


				<!-- Linha -->
				<div class="row mt10">
					<div class="col-md-12 mt40">
						<hr>
					</div>
				</div>

				<form action="{{route('cliente.perfil.update')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
					@csrf
					<div class="row mt20">
						<div class="col-md-9 text-left">
							<h3 class="title_page">
								DADOS DO SÓCIO OU DO PROCURADOR
							</h3>
						</div>
						<div class="col-md-3 text-right">
							<button type="submit" class="botao_salvar ml35" name="botao_salvar">
								<i class="fa fa-save"></i> SALVAR PERFIL
							</button>
						</div>
					</div>
					<div class="row mt20">
						<div class="col-md-6">
							<img src="{{isset(Auth::user()->imagem) ? asset('images/usuarios/'.Auth::user()->imagem) : asset('images/padrao.png')}}" class="img_perfil_box" id="preview">
							<div class="div_perfil">
								<div>
									<label for="choose-file" class="botao_salvar_menor">
										<i>ALTERAR FOTO</i>
									</label>
									<input id="choose-file" name="imagem" style="display: none;" type="file" class="form-control" onchange="openFile(event)">
								</div>
								<label><i>TAMANHO IDEAL: 200px X 200px<br>FORMATOS: JPG ou PNG</i></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<label class="texto_formulario">NOME COMPLETO</label>
							<input type="text" class="form-control input_default" name="nome" value="{{Auth::user()->name}}" required>
						</div>
						<div class="col-md-6">
							<label class="texto_formulario">SENHA</label>
							<input type="password" class="form-control input_default" autocomplete="new-password" name="password" id="senha">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<label class="texto_formulario">E-MAIL</label>
							<input type="email" class="form-control input_default" name="email" value="{{Auth::user()->email}}" required readonly />
						</div>
						<div class="col-md-6">
							<label class="texto_formulario">CONFIRMAR SENHA</label>
							<input type="password" class="form-control input_default" autocomplete="new-password" name="confirma_senha" id="confirma_senha">
						</div>
					</div>
				</form>

				<!-- Linha -->
				<div class="row mt10">
					<div class="col-md-12 mt40">
						<hr>
					</div>
				</div>

				<form method="POST" action="{{route('cliente.documento.update')}}" enctype="multipart/form-data">
					@csrf
					<div class="row mt60">
						<div class="col-md-6 text-left">
							<h3 class="title_page">
								ARQUIVOS 
							</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<label class="texto_formulario">DOCUMENTOS</label>
						</div>
						<div class="col-md-4">
							<input type="file" class="form-control input_default" name="file">
						</div>
						<div class="col-md-3">
							<select class="form-control input_default" name="tipo_file">
								<option value="contrato_social">Contrato Social</option>
								<option value="faturamento">Faturamento</option>
							</select>
						</div>
						<div class="col-md-3">
							<button type="submit" name="atualizar_arquivo" class="botao_salvar" style="padding: 4px 20px !important;">Enviar Arquivo</button>
						</div>
					</div>
					<div style="display: flex; margin-top: 10px; flex-wrap: wrap;">
						@foreach($documentos as $d)
							<div class="text-center" style="padding: 15px; width: 160px;">
								<a href="{{asset('uploads/contratos/'.$d['source'])}}" target="_blank" download>
									<div><i class="fa fa-download" style="font-size: 33px;"></i></div>
									<div>{{$d->file_type}}</div>
									<div style="font-size: 12px;">{{$d->created_at}}</div>
								</a>
							</div>
						@endforeach
					</div>
				</form>
			
				<!-- Linha -->
				<div class="row mt10">
					<div class="col-md-12 mt40">
						<hr>
					</div>
				</div>

				<div class="row mt60">
					<div class="col-md-6 text-left">
						<h3 class="title_page">Contas Bancárias</h3>
					</div>
					<div class="col-md-6 text-right">
						<button ng-click="salvarContas()" class="botao_salvar ml35" name="botao_salvar">
							<i class="fa fa-save"></i> SALVAR CONTAS
						</button>
					</div>
				</div>

				<!-- CONTA BANCARIA -->
				<div id="div_contas mt20">
					<div class="dflex" id="div_conta" ng-repeat="c in contas">
						<div class="flex1">
							<label class="texto_formulario">AGÊNCIA</label>
							<input type="text" class="form-control input_default" ng-model="c.agencia" placeholder="XXXX" ng-readonly="c.id != ''"/>
						</div>
						<div class="flex1">
							<label class="texto_formulario">CONTA</label>
							<input type="text" class="form-control input_default" ng-model="c.conta" placeholder="XXXXXX-X" ng-readonly="c.id != ''"/>
						</div>
						<div class="flex1">
							<label class="texto_formulario">DIGITO</label>
							<input type="text" class="form-control input_default" ng-model="c.digito" placeholder="X" ng-readonly="c.id != ''"/>
						</div>
						<div class="flex1">
							<label class="texto_formulario">BANCO</label>
							<select class="form-control input_default" ng-model="c.banco" style="border-color: #ccc;" ng-readonly="c.id != ''">
								<option value="001" ng-selected="c.banco == '001'">001 - Banco do Brasil</option>
								<option value="002" ng-selected="c.banco == '002'">002 - Banco Central do Brasil</option>
								<option value="003" ng-selected="c.banco == '003'">003 - Banco da Amazônia</option>
								<option value="004" ng-selected="c.banco == '004'">004 - Banco do Nordeste do Brasil</option>
								<option value="007" ng-selected="c.banco == '007'">007 - Banco Nacional de Desenvolvimento Econômico e Social</option>
								<option value="104" ng-selected="c.banco == '104'">104 - Caixa Econômica Federal</option>
								<option value="046" ng-selected="c.banco == '046'">046 - Banco Regional de Desenvolvimento do Extremo Sul</option>
								<option value="000" ng-selected="c.banco == '000'">000 - Badesul</option>
								<option value="000" ng-selected="c.banco == '000'">000 - Banco de Desenvolvimento do Espírito Santo</option>
								<option value="023" ng-selected="c.banco == '023'">023 - Banco de Desenvolvimento de Minas Gerais</option>
								<option value="070" ng-selected="c.banco == '070'">070 - Banco de Brasília</option>
								<option value="047" ng-selected="c.banco == '047'">047 - Banco do Estado de Sergipe</option>
								<option value="021" ng-selected="c.banco == '021'">021 - Banco do Estado do Espírito Santo</option>
								<option value="037" ng-selected="c.banco == '037'">037 - Banco do Estado do Pará</option>
								<option value="041" ng-selected="c.banco == '041'">041 - Banco do Estado do Rio Grande do Sul</option>
								<option value="075" ng-selected="c.banco == '075'">075 - Banco ABN Amro S.A.</option>
								<option value="025" ng-selected="c.banco == '025'">025 - Banco Alfa</option>
								<option value="107" ng-selected="c.banco == '107'">107 - Banco BBM</option>
								<option value="318" ng-selected="c.banco == '318'">318 - Banco BMG</option>
								<option value="218" ng-selected="c.banco == '218'">218 - Banco Bonsucesso</option>
								<option value="208" ng-selected="c.banco == '208'">208 - Banco BTG Pactual</option>
								<option value="263" ng-selected="c.banco == '263'">263 - Banco Cacique</option>
								<option value="473" ng-selected="c.banco == '473'">473 - Banco Caixa Geral - Brasil</option>
								<option value="505" ng-selected="c.banco == '505'">505 - Banco Credit Suisse</option>
								<option value="265" ng-selected="c.banco == '265'">265 - Banco Fator</option>
								<option value="224" ng-selected="c.banco == '224'">224 - Banco Fibra</option>
								<option value="121" ng-selected="c.banco == '121'">121 - Agibank</option>
								<option value="612" ng-selected="c.banco == '612'">612 - Banco Guanabara</option>
								<option value="604" ng-selected="c.banco == '604'">604 - Banco Industrial do Brasil</option>
								<option value="653" ng-selected="c.banco == '653'">653 - Banco Indusval</option>
								<option value="077" ng-selected="c.banco == '077'">077 - Banco Inter</option>
								<option value="389" ng-selected="c.banco == '389'">389 - Banco Mercantil do Brasil</option>
								<option value="389" ng-selected="c.banco == '389'">389 - Banco Luso Brasileiro</option>
								<option value="746" ng-selected="c.banco == '746'">746 - Banco Modal</option>
								<option value="738" ng-selected="c.banco == '738'">738 - Banco Morada</option>
								<option value="623" ng-selected="c.banco == '623'">623 - Banco Pan</option>
								<option value="611" ng-selected="c.banco == '611'">611 - Banco Paulista</option>
								<option value="643" ng-selected="c.banco == '643'">643 - Banco Pine</option>
								<option value="654" ng-selected="c.banco == '654'">654 - Banco Renner</option>
								<option value="741" ng-selected="c.banco == '741'">741 - Banco Ribeirão Preto</option>
								<option value="422" ng-selected="c.banco == '422'">422 - Banco Safra</option>
								<option value="033" ng-selected="c.banco == '033'">033 - Banco Santander</option>
								<option value="637" ng-selected="c.banco == '637'">637 - Banco Sofisa</option>
								<option value="082" ng-selected="c.banco == '082'">082 - Banco Topázio</option>
								<option value="655" ng-selected="c.banco == '655'">655 - Banco Votorantim</option>
								<option value="237" ng-selected="c.banco == '237'">237 - Bradesco</option>
								<option value="341" ng-selected="c.banco == '341'">341 - Itaú Unibanco</option>
								<option value="212" ng-selected="c.banco == '212'">212 - Banco Original</option>
								<option value="260" ng-selected="c.banco == '260'">260 - Nu Pagamentos S.A</option>
								<option value="336" ng-selected="c.banco == '336'">336 - Banco C6 S.A.</option>
								<option value="756" ng-selected="c.banco == '756'">756 - Banco Cooperativo do Brasil - BANCOOB</option>
								<option value="748" ng-selected="c.banco == '748'">748 - Banco Cooperativo Sicredi - BANSICREDI</option>
								<option value="136" ng-selected="c.banco == '136'">136 - Unicred</option>
							</select>
						</div>
						<div class="flex1">
							<label class="texto_formulario">&nbsp;</label>
							<div>
								<input type="hidden" class="form-control input_default" ng-model="c.id" />
								<button class="btn-trash" ng-click="removeCloneConta($index)"><i class="fa fa-trash"></i></button>
							</div>
						</div>
					</div>
				</div>

				<!-- NOVA CONTA BANCARIA -->
				<div class="dflex">
					<div class="flex1">
						<label class="texto_formulario">&nbsp;</label>
						<div>
							<button class="btn-blue" ng-click="appendClonedConta()">ADICIONAR OUTRA CONTA</button>
						</div>
					</div>
				</div>

				<!-- Linha -->
				<div class="row mt10">
					<div class="col-md-12 mt40">
						<hr>
					</div>
				</div>

				<div class="row mt60">
					<div class="col-md-6 text-left">
						<h3 class="title_page">SÓCIOS</h3>
					</div>
					<div class="col-md-6 text-right">
						<button ng-click="salvarSocios()" class="botao_salvar ml35" name="botao_salvar">
							<i class="fa fa-save"></i> SALVAR SÓCIOS
						</button>
					</div>
				</div>

				<!-- SÓCIOS -->
				<div id="div_contas mt20">
					<div class="dflex" id="div_conta" ng-repeat="s in socios">
						<div class="flex1">
							<label class="texto_formulario">NOME DO SÓCIO</label>
							<input type="text" class="form-control input_default" ng-model="s.nome" placeholder="XXXX" ng-readonly="s.id != ''"/>
						</div>
						<div class="flex1">
							<label class="texto_formulario">CPF</label>
							<input type="text" class="form-control input_default" ng-model="s.cpf" placeholder="XXXXXX-X" ng-readonly="s.id != ''"/>
						</div>
						<div class="flex1">
							<label class="texto_formulario">DOCUMENTO</label>
							<input type="file" class="form-control input_default" ng-model="s.documento" placeholder="XXXXXX-X" ng-readonly="s.id != ''"/>
						</div>
						<div class="flex1">
							<label class="texto_formulario">CÔNJUGE</label>
							<input type="text" class="form-control input_default" ng-model="s.conjuge[0].nome" placeholder="XXXX" ng-readonly="s.id != ''"/>
						</div>
						<div class="flex1">
							<label class="texto_formulario">CPF CÔNJUGE</label>
							<input type="text" class="form-control input_default" ng-model="s.conjuge[0].cpf" placeholder="XXXXXX-X" ng-readonly="s.id != ''"/>
						</div>
						<div class="flex1">
							<label class="texto_formulario">E-MAIL CÔNJUGE</label>
							<input type="text" class="form-control input_default" ng-model="s.conjuge[0].email" placeholder="XXXXXX-X" ng-readonly="s.id != ''"/>
						</div>
						<div class="flex1">
							<label class="texto_formulario">&nbsp;</label>
							<div>
								<input type="hidden" class="form-control input_default" ng-model="s.id" />
								<button class="btn-trash" ng-click="removeCloneSocio($index)"><i class="fa fa-trash"></i></button>
							</div>
						</div>

					</div>
					<!-- NOVO SÓCIO -->
					<div class="dflex">
						<div class="flex1">
							<label class="texto_formulario">&nbsp;</label>
							<div>
								<button class="btn-blue" ng-click="appendClonedSocio()">ADICIONAR SÓCIO</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		function validaSenhas(){
			if($('#senha').val() == '' && $('#confirma_senha').val() == ''){
				return true;
			}else if($('#senha').val() == $('#confirma_senha').val()){
				return true;
			}else{
				return false;
			}
		}
	</script>
	<script>
		var app = angular.module('myApp',[]);

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

		app.controller('myCtrl', ['$scope', '$http', 'fileUpload', function($scope, $http, fileUpload){
			$scope.contas 				= [];
			$scope.socios 				= [];

			// request inicial
			$http.get("<?=route('cliente.contas')?>")
			.success(function(data){
				$scope.contas = data;
			})
			
			$scope.appendClonedConta = function() {
				$scope.contas.push({id: '', agencia: '', conta: '', digito: '', banco: ''});
			}

			$scope.removeCloneConta = function(index){
				$scope.contas.splice(index, 1);
			}

			$http.get("<?=route('cliente.socios')?>")
			.success(function(data){
				$scope.socios = data;
				data.map(function(v) {
					console.log(v.conjuge[0].nome);
				})
				//console.log('Data', data);
			})
			
			$scope.appendClonedSocio = function() {
				$scope.socios.push({id: '', nome: '', cpf: '', documento: ''});
			}

			$scope.removeCloneSocio = function(index){
				$scope.socios.splice(index, 1);
			}

			$scope.salvarContas = function(){
				$http.post("<?=route('cliente.update.contas')?>",{
                    'contas': $scope.contas
                }).success(function(data){
					console.log('Teste');
					window.location.href = "<?=route('cliente.perfil')?>";
				});   
			}

			$scope.salvarSocios = function(){
				var registerSocios 		= "<?=route('socios.novo')?>";
				$http.post(registerSocios, {
					'socios': $scope.socios
				}).success(function(data) {
					console.log('chegou');
					var uploadUrl5 = "<?= route('register.socios.upload','idcliente='.Auth::user()->id_cliente.'&idsocio=')?>"+ data;
					fileUpload.uploadFileToUrl($scope.socios.imagem, uploadUrl5);
					window.location.href = "<?=route('cliente.perfil')?>";
				})
				
			}
		}]);
	</script>
@endsection