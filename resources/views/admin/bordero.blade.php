@extends('layouts.admin.topo')
@section('content')
@if(isset($_GET['tag']))
<style>
.rodape{
	display: none !important;
}
.drawer-navbar{
	display: none !important;
}
.botao_pink{
    display: none !important;
}
.text-right{
    display: none !important;
}
</style>
@endif
<style>
    @media print {
        .container {
            display: block;
            color: black !important;
        }
        header, div.div-btn-imprimir, div.rodape {
            display: none;
        }
    }
    </style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
<div class="container" ng-app="myApp" ng-controller="myCtrl" ng-cloak id='bordero'>
    <div class="row text-right div-btn-imprimir" style='margin-top: 120px'>
        <a href="" onclick="window.print()" target="_blank" class="botao_pink" id="imprimir" style="margin: 0px">IMPRIMIR</a>
    </div>
    <div class="row" style="margin-top: 50px">
        <h5 class='text-capitalize'>
            Borderô de Compra de títulos:
        </h5>

        <p>
            A CEDENTE, abaixo identificada, cede à Zamprogna Securitizadora S/A, como objeto da operação - Compra de Títulos, realizada nesta data, o(s) título(s) relacionado(s) neste Borderô, sujeito(s) às normas discriminadas abaixo, que foram aceitas integralmente.
        </p>
    </div>
    <div class='row table-responsive'>
        <table class="table table-bordered" style="font-size: 12px !important;">
            <thead>
                <tr>
                    <th scope="col">Cedente</th>
                    <th scope="col">CNPJ</th>
                </tr>
            </thead>
            <tbody style="font-size: 12px !important;">
                <tr>
                    <td>{{isset($solicitante->OfficialName) ? $solicitante->OfficialName : $solicitante->Name}}</td>
                    <td>{{$solicitante->cnpj}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!--<div class='row'>
        <p>Dados da CEDENTE</p>
    </div>-->
    <div class='row table-responsive'>
        <table class="table table-bordered" style="font-size: 12px !important;">
            <thead>
                <tr>
                    <th scope="col">Data movimento</th>
                    <th scope="col">N° Borderô</th>
                </tr>
            </thead>
            <tbody style="font-size: 12px !important;">
                <tr>
                    <td>{{$bordero[0]->data_gerado}}</td>
                    <td>{{$bordero[0]->nro_bordero}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class='row'>
        <p>
            Taxa de Deságio por Prazo (dias)
        </p>
    </div>
    <div class='row table-responsive'>
        <table class="table table-bordered" style="font-size: 12px !important;">
            <thead>
                <tr>
                    <th scope="col">Vencimento</th>
                    <th scope="col">Mensal</th>
                    <th scope="col">Anual</th>
                </tr>
            </thead>
            <tbody style="font-size: 12px !important;">
                <tr>
                    <td>ATE 030</td>
                    <td>{{$solicitante->taxa_desagio}} %</td>
                    <td>{{$solicitante->taxa_desagio * 12}} %</td>
                </tr>
                <tr>
                    <td>031 A 060</td>
                    <td>{{$solicitante->taxa_desagio}} %</td>
                    <td>{{$solicitante->taxa_desagio * 12}} %</td>
                </tr>
                <tr>
                    <td>061 A 090</td>
                    <td>{{$solicitante->taxa_desagio}} %</td>
                    <td>{{$solicitante->taxa_desagio * 12}} %</td>
                </tr>
                <tr>
                    <td>091 A 120</td>
                    <td>{{$solicitante->taxa_desagio}} %</td>
                    <td>{{$solicitante->taxa_desagio * 12}} %</td>
                </tr>
                <tr>
                    <td>121 A 150</td>
                    <td>{{$solicitante->taxa_desagio}} %</td>
                    <td>{{$solicitante->taxa_desagio * 12}} %</td>
                </tr>
                <tr>
                    <td>A PARTIR DE 151%</td>
                    <td>{{$solicitante->taxa_desagio}} %</td>
                    <td>{{$solicitante->taxa_desagio * 12}} %</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class='row table-responsive'>
        <table class="table table-bordered" style="font-size: 12px !important;">
            <thead>
                <tr>
                    <!--th scope="col">Moeda</th>
                    <th scope="col">Real</th>-->
                </tr>
            </thead>
            <tbody style="font-size: 12px !important;">
                <tr>
                    <!--<td>Tipo de documento</td>
                    <td>Boleto bancário</td>-->
                </tr>
            </tbody>
        </table>
    </div>
    <div class='row table-responsive'>
        <table class="table table-bordered" style="font-size: 12px !important;">
            <thead>
                <tr>
                    <th scope="col">Quantidade</th>
                    <th scope="col">
                        Valor total do borderô
                    </th>
                </tr>
            </thead>
            <tbody style="font-size: 12px !important;">
            <?php   
            $valor_liberado = number_format($valor_liberado, 2, ',', '.');
            $valor_total_devido = number_format($valor_total_devido, 2, ',', '.');
            ?>
                <tr>
                    <td>{{$qtd_parcelas}}</td>
                    <td>{{$valor_total_devido}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class='row'>
        <p>PROTESTO/NEGATIVAÇÃO</p>
    </div>
    <div class='row table-responsive'>
        <table class="table table-bordered" style="font-size: 12px !important;">
            <tbody style="font-size: 12px !important;">
                <tr>
                    <td style="text-align: right">X</td>
                    <td>COM</td>
                </tr>
                <tr>
                    <td style="text-align: right"></td>
                    <td>SEM</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!--<div class='row table-responsive'>
        <table class="table table-bordered" style="font-size: 12px !important;">
            <thead>
                <tr>
                    <th scope="col">Somatório de Vencimentos</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody style="font-size: 12px !important;">
                <tr>
                    <td>Prazo de débito</td>
                    <td>1 dia</td>
                </tr>
            </tbody>
        </table>
    </div>-->
    <div class='row'>
        <h5>
            Operação de Compra de Títulos
        </h5>
        <p>
            1 - O(s) Título(s) objeto da(s) operação(ões) de compra, entregues à Cash to Flow para digitação e/ou transmitidos via internet, disponível no endereço eletrônico, são entregue(s) à Cash to Flow devidamente endossado(s) pela CEDENTE, que juntamente com o(s) FIADOR(ES) ficam responsáveis pela informação ao emitente de que o(s) Título(s) foi(ram) cedido(s) à Cash to Flow.
        </p>
        <p>
            2 - Após o(s) recebimento(s) do(s) Título(s) e aceitação na Cash to Flow para compra, o crédito do valor antecipado será feito à CEDENTE mediante crédito em conta digital ou conta corrente de sua titularidade. 
        <p>
            3 – O(s) valor(es) da(s) obrigação(es) assumida(s) em cada compra de títulos, terá(ão) o(s) mesmo(s) vencimento(s) do(s) respectivo(s) Título(s) cedido(s) para compra na Cash to Flow.
        </p>
        <!--<p>
            4 – Em caso de inadimplência ou descumprimento de qualquer obrigação legal ou convencional, inclusive na hipótese do vencimento antecipado da dívida, o débito apurado ficará sujeito aos seguintes encargos:
        </p>
        <p>
            I - Atualização monetária pela TR, prevista no artigo 404 do Código Civil e artigo 28, inciso II da Lei 10931/2004;
        </p>
        <p>
            - juros compensatórios capitalizados diariamente, previstos nos artigos 402 a 404 do Código Civil e artigo 28, inciso I da Lei 10931/2004, obedecida a mesma metodologia de cálculo e à razão das mesmas taxas dos juros remuneratórios previstos para o período de adimplência;
        </p>
        <p>
            - juros de mora, previstos nos artigos 406 e 407 do Código Civil e artigo 28, inciso III da Lei 10931/2004, calculados à taxa nominal de 1% (um por cento) ao mês ou fração, proporcionais aos dias compreendidos entre o vencimento da obrigação e o pagamento;
        </p>
        <p>
            IV - custas e honorários advocatícios, previstos nos artigos 389, 395 e 404 do Código Civil, à razão de 30% (trinta por cento) sobre o valor total devido em caso de intervenção de advogado (honorários extrajudiciais) e em montante que venha a ser estipulado pelo juízo em caso de sucumbência, nos termos dos artigos 85 a 87 do Código de Processo Civil (honorários judiciais).
        </p>
        <p>
            5.1 - Todos os encargos citados serão devidos mesmo nos casos de falência, recuperação judicial, insolvência civil ou superendividamento do CREDITADO.
        </p>
        <p>
            6 - A liquidação da operação ocorrerá das seguintes formas:
        </p>
        <p>
            6.1 - Mediante débito em conta da CEDENTE, quando não ocorrer a(s) liquidação(ões) financeira(s) do(s) título(s) cedido(s).
        </p>-->
        <p>
            4 – Os títulos relacionados neste Termo, entregues neste ato, serão analisados e processados pela Cash to Flow e após estes procedimentos poderão ser excluídos por terem sido considerados inadequados, impróprios ou fora dos critérios de aceitação, sendo que os demais títulos considerados aceitos passarão a fazer parte integrante e complementar deste instrumento para todos os fins de direito.
        </p>
        <!--<p>
            7.1 – Os dados dos títulos porventura alterados, incluídos ou excluídos constarão da Relação de títulos Excluídos/Alterados do Borderô, parte integrante e inseparável deste Instrumento.
        </p>-->
        <p>
            5 - A CEDENTE e o(s) FIADOR(ES)/CO-DEVEDOR(ES) declaram, para todos os fins de direito que tiveram prévio conhecimento das cláusulas contratuais, por período e modo suficientes para o pleno conhecimento das estipulações previstas, as quais reputam claras e desprovidas de ambiguidade, dubiedade ou contradição, estando cientes dos direitos e das obrigações previstas no contrato.
        </p>
    </div>
    <div class='row'>
        <h5><u>Relação de Títulos para Compra:</u></h5>
    </div>
    <div class='row table-responsive'>
                <table class="table table-bordered" style="font-size: 12px !important;">
                    <thead>
                        <tr>
                            <th scope="col" class="text-left">Sacado</th>
                            <th scope="col" class="text-left">CNPJ/CPF</th>
                            <th scope="col" class="text-left">Título</th>
                            <th scope="col" class="text-left">Venc.</th>
                            <th scope="col" class="text-left">Valor</th>
                            <th scope="col" class="text-left">Juros</th>
                            <th scope="col" class="text-left">IOF</th>
                            <th scope="col" class="text-left">TAC</th>
                            <th scope="col" class="text-left">Prazo</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $i = 0; @endphp
                    @foreach($parcelas as $parcela)
                        @foreach($parcela as $sc)
                            @php $i++;
                            $t_total        = str_replace('.', '', $sc->valor_parcela);
                            $t_total        = str_replace(',', '.', $t_total);
                            $t_juros        = str_replace('.', '', $sc->valor_juros);
                            $t_juros        = str_replace(',', '.', $t_juros);
                            $v_juros        = $t_total-$t_juros; 
                            
                            $data               = date('Y-m-d');
                            $diff_dias          = number_format((strtotime($sc->vencimento) - strtotime($data)) / 86400, 0);

                            $sc->vencimento = $sc->vencimento.' 00:00:00';
                            $sc->vencimento = implode("/", array_reverse(explode("-", substr($sc->vencimento, 0, 10))));;
                                
                            @endphp
                            <tr style="font-size: 12px !important;">
                                <td>
                                    {{isset($sc->OfficialName) ? $sc->OfficialName : $sc->Name }}
                                </td>
                                <td>
                                    {{isset($sc->cnpj) ? $sc->cnpj : $sc->cpf }}
                                </td>
                                <td>
                                    {{$i}}
                                </td>
                                <td>
                                    {{$sc->vencimento}}
                                </td>
                                <td>
                                    {{$sc->valor_parcela}}
                                </td>
                                <td>
                                    {{ number_format($v_juros, 2, ',', '.') }}
                                </td>                        
                                <td>
                                    0
                                </td>
                                <td>
                                    0
                                </td>
                                <td>
                                    {{$diff_dias}}
                                </td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
    <div class='row table-responsive'>
        <table class="table table-bordered" style="font-size: 12px !important;">
            <tbody style="font-size: 12px !important;">
                <tr>
                </tr>
            </tbody>
        </table>
    </div>
    <div class='row'>
        <!--<p class="text-center">
            O CET será alterado no caso de inclusão/exclusão/rejeição de títulos do borderô ou pela alteração das condições da operação (taxa de juros, tarifa e demais).
        </p>-->
    </div>
    <div class='row table-responsive'>
                <table class="table table-bordered" style="font-size: 12px !important;">
                    <thead>
                        <tr>
                        <th scope="col">RESUMO DA OPERAÇÃO</th>
                        <th scope="col">Valor (R$)</th>
                        <th scope="col">Percentual em Relação ao Total (%)</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 12px !important;">
                        <tr>
                            <td>1- Valor total no ato da contratação</td>
                            <td>{{$valor_total_devido}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2- Valor liberado ao cliente</td>
                            <td>{{ $valor_liberado }}</td>
                            <td>{{number_format($porc_final,2)}}</td>
                        </tr>
                        <tr>
                            <td>3- Despesas vinculadas</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>3- A) Tarifa</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>3- B) Imposto (IOF)</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>3- C) DESÁGIO</td>
                            <td>{{$diff_valor}}</td>
                            <td>{{number_format($porc_restante,2)}} %</td>
                        </tr>
                    </tbody>
                </table>
            </div>
    <div class="row">
        <p>6 - O(s) CEDENTE(S) declara(m)-se ciente(s) dos fluxos referentes aos pagamentos e recebimentos considerados no RESUMO DA OPERAÇÃO, para a presente operação de compra de títulos, conforme demonstrado em planilha, no qual constam os valores em sua forma nominal e cálculo dos percentuais de cada componente do fluxo das operações.
        </p>
    </div>
    <div class="row">
        <p>
        <?
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $data = strftime('%d de %B de %Y', strtotime('today'));
        ?>
        Guaporé-RS, <?echo $data; ?>
        </p>
        <br />
        <br />
        <br />
    </div>
    <div class="row">
        <div class='line' style='border-bottom: 1px solid black; width: 50%;'>
        </div>
        <p>Assinatura do Representante da CEDENTE</p>
        <p>Nome: {{isset($solicitante->OfficialName) ? $solicitante->OfficialName: ''}}</p>
        <br />
    </div>
    <div class="row">
        <div class='line' style='border-bottom: 1px solid black; width: 50%;'>
        </div>
        <p>Zamprogna Securitizadora S/A</p>
        <br />
    </div>
    <!--<div class="row">
        <p>Testemunhas:</p>
    </div>
    <div class="row" style='display: flex; justify-content: space-between'>
        <div class="" style="width: 100%">
            <br />
            <div class='line' style='border-bottom: 1px solid black; width: 50%;'>
            </div>
            <p>Nome:</p>
            <p>CPF:</p>
            <br />
        </div>
        <div class="" style="width: 100%">
            <br />
            <div class='line' style='border-bottom: 1px solid black; width: 50%;'>
            </div>
            <p>Nome:</p>
            <p>CPF:</p>
            <br />
        </div>
    </div>-->
</div>
<script src="./js/html2pdf.min.js"></script>
<script>
    // var a4 = [595.28, 841.89]; // Widht e Height de uma folha a4

    // const element = document.getElementById('bordero');
    // const width = element.offsetWidth;

    // // debugger;
    // element.style.width = '600px';
    // // Define optional configuration
    // var options = {
    //     filename: 'my-file.pdf',
    // };

    // // Create instance of html2pdf class
    // var exporter = new html2pdf(element, options);

    // // Download the PDF or...
    // exporter.getPdf(true).then((pdf) => {
    //     console.log('pdf file downloaded');
    //     element.style.width = width+'px';
    // });

    // // Get the jsPDF object to work with it
    // exporter.getPdf(false).then((pdf) => {
    //     console.log('doing something before downloading pdf file');
    //     pdf.save();
    // });

    // // You can also use static methods for one time use...
    // options.source = element;
    // options.download = true;
    // html2pdf.getPdf(options);

    /**TODO ADJUST width*/
    // return location.reload();

    // window.onload(() => {
    //     window.print()
    // });

    var app = angular.module('myApp', []);
    app.controller('myCtrl', ['$scope', '$http', function($scope, $http) {
        $scope.etapa = 1;

        $scope.atualizaEtapa = function(v) {
            $scope.etapa = v;
        }
    }]);
</script>
@endsection