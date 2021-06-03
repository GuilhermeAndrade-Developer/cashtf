@extends('layouts.admin.cliente_view.topo_bordero')
@section('content')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>

<div class="div_geral_socio_procurador">
<div class="container-fluid">
		
</div>
<form id="filtros" action="" method="GET" >
        <div class="mt80_bordero_cliente flex_pai_buscar_bordero_cliente">
                <input type="hidden" id="status" name="status" class="hidden" value="{{ isset($status)? $status : '' }}"> 
                <div class="fundo_title_bordero_cliente b_t_color white">
                        <div class="flex_1_bordero_cliente_title">
                                <span class="fonte_bordero_title_cliente">
                                        BOLETOS
                                </span>
                        </div>
                </div>
        </div>
</form>
<div class="container-fluid fluid-person mb80" ng-app="myApp" ng-controller="myCtrl" ng-cloak>
<?php $count = 1;?>
	<div class="row mt50">
		<div class="col-md-12 mt20">
			<ol class="div_cliente_flex custom margin text-center">
            @foreach($bordero as $b)
				<div class="cinzasacado" ng-click="atualizaEtapa(<?= $count;?>)" ng-class="etapa==<?= $count;?>?'active':''">
					<li>{{isset($b->sacado->OfficialName) ? $b->sacado->OfficialName : $b->sacado->Name}}</li>
				</div>
                <?php $count++;?>
            @endforeach
			</ol>
            <div class="linhaazul margin"></div>
		</div>
	</div>
    <?php $count = 1;?>
	<div class="row">
    @foreach($bordero as $b)
		<div class="col-md-12" ng-show="etapa==<?= $count;?>">
            <table class="table table-default table-default-admin custom billet">
                <thead>
                    <tr>
                        <th>NRE BOLETO</th>
                        <th>VENCIMENTO</th>
                        <th colspan="5"></th>
                        <th>VALOR</th>
                        <th>STATUS</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($b->parcelas as $p)
                    <tr>
                        <td>{{$p->id_solicitacao}}/{{$p->numero}}</td>
                        <td>{{$p->vencimento}}</td>
                        <td colspan="5"></td>
                        <td>R$ <span>{{$p->valor_parcela}}</span></td>
                        <td class="text-center d_flex j_center">
                            <p class="m_b_green white">{{$p->status}}</p>
                        </td>
                    </tr>
                @endforeach
                </tbody>

                <tfoot>
                    <tr class="b_s_dark_color">
                        <td></td>
                        <td></td>
                        <td colspan="5"></td>
                        <td>TOTAL</td>
                        <td></td>
                    </tr>
                    <tr class="b_f_color">
                        <td></td>
                        <td></td>
                        <td colspan="5"></td>
                        <td>R$ {{$b->valor_total}}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <div class='input-list mt30'>
                <p class="stats f_color">DADOS DO SACADO</p>

                <div class="dflex">
                    <label class="texto_formulario f_2" style="min-width: 31ch;">
                        CPF/CNPJ
                        <input id="clipboard" class="clipboard form-control input_default copy-type white" type="text" placeholder="21.594.976/0001-00" value="{{isset($b->sacado->cnpj) ? $b->sacado->cnpj : $b->sacado->cpf}}" data-clipboard-action="copy" data-clipboard-target="#clipboard" readonly>
                    </label>
                    <label class="texto_formulario f_5" style="min-width: 65ch;">
                        NOME / RAZÃO SOCIAL
                        <input class="form-control input_default b_f_color white" type="text" placeholder="HOTEL MONTE VERDE EIRELI" value="{{isset($b->sacado->OfficialName) ? $b->sacado->OfficialName : $b->sacado->Name}}" readonly>
                    </label>

                    <label class="texto_formulario f_2" style="min-width: 15ch;">
                        EMISSÃO
                        <input class="form-control input_default" type="text" placeholder="12/05/1990" value="{{isset($b) ? $b->data_emissao : ''}}" readonly>
                    </label>

                    <label class="f_3"></label>

                    <label class="texto_formulario" style="min-width: 10ch;">
                        SCORE
                        <!-- CLASSES PARA SCORES POSITIVO~NEGATIVO VERDE = m_b_green / AMARELO = m_b_yellow / VERMELHO = m_b_red  -->
                        <input class="form-control input_default white m_b_green" type="number" placeholder="900" value="" readonly>
                    </label>
                </div>

                <div class="dflex">
                    <label class="texto_formulario f_2" style="min-width: 15ch;">
                        CEP
                        <input class="form-control input_default" type="number" placeholder="12917-021" value="{{isset($endereco_sacado_juridica) ? $endereco_sacado_juridica->Endereco_CEP : $endereco_sacado_fisica->Endereco_CEP}}" readonly>
                    </label>

                    <label class="texto_formulario f_4" style="min-width: 51ch">
                        ENDEREÇO/RUA..., AV..., etc.
                        <input class="form-control input_default" type="text" placeholder="Rua das Orquídeas" value="{{isset($endereco_sacado_juridica) ? $endereco_sacado_juridica->Endereco_Lgr : $endereco_sacado_fisica->Endereco_Lgr}}" readonly>
                    </label>

                    <label class="texto_formulario" style="min-width: 10ch;">
                        Nº
                        <input class="form-control input_default" type="number" placeholder="520" value="{{isset($endereco_sacado_juridica) ? $endereco_sacado_juridica->Endereco_Nro : $endereco_sacado_fisica->Endereco_Nro}}" readonly>
                    </label>

                    <label class="texto_formulario f_3" style="min-width: 26ch;">
                        COMPLEMENTO
                        <input class="form-control input_default" type="text" placeholder="" value="{{isset($endereco_sacado_juridica) ? $endereco_sacado_juridica->Endereco_Complemento : $endereco_sacado_fisica->Endereco_Complemento}}" readonly>
                    </label>

                    <label class="texto_formulario f_3" style="min-width: 21ch;">
                        BAIRRO
                        <input class="form-control input_default" type="text" placeholder="Jd. Flamboyant" value="{{isset($endereco_sacado_juridica) ? $endereco_sacado_juridica->Endereco_Bairro : $endereco_sacado_fisica->Endereco_Bairro}}" readonly>
                    </label>

                    <label class="texto_formulario" style="min-width: 7ch;">
                        UF
                        <input class="form-control input_default" type="text" placeholder="SP" value="{{isset($endereco_sacado_juridica) ? $endereco_sacado_juridica->Endereco_UF : $endereco_sacado_fisica->Endereco_UF}}" readonly>
                    </label>

                    <label class="texto_formulario f_2" style="min-width: 19ch;">
                        MUNICÍPIO
                        <input class="form-control input_default" type="text" placeholder="São Paulo" value="{{isset($endereco_sacado_juridica) ? $endereco_sacado_juridica->Endereco_Mun : $endereco_sacado_fisica->Endereco_Mun}}" readonly>
                    </label>

                    <label class="texto_formulario f_2" style="min-width: 19ch;">
                        PAÍS
                        <input class="form-control input_default" type="text" placeholder="BRASIL" value="{{isset($endereco_sacado_juridica) ? $endereco_sacado_juridica->Endereco_Pais : $endereco_sacado_fisica->Endereco_Pais}}" readonly>
                    </label>
                </div>
            </div>
		</div>
        <?php $count++;?>
    @endforeach
	</div>

	<script>
		var app = angular.module('myApp', []);
		app.controller('myCtrl', ['$scope', '$http', function($scope, $http) {
			$scope.etapa = 1;

			$scope.atualizaEtapa = function(v) {
				$scope.etapa = v;
			}
		}]);
	</script>

@endsection