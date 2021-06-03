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
            <div class="mt20">
                <div class="col-md-2">
                    <div class="btn btn-block button_aprovado" style="padding: 9px 60px;">
                        APROVADO
                    </div>
                </div>
                <div class="col-md-2 margin_buttons_mobile">
                    <div class="btn btn-block button_pendente" style="padding: 9px 60px;">
                        PENDENTE
                    </div>
                </div>
                <div class="col-md-2 margin_buttons_mobile">
                    <div class="btn btn-block button_recusado" style="padding: 9px 60px;">
                        RECUSADO
                    </div>
                </div>
            </div>
        </div>
        <div class="form_socio_procurador">
            <div class="flexpai mt20">
                <div class="dflex3"></div>
                <div class="dflex1">
                    <label for="bancoeagencia">BANCO E AGÊNCIA</label>
                    <input type="text" id="bancoeagencia" name="bancoeagencia" placeholder="Banco e agência...">
                </div>
                <div class="box_rosa"></div>
                <div class="ph10"></div>
                <div class="dflex1">
                    <label for="contaselecionada">CONTA SELECIONADA</label>
                    <input type="text" id="contaselecionada" name="contaselecionada" placeholder="Conta Selecionada...">
                </div>
                <div class="box_rosa"></div>
                <div class="ph10"></div>
                <div class="dflex1">
                    <label for="limitedecredito">LIMITE DE CRÉDITO</label>
                    <input type="text" id="limitedecredito" name="limitedecredito" placeholder="Limite de crédito...">
                </div>
                <div class="box_rosa_icons">
                    <i class="fa fa-floppy-o" style="color: #fff;" aria-hidden="true"></i>
                </div>
                <div class="ph10"></div>
                <div class="dflex1">
                    <label for="porcentagemdejuros">PORCENTAGEM DE JUROS</label>
                    <input type="text" id="porcentagemdejuros" name="porcentagemdejuros" placeholder="Porcentagem de juros...">
                </div>
                <div class="box_rosa_icons">
                    <i class="fa fa-floppy-o" style="color: #fff;" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="row mt30">
            <div class="col-md-12">
                <div class="linha_socio_procurador">
                </div>
            </div>
        </div>
        <div class="div_funcoes_analisar_solicitacao mt20">
            <div class="dflex4">
            </div>
            <div class="dflex1">
                <div class="btn btn-block button_azul_analisar" style="padding: 9px 20px;">
                    <i class="fa fa-download" style="font-size: 14px;" aria-hidden="true"></i>
                    ARQUIVO XML
                </div>
            </div>
            <div class="ph10"></div>
            <div class="dflex1">
                <div class="btn btn-block button_transparente_analisar" style="padding: 9px 20px;">
                    <i class="fa fa-link" style="font-size: 14px;" aria-hidden="true"></i>
                    ACESSAR PORTAL
                </div>
            </div>
            <div class="ph10"></div>
            <div class="dflex1">
                <div class="btn btn-block button_rosa_analisar" style="padding: 9px 20px;">
                    <i class="fa fa-file-o" style="font-size: 14px;" aria-hidden="true"></i>
                    BORDERÔ
                </div>
            </div>
            <div class="ph10"></div>
            <div class="dflex1">
                <div class="btn btn-block button_transparente_analisar" style="padding: 9px 20px;">
                    <i class="fa fa-barcode" style="font-size: 14px;" aria-hidden="true"></i>
                    BOLETO
                </div>
            </div>
        </div>
        <div class="row mt30">
            <div class="col-md-12 text-left">
                <span>CLIENTE</span>
            </div>
        </div>
        <div class="div_pai_analisar_box_central mt10">
            <div class="dflex1">
                <div class="background_azul">
                    <span class="fonte_branca_box">SACADO: <b>HOTEL MONTE VERDE EIRELI</b></span>
                </div>
            </div>
            <div class="ph5"></div>
            <div class="dflex1">
                <div class="background_cinza">
                    <span class="fonte_cinza_box">SACADOR: <b>PEEXELL DIGITAL SOLUTIONS</b></span>
                </div>
            </div>
        </div>
        <div class="row mt10">
            <div class="col-md-12 text-left">
                <span>PESSOA</span>
            </div>
        </div>
        <div class="div_pai_analisar_box_central mt10">
            <div class="dflex1">
                <div class="background_cinza">
                    <span class="fonte_cinza_box"><b>PESSOA FÍSICA</b></span>
                </div>
            </div>
            <div class="ph5"></div>
            <div class="dflex1">
                <div class="background_azul">
                    <span class="fonte_branca_box"><b>PESSOA JURÍDICA</b></span>
                </div>
            </div>
        </div>
        <div class="div_pai_analisar_fichas mt50">
            <div class="flexauto">
                <div class="background_azul">
                    <span class="fonte_branca">
                        FATURAS
                    </span>
                </div>
            </div>
            <div class="ph5"></div>
            <div class="flexauto">
                <div class="background_cinza">
                    <span class="fonte_cinza">
                        DADOS
                    </span>
                </div>
            </div>
            <div class="ph5"></div>
            <div class="flexauto">
                <div class="background_cinza">
                    <span class="fonte_cinza">
                        ENDEREÇOS
                    </span>
                </div>
            </div>
            <div class="ph5"></div>
            <div class="flexauto">
                <div class="background_cinza">
                    <span class="fonte_cinza">
                        GRUPO ECONÔMICO
                    </span>
                </div>
            </div>
            <div class="ph5"></div>
            <div class="flexauto">
                <div class="background_cinza">
                    <span class="fonte_cinza">
                        INDICADORES DE ATIVIDADES
                    </span>
                </div>
            </div>
            <div class="ph5"></div>
            <div class="flexauto">
                <div class="background_cinza">
                    <span class="fonte_cinza">
                       KYC
                    </span>
                </div>
            </div>
            <div class="ph5"></div>
            <div class="flexauto">
                <div class="background_cinza">
                    <span class="fonte_cinza">
                        PROCESSOS
                    </span>
                </div>
            </div>
            <div class="ph5"></div>
            <div class="flexauto">
                <div class="background_cinza">
                    <span class="fonte_cinza">
                       RELACIONAMENTOS
                    </span>
                </div>
            </div>
            <div class="ph5"></div>
            <div class="flexauto">
                <div class="background_cinza">
                    <span class="fonte_cinza">
                        TELEFONES
                    </span>
                </div>
            </div>
            <div class="ph5"></div>
            <div class="flexauto">
                <div class="background_cinza">
                    <span class="fonte_cinza">
                        ON DEMAND
                    </span>
                </div>
            </div>
        </div>
        <div class="div_linha_azul_analisar">
        </div>
        <div class="div_pai_analisar_fundo_azul_selecionada mt30 ">
            <div class="flex1_text_center">
                <span>PARCELAS</span>
            </div>
            <div class="flex1_text_center">
                <span>VENCIMENTO</span>
            </div>
            <div class="flex1_text_center">
                <span>VALOR DA PARCELA</span>
            </div>
            <div class="flex1_text_center">
                <span>JUROS</span>
            </div>
            <div class="flex1_text_center">
                <span>VALOR A RECEBER</span>
            </div>
            <div class="flex1_text_center">
                <span>STATUS</span>
            </div>
        </div>
        <div class="div_pai_analisar_fundo_branco_selecionada">
            <div class="flex1_text_center">
                <span>1ª PARCELA</span>
            </div>
            <div class="flex1_text_center">
                <span>10/10/19</span>
            </div>
            <div class="flex1_text_center">
                <span>R$ 500,00</span>
            </div>
            <div class="flex1_text_center">
                <span>2%</span>
            </div>
            <div class="flex1_text_center">
                <span>R$ 470,00</span>
            </div>
            <div class="flex1_text_center">
                <span>SOLICITADO</span>
            </div>
        </div>
        <div class="div_pai_analisar_fundo_cinza_selecionada ">
            <div class="flex1_text_center">
                <span>2ª PARCELA</span>
            </div>
            <div class="flex1_text_center">
                <span>10/10/19</span>
            </div>
            <div class="flex1_text_center">
                <span>R$ 500,00</span>
            </div>
            <div class="flex1_text_center">
                <span>2%</span>
            </div>
            <div class="flex1_text_center">
                <span>R$ 470,00</span>
            </div>
            <div class="flex1_text_center">
                <span>SOLICITADO</span>
            </div>
        </div>
        <div class="div_pai_analisar_fundo_branco_selecionada">
            <div class="flex1_text_center">
                <span>3ª PARCELA</span>
            </div>
            <div class="flex1_text_center">
                <span>10/10/19</span>
            </div>
            <div class="flex1_text_center">
                <span>R$ 500,00</span>
            </div>
            <div class="flex1_text_center">
                <span>2%</span>
            </div>
            <div class="flex1_text_center">
                <span>R$ 470,00</span>
            </div>
            <div class="flex1_text_center">
                <span>SOLICITADO</span>
            </div>
        </div>
        <div class="div_pai_analisar_fundo_rosa_selecionada">
            <div class="flex1_text_center">
            </div>
            <div class="flex1_text_center">
            </div>
            <div class="flex1_text_center">
            </div>
            <div class="flex1_text_center">
                <span>JUROS TOTAL</span>
            </div>
            <div class="flex1_text_center">
                <span>TOTAL A RECEBER</span>
            </div>
            <div class="flex1_text_center">
            </div>
        </div>
        <div class="div_pai_analisar_fundo_cinza_selecionada mb150 ">
            <div class="flex1_text_center">
            </div>
            <div class="flex1_text_center">
            </div>
            <div class="flex1_text_center">
            </div>
            <div class="flex1_text_center">
                <span>2%</span>
            </div>
            <div class="flex1_text_center">
                <span>R$ 1.410,00</span>
            </div>
            <div class="flex1_text_center">
            </div>
        </div>
    </div>
</div>
<div class="linha_rodape_analisar">
   
</div>
@endsection


