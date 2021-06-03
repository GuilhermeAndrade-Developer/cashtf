@extends('layouts.cliente.topo')
@section('content')
<style>
.texto_formulario{
    margin-top: 5px;
	}
.rodape{
	position: absolute ;
    display: none !important;
}
.drawer-navbar{
	display: none !important;
}
</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
<div class="container-fluid" ng-controller="myCtrl" ng-app="myApp" ng-cloak ng-init="verificaCpf()">

	<!-- STEP1 -->
	<div ng-show="step == 1">
		<div class="div-default-shadow">
			<div class="row">
				<div class="col-md-12">
					<div class="div_analisa_flex">
						<div class="mt20 fonte_analisar" style="flex: auto;">
							{{-- <img src="{{asset('images/search_analisar_solicitacao_icn.png')}}"> --}}
							<span>
								CONFIRMAR DADOS
							</span>
						</div>
					</div>
					<div class="faixarosa mt10"></div>
				</div>
			</div>


			<!-- CPF CNPJ -->
			<div class="mt20 dflex">
				<div class="flex1">
					<label class="texto_formulario">CPF</label>
					<input type="text" class="form-control input_default cpf" readonly ng-model="cpf" placeholder="Digite o cpf" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">CNPJ</label>
					<input type="text" class="form-control input_default cnpj" readonly ng-model="cnpj" placeholder="Digite o cnpj" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">&nbsp;</label>
					{{-- <div>
						<button class="btn-verificar" ng-click="verificaCpf()">VERIFICAR</button>
					</div> --}}
				</div>
			</div>

			<div class="row mt40 mb20">
				<div class="col-md-12">
					<div class="faixarosa"></div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<label class="texto_formulario">PESSOA</label>
					<div class="div_cliente_flex">
						<div class="pinkdiv" ng-class="pessoa == 1?'active':''" style="flex: 1; margin: 2px;" ng-click="trocarPessoa(1)">
							<span>PESSOA FÍSICA</b></span>
						</div>
						<div class="pinkdiv" ng-class="pessoa == 2?'active':''" style="flex: 1; margin: 2px;" ng-click="trocarPessoa(2)">
							<span>PESSOA JURÍDICA</b></span>
						</div>
					</div>
				</div>
			</div>

			<!-- Fisica -->
			<div ng-show="pessoa == 1">
				<!-- Dados Empresa -->
				<div class="dflex fwrap">
					<div class="flex1">
						<label class="texto_formulario">Nome</label>
						<input type="text" class="form-control input_default" placeholder="Nome" ng-model="dataPessoaFisica.Name" />
					</div>
					<div class="flex1">
						<label class="texto_formulario">Sexo</label>
						<input type="text" class="form-control input_default" placeholder="Sexo" ng-model="dataPessoaFisica.Gender" />
					</div>
					<div class="flex1">
						<label class="texto_formulario">Data de Nascimento</label>
						<input type="text" class="form-control input_default date" placeholder="Data de Nascimento" ng-model="dataPessoaFisica.BirthDate" />
					</div>
					<div class="flex1">
						<label class="texto_formulario">Nacionalidade</label>
						<input type="text" class="form-control input_default" placeholder="Nacionalidade" ng-model="dataPessoaFisica.BirthCountry" />
					</div>
					<div class="flex1">
						<label class="texto_formulario">Estado de Nascimento</label>
						<input type="text" class="form-control input_default" placeholder="Estado" ng-model="dataPessoaFisica.BirthState" />
					</div>
					<div class="flex1">
						<label class="texto_formulario">Nome da mãe</label>
						<input type="text" class="form-control input_default" placeholder="Nome da mãe" ng-model="dataPessoaFisica.MotherName" />
					</div>
					<div class="flex1">
						<label class="texto_formulario">Nome do Pai</label>
						<input type="text" class="form-control input_default" placeholder="Nome do Pai" ng-model="dataPessoaFisica.FatherName" />
					</div>
					<div class="flex1">
						<label class="texto_formulario">Estado Civil</label>
						<select class="form-control input_default" style="border-color: #ccc;" ng-model="dataPessoaFisica.EstadoCivil">
							<option value="CASADO" ng-selected="dataPessoaFisica.EstadoCivil == CASADO">CASADO</option>
							<option value="SOLTEIRO" ng-selected="dataPessoaFisica.EstadoCivil == SOLTEIRO">SOLTEIRO</option>
							<option value="VIÚVO" ng-selected="dataPessoaFisica.EstadoCivil == VIUVO">VIUVO</option>
							<option value="SEPARADO" ng-selected="dataPessoaFisica.EstadoCivil == SEPARADO">SEPARADO</option>
							<option value="DIVORCIADO" ng-selected="dataPessoaFisica.EstadoCivil == DIVORCIADO">DIVORCIADO</option>
						</select>
					</div>
					<!--<div class="flex1">
						<label class="texto_formulario">Indicação de falecimento</label>
						<select class="form-control input_default" style="border-color: #ccc;" ng-model="dataPessoaFisica.HasObitIndication">
							<option value="false" ng-selected="dataPessoaFisica.HasObitIndication == false">Não</option>
							<option value="true" ng-selected="dataPessoaFisica.HasObitIndication == true">Sim</option>
						</select>
					</div>-->
				</div>
			</div>

			<!-- Juridica -->
			<div ng-show="pessoa == 2">
				<!-- Dados Empresa -->
				<div class="dflex fwrap">
					<div class="flex1">
						<label class="texto_formulario">Nome oficial da empresa</label>
						<input type="text" class="form-control input_default" placeholder="Nome oficial da empresa" ng-model="dataPessoaJuridica.OfficialName" />
					</div>
					<div class="flex1">
						<label class="texto_formulario">Nome fantasia</label>
						<input type="text" class="form-control input_default" placeholder="Nome fantasia" ng-model="dataPessoaJuridica.TradeName" />
					</div>
					<div class="flex1">
						<label class="texto_formulario">Estado da sede da empresa</label>
						<input type="text" class="form-control input_default" placeholder="Estado da sede da empresa" ng-model="dataPessoaJuridica.HeadquarterState" />
					</div>
					<div class="flex1">
						<label class="texto_formulario">Tipo de regime tributário</label>
						<input type="text" class="form-control input_default" placeholder="Tipo de regime tributário" ng-model="dataPessoaJuridica.TaxRegime" />
					</div>
					<div class="flex1">
						<label class="texto_formulario">Idade</label>
						<input type="text" class="form-control input_default date" placeholder="Data da criação" ng-model="dataPessoaJuridica.Age" />
					</div>
					<div class="flex1">
						<label class="texto_formulario">Data da fundação</label>
						<input type="text" class="form-control input_default date" placeholder="Data da criação" ng-model="dataPessoaJuridica.FoundedDate" />
					</div>
					<div class="flex1">
						<label class="texto_formulario">Data da criação</label>
						<input type="text" class="form-control input_default date" placeholder="Data da criação" ng-model="dataPessoaJuridica.CreationDate" />
					</div>
					<div class="flex1">
						<label class="texto_formulario">Data da última atualização</label>
						<input type="text" class="form-control input_default date" placeholder="Data da última atualização" ng-model="dataPessoaJuridica.LastUpdateDate" />
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- STEP2 -->
	<div ng-show="step == 2">
		<div class="div-default-shadow">
			<div class="row">
				<div class="col-md-12">
					<div class="div_analisa_flex">
						<div class="mt20 fonte_analisar" style="flex: auto;">
							{{-- <img src="{{asset('images/search_analisar_solicitacao_icn.png')}}"> --}}
							<span>
								DOCUMENTOS DA EMPRESA
							</span>
						</div>
					</div>
					<div class="faixarosa mt10"></div>
				</div>
			</div>


			<!-- CPF CNPJ -->
			<div class="mt20 dflex">
				<div class="flex1">
					<label class="texto_formulario">CPF</label>
					<input type="text" class="form-control input_default" ng-model="cpf" ng-readonly="true" placeholder="Digite o cpf" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">CNPJ</label>
					<input type="text" class="form-control input_default" ng-model="cnpj" ng-readonly="true" placeholder="Digite o cnpj" />
				</div>
				<div class="flex1">
				</div>
			</div>

			<div class="row mt40 mb20">
				<div class="col-md-12">
					<div class="faixarosa"></div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<span style="text-transform: none; font-style: italic;"> 
					VOCÊ DEVERÁ INCLUIR ARQUIVOS DE CONTRATO SOCIAL CONSOLIDADO OU CONTRATO SOCIAL E SUAS ALTERAÇÕES / FATURAMENTO DOS ÚLTIMOS 12 MESES ASSINADO PELO <b>CONTADOR E SÓCIO ADMINISTRADOR</b>.</span>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<span style="text-transform: none; font-style: italic;">Arquivos no formato: .PDF, .PNG, .JPG</span>
				</div>
			</div>

			<div class="dflex">
				<div class="flex1">
					<label class="texto_formulario">CONTRATO SOCIAL</label>
					<input type="file" file-model="myFile" class="form-control input_default filecontrato" multiple/>
				</div>
				<div class="flex1">
					<label class="texto_formulario">FATURAMENTO DOS ÚLTIMOS 12 MESES</label>
					<input type="file" file-model="myFile2" class="form-control input_default filefaturamento" multiple/>
				</div>
			</div>

		</div>
	</div>

	<!-- STEP3 -->
	<div ng-show="step == 3">
		<div class="div-default-shadow">
			<div class="row">
				<div class="col-md-12">
					<div class="div_analisa_flex">
						<div class="mt20 fonte_analisar" style="flex: auto;">
							{{-- <img src="{{asset('images/search_analisar_solicitacao_icn.png')}}"> --}}
							<span>
								ADICIONAR SÓCIOS
							</span>
						</div>
					</div>
					<div class="faixarosa mt10"></div>
				</div>
			</div>


			<!-- CPF CNPJ -->
			<div class="mt20 dflex">
				<div class="flex1">
					<label class="texto_formulario">CPF</label>
					<input type="text" class="form-control input_default cpf" ng-model="cpf" ng-readonly="true" placeholder="Digite o cpf" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">CNPJ</label>
					<input type="text" class="form-control input_default" ng-model="cnpj" ng-readonly="true" placeholder="Digite o cnpj" />
				</div>
				<div class="flex1">
				</div>
			</div>

			<div class="row mt40 mb20">
				<div class="col-md-12">
					<div class="faixarosa"></div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<span style="text-transform: none; font-style: italic;">Preencher dados dos sócios de acordo com os dados do <b>contrato social</b>.</span>
				</div>
			</div>

			<!-- SÓCIO -->
			<div id="div_socios" style="margin-top: 15px;">
				<div class="dflex" id="div_socio" ng-repeat="s in socios">
					<div class="flex1">
						<label class="texto_formulario">NOME DO SÓCIO</label>
						<input type="text" class="form-control input_default" ng-model="s.nome" placeholder="Digite o nome do sócio" ng-readonly="s.id != '' || s.principal == 1" />
					</div>
					<div class="flex1">
						<label class="texto_formulario">CPF</label>
						<input type="text" class="form-control input_default cpf" ng-model="s.cpf" placeholder="Digite o cpf do sócio" ng-readonly="s.id != '' || s.principal == 1" />
					</div>
					<div class="flex1">
						<label class="texto_formulario">EMAIL</label>
						<input type="text" class="form-control input_default" ng-model="s.email" placeholder="Digite o email do sócio" ng-readonly="s.id != '' || s.principal == 1" />
					</div>
					<div class="flex1">
						<label class="texto_formulario">CNH (CART. DE MOTORISTA) OU IDENTIDADE E CPF</label>
						<div>
							<input type="file" file-model="s.imagem" class="form-control input_default" />
						</div>
					</div>
					<div class="flex1">
						<label class="texto_formulario">&nbsp;</label>
						<div ng-show="s.principal != 1">
							<button class="btn-trash" ng-click="removeCloneSocio($index)"><i class="fa fa-trash"></i></button>
						</div>
					</div>
				</div>
			</div>

			<!-- NOVO SÓCIO -->
			<div class="dflex">
				<div class="flex1">
					<label class="texto_formulario">&nbsp;</label>
					<div>
						<button class="btn-blue" ng-click="appendClonedSocio()">ADICIONAR SÓCIO</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- STEP4 -->
	<div ng-show="step == 4">
		<div class="div-default-shadow">
			<div class="row">
				<div class="col-md-12">
					<div class="div_analisa_flex">
						<div class="mt20 fonte_analisar" style="flex: auto;">
							{{-- <img src="{{asset('images/search_analisar_solicitacao_icn.png')}}"> --}}
							<span>
								ADICIONAR CONJUGE
							</span>
						</div>
					</div>
					<div class="faixarosa mt10"></div>
				</div>
			</div>


			<!-- CPF CNPJ -->
			<div class="mt20 dflex">
				<div class="flex1">
					<label class="texto_formulario">CPF</label>
					<input type="text" class="form-control input_default cpf" ng-model="cpf" ng-readonly="true" placeholder="Digite o cpf" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">CNPJ</label>
					<input type="text" class="form-control input_default" ng-model="cnpj" ng-readonly="true" placeholder="Digite o cnpj" />
				</div>
				<div class="flex1">
				</div>
			</div>

			<div class="row mt40 mb20">
				<div class="col-md-12">
					<div class="faixarosa"></div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<span style="text-transform: none; font-style: italic;">Preencher dados do cônjuge. Caso solteiro, não é necessário o preenchimento.</span>
				</div>
			</div>

			<!-- Cônjuge -->
			<div id="div_conjuge" style="margin-top: 15px;">
				<div class="dflex" id="div_conjuge" ng-repeat="s in socios">
					<div class="flex1">
						<label class="texto_formulario">NOME DO SÓCIO</label>
						<input type="text" class="form-control input_default" ng-model="s.nome" placeholder="Digite o nome do sócio" ng-readonly="s.id != '' || s.principal == 1" />
						<input type="hidden" ng-model="conjuge.id" ng-value="s.id">
					</div>
					<div class="flex1">
						<label class="texto_formulario">NOME DO CÔNJUGE</label>
						<input type="text" class="form-control input_default" ng-model="s.cnome" placeholder="Digite o nome do cônjuge"/>
					</div>
					<div class="flex1">
						<label class="texto_formulario">CPF</label>
						<input type="text" class="form-control input_default cpf" ng-model="s.ccpf" placeholder="Digite o cpf do cônjuge" />
					</div>
					<div class="flex1">
						<label class="texto_formulario">EMAIL</label>
						<div>
						<input type="text" class="form-control input_default email" ng-model="s.cemail" placeholder="Digite o email do cônjuge"/>
						</div>
					</div>
				</div>
			</div>

			<!-- NOVO SÓCIO -->
			<div class="dflex">
				<div class="flex1">
					<label class="texto_formulario">&nbsp;</label>
					<div>
						<button class="btn-blue" ng-click="appendClonedSocio()">ADICIONAR CONJUGE</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- STEP5 -->
	<div ng-show="step == 5">
		<div class="div-default-shadow">
			<div class="row">
				<div class="col-md-12">
					<div class="div_analisa_flex">
						<div class="mt20 fonte_analisar" style="flex: auto;">
							{{-- <img src="{{asset('images/search_analisar_solicitacao_icn.png')}}"> --}}
							<span>
								CADASTRE UMA CONTA BANCÁRIA
							</span>
						</div>
					</div>
					<div class="faixarosa mt10"></div>
				</div>
			</div>


			<!-- CPF CNPJ -->
			<div class="mt20 dflex">
				<div class="flex1">
					<label class="texto_formulario">CPF</label>
					<input type="text" class="form-control input_default" ng-model="cpf" ng-readonly="true" placeholder="Digite o cpf" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">CNPJ</label>
					<input type="text" class="form-control input_default" ng-model="cnpj" ng-readonly="true" placeholder="Digite o cnpj" />
				</div>
				<div class="flex1">
				</div>
			</div>

			<div class="row mt40 mb20">
				<div class="col-md-12">
					<div class="faixarosa"></div>
				</div>
			</div>

			<!-- CONTA BANCARIA -->
			<div id="div_contas mt20">
				<div class="dflex" id="div_conta" ng-repeat="c in contas">
					<div class="flex1">
						<label class="texto_formulario">AGÊNCIA</label>
						<input type="text" class="form-control input_default" ng-model="c.agencia" placeholder="XXXX" ng-readonly="c.id != ''" />
					</div>
					<div class="flex1">
						<label class="texto_formulario">CONTA</label>
						<input type="text" class="form-control input_default" ng-model="c.conta" placeholder="XXXXXX-X" ng-readonly="c.id != ''" />
					</div>
					<div class="flex1">
						<label class="texto_formulario">DIGITO</label>
						<input type="text" class="form-control input_default" ng-model="c.digito" placeholder="X" ng-readonly="c.id != ''" />
					</div>
					<div class="flex1">
						<label class="texto_formulario">BANCO</label>
						<select class="form-control input_default" ng-model="c.banco" style="border-color: #ccc;" ng-readonly="c.id != ''">
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
					<div class="flex1">
						<label class="texto_formulario">&nbsp;</label>
						<div>
							<button class="btn-trash" ng-click="removeCloneConta($index)"><i class="fa fa-trash"></i></button>
						</div>
					</div>
				</div>
			</div>

			<!-- NOVA CONTA BANCARIA -->
			<div class="dflex">
				<div class="flex1">
					<label class="texto_formulario">&nbsp;</label>
					<div>
						<button class="btn-blue" ng-click="appendClonedConta()">ADICIONAR OUTRA CONTA</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Navegação -->
	<div class="dflex">
		<div class="flex1 div_absolute_rodape">
			<div ng-click="voltaStep()" class="div_back_next" ng-show="step!=1"><img src="{{asset('/images/anterior_icn.png')}}">ANTERIOR</div>
			<div ng-click="voltaStep()" class="div_back_next" ng-show="step==1"></div>
			<div class="icons_steps">
				<img src="{{asset('/images/step_preenchido_icn.png')}}" ng-show="step==1"> <img src="{{asset('/images/step_vazio_icn.png')}}" ng-show="step!=1">
				<img src="{{asset('/images/step_preenchido_icn.png')}}" ng-show="step==2"> <img src="{{asset('/images/step_vazio_icn.png')}}" ng-show="step!=2">
				<img src="{{asset('/images/step_preenchido_icn.png')}}" ng-show="step==3"> <img src="{{asset('/images/step_vazio_icn.png')}}" ng-show="step!=3">
				<img src="{{asset('/images/step_preenchido_icn.png')}}" ng-show="step==4"> <img src="{{asset('/images/step_vazio_icn.png')}}" ng-show="step!=4">
				<img src="{{asset('/images/step_preenchido_icn.png')}}" ng-show="step==5"> <img src="{{asset('/images/step_vazio_icn.png')}}" ng-show="step!=5">
			</div>
			<div ng-show="step < 5" ng-click="avancaStep()" class="div_back_next">PRÓXIMO <img src="{{asset('/images/proximo_icn.png')}}"></div>
			<div ng-show="step == 5 && (contas.length > 0 && contas[0].agencia != '' && contas[0].conta != '' && contas[0].digito != '' && contas[0].banco != '')" ng-click="finalizarStep()" class="div_back_next">FINALIZAR <img src="{{asset('/images/proximo_icn.png')}}"></div>
		</div>
	</div>

	<!-- Modal Sucesso -->
	<div ng-show="showModal == 1">
		<div class="overlay"></div>
		<div class="div_modal_absolute">
			<div class="text-center">
				<h4><img src="{{asset('images/cadastrado_p_icn.png')}}"> CADASTRO FINALIZADO</h4>
				Ele será analisado para eventual geração de limite de crédito e taxa de deságio.
				A qualquer momento você receberá mais informações pelo e-mail cadastrado!
			</div>
			<div class="text-center">
				<!--<div><img src="{{asset('/images/cadastrado_g_icn.png')}}"></div>-->
				<div style="text-align: center; margin-top: 40px;" ><a href="{{route('ativo.credito')}}" class="btn-verificar">ENTENDI</a></div>
			</div>
		</div>
	</div>

	<div ng-show="showModal == 3">
		<div class="overlay"></div>
		<div class="div_modal_absolute">
			<div>
				<h4>O QUE VOCÊ IRÁ PRECISAR</h4>
			</div>
			<div class="text-center">
				<div>- CONTRATO SOCIAL CONSOLIDADO OU CONTRATO SOCIAL E SUAS ALTERAÇÕES</div>
				<div>- FATURAMENTO DOS ÚLTIMOS 12 MESES ASSINADO PELO CONTADOR E SÓCIO ADMINISTRADOR</div>
				<div>- CNH (CARTEIRA DE MOTORISTA) OU IDENTIDADE E CPF DOS SÓCIOS</div>
				<div style="text-align: center; margin-top: 40px;" ng-click="closeModal()"><a class="btn-verificar">CONTINUAR</a></div>
			</div>
		</div>
	</div>


	<!-- Modal Error -->
	<div ng-show="showModal == 2">
		<div class="overlay"></div>
		Erro
	</div>
</div>
<script type="text/javascript" src="{{asset('js/cliente/jquery.min.js')}}"></script><!-- jQuery -->
<script type="text/javascript" src="{{asset('js/cliente/mask.min.js')}}"></script><!-- Responsive Tables -->

<script>
	var app = angular.module('myApp', []);
        app.config(function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
		});
	app.directive('fileModel', ['$parse', function($parse) {
		return {
			restrict: 'A',
			link: function(scope, element, attrs) {
				var model = $parse(attrs.fileModel);
				var modelSetter = model.assign;
				element.bind('change', function() {
					scope.$apply(function() {
						modelSetter(scope, element[0].files[0]);
					});
				});
			}
		};
	}]);

	app.service('fileUpload', ['$http', function($http) {
		this.uploadFileToUrl = function(file, uploadUrl) {
			var fd = new FormData();
			fd.append('file',file);
			$http.post(uploadUrl, fd, {
					transformRequest: angular.identity,
					headers: {
						'Content-Type': undefined
					}
				})
				.success(function() {})
				.error(function() {});
		}
		this.uploadMultipleFileToUrl = function(files, uploadUrl) {
			var fd = new FormData();
			for(let i in files){
				fd.append('item_file[]', files[i]);
			}
			$http.post(uploadUrl, fd, {
					transformRequest: angular.identity,
					headers: {
						'Content-Type': undefined
					}
				})
				.success(function() {})
				.error(function() {});
		}
	}]);

	app.controller('myCtrl', ['$scope', '$http', 'fileUpload', function($scope, $http, fileUpload) {
		$scope.step = 1;
		$scope.dados = [];
		$scope.socios = [];
		$scope.contas = [];
		$scope.conjuge = [];
		$scope.dataPessoaFisica = {};
		$scope.dataPessoaJuridica = {};
		$scope.pessoa = 1;
		$scope.showModal = 3;
		$scope.contrato_social = '';
		$scope.cpfSocio = 0;
		$scope.cpfInvalido = []
		$scope.myFile = []
		$scope.idcliente = "{{$cliente->id}}";

		// request inicial
		var contasGet = "<?=route('cliente.contas','id='.$cliente->id)?>";
		$http.get(contasGet)
			.success(function(data) {
				$scope.contas = data;
			})

		// request inicial
		var sociosGet = "<?=route('cliente.socios','id='.$cliente->id)?>";
		$http.get(sociosGet)
			.success(function(data) {
				$scope.socios = data;
			})

		//validação de cpf, só deve deixar chamar 1 vez por cpf/cnpj
		$scope.verificaCpf = function() {
			$scope.cpf = "{{$cliente->cpf}}";
			$scope.cnpj = "{{$cliente->cnpj}}";

			$http.post("<?=route('register.step1',['type' => 'cpf','id' => $cliente->id])?>").success(function(data) {
				if (data.Result[0].BasicData.Age) {
					$scope.dataPessoaFisica = data.Result[0].BasicData;
					$scope.dataPessoaFisica.BirthDate = $scope.dataPessoaFisica.BirthDate ? moment($scope.dataPessoaFisica.BirthDate).add(1, 'day').format('DD/MM/YYYY') : ''
				} else {
					console.log('CPF não existente');
				}
			});
			$scope.verificaCnpj();
		}

		$scope.closeModal = function() {
			$scope.showModal = 0;
		}
		//validação de cnpj, só deve deixar chamar 1 vez por cpf/cnpj
		$scope.verificaCnpj = function() {
			$http.post("<?=route('register.step1',['type' => 'cnpj','id' => $cliente->id])?>").success(function(data) {
				if (data.Result[0].BasicData.TaxIdNumber) {
					$scope.dataPessoaJuridica = data.Result[0].BasicData;
					$scope.dataPessoaJuridica.ClosedDate = $scope.dataPessoaJuridica.ClosedDate ? moment($scope.dataPessoaJuridica.ClosedDate).add(1, 'day').format('DD/MM/YYYY') : ''
					$scope.dataPessoaJuridica.FoundedDate = $scope.dataPessoaJuridica.FoundedDate ? moment($scope.dataPessoaJuridica.FoundedDate).add(1, 'day').format('DD/MM/YYYY') : ''
					$scope.dataPessoaJuridica.CreationDate = $scope.dataPessoaJuridica.CreationDate ? moment($scope.dataPessoaJuridica.CreationDate).add(1, 'day').format('DD/MM/YYYY') : ''
					$scope.dataPessoaJuridica.LastUpdateDate = $scope.dataPessoaJuridica.LastUpdateDate ? moment($scope.dataPessoaJuridica.LastUpdateDate).add(1, 'day').format('DD/MM/YYYY') : ''
				} else {
					console.log('CNPJ não existente');
				}
			});
		}

		//atualiza dados
		$scope.atualizaDados = function() {
			console.log('atualiza');
		}

		//avançar
		$scope.avancaStep = function() {
			if ($scope.step == 1) {
				var register = "<?=route('register.dados.basicos')?>";
				$scope.showModal = 0;
				$http.post(register, {
					'fisica': $scope.dataPessoaFisica,
					'juridica': $scope.dataPessoaJuridica,
					'cpf': $scope.cpf,
					'cnpj': $scope.cnpj,
					'idcliente': $scope.idcliente
				}).success(function(data) {
					console.log('Atualizado com sucesso');
				})
			}

			if ($scope.step == 2) {
				if ($scope.myFile != undefined && $scope.myFile2 != undefined) {
					var contrato 		= $scope.myFile;
					var faturamento 	= $scope.myFile2;
					var uploadUrl = "<?=route('register.contrato.faturamento','acao=contrato_social&id='.$cliente->id)?>";

					const contratos = $(".filecontrato")[0].files;
					fileUpload.uploadMultipleFileToUrl(contratos, uploadUrl);

					var uploadUrl2 		= "<?=route('register.contrato.faturamento','acao=faturamento&id='.$cliente->id)?>";
					const faturamentos = $(".filefaturamento")[0].files;
					fileUpload.uploadMultipleFileToUrl(faturamentos, uploadUrl2);

					if ($scope.socios.length == 0) {
						$scope.socios.push({
							id: '',
							nome: $scope.dataPessoaFisica.Name,
							cpf: $scope.cpf,
							imagem: '',
							principal: 1
						});
					}
				} else {
					alert('Selecione um arquivo de Contrato Social / Faturamento.')
					return false;
				}
			}

			if ($scope.step == 3) {
				var imagem_socio = 0;
				$scope.socios.map((v) => {
					if (!TestaCPF(v.cpf)) {
						$scope.cpfSocio = 1;
						$scope.cpfInvalido = [...$scope.cpfInvalido, v.cpf];
					}
					if(v.imagem == undefined || v.imagem == null || v.imagem == ''){
						imagem_socio = 1;
					}
				})
				/*if(($scope.conjuge.nome == '' || $scope.conjuge.nome == undefined || $scope.conjuge.nome == null) && $scope.dataPessoaFisica.EstadoCivil == 'CASADO'){
					alert('Informe o nome do cônjuge');
					return false;
				}
				if(($scope.conjuge.cpf == '' || $scope.conjuge.cpf == undefined || $scope.conjuge.cpf == null) && $scope.dataPessoaFisica.EstadoCivil == 'CASADO'){
					alert('Informe o cpf do cônjuge');
					return false;
				}
				if(($scope.conjuge.email == '' || $scope.conjuge.email == undefined || $scope.conjuge.email == null) && $scope.dataPessoaFisica.EstadoCivil == 'CASADO'){
					alert('Informe o email do cônjuge');
					return false;
				}*/
				if(imagem_socio == 1){
					alert('Selecionar uma imagem de documento.');
					return false;
				}
				if ($scope.cpfSocio == 1) {
					if($scope.cpfInvalido.length > 1){
						const txt = `Ops, CPF(s) inválido(s)! ${$scope.cpfInvalido.join(', ')}`;
						alert(txt)
					}else{
						const txt = `Ops, CPF inválido! ${$scope.cpfInvalido.join(', ')}`;
						alert(txt)
					}
					$scope.cpfSocio = 0;
					$scope.cpfInvalido = [];
					return false;
				}
				$scope.socios.map((v) => {
					var registerSocios 		= "<?=route('register.socios')?>";
					$http.post(registerSocios, {
						'socios': v,
						'idcliente': $scope.idcliente
					}).success(function(data) {
						console.log(data);
						var uploadUrl5 = "<?= route('register.socios.upload','idcliente='.$cliente->id.'&idsocio=')?>"+ data;
						fileUpload.uploadFileToUrl(v.imagem, uploadUrl5);
					})
				})
				$http.get(sociosGet)
				.success(function(data) {
					$scope.socios = data;
				})
			}

			if($scope.step == 4){
				console.log('estoura o rojaozito');
				$scope.socios.map((a) => {
					var registerConjuge	= "<?=route('register.conjuge')?>";
					console.log(a);
					$http.post(registerConjuge, {
						'conjuge': a,
						'id': $scope.idcliente,
					}).success(function(data) {
						console.log(data);
					})
				})
				$http.get(sociosGet)
				.success(function(data) {
					$scope.socios = data;
				})
			}

			if ($scope.step < 5) {
				$scope.step++;
			}
		}

		//voltar
		$scope.voltaStep = function() {
			if ($scope.step > 1) {
				$scope.step--;
			}
		}

		//finalizar step
		$scope.finalizarStep = function() {
			if ($scope.pessoa == 1 || $scope.pessoa == 2) {
				var endereco 		= "<?=route('api.endereco')?>";
				$http.post(endereco, {
					'doc': $scope.cpf,
					'idcliente': $scope.idcliente
				}).success(function(data) {
					console.log('sucesso')
					})

					//Verificar endereços juridico
					var enderecoJur 		= "<?=route('api.endereco.juridica')?>";
					$http.post(enderecoJur, {
						'doc': $scope.cnpj,
						'idcliente': $scope.idcliente
					}).success(function(data) {
						console.log('sucesso')
						if (data.retorno == 'success') {
								var updateConta 		= "<?=route('cliente.update.contas')?>";
								$http.post(updateConta, {
									'contas': $scope.contas,
									'idcliente': $scope.idcliente
								}).success(function(data) {
									$scope.showModal = 1;
								});
							} else {
								$scope.showModal = 2;
							}
						})
			}
		}


		$scope.mudaStep = function(v) {
			$scope.step = v;
		}

		$scope.trocarPessoa = function(v) {
			$scope.pessoa = v;
		}

		$scope.appendClonedSocio = function() {
			$scope.socios.push({
				id: '',
				nome: '',
				cpf: '',
				email:'',
				imagem: ''
			});
		}

		$scope.appendClonedConta = function() {
			$scope.contas.push({
				id: '',
				agencia: '',
				conta: '',
				digito: '',
				banco: ''
			});
		}

		$scope.removeCloneConta = function(index) {
			$scope.contas.splice(index, 1)
		}

		$scope.removeCloneSocio = function(index) {
			if ($scope.socios[index].id != '') {
				$http.get("steps/api/cliente.php?acao=deletarSocios&id=" + $scope.socios[index].id)
					.success(function(data) {

					})
			}
			$scope.socios.splice(index, 1)
		}



		//Verificação, limitar 1 por CPF e CNPJ, não precisa fazer novamente, levar campo para o banco para saber que foi feito
		//Quando a leitura falha, deixar ele colocar na mão
		//Socios já na tela de cadastro, tentar buscar no bigboost
		//Quando finalizar o flow de cadastro já levar para dash
		//gravar na solicitacao e no user

	}]);
</script>
<script>
	$('.cpf').mask('000.000.000-00', {
		reverse: true
	});
	$('.cnpj').mask('00.000.000/0000-00', {
		reverse: true
	});
	$('.date').mask('00/00/0000');

	function TestaCPF(strCPF) {
		var Soma;
		var Resto;
		Soma = 0;
		strCPF = strCPF.replace(/[^\d]+/g, '');
		if (strCPF == "00000000000") return false;

		for (i = 1; i <= 9; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
		Resto = (Soma * 10) % 11;
		if ((Resto == 10) || (Resto == 11)) Resto = 0;
		if (Resto != parseInt(strCPF.substring(9, 10))) return false;
		Soma = 0;
		for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
		Resto = (Soma * 10) % 11;

		if ((Resto == 10) || (Resto == 11)) Resto = 0;
		if (Resto != parseInt(strCPF.substring(10, 11))) return false;
		return true;
	}
</script>
@endsection
