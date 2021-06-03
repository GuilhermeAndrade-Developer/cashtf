@extends('layouts.admin.cliente_view.topo_bordero')
@section('content')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>

<div class="container-fluid fluid-person mb80" ng-app="myApp" ng-controller="myCtrl" ng-cloak>
	<div class="row mt120">
        <div class='input-list col-md-7'>
            <p class="stats f_color">CONTA PARA RECEBIMENTO</p>

            <div class="dflex">
                <label class="texto_formulario f_6" style="min-width: 40ch;">
                    BANCO
                    <input class="form-control input_default" type="text" placeholder="BANCO X S.A." value="{{isset($conta) ? $conta->banco : ''}}" readonly>
                </label>

                <label class="texto_formulario f_2" style="min-width: 13ch;">
                    AGÊNCIA
                    <input class="form-control input_default" type="number" placeholder="0594" value="{{isset($conta) ? $conta->agencia : ''}}" readonly>
                </label>

                <label class="texto_formulario f_3" style="min-width: 21ch;">
                    CONTA
                    <input class="form-control input_default" type="number" placeholder="384234" value="{{isset($conta) ? $conta->conta : ''}}" readonly>
                </label>

                <label class="texto_formulario" style="min-width: 8ch;">
                    DIGITO
                    <input class="form-control input_default" type="number" placeholder="6" value="{{isset($conta) ? $conta->digito : ''}}" readonly>
                </label>
            </div>
        </div>
        <?php $count = 1;?>
        @foreach($bordero as $b)
        <div class="solicitacao-status col-md-4 dflex" ng-show="etapa==<?= $count;?>">
            <div>
                <i class="las la-check steps"></i>
                <p>EM ANÁLISE</p>
            </div>
            @if($b->id_status <= 2 && $b->id_status != 1)
            <div><i class="status-lineun"></i></div>
            @else
            <div><i class="status-line"></i></div>
            @endif
            <div>
                @if($b->id_status < 4)
                <i class="las la-check stepsun"></i>
                @else
                <i class="las la-check steps"></i>
                @endif
                <p>ASSINAR BORDERÔ<br>
                (Parcialmente Aprovado)
                </p>
            </div>
            @if($b->id_status < 5)
            <div><i class="status-lineun"></i></div>
            @else
            <div><i class="status-line"></i></div>
            @endif
            <div>
                @if($b->id_status == 6)
                <i class="las la-check steps"></i>
                @else
                <i class="las la-check stepsun"></i>
                @endif
                <p>CREDITADO</p>
            </div>
        </div>
        <?php $count++;?>
        @endforeach
	</div>
    <?php $count = 1;?>
	<div class="row" style="margin: 0 -11px;">
		<div class="col-md-12 mt20">
			<ol class="div_cliente_flex custom text-center">
                <!-- foreach quando refatorar -->
                @foreach($bordero as $b)
                    @if($b->id_status == 3)
                    <div class="cinzasacado m_b_dark_red" ng-click="atualizaEtapa(<?= $count;?>)" ng-class="etapa==<?= $count;?>?'active':''">
                        <li>{{isset($b->id_nota_reduzida) ? $b->id_nota_reduzida : ''}}</li>
                    </div>
                    @else
                    <div class="cinzasacado" ng-click="atualizaEtapa(<?= $count;?>)" ng-class="etapa==<?= $count;?>?'active':''">
                        <li>{{isset($b->id_nota_reduzida) ? $b->id_nota_reduzida : ''}}</li>
                    </div>
                    @endif
                    <?php $count++;?>
                @endforeach
                <!-- endforeach -->
                <?php $count = 1;?>
                @foreach($bordero as $b)
				<div class="cinzasacado soma-notas" ng-show="etapa==<?= $count;?>">TOTAL LÍQUIDO: <b>R$ {{$b->valor_total_juros}}</b></div>
                <?php $count++;?>
                @endforeach
			</ol>

            <div class="linhaazul"></div>
		</div>
	</div>
    <?php $count = 1;?>
	<div class="row">
        @foreach($bordero as $b)
		<div class="col-md-12" ng-show="etapa==<?= $count;?>">
            <table class="table table-default table-default-admin custom">
                @if($b->id_status == 3)
                <thead class="m_b_dark_red">
                @else
                <thead>
                @endif
                    <tr>
                        <th>PARCELAS</th>
                        <th>VENCIMENTO</th>
                        <th>VALOR DA PARCELA</th>
                        <th>JUROS</th>
                        <th>TAC</th>
                        <th>VALOR A RECEBER</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                @foreach ($b->parcelas as $p)
                    <tr>
                        <td>{{$p->numero}}ª PARCELA</td>
                        <td>{{$p->vencimento}}</td>
                        <td>R$ {{$p->valor_parcela}}</td>
                        <td>R$ {{$p->desagio}}</td>
                        <td>R$ {{$p->tac}}</td>
                        <td>R$ {{$p->valor_juros}}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>

                <tfoot>
                    @if($b->id_status == 3)
                    <tr class="m_b_dark_red">
                        <td colspan="5"></td>
                        <td>TOTAL ANTECIPADO</td>
                        <td>JUROS</td>
                    </tr>
                    @else
                    <tr class="b_s_dark_color">
                        <td colspan="5"></td>
                        <td>TOTAL ANTECIPADO</td>
                        <td>JUROS</td>
                    </tr>
                    @endif
                    @if($b->id_status == 3)
                    <tr class="m_b_red">
                    @else
                    <tr class="b_f_color">
                    @endif
                        <td colspan="5"><i class="las la-link" href="http://www.nfe.fazenda.gov.br/portal/consultaRecaptcha.aspx?tipoConsulta=completa&tipoConteudo=XbSeqxE8pl8=" target="_blank">{{$b->id_nota}}</i></td>
                        <td>R$ {{$b->valor_total}}</td>
                        <td>{{$b->juros}}%</td>
                    </tr>
                </tfoot>
            </table>

            <div class="text-right" style="margin: 0 6px;">
            @if(isset($b->arquivo_xml))
                <a class="download las la-file-download la-lg white b_s_dark_color" href="{{asset('/uploads/xml/'.$b->arquivo_xml)}}" download>BAIXAR NOTA</a>
            @endif    
                <label for="status">
                <form action="{{route('admin.update.status',$b->id)}}" method="post">
                @csrf
                <!--onchange event-->
                    <select name="status" onchange="this.form.submit()">
                    @foreach($status as $s)
                    @if($s->id == $b->id_status)
                        <option value="{{$s->id}}" selected>{{$s->nome}}</option>
                    @else
                        <option value="{{$s->id}}">{{$s->nome}}</option>
                    @endif
                    @endforeach
                    </select>
                </form>
                </label>
            </div>

            <div class='input-list'>
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
                        <input class="form-control input_default" type="text" placeholder="12/05/1990" value="{{$b->data_emissao}}" readonly>
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
                        <input class="form-control input_default" type="text" placeholder="12917-021" value="{{isset($endereco->Endereco_CEP) ? $endereco->Endereco_CEP : ''}}" readonly>
                    </label>

                    <label class="texto_formulario f_4" style="min-width: 51ch">
                        ENDEREÇO/RUA..., AV..., etc.
                        <input class="form-control input_default" type="text" placeholder="Rua das Orquídeas" value="{{isset($endereco->Endereco_Lgr) ? $endereco->Endereco_Lgr : ''}}" readonly>
                    </label>

                    <label class="texto_formulario" style="min-width: 10ch;">
                        Nº
                        <input class="form-control input_default" type="number" placeholder="520" value="{{isset($endereco->Endereco_Nro) ? $endereco->Endereco_Nro : ''}}" readonly>
                    </label>

                    <label class="texto_formulario f_3" style="min-width: 26ch;">
                        COMPLEMENTO
                        <input class="form-control input_default" type="text" placeholder="" value="{{isset($endereco->Endereco_Complemento) ? $endereco->Endereco_Complemento : ''}}" readonly>
                    </label>

                    <label class="texto_formulario f_3" style="min-width: 21ch;">
                        BAIRRO
                        <input class="form-control input_default" type="text" placeholder="Jd. Flamboyant" value="{{isset($endereco->Endereco_Bairro) ? $endereco->Endereco_Bairro : ''}}" readonly>
                    </label>

                    <label class="texto_formulario" style="min-width: 7ch;">
                        UF
                        <input class="form-control input_default" type="text" placeholder="SP" value="{{isset($endereco->Endereco_UF) ? $endereco->Endereco_UF : ''}}" readonly>
                    </label>

                    <label class="texto_formulario f_2" style="min-width: 19ch;">
                        MUNICÍPIO
                        <input class="form-control input_default" type="text" placeholder="São Paulo" value="{{isset($endereco->Endereco_Mun) ? $endereco->Endereco_Mun : ''}}" readonly>
                    </label>

                    <label class="texto_formulario f_2" style="min-width: 19ch;">
                        PAÍS
                        <input class="form-control input_default" type="text" placeholder="BRASIL" value="{{isset($endereco->Endereco_Pais) ? $endereco->Endereco_Pais : ''}}" readonly>
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