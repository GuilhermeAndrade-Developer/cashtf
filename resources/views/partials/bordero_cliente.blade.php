@extends('layouts.cliente.topo')
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
        <form id="filtros" action="{{route('cliente.solicitacoes.filtro')}}" method="GET" >
            <div class="flex_pai_buscar_bordero_cliente">
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
                    @if ($solicitacoes->lastPage() > 1)
                    <div class="flexend_paginacao_bordero_cliente">
                        <div class="disp_flex_bordero_paginacao_cliente">
                            @if($solicitacoes->currentPage() == 1)
                            <div class="fonte_icon_chevron_bordero">
                                <i class="las la-chevron-circle-left"></i>
                            </div>
                            @else
                            <div class="fonte_icon_chevron_bordero">
                                <a href="{{$solicitacoes->url($solicitacoes->currentPage()-1) }}"><i class="las la-chevron-circle-left"></i></a>
                            </div>
                            @endif
                            @for ($i = 1; $i <= $solicitacoes->lastPage(); $i++)
                            @if($i >= $solicitacoes->currentPage()-3 AND $i <= $solicitacoes->currentPage()+3)
                            <div class="{{ ($solicitacoes->currentPage() == $i) ? 'div_paginacao_selecionada_bordero_cliente' : 'div_paginacao_nao_selecionada_bordero_cliente' }}">
                                <a href="{{ $solicitacoes->url($i) }}">{{ $i }}</a>
                            </div>
                            @endif
                            @endfor
                            @if($solicitacoes->currentPage() == $solicitacoes->lastPage())
                            <div class="fonte_icon_chevron_bordero_right">
                                <i class="las la-chevron-circle-right"></i>
                            </div>
                            @else
                            <div class="fonte_icon_chevron_bordero_right">
                                <a href="{{$solicitacoes->url($solicitacoes->currentPage()+1) }}"><i class="las la-chevron-circle-right"></i></a>
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
                    <a href="{{route('cliente.solicitacoes.novo')}}">
                    <div class="div_plus_bordero_cliente">
                        <i class="las la-plus" class="icone_plus_bordero_cliente" style="color: #f11270; font-size: 25px;"></i>
                    </div>
                    </a>
                </div>
            </div>
        </form>
        <table data-table-list class="table table-responsive table-striped tabela_padrao bordero" id="tabela_clicavel">
            <thead>
                <tr>
                    <th class="text-center">BORDERÔ</th>
                    <th class="text-center" style="width: 30%">SACADOS</th>
                    <th class="text-center">INCLUSÃO</th>
                    <th class="text-center">VALOR DA NFE</th>
                    <th class="text-center">DESÁGIO</th>
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
                    <tr class="clickable-row" data-href="{{route('cliente.info.solicitacao',$s->id)}}">
                        <td class="text-center">{{$s->id}}</td>
                        <td class="text-center">{{$s->sacado_nome}}</td>
                        <td class="text-center">{{$s->data_gerado}}</td>
                        <td class="text-center">{{$s->valor_total}}</td>
                        <td class="text-center">{{$s->desagio}}</td>
                        <td class="text-center">{{$s->juros}} %</td>
                        <td class="text-center">{{$s->valor_total_juros}}</td>

                        <!-- bot_amarelo_apro - bot_verde_apro - bot_vermelho_apro -->
                        <td class="text-center"><span class="{{isset($class_status)? $class_status : ''}}">{{$s->nome_status}}</span></td>
                        <td class="text-center"><a href="{{route('cliente.solicitacao.delete',$s->id)}}"><i class="fa fa-trash lixeira_tabela"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
            <!-- <tfoot>
                <tr>
                    <td colspan="6" style="padding: 8px 15px;">TOTAL LÍQUIDO ANTECIPADO:</td>
                    <td class="text-center"><b>R$ {valor}</b></td>
                    <td colspan="2"></td>
                </tr>
            </tfoot> -->
        </table>
    </div>
@endsection


