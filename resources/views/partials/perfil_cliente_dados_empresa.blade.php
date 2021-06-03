<style>
    input#cnpjcliente {
        background-color: #f11070;
        border: none;
        color: #FFF;
    }
    #cnpjcliente::-webkit-input-placeholder {
        color: #fff !important;
    }  
    input#razaosocialcliente {
        background-color: #f4f4f4;
        border: none;
    }  
    input#nomefantasiacliente{
        background-color: #f4f4f4;
        border: none;
    }  
    input#fundacaocliente{
        background-color: #f4f4f4;
        border: none;
    } 
    input#atividadepricipalcliente{
        background-color: #f4f4f4;
        border: none;
    }   
    input#atividadesecundariacliente{
        background-color: #f4f4f4;
        border: none;
    }   
    input#cepempresa{
        background-color: #f4f4f4;
        border: none;
    }
    input#enderecoempresa{
        background-color: #f4f4f4;
        border: none;
    }  
    input#numeroempresa{
        background-color: #f4f4f4;
        border: none;
    }  
    input#complementoempresa{
        background-color: #f4f4f4;
        border: none;
    }  
    input#bairroempresa{
        background-color: #f4f4f4;
        border: none;
    } 
    select#ufempresa{
        background-color: #f4f4f4;
        border: none;
        color: black;
    }  
    input#municipioempresa{
        background-color: #f4f4f4;
        border: none;
    } 
    select#paisempresa{
        background-color: #f4f4f4;
        border: none;
        color: black;
    }
    .linha_divide_perfil_cliente{
        background-color: #f11070;
        height: 1px;
        width: 100%;
    }
    .fundo_arquivos_cliente{
        padding: 3px;
        height: auto;
    }
    .fundo_arquivos_cliente input{
        height: auto;
        color: #FFF;
        background-color: #00a7ff;
        border: initial;
    }
    .form_socio_procurador .cor_fundo_icone_cliente{
        margin: auto;
        padding: auto;
        width: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .details-format{
        font-size: 12px;
        font-style: italic;
    }
</style>

<div class="form_socio_procurador">
    <div class="flexpai mt20">
        <div class="dflex1">
            <label for="cnpjcliente">CNPJ</label>
            <input type="text" id="cnpjcliente" class="cnpj" ng-model="empresa.cnpj" readonly placeholder="CNPJ...">
        </div>
        <div class="ph10"></div>
        <div class="dflex2">
            <label for="razaosocialcliente">RAZÃO SOCIAL</label>
            <input type="text" id="razaosocialcliente" ng-model="empresa.OfficialName" readonly placeholder="Razão...">
        </div>
        <div class="ph10"></div>
        <div class="dflex2">
            <label for="nomefantasiacliente">NOME FANTASIA</label>
            <input type="text" id="nomefantasiacliente" ng-model="empresa.TradeName" readonly placeholder="Nome...">
        </div>
        <div class="ph10"></div>
        <div class="dflex1">
            <label for="fundacaocliente">FUNDAÇÃO</label>
            <input type="text" id="fundacaocliente" class="date" ng-model="empresa.FoundedDate" readonly placeholder="00/00/0000">
        </div>
    </div>
    <div class="flexpai mt20">
        <div class="dflex1">
            <label for="atividadepricipalcliente">ATIVIDADE PRINCIPAL</label>
            <input type="text" id="atividadepricipalcliente" ng-model="empresa.mainActivity" readonly placeholder="Atividade Principal...">
        </div>
        <div class="ph10"></div>
        <div class="dflex1">
            <label for="atividadesecundariacliente">ATIVIDADES SECUNDÁRIAS</label>
            <input type="text" id="atividadesecundariacliente" ng-model="empresa.secondActivity" readonly placeholder="Atividade Secundária...">
        </div>
    </div>
    <div class="flexpai mt20">
        <div class="dflex1">
            <label for="cepempresa">CEP</label>
            <input type="text" id="cepempresa" class="cep" ng-blur="cepEmpresa()" ng-model="empresa.Address.Endereco_CEP" readonly placeholder="CEP...">
        </div>
        <div class="ph10"></div>
        <div class="dflex3">
            <label for="enderecoempresa">ENDEREÇO / RUA, AV., etc… </label>
            <input type="text" id="enderecoempresa" ng-model="empresa.Address.Endereco_Lgr" readonly placeholder="Rua ....">
        </div>
        <div class="ph10"></div>
        <div class="dflex1">
            <label for="numeroempresa">Nº</label>
            <input type="text" id="numeroempresa" ng-model="empresa.Address.Endereco_Nro" readonly placeholder="Nº...">
        </div>
        <div class="ph10"></div>
        <div class="dflex1">
            <label for="complementoempresa">COMPLEMENTO</label>
            <input type="text" id="complementoempresa" readonly ng-model="empresa.Address.Endereco_Complemento">
        </div>
        <div class="ph10"></div>
        <div class="dflex1">
            <label for="bairroempresa">BAIRRO</label>
            <input type="text" id="bairroempresa" ng-model="empresa.Address.Endereco_Bairro" readonly placeholder="Bairro...">
        </div>
        <div class="ph10"></div>
        <div class="dflex1">
            <label for="ufempresa">UF</label>
            <select ng-model="empresa.Address.Endereco_UF" id="ufempresa" readonly disabled>
                <option value="AC">Acre</option>
                <option value="AL">Alagoas</option>
                <option value="AP">Amapá</option>
                <option value="AM">Amazonas</option>
                <option value="BA">Bahia</option>
                <option value="CE">Ceará</option>
                <option value="DF">Distrito Federal</option>
                <option value="ES">Espírito Santo</option>
                <option value="GO">Goiás</option>
                <option value="MA">Maranhão</option>
                <option value="MT">Mato Grosso</option>
                <option value="MS">Mato Grosso do Sul</option>
                <option value="MG">Minas Gerais</option>
                <option value="PA">Pará</option>
                <option value="PB">Paraíba</option>
                <option value="PR">Paraná</option>
                <option value="PE">Pernambuco</option>
                <option value="PI">Piauí</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="RN">Rio Grande do Norte</option>
                <option value="RS">Rio Grande do Sul</option>
                <option value="RO">Rondônia</option>
                <option value="RR">Roraima</option>
                <option value="SC">Santa Catarina</option>
                <option value="SP">São Paulo</option>
                <option value="SE">Sergipe</option>
                <option value="TO">Tocantins</option>
            </select>
        </div>
        <div class="ph10"></div>
        <div class="dflex1">
            <label for="municipioempresa">MUNICÍPIO</label>
            <input type="text" id="municipioempresa" ng-model="empresa.Address.Endereco_Mun" readonly placeholder="Município...">
        </div>
        <div class="ph10"></div>
        <div class="dflex1">
            <label for="paisempresa">PAÍS</label>
            <select ng-model="empresa.Address.Endereco_Pais" id="paisempresa" readonly disabled placeholder="País..">
                @foreach(config('enum.paises') as $value => $name)
                    <option value="{{ $value }}">
                            {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mt40">
        <div class="col-md-12">
            <div class="linha_divide_perfil_cliente">
            </div>
        </div>
    </div>
</div>
<div class="row mt30">
    <div class="col-md-12 text-left">
        <span class="fonte_arquivos_cliente">ARQUIVOS</span>
    </div>
</div>
<div class="row mt10">
    <div class="col-md-12 text-left">
        CASO HAJA ALGUMA ALTERAÇÃO, <b>ADICIONE OS ARQUIVOS MAIS RECENTES</b>
    </div>
</div>
<div class="form_socio_procurador mt40 mb150">
    <div class="flexpai mt20">
        <div class="dflex1">
            <label for="contratoSocial">CONTRATO SOCIAL OU CONTRATO SOCIAL CONSOLIDADO</label>
            <div class="fundo_arquivos_cliente">
                <input type="file" id="contratoSocial" file-model="contratoSocial" class="filecontratoSocial" required placeholder="Incluir...">
                <div class="flex_fundo_icone_cliente">
                    <span class="cor_fundo_icone_cliente">
                        <i class="las la-cloud-upload-alt estilo_icone_download_cliente"></i> 
                    </span>
                </div>
            </div>
            <div class="details-format">
                Arquivos no formato: PDF, JPG, PNG
            </div>
        </div>
        <div class="ph10"></div>
        <div class="dflex1">
            <label for="faturamento">FATURAMENTO DOS ÚLTIMOS 12 MESES</label>
            <div class="fundo_arquivos_cliente">
                <input type="file" id="faturamento" file-model="faturamento" class="filefaturamento" required placeholder="Incluir...">
                <div class="flex_fundo_icone_cliente">
                    <span class="cor_fundo_icone_cliente">
                        <i class="las la-cloud-upload-alt estilo_icone_download_cliente"></i> 
                    </span>
                </div>
            </div>
            <div class="details-format">
                Arquivos no formato: PDF, JPG, PNG
            </div>
        </div>
        <div class="ph10"></div>
        <div class="dflex1">
            <label for="alteracoesContratuais">ALTERAÇÕES CONTRATUAIS</label>
            <div class="fundo_arquivos_cliente">
                <input type="file" id="alteracoesContratuais" file-model="alteracoesContratuais" class="filealteracoesContratuais" required placeholder="Incluir..">
                <div class="flex_fundo_icone_cliente">
                    <span class="cor_fundo_icone_cliente">
                        <i class="las la-cloud-upload-alt estilo_icone_download_cliente"></i> 
                    </span>
                </div>
            </div>
            <div class="details-format">
                Arquivos no formato: PDF, JPG, PNG
            </div>
        </div>
    </div>
</div>