@extends('layouts.cliente.borderoInfo')

@section('content')
    <script>document.querySelector('header #boletos').classList.add('active');</script>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>


    <main class="app-g bordero-info">
        <div id="nao_ha_boletos" class="box_alert" style="display: none">
            <div>
                <button class="las la-times la-lg" onClick="getElementById('nao_ha_boletos').style.display='none';"></button>

                <i class="las la-times la-lg"></i>
                <p class="h3">BOLETOS AINDA NÃO DISPONÍVEIS</p>

                <p>Os boletos ainda não foram gerados. Assim que <br>
                disponíveis enviaremos um e-mail informativo.</p>

                <button class="understand" onClick="location.href = 'whoRoute?'">ENTENDI</button>
            </div>
        </div>

        <div class="conteudo" ng-app="myApp" ng-controller="myCtrl" ng-cloak>
            <div class="title b_t_color">BOLETOS</div>

            <div class="row" style="margin: 0">
                <div class="col-md-12 mt30">
                    <ol class="div_cliente_flex custom text-center">
                        <div class="cinzasacado" ng-click="atualizaEtapa(1)" ng-class="etapa==1?'active':''">
                            <li>HOTEL</li>
                        </div>

                        <div class="cinzasacado" ng-click="atualizaEtapa(2)" ng-class="etapa==2?'active':''">
                            <li>JOÃO</li>
                        </div>
                    </ol>

                    <div class="linhaazul"></div>
                </div>
            </div>

            <div class="row" style="margin: 0">
                <div class="col-md-12" ng-show="etapa==1">
                    <table class="table table-default table-default-admin custom boletos">
                        <thead>
                            <tr>
                                <th>NRE BOLETO</th>
                                <th style="width: 40%">VENCIMENTO</th>
                                <th>VALOR</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>114-1/1</td>
                                <td>10/10/2020</td>
                                <td>490,05</td>
                                <td><span class="payment b_green white">PAGO</span></td>
                            </tr>
                            <tr>
                                <td>114-1/1</td>
                                <td>10/11/2020</td>
                                <td>490,05</td>
                                <td><span class="payment b_red white">ATRASADO</span></td>
                            </tr>
                            <tr>
                                <td>114-1/1</td>
                                <td>10/12/2020</td>
                                <td>490,05</td>
                                <td><span class="payment b_yellow white">PENDENTE</span></td>
                            </tr>
                        </tbody>

                        <tfoot>
                            <tr class="b_s_dark_color">
                                <td colspan="2"></td>
                                <td>TOTAL</td>
                                <td></td>
                            </tr>
                            <tr class="b_f_color">
                                <td colspan="2"></td>
                                <td>R$ 1.470,15</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="input-list mt30">
                        <p class="stats">DADOS DO SACADO</p>

                        <div class="dflex">
                            <label class="texto_formulario f_2" style="min-width: 32ch;" >
                                CPF/CNPJ
                                <input class="form-control input_default copy-type white" type="number" placeholder="21.594.976/0001-00" value="" disabled>
                            </label>

                            <label class="texto_formulario f_5" style="min-width: 65ch;">
                                NOME / RAZÃO SOCIAL
                                <input class="form-control input_default mark-type white" type="text" placeholder="HOTEL MONTE VERDE EIRELI" value="" disabled>
                            </label>

                            <label class="texto_formulario f_2" style="min-width: 15ch;">
                                EMISSÃO
                                <input class="form-control input_default" type="text" placeholder="12/05/1990" value="" disabled>
                            </label>

                            <label class="f_3"></label>
                        </div>

                        <div class="dflex">
                            <label class="texto_formulario f_2" style="min-width: 18ch;">
                                CEP
                                <input class="form-control input_default" type="number" placeholder="12917-021" value="" disabled>
                            </label>

                            <label class="texto_formulario f_4" style="min-width: 51ch">
                                ENDEREÇO/RUA..., AV..., etc.
                                <input class="form-control input_default" type="text" placeholder="Rua das Orquídeas" value="" disabled>
                            </label>

                            <label class="texto_formulario" style="min-width: 11ch;">
                                Nº
                                <input class="form-control input_default" type="number" placeholder="520" value="" disabled>
                            </label>

                            <label class="texto_formulario f_3" style="min-width: 26ch;">
                                COMPLEMENTO
                                <input class="form-control input_default" type="text" placeholder="" value="" disabled>
                            </label>

                            <label class="texto_formulario f_3" style="min-width: 21ch;">
                                BAIRRO
                                <input class="form-control input_default" type="text" placeholder="Jd. Flamboyant" value="" disabled>
                            </label>

                            <label class="texto_formulario" style="min-width: 7ch;">
                                UF
                                <input class="form-control input_default" type="text" placeholder="SP" value="" disabled>
                            </label>

                            <label class="texto_formulario f_2" style="min-width: 19ch;">
                                MUNICÍPIO
                                <input class="form-control input_default" type="text" placeholder="São Paulo" value="" disabled>
                            </label>

                            <label class="texto_formulario f_2" style="min-width: 19ch;">
                                PAÍS
                                <input class="form-control input_default" type="text" placeholder="BRASIL" value="" disabled>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" ng-show="etapa==2">2</div>

                <div class="col-md-12" ng-show="etapa==3">3</div>
            </div>
        </div>
    </main>


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
