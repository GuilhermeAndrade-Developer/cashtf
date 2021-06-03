@extends('layouts.cliente.borderoInfo')

@section('content')
    <script>document.querySelector('header #notas').classList.add('active');</script>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>

    <main class="app-g bordero-info conteudo" ng-app="myApp" ng-controller="myCtrl" ng-cloak>
        <div class="row" style="margin: 34px 0 0">
            <div class="input-list col-md-7" style="margin: 0 -6px">
                <p class="stats f_color">CONTA PARA RECEBIMENTO</p>

                <div class="dflex">
                    <label class="texto_formulario f_6" style="min-width: 40ch;">
                        BANCO
                        <input class="form-control input_default" type="text" placeholder="BANCO X S.A." value="" disabled>
                    </label>

                    <label class="texto_formulario f_2" style="min-width: 13ch;">
                        AGÊNCIA
                        <input class="form-control input_default" type="number" placeholder="0594" value="" disabled>
                    </label>

                    <label class="texto_formulario f_3" style="min-width: 21ch;">
                        CONTA
                        <input class="form-control input_default" type="number" placeholder="384234" value="" disabled>
                    </label>

                    <label class="texto_formulario" style="min-width: 8ch;">
                        DIGITO
                        <input class="form-control input_default" type="number" placeholder="6" value="" disabled>
                    </label>
                </div>
            </div>

            <div class="solicitacao-status col-md-4">
                <div>
                    <i class="las la-check b_green"></i>
                    <p>EM ANÁLISE</p>
                </div>

                <div><i class="status-line b_green"></i></div>

                <div>
                    <i class="las la-ellipsis-h b_yellow"></i>
                    <p>ASSINAR BORDERÔ<br>
                    (Parcialmente Aprovado)
                    </p>
                </div>

                <div><i class="status-line"></i></div>

                <div>
                    <i class="las la-times b_red"></i>
                    <p>CREDITADO</p>
                </div>
            </div>
        </div>

        <div class="row" style="margin: 0">
            <div class="col-md-12 mt30">
                <ol class="div_cliente_flex custom text-center">
                    <div class="" ng-click="atualizaEtapa(1)" ng-class="etapa==1?'active':''">
                        <li>HOTEL</li>
                    </div>

                    <div class="warn" ng-click="atualizaEtapa(2)" ng-class="etapa==2?'active':''">
                        <li>JOÃO</li>
                    </div>

                    <div class="" ng-click="atualizaEtapa(3)" ng-class="etapa==3?'active':''">
                        <li>COCA</li>
                    </div>

                    <div class="soma-notas">TOTAL LÍQUIDO: <b>R$ 4.338,85</b></div>
                </ol>

                <div class="linhaazul"></div>
            </div>
        </div>

        <div class="row" style="margin: 0">
            <div class="col-md-12" ng-show="etapa==1">
                <table class="table table-default table-default-admin custom notas">
                    <thead>
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
                        <tr>
                            <td>1ª PARCELA</td>
                            <td>10/10/2020</td>
                            <td>R$ 500,00</td>
                            <td>R$ 29,85</td>
                            <td>R$ 4,44</td>
                            <td>490,05</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2ª PARCELA</td>
                            <td>10/11/2020</td>
                            <td>R$ 500,00</td>
                            <td>R$ 29,85</td>
                            <td>R$ 4,44</td>
                            <td>490,05</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>3ª PARCELA</td>
                            <td>10/12/2020</td>
                            <td>R$ 500,00</td>
                            <td>R$ 29,85</td>
                            <td>R$ 4,44</td>
                            <td>490,05</td>
                            <td></td>
                        </tr>
                    </tbody>

                    <tfoot>
                        <tr class="b_s_dark_color">
                            <td colspan="4"></td>
                            <td>TOTAL DA NOTA</td>
                            <td>TOTAL ANTECIPADO</td>
                            <td>JUROS</td>
                        </tr>
                        <tr class="b_f_color">
                            <td colspan="4"></td>
                            <td>R$ 1.500,00</td>
                            <td>R$ 1.470,15</td>
                            <td>1.99%</td>
                        </tr>
                    </tfoot>
                </table>

                <div class='input-list'>
                    <p class="stats f_color">DADOS DO SACADO</p>

                    <div class="dflex">
                        <label class="texto_formulario f_2" style="min-width: 31ch;">
                            CPF/CNPJ
                            <input class="form-control input_default" type="number" placeholder="21.594.976/0001-00" value="" disabled>
                        </label>

                        <label class="texto_formulario f_5" style="min-width: 65ch;">
                            NOME / RAZÃO SOCIAL
                            <input class="form-control input_default" type="text" placeholder="HOTEL MONTE VERDE EIRELI" value="" disabled>
                        </label>

                        <label class="texto_formulario f_2" style="min-width: 15ch;">
                            EMISSÃO
                            <input class="form-control input_default" type="text" placeholder="12/05/1990" value="" disabled>
                        </label>

                        <label class="f_3"></label>
                    </div>

                    <div class="dflex">
                        <label class="texto_formulario f_2" style="min-width: 15ch;">
                            CEP
                            <input class="form-control input_default" type="number" placeholder="12917-021" value="" disabled>
                        </label>

                        <label class="texto_formulario f_4" style="min-width: 51ch">
                            ENDEREÇO/RUA..., AV..., etc.
                            <input class="form-control input_default" type="text" placeholder="Rua das Orquídeas" value="" disabled>
                        </label>

                        <label class="texto_formulario" style="min-width: 10ch;">
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

            <div class="col-md-12" ng-show="etapa==2">
                <table class="table table-default table-default-admin custom notas">
                    <thead class="b_Dred">
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
                        <tr>
                            <td>1ª PARCELA</td>
                            <td>10/10/2020</td>
                            <td>R$ 500,00</td>
                            <td>R$ 29,85</td>
                            <td>R$ 4,44</td>
                            <td>490,05</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2ª PARCELA</td>
                            <td>10/11/2020</td>
                            <td>R$ 500,00</td>
                            <td>R$ 29,85</td>
                            <td>R$ 4,44</td>
                            <td>490,05</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>3ª PARCELA</td>
                            <td>10/12/2020</td>
                            <td>R$ 500,00</td>
                            <td>R$ 29,85</td>
                            <td>R$ 4,44</td>
                            <td>490,05</td>
                            <td></td>
                        </tr>
                    </tbody>

                    <tfoot>
                        <tr class="b_Dred">
                            <td colspan="4"></td>
                            <td>TOTAL DA NOTA</td>
                            <td>TOTAL ANTECIPADO</td>
                            <td>JUROS</td>
                        </tr>
                        <tr class="b_red">
                            <td colspan="4"></td>
                            <td>R$ 1.500,00</td>
                            <td>R$ 1.470,15</td>
                            <td>1.99%</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="col-md-12" ng-show="etapa==3">
                3
            </div>
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

    </main>
@endsection
