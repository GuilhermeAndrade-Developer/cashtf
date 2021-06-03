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

            table#tabela_clicavel tr td{
                text-align: center;
            }
            .rodape_socio_procurador, .linha_rodape_analisar {
                display: none !important;
            }
        </style>

<div class="div_geral_socio_procurador">
    <header class="bordero-boletos fundo_azul_topo_bordero_cliente_resumo" style="position: sticky; top: 0;">
        <div class="container-fluid" style="padding-right: 0;">
            <div class="flex_pai_topo_azul_bordero_cliente">
                <div class="flex1">
                    <span class="fonte_empresa">CLIENTE | {{ isset($solicitante->Name)? $solicitante->Name : 'Nome Solicitante' }}</span>
                    <br>
                    <span class="numero_bordero">Borderô: {{ isset($solicitacao->id)? $solicitacao->id : '' }}</span>
                </div>

                <div class="flex1">
                    <div class="flex_end">
                        <a id="resumo" class="menu" href="{{route('cliente.resumo.bordero',$solicitacao->id)}}">
                            <i class="fa fa-file-text-o"></i> Resumo do Borderô
                        </a>

                        <a id="boletos" class="menu active" href="">
                            <i class="fa fa-barcode" aria-hidden="true"></i> Boletos
                        </a>

                        <a href="{{route('cliente.solicitacoes')}}"><i class="fa fa-times button-close" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="form_conta_recebimento mt80_bordero_cliente">
            <div class="fonte_bordero_cliente_conta_recebimento">
                CONTA PARA RECEBIMENTO
            </div>
            <div class="flexpai mt10">
                <div class="dflex2">
                    <label for="banco">BANCO</label>
                    <input type="text" id="banco" name="banco" class="banco" value="{{isset($conta->banco) ? $conta->banco : ''}}" readonly placeholder="Banco...">
                </div>
                <div class="ph10"></div>
                <div class="dflex1">
                    <label for="agencia">AGÊNCIA</label>
                    <input type="text" id="agencia" name="agencia" value="{{isset($conta->agencia) ? $conta->agencia : ''}}" readonly placeholder="Agência...">
                </div>
                <div class="ph10"></div>
                <div class="dflex1">
                    <label for="conta">CONTA</label>
                    <input type="text" id="conta" name="conta" value="{{isset($conta->conta) ? $conta->conta : ''}}" readonly placeholder="Conta...">
                </div>
                <div class="ph10"></div>
                <div class="dflex1">
                    <label for="digito">DIGITO</label>
                    <input type="text" id="digito" name="digito" value="{{isset($conta->digito) ? $conta->digito : ''}}" readonly placeholder="Digito...">
                </div>
                <div class="dflex1"></div>
                <div>@include('partials.bolinhas_steps')</div>

            </div>
        </div>
        <div class="div_pai_analisar_fichas" style="margin-top: 100px;">
            <div class="flexauto">
                <div class="background_azul">
                    <span class="fonte_branca" alt="{{$solicitacao->id_nota}}" title="{{$solicitacao->id_nota}}">
                        {{isset($id_nota_reduzida) ? $id_nota_reduzida : '$solicitacao->id_nota'}}
                    </span>
                </div>
            </div>
            <div class="dflex3">

            </div>
            <div class="dflex2">
                <div class="total_liquido_box">
                    TOTAL LÍQUIDO <b>R$ {{isset($solicitacao->valor_total_juros)? $solicitacao->valor_total_juros : ''}}</b>
                </div>
            </div>
        </div>
        <div class="div_linha_azul_analisar">
        </div>
        <div class="div_pai_analisar_fundo_azul_selecionada mt10 ">
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
                <span>TAC</span>
            </div>
            <div class="flex1_text_center">
                <span>VALOR A RECEBER</span>
            </div>
        </div>
        @foreach($parcelas as $parcela)
            @php
                $v_parcela  = str_replace('.', '', $parcela->valor_parcela);
                $v_parcela  = str_replace(',', '.', $v_parcela);
                $v_juros    = str_replace('.', '', $parcela->valor_juros);
                $v_juros    = str_replace(',', '.', $v_juros);
            @endphp
            <div class="{{ !($parcela->numero % 2) ? 'div_pai_analisar_fundo_cinza_selecionada' : 'div_pai_analisar_fundo_branco_selecionada'}}">
                <div class="flex1_text_center">
                    <span>{{ltrim($parcela->numero, '0')}}ª PARCELA</span>
                </div>
                <div class="flex1_text_center">
                    <span>{{$parcela->vencimento}}</span>
                </div>
                <div class="flex1_text_center">
                    <span>R$ {{$parcela->valor_parcela}}</span>
                </div>
                <div class="flex1_text_center">
                    <span>R$ {{number_format($v_parcela - $v_juros, 2, ',', '.')}}</span>
                </div>
                <div class="flex1_text_center">
                    <span>R$ 0,00</span>
                </div>
                <div class="flex1_text_center">
                    <span>R$ {{number_format($v_juros, 2, ',', '.')}}</span>
                </div>
            </div>
        @endforeach
        <div class="div_pai_solicitar_fundo_azul_selecionada">
            <div class="flex1_text_center">
            </div>
            <div class="flex1_text_center">
            </div>
            <div class="flex1_text_center">
            </div>
            <div class="flex1_text_center">
            </div>
            <div class="flex1_text_center">
                <span><b>TOTAL ANTECIPADO</b></span>
            </div>
            <div class="flex1_text_center">
                <span><b>JUROS TOTAL</b></span>
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
            </div>
            <div class="flex1_text_center">
                <span><b>R$ {{isset($solicitacao->valor_total)? $solicitacao->valor_total : ''}}</b></span>
            </div>
            <div class="flex1_text_center">
                <span><b>{{$solicitacao->juros}} %</b></span>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-12 text-left mt30">
                <span class="fonte_dados_do_sacado_title">
                    DADOS DO SACADO
                </span>
            </div>
        </div>
        <div class="form_socio_procurador mb150">
            <div class="flexpai mt20">
                <div class="dflex1">
                    <label for="cpfcnpj">CPF / CNPJ </label>
                    <input type="text" id="cpfcnpj" name="cpfcnpj" class="cpfcnpj" value="{{isset($sacado->cnpj) ? $sacado->cnpj : $sacado->cpf}}" readonly placeholder="CPF / CNPJ...">
                </div>
                <div class="ph10"></div>
                <div class="dflex2">
                    <label for="nomerazaosocial">NOME / RAZÃO SOCIAL </label>
                    <input type="text" id="nomerazaosocial" name="nomerazaosocial" value="{{isset($sacado->Name) ? $sacado->Name : ''}}" readonly placeholder="Nome / Razão Social...">
                </div>
                <div class="ph10"></div>
                <div class="dflex1">
                    <label for="emissao">EMISSÃO</label>
                    <input type="text" id="emissao" name="emissao" value="{{isset($solicitacao->data_emissao) ? $solicitacao->data_emissao : ''}}" readonly placeholder="Emissão...">
                </div>
            </div>
            <div class="flexpai mt20">
                <div class="dflexauto">
                    <label for="cep">CEP </label>
                    <input type="text" id="cep" name="cep" value="{{isset($endereco_sacado_juridica->Endereco_CEP) ? $endereco_sacado_juridica->Endereco_CEP : $endereco_sacado_fisica->Endereco_CEP}}" readonly placeholder="Cep...">
                </div>
                <div class="ph10"></div>
                <div class="dflexauto">
                    <label for="endereco">ENDEREÇO</label>
                    <input type="text" id="endereco" name="endereco" value="{{isset($endereco_sacado_juridica->Endereco_Lgr) ? $endereco_sacado_juridica->Endereco_Lgr :  $endereco_sacado_fisica->Endereco_Lgr}}" readonly placeholder="Endereço...">
                </div>
                <div class="ph10"></div>
                <div class="dflexauto">
                    <label for="nf">Nº </label>
                    <input type="text" id="numero" name="numero" value="{{isset($endereco_sacado_juridica->Endereco_Nro) ? $endereco_sacado_juridica->Endereco_Nro : $endereco_sacado_fisica->Endereco_Nro}}" readonly placeholder="Nº...">
                </div>
                <div class="ph10"></div>
                <div class="dflexauto">
                    <label for="complemento">COMPLEMENTO </label>
                    <input type="text" id="complemento" name="complemento" value="{{isset($endereco_sacado_juridica->Endereco_Complemento) ? $endereco_sacado_juridica->Endereco_Complemento : $endereco_sacado_fisica->Endereco_Complemento}}" readonly placeholder="Complemento..">
                </div>
                <div class="ph10"></div>
                <div class="dflexauto">
                    <label for="bairro">BAIRRO </label>
                    <input type="text" id="bairro" name="bairro" value="{{isset($endereco_sacado_juridica->Endereco_Bairro) ? $endereco_sacado_juridica->Endereco_Bairro : $endereco_sacado_fisica->Endereco_Bairro}}" readonly placeholder="Bairro..">
                </div>
                <div class="ph10"></div>
                <div class="dflexauto">
                    <label for="estado">UF </label>
                    <input type="text" id="estado" name="estado" value="{{isset($endereco_sacado_juridica->Endereco_UF) ? $endereco_sacado_juridica->Endereco_UF : $endereco_sacado_fisica->Endereco_UF}}" readonly placeholder="UF..">
                </div>
                <div class="ph10"></div>
                <div class="dflexauto">
                    <label for="municipio">MUNICÍPIO </label>
                    <input type="text" id="municipio" name="municipio" value="{{isset($endereco_sacado_juridica->Endereco_Mun) ? $endereco_sacado_juridica->Endereco_Mun : $endereco_sacado_fisica->Endereco_Mun}}" readonly placeholder="Bairro..">
                </div>
                <div class="ph10"></div>
                <div class="dflexauto">
                    <label for="telefone">TELEFONE </label>
                    <input type="text" id="telefone" name="telefone" class="telefone" value="{{isset($sacado->telefone) ? $sacado->telefone : ''}}" readonly placeholder="Telefone..">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="linha_rodape_analisar">

</div>
@endsection


