@extends('layouts.admin.topo')
@section('content')

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
        <form id="filtros" action="{{route('admin.clientes.filter')}}" method="GET" >
            <div class="mt80_bordero_cliente flex_pai_buscar_bordero_cliente">
                <div class="fundo_procure_bordero">
                    <i class="fa fa-search fa-rotate-270 mr10_bordero_cliente" aria-hidden="true"></i>
                    <input type="text" id="procure" name="procure" class="procure" value="{{ isset($procure)? $procure : '' }}" placeholder="Procure por empresa..."> 
                </div>
                <input type="hidden" id="status" name="status" class="hidden" value="{{ isset($status)? $status : '' }}"> 
                <div class="fundo_title_bordero_cliente">
                    <div class="flex_1_bordero_cliente_title">
                        <span class="fonte_bordero_title_cliente">
                            CLIENTES
                        </span>
                    </div>
                    @if ($clientes->lastPage() > 1)
                    <div class="flexend_paginacao_bordero_cliente">
                        <div class="disp_flex_bordero_paginacao_cliente">
                            @if($clientes->currentPage() == 1)
                            <div class="fonte_icon_chevron_bordero">
                                <i class="las la-chevron-circle-left"></i>
                            </div>
                            @else
                            <div class="fonte_icon_chevron_bordero">
                                <a href="{{$clientes->url($clientes->currentPage()-1) }}"><i class="las la-chevron-circle-left"></i></a>
                            </div>
                            @endif
                            @for ($i = 1; $i <= $clientes->lastPage(); $i++)
                            @if($i >= $clientes->currentPage()-3 AND $i <= $clientes->currentPage()+3)
                            <div class="{{ ($clientes->currentPage() == $i) ? 'div_paginacao_selecionada_bordero_cliente' : 'div_paginacao_nao_selecionada_bordero_cliente' }}">
                                <a href="{{ $clientes->url($i) }}">{{ $i }}</a>
                            </div>
                            @endif
                            @endfor
                            @if($clientes->currentPage() == $clientes->lastPage())
                            <div class="fonte_icon_chevron_bordero_right">
                                <i class="las la-chevron-circle-right"></i>
                            </div>
                            @else
                            <div class="fonte_icon_chevron_bordero_right">
                                <a href="{{$clientes->url($clientes->currentPage()+1) }}"><i class="las la-chevron-circle-right"></i></a>
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
                    <a href="{{route('admin.register.confirmar')}}">
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
						<th class="text-left">CNPJ</th>
						<th class="text-left">RAZÃO SOCIAL</th>
						<th class="text-center">STATUS</th>
						<th class="text-center"></th>
						<th class="text-center"></th>	
				</tr>
		</thead>
		<tbody>
		@foreach($clientes as $c)
			<tr class="clickable-row" data-href="{{route('admin.clientes.view',$c->id_cliente)}}">			
				<td class="text-center"></td>
				<td class="text-left">{{isset($c->cnpj) ? $c->cnpj : ''}}</td>
				<td class="text-left">{{isset($c->OfficialName) ? $c->OfficialName : $c->Name}}</td>
						
				<!-- bot_amarelo_apro - bot_verde_apro - bot_vermelho_apro -->
                @if($c->ativo == 1)
				<td class="text-center"><span class="bot_verde_apro">APROVADO</span></td>
                <td class="text-center"></td>
                @elseif($c->ativo == 2)
                <td class="text-center"><span class="bot_vermelho_apro">RECUSADO</span></td>
                <td class="text-center"><a href="{{route('admin.clientes.delete',$c->id_cliente)}}"><i class="fa fa-trash lixeira_tabela"></i></a></td>
                @elseif($c->ativo == 0)
                <td class="text-center"><span class="bot_amarelo_apro">PENDENTE</span></td>
                <td class="text-center"></td>
                @endif
				<td class="text-center"></td>
			</tr>
		@endforeach
		</tbody>
</table>
</div>
@endsection