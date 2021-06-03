<style>
    .control {
        font-family: arial;
        display: block;
        position: relative;
        padding-left: 30px;
        margin-bottom: 5px;
        padding-top: 3px;
        cursor: pointer;
        font-size: 16px;
    }
    .control input {
        position: absolute;
        z-index: -1;
        opacity: 0;
    }
    .control_indicator {
        position: absolute;
        top: 6px;
        left: 0;
        height: 20px;
        width: 20px;
        background: #ffffff;
        border: 1px solid #a4a4a4;
        border-radius: undefinedpx;
    }
    .control:hover input ~ .control_indicator,
    .control input:focus ~ .control_indicator {
        background: #ffffff;
    }

    .control input:checked ~ .control_indicator {
        background: #ffffff;
    }
    .control:hover input:not([disabled]):checked ~ .control_indicator,
    .control input:checked:focus ~ .control_indicator {
        background: #ffffff;
    }
    .control input:disabled ~ .control_indicator {
        background: #e6e6e6;
        opacity: 0;
        pointer-events: none;
    }
    .control_indicator:after {
        box-sizing: unset;
        content: '';
        position: absolute;
        display: none;
    }
    .control input:checked ~ .control_indicator:after {
        display: block;
    }
    .control-radio .control_indicator {
        border-radius: 50%;
    }

    .control-radio .control_indicator:after {
        left: 3px;
        top: 3px;
        height: 12px;
        width: 12px;
        border-radius: 50%;
        background: #a4a4a4;
        transition: background 250ms;
    }
    .control-radio input:disabled ~ .control_indicator:after {
        background: #7b7b7b;
    }.control-radio .control_indicator::before {
        content: '';
        display: block;
        position: absolute;
        left: 0;
        top: 0;
        width: 4.5rem;
        height: 4.5rem;
        margin-left: -1.3rem;
        margin-top: -1.3rem;
        background: #2aa1c0;
        border-radius: 3rem;
        opacity: 0.6;
        z-index: 99999;
        transform: scale(0);
    }
    @keyframes s-ripple {
        0% {
            opacity: 0;
            transform: scale(0);
        }
        20% {
            transform: scale(1);
        }
        100% {
            opacity: 0.01;
            transform: scale(1);
        }
    }
    @keyframes s-ripple-dup {
    0% {
        transform: scale(0);
        }
    30% {
            transform: scale(1);
        }
        60% {
            transform: scale(1);
        }
        100% {
            opacity: 0;
            transform: scale(1);
        }
    }
    .control-radio input + .control_indicator::before {
        animation: s-ripple 250ms ease-out;
    }
    .control-radio input:checked + .control_indicator::before {
        animation-name: s-ripple-dup;
    }
    input:-webkit-autofill {
    -webkit-text-fill-color: #000 !important;
    }
    #cpf:valid { background-color: #f11270; color: #fff; border: none; }
    #cpf:-webkit-autofill {
    -webkit-text-fill-color: #fff !important;
    }
    #digitalize:valid { background-color: #1ca7fc; color: #fff; border: none; }
    
    input#cpfcliente{
        background-color: #f11070;
        border: none;
    }
    #cpfcliente::-webkit-input-placeholder {
        color: #fff !important;
    }  
    input#rgcliente {
        background-color: #f4f4f4;
        border: none;
    }  
    input#orgaoemissorcliente {
        background-color: #f4f4f4;
        border: none;
    } 
    input#namecliente {
        background-color: #f4f4f4;
        border: none;
    } 
    select#nacionalidadecliente {
        background-color: #f4f4f4;
        border: none;
        color: black;
    }  
    input#passaportecliente {
        background-color: #f4f4f4;
        border: none;
    } 
    input#digitalizecliente {
        background-color: #bfbfbf;
        border: none;
    }
    #digitalizecliente::-webkit-input-placeholder {
        color: #fff !important;
    }  
    input#nascimentocliente {
        background-color: #f4f4f4;
        border: none;
    } 
    select#generocliente {
        background-color: #f4f4f4;
        border: none;
        color: black;
    } 
    input#emailcliente {
        background-color: #f4f4f4;
        border: none;
    } 
    select#estadocivilcliente {
        background-color: #f4f4f4;
        border: none;
        color: black;
    } 
    input#cepcliente {
        background-color: #f4f4f4;
        border: none;
    } 
    input#enderecocliente {
        background-color: #f4f4f4;
        border: none;
    } 
    input#numerocliente {
        background-color: #f4f4f4;
        border: none;
    }  
    input#complementocliente {
        background-color: #f4f4f4;
        border: none;
    }  
    input#bairrocliente {
        background-color: #f4f4f4;
        border: none;   
    }  
    select#ufcliente{
        background-color: #f4f4f4;
        border: none;   
        color: black;
    } 
    input#municipiocliente{
        background-color: #f4f4f4;
        border: none;   
    } 
    select#paiscliente{
        background-color: #f4f4f4;
        border: none;   
        color: black;
    } 
    input#ccpf{
        background-color: #f11070;
        border: none;
    }
    #ccpf::-webkit-input-placeholder {
        color: #fff !important;
    }  
    input#crg{
        background-color: #f4f4f4;
        border: none;   
    }
    input#cnome{
        background-color: #f4f4f4;
        border: none;   
    }
    select#cnacionalidade{
        background-color: #f4f4f4;
        border: none;   
        color: black;
    }
    input#cprofissao{
        background-color: #f4f4f4;
        border: none;   
    }
    input#cemail{
        background-color: #f4f4f4;
        border: none;   
    }
    input#cpfsociocliente{
        background-color: #f11070;
        border: none;
    }
    #cpfsociocliente::-webkit-input-placeholder {
        color: #fff !important;
    }  
    input#rgsociocliente{
        background-color: #f4f4f4;
        border: none;   
    } 
    input#orgaoemissorsociocliente{
        background-color: #f4f4f4;
        border: none;   
    } 
    input#nomesociocliente{
        background-color: #f4f4f4;
        border: none;   
    } 
    select#nacionalidadesociocliente{
        background-color: #f4f4f4;
        border: none;   
        color: black;
    } 
    input#passaportesociocliente{
        background-color: #f4f4f4;
        border: none;   
    } 
    input#documentoSocio{
        background-color: #f4f4f4;
        border: none;   
    }
    input#datanascimentosociocliente{
        background-color: #f4f4f4;
        border: none;   
    }
    select#generosociocliente{
        background-color: #f4f4f4;
        border: none;   
        color: black;
    }
    input#emailsociocliente{
        background-color: #f4f4f4;
        border: none;   
    }
    select#estadocivilsociocliente{
        background-color: #f4f4f4;
        border: none;   
        color: black;
    }
    input#cepsociocliente{
        background-color: #f4f4f4;
        border: none;   
    }
    input#enderecosociocliente{
        background-color: #f4f4f4;
        border: none;   
    }
    input#numerosociocliente{
        background-color: #f4f4f4;
        border: none;   
    }
    input#complementosociocliente{
        background-color: #f4f4f4;
        border: none;   
    }
    input#bairrosociocliente{
        background-color: #f4f4f4;
        border: none;   
    }
    select#ufsociocliente{
        background-color: #f4f4f4;
        border: none;   
        color: black;
    }
    input#municipiosociocliente{
        background-color: #f4f4f4;
        border: none;   
    }
    select#paissociocliente{
        background-color: #f4f4f4;
        border: none;   
        color: black;
    }
    input#cpfconjugecliente{
        background-color: #f11070;
        border: none;
    }
    #cpfconjugecliente::-webkit-input-placeholder {
        color: #fff !important;
    }  
    input#rgconjugecliente{
        background-color: #f4f4f4;
        border: none;   
    }
    input#nomeconjugecliente{
        background-color: #f4f4f4;
        border: none;   
    }
    select#nacionalidadeconjugecliente{
        background-color: #f4f4f4;
        border: none;   
        color: black;
    }
    input#profissaoconjugecliente{
        background-color: #f4f4f4;
        border: none;   
    }
    input#emailconjugecliente{
        background-color: #f4f4f4;
        border: none;   
    }
    .form_socio_procurador input[type='file']{
        height: auto;
        padding: 5px;
    }

</style> 
<form name="formSocios" class="div_geral_socio_procurador">
    <div class="">
        <div class="mt10">
            <div class="text-left">
                <span class="subtitulo_socio_procurador">SÓCIO ADMINISTRADOR OU PROCURADOR*</span>
            </div>
        </div>
        <div class="">
            <div class="control-group" style="display: flex;">
                <div class="" style="margin-right: 30px;">
                    <label class="control control-radio">
                        <span class="fonte_radio">SÓCIO ADMINISTRADOR</span>
                            <input type="radio" name="radio" value="socioAdmin" readonly ng-model="empresa.tipo"/>
                        <div class="control_indicator"></div>
                    </label>
                </div>
                <div class="">
                    <label class="control control-radio">
                        <span class="fonte_radio">PROCURADOR</span>
                            <input type="radio" name="radio" value="procurador" readonly ng-model="empresa.tipo"/>
                        <div class="control_indicator"></div>
                    </label>
                </div>
            </div>
        </div>

        <div class="">
            <div class="">
                <div class="form_socio_procurador">
                    <div class="flexpai mt20">
                        <div class="dflex2">
                            <label for="cpfcliente">CPF</label>
                            <input type="text" id="cpfcliente" class="cpf" style="color: #FFF;" ng-model="mainSocio.cpf" readonly placeholder="000.000.000-00">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex2">
                            <label for="rgcliente">RG</label>
                            <input type="text" id="rgcliente" ng-model="mainSocio.rg" readonly placeholder="00.000.000-00">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex2">
                            <label for="orgaoemissorcliente">ORGÃO EMISSOR</label>
                            <input type="text" id="orgaoemissorcliente" ng-model="mainSocio.orgaoEmissor" readonly placeholder="Orgão...">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex3">
                            <label for="namecliente">NOME</label>
                            <input type="text" id="namecliente" ng-model="mainSocio.nome" readonly placeholder="Nome...">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex2">
                            <label for="nacionalidadecliente">NACIONALIDADE</label>
                            <select ng-model="mainSocio.nationality" id="nacionalidadecliente" readonly disabled placeholder="Nacionalidade...">
                                @foreach(config('enum.nacionalidades') as $value => $name)
                                    <option value="{{ $value }}">
                                            {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex2">
                            <label for="passaportecliente">PASSAPORTE</label>
                            <input type="text" id="passaportecliente" ng-model="mainSocio.passport" readonly placeholder="Passaporte...">
                        </div>
                    </div>
                    <div class="flexpai mt20">
                        <div class="dflex3">
                            <label for="documento">DIGITALIZE SUA CNH OU RG E CPF</label>
                            <input type="file" id="documento" file-model="docCliente" placeholder="Documento..." class="filecliente">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex2">
                            <label for="procuracao">PROCURAÇÃO</label>
                            <input type="file" id="procuracao" file-model="procCliente" placeholder="Procuração..." class="fileprocuracao">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex2">
                            <label for="nascimentocliente">DATA DE NASCIMENTO</label>
                            <input type="text" id="nascimentocliente" class="date" ng-model="mainSocio.birthDate" readonly placeholder="00/00/0000">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex1">
                            <label for="generocliente">GÊNERO</label>
                            <select id="generocliente" ng-model="mainSocio.gender" readonly disabled>
                                <option value="feminino">Feminino</option>
                                <option value="masculino">Masculino</option>
                            </select>
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex2">
                            <label for="emailcliente">E-MAIL</label>
                            <input type="text" id="emailcliente" name="emailcliente" class="form-control" ng-model="mainSocio.email" ng-pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/" readonly placeholder="Email...">
                            <div class="custom-error"  ng-show="formSocios.emailcliente.$error.pattern">
                                <span style="color:red">Formato de e-mail inválido.</span>
                            </div>
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex2">
                            <label for="estadocivilcliente">ESTADO CIVIL</label>
                            <select ng-model="mainSocio.estadoCivil" id="estadocivilcliente" readonly disabled>
                                <option value="solteiro">Solteiro(a)</option>
                                <option value="casado">Casado(a)</option>
                                <option value="divorciado">Divorciado(a)</option>
                                <option value="viuvo">Viúvo(a)</option>
                            </select>
                        </div>
                    </div>
                    <div class="flexpai mt20">
                        <div class="dflex1">
                            <label for="cepcliente">CEP</label>
                            <input type="text" id="cepcliente" class="cep" ng-blur="cepCliente()" ng-model="mainSocio.Address.Endereco_CEP" readonly placeholder="CEP...">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex3">
                            <label for="enderecocliente">ENDEREÇO / RUA, AV., etc… </label>
                            <input type="text" id="enderecocliente" ng-model="mainSocio.Address.Endereco_Lgr" readonly placeholder="Endereço...">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex1">
                            <label for="numerocliente">Nº</label>
                            <input type="text" id="numerocliente" ng-model="mainSocio.Address.Endereco_Nro" readonly placeholder="Nº...">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex1">
                            <label for="complementocliente">COMPLEMENTO</label>
                            <input type="text" id="complementocliente" ng-model="mainSocio.Address.Endereco_Complemento" readonly placeholder="Complemento...">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex1">
                            <label for="bairrocliente">BAIRRO</label>
                            <input type="text" id="bairrocliente" ng-model="mainSocio.Address.Endereco_Bairro" readonly placeholder="Bairro...">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex1">
                            <label for="ufcliente">UF</label>
                            <select ng-model="mainSocio.Address.Endereco_UF" id="ufcliente" readonly disabled>
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
                            <label for="municipiocliente">MUNICÍPIO</label>
                            <input type="text" id="municipiocliente" ng-model="mainSocio.Address.Endereco_Mun" readonly placeholder="Mun...">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex1">
                            <label for="paiscliente">PAÍS</label>
                            <select ng-model="mainSocio.Address.Endereco_Pais" id="paiscliente" readonly disabled placeholder="País..">
                                @foreach(config('enum.paises') as $value => $name)
                                    <option value="{{ $value }}">
                                            {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt30">
                        <div id="divConjuge" ng-show="mainSocio.estadoCivil == 'casado'" style="display:inherit;" class="text-left">
                            <span class="subtitulo_socio_procurador">DADOS DO CÔNJUGUE</span>
                            <div class="form_socio_procurador">
                                <div class="flexpai mt20">
                                    <div class="dflex2">
                                        <label for="ccpf">CPF</label>
                                        <input type="text" id="ccpf" ng-model="mainSocio.conjuge_cpf" readonly class="cpf" placeholder="CPF...">
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex2">
                                        <label for="crg">RG</label>
                                        <input type="text" id="crg" ng-model="mainSocio.conjuge_rg" readonly placeholder="RG...">
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex3">
                                        <label for="cnome">NOME</label>
                                        <input type="text" id="cnome" ng-model="mainSocio.conjuge_nome" readonly placeholder="Nome...">
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex2">
                                        <label for="cnacionalidade">NACIONALIDADE</label>
                                        <select ng-model="mainSocio.conjuge_nationality" id="cnacionalidade" readonly disabled placeholder="Nacionalidade...">
                                            @foreach(config('enum.nacionalidades') as $value => $name)
                                                <option value="{{ $value }}">
                                                        {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex2">
                                        <label for="cprofissao">PROFISSÃO</label>
                                        <input type="text" id="cprofissao" ng-model="mainSocio.conjuge_profissao" readonly placeholder="Profissão...">
                                    </div>
                                </div>
                                <div class="flexpai mt20">
                                    <div class="dflex2">
                                        <label for="cemail">E-MAIL</label>
                                        <input type="text" id="cemail" name="cemail" ng-model="mainSocio.conjuge_email" ng-pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/" readonly placeholder="E-mail...">
                                        <div class="custom-error"  ng-show="formSocios.cemail.$error.pattern">
                                            <span style="color:red">Formato de e-mail inválido.</span>
                                        </div>
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex2"> </div>
                                    <div class="ph10"></div>
                                    <div class="dflex3"></div>
                                    <div class="ph10"></div>
                                    <div class="dflex2"></div>
                                    <div class="ph10"></div>
                                    <div class="dflex2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt30">
                        <div class="">
                            <div class="linha_socio_procurador">
                            </div>
                        </div>
                    </div>
                    <div class="mt30">
                        <div id="divSocios" ng-repeat="s in socios" class="text-left">
                            <span class="subtitulo_socio_procurador">DADOS DO SÓCIO</span>
                            <div class="form_socio_procurador">
                                <div class="flexpai">
                                    <div class="dflex2">
                                        <label for="cpfsociocliente">CPF</label>
                                        <input type="text" id="cpfsociocliente" ng-model="s.cpf" class="cpf" placeholder="CPF..." >
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex2">
                                        <label for="rgsociocliente">RG</label>
                                        <input type="text" id="rgsociocliente" ng-model="s.rg" placeholder="RG..." >
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex2">
                                        <label for="orgaoemissorsociocliente">ORGÃO EMISSOR</label>
                                        <input type="text" id="orgaoemissorsociocliente" ng-model="s.orgaoEmissor" placeholder="Orgão Emissor...">
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex3">
                                        <label for="nomesociocliente">NOME</label>
                                        <input type="text" id="nomesociocliente" ng-model="s.nome" placeholder="Nome...">
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex2">
                                        <label for="nacionalidadesociocliente">NACIONALIDADE</label>
                                        <select ng-model="s.nationality" id="nacionalidadesociocliente" placeholder="Nacionalidade...">
                                            @foreach(config('enum.nacionalidades') as $value => $name)
                                                <option value="{{ $value }}">
                                                        {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex2">
                                        <label for="passaportesociocliente">PASSAPORTE</label>
                                        <input type="text" id="passaportesociocliente" ng-model="s.passport" placeholder="Passaporte..." >
                                    </div>
                                </div>
                            
                                <div class="flexpai mt20">
                                    <div class="dflex3">
                                        <label for="documentoSocio">DIGITALIZE SUA CNH OU RG E CPF</label>
                                        <input type="file" id="documentoSocio" file-model="s.documento" placeholder="Incluir..">
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex2">
                                        <label for="datanascimentosociocliente">DATA DE NASCIMENTO</label>
                                        <input type="text" id="datanascimentosociocliente" ng-model="s.birthDate" class="date" placeholder="Data de Nascimento..." >
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex1">
                                        <label for="generosociocliente">GÊNERO</label>
                                        <select id="generosociocliente" ng-model="s.gender" >
                                            <option value="feminino">Feminino</option>
                                            <option value="masculino">Masculino</option>
                                        </select>
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex3">
                                        <label for="emailsociocliente">E-MAIL</label>
                                        <input type="text" id="emailsociocliente" name="emailSocio" ng-model="s.email" ng-pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/" placeholder="E-mail..">
                                        <div class="custom-error"  ng-show="formSocios.emailSocio.$error.pattern">
                                            <span style="color:red">Formato de e-mail inválido.</span>
                                        </div>
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex1">
                                        <label for="estadocivilsociocliente">ESTADO CIVIL</label>
                                        <select  id="estadocivilsociocliente" ng-model="s.estadoCivil">
                                            <option value="solteiro">Solteiro(a)</option>
                                            <option value="casado">Casado(a)</option>
                                            <option value="divorciado">Divorciado(a)</option>
                                            <option value="viuvo">Viúvo(a)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="flexpai mt20">
                                    <div class="dflex1">
                                        <label for="cepsociocliente">CEP</label>
                                        <input type="text" id="cepsociocliente" class="cep" ng-model="s.Address.Endereco_CEP" ng-blur="cepSocio($index)" placeholder="Cep...">
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex3">
                                        <label for="enderecosociocliente">ENDEREÇO / RUA, AV., etc…</label>
                                        <input type="text" id="enderecosociocliente" ng-model="s.Address.Endereco_Lgr" placeholder="Endereço...">
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex1">
                                        <label for="numerosociocliente">Nº</label>
                                        <input type="text" id="numerosociocliente" ng-model="s.Address.Endereco_Nro" placeholder="Nº...">
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex1">
                                        <label for="complementosociocliente">COMPLEMENTO</label>
                                        <input type="text" id="complementosociocliente" ng-model="s.Address.Endereco_Complemento" placeholder="Complemento..">
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex1">
                                        <label for="bairrosociocliente">BAIRRO</label>
                                        <input type="text" id="bairrosociocliente" ng-model="s.Address.Endereco_Bairro" placeholder="Bairro..">
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex1">
                                        <label for="ufsociocliente">UF</label>
                                        <select id="ufsociocliente" ng-model="s.Address.Endereco_UF">
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
                                        <label for="municipiosociocliente">MUNICÍPIO</label>
                                        <input type="text" id="municipiosociocliente" ng-model="s.Address.Endereco_Mun" placeholder="Município..">
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex1">
                                        <label for="paissociocliente">PAÍS</label>
                                        <select ng-model="s.Address.Endereco_Pais" id="paissociocliente" placeholder="País..">
                                            @foreach(config('enum.paises') as $value => $name)
                                                <option value="{{ $value }}">
                                                        {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mt20">
                                <div class="text-left">
                                    <span class="fontedemaissocios">*Demais sócios poderão ser adicionados depois.</span>
                                </div>
                            </div>
                            <div class="mt30">
                                <div id="divConjugeSocio" ng-show="s.estadoCivil == 'casado'" style="display:inherit;" class="text-left">
                                    <span class="subtitulo_socio_procurador">DADOS DO CÔNJUGUE</span>
                                    <div class="form_socio_procurador">
                                        <div class="flexpai mt20">
                                            <div class="dflex2">
                                                <label for="cpfconjugecliente">CPF</label>
                                                <input type="text" id="cpfconjugecliente" ng-model="s.conjuge_cpf" class="cpf" placeholder="CPF...">
                                            </div>
                                            <div class="ph10"></div>
                                            <div class="dflex2">
                                                <label for="rgconjugecliente">RG</label>
                                                <input type="text" id="rgconjugecliente" ng-model="s.conjuge_rg" placeholder="RG...">
                                            </div>
                                            <div class="ph10"></div>
                                            <div class="dflex3">
                                                <label for="nomeconjugecliente">NOME</label>
                                                <input type="text" id="nomeconjugecliente" ng-model="s.conjuge_nome" placeholder="Nome...">
                                            </div>
                                            <div class="ph10"></div>
                                            <div class="dflex2">
                                                <label for="nacionalidadeconjugecliente">NACIONALIDADE</label>
                                                <select ng-model="s.conjuge_nationality" id="nacionalidadeconjugecliente" placeholder="Nacionalidade...">
                                                    @foreach(config('enum.nacionalidades') as $value => $name)
                                                        <option value="{{ $value }}">
                                                                {{ $name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="ph10"></div>
                                            <div class="dflex2">
                                                <label for="profissaoconjugecliente">PROFISSÃO</label>
                                                <input type="text" id="profissaoconjugecliente" ng-model="s.conjuge_profissao" placeholder="Profissão...">
                                            </div>
                                        </div>
                                        <div class="flexpai mt20">
                                            <div class="dflex2">
                                                <label for="emailconjugecliente">E-MAIL</label>
                                                <input type="text" id="emailconjugecliente" name="emailConjSocio" ng-model="s.conjuge_email" ng-pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/" placeholder="E-mail...">
                                                <div class="custom-error"  ng-show="formSocios.emailConjSocio.$error.pattern">
                                                    <span style="color:red">Formato de e-mail inválido.</span>
                                                </div>
                                            </div>
                                            <div class="ph10"></div>
                                            <div class="dflex2"> </div>
                                            <div class="ph10"></div>
                                            <div class="dflex3"></div>
                                            <div class="ph10"></div>
                                            <div class="dflex2"></div>
                                            <div class="ph10"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center;" class="mb30">
                                <div class="mt10">
                                    <button type="button" class="btn btn-danger botaoexcluirsocio" ng-click="removeCloneSocio($index)" style="width: auto !important;">EXCLUIR SÓCIO</button>
                                </div>
                                <div ng-show="$last" class="mt10" style="margin-left: 20px;">
                                    <button type="button" class="btn btn-primary botaoadicionarsocio" ng-click="appendClonedSocio()" style="width: auto !important;">ADICIONAR OUTRO SÓCIO</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt10 mb150">
                        <div ng-show="socios.length==0" class="">
                            <button type="button" class="btn btn-primary botaoadicionarsocio" ng-click="appendClonedSocio()" style="width: auto !important;">ADICIONAR OUTRO SÓCIO</button>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</form>