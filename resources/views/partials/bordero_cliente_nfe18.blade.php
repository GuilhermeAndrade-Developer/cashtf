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
    <div class="fundo_azul_topo_bordero_cliente">
        <div class="container-fluid">
            <div class="flex_pai_topo_azul_bordero_cliente">
                <div class="flex1">
                    <span class="fonte_empresa">Peexell Digital Solutions Ltda. ME</span><br>
                    <span class="numero_bordero">BORDERÔ: 00114</span>
                </div>
                <div class="flex1">
                    <div class="flex_end">
                        <i class="fa fa-file-text-o icon_file" aria-hidden="true"></i>
                        <span class="resumo_bordero">Resumo do Borderô</span>
                        <i class="fa fa-times icone_fechar" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="form_conta_recebimento mt80_bordero_cliente">
            <div class="fonte_bordero_cliente_conta_recebimento">
                CONTA PARA RECEBIMENTO
            </div>
            <div class="flexpai mt10">
                <div class="dflex2">
                    <label for="banco">BANCO</label>
                    <input type="text" id="banco" name="banco" class="banco" required placeholder="Banco...">
                </div>
                <div class="ph10"></div>
                <div class="dflex1">
                    <label for="agencia">AGÊNCIA</label>
                    <input type="text" id="agencia" name="agencia" placeholder="Agência...">
                </div>
                <div class="ph10"></div>
                <div class="dflex1">
                    <label for="conta">CONTA</label>
                    <input type="text" id="conta" name="conta" placeholder="Conta...">
                </div>
                <div class="ph10"></div>
                <div class="dflex1">
                    <label for="digito">DIGITO</label>
                    <input type="text" id="digito" name="digito" placeholder="Digito...">
                </div>
                <div class="dflex1"></div>
                <div>@include('partials.bolinhas_steps')</div>
                
            </div>
        </div>
        <div class="div_pai_analisar_fichas" style="margin-top: 100px;">
            <div class="flexauto">
                <div class="background_azul">
                    <span class="fonte_branca">
                        NFE18
                    </span>
                </div>
            </div>
            <div class="ph5"></div>
            <div class="flexauto">
                <div class="background_vermelho">
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
                    TOTAL LÍQUIDO <b>R$ 4.338,85</b>
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
            <div class="flex1_text_center">
                
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
                <span>R$29,85</span>
            </div>
            <div class="flex1_text_center">
                <span>R$4,44</span>
            </div>
            <div class="flex1_text_center">
                <span>R$ 470,00</span>
            </div>
            <div class="flex1_text_center">
               
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
                <span>R$29,85</span>
            </div>
            <div class="flex1_text_center">
                <span>R$4,44</span>
            </div>
            <div class="flex1_text_center">
                <span>R$ 470,00</span>
            </div>
            <div class="flex1_text_center">
                
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
                <span>R$29,85</span>
            </div>
            <div class="flex1_text_center">
                <span>R$4,44</span>
            </div>
            <div class="flex1_text_center">
                <span>R$ 470,00</span>
            </div>
            <div class="flex1_text_center">
                
            </div>
        </div>
	
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
            </div>
            <div class="flex1_text_center">
                <span><b>TOTAL ANTECIPADO</b></span>
            </div>
            <div class="flex1_text_center">
                <span><b>JUROS</b></span>
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
            </div>
            <div class="flex1_text_center">
                <span><b>R$ 1.470,15</b></span>
            </div>
            <div class="flex1_text_center">
                <span><b>1,99%</b></span>
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
                    <label for="cpfcnpj">CPF / CNPJ <span class="asteriscorosa">*</span></label>
                    <input type="text" id="cpfcnpj" name="cpfcnpj" class="cpfcnpj" required placeholder="CPF / CNPJ...">
                </div>
                <div class="ph10"></div>
                <div class="dflex2">
                    <label for="nomerazaosocial">NOME / RAZÃO SOCIAL <span class="asteriscorosa">*</span></label>
                    <input type="text" id="nomerazaosocial" name="nomerazaosocial" placeholder="Nome / Razão Social...">
                </div>
                <div class="ph10"></div>
                <div class="dflex1">
                    <label for="emissao">EMISSÃO</label>
                    <input type="text" id="emissao" name="emissao" placeholder="Emissão...">
                </div>
            </div>
            <div class="flexpai mt20">
                <div class="dflexauto">
                    <label for="cep">CEP <span class="asteriscorosa">*</span></label>
                    <input type="text" id="cep" name="cep" required placeholder="Cep...">
                </div>
                <div class="ph10"></div>
                <div class="dflexauto">
                    <label for="endereco">ENDEREÇO<span class="asteriscorosa">*</span></label>
                    <input type="text" id="endereco" name="endereco" placeholder="Endereço...">
                </div>
                <div class="ph10"></div>
                <div class="dflexauto">
                    <label for="nf">Nº <span class="asteriscorosa">*</span></label>
                    <input type="text" id="numero" name="numero" placeholder="Nº...">
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
                        <option value="SP">São Paulo</option>
                        <option value="RJ">Rio de Janeiro</option>
                    </select>
                </div>
                <div class="ph10"></div>
                <div class="dflexauto">
                    <label for="municipio">MUNICÍPIO <span class="asteriscorosa">*</span></label>
                    <select name="municipio" id="municipio">
                        <option value="São Paulo">São Paulo</option>
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
<div class="linha_rodape_analisar">
   
</div>
@endsection


