@extends('layouts.admin.topo')
@section('content')
@include('layouts/admin/solicitacao')
<style>
 .drawer-navbar{
	 display: none;
 }
 .rodape{
	display: none;
}

.alert{
	margin-right: 300px;
    margin-left: 300px;
}
</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js">
</script>
<div class="container-fluid" ng-app="myApp" ng-controller="myCtrl" style="margin-bottom: 50px;">
	<div class="row">
		<div class="col-md-12 text-right mt30">
			<a href="{{route('admin.solicitacoes')}}"><i class="fa fa-times" style="color: #BFBFBF; font-size: 26px;"></i></a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
		<form method="POST" action="{{route('admin.update.status',$id)}}" id="atualiza_status">
			@csrf
			<input type="hidden" id="status" name="status">
			<input type="hidden" id="solicitante" name="solicitante" value="{{isset($solicitante) ? $solicitante[0]->id : '' }}">
			<div class="div_analisa_flex">
				<div class="mt20 fonte_analisar" style="flex: auto;">
					<img src="{{asset('images/search_analisar_solicitacao_icn.png')}}">
					<span>
						ANALISAR SOLICITAÇÃO
					</span>
				</div>
				<div class="mt20 text-center" style="flex: auto; display: flex; flex-direction: row; flex-direction: row; justify-content: center; align-items: center;">
					<a onclick="aprova()" id="aprovado" value="1" class="botao_aprovado {{$solicitacao->id_status == 1 ? 'active' : '' }}">
						{{$solicitacao->id_status == 1 ? 'APROVADO' : 'APROVAR' }}	
					</a>
					<a onclick="pendente()" class="botao_boleto {{ $solicitacao->id_status == 2 ? 'active' : '' }}">
						PENDENTE		
					</a>
					<a onclick="recusa()" class="botao_recusado {{ $solicitacao->id_status == 3 ? 'active' : '' }}">
						{{ $solicitacao->id_status == 3 ? 'RECUSADO' : 'RECUSAR' }}
					</a>
				</div>
			</div>
		</form>
			<div class="row">
				<div class="col-md-12" style="display: flex; justify-content: flex-end;">
					<div style="display: flex; flex-direction: column">
						<div><i>Banco e Agencia</i></div>
							<div style="display: flex;">
								<input type="text" id="conta" name="conta" value="{{$conta->banco}} - {{$conta->agencia}}" class="form-control" placeholder="Conta selecionada" style="width: 140px; height: 40px; border-radius: 0px; border-color: #F11070 !important; border-right: none;">
								<button style="width: 1px; height: 40px; background-color: #F11070; border-color: #F11070;" >
								</button>
							</div>
					</div>

					<div style="display: flex; margin-left: 20px; flex-direction: column">
						<div><i>Conta Selecionada</i></div>
							<div style="display: flex;">
								<input type="text" id="conta" name="conta" value="{{$conta->conta}}-{{$conta->digito}}" class="form-control" placeholder="Conta selecionada" style="width: 140px; height: 40px; border-radius: 0px; border-color: #F11070 !important; border-right: none;">
								<button style="width: 5px; height: 40px; background-color: #F11070; border-color: #F11070;" >
								</button>
							</div>
					</div>

					<div style="display: flex; margin-left: 20px; flex-direction: column">
						<div><i>Limite de Crédito</i></div>
						<form method="POST" id="credito" action="{{isset($solicitante) ? route('admin.update.credito',$solicitante[0]->id) : ''}}">
							@csrf
							<input type="hidden" id="solicitacao" name="solicitacao" value="{{$solicitacao->id}}">
							<div style="display: flex;">
								<input type="text" id="credito" name ="credito" value="{{$solicitacao->credito}}" onkeyup="moeda(this)" class="form-control porcentagem" placeholder="Digite o credito" style="width: 140px; height: 40px; border-radius: 0px; border-color: #F11070 !important; border-right: none;">
								<button type="submit" style="width: 50px; height: 40px; background-color: #F11070; border-color: #F11070;" >
									<i class="fa fa-save" style="color: #FFF;"></i>
								</button>
							</div>
						</form>
					</div>
					
					<div class="" style="display: flex; margin-left: 20px; flex-direction: column">
						<div><i>Porcentagem de Juros</i></div>
						<form method="POST" action="{{isset($solicitante) ? route('admin.update.juros',$solicitacao->id) : ''}}">
							@csrf
							<div style="display: flex;">
								<input type="text" id="juros" name="juros" value="{{isset($solicitante[0]->taxa_desagio) ? $solicitante[0]->taxa_desagio : 1.99 }}" class="form-control porcentagem" placeholder="Digite a % de juros" style="width: 140px; height: 40px; border-radius: 0px; border-color: #F11070 !important; border-right: none;">
								<button type="submit" style="width: 50px; height: 40px; background-color: #F11070; border-color: #F11070;">
									<i class="fa fa-save" style="color: #FFF;"></i>
								</button>
							</div>
					</div>
				</div>
			</div>
			<div class="faixarosa mt10">

			</div>
		</div>
	</div>

	<div class="row mt20" style="display: flex; align-items: center;">
		<div class="col-md-5 text-left">
			<b>NOTA</b>
			<br><i style="text-decoration: underline;">{{$solicitacao->id_nota}}</i>
		</div>
		<div class="col-md-7 text-right">
			@if($solicitacao->arquivo_xml)
					<a href="{{asset('/cliente/uploads/xml/'.$solicitacao->arquivo_xml)}}" target="_blank" class="botao_blue" download>
						<i class="fa fa-download" style="font-size: 14px;"></i>
						<span>ARQUIVO XML</span>
					</a>
			@endif
			<a href="http://www.nfe.fazenda.gov.br/portal/consultaRecaptcha.aspx?tipoConsulta=completa&tipoConteudo=XbSeqxE8pl8=" target="_blank" class="botao_default">
				<i class="fa fa-link" style="font-size: 14px;"></i>
				<span>ACESSAR PORTAL</span>
			</a>
			@if($solicitacao->id_status == 1)
					<a href="{{route('bordero',$solicitacao->id)}}" target="_blank" class="botao_pink">
						<i class="fa fa-file" style="font-size: 14px;"></i>
						<span>BORDERÔ</span>
					</a>
			@endif
			<a href="{{isset($boleto) ? route('admin.solicitacao.boletos',$solicitacao->id): route('admin.solicitacao.boletos',$solicitacao->id)}}" target="_blank" class="botao_pink">
				<i class="fa fa-barcode" style="font-size: 14px;"></i>
				<span>BOLETO</span>
			</a>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 text-left mt20">
			<span>CLIENTE</span>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="div_cliente_flex mt10">
				<div class="cinzasacado" ng-class="abaCliente == 1?'active':''" ng-click="trocaCliente(1)" style="flex: 1; margin: 2px;">
					<span>SACADOR: <b>{{$solicitacao->nome_empresa_sacador}}</b></span>
					<a href="{{isset($solicitante) ? route('admin.clientes.view',$solicitante[0]->id) : ''}}" target="_blank"><i class="fa fa-eye"></i></a>
				</div>
				<div class="cinzasacado" ng-class="abaCliente == 2?'active':''" ng-click="trocaCliente(2)" style="flex: 1; margin: 2px;">
					<span>SACADO: <b>{{isset($sacado) ? $sacado[0]->Name : ''}}</b></span>
					<a href="{{isset($sacado) ? route('admin.clientes.view',$sacado[0]->id) : ''}}" target="_blank"><i class="fa fa-eye"></i></a>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 text-left mt20">
			<span>PESSOA</span>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="div_cliente_flex mt10" id="myTab">
					<div class="cinzasacado" ng-class="abaPessoa == 1?'active':''" ng-click="trocaPessoa(1)" style="flex: 1; margin: 2px;">
						<span><b>PESSOA FÍSICA</b></span>
					</div>
					<div class="cinzasacado" ng-class="abaPessoa == 2?'active':''" ng-click="trocaPessoa(2)" style="flex: 1; margin: 2px;">
						<span><b>PESSOA JURÍDICA</b></span>
					</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="div_cliente_flex mt50 text-center" ng-show="abaPessoa == 1">
				<div class="cinzacategorias text-center" ng-class="etapaFisica == 1?'active':''" ng-click="subCategoria(1, 1)">
					<span>FATURAS</span>
				</div>
				<div class="cinzacategorias text-center" ng-class="etapaFisica == 2?'active':''" ng-click="subCategoria(2, 1)">
					<span>DADOS DO CLIENTE</span>
				</div>
				<div class="cinzacategorias text-center" ng-class="etapaFisica == 3?'active':''" ng-click="subCategoria(3, 1)">
					<span>ENDEREÇOS</span>
				</div>
				<div class="cinzacategorias text-center" ng-class="etapaFisica == 4?'active':''" ng-click="subCategoria(4, 1)">
					<span>TELEFONES</span>
				</div>
				<!--<div class="cinzacategorias text-center" ng-class="etapaFisica == 5?'active':''" ng-click="subCategoria(5, 1)">
					<span>SPC BRASIL COM SCORE</span>
				</div>-->
				<div class="cinzacategorias text-center" ng-class="etapaFisica == 6?'active':''" ng-click="subCategoria(6, 1)">
					<span>DADOS PROFISSIONAIS</span>
				</div>
				<div class="cinzacategorias text-center" ng-class="etapaFisica == 7?'active':''" ng-click="subCategoria(7, 1)">
					<span>INFORMACOES FINANCEIRAS</span>
				</div>
				<!--<div class="cinzacategorias text-center" ng-class="etapaFisica == 8?'active':''" ng-click="subCategoria(8, 1)">
					<span>KYC</span>
				</div>
				<div class="cinzacategorias text-center" ng-class="etapaFisica == 9?'active':''" ng-click="subCategoria(9, 1)">
					<span>PROCESSOS</span>
				</div>
				<div class="cinzacategorias text-center" ng-class="etapaFisica == 10?'active':''" ng-click="subCategoria(10, 1)">
					<span>RELACIONAMENTOS</span>
				</div>-->
				<div class="cinzacategorias text-center" ng-class="etapaFisica == 11?'active':''" ng-click="subCategoria(11, 1)">
					<span>VEICULOS</span>
				</div>
				<div class="cinzacategorias text-center" ng-class="etapaFisica == 12?'active':''" ng-click="subCategoria(12, 1)">
					<span>ANTECEDENTES CRIMINAIS</span>
				</div>
			</div>

			<div class="div_cliente_flex mt50 text-center" ng-show="abaPessoa == 2">
				<div class="cinzacategorias text-center" ng-class="etapaJuridica == 1?'active':''" ng-click="subCategoria(1, 2)">
					<span>FATURAS</span>
				</div>
				<div class="cinzacategorias text-center" ng-class="etapaJuridica == 2?'active':''" ng-click="subCategoria(2, 2)">
					<span>DADOS CADASTRAIS BÁSICOS</span>
				</div>
				<div class="cinzacategorias text-center" ng-class="etapaJuridica == 3?'active':''" ng-click="subCategoria(3, 2)">
					<span>ENDEREÇOS</span>
				</div>
				<div class="cinzacategorias text-center" ng-class="etapaJuridica == 4?'active':''" ng-click="subCategoria(4, 2)">
					<span>TELEFONES</span>
				</div>
				<!--<div class="cinzacategorias text-center" ng-class="etapaJuridica == 5?'active':''" ng-click="subCategoria(5, 2)">
					<span>SPC BRASIL COM SCORE</span>
				</div>-->
				<!--<div class="cinzacategorias text-center" ng-class="etapaJuridica == 6?'active':''" ng-click="subCategoria(6, 2)">
					<span>GRUPOS ECONOMICOS</span>
				</div>-->
				<div class="cinzacategorias text-center" ng-class="etapaJuridica == 7?'active':''" ng-click="subCategoria(7, 2)">
					<span>INDICADORES DE ATIVIDADE</span>
				</div>
				<!--<div class="cinzacategorias text-center" ng-class="etapaJuridica == 8?'active':''" ng-click="subCategoria(8, 2)">
					<span>KYC</span>
				</div>
				<div class="cinzacategorias text-center" ng-class="etapaJuridica == 9?'active':''" ng-click="subCategoria(9, 2)">
					<span>PROCESSOS</span>
				</div>
				<div class="cinzacategorias text-center" ng-class="etapaJuridica == 10?'active':''" ng-click="subCategoria(10, 2)">
					<span>RELACIONAMENTOS</span>
				</div>-->
			</div>

			<div class="linhaazul">
			</div>
		</div>
	</div>

	<!-- Tabela de parcelas -->
	<div class="row mt20" ng-show="etapaFisica == 1 && abaPessoa == 1 || etapaJuridica == 1 && abaPessoa == 2">
		<div class="col-md-12">
			<div class="text-center">
				<table data-table-list class="table table-responsive table-striped tabela_padrao" id="tabela_clicavel">
					<thead>
						<tr>
							<th class="text-center">PARCELAS</th>
							<th class="text-center">DATA</th>
							<th class="text-center">VALOR DA PARCELA</th>
							<th class="text-center">VALOR JUROS</th>
							<th class="text-center">VALOR A RECEBER</th>
							<th class="text-center"></th>
						</tr>
					</thead>
					<tbody>
					@foreach($parcelas as $parcela)
							<?php
							$v_parcela  = str_replace('.', '', $parcela->valor_parcela);
							$v_parcela  = str_replace(',', '.', $v_parcela);
							$v_juros    = str_replace('.', '', $parcela->valor_juros);
							$v_juros    = str_replace(',', '.', $v_juros); ?>
							<tr>
								<td class="text-center">{{$parcela->numero}}</td>
								<td class="text-center">{{$parcela->vencimento}}</td>
								<td class="text-center">R$ {{$parcela->valor_parcela}}</td>
								<td class="text-center">R$ {{number_format($v_parcela - $v_juros, 2, ',', '.')}}</td>
								<td class="text-center">R$ {{$v_juros}}</td>
								<td class="text-center"></td>
							</tr>
					@endforeach
					</tbody>
					<thead>
						<tr>
							<th class="text-center funrosatab"></th>
							<th class="text-center funrosatab"></th>
							<th class="text-center funrosatab"></th>
							<th class="text-center funrosatab">JUROS TOTAL</th>
							<th class="text-center funrosatab">TOTAL A RECEBER</th>
							<th class="text-center funrosatab"></th>
						</tr>
					</thead>
					<tbody>
						<tr class="clickable-row" data-href="">
							<td class="text-center funtabsolic"></td>
							<td class="text-center funtabsolic"></td>
							<td class="text-center funtabsolic"></td>
							<td class="text-center funtabsolic">{{$solicitante[0]->taxa_desagio}} %</td>
							<td class="text-center funtabsolic">R$ {{$solicitacao->valor_total_juros}}</td>
							<td class="text-center funtabsolic"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Sacador	 -->
	<!-- Fisica -->
	<div class="row mt20" ng-show="abaCliente == 1 && etapaFisica == 2 && abaPessoa == 1">
		<div class="col-md-12">
			<!-- Dados Pessoa -->
			<div class="dflex fwrap">
				<div class="flex1">
					<label class="texto_formulario">Nome</label>
					<input type="text" class="form-control input_default" readonly placeholder="Nome" value="{{isset($solicitante) ? $solicitante[0]->Name : ''}}" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Sexo</label>
					<input type="text" class="form-control input_default" readonly placeholder="Sexo" value="{{isset($solicitante) ? $solicitante[0]->Gender : ''}}" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Data de Nascimento</label>
					<input type="text" class="form-control input_default" readonly placeholder="Data de Nascimento" value="{{isset($solicitante) ? $solicitante[0]->BirthDate : ''}}" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Nacionalidade</label>
					<input type="text" class="form-control input_default" readonly placeholder="Nacionalidade" value="{{isset($solicitante) ? $solicitante[0]->BirthCountry : ''}}" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Estado</label>
					<input type="text" class="form-control input_default" readonly placeholder="Estado" value="{{isset($solicitante) ? $solicitante[0]->BirthState : ''}}" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Nome da mãe</label>
					<input type="text" class="form-control input_default" readonly placeholder="Nome da mãe" value="{{isset($solicitante) ? $solicitante[0]->MotherName : ''}}" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Nome do Pai</label>
					<input type="text" class="form-control input_default" readonly placeholder="Nome do Pai" value="{{isset($solicitante) ? $solicitante[0]->FatherName  : ''}}" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Indicação de falecimento</label>
					<input type="text" class="form-control input_default" readonly placeholder="Indicação de falecimento" value="{{isset($solicitante) ? $solicitante[0]->HasObitIndication : ''}}" />
				</div>
			</div>
		</div>
	</div>

	<div class="row mt20" ng-show="abaCliente == 1 && etapaFisica == 3 && abaPessoa == 1">
		<div class="col-md-12">
			<!-- Dados Pessoa -->
			<div class="dflex fwrap">
				<div class="flex1">
					<label class="texto_formulario">Logradouro</label>
					<input type="text" class="form-control input_default" placeholder="Logradouro" value="{{isset($sol_fis_endereco) ? $sol_fis_endereco[0]->Endereco_Lgr : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Nro</label>
					<input type="text" class="form-control input_default" placeholder="Nro" value="{{isset($sol_fis_endereco) ? $sol_fis_endereco[0]->Endereco_Nro : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Complemento</label>
					<input type="text" class="form-control input_default" placeholder="Complemento" value="{{isset($sol_fis_endereco) ? $sol_fis_endereco[0]->Endereco_Complemento : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Bairro</label>
					<input type="text" class="form-control input_default" placeholder="Bairro" value="{{isset($sol_fis_endereco) ? $sol_fis_endereco[0]->Endereco_Bairro : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Município</label>
					<input type="text" class="form-control input_default" placeholder="Município" value="{{isset($sol_fis_endereco) ? $sol_fis_endereco[0]->Endereco_Mun : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">UF</label>
					<input type="text" class="form-control input_default" placeholder="UF" value="{{isset($sol_fis_endereco) ? $sol_fis_endereco[0]->Endereco_UF : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">CEP</label>
					<input type="text" class="form-control input_default" placeholder="CEP" value="{{isset($sol_fis_endereco) ? $sol_fis_endereco[0]->Endereco_CEP : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">País</label>
					<input type="text" class="form-control input_default" placeholder="País" value="{{isset($sol_fis_endereco) ? $sol_fis_endereco[0]->Endereco_Pais : ''}}" readonly />
				</div>
			</div>
		</div>
	</div>

	<div class="row mt20" ng-show="abaCliente == 1 && etapaFisica == 4 && abaPessoa == 1">
		<div class="col-md-12">
			<div class="dflex fwrap" style="justify-content: initial;">
				<div class="flex1" style="flex: initial;">
					<label class="texto_formulario">Telefone</label>
					<input type="text" class="form-control input_default" placeholder="Telefone" value="{{isset($solicitante) ? $solicitante[0]->telefone : ''}}" readonly />
				</div>
			</div>
		</div>
	</div>

	<!-- Juridica -->
	<div class="row mt20" ng-show="abaCliente == 1 && etapaJuridica == 2 && abaPessoa == 2">
		<div class="col-md-12">
			<!-- Dados Empresa -->
			<div class="dflex fwrap">
				<div class="flex1">
					<label class="texto_formulario">Nome oficial da empresa</label>
					<input type="text" class="form-control input_default" placeholder="Nome oficial da empresa" value="{{isset($solicitante) ? $solicitante[0]->OfficialName : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Nome fantasia</label>
					<input type="text" class="form-control input_default" placeholder="Nome fantasia" value="{{isset($solicitante) ? $solicitante[0]->TradeName : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Data de fechamento da empresa</label>
					<input type="text" class="form-control input_default" placeholder="Data de fechamento da empresa" value="{{isset($solicitante) ? $solicitante[0]->ClosedDate : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Sede da empresa</label>
					<input type="text" class="form-control input_default" placeholder="Sede da empresa" value="{{isset($solicitante) ? $solicitante[0]->IsHeadquarter : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Estado da sede da empresa</label>
					<input type="text" class="form-control input_default" placeholder="Estado da sede da empresa" value="{{isset($solicitante) ? $solicitante[0]->HeadquarterState : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Status do documento</label>
					<input type="text" class="form-control input_default" placeholder="Status do documento" value="{{isset($solicitante) ? $solicitante[0]->TaxIdStatus : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Origem do documento</label>
					<input type="text" class="form-control input_default" placeholder="Origem do documento" value="{{isset($solicitante) ? $solicitante[0]->TaxIdOrigin : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Tipo de regime tributário</label>
					<input type="text" class="form-control input_default" placeholder="Tipo de regime tributário" value="{{isset($solicitante) ? $solicitante[0]->TaxRegime : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Data da criação</label>
					<input type="text" class="form-control input_default" placeholder="Data da criação" value="{{isset($solicitante) ? $solicitante[0]->CreationDate : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Data da última atualização</label>
					<input type="text" class="form-control input_default" placeholder="Data da última atualização" value="{{isset($solicitante) ? $solicitante[0]->LastUpdateDate : ''}}" readonly />
				</div>
			</div>
		</div>
	</div>

	<div class="row mt20" ng-show="abaCliente == 1 && etapaJuridica == 3 && abaPessoa == 2">
		<div class="col-md-12">
			<!-- Dados Pessoa -->
			<div class="dflex fwrap">
				<div class="flex1">
					<label class="texto_formulario">Logradouro</label>
					<input type="text" class="form-control input_default" placeholder="Logradouro" value="{{isset($sol_jur_endereco) ? $sol_jur_endereco[0]->Endereco_Lgr : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Nro</label>
					<input type="text" class="form-control input_default" placeholder="Nro" value="{{isset($sol_jur_endereco) ? $sol_jur_endereco[0]->Endereco_Nro : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Complemento</label>
					<input type="text" class="form-control input_default" placeholder="Complemento" value="{{isset($sol_jur_endereco) ? $sol_jur_endereco[0]->Endereco_Complemento : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Bairro</label>
					<input type="text" class="form-control input_default" placeholder="Bairro" value="{{isset($sol_jur_endereco) ? $sol_jur_endereco[0]->Endereco_Bairro : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Município</label>
					<input type="text" class="form-control input_default" placeholder="Município" value="{{isset($sol_jur_endereco) ? $sol_jur_endereco[0]->Endereco_Mun : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">UF</label>
					<input type="text" class="form-control input_default" placeholder="UF" value="{{isset($sol_jur_endereco) ? $sol_jur_endereco[0]->Endereco_UF : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">CEP</label>
					<input type="text" class="form-control input_default" placeholder="CEP" value="{{isset($sol_jur_endereco) ? $sol_jur_endereco[0]->Endereco_CEP : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">País</label>
					<input type="text" class="form-control input_default" placeholder="País" value="{{isset($sol_jur_endereco) ? $sol_jur_endereco[0]->Endereco_Pais : ''}}" readonly />
				</div>
			</div>
		</div>
	</div>

	<div class="row mt20" ng-show="abaCliente == 1 && etapaJuridica == 4 && abaPessoa == 2">
		<div class="col-md-12">
			<div class="dflex fwrap" style="justify-content: initial;">
				<div class="flex1" style="flex: initial;">
					<label class="texto_formulario">Telefone</label>
					<input type="text" class="form-control input_default" placeholder="Telefone" value="{{isset($solicitante) ? $solicitante[0]->telefone : ''}}" readonly />
				</div>
			</div>
		</div>
	</div>
	

	<!-- Sacado -->
	<!-- Fisica -->
	<div class="row mt20" ng-show="abaCliente == 2 && etapaFisica == 2 && abaPessoa == 1">
		<div class="col-md-12">
			<!-- Dados Pessoa -->
			<div class="dflex fwrap">
				<div class="flex1">
					<label class="texto_formulario">Nome</label>
					<input type="text" class="form-control input_default" readonly placeholder="Nome" value="{{isset($sacado) ? $sacado[0]->Name : ''}}" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Sexo</label>
					<input type="text" class="form-control input_default" readonly placeholder="Sexo" value="{{isset($sacado) ? $sacado[0]->Gender : ''}}" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Data de Nascimento</label>
					<input type="text" class="form-control input_default" readonly placeholder="Data de Nascimento" value="{{isset($sacado) ? $sacado[0]->BirthDate : ''}}" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Nacionalidade</label>
					<input type="text" class="form-control input_default" readonly placeholder="Nacionalidade" value="{{isset($sacado) ? $sacado[0]->BirthCountry : ''}}" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Estado</label>
					<input type="text" class="form-control input_default" readonly placeholder="Estado" value="{{isset($sacado) ? $sacado[0]->BirthState : ''}}" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Nome da mãe</label>
					<input type="text" class="form-control input_default" readonly placeholder="Nome da mãe" value="{{isset($sacado) ? $sacado[0]->MotherName : ''}}" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Nome do Pai</label>
					<input type="text" class="form-control input_default" readonly placeholder="Nome do Pai" value="{{isset($sacado) ? $sacado[0]->FatherName : ''}}" />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Indicação de falecimento</label>
					<input type="text" class="form-control input_default" readonly placeholder="Indicação de falecimento" value="{{isset($sacado) ? $sacado[0]->HasObitIndication : ''}}" />
				</div>
			</div>
		</div>
	</div>

	<div class="row mt20" ng-show="abaCliente == 2 && etapaFisica == 3 && abaPessoa == 1">
		<div class="col-md-12">
			<!-- Dados Pessoa -->
			<div class="dflex fwrap">
				<div class="flex1">
					<label class="texto_formulario">Logradouro</label>
					<input type="text" class="form-control input_default" placeholder="Logradouro" value="{{isset($sac_fis_endereco) ? $sac_fis_endereco[0]->Endereco_Lgr : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Nro</label>
					<input type="text" class="form-control input_default" placeholder="Nro" value="{{isset($sac_fis_endereco) ? $sac_fis_endereco[0]->Endereco_Nro : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Complemento</label>
					<input type="text" class="form-control input_default" placeholder="Complemento" value="{{isset($sac_fis_endereco) ? $sac_fis_endereco[0]->Endereco_Complemento : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Bairro</label>
					<input type="text" class="form-control input_default" placeholder="Bairro" value="{{isset($sac_fis_endereco) ? $sac_fis_endereco[0]->Endereco_Bairro : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Município</label>
					<input type="text" class="form-control input_default" placeholder="Município" value="{{isset($sac_fis_endereco) ? $sac_fis_endereco[0]->Endereco_Mun : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">UF</label>
					<input type="text" class="form-control input_default" placeholder="UF" value="{{isset($sac_fis_endereco) ? $sac_fis_endereco[0]->Endereco_UF : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">CEP</label>
					<input type="text" class="form-control input_default" placeholder="CEP" value="{{isset($sac_fis_endereco) ? $sac_fis_endereco[0]->Endereco_CEP : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">País</label>
					<input type="text" class="form-control input_default" placeholder="País" value="{{isset($sac_fis_endereco) ? $sac_fis_endereco[0]->Endereco_Pais : ''}}" readonly />
				</div>
			</div>
		</div>
	</div>

	<div class="row mt20" ng-show="abaCliente == 2 && etapaFisica == 4 && abaPessoa == 1">
		<div class="col-md-12">
			<div class="dflex fwrap" style="justify-content: initial;">
				<div class="flex1" style="flex: initial;">
					<label class="texto_formulario">Telefone</label>
					<input type="text" class="form-control input_default" placeholder="Telefone" value="{{isset($sacado) ? $sacado[0]->telefone : ''}}" readonly />
				</div>
			</div>
		</div>
	</div>

	<!-- Juridica -->
	<div class="row mt20" ng-show="abaCliente == 2 && etapaJuridica == 2 && abaPessoa == 2">
		<div class="col-md-12">
			<!-- Dados Empresa -->
			<div class="dflex fwrap">
				<div class="flex1">
					<label class="texto_formulario">Nome oficial da empresa</label>
					<input type="text" class="form-control input_default" placeholder="Nome oficial da empresa" value="{{isset($sacado) ? $sacado[0]->OfficialName : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Nome fantasia</label>
					<input type="text" class="form-control input_default" placeholder="Nome fantasia" value="{{isset($sacado) ? $sacado[0]->TradeName : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Data de fechamento da empresa</label>
					<input type="text" class="form-control input_default" placeholder="Data de fechamento da empresa" value="{{isset($sacado) ? $sacado[0]->ClosedDate : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Sede da empresa</label>
					<input type="text" class="form-control input_default" placeholder="Sede da empresa" value="{{isset($sacado) ? $sacado[0]->IsHeadquarter : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Estado da sede da empresa</label>
					<input type="text" class="form-control input_default" placeholder="Estado da sede da empresa" value="{{isset($sacado) ? $sacado[0]->HeadquarterState : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Status do documento</label>
					<input type="text" class="form-control input_default" placeholder="Status do documento" value="{{isset($sacado) ? $sacado[0]->TaxIdStatus : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Origem do documento</label>
					<input type="text" class="form-control input_default" placeholder="Origem do documento" value="{{isset($sacado) ? $sacado[0]->TaxIdOrigin : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Tipo de regime tributário</label>
					<input type="text" class="form-control input_default" placeholder="Tipo de regime tributário" value="{{isset($sacado) ? $sacado[0]->TaxRegime : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Data da criação</label>
					<input type="text" class="form-control input_default" placeholder="Data da criação" value="{{isset($sacado) ? $sacado[0]->CreationDate : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Data da última atualização</label>
					<input type="text" class="form-control input_default" placeholder="Data da última atualização" value="{{isset($sacado) ? $sacado[0]->LastUpdateDate : ''}}" readonly />
				</div>
			</div>
		</div>
		<div class='col-md-12'>
			<i style='float: right; margin-right: 8px; margin-top: 15px;'>Data da última consulta: </i>
		</div>
		<div class='col-md-12' ng-show="erro_consulta == 1">
			<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
		</div>
	</div>

	<div class="row mt20" ng-show="abaCliente == 2 && etapaJuridica == 3 && abaPessoa == 2">
		<div class="col-md-12">
			<!-- Dados Pessoa -->
			<div class="dflex fwrap">
				<div class="flex1">
					<label class="texto_formulario">Logradouro</label>
					<input type="text" class="form-control input_default" placeholder="Logradouro" value="{{isset($sac_jur_endereco) ? $sac_jur_endereco[0]->Endereco_Lgr : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Nro</label>
					<input type="text" class="form-control input_default" placeholder="Nro" value="{{isset($sac_jur_endereco) ? $sac_jur_endereco[0]->Endereco_Nro : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Complemento</label>
					<input type="text" class="form-control input_default" placeholder="Complemento" value="{{isset($sac_jur_endereco) ? $sac_jur_endereco[0]->Endereco_Complemento : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Bairro</label>
					<input type="text" class="form-control input_default" placeholder="Bairro" value="{{isset($sac_jur_endereco) ? $sac_jur_endereco[0]->Endereco_Bairro : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Município</label>
					<input type="text" class="form-control input_default" placeholder="Município" value="{{isset($sac_jur_endereco) ? $sac_jur_endereco[0]->Endereco_Mun : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">UF</label>
					<input type="text" class="form-control input_default" placeholder="UF" value="{{isset($sac_jur_endereco) ? $sac_jur_endereco[0]->Endereco_UF : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">CEP</label>
					<input type="text" class="form-control input_default" placeholder="CEP" value="{{isset($sac_jur_endereco) ? $sac_jur_endereco[0]->Endereco_CEP : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">País</label>
					<input type="text" class="form-control input_default" placeholder="País" value="{{isset($sac_jur_endereco) ? $sac_jur_endereco[0]->Endereco_Pais : ''}}" readonly />
				</div>
			</div>
		</div>
	</div>

	<div class="row mt20" ng-show="abaCliente == 2 && etapaJuridica == 4 && abaPessoa == 2">
		<div class="col-md-12">
			<div class="dflex fwrap" style="justify-content: initial;">
				<div class="flex1" style="flex: initial;">
					<label class="texto_formulario">Telefone</label>
					<input type="text" class="form-control input_default" placeholder="Telefone" value="{{isset($sacado) ? $sacado[0]->telefone : ''}}" readonly />
				</div>
			</div>
		</div>
	</div>
	<!-- Imports de Templates -->
		<!-- Fisica -->
		<!-- Solicitante -->
	<div class="row mt20" ng-show="abaCliente == 1 && etapaFisica == 6 && abaPessoa == 1">
		@yield('dpf')
	</div>

	<div class="row mt20" ng-show="abaCliente == 1 && etapaFisica == 11 && abaPessoa == 1">
		@yield('vef')
	</div>

	<div class="row mt20" ng-show="abaCliente == 1 && etapaFisica == 7 && abaPessoa == 1">
		@yield('iff')
	</div>

	<div class="row mt20" ng-show="abaCliente == 1 && etapaFisica == 12 && abaPessoa == 1">
		@yield('acf')
	</div>

		<!-- Sacado -->
	<div class="row mt20" ng-show="abaCliente == 2 && etapaFisica == 6 && abaPessoa == 1">
		@yield('dpfs')
	</div>

	<div class="row mt20" ng-show="abaCliente == 2 && etapaFisica == 11 && abaPessoa == 1">
		@yield('vefs')
	</div>

	<div class="row mt20" ng-show="abaCliente == 2 && etapaFisica == 7 && abaPessoa == 1">
		@yield('iffs')
	</div>

	<div class="row mt20" ng-show="abaCliente == 2 && etapaFisica == 12 && abaPessoa == 1">
		@yield('acfs')
	</div>
		<!-- Juridica -->
		<!-- Solicitante -->
	<div class="row mt20" ng-show="abaCliente == 1 && etapaJuridica == 7 && abaPessoa == 2">
		@yield('iaj')
	</div>
		<!-- Sacado -->
	<div class="row mt20" ng-show="abaCliente == 2 && etapaJuridica == 7 && abaPessoa == 2">
		@yield('iajs')
	</div>


	<!-- Formulários das Consultas -->
	<form method="post" id="dadosProfissionaisSac" action="{{isset($sacado) ? route('api.dadosProfissionais',$sacado[0]->id) : ''}}">
		@csrf
		<input type="hidden" name="cpf" value="{{$sacado[0]->cpf}}">	
	</form>

	<form method="post" id="dadosProfissionais" action="{{isset($solicitante) ? route('api.dadosProfissionais',$solicitante[0]->id) : ''}}">
		@csrf
		<input type="hidden" name="cpf" value="{{$solicitante[0]->cpf}}">	
	</form>

	<form method="post" id="veiculos" action="{{isset($solicitante) ? route('api.veiculos',$solicitante[0]->id) : ''}}">
		@csrf
		<input type="hidden" name="cpf" value="{{$solicitante[0]->cpf}}">	
	</form>

	<form method="post" id="veiculosSac" action="{{isset($sacado) ? route('api.veiculos',$sacado[0]->id) : ''}}">
		@csrf
		<input type="hidden" name="cpf" value="{{$sacado[0]->cpf}}">	
	</form>

	<form method="post" id="infoFinanceira" action="{{isset($solicitante) ? route('api.infoFinanceira',$solicitante[0]->id) : ''}}">
		@csrf
		<input type="hidden" name="cpf" value="{{$solicitante[0]->cpf}}">	
	</form>

	<form method="post" id="infoFinanceiraSac" action="{{isset($sacado) ? route('api.infoFinanceira',$sacado[0]->id) : ''}}">
		@csrf
		<input type="hidden" name="cpf" value="{{$sacado[0]->cpf}}">	
	</form>

	<form method="post" id="criminal" action="{{isset($solicitante) ? route('api.criminal',$solicitante[0]->id) : ''}}">
		@csrf
		<input type="hidden" name="cpf" value="{{$solicitante[0]->cpf}}">	
	</form>

	<form method="post" id="criminalSac" action="{{isset($sacado) ? route('api.criminal',$sacado[0]->id) : ''}}">
		@csrf
		<input type="hidden" name="cpf" value="{{$sacado[0]->cpf}}">	
	</form>

	<form method="post" id="indicaAtiv" action="{{isset($solicitante) ? route('api.indicaAtiv',$solicitante[0]->id) : ''}}">
		@csrf
		<input type="hidden" name="cnpj" value="{{$solicitante[0]->cnpj}}">	
	</form>

	<form method="post" id="indicaAtivSac" action="{{isset($sacado) ? route('api.indicaAtiv',$sacado[0]->id) : ''}}">
		@csrf
		<input type="hidden" name="cnpj" value="{{$sacado[0]->cnpj}}">	
	</form>
	

</div>
<script>
	var app = angular.module('myApp', []);
	app.controller('myCtrl', function($scope, $http) {
		$scope.abaCliente 				= 1;
		$scope.abaPessoa 				= 1;
		$scope.etapaFisica 				= 1;
		$scope.etapaJuridica 			= 1;
		$scope.solicitante_fisica 		= 0;
		$scope.solicitante_juridica 	= 0;
		$scope.sacado_fisico 			= 0;
		$scope.sacado_juridica 			= 0;
		$scope.erro_consuta 			= 0;
		$scope.juros 					= <?=isset($solicitacao->juros) ? $solicitacao->juros : 1.99 ?>;
		$scope.limite_credito 			= <?=$solicitacao->credito?>;
		$scope.id_solicitacao 			= <?=$solicitacao->id?>;


		$scope.trocaCliente = function(v) {
			$scope.abaCliente = v;

			//Reseta step assim que troca a aba de cliente
			$scope.abaPessoa = 1;
			$scope.etapaFisica = 1;
			$scope.etapaJuridica = 1;
		}

		$scope.trocaPessoa = function(v) {
			$scope.abaPessoa = v;
		}

		$scope.subCategoria = function(v, a) {
			if (a == 1) {
				$scope.etapaFisica = v;
			} else {
				$scope.etapaJuridica = v;
			}
		}
		
	});

	function dadosProfissionais(){
		document.getElementById("dadosProfissionais").submit();
	}

	function dadosProfissionaisSac(){
		document.getElementById("dadosProfissionaisSac").submit();
	}

	function infoFinanceira(){
		document.getElementById("infoFinanceira").submit();
	}

	function infoFinanceiraSac(){
		document.getElementById("infoFinanceiraSac").submit();
	}

	function veiculos(){
		document.getElementById("veiculos").submit();
	}

	function veiculosSac(){
		document.getElementById("veiculosSac").submit();
	}

	function indicaAtiv(){
		document.getElementById("indicaAtiv").submit();
	}

	function indicaAtivSac(){
		document.getElementById("indicaAtivSac").submit();
	}

	function criminal(){
		document.getElementById("criminal").submit();
	}

	function criminalSac(){
		document.getElementById("criminalSac").submit();
	}

	function aprova() {
    	document.getElementById("status").value = 1;
		document.getElementById('atualiza_status').submit();
	}
	function pendente() {
    	document.getElementById("status").value = 2;
		document.getElementById('atualiza_status').submit();
	}
	function recusa() {
    	document.getElementById("status").value = 3;
		document.getElementById('atualiza_status').submit();
	}
	</script>
@endsection