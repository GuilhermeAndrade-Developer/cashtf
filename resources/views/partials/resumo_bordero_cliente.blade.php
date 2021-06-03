@extends('layouts.etapas')
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

        </style>


<div class="fundo_azul_topo_bordero_cliente_resumo">
    <div class="container-fluid">
        <div class="flex_pai_topo_azul_bordero_cliente">
            <div class="flex1">
                <span class="fonte_empresa">{{ isset($solicitacao->nome_solicitante)? $solicitacao->nome_solicitante : 'Nome Solicitante' }}</span><br>
                <span class="numero_bordero">BORDERÔ: {{ isset($solicitacao->id)? $solicitacao->id : '' }}</span>
            </div>
            <div class="flex1">
                <div class="flex_end">
                    <div class="active">
                        <i class="fa fa-file-text-o icon_file" aria-hidden="true"></i>
                        <span class="resumo_bordero">Resumo do Borderô</span>
                    </div>
                    <a href="{{route('cliente.solicitacoes')}}"><i class="fa fa-times icone_fechar" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="div_geral_socio_procurador" style="padding-top: 68px;">
    <div class="div_pai_solicitar_fundo_bordero ">
        <span class="fonte_boletos">
            RESUMO DO BORDERÔ
        </span>
    </div>
    <div class="div_pai_analisar_fundo_azul_selecionada ">
        <div class="flex1_text_center">
            <span>RAZÃO SOCIAL</span>
        </div>
        <div class="flex2_text_center">
            <span>CPF/CNPJ</span>
        </div>
        <div class="flex1_text_center">
            <span>NFE</span>
        </div>
        <div class="flex1_text_center">
            <span>DATA DA NFE</span>
        </div>
        <div class="flex1_text_center">
            <span>VALOR</span>
        </div>
        <div class="flex1_text_center">
            <span>JUROS</span>
        </div>
        <div class="flex1_text_center">
            <span>IOF</span>
        </div>
        <div class="flex1_text_center">
            <span>TAC</span>
        </div>
        <div class="flex1_text_center">
            <span>PRAZO MÉDIO</span>
        </div>
        <div class="flex1_text_center">
            <span>A RECEBER</span>
        </div>
        <div class="flex1_text_center">
            <span>DESÁGIO</span>
        </div>
    </div>
        <div class="{{ !($solicitacao->id % 2) ? 'div_pai_analisar_fundo_cinza_selecionada' : 'div_pai_analisar_fundo_branco_selecionada'}}">
            <div class="flex1_text_center">
                <a href="{{route('cliente.info.solicitacao',$solicitacao->id)}}"><span alt="{{isset($sacado->OfficialName) ? $sacado->OfficialName : $sacado->Name}}" title="{{isset($sacado->OfficialName) ? $sacado->OfficialName : $sacado->Name}}">{{isset($sacado->OfficialName) ? $OfficialName_reduzido : $Name_reduzido}}</span></a>
            </div>
            <div class="flex2_text_center">
                <span class="cnpj">{{isset($sacado->cnpj) ? $sacado->cnpj : $sacado->cpf}}</span>
            </div>
            <div class="flex1_text_center">
                <span alt="{{$solicitacao->id_nota}}" title="{{$solicitacao->id_nota}}">{{isset($id_nota_reduzida) ? $id_nota_reduzida : ''}}</span>
            </div>
            <div class="flex1_text_center">
                <span>{{isset($solicitacao->data_emissao) ? $solicitacao->data_emissao : ''}}</span>
            </div>
            <div class="flex1_text_center">
                <span>R$ {{$solicitacao->valor_total}}</span>
            </div>
            <div class="flex1_text_center">
                <span>R$ {{$solicitacao->juros_valor}}</span>
            </div>
            <div class="flex1_text_center">
                <span>R$ 0,00</span>
            </div>
            <div class="flex1_text_center">
                <span>R$ 0,00</span>
            </div>
            <div class="flex1_text_center">
                <span>{{$solicitacao->diff_dias}}</span>
            </div>
            <div class="flex1_text_center">
                <span>R$ {{$solicitacao->valor_total_juros}}</span>
            </div>
            <div class="flex1_text_center">
                <span>{{isset($solicitacao->juros_total) ? $solicitacao->juros_total : ''}} %</span>
            </div>
        </div>
    <div class="div_pai_analisar_fundo_rosa_selecionada mb150">
        <div style="flex: 3; margin-left: 20px; color: #fff;">
            <span><b>TOTAL LÍQUIDO ANTECIPADO:</b></span>
        </div>
        <div class="flex1_text_center">
        </div>
        <div class="flex1_text_center">
        </div>
        <div class="flex1_text_center">
        </div>
        <div class="flex1_text_center">
        </div>
        <div class="flex1_text_center">
        </div>
        <div class="flex1_text_center">
        </div>
        <div class="flex1_text_center">
        </div>
       
        <div class="flex1_text_center">
            <span><b>R$ {{isset($solicitacao->valor_total_juros) ? $solicitacao->valor_total_juros : ''}}</b></span>
        </div>
        <div class="flex1_text_center">
        </div>
    </div>
</div>
<div class="linha_rodape_analisar">
   
</div>
@endsection


