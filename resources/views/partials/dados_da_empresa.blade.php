<style>
    input:-webkit-autofill {
        -webkit-text-fill-color: #000 !important;
    }
    #cpf:valid { background-color: #f11270; color: #fff; border: none; }
    #cpf:-webkit-autofill {
        -webkit-text-fill-color: #fff !important;
    }
    #contratoSocial:valid { background-color: #1ca7fc; color: #fff; border: none; } 
    #alteracoesContratuais:valid { background-color: #1ca7fc; color: #fff; border: none; }
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

<form name="myForm2" class="div_geral_socio_procurador">
    <div class="container-fluid">
        <div class="row mt20">
            <div class="col-md-12 text-left">
                <i class="fa fa-search socio_procurador_icon" aria-hidden="true"></i>
                <span class="titulo_socio">DADOS DA EMPRESA</span>
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
            <div class="col-md-6 col-xs-12 col-sm-12 text-left">
                <span class="subtitulo_socio_procurador">PESSOA JURÍDICA</span>
            </div>
            <div class="col-md-6 col-xs-12 col-sm-12 text-right">
                <span class="fonte_obrigatorios">*campos obrigatórios</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form_socio_procurador">
                    <div class="flexpai mt20">
                        <div class="dflex1">
                            <label for="cnpj">CNPJ <span class="asteriscorosa">*</span></label>
                            <input type="text" id="cnpj" ng-change="consultaCNPJUser()" ng-model="cnpj" class="cnpj" required placeholder="CNPJ...">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex2">
                            <label for="razaoSocial">RAZÃO SOCIAL <span class="asteriscorosa">*</span></label>
                            <input type="text" id="razaoSocial" ng-model="dataPessoaJuridica.OfficialName" required placeholder="Razão Social...">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex2">
                            <label for="nomeFantasia">NOME FANTASIA</label>
                            <input type="text" id="nomeFantasia" ng-model="dataPessoaJuridica.TradeName" placeholder="Nome Fantasia...">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex1">
                            <label for="fundacao">FUNDAÇÃO <span class="asteriscorosa">*</span></label>
                            <input type="text" id="fundacao" class="date" ng-model="dataPessoaJuridica.FoundedDate" required placeholder="Fundação...">
                        </div>
                    </div>
                    <div class="flexpai mt20">
                        <div class="dflex1">
                            <label for="mainActivity">ATIVIDADE PRINCIPAL <span class="asteriscorosa">*</span></label>
                            <input type="text" id="mainActivity" ng-model="dataPessoaJuridica.mainActivity" required placeholder="Atividade Principal...">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex1">
                            <label for="secondActivity">ATIVIDADES SECUNDÁRIAS</label>
                            <input type="text" id="secondActivity" ng-model="dataPessoaJuridica.secondActivity" placeholder="Atividades Secundárias...">
                        </div>
                    </div>
                    <div class="flexpai mt20">
                        <div class="dflex1">
                            <label for="cepJuridica">CEP <span class="asteriscorosa">*</span></label>
                            <input type="text" ng-model="dataPessoaJuridica.Address.ZipCode" ng-blur="cepEmpresa()" class="cep" required placeholder="Cep...">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex3">
                            <label for="streetJuridica">ENDEREÇO / RUA, AV., etc… <span class="asteriscorosa">*</span></label>
                            <input type="text" id="streetJuridica" ng-model="dataPessoaJuridica.Address.AddressMain" required placeholder="Endereço...">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex1">
                            <label for="numberJuridica">Nº <span class="asteriscorosa">*</span></label>
                            <input type="text" id="numberJuridica" ng-model="dataPessoaJuridica.Address.Number" required placeholder="Nº...">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex1">
                            <label for="complementJuridica">COMPLEMENTO</label>
                            <input type="text" id="complementJuridica" ng-model="dataPessoaJuridica.Address.Complement" placeholder="Complemento..">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex1">
                            <label for="neighborJuridica">BAIRRO <span class="asteriscorosa">*</span></label>
                            <input type="text" id="neighborJuridica" ng-model="dataPessoaJuridica.Address.Neighborhood" required placeholder="Bairro..">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex1">
                            <label for="ufJuridica">UF <span class="asteriscorosa">*</span></label>
                            <select ng-model="dataPessoaJuridica.Address.State" id="ufJuridica" required>
                                <option class="upper-select" value="AC">ACRE</option>
                                <option class="upper-select" value="AL">ALAGOAS</option>
                                <option class="upper-select" value="AP">AMAPÁ</option>
                                <option class="upper-select" value="AM">AMAZONAS</option>
                                <option class="upper-select" value="BA">BAHIA</option>
                                <option class="upper-select" value="CE">CEARÁ</option>
                                <option class="upper-select" value="DF">DISTRITO FEDERAL</option>
                                <option class="upper-select" value="ES">ESPÍRITO SANTO</option>
                                <option class="upper-select" value="GO">GOIÁS</option>
                                <option class="upper-select" value="MA">MARANHÃO</option>
                                <option class="upper-select" value="MT">MATO GROSSO</option>
                                <option class="upper-select" value="MS">MATO GROSSO DO SUL</option>
                                <option class="upper-select" value="MG">MINAS GERAIS</option>
                                <option class="upper-select" value="PA">PARÁ</option>
                                <option class="upper-select" value="PB">PARAÍBA</option>
                                <option class="upper-select" value="PR">PARANÁ</option>
                                <option class="upper-select" value="PE">PERNAMBUCO</option>
                                <option class="upper-select" value="PI">PIAUÍ</option>
                                <option class="upper-select" value="RJ">RIO DE JANEIRO</option>
                                <option class="upper-select" value="RN">RIO GRANDE DO NORTE</option>
                                <option class="upper-select" value="RS">RIO GRANDE DO SUL</option>
                                <option class="upper-select" value="RO">RONDÔNIA</option>
                                <option class="upper-select" value="RR">RORAIMA</option>
                                <option class="upper-select" value="SC">SANTA CATARINA</option>
                                <option class="upper-select" value="SP">SÃO PAULO</option>
                                <option class="upper-select" value="SE">SERGIPE</option>
                                <option class="upper-select" value="TO">TOCANTINS</option>
                            </select>
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex1">
                            <label for="cityJuridica">MUNICÍPIO <span class="asteriscorosa">*</span></label>
                            <input type="text" id="cityJuridica" ng-model="dataPessoaJuridica.Address.City" required placeholder="Município..">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex1">
                            <label for="countryJuridica">PAÍS <span class="asteriscorosa">*</span></label>
                            <select ng-model="dataPessoaJuridica.Address.Country" id="countryJuridica" required placeholder="País..">
                                @foreach(config('enumpj.paises') as $value => $name)
                                    <option class="upper-select" value="{{ $value }}">
                                            {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt40">
            <div class="col-md-12">
                <div class="linha_socio_procurador">
                </div>
            </div>
        </div>
        <div class="row mt20">
            <div class="col-md-12 text-left">
                <span class="subtitulo_socio_procurador">ARQUIVOS</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-left">
                <span class="preencherdadossocios">
                    VOCÊ DEVERÁ INCLUIR ARQUIVOS DE CONTRATO SOCIAL CONSOLIDADO OU CONTRATO SOCIAL E SUAS ALTERAÇÕES / 
                    FATURAMENTO DOS ÚLTIMOS 12 MESES ASSINADO PELO <b>CONTADOR E SÓCIO ADMINISTRADOR.</b>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form_socio_procurador mt40 mb150">
                    <div class="flexpai mt20">
                        <div class="dflex1">
                            <label for="contratoSocial">CONTRATO SOCIAL OU CONTRATO SOCIAL CONSOLIDADO <span class="asteriscorosa">*</span></label>
                            <input type="file" id="contratoSocial" file-model="contratoSocial" class="filecontratoSocial" placeholder="Incluir..." required>
                            <label for="contratoSocial">Arquivos no formato: .PDF, .JPG, .PNG</label>
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex1">
                            <label for="faturamento">FATURAMENTO DOS ÚLTIMOS 12 MESES <span class="asteriscorosa">*</span></label>
                            <input type="file" id="faturamento" file-model="faturamento" class="filefaturamento" placeholder="Incluir..." required>
                            <label for="contratoSocial">Arquivos no formato: .PDF, .JPG, .PNG </label>
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex1">
                            <label for="alteracoesContratuais">ALTERAÇÕES CONTRATUAIS </label>
                            <input type="file" id="alteracoesContratuais" file-model="alteracoesContratuais" class="filealteracoesContratuais" placeholder="Incluir.." required>
                            <label for="contratoSocial">Arquivos no formato: .PDF, .JPG, .PNG </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>