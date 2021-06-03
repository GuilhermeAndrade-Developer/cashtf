@extends('layouts.admin.cliente_view.topo')
@section('content')
<!-- <link rel="stylesheet" type="text/css" href="{{asset('css/solicitacoes.css')}}" /> -->
<style>

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
	.input-group-addon_lixeira {
			font-size: 14px;
			font-weight: 400;
			line-height: 1;
			color: #555;
			text-align: center;
			background-color: #eee;
			border: 1px solid #ccc;
			border-radius: 4px;
	}
</style>

<div class="div_geral_socio_procurador">
<div class="container-fluid">
		
</div>
<form id="filtros" action="{{route('admin.cliente.solicitacoes.filter',$id)}}" method="GET" >
            <div class="mt80_bordero_cliente flex_pai_buscar_bordero_cliente">
                <div class="fundo_procure_bordero">
                    <i class="fa fa-search fa-rotate-270 mr10_bordero_cliente" aria-hidden="true"></i>
                    <input type="text" id="procure" name="procure" class="procure" value="{{ isset($procure)? $procure : '' }}" placeholder="Procure por borderô..."> 
                </div>
                <input type="hidden" id="status" name="status" class="hidden" value="{{ isset($status)? $status : '' }}"> 
                <div class="fundo_title_bordero_cliente">
                    <div class="flex_1_bordero_cliente_title">
                        <span class="fonte_bordero_title_cliente">
                            BORDERÔS
                        </span>
                    </div>
                    @if ($borderos->lastPage() > 1)
                    <div class="flexend_paginacao_bordero_cliente">
                        <div class="disp_flex_bordero_paginacao_cliente">
                            @if($borderos->currentPage() == 1)
                            <div class="fonte_icon_chevron_bordero">
                                <i class="las la-chevron-circle-left"></i>
                            </div>
                            @else
                            <div class="fonte_icon_chevron_bordero">
                                <a href="{{$borderos->url($borderos->currentPage()-1) }}"><i class="las la-chevron-circle-left"></i></a>
                            </div>
                            @endif
                            @for ($i = 1; $i <= $borderos->lastPage(); $i++)
                            @if($i >= $borderos->currentPage()-3 AND $i <= $borderos->currentPage()+3)
                            <div class="{{ ($borderos->currentPage() == $i) ? 'div_paginacao_selecionada_bordero_cliente' : 'div_paginacao_nao_selecionada_bordero_cliente' }}">
                                <a href="{{ $borderos->url($i) }}">{{ $i }}</a>
                            </div>
                            @endif
                            @endfor
                            @if($borderos->currentPage() == $borderos->lastPage())
                            <div class="fonte_icon_chevron_bordero_right">
                                <i class="las la-chevron-circle-right"></i>
                            </div>
                            @else
                            <div class="fonte_icon_chevron_bordero_right">
                                <a href="{{$borderos->url($borderos->currentPage()+1) }}"><i class="las la-chevron-circle-right"></i></a>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                    <div class="ml10_select_bordero_cliente">
                        <select name="paginas" onChange="$('#filtros').submit();" id="bordero_cliente">
							<option value="10" {{Session::has('paginate')?(session('paginate') == 10? 'selected' : '') : ''}} >10</option>
                            <option value="5" {{Session::has('paginate')?(session('paginate') == 5? 'selected' : '') : ''}}>5</option>
                            <option value="2" {{Session::has('paginate')?(session('paginate') == 2? 'selected' : '') : ''}}>2</option>
                        </select>
                        <div class="select_arrow">
                        </div>
                    </div>
                    <a href="{{route('cliente.solicitacoes.novo', ['id'=> $id])}}">
                    <div class="div_plus_bordero_cliente">
                        <i class="las la-plus" class="icone_plus_bordero_cliente" style="color: #f11270; font-size: 25px;"></i>
                    </div>
                    </a>
                </div>
            </div>
        </form>
<table data-table-list class="table table-responsive table-striped tabela_padrao" id="tabela_clicavel">
		<thead>
				<tr>
						<th class="text-center"></th>
						<th class="text-left">BORDERÔ</th>
						<th class="text-left">SACADOS</th>
						<th class="text-center">INCLUSÃO</th>
						<th class="text-center">VALOR TOTAL</th>
						<th class="text-center">DESÁGIO</th>
						<th class="text-center">TAC</th>
						<th class="text-center">JUROS</th>
						<th class="text-center">VALOR A RECEBER</th>
						<th class="text-center">STATUS</th>
						<th class="text-center"></th>
						<th class="text-center"></th>
				</tr>
		</thead>
		<tbody>
		@foreach($borderos as $a)
			<tr class="clickable-row" data-href="{{route('admin.solicitacoes.view', $a['nro_bordero'])}}">
				<td class="text-center"></td>
				<td class="text-left">{{$a['nro_bordero']}}</td>
				<td class="text-left">{{isset($a['Name']) ? $a['Name'] : ''}}</td></td>
				<td class="text-center">{{$a['data_gerado']}}</td>
				<td class="text-center">R$ {{$a['valor_total']}}</td>
				<td class="text-center">R$ {{$a['desagio']}}</td>
				<td class="text-center">R$ {{$a['tac']}}</td>
				<td class="text-center">{{$a['juros']}}%</td>
				<td class="text-center">R$ {{$a['valor_total_juros']}}</td>

				<!-- bot_amarelo_apro - bot_verde_apro - bot_vermelho_apro -->
				@if(($a['id_status'] == 1) || ($a['id_status'] == 4) || ($a['id_status'] == 5) || ($a['id_status'] == 6)) 
				<td class="text-center"><span class="bot_verde_apro">APROVADA</span></td>
				<td class="text-center"></td>
				@elseif($a['id_status'] == 2)
				<td class="text-center"><span class="bot_amarelo_apro">PENDENTE</span></td>
				<td class="text-center"></td>
				@elseif($a['id_status'] == 3)
				<td class="text-center"><span class="bot_vermelho_apro">RECUSADO</span></td>
				<td class="text-center"><a href="{{route('admin.solicitacao.delete',$a['id'])}}"><i class="fa fa-trash lixeira_tabela"></i></a></td>
				@endif
				<td class="text-center"></td>
			</tr>
		@endforeach				
		</tbody>
</table>
</div>

<!-- Modal Sucesso -->
<div style="display: none;" id="modal_confirmacao">
	<div class="overlay"></div>
	<div class="div_modal_absolute">
		<div class="text-center">
			<div><i class="fa fa-exclamation-circle" style="font-size: 100px; color: #f11070;"></i></div>
			<h4>ATENÇÃO<div style="margin-top: 20px">REALMENTE DESEJA DELETAR<br>ESTA SOLICITAÇÃO?</div></h4>
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