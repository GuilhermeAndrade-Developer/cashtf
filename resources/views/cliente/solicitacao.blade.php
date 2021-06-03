@extends('layouts.admin.topo')
@section('content')
<style>
 .drawer-navbar{
	 display: none;
 }
 .rodape{
	display: none;
}
.cinzacategorias{
	width: 140px;
	flex: initial;
}
table#tabela_clicavel tr td{
	text-align: center;
}
.botao_aprovado2{
	flex: 1;
	background-color: #BFBFBF;
	margin: 10px;
	padding: 8px;
	color: #fff;
	font-weight: 500;
}
.botao_aprovado2.active{
	background-color: #5CD072;
	color: #fff;
}
.botao_boleto2{
	flex: 1;
	background-color: #BFBFBF;
	margin: 10px;
	padding: 8px;
	color: #fff;
	font-weight: 500;
}
.botao_boleto2.active{
	background-color: #ffce00;
	color: #fff;
}
.botao_recusado2{
	flex: 1;
	background-color: #BFBFBF;
	margin: 10px;
	padding: 8px;
	color: #fff;
	font-weight: 500;
}
.botao_recusado2.active{
	background-color: #f11070;
	color: #fff;
}
</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js">
</script>
<div class="container-fluid" ng-app="myApp" ng-controller="myCtrl" style="margin-bottom: 50px;">
	<div class="row">
		<div class="col-md-12 text-right mt30">
			<a href="{{route('cliente.solicitacoes')}}"><i class="fa fa-times" style="color: #BFBFBF; font-size: 26px;"></i></a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="div_analisa_flex">
				<div class="mt20 fonte_analisar" style="flex: auto;">
					<img src="{{asset('images/search_analisar_solicitacao_icn.png')}}">
					<span>
						SOLICITAÇÃO
					</span>
				</div>
				<div class="mt20 text-center" style="flex: auto; display: flex; flex-direction: row; flex-direction: row; justify-content: center; align-items: center;">
					<a id="aprovado" value="1" class="botao_aprovado2 {{$solicitacao->id_status == 1 ? 'active' : '' }}">
						{{$solicitacao->id_status == 1 ? 'APROVADO' : 'APROVAR' }}	
					</a>
					<a class="botao_boleto2 {{ $solicitacao->id_status == 2 ? 'active' : '' }}">
						PENDENTE		
					</a>
					<a class="botao_recusado2 {{ $solicitacao->id_status == 3 ? 'active' : '' }}">
						{{ $solicitacao->id_status == 3 ? 'RECUSADO' : 'RECUSAR' }}
					</a>
				</div>
			</div>
			<div class="faixarosa mt10">

			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 mt10">
			<span style="margin-top: 15px; font-size: 12px; font-weight: normal;">ARQUIVO ANEXADO</span>
			<div style="border: 1px solid #ccc; padding: 3px; display: flex;">
				<span style="background: #00A7FF; padding: 5px 10px; font-size: 12px; color: #fff">{{$solicitacao->arquivo_xml}}</span>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="div_cliente_flex mt20 text-center" ng-show="abaPessoa == 1">
				<div class="cinzacategorias text-center" ng-class="etapaFisica == 2?'active':''" ng-click="subCategoria(2, 1)">
					<span>DADOS</span>
				</div>
				<div class="cinzacategorias text-center" ng-class="etapaFisica == 1?'active':''" ng-click="subCategoria(1, 1)">
					<span>FATURAS</span>
				</div>
			</div>
			<div class="linhaazul">
			</div>
		</div>
	</div>

	<!-- Tabela de parcelas -->
	<div class="row mt20" ng-show="etapaFisica == 1 && abaPessoa == 1 || etapaJuridica == 1 && abaPessoa == 2">
		<div class="col-md-12">
			<div class="text-center">
				<table data-table-list class="table table-responsive table-striped tabela_padrao" id="tabela_clicavel">
					<thead>
						<tr>
							<th class="text-center">PARCELAS</th>
							<th class="text-center">DATA</th>
							<th class="text-center">VALOR DA PARCELA</th>
							<th class="text-center">VALOR JUROS</th>
							<th class="text-center">VALOR A RECEBER</th>
							<th class="text-center"></th>
						</tr>
					</thead>
					<tbody>
					@foreach($parcelas as $parcela)
							@php
								$v_parcela  = str_replace('.', '', $parcela->valor_parcela);
								$v_parcela  = str_replace(',', '.', $v_parcela);
								$v_juros    = str_replace('.', '', $parcela->valor_juros);
								$v_juros    = str_replace(',', '.', $v_juros); 
							@endphp
							<tr>
								<td class="text-center">{{$parcela->numero}}</td>
								<td class="text-center">{{$parcela->vencimento}}</td>
								<td class="text-center">R$ {{$parcela->valor_parcela}}</td>
								<td class="text-center">R$ {{number_format($v_parcela - $v_juros, 2, ',', '.')}}</td>
								<td class="text-center">R$ {{$v_juros}}</td>
								<td class="text-center"></td>
							</tr>
					@endforeach
					</tbody>
					<thead>
						<tr>
							<th class="text-center funrosatab"></th>
							<th class="text-center funrosatab"></th>
							<th class="text-center funrosatab"></th>
							<th class="text-center funrosatab">JUROS TOTAL</th>
							<th class="text-center funrosatab">TOTAL A RECEBER</th>
							<th class="text-center funrosatab"></th>
						</tr>
					</thead>
					<tbody>
						<tr class="clickable-row" data-href="">
							<td class="text-center funtabsolic"></td>
							<td class="text-center funtabsolic"></td>
							<td class="text-center funtabsolic"></td>
							<td class="text-center funtabsolic">{{$solicitacao->juros}} %</td>
							<td class="text-center funtabsolic">R$ {{$solicitacao->valor_total_juros}}</td>
							<td class="text-center funtabsolic"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Sacador -->
	<!-- Fisica -->
	<div class="row mt20" ng-show="abaCliente == 1 && etapaFisica == 2 && abaPessoa == 1">
		<div class="col-md-12">
			<!-- Dados Pessoa -->
			<div class="dflex fwrap">
				<div class="flex1">
					<label class="texto_formulario">Nome</label>
					<input type="text" class="form-control input_default" readonly placeholder="Nome" value="{{isset($solicitante) ? $solicitante[0]->Name : ''}}" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Sexo</label>
					<input type="text" class="form-control input_default" readonly placeholder="Sexo" value="{{isset($solicitante) ? $solicitante[0]->Gender : ''}}" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Data de Nascimento</label>
					<input type="text" class="form-control input_default" readonly placeholder="Data de Nascimento" value="{{isset($solicitante) ? $solicitante[0]->BirthDate : ''}}" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Nacionalidade</label>
					<input type="text" class="form-control input_default" readonly placeholder="Nacionalidade" value="{{isset($solicitante) ? $solicitante[0]->BirthCountry : ''}}" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Estado</label>
					<input type="text" class="form-control input_default" readonly placeholder="Estado" value="{{isset($solicitante) ? $solicitante[0]->BirthState : ''}}" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Nome da mãe</label>
					<input type="text" class="form-control input_default" readonly placeholder="Nome da mãe" value="{{isset($solicitante) ? $solicitante[0]->MotherName : ''}}" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Nome do Pai</label>
					<input type="text" class="form-control input_default" readonly placeholder="Nome do Pai" value="{{isset($solicitante) ? $solicitante[0]->FatherName  : ''}}" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Indicação de falecimento</label>
					<input type="text" class="form-control input_default" readonly placeholder="Indicação de falecimento" value="{{isset($solicitante) ? $solicitante[0]->HasObitIndication : ''}}" />
				</div>
			</div>
		</div>
	</div>

</div>
<script>
	var app = angular.module('myApp', []);
	app.controller('myCtrl', function($scope, $http) {
		$scope.abaCliente 				= 1;
		$scope.abaPessoa 				= 1;
		$scope.etapaFisica 				= 2;
		$scope.etapaJuridica 			= 1;
		$scope.solicitante_fisica 		= 0;
		$scope.solicitante_juridica 	= 0;
		$scope.sacado_fisico 			= 0;
		$scope.sacado_juridica 			= 0;
		$scope.erro_consuta 			= 0;
		$scope.juros 					= <?=isset($solicitacao->juros) ? $solicitacao->juros : 1.99 ?>;
		$scope.limite_credito 			= <?=$solicitacao->credito?>;
		$scope.id_solicitacao 			= <?=$solicitacao->id?>;


		$scope.trocaCliente = function(v) {
			$scope.abaCliente = v;

			//Reseta step assim que troca a aba de cliente
			$scope.abaPessoa = 1;
			$scope.etapaFisica = 1;
			$scope.etapaJuridica = 1;
		}

		$scope.trocaPessoa = function(v) {
			$scope.abaPessoa = v;
		}

		$scope.subCategoria = function(v, a) {
			if (a == 1) {
				$scope.etapaFisica = v;
			} else {
				$scope.etapaJuridica = v;
			}
		}
		
	});

	function aprova() {
    	document.getElementById("status").value = 1;
		document.getElementById('atualiza_status').submit();
	}
	function pendente() {
    	document.getElementById("status").value = 2;
		document.getElementById('atualiza_status').submit();
	}
	function recusa() {
    	document.getElementById("status").value = 3;
		document.getElementById('atualiza_status').submit();
	}
	</script>
@endsection