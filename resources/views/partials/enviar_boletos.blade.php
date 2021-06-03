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
            .rodape_socio_procurador{
                display: none;
            }
        </style>

    <div class="div_geral_socio_procurador">
        <button type="button" id="" class="close mr-2" data-dismiss="" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="container-fluid">
            <div class="row mt40">
                <div class="col-md-6 text-left">
                    <i class="fa fa-search socio_procurador_icon" aria-hidden="true"></i>
                    <span class="titulo_socio">ANALISAR SOLICITAÇÃO</span>
                </div>
            </div>
        </div>
        <div class="div_pai_analisar_fundo_boletos mt20">
            <span class="fonte_boletos">
                BOLETOS
            </span>
        </div>
        <div class="div_pai_analisar_fundo_azul_selecionada ">
            <div class="flex1_text_center">
                <span>RAZÃO SOCIAL</span>
            </div>
            <div class="flex1_text_center">
                <span>CPF/CNPJ</span>
            </div>
            <div class="flex1_text_center">
                <span>VENCIMENTO</span>
            </div>
            <div class="flex1_text_center">
                
            </div>
            <div class="flex1_text_center">
                <span>VALOR</span>
            </div>
        </div>
        @foreach($parcelas as $p)
        <?php $v_parcela  = str_replace('.', '', $p->valor_parcela);
							$v_parcela  = str_replace(',', '.', $v_parcela);
							$v_juros    = str_replace('.', '', $p->valor_juros);
							$v_juros    = str_replace(',', '.', $v_juros); ?>
        <div class="div_pai_analisar_fundo_branco_selecionada">
            <div class="flex1_text_center">
                <span>{{$sacado[0]->Name}}</span>
            </div>
            <div class="flex1_text_center">
                <span>{{$sacado[0]->cnpj}}</span>
            </div>
            <div class="flex1_text_center">
                <span>{{$p->vencimento}}</span>
            </div>
            <div class="flex1_text_center">
                
            </div>
            <div class="flex1_text_center">
                <span>R$ {{$v_parcela}}</span>
            </div>
        </div>
        @endforeach
        <div class="div_pai_analisar_fundo_rosa_selecionada mb150">
            <div class="flex1_text_center">
            </div>
            <div class="flex1_text_center">
            </div>
            <div class="flex1_text_center">
            </div>
            <div class="flex1_text_center">
            </div>
            <div class="flex1_text_center">
                <span><b>R$ {{$solicitacao->valor_total}}</b></span>
            </div>
        </div>
    </div>
    <div class="fundorodapesteps">
        <div class="container-fluid alinhaconteudo">
            <div class="flexpai">
                <div class="dflexaligncenter">
                </div>
                <div class="flexbolinhas">
                   
                </div>
                <div class="divflexend">
                    <div class="fundo_enviar_boletos">
                    <a href="{{route('admin.boleto.create',$solicitacao->id)}}">
                        <span class="fontefinalizar">ENVIAR BOLETOS</span>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


