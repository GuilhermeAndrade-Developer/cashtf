
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

    /* tirando as setinhas do input number */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<form name="myForm3" class="div_geral_socio_procurador">
    <div class="container-fluid">
        <div class="row mt20">
            <div class="col-md-12 text-left">
                <i class="fa fa-search socio_procurador_icon" aria-hidden="true"></i>
                <span class="titulo_socio">CADASTRE UMA CONTA BANCÁRIA</span>
            </div>
            <div ng-show="admin == true" class="text-right" title="closebtn">
                <a href="{{route('admin.clientes')}}" target="_self">
                    <i class="fa fa-close icones"></i>
                </a>
		    </div>
        </div>
        <div class="row mt10">
            <div class="col-md-12">
                <div class="linha_socio_procurador">
                </div>
            </div>
        </div>
        
        <div class="row mt10">
            <div class="col-md-12">
                <div class="form_socio_procurador">
                    <div id="divContas" class="flexpai mt20" ng-repeat="c in contas">
                        <div style="width: 400px">
                            <label for="banco">BANCO<span class="asteriscorosa">*</span></label>
                            <select ng-model="c.banco" required>
                                <option value="001" ng-selected="c.banco == '001'">001 - Banco do Brasil</option>
                                <option value="002" ng-selected="c.banco == '002'">002 - Banco Central do Brasil</option>
                                <option value="003" ng-selected="c.banco == '003'">003 - Banco da Amazônia</option>
                                <option value="004" ng-selected="c.banco == '004'">004 - Banco do Nordeste do Brasil</option>
                                <option value="007" ng-selected="c.banco == '007'">007 - Banco Nacional de Desenvolvimento Econômico e Social</option>
                                <option value="104" ng-selected="c.banco == '104'">104 - Caixa Econômica Federal</option>
                                <option value="046" ng-selected="c.banco == '046'">046 - Banco Regional de Desenvolvimento do Extremo Sul</option>
                                <option value="000" ng-selected="c.banco == '000'">000 - Badesul</option>
                                <option value="000" ng-selected="c.banco == '000'">000 - Banco de Desenvolvimento do Espírito Santo</option>
                                <option value="023" ng-selected="c.banco == '023'">023 - Banco de Desenvolvimento de Minas Gerais</option>
                                <option value="070" ng-selected="c.banco == '070'">070 - Banco de Brasília</option>
                                <option value="047" ng-selected="c.banco == '047'">047 - Banco do Estado de Sergipe</option>
                                <option value="021" ng-selected="c.banco == '021'">021 - Banco do Estado do Espírito Santo</option>
                                <option value="037" ng-selected="c.banco == '037'">037 - Banco do Estado do Pará</option>
                                <option value="041" ng-selected="c.banco == '041'">041 - Banco do Estado do Rio Grande do Sul</option>
                                <option value="075" ng-selected="c.banco == '075'">075 - Banco ABN Amro S.A.</option>
                                <option value="025" ng-selected="c.banco == '025'">025 - Banco Alfa</option>
                                <option value="107" ng-selected="c.banco == '107'">107 - Banco BBM</option>
                                <option value="318" ng-selected="c.banco == '318'">318 - Banco BMG</option>
                                <option value="218" ng-selected="c.banco == '218'">218 - Banco Bonsucesso</option>
                                <option value="208" ng-selected="c.banco == '208'">208 - Banco BTG Pactual</option>
                                <option value="263" ng-selected="c.banco == '263'">263 - Banco Cacique</option>
                                <option value="473" ng-selected="c.banco == '473'">473 - Banco Caixa Geral - Brasil</option>
                                <option value="505" ng-selected="c.banco == '505'">505 - Banco Credit Suisse</option>
                                <option value="265" ng-selected="c.banco == '265'">265 - Banco Fator</option>
                                <option value="224" ng-selected="c.banco == '224'">224 - Banco Fibra</option>
                                <option value="121" ng-selected="c.banco == '121'">121 - Agibank</option>
                                <option value="612" ng-selected="c.banco == '612'">612 - Banco Guanabara</option>
                                <option value="604" ng-selected="c.banco == '604'">604 - Banco Industrial do Brasil</option>
                                <option value="653" ng-selected="c.banco == '653'">653 - Banco Indusval</option>
                                <option value="077" ng-selected="c.banco == '077'">077 - Banco Inter</option>
                                <option value="389" ng-selected="c.banco == '389'">389 - Banco Mercantil do Brasil</option>
                                <option value="389" ng-selected="c.banco == '389'">389 - Banco Luso Brasileiro</option>
                                <option value="746" ng-selected="c.banco == '746'">746 - Banco Modal</option>
                                <option value="738" ng-selected="c.banco == '738'">738 - Banco Morada</option>
                                <option value="623" ng-selected="c.banco == '623'">623 - Banco Pan</option>
                                <option value="611" ng-selected="c.banco == '611'">611 - Banco Paulista</option>
                                <option value="643" ng-selected="c.banco == '643'">643 - Banco Pine</option>
                                <option value="654" ng-selected="c.banco == '654'">654 - Banco Renner</option>
                                <option value="741" ng-selected="c.banco == '741'">741 - Banco Ribeirão Preto</option>
                                <option value="422" ng-selected="c.banco == '422'">422 - Banco Safra</option>
                                <option value="033" ng-selected="c.banco == '033'">033 - Banco Santander</option>
                                <option value="637" ng-selected="c.banco == '637'">637 - Banco Sofisa</option>
                                <option value="082" ng-selected="c.banco == '082'">082 - Banco Topázio</option>
                                <option value="655" ng-selected="c.banco == '655'">655 - Banco Votorantim</option>
                                <option value="237" ng-selected="c.banco == '237'">237 - Bradesco</option>
                                <option value="341" ng-selected="c.banco == '341'">341 - Itaú Unibanco</option>
                                <option value="212" ng-selected="c.banco == '212'">212 - Banco Original</option>
                                <option value="260" ng-selected="c.banco == '260'">260 - Nu Pagamentos S.A</option>
                                <option value="336" ng-selected="c.banco == '336'">336 - Banco C6 S.A.</option>
                                <option value="756" ng-selected="c.banco == '756'">756 - Banco Cooperativo do Brasil - BANCOOB</option>
                                <option value="748" ng-selected="c.banco == '748'">748 - Banco Cooperativo Sicredi - BANSICREDI</option>
                                <option value="136" ng-selected="c.banco == '136'">136 - Unicred</option>
                            </select>
                        </div>
                        <div class="ph10"></div>
                        <div style="width: 160px">
                            <label for="agencia">AGÊNCIA (sem dígito)<span class="asteriscorosa">*</span></label>
                            <input type="text" ng-model="c.agencia" required placeholder="    XXXX">
                        </div>
                        <div class="ph10"></div>
                        <div style="width: 170px">
                            <label for="conta">CONTA<span class="asteriscorosa">*</span></label>
                            <input type="text" ng-model="c.conta" required placeholder="    XXXXXX">
                        </div>
                        <div class="ph10"></div>
                        <div style="width: 50px">
                            <label for="digito">DIGITO<span class="asteriscorosa">*</span></label>
                            <input type="text" ng-model="c.digito" required placeholder="    X">
                        </div>
                        <div class="ph10"></div>
                        <div class="alinhalixeira">
                            <div class="fundolixeira" ng-show="contas.length > 1">
                                <i ng-click="removeCloneConta($index)" class="fa fa-trash-o iconelixeira"></i>
                            </div>
                        </div> 
                        <div class="dflex1"></div>
                    </div>   
                </div>
            </div>
        </div>

        <div class="row mt40 mb100">
            <div class="col-md-3">
                <button type="button" class="btn btn-primary botaoadicionarsocio" ng-click="appendClonedConta()">ADICIONAR OUTRA CONTA</button>
            </div>
        </div>
    </div>
</form>

