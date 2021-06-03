@extends('layouts.admin.cliente_view.topo_bordero')
@section('content')

<style>
	#modal-solicitacao-enviada {
		width:100px;
		height:100px;
		position:absolute;
		top:50%;
		left:36%;
		margin-top:-50px;
		margin-left:-50px;
	}
	input:-webkit-autofill {
			-webkit-text-fill-color: #000 !important;
	}
	#cpf:valid { background-color: #f11270; color: #fff; border: none; }
	#cpf:-webkit-autofill {
			-webkit-text-fill-color: #fff !important;
	}
	#contratosocial:valid { background-color: #1ca7fc; color: #fff; border: none; } 
	#alteracoescontratuais:valid { background-color: #1ca7fc; color: #fff; border: none; }
	#faturamento:valid { background-color: #1ca7fc; color: #fff; border: none; }

	select#bordero_cliente{
			height: 36px;
			border: initial;
			width: 50px;
	}
</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
<div class="div_geral_socio_procurador" ng-app="myApp" ng-controller="myCtrl" ng-cloak>
	<div class="container-fluid">
	</div>
	<form id="filtros" action="" method="GET" >
			<div class="mt80_bordero_cliente flex_pai_buscar_bordero_cliente">
					<div class="fundo_title_bordero_cliente">
						<div class="flex_1_bordero_cliente_title">
							<a></a>
						</div>
						<div class="flex_1_bordero_cliente_title">
							<span class="fonte_bordero_title_cliente">
							RESUMO DO BORDERÔ
							</span>
						</div>
						<div class="flex_1_bordero_cliente_title" style="justify-content: center; align-items: center;">
							<a class="download las la-envelope la-lg white b_s_dark_color" ng-click="enviaContrato()"> ENVIAR CONTRATO</a>
						</div>
					</div>
				</div>
	</form>
	<table data-table-list class="table table-responsive table-striped tabela_padrao resume" id="tabela_clicavel">
			<thead>
					<tr>						
							<th class="text-center"></th>
							<th class="text-left">RAZÃO SOCIAL</th>
							<th class="text-left">CNPJ</th>
							<th class="text-center">NFE</th>
							<th class="text-center">DATA DA NFE</th>
							<th class="text-center">VALOR</th>
							<th class="text-center">JUROS</th>
							<th class="text-center">IOF</th>
							<th class="text-center">TAC</th>
							<th class="text-center">PRAZO MÉDIO</th>
							<th class="text-center">A RECEBER</th>
							<th class="text-center">% JUROS</th>	
							<th class="text-center"></th>	
					</tr>
			</thead>
			<tbody>
			<!-- futuramente foreach bordero -->
			@foreach($bordero as $b)
				@if($b->id_status != 3)
							<tr class="clickable-row" data-href="">			
									<td class="text-center"></td>
									<td class="text-left">{{isset($b->sacado->OfficialName) ? $b->sacado->OfficialName : $b->sacado->Name}}</td>
									<td class="text-left">{{isset($b->sacado->cnpj) ? $b->sacado->cnpj : $b->sacado->cpf}}</td>
									<td class="text-center" alt="{{$b->id_nota}}" title="{{$b->id_nota}}">{{isset($b->id_nota_reduzida) ? $b->id_nota_reduzida : ''}}</td>
									<td class="text-center">{{isset($b->data_emissao) ? $b->data_emissao : ''}}</td>
									<td class="text-center">R$ <span>{{$b->valor_total}}</span> </td>
									<td class="text-center">R$ <span> {{$b->juros_valor}} </span> </td>
									<td class="text-center">R$ 00,00</td>
									<td class="text-center">R$ <span>{{$b->tac}}</span> </td>
									<td class="text-center">{{$b->diff_dias}}</td>
									<td class="text-center">R$ <span>{{$b->valor_total_juros}}</span>  </td>
									<td class="text-center">{{isset($b->juros) ? $b->juros : ''}} %</td>
									<td class="text-center"></td>
							</tr>
				@else
							<tr class="clickable-row white m_light_b_red" data-href="">			
									<td class="text-center"></td>
									<td class="text-left">{{isset($b->sacado->OfficialName) ? $b->sacado->OfficialName : $b->sacado->Name}}</td>
									<td class="text-left">{{isset($b->sacado->cnpj) ? $b->sacado->cnpj : $b->sacado->cpf}}</td>
									<td class="text-center" alt="{{$b->id_nota}}" title="{{$b->id_nota}}">{{isset($b->id_nota_reduzida) ? $b->id_nota_reduzida : ''}}</td>
									<td class="text-center">{{isset($b->data_emissao) ? $b->data_emissao : ''}}</td>
									<td class="text-center">R$ <span>{{$b->valor_total}}</span> </td>
									<td class="text-center">R$ <span> {{$b->juros_valor}} </span> </td>
									<td class="text-center">R$ 00,00</td>
									<td class="text-center">R$ <span>{{$b->tac}}</span> </td>
									<td class="text-center">{{$b->diff_dias}}</td>
									<td class="text-center">R$ <span>{{$b->valor_total_juros}}</span>  </td>
									<td class="text-center">{{isset($b->juros) ? $b->juros : ''}} %</td>
									<td class="text-center"></td>
							</tr>
				@endif
			@endforeach
			</tbody>
			<tfoot>
				<tr class="b_f_color">
					<td class="text-center"></td>
					<td class="text-left">TOTAL LÍQUIDO ANTECIPADO</td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center">R$ {{isset($valor_liquido_total) ? $valor_liquido_total : ''}}</td>
					<td class="text-center"></td>
					<td class="text-center"></td>
				</tr>
			</tfoot>
	</table>
	<div ng-show="modal==1">@include('partials.modals.contrato_enviado')</div>
</div>

<script>
		var app = angular.module('myApp', []);
		app.controller('myCtrl', ['$scope', '$http', function($scope, $http) {
			$scope.modal = 0;

			$scope.enviaContrato = function() {
				$http.get('<?=route('admin.solicitacao.contrato',$bordero[0]->nro_bordero)?>').success(function(data){
					console.log(data);
					$scope.modal = 1;
				});
			}

		}]);
	</script>
@endsection