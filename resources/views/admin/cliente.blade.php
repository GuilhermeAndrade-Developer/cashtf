@extends('layouts.admin.cliente_view.topo')
@section('content')
<style>
 .drawer-navbar{
	 display: none;
 }
 .rodape{
	display: none;
}
</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
<div class="container-fluid fluid-person" ng-app="myApp" ng-controller="myCtrl" ng-cloak>
	<div class="row mt120">
		<form action="{{route('admin.cliente.save',$empresa->id)}}" method="post" id="cliente">
		@csrf
		@include('layouts.admin.return')
			<div class="col-md-6">
				<p class="m_color stats">STATUS DE CADASTRO</p>
				<label class="content">APROVADO
				@if($usuario->ativo == 1)
					<input type="radio" checked="checked" name="status" value="approved">
				@else
					<input type="radio" name="status" value="approved">
				@endif
					<span class="checkmark"></span>
				</label>
				<label class="content">PENDENTE
				@if($usuario->ativo == 0)
					<input type="radio" checked="checked" name="status" value="pending">
				@else
					<input type="radio" name="status" value="pending">
				@endif
					<span class="checkmark yellow"></span>
				</label>
				<label class="content">RECUSADO
				@if($usuario->ativo == 2)
					<input type="radio" checked="checked" name="status" value="refused">
				@else
					<input type="radio" name="status" value="refused">
				@endif
					<span class="checkmark red"></span>
				</label>
			</div>
			<div class="col-md-6">
				<p class="score">SCORE</p>
				<div class="d_flex j_between h_40">
					<div class="aligned score">
							<span class="ml10">900</span> 
					</div>
					<div class="d_flex j_end f_1">
						<div class="aligned botao_apagar">
							<a href="{{route('admin.clientes.delete',$empresa->id)}}">
								<i class="fa fa-trash"  aria-hidden="true"></i>
								<span class="ml10">EXCLUIR</span>
							</a> 
						</div>
						<div class="botao_salvar">
								<i class="fa fa-floppy-o" aria-hidden="true"></i>
								<span class="ml10" onclick="document.getElementById('cliente').submit();">SALVAR</span> 
						</div>
					</div>
				</div>
			</div>
	</div>
	<div class="row">
		<div class='col-md-6'>
			<div class="dflex fwrap">
				<div class="flex1">
					<label class="texto_formulario">LIMITE DE CRÉDITO</label>
					<input type="text" class="form-control input_default" name="credito" placeholder="R$ 0,00" value="{{isset($empresa->limite_credito) ? $empresa->limite_credito : '0,00'}}" onkeyup="moeda(this)" />	
				</div>
				<div class="flex1">
					<label class="texto_formulario">TAXA DE DESÁGIO</label>
					<input type="text" class="form-control input_default" name="juros" placeholder="1.99 %" value="{{isset($empresa->taxa_desagio) ? $empresa->taxa_desagio : '0,00'}}" onkeyup="percentage(this)"/>	
				</div>
				<div class="flex1 last">
					<label class="texto_formulario">TARIFA DE BORDERÔ</label>
					<input type="text" class="form-control input_default" id="tarifa_bordero" name="tarifa_bordero" placeholder="R$ 0,00" value="{{isset($empresa->tarifa_bordero) ? $empresa->tarifa_bordero : '0,00'}}" onkeyup="moeda(this)" />	
				</div>
			</div>
		</div>
		<input type="hidden" class="form-control input_default" name="id" value="{{$empresa->id}}" />	
		</form>
		<div class="col-md-12 mt20 mb20">
			<div class="div_cliente_flex mt20 text-center">
				<div class="cinzasacado text-center" style="flex: 1; margin: 2px;" ng-click="atualizaEtapa(1)" ng-class="etapa==1?'active':''">
					<span>MEUS DADOS</span>
				</div>
				<div class="cinzasacado text-center" style="flex: 1; margin: 2px;" ng-click="atualizaEtapa(2)" ng-class="etapa==2?'active':''">
					<span>DADOS DA EMPRESA</span>
				</div>
				<div class="cinzasacado text-center" style="flex: 1; margin: 2px;" ng-click="atualizaEtapa(3)" ng-class="etapa==3?'active':''">
					<span>Sócios e Cônjuges</span>
				</div>
				<div class="cinzasacado text-center" style="flex: 1; margin: 2px;" ng-click="atualizaEtapa(4)" ng-class="etapa==4?'active':''">
					<span>Contas Bancárias</span>
				</div>
			</div>
			<div class="linhaazul">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 pt60 pb80" ng-show="etapa==1">
			<img src="{{asset('images/usuarios')}}/{{isset($usuario->imagem) ? $usuario->imagem : '1592392123tela_19_a.png'}}" class="img_perfil_box" id="preview">
			<div class="div_perfil">
				<div>
					<label for="choose-file" class="botao_salvar_menor change_img">
						<span>ALTERAR FOTO</span>
					</label>
					<input id="choose-file" style="display: none;" type="file" class="form-control" name="imagem" onchange="openFile(event)">
				</div>
				<label><i>TAMANHO IDEAL: 200px X 200px<br>FORMATOS: JPG ou PNG</i></label>
			</div>
			<!-- Dados Empresa -->
			<div class="pt40 dflex j_start fwrap w100">
				<div class="flex1 max pr30">
					<label class="texto_formulario">NOME COMPLETO</label>
					<input type="text" class="form-control input_default" placeholder="Nome" value="{{isset($usuario) ? $usuario->name : ''}}" readonly/>
				</div>
				<div class="flex1 max pr30">
					<label class="texto_formulario">CONTAS VÍNCULADAS</label>
					<div class="d_flex a_center j_start f_row accounts">
						<i class="lab la-facebook"></i>
						<p>NENHUMA CONTA VINCULADA</p>
					</div>
				</div>
				@if($usuario->linkedin_id != null || $usuario->google_id != null || $usuario->facebook_id != null)
				<i class="las la-trash-alt delete"></i>
				@endif
			</div>
		</div>

		<div class="col-md-12 pb80" ng-show="etapa==2">
			<!-- Dados Empresa -->
			<div class="dflex fwrap">
				<div class="f_1 pr10 p_relative">
					<label class="texto_formulario">CNPJ</label>
					<input id="cnpjcopy" name="cnpjcopy" type="text" class="form-control input_default b_f_color white" placeholder="CNPJ" value="{{isset($empresa) ? $empresa->cnpj : ''}}" readonly/>
					<div class="float_icon">
						<i type="button" id="clipboard" class="clipboard las la-copy" data-clipboard-action="copy" data-clipboard-target="#cnpjcopy"></i>
					</div>
				</div>
				<div class="f_2 pr10">
					<label class="texto_formulario">Razão Social</label>
					<input type="text" class="form-control input_default" placeholder="Razão Social" value="{{isset($empresa) ? $empresa->OfficialName : ''}}" readonly/>
				</div>
				<div class="f_2 pr10">
					<label class="texto_formulario">Nome Fantasia</label>
					<input type="text" class="form-control input_default" placeholder="Nome Fantasia" value="{{isset($empresa) ? $empresa->TradeName : ''}}" readonly/>
				</div>
				<div class="f_1">
					<label class="texto_formulario">Fundação</label>
					<input type="text" class="form-control input_default" placeholder="Data Fundação" value="{{isset($empresa) ? $empresa->ClosedDate : ''}}" readonly/>
				</div>
			</div>
			<div class="dflex j_start fwrap">
				<div class="flex1 max_w_600">
					<label class="texto_formulario">ATIVIDADE PRÍNCIPAL</label>
					<input type="text" class="form-control input_default" placeholder="Atividade Príncipal" value="{{isset($empresa) ? $empresa->mainActivity : ''}}" readonly/>
				</div>
				<div class="flex1 max_w_600 last">
					<label class="texto_formulario">ATIVIDADES SECUNDÁRIAS</label>
					<input type="text" class="form-control input_default" placeholder="Atividade Secundárias" value="{{isset($empresa) ? $empresa->secondActivity : ''}}" readonly/>
				</div>
			</div>
			<div class="dflex fwrap">
				<div class="f_2 pr10">
					<label class="texto_formulario">CEP</label>
					<input type="text" class="form-control input_default" placeholder="Cep" value="{{isset($empresa) ? $empresa->endereco->Endereco_CEP : ''}}" readonly/>
				</div>
				<div class="f_3 pr10">
					<label class="texto_formulario">Endereço</label>
					<input type="text" class="form-control input_default" placeholder="Endereço..." value="{{isset($empresa) ? $empresa->endereco->Endereco_Lgr : ''}}" readonly/>
				</div>
				<div class="f_1 pr10">
					<label class="texto_formulario">Nº</label>
					<input type="text" class="form-control input_default" placeholder="Num..." value="{{isset($empresa) ? $empresa->endereco->Endereco_Nro : ''}}" readonly/>
				</div>
				<div class="f_2 pr10">
					<label class="texto_formulario">Complemento</label>
					<input type="text" class="form-control input_default" placeholder="Complemento..." value="{{isset($empresa) ? $empresa->endereco->Endereco_Complemento : ''}}" readonly/>
				</div>
				<div class="f_2 pr10">
					<label class="texto_formulario">Bairro</label>
					<input type="text" class="form-control input_default" placeholder="Bairro..." value="{{isset($empresa) ? $empresa->endereco->Endereco_Bairro : ''}}" readonly/>
				</div>
				<div class="f_1 pr10">
					<label class="texto_formulario">UF</label>
					<input type="text" class="form-control input_default" placeholder="UF..." value="{{isset($empresa) ? $empresa->endereco->Endereco_UF : ''}}" readonly/>
				</div>
				<div class="f_2 pr10">
					<label class="texto_formulario">MUNICÍPIO</label>
					<input type="text" class="form-control input_default" placeholder="Município..." value="{{isset($empresa) ? $empresa->endereco->Endereco_Mun : ''}}" readonly/>
				</div>
				<div class="f_2">
					<label class="texto_formulario">País</label>
					<input type="text" class="form-control input_default" placeholder="País..." value="{{isset($empresa) ? $empresa->endereco->Endereco_Pais : ''}}" readonly/>
				</div>
			</div>
			<div class="linhaazul mt15 mb30 b_f_color">
			</div>
			<div class="d_flex f_column f_wrap">
				<p class="m_color stats">ARQUIVOS</p>
				<label class="random">CASO HAJA ALGUMA ALTERAÇÃO ADICIONE OS <span>ARQUIVOS MAIS RECENTES</span> </label>
			</div>
			<div class="d_flex pt20">
				<div class="file_upload">
					<label class="texto_formulario" for="">CONTRATO SOCIAL OU CONSOLIDADO</label>
					<input class="form-control input_default b_s_dark_color white" type="text" value="{{isset($contratos) ? $contratos->source : ''}}" readonly>
					<p>Arquivo no formato .PDF, .JPG, .PNG</p>
					<!--<div class="float_icon">
						<i class="las la-cloud-upload-alt"></i>
					</div>-->
					<div class="float_icon">
					<a href="{{isset($contratos) ? asset('/uploads/contratos/'.$contratos->source) : ''}}" ctarget="_blank" class="las la-file-download" download></a>
					</div>
				</div>
				<div class="file_upload">
					<label class="texto_formulario" for="">FATURAMENTO DOS ÚLTIMOS 12 MESES</label>
					<input class="form-control input_default b_s_dark_color white" type="text" value="{{isset($faturamento) ? $faturamento->source : ''}}" readonly>
					<p>Arquivo no formato .PDF, .JPG, .PNG</p>
					<!--<div class="float_icon">
						<i class="las la-cloud-upload-alt"></i>
					</div>-->
					<div class="float_icon">
						<a href="{{isset($faturamento) ? asset('/uploads/faturamentos/'.$faturamento->source) : ''}}" target="_blank" class="las la-file-download" download>
						</a>
					</div>
				</div>
				<div class="file_upload last">
					<label class="texto_formulario" for="">ALTERAÇÕES CONTRATUAIS</label>
					<input class="form-control input_default b_s_dark_color white" type="text" value="{{isset($alteracoes) ? $alteracoes->source : ''}}" readonly>
					<p>Arquivo no formato .PDF, .JPG, .PNG</p>
					<!-- <div class="float_icon">
						<i class="las la-cloud-upload-alt"></i>
					</div> -->
					<div class="float_icon">
						<a href="{{isset($alteracoes) ? asset('/uploads/alteracoes/'.$alteracoes->source) : ''}}" ctarget="_blank" class="las la-file-download" download></a>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 pb80" ng-show="etapa==3">
			<!-- Dados Sócio -->
			<div class="d_flex f_column f_wrap">
				<p class="m_color stats">SÓCIO ADMINISTRADOR OU PROCURADOR</p>
				<div class="d_flex f_row">
					<label class="content">SÓCIO ADMINISTRADOR
					@if($empresa->tipo == 'socioAdmin')
						<input type="radio" checked="checked" name="type">
					@else
						<input type="radio" name="type">
					@endif
						<span class="checkmark pink"></span>
					</label>
					<label class="content">PROCURADOR
					@if($empresa->tipo == 'procurador')
						<input type="radio" checked="checked" name="type">
					@else
						<input type="radio" name="type">
					@endif
						<span class="checkmark pink"></span>
					</label>
				</div>
			</div>
			<div class="dflex fwrap">
				<div class="f_2 pr10 p_relative">
					<label class="texto_formulario">CPF</label>
					<input id="copysocioprop" name ="copysocioprop" type="text" class="form-control input_default b_f_color white" placeholder="CPF" value="{{isset($socios[0]) ? $socios[0]->cpf : ''}}" readonly/>
					<div class="float_icon">
						<i type="button" id="clipboard" class="clipboard las la-copy" data-clipboard-action="copy" data-clipboard-target="#copysocioprop"></i>
					</div>
				</div>
				<div class="f_2 pr10">
					<label class="texto_formulario">RG</label>
					<input type="text" class="form-control input_default" placeholder="RG" value="{{isset($socios[0]) ? $socios[0]->rg : ''}}" readonly/>
				</div>
				<div class="f_1 pr10">
					<label class="texto_formulario">Órgão Emissor</label>
					<input type="text" class="form-control input_default" placeholder="OM" value="{{isset($socios[0]) ? $socios[0]->orgaoEmissor : ''}}" readonly/>
				</div>
				<div class="f_3 pr10">
					<label class="texto_formulario">Nome</label>
					<input type="text" class="form-control input_default" placeholder="Nome" value="{{isset($socios[0]) ? $socios[0]->nome : ''}}" readonly/>
				</div>
				<div class="f_1 pr10">
					<label class="texto_formulario">Nacionalidade</label>
					<input type="text" class="form-control input_default" placeholder="Nacionalidade" value="{{isset($socios[0]) ? $socios[0]->nationality : ''}}" readonly/>
				</div>
				<div class="f_1">
					<label class="texto_formulario">Passaporte</label>
					<input type="text" class="form-control input_default" placeholder="Passaporte" value="{{isset($socios[0]) ? $socios[0]->passport : ''}}" readonly/>
				</div>
			</div>
			<div class="dflex fwrap">
				<div class="f_2 pr10 p_relative">
					<label class="texto_formulario">DIGITALIZE CNH, RG ou CPF</label>
					<input class="form-control input_default b_s_dark_color white" type="text" placeholder="exemple_doc.jpg" value="{{isset($empresa) ? $empresa->documento : ''}}" readonly>
					<div class="float_icon upload">
						<a href="{{isset($empresa) ? asset('uploads/socios/'.$empresa->documento) : ''}}" ctarget="_blank" class="las la-file-download" download></a>
					</div>
				</div>
				<div class="f_2 pr10 p_relative">
					<label class="texto_formulario">PROCURAÇÃO</label>
					<input class="form-control input_default b_s_dark_color white" type="text" placeholder="" value="{{isset($procuracao) ? $procuracao->source : ''}}" readonly>
					<div class="float_icon upload">
						<a href="{{isset($procuracao) ? asset('uploads/procuracao/'.$procuracao->source) : ''}}" ctarget="_blank" class="las la-file-download" download></a>
					</div>
				</div>
				<div class="f_2 pr10">
					<label class="texto_formulario">DATA DE NASCIMENTO</label>
					<input type="text" class="form-control input_default" placeholder="00/00/0000" value="{{isset($socios[0]->birthDate) ? $socios[0]->birthDate : ''}}" readonly/>
				</div>
				<div class="f_1 pr10">
					<label class="texto_formulario">Gênero</label>
					<input type="text" class="form-control input_default" placeholder="" value="{{isset($socios[0]->gender) ? $socios[0]->gender : ''}}" readonly/>
				</div>
				<div class="f_3 pr10">
					<label class="texto_formulario">E-mail</label>
					<input type="text" class="form-control input_default" placeholder="E-mail" value="{{isset($socios[0]->email) ? $socios[0]->email : ''}}"readonly/>
				</div>
				<div class="f_2">
					<label class="texto_formulario">Estado Cívil</label>
					<input type="text" class="form-control input_default" placeholder="Estado Civil..." value="{{isset($socios[0]->estadoCivil) ? $socios[0]->estadoCivil : ''}}" readonly/>
				</div>
			</div>
			<div class="dflex fwrap">
				<div class="f_2 pr10">
					<label class="texto_formulario">CEP</label>
					<input type="text" class="form-control input_default" placeholder="Cep" value="{{isset($socios[0]->endereco->Endereco_CEP) ?$socios[0]->endereco->Endereco_CEP : ''}}" readonly/>
				</div>
				<div class="f_3 pr10">
					<label class="texto_formulario">Endereço</label>
					<input type="text" class="form-control input_default" placeholder="Endereço..." value="{{isset($socios[0]->endereco->Endereco_Lgr) ?$socios[0]->endereco->Endereco_Lgr : ''}}" readonly/>
				</div>
				<div class="f_1 pr10">
					<label class="texto_formulario">Nº</label>
					<input type="text" class="form-control input_default" placeholder="Num..." value="{{isset($socios[0]->endereco->Endereco_Nro) ?$socios[0]->endereco->Endereco_Nro : ''}}" readonly/>
				</div>
				<div class="f_2 pr10">
					<label class="texto_formulario">Complemento</label>
					<input type="text" class="form-control input_default" placeholder="Complemento..." value="{{isset($socios[0]->endereco->Endereco_Complemento) ?$socios[0]->endereco->Endereco_Complemento : ''}}" readonly/>
				</div>
				<div class="f_2 pr10">
					<label class="texto_formulario">Bairro</label>
					<input type="text" class="form-control input_default" placeholder="Bairro..." value="{{isset($socios[0]->endereco->Endereco_Bairro) ?$socios[0]->endereco->Endereco_Bairro : ''}}" readonly/>
				</div>
				<div class="f_1 pr10">
					<label class="texto_formulario">UF</label>
					<input type="text" class="form-control input_default" placeholder="UF..." value="{{isset($socios[0]->endereco->Endereco_UF) ? $socios[0]->endereco->Endereco_UF: ''}}" readonly/>
				</div>
				<div class="f_2 pr10">
					<label class="texto_formulario">MUNICÍPIO</label>
					<input type="text" class="form-control input_default" placeholder="Município..." value="{{isset($socios[0]->endereco->Endereco_Mun) ? $socios[0]->endereco->Endereco_Mun: ''}}" readonly/>
				</div>
				<div class="f_2">
					<label class="texto_formulario">País</label>
					<input type="text" class="form-control input_default" placeholder="País..." value="{{isset($socios[0]->endereco->Endereco_Pais) ? $socios[0]->endereco->Endereco_Pais: ''}}" readonly/>
				</div>
			</div>
			<div ng-if="s.id != 0" ng-repeat="s in socios">
					<div class="linhaazul mt15 mb30 b_f_color">
					</div>
					<div class="d_flex f_column f_wrap">
						<p class="m_color stats">DADOS DOS SÓCIOS</p>
					</div>
					<div class="dflex fwrap">
						<div class="f_2 pr10 p_relative">
							<label class="texto_formulario">CPF</label>
							<input type="text" ng-attr-id="<% 'copy' + s.id %>" class="form-control input_default b_f_color white" placeholder="CPF" ng-model="s.cpf" readonly/>
							<div class="float_icon">
								<i type="button" id="clipboard" class="clipboard las la-copy" data-clipboard-action="copy" data-clipboard-target="#copy<% s.id %>"></i>
							</div>
						</div>
						<div class="f_2 pr10">
							<label class="texto_formulario">RG</label>
							<input type="text" class="form-control input_default" placeholder="RG" ng-model="s.rg" readonly/>
						</div>
						<div class="f_1 pr10">
							<label class="texto_formulario">Órgão Emissor</label>
							<input type="text" class="form-control input_default" placeholder="OM" ng-model="s.orgaoEmissor" readonly/>
						</div>
						<div class="f_3 pr10">
							<label class="texto_formulario">Nome</label>
							<input type="text" class="form-control input_default" placeholder="Nome" ng-model="s.nome" readonly/>
						</div>
						<div class="f_1 pr10">
							<label class="texto_formulario">Nacionalidade</label>
							<input type="text" class="form-control input_default" placeholder="Nacionalidade" ng-model="s.nationality" readonly/>
						</div>
						<div class="f_1">
							<label class="texto_formulario">Passaporte</label>
							<input type="text" class="form-control input_default" placeholder="Passaporte" ng-model="s.passport" readonly/>
						</div>
					</div>
					<div class="dflex fwrap">
						<div class="f_2 pr10 p_relative">
							<label class="texto_formulario">DIGITALIZE CNH, RG ou CPF</label>
							<input class="form-control input_default b_s_dark_color white" type="text" placeholder="exemple_doc.jpg" ng-model = "s.documento" readonly>
							<div class="float_icon upload">
							<a href="{{isset($empresa) ? asset('uploads/socios') : ''}}/<% s.documento %>" ctarget="_blank" class="las la-file-download" download></a>
							</div>
						</div>
						<div class="f_2 pr10">
							<label class="texto_formulario">DATA DE NASCIMENTO</label>
							<input type="text" class="form-control input_default" placeholder="00/00/0000" ng-model="s.birthDate" readonly/>
						</div>
						<div class="f_1 pr10">
							<label class="texto_formulario">Gênero</label>
							<input type="text" class="form-control input_default" placeholder="" ng-model="s.gender" readonly/>
						</div>
						<div class="f_3 pr10">
							<label class="texto_formulario">E-mail</label>
							<input type="text" class="form-control input_default" placeholder="E-mail" ng-model="s.email" readonly/>
						</div>
						<div class="f_2">
							<label class="texto_formulario">Estado Cívil</label>
							<input type="text" class="form-control input_default" placeholder="Estado Civil" ng-model="s.estadoCivil" readonly/>
						</div>
						<div class="f_2 pr10 p_relative">
							
						</div>
					</div>
					<div class="dflex fwrap">
						<div class="f_2 pr10">
							<label class="texto_formulario">CEP</label>
							<input type="text" class="form-control input_default" placeholder="Cep" ng-model="s.Address.Endereco_CEP" readonly/>
						</div>
						<div class="f_3 pr10">
							<label class="texto_formulario">Endereço</label>
							<input type="text" class="form-control input_default" placeholder="Endereço..." ng-model="s.Address.Endereco_Lgr" readonly/>
						</div>
						<div class="f_1 pr10">
							<label class="texto_formulario">Nº</label>
							<input type="text" class="form-control input_default" placeholder="Num..." ng-model="s.Address.Endereco_Nro" readonly/>
						</div>
						<div class="f_2 pr10">
							<label class="texto_formulario">Complemento</label>
							<input type="text" class="form-control input_default" placeholder="Complemento..." ng-model="s.Address.Endereco_Complemento" readonly/>
						</div>
						<div class="f_2 pr10">
							<label class="texto_formulario">Bairro</label>
							<input type="text" class="form-control input_default" placeholder="Bairro..." ng-model="s.Address.Endereco_Bairro" readonly/>
						</div>
						<div class="f_1 pr10">
							<label class="texto_formulario">UF</label>
							<input type="text" class="form-control input_default" placeholder="UF..." ng-model="s.Address.Endereco_UF" readonly/>
						</div>
						<div class="f_2 pr10">
							<label class="texto_formulario">MUNICÍPIO</label>
							<input type="text" class="form-control input_default" placeholder="Município..." ng-model="s.Address.Endereco_Mun" readonly/>
						</div>
						<div class="f_2">
							<label class="texto_formulario">País</label>
							<input type="text" class="form-control input_default" placeholder="País..." ng-model="s.Address.Endereco_Pais" readonly/>
						</div>
					</div>
					<!-- DADOS CONJUGE  -->
					<div ng-show="if(s.conjuge_cpf != null)">
						<div class="d_flex f_column f_wrap mt30">
							<p class="m_color stats">DADOS DOS CÔNJUGE</p>
						</div>
						<div class="dflex fwrap">
							<div class="f_2 pr10 p_relative">
								<label class="texto_formulario">CPF</label>
								<input type="text" class="form-control input_default b_f_color white" placeholder="CPF" ng-model="s.conjuge_cpf" readonly/>
								<div class="float_icon">
									<i class="las la-copy"></i>
								</div>
							</div>
							<div class="f_2 pr10">
								<label class="texto_formulario">RG</label>
								<input type="text" class="form-control input_default" placeholder="RG" ng-model="s.conjuge_rg" readonly/>
							</div>
							<div class="f_1 pr10">
								<label class="texto_formulario">Órgão Emissor</label>
								<input type="text" class="form-control input_default" placeholder="OM" ng-model="s.orgaoEmissor" readonly/>
							</div>
							<div class="f_3 pr10">
								<label class="texto_formulario">Nome</label>
								<input type="text" class="form-control input_default" placeholder="Nome" ng-model="s.conjuge_nome" readonly/>
							</div>
							<div class="f_1 pr10">
								<label class="texto_formulario">Nacionalidade</label>
								<input type="text" class="form-control input_default" placeholder="Nacionalidade" ng-model="s.conjuge_nationality" readonly/>
							</div>
							<div class="f_1">
								<label class="texto_formulario">Profissão</label>
								<input type="text" class="form-control input_default" placeholder="Profissão" ng-model="s.conjuge_profissao" readonly/>
							</div>
						</div>
						<div class="dflex fwrap">
							<div class="f_2 pr10">
								<label class="texto_formulario">E-mail</label>
								<input type="text" class="form-control input_default" placeholder="E-mail" ng-model="s.conjuge_email" readonly/>
							</div>
							<div class="f_4 pr10 p_relative">
							</div>
						</div>
					<div>
				</div>
			</div>
		</div>
	</div>
		<div class="col-md-12 mb80" ng-show="etapa==4">
			<div class="dflex fwrap mt10" ng-repeat="c in contas">
				<div class="f_4 pr25">
					<label class="texto_formulario">BANCO</label>
					<input type="text" class="form-control input_default" placeholder="Banco..." ng-model="c.banco" readonly/>
				</div>
				<div class="f_2 pr25">
					<label class="texto_formulario">AGÊNCIA</label>
					<input type="text" class="form-control input_default" placeholder="Agência..." ng-model="c.agencia" readonly/>
				</div>
				<div class="f_3 pr25">
					<label class="texto_formulario">Conta</label>
					<input type="text" class="form-control input_default" placeholder="Conta..." ng-model="c.conta" readonly/>
				</div>
				<div class="f_1 pr25">
					<label class="texto_formulario">Digito</label>
					<input type="text" class="form-control input_default" placeholder="Dígito..." ng-model="c.digito" readonly/>
				</div>
				<div class="f_1 pr25">
				</div>
				<div class="f_4">
				</div>
			</div>
		</div> 
	</div>
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
			$scope.etapa = 1;
			$scope.socios = [];
			$scope.contas = [];
			$scope.dados = [];
			$scope.dataPessoaFisica = {};
			$scope.dataPessoaJuridica = {};
			$scope.enderecoFisica = {};
			$scope.enderecoJuridica = {};
			$scope.contratoSocial = [];
			$scope.faturamento = [];
			$scope.alteracoesContratuais = [];
			$scope.cpfSocio = 0;
			$scope.cpfInvalido = []
			$scope.docCliente = []
			$scope.procCliente = []
			$scope.myFile = []

			$scope.atualizaEtapa = function(v) {
				$scope.etapa = v;
			}

			var contasGet = "<?=route('cliente.contas','id='.$usuario->id_cliente)?>";
			$http.get(contasGet)
			.success(function(data) {
				$scope.contas = data;
				if($scope.contas.length == 0){
					$scope.contas.push({});
				}
			})

			//Conferir rotas e funções
			var sociosGet = "<?=route('cliente.socios','id='.$usuario->id_cliente)?>";
			$http.get(sociosGet)
			.success(function(data) {
				$scope.socios = data;
				console.log($scope.socios);
			})
			
			//Passo a Passo
			$scope.avancaStep = function() {
				if ($scope.etapa == 1) {

				}

				if ($scope.etapa == 2) {

				}

				if ($scope.etapa == 3) {

				}

				if ($scope.etapa == 4) {
				
				}

				if ($scope.etapa < 4) {
					$scope.etapa++;
				}
			}
		}]);
	</script>
@endsection