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
        <div class="row mt10">
            <div class="col-md-12 text-left">
                <i class="fa fa-plus-square-o socio_procurador_icon" aria-hidden="true"></i>
                <span class="titulo_socio">SOLICITAR</span>
            </div>
        </div>
        <div class="row mt10">
            <div class="col-md-12">
                <div class="linha_socio_procurador">
                </div>
            </div>
        </div>
        <div class="div_pai_analisar_fichas mt50">
            <div class="flexauto">
                <div class="background_cinza">
                    <span class="fonte_cinza">
                        NFE18
                    </span>
                </div>
            </div>
            <div class="ph5"></div>
            <div class="flexauto">
                <div class="background_azul">
                    <span class="fonte_branca">
                        NFE19
                    </span>
                </div>
            </div>
            <div class="ph5"></div>
            <div class="flexauto">
                <div class="background_cinza">
                    <span class="fonte_cinza">
                        NFE20
                    </span>
                </div>
            </div>
            <div class="dflex3">
            
            </div>
            <div class="dflex2">
                <div class="total_liquido_box">
                    TOTAL L??QUIDO <b>R$ 4.338,85</b>
                </div>

            </div>
        </div>
        <div class="div_linha_azul_analisar">
        </div>
        <div class="div_pai_analisar_fundo_azul_selecionada mt10 ">
            <div class="fundo_plus">
                <i class="fa fa-plus"></i>
            </div>
            <div class="flex1_text_center">
                <div>PARCELAS</div>
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
            <div class="flex1_text_center">
                <span>EXCLUIR</span>
            </div>
        </div>
        <div class="div_pai_analisar_fundo_branco_selecionada">
            <div class="w30h30"></div>
            <div class="flex1_text_center">
                <span>1?? PARCELA</span>
            </div>
            <div class="flex1_text_center">
                <input type="text" id="vencimento" name="vencimento" class="vencimento" required placeholder="00/00/0000">
            </div>
            <div class="flex1_text_center">
                <input type="text" id="valor_parcela" name="valor_parcela" class="valor_parcela" required placeholder="R$ 00,00">
            </div>
            <div class="flex1_text_center">
                <span>R$29,85</span>
            </div>
            <div class="flex1_text_center">
                <span>R$4,44</span>
            </div>
            <div class="flex1_text_center">
                <span>R$ 470,00</span>
            </div>
            <div class="flex1_text_center">
                <i class="fa fa-trash-o"></i>
            </div>
        </div>
        <div class="div_pai_analisar_fundo_cinza_selecionada ">
            <div class="w30h30"></div>
            <div class="flex1_text_center">
                <span>2?? PARCELA</span>
            </div>
            <div class="flex1_text_center">
                <input type="text" id="vencimento" name="vencimento" class="vencimento" required placeholder="00/00/0000">
            </div>
            <div class="flex1_text_center">
                <input type="text" id="valor_parcela" name="valor_parcela" class="valor_parcela" required placeholder="R$ 00,00">
            </div>
            <div class="flex1_text_center">
                <span>R$29,85</span>
            </div>
            <div class="flex1_text_center">
                <span>R$4,44</span>
            </div>
            <div class="flex1_text_center">
                <span>R$ 470,00</span>
            </div>
            <div class="flex1_text_center">
                <i class="fa fa-trash-o"></i>
            </div>
        </div>
        <div class="div_pai_analisar_fundo_branco_selecionada">
            <div class="w30h30"></div>
            <div class="flex1_text_center">
                <span>3?? PARCELA</span>
            </div>
            <div class="flex1_text_center">
                <input type="text" id="vencimento" name="vencimento" class="vencimento" required placeholder="00/00/0000">
            </div>
            <div class="flex1_text_center">
                <input type="text" id="valor_parcela" name="valor_parcela" class="valor_parcela" required placeholder="R$ 00,00">
            </div>
            <div class="flex1_text_center">
                <span>R$29,85</span>
            </div>
            <div class="flex1_text_center">
                <span>R$4,44</span>
            </div>
            <div class="flex1_text_center">
                <span>R$ 470,00</span>
            </div>
            <div class="flex1_text_center">
                <i class="fa fa-trash-o"></i>
            </div>
        </div>
	
        <div class="div_pai_solicitar_fundo_azul_selecionada">
            <div class="w30h30"></div>
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
                <span><b>TOTAL ANTECIPADO</b></span>
            </div>
            <div class="flex1_text_center">
                <span><b>JUROS</b></span>
            </div>
        </div>
        <div class="div_pai_analisar_fundo_rosa_selecionada">
            <div class="w30h30"></div>
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
                <span><b>R$ 1.470,15</b></span>
            </div>
            <div class="flex1_text_center">
                <span><b>1,99%</b></span>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-12 text-left mt50">
                <span class="fonte_dados_do_sacado_title">
                    DADOS DO SACADO
                </span>
            </div>
        </div>
        <div class="form_socio_procurador mb150">
            <div class="flexpai mt20">
                <div class="dflex1">
                    <label for="cpfcnpj">CPF / CNPJ <span class="asteriscorosa">*</span></label>
                    <input type="text" id="cpfcnpj" name="cpfcnpj" class="cpfcnpj" required placeholder="CPF / CNPJ...">
                </div>
                <div class="ph10"></div>
                <div class="dflex2">
                    <label for="nomerazaosocial">NOME / RAZ??O SOCIAL <span class="asteriscorosa">*</span></label>
                    <input type="text" id="nomerazaosocial" name="nomerazaosocial" placeholder="Nome / Raz??o Social...">
                </div>
                <div class="ph10"></div>
                <div class="dflex1">
                    <label for="emissao">EMISS??O</label>
                    <input type="text" id="emissao" name="emissao" placeholder="Emiss??o...">
                </div>
            </div>
            <div class="flexpai mt20">
                <div class="dflexauto">
                    <label for="cep">CEP <span class="asteriscorosa">*</span></label>
                    <input type="text" id="cep" name="cep" required placeholder="Cep...">
                </div>
                <div class="ph10"></div>
                <div class="dflexauto">
                    <label for="endereco">ENDERE??O<span class="asteriscorosa">*</span></label>
                    <input type="text" id="endereco" name="endereco" placeholder="Endere??o...">
                </div>
                <div class="ph10"></div>
                <div class="dflexauto">
                    <label for="nf">N?? <span class="asteriscorosa">*</span></label>
                    <input type="text" id="numero" name="numero" placeholder="N??...">
                </div>
                <div class="ph10"></div>
                <div class="dflexauto">
                    <label for="complemento">COMPLEMENTO <span class="asteriscorosa">*</span></label>
                    <input type="text" id="complemento" name="complemento" placeholder="Complemento..">
                </div>
                <div class="ph10"></div>
                <div class="dflexauto">
                    <label for="bairro">BAIRRO <span class="asteriscorosa">*</span></label>
                    <input type="text" id="bairro" name="bairro" placeholder="Bairro..">
                </div>
                <div class="ph10"></div>
                <div class="dflexauto">
                    <label for="estado">UF <span class="asteriscorosa">*</span></label>
                    <select name="estado" id="estado">
                        <option value="SP">S??o Paulo</option>
                        <option value="RJ">Rio de Janeiro</option>
                    </select>
                </div>
                <div class="ph10"></div>
                <div class="dflexauto">
                    <label for="municipio">MUNIC??PIO <span class="asteriscorosa">*</span></label>
                    <select name="municipio" id="municipio">
                        <option value="S??o Paulo">S??o Paulo</option>
                        <option value="Rio de Janeiro">Rio de Janeiro</option>
                    </select>
                </div>
                <div class="ph10"></div>
                <div class="dflexauto">
                    <label for="telefone">TELEFONE <span class="asteriscorosa">*</span></label>
                    <input type="text" id="telefone" name="telefone" placeholder="Telefone..">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="fundorodapesteps">
    <div class="container-fluid alinhaconteudo">
        <div class="flexpai">
            <div class="dflexaligncenter">
                <i class="fa fa-caret-left iconeproximo"></i>
                <span class="fonteproximo">VOLTAR</span>
            </div>
            <div class="flexbolinhas">
                <div class="bolinhapreenchida"></div>  
                <div class="bolinhavazia mh10"></div>
                <div class="bolinhavazia"></div>
            </div>
            <div class="divflexend">
                
            </div>
        </div>
    </div>
</div>
@endsection


