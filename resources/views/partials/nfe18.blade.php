    <style>
        input:-webkit-autofill {
            -webkit-text-fill-color: #000 !important;
        }
        #cpf:valid { background-color: #f11270; color: #fff; border: none; }
        #cpf:-webkit-autofill {
            -webkit-text-fill-color: #fff !important;
        }
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
                <div style="margin-right: 10px;" class="dflex1" ng-repeat="d in dados">
                    <div ng-class="ativo == $index ? 'background_azul' : 'background_cinza'" ng-click="trocaAtivo($index)">
                        <span ng-class="ativo == $index ? 'fonte_branca' : 'fonte_branca'" alt="<% d.idNota %>" title="<% d.idNota %>">
                            <% d.idNota_reduzida %>
                        </span>
                    </div>
                </div>
                <div class="ph5"></div>
                <!--<div class="flexauto">
                    <div class="background_cinza">
                        <span class="fonte_cinza">
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
                </div>-->
                <div class="dflex3">

                </div>
                <div class="dflex2">
                    <div ng-repeat="d in dados">
                        <div ng-show="ativo == $index">
                            <div class="total_liquido_box">
                                TOTAL L??QUIDO <b>R$ <% d.totalGeral.totalGeralJuros %></b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="div_linha_azul_analisar">
            </div>
            <div ng-repeat="d in dados">
                <div ng-show="ativo == $index">
                    <div class="div_pai_analisar_fundo_azul_selecionada mt10">
                        <div class="flex1_text_center">
                            <div ng-click="adicionaParcela($index)" class="fundo_plus">
                                <i class="fa fa-plus"></i>
                            </div>
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
                        <div ng-show="d.cobr.length >= 2" class="flex1_text_center">
                            <span>EXCLUIR</span>
                        </div>
                    </div>
                    <div ng-class="!($index % 2) ? 'div_pai_analisar_fundo_cinza_selecionada' : 'div_pai_analisar_fundo_branco_selecionada'" ng-repeat="linha in d.cobr">
                        <div class="flex1_text_center">
                            <span><% $index + 1 %>?? PARCELA</span>
                        </div>
                        <div class="flex1_text_center">
                            <input type="text" class="date" ng-model="linha.dVenc" placeholder="00/00/0000" ng-change="calculo($parent.$index, $index)">
                        </div>
                        <div class="flex1_text_center">
                            <input type="text" class="" ng-model="linha.vDup" ng-keyup="calculo($parent.$index, $index)">
                        </div>
                        <div class="flex1_text_center">
                            <span>R$ <% linha.vJurosReal %></span>
                        </div>
                        <div class="flex1_text_center">
                            <span>R$ <% d.totalGeral.tac %></span>
                        </div>
                        <div class="flex1_text_center">
                            <span>R$ <% linha.vTotal %></span>
                        </div>
                        <div ng-show="d.cobr.length >= 2" class="flex1_text_center">
                            <i class="fa fa-trash-o" ng-click="removeParcela($parent.$index,$index)"></i>
                        </div>
                    </div>
                    <!-- endforeach -->
                    <div class="div_pai_solicitar_fundo_azul_selecionada">
                        <div ng-show="d.cobr.length >= 2" class="flex1_text_center">
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
                        <div ng-show="d.cobr.length >= 2" class="flex1_text_center">
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
                            <span><b>R$ <% d.totalGeral.totalGeralSimples %></b></span>
                        </div>
                        <div class="flex1_text_center">
                            <span><b><% d.totalGeral.jurosAplicado %> %</b></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-left mt30">
                            <span class="fonte_dados_do_sacado_title">
                                DADOS DO SACADO
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form_socio_procurador mb150">
                                <div class="flexpai mt20">
                                    <div class="dflex1">
                                        <label for="cpfcnpj">CPF / CNPJ <span class="asteriscorosa">*</span></label>
                                        <input type="text" ng-if="d.dest.CPF" ng-model="d.dest.CPF" class="CPF" required placeholder="CPF / CNPJ...">
                                        <input type="text" ng-if="d.dest.CNPJ" ng-model="d.dest.CNPJ" class="cnpj" required placeholder="CPF / CNPJ...">
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex2">
                                        <label for="nomerazaosocial">NOME / RAZ??O SOCIAL <span class="asteriscorosa">*</span></label>
                                        <input type="text" ng-model="d.dest.xNome" placeholder="Nome / Raz??o Social...">
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex1">
                                        <label for="emissao">EMISS??O <span class="asteriscorosa">*</span></label>
                                        <input type="text" class="date" ng-model="d.ide.dhEmi" placeholder="Emiss??o...">
                                    </div>
                                </div>
                                <div class="flexpai mt20">
                                    <div class="dflexauto">
                                        <label for="cep">CEP <span class="asteriscorosa">*</span></label>
                                        <input type="text" class="cep" ng-blur="cepCliente()" ng-model="d.dest.CEP" required placeholder="Cep...">
                                    </div>
                                    <div class="ph10"></div>
                                    <div style="width: 300px;">
                                        <label for="endereco">ENDERE??O / RUA, AV., etc??? <span class="asteriscorosa">*</span></label>
                                        <input type="text" ng-model="d.dest.xLgr" placeholder="Endere??o...">
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflexauto">
                                        <label for="nf">N?? <span class="asteriscorosa">*</span></label>
                                        <input type="text"  ng-model="d.dest.nro" placeholder="N??...">
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflexauto">
                                        <label for="complemento">COMPLEMENTO</label>
                                        <input type="text" ng-model="d.dest.xCpl" placeholder="Complemento..">
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflexauto">
                                        <label for="bairro">BAIRRO <span class="asteriscorosa">*</span></label>
                                        <input type="text" ng-model="d.dest.xBairro" placeholder="Bairro..">
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflexauto">
                                        <label for="estado">UF <span class="asteriscorosa">*</span></label>
                                        <select ng-model="d.dest.UF" required>
                                            <option value="AC">Acre</option>
                                            <option value="AL">Alagoas</option>
                                            <option value="AP">Amap??</option>
                                            <option value="AM">Amazonas</option>
                                            <option value="BA">Bahia</option>
                                            <option value="CE">Cear??</option>
                                            <option value="DF">Distrito Federal</option>
                                            <option value="ES">Esp??rito Santo</option>
                                            <option value="GO">Goi??s</option>
                                            <option value="MA">Maranh??o</option>
                                            <option value="MT">Mato Grosso</option>
                                            <option value="MS">Mato Grosso do Sul</option>
                                            <option value="MG">Minas Gerais</option>
                                            <option value="PA">Par??</option>
                                            <option value="PB">Para??ba</option>
                                            <option value="PR">Paran??</option>
                                            <option value="PE">Pernambuco</option>
                                            <option value="PI">Piau??</option>
                                            <option value="RJ">Rio de Janeiro</option>
                                            <option value="RN">Rio Grande do Norte</option>
                                            <option value="RS">Rio Grande do Sul</option>
                                            <option value="RO">Rond??nia</option>
                                            <option value="RR">Roraima</option>
                                            <option value="SC">Santa Catarina</option>
                                            <option value="SP">S??o Paulo</option>
                                            <option value="SE">Sergipe</option>
                                            <option value="TO">Tocantins</option>
                                        </select>
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflexauto">
                                        <label for="municipio">MUNIC??PIO <span class="asteriscorosa">*</span></label>
                                        <input type="text" ng-model="d.dest.xMun" placeholder="Municipio..">
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflexauto">
                                        <label for="telefone">TELEFONE <span class="asteriscorosa">*</span></label>
                                        <input type="text" class="fone" ng-model="d.dest.fone" placeholder="Telefone..">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>