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
        border: 1px solid #f11270;
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
        background: #e91212;
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
    input::placeholder{color: #bdb8b8 !important;}
    input[type='file'] {
        height: auto;
        padding: 6px;
    }

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

<form name="myForm" class="div_geral_socio_procurador">
    <div class="container-fluid">
        <div class="row mt20">
            <div class="col-md-12 text-left">
                <i class="fa fa-search socio_procurador_icon" aria-hidden="true"></i>
                <span class="titulo_socio">DADOS DO(S) SÓCIO(S) OU PROCURADOR</span>
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
                <span class="subtitulo_socio_procurador">SÓCIO ADMINISTRADOR OU PROCURADOR*</span>
            </div>
            <div class="col-md-6 col-xs-12 col-sm-12 text-right">
                <span class="fonte_obrigatorios">*campos obrigatórios</span>
            </div>
        </div>
        <div class="row">
            <div class="control-group">
                <div class="col-md-3 col-xs-12 col-sm-12">
                    <label class="control control-radio">
                        <span class="fonte_radio">SÓCIO ADMINISTRADOR</span>
                            <input type="radio" name="radio" value="socioAdmin" ng-model="dataPessoaFisica.tipo" ng-checked="true" />
                        <div class="control_indicator"></div>
                    </label>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-12">
                    <label class="control control-radio">
                        <span class="fonte_radio">PROCURADOR</span>
                            <input type="radio" name="radio" value="procurador" ng-model="dataPessoaFisica.tipo"/>
                        <div class="control_indicator"></div>
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="form_socio_procurador">
                    <div class="flexpai mt20">
                        <div class="dflex2">
                            <label for="cpf">CPF <span class="asteriscorosa">*</span></label>
                            <input type="text" id="cpf" ng-change="consultaCPFUser()" ng-model="cpf" class="cpf" required placeholder="CPF...">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex2">
                            <label for="rg">RG <span class="asteriscorosa">*</span></label>
                            <input type="text" id="rg" ng-model="dataPessoaFisica.AlternativeIdNumbers.RGSP" required placeholder="RG...">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex2">
                            <label for="orgaoEmissor">ORGÃO EMISSOR <span class="asteriscorosa">*</span></label>
                            <input type="text" id="orgaoEmissor" ng-model="dataPessoaFisica.orgaoEmissor" required placeholder="Orgão Emissor...">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex3">
                            <label for="name">NOME <span class="asteriscorosa">*</span></label>
                            <input type="text" id="name" ng-model="dataPessoaFisica.Name" required placeholder="Nome...">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex2">
                            <label for="nationality">NACIONALIDADE <span class="asteriscorosa">*</span></label>
                            <select ng-model="dataPessoaFisica.BirthCountry" id="nationality" placeholder="Nacionalidade...">
                                @foreach(config('enum.nacionalidades') as $value => $name)
                                    <option class="upper-select" value="{{ $value }}">
                                            {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex2">
                            <label for="passport">PASSAPORTE</label>
                            <input type="text" id="passport" ng-model="dataPessoaFisica.passport" placeholder="Passaporte...">
                        </div>
                    </div>
                    <div class="flexpai mt20">
                        <div class="dflex3">
                            <label for="documento">DIGITALIZE SUA CNH OU RG E CPF <span class="asteriscorosa">*</span></label>
                            <input type="file" id="documento" file-model="docCliente" required placeholder="Digitalize..." class="filecliente" required>
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex2">
                            <label for="procuracao">PROCURAÇÃO<span class="asteriscorosa" ng-show="dataPessoaFisica.tipo == 'procurador'">*</span></label>
                            <input type="file" id="procuracao" file-model="procCliente" placeholder="Procuração..." class="fileprocuracao" ng-required="dataPessoaFisica.tipo == 'procurador'">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex2">
                            <label for="birthDate">DATA DE NASCIMENTO <span class="asteriscorosa">*</span></label>
                            <input type="text" id="birthDate" class="date" ng-model="dataPessoaFisica.BirthDate" required placeholder="Data de Nascimento...">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex1">
                            <label for="gender">GÊNERO <span class="asteriscorosa">*</span></label>
                            <select id="gender" ng-model="dataPessoaFisica.Gender" required>
                                <option class="upper-select" value="feminino">FEMININO</option>
                                <option class="upper-select" value="masculino">MASCULINO</option>
                            </select>
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex3">
                            <label for="email">E-MAIL <span class="asteriscorosa">*</span></label>
                            <input type="text" id="email" name="email" ng-model="dataPessoaFisica.email" ng-pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/" required placeholder="E-mail..">
                            <div class="custom-error"  ng-show="myForm.email.$error.pattern">
                                <span style="color:red">Formato de e-mail inválido.</span>
                            </div>
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex2">
                            <label for="estadoCivil">ESTADO CIVIL <span class="asteriscorosa">*</span></label>
                            <select ng-model="dataPessoaFisica.estadoCivil" id="estadoCivil" required>
                                <option class="upper-select" value="solteiro">SOLTEIRO(A)</option>
                                <option class="upper-select" value="casado">CASADO(A)</option>
                                <option class="upper-select" value="uniao">UNIÃO ESTÁVEL</option>
                                <option class="upper-select" value="divorciado">DIVORCIADO(A)</option>
                                <option class="upper-select" value="viuvo">VIÚVO(A)</option>
                            </select>
                        </div>
                    </div>
                    <div class="flexpai mt20">
                        <div class="dflex1">
                            <label for="cep">CEP <span class="asteriscorosa">*</span></label>
                            <input type="text" id="cep" class="cep" ng-blur="cepCliente()" ng-model="dataPessoaFisica.Address.ZipCode" required placeholder="Cep..." data-mask="00000-000">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex3">
                            <label for="street">ENDEREÇO / RUA, AV., etc… <span class="asteriscorosa">*</span></label>
                            <input type="text" id="street" ng-model="dataPessoaFisica.Address.AddressMain" required placeholder="Endereço...">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex1">
                            <label for="number">Nº <span class="asteriscorosa">*</span></label>
                            <input type="text" id="number" ng-model="dataPessoaFisica.Address.Number" required placeholder="Nº...">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex1">
                            <label for="complement">COMPLEMENTO</label>
                            <input type="text" id="complement" ng-model="dataPessoaFisica.Address.Complement" placeholder="Complemento..">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex1">
                            <label for="neighbor">BAIRRO <span class="asteriscorosa">*</span></label>
                            <input type="text" id="neighbor" ng-model="dataPessoaFisica.Address.Neighborhood" required placeholder="Bairro..">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex1">
                            <label for="uf">UF <span class="asteriscorosa">*</span></label>
                            <select ng-model="dataPessoaFisica.Address.State" id="uf" required>
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
                            <label for="city">MUNICÍPIO <span class="asteriscorosa">*</span></label>
                            <input type="text" id="city" ng-model="dataPessoaFisica.Address.City" required placeholder="Município..">
                        </div>
                        <div class="ph10"></div>
                        <div class="dflex1">
                            <label for="country">PAÍS <span class="asteriscorosa">*</span></label>
                            <select ng-model="dataPessoaFisica.Address.Country" id="country" required placeholder="País..">
                                @foreach(config('enum.paises') as $value => $name)
                                    <option class="upper-select" value="{{ $value }}">
                                            {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt30">
                        <div id="divConjuge" ng-show="dataPessoaFisica.estadoCivil == 'casado' || dataPessoaFisica.estadoCivil == 'uniao'" style="display:inherit;" class="text-left">
                            <span class="subtitulo_socio_procurador">DADOS DO CÔNJUGUE</span>
                            <div class="form_socio_procurador">
                                <div class="flexpai">
                                    <div class="dflex2">
                                        <label for="ccpf">CPF <span class="asteriscorosa">*</span></label>
                                        <input type="text" id="ccpf" ng-change="consultaCPFConjuge()" ng-model="dataPessoaFisica.conjuge_cpf" class="cpf" placeholder="CPF..." ng-required="dataPessoaFisica.estadoCivil == 'casado' || dataPessoaFisica.estadoCivil == 'uniao'">
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex2">
                                        <label for="crg">RG <span class="asteriscorosa">*</span></label>
                                        <input type="text" id="crg" ng-model="dataPessoaFisica.conjuge_rg" placeholder="RG..." ng-required="dataPessoaFisica.estadoCivil == 'casado' || dataPessoaFisica.estadoCivil == 'uniao'">
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex3">
                                        <label for="cnome">NOME <span class="asteriscorosa">*</span></label>
                                        <input type="text" id="cnome" ng-model="dataPessoaFisica.conjuge_nome" placeholder="Nome..." ng-required="dataPessoaFisica.estadoCivil == 'casado' || dataPessoaFisica.estadoCivil == 'uniao'">
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex2">
                                        <label for="cnacionalidade">NACIONALIDADE <span class="asteriscorosa">*</span></label>
                                        <select ng-model="dataPessoaFisica.conjuge_nationality" id="cnacionalidade" placeholder="Nacionalidade...">
                                            @foreach(config('enum.nacionalidades') as $value => $name)
                                                <option class="upper-select" value="{{ $value }}">
                                                        {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="ph10"></div>
                                    <div class="dflex2">
                                        <label for="cprofissao">PROFISSÃO <span class="asteriscorosa">*</span></label>
                                        <input type="text" id="cprofissao" ng-model="dataPessoaFisica.conjuge_profissao" placeholder="Profissão..." ng-required="dataPessoaFisica.estadoCivil == 'casado' || dataPessoaFisica.estadoCivil == 'uniao'">
                                    </div>
                                </div>
                                <div class="flexpai mt20">
                                    <div class="dflex2">
                                        <label for="cemail">E-MAIL <span class="asteriscorosa">*</span></label>
                                        <input type="text" id="cemail" name="cemail" ng-model="dataPessoaFisica.conjuge_email" ng-pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/" placeholder="E-mail..." ng-required="dataPessoaFisica.estadoCivil == 'casado' || dataPessoaFisica.estadoCivil == 'uniao'">
                                        <div class="custom-error"  ng-show="myForm.cemail.$error.pattern">
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
                </div>


                <div class="">
                    <div class="text-left">
                        <span class="fontedemaissocios">*Demais sócios poderão ser adicionados depois.</span>
                    </div>
                </div>
                <div class="mt20">
                    <div class="">
                        <div class="linha_socio_procurador">
                        </div>
                    </div>
                </div>
                <div class="mt20">
                    <div class="text-left">
                        <span class="subtitulo_socio_procurador">SÓCIOS DA EMPRESA</span>
                    </div>
                </div>
                <div class="">
                    <div class="text-left">
                        <span class="preencherdadossocios">PREENCHER OS DADOS DE <b>TODOS</b> OS SÓCIOS DE ACORDO COM O CONTRATO SOCIAL</span>
                    </div>
                </div>
                
                <div class="mt30" ng-repeat="s in socios">
                    <div id="divSocios" class="text-left">
                        <span class="subtitulo_socio_procurador">DADOS DO SÓCIO</span>
                        <div class="form_socio_procurador">
                            <div class="flexpai">
                                <div class="dflex2">
                                    <label for="cpfSocio">CPF <span class="asteriscorosa">*</span></label>
                                    <input type="text" ng-change="consultaCPFSocio($index)" ng-model="s.cpf" class="cpf" ng-required ="true" placeholder="CPF...">
                                </div>
                                <div class="ph10"></div>
                                <div class="dflex2">
                                    <label for="rgSocio">RG <span class="asteriscorosa">*</span></label>
                                    <input type="text" ng-model="s.rg" placeholder="RG..." ng-required ="true">
                                </div>
                                <div class="ph10"></div>
                                <div class="dflex2">
                                    <label for="orgaoEmissorSocio">ORGÃO EMISSOR <span class="asteriscorosa">*</span></label>
                                    <input type="text"  ng-model="s.orgaoEmissor" placeholder="Orgão Emissor..." required>
                                </div>
                                <div class="ph10"></div>
                                <div class="dflex3">
                                    <label for="nomeSocio">NOME <span class="asteriscorosa">*</span></label>
                                    <input type="text" ng-model="s.nome" placeholder="Nome..." required>
                                </div>
                                <div class="ph10"></div>
                                <div class="dflex2">
                                    <label for="nationalitySocio">NACIONALIDADE <span class="asteriscorosa">*</span></label>
                                    <select ng-model="s.nationality" id="nationalitySocio" placeholder="Nacionalidade...">
                                        @foreach(config('enum.nacionalidades') as $value => $name)
                                            <option class="upper-select" value="{{ $value }}">
                                                    {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="ph10"></div>
                                <div class="dflex2">
                                    <label for="passportSocio">PASSAPORTE</label>
                                    <input type="text" ng-model="s.passport" placeholder="Passaporte...">
                                </div>
                            </div>
                        
                            <div class="flexpai mt20">
                                <div class="dflex3">
                                    <label for="documentoSocio">DIGITALIZE SUA CNH OU RG E CPF <span class="asteriscorosa">*</span></label>
                                    <input type="file" id="documentoSocio" file-model="s.documento" required placeholder="Incluir..">
                                </div>
                                <div class="ph10"></div>
                                <div class="dflex2">
                                    <label for="datanascimentoSocio">DATA DE NASCIMENTO <span class="asteriscorosa">*</span></label>
                                    <input type="text" ng-model="s.birthDate" class="date"  placeholder="Data de Nascimento..." required>
                                </div>
                                <div class="ph10"></div>
                                <div class="dflex2">
                                    <label for="generoSocio">GÊNERO <span class="asteriscorosa">*</span></label>
                                    <select ng-model="s.gender" required>
                                        <option class="upper-select" value="feminino">FEMININO</option>
                                        <option class="upper-select" value="masculino">MASCULINO</option>
                                    </select>
                                </div>
                                <div class="ph10"></div>
                                <div class="dflex3">
                                    <label for="emailSocio">E-MAIL <span class="asteriscorosa">*</span></label>
                                    <input type="text" id="emailSocio" name="emailSocio" ng-model="s.email" ng-pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/" required placeholder="E-mail...">
                                    <div class="custom-error"  ng-show="myForm.emailSocio.$error.pattern">
                                        <span style="color:red">Formato de e-mail inválido.</span>
                                    </div>
                                </div>
                                <div class="ph10"></div>
                                <div class="dflex1">
                                    <label>ESTADO CIVIL <span class="asteriscorosa">*</span></label>
                                    <select ng-model="s.estadoCivil" required>
                                        <option class="upper-select" value="solteiro">SOLTEIRO(A)</option>
                                        <option class="upper-select" value="casado">CASADO(A)</option>
                                        <option class="upper-select" value="uniao">UNIÃO ESTÁVEL</option>
                                        <option class="upper-select" value="divorciado">DIVORCIADO(A)</option>
                                        <option class="upper-select" value="viuvo">VIÚVO(A)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flexpai mt20">
                                <div class="dflex1">
                                    <label for="cepSocio">CEP <span class="asteriscorosa">*</span></label>
                                    <input type="text" class="cep" ng-blur="cepSocio($index)" ng-model="s.Address.ZipCode" placeholder="Cep..." required data-mask="00000-000">
                                </div>
                                <div class="ph10"></div>
                                <div class="dflex2">
                                    <label for="streetSocio">ENDEREÇO / RUA, AV., etc… <span class="asteriscorosa">*</span></label>
                                    <input type="text" ng-model="s.Address.AddressMain" placeholder="Endereço..." required>
                                </div>
                                <div class="ph10"></div>
                                <div class="dflex1">
                                    <label for="numberSocio">Nº <span class="asteriscorosa">*</span></label>
                                    <input type="text" ng-model="s.Address.Number" placeholder="Nº..." required>
                                </div>
                                <div class="ph10"></div>
                                <div class="dflex1">
                                    <label for="complementSocio">COMPLEMENTO</label>
                                    <input type="text" ng-model="s.Address.Complement" placeholder="Complemento..">
                                </div>
                                <div class="ph10"></div>
                                <div class="dflex1">
                                    <label for="neighborSocio">BAIRRO <span class="asteriscorosa">*</span></label>
                                    <input type="text" ng-model="s.Address.Neighborhood" placeholder="Bairro.." required>
                                </div>
                                <div class="ph10"></div>
                                <div class="dflex1">
                                    <label for="ufSocio">UF <span class="asteriscorosa">*</span></label>
                                    <select ng-model="s.Address.State" required>
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
                                    <label for="citySocio">MUNICÍPIO <span class="asteriscorosa">*</span></label>
                                    <input type="text" ng-model="s.Address.City" placeholder="Município.." required>
                                </div>
                                <div class="ph10"></div>
                                <div class="dflex1">
                                    <label for="countrySocio">PAÍS <span class="asteriscorosa">*</span></label>
                                    <select ng-model="s.Address.Country" id="countrySocio" required placeholder="País..">
                                        @foreach(config('enum.paises') as $value => $name)
                                            <option class="upper-select" value="{{ $value }}">
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
                        <div class="mt40" ng-show="s.estadoCivil == 'casado' || s.estadoCivil == 'uniao'">
                            <div id="divConjugeSocio" style="display:inherit;" class="text-left">
                                <span class="subtitulo_socio_procurador">DADOS DO CÔNJUGUE</span>
                                <div class="form_socio_procurador">
                                    <div class="flexpai">
                                        <div class="dflex2">
                                            <label for="cpfConjSocio">CPF <span class="asteriscorosa">*</span></label>
                                            <input type="text" ng-change="consultaCPFConjugeSocio($index)" ng-model="s.conjuge_cpf" class="cpf" placeholder="CPF..." data-mask="000.000.000-00" ng-required="s.estadoCivil == 'casado' || s.estadoCivil == 'uniao'">
                                        </div>
                                        <div class="ph10"></div>
                                        <div class="dflex2">
                                            <label for="rgConjSocio">RG <span class="asteriscorosa">*</span></label>
                                            <input type="text" ng-model="s.conjuge_rg" placeholder="RG..." ng-required="s.estadoCivil == 'casado' || s.estadoCivil == 'uniao'">
                                        </div>
                                        <div class="ph10"></div>
                                        <div class="dflex3">
                                            <label for="nomeConjSocio">NOME <span class="asteriscorosa">*</span></label>
                                            <input type="text" ng-model="s.conjuge_nome" placeholder="Nome..." ng-required="s.estadoCivil == 'casado' || s.estadoCivil == 'uniao'">
                                        </div>
                                        <div class="ph10"></div>
                                        <div class="dflex2">
                                            <label for="nacionalidadeConjSocio">NACIONALIDADE <span class="asteriscorosa">*</span></label>
                                            <select ng-model="s.conjuge_nationality" id="nacionalidadeConjSocio" ng-required="s.estadoCivil == 'casado' || s.estadoCivil == 'uniao'" placeholder="Nacionalidade...">
                                                @foreach(config('enum.nacionalidades') as $value => $name)
                                                    <option class="upper-select" value="{{ $value }}">
                                                            {{ $name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="ph10"></div>
                                        <div class="dflex2">
                                            <label for="profissaoConjSocio">PROFISSÃO <span class="asteriscorosa">*</span></label>
                                            <input type="text" ng-model="s.conjuge_profissao" placeholder="Profissão..." ng-required="s.estadoCivil == 'casado' || s.estadoCivil == 'uniao'">
                                        </div>
                                    </div>
                                    <div class="flexpai mt20">
                                        <div class="dflex2">
                                            <label for="emailConjSocio">E-MAIL <span class="asteriscorosa">*</span></label>
                                            <input type="text" id="emailConjSocio" name="emailConjSocio" ng-model="s.conjuge_email" ng-pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/" placeholder="E-mail..." ng-required="s.estadoCivil == 'casado' || s.estadoCivil == 'uniao'">
                                            <div class="custom-error"  ng-show="myForm.emailConjSocio.$error.pattern">
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
</form>