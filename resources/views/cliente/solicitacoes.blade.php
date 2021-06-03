@extends('layouts.cliente.topo')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/solicitacoes.css')}}" />
<div class="padding_top_default">		
	<div class="container-fluid">
		<div class="row">			
			<div style="background-color: #f11070;">
				<div class="row">			
					<div class="col-md-12 text-center div_solicitacoes">						
						<span>
							SOLICITAÇÕES
						</span>				
					</div>
				</div>
			</div>			
		</div>		
	</div>
	<div class="container-fluid">			
		<div class="row">
			<div class="text-center mt5">
				<table data-table-list class="table table-responsive table-striped tabela_padrao" id="tabela_clicavel">
					<thead>
						<tr>							
							<th class="text-left">SOLICITAÇÕES</th>
							<th class="text-center">VALOR TOTAL</th>
							<th class="text-center">DATA DA INCLUSÃO</th>
							<th class="text-center">JUROS</th>
							<th class="text-center">VALOR A RECEBER</th>
							<th class="text-center">STATUS</th>
							<th class="text-center"></th>				
						</tr>
					</thead>
					<tbody>
                        @foreach($solicitacoes as $s)
						@php 
							$class_status = ($s->id_status == 1)?'bot_verde_apro':($s->id_status == 2?'bot_amarelo_apro':'bot_vermelho_apro'); 
						@endphp
							<tr class="clickable-row" data-href="{{route('cliente.solicitacoes.view',$s->id)}}">			
								<td class="text-left">{{$s->nome_sacado}}</td>
								<td class="text-center">{{$s->valor_total}}</td>
								<td class="text-center">{{$s->data_gerado}}</td>
								<td class="text-center">{{$s->juros_total}} %</td>
								<td class="text-center">{{$s->valor_total_juros}}</td>
								
								<!-- bot_amarelo_apro - bot_verde_apro - bot_vermelho_apro -->
								<td class="text-center"><span class="{{isset($class_status)? $class_status : ''}}">{{$s->nome_status}}</span></td>
								<td class="text-center"><a href="{{route('cliente.solicitacao.delete',$s->id)}}"><i class="fa fa-trash lixeira_tabela"></i></a></td>
							</tr>
                        @endforeach
					</tbody>
				</table>	
				{{ $solicitacoes->appends(Request::except('page'))->links() }}
			</div>
		</div>
	</div>			
</div>


<!-- Modal Sucesso -->
<div style="display: none;" id="modal_confirmacao">
	<div class="overlay"></div>
	<div class="div_modal_absolute">
		<div class="text-center">
			<div><i class="fa fa-exclamation-circle" style="font-size: 100px; color: #f11070;"></i></div>
			<h4>ATENÇÃO</h4>
			<div style="margin-top: 20px">REALMENTE DESEJA DELETAR<br>ESTA SOLICITAÇÃO?</div>
		</div>
		<div class="text-center">
			<div style="text-align: center; margin-top: 40px;">
			<form method="POST" action="" id="link_sim">
			@csrf
				<a class="botao_sim btn-verificar" onclick="document.getElementById('link_sim').submit()">SIM</a>
				<a id="fecha_modal" class="botao_nao btn-verificar">NÃO</a>
			</form>
			</div>		
		</div>
	</div>
</div>	


	<!-- Modal Sucesso -->
	<div style="display: none;" id="modal_retorno">
		<div class="overlay"></div>
		<div class="div_modal_absolute">
			<div class="text-center">
				<div><img src="{{asset('cliente/images/cadastrado_g_icn.png')}}"></div>
				<h4>SOLICITAÇÃO DELETADA COM SUCESSO!</h4>
			</div>
			<div class="text-center">
				<div style="text-align: center; margin-top: 40px;">
					<a id="fecha_modal2" class="botao_sim btn-verificar">OK</a>
				</div>
			</div>
		</div>
	</div>	
@endsection