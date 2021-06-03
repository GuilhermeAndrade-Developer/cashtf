<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
</head>
<style>
    .container{width:90%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}
    .text-justify{text-align: justify;}
    .row{margin-right:-15px;margin-left:-15px}
    .text-capitalize{text-transform:capitalize!important}
    .text-center{text-align:center}
    .text-left{text-align:left}
    .table-striped > tbody > tr:nth-of-type(2n+1){
		background-color: #F5F5F5;	
    }
    .table{width:100%;margin-bottom:1rem;background-color:transparent}.table td,.table th{padding:.75rem;vertical-align:top;border-top:1px solid #dee2e6}.table thead th{vertical-align:bottom;border-bottom:2px solid #dee2e6}.table tbody+tbody{border-top:2px solid #dee2e6}.table .table{background-color:#f8fafc}.table-sm td,.table-sm th{padding:.3rem}.table-bordered,.table-bordered td,.table-bordered th{border:1px solid #dee2e6}.table-bordered thead td,.table-bordered thead th{border-bottom-width:2px}.table-borderless tbody+tbody,.table-borderless td,.table-borderless th,.table-borderless thead th{border:0}.table-striped tbody tr:nth-of-type(odd){background-color:rgba(0,0,0,.05)}.table-hover tbody tr:hover{background-color:rgba(0,0,0,.075)}.table-primary,.table-primary>td,.table-primary>th{background-color:#c6e0f5}.table-hover .table-primary:hover,.table-hover .table-primary:hover>td,.table-hover .table-primary:hover>th{background-color:#b0d4f1}.table-secondary,.table-secondary>td,.table-secondary>th{background-color:#d6d8db}.table-hover .table-secondary:hover,.table-hover .table-secondary:hover>td,.table-hover .table-secondary:hover>th{background-color:#c8cbcf}.table-success,.table-success>td,.table-success>th{background-color:#c7eed8}.table-hover .table-success:hover,.table-hover .table-success:hover>td,.table-hover .table-success:hover>th{background-color:#b3e8ca}.table-info,.table-info>td,.table-info>th{background-color:#d6e9f9}.table-hover .table-info:hover,.table-hover .table-info:hover>td,.table-hover .table-info:hover>th{background-color:#c0ddf6}.table-warning,.table-warning>td,.table-warning>th{background-color:#fffacc}.table-hover .table-warning:hover,.table-hover .table-warning:hover>td,.table-hover .table-warning:hover>th{background-color:#fff8b3}.table-danger,.table-danger>td,.table-danger>th{background-color:#f7c6c5}.table-hover .table-danger:hover,.table-hover .table-danger:hover>td,.table-hover .table-danger:hover>th{background-color:#f4b0af}.table-light,.table-light>td,.table-light>th{background-color:#fdfdfe}.table-hover .table-light:hover,.table-hover .table-light:hover>td,.table-hover .table-light:hover>th{background-color:#ececf6}.table-dark,.table-dark>td,.table-dark>th{background-color:#c6c8ca}.table-hover .table-dark:hover,.table-hover .table-dark:hover>td,.table-hover .table-dark:hover>th{background-color:#b9bbbe}.table-active,.table-active>td,.table-active>th,.table-hover .table-active:hover,.table-hover .table-active:hover>td,.table-hover .table-active:hover>th{background-color:rgba(0,0,0,.075)}.table .thead-dark th{color:#f8fafc;background-color:#212529;border-color:#32383e}.table .thead-light th{color:#495057;background-color:#e9ecef;border-color:#dee2e6}.table-dark{color:#f8fafc;background-color:#212529}.table-dark td,.table-dark th,.table-dark thead th{border-color:#32383e}.table-dark.table-bordered{border:0}.table-dark.table-striped tbody tr:nth-of-type(odd){background-color:hsla(0,0%,100%,.05)}.table-dark.table-hover tbody tr:hover{background-color:hsla(0,0%,100%,.075)}@media (max-width:575.98px){.table-responsive-sm{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch;-ms-overflow-style:-ms-autohiding-scrollbar}.table-responsive-sm>.table-bordered{border:0}}@media (max-width:767.98px){.table-responsive-md{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch;-ms-overflow-style:-ms-autohiding-scrollbar}.table-responsive-md>.table-bordered{border:0}}@media (max-width:991.98px){.table-responsive-lg{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch;-ms-overflow-style:-ms-autohiding-scrollbar}.table-responsive-lg>.table-bordered{border:0}}@media (max-width:1199.98px){.table-responsive-xl{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch;-ms-overflow-style:-ms-autohiding-scrollbar}.table-responsive-xl>.table-bordered{border:0}}.table-responsive{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch;-ms-overflow-style:-ms-autohiding-scrollbar}.table-responsive>.table-bordered{border:0}
    .table{border-collapse:collapse!important}.table td,.table th{background-color:#fff!important}.table-bordered td,.table-bordered th{border:1px solid #dee2e6!important}.table-dark{color:inherit}.table-dark tbody+tbody,.table-dark td,.table-dark th,.table-dark thead th{border-color:#dee2e6}.table .thead-dark th{color:inherit;border-color:#dee2e6}}
    .table{border-collapse:collapse!important}.table td,.table th{background-color:#fff!important}.table-bordered td,.table-bordered th{border:1px solid #ddd!important}}
    .col-lg-1,.col-lg-10,.col-lg-11,.col-lg-12,.col-lg-2,.col-lg-3,.col-lg-4,.col-lg-5,.col-lg-6,.col-lg-7,.col-lg-8,.col-lg-9,.col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-sm-1,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9,.col-xs-1,.col-xs-10,.col-xs-11,.col-xs-12,.col-xs-2,.col-xs-3,.col-xs-4,.col-xs-5,.col-xs-6,.col-xs-7,.col-xs-8,.col-xs-9{position:relative;min-height:1px;padding-right:15px;padding-left:15px}.col-xs-1,.col-xs-10,.col-xs-11,.col-xs-12,.col-xs-2,.col-xs-3,.col-xs-4,.col-xs-5,.col-xs-6,.col-xs-7,.col-xs-8,.col-xs-9{float:left}.col-xs-12{width:100%}.col-xs-11{width:91.66666667%}.col-xs-10{width:83.33333333%}.col-xs-9{width:75%}.col-xs-8{width:66.66666667%}.col-xs-7{width:58.33333333%}.col-xs-6{width:50%}.col-xs-5{width:41.66666667%}.col-xs-4{width:33.33333333%}.col-xs-3{width:25%}.col-xs-2{width:16.66666667%}.col-xs-1{width:8.33333333%}.col-xs-pull-12{right:100%}.col-xs-pull-11{right:91.66666667%}.col-xs-pull-10{right:83.33333333%}.col-xs-pull-9{right:75%}.col-xs-pull-8{right:66.66666667%}.col-xs-pull-7{right:58.33333333%}.col-xs-pull-6{right:50%}.col-xs-pull-5{right:41.66666667%}.col-xs-pull-4{right:33.33333333%}.col-xs-pull-3{right:25%}.col-xs-pull-2{right:16.66666667%}.col-xs-pull-1{right:8.33333333%}.col-xs-pull-0{right:auto}.col-xs-push-12{left:100%}.col-xs-push-11{left:91.66666667%}.col-xs-push-10{left:83.33333333%}.col-xs-push-9{left:75%}.col-xs-push-8{left:66.66666667%}.col-xs-push-7{left:58.33333333%}.col-xs-push-6{left:50%}.col-xs-push-5{left:41.66666667%}.col-xs-push-4{left:33.33333333%}.col-xs-push-3{left:25%}.col-xs-push-2{left:16.66666667%}.col-xs-push-1{left:8.33333333%}.col-xs-push-0{left:auto}.col-xs-offset-12{margin-left:100%}.col-xs-offset-11{margin-left:91.66666667%}.col-xs-offset-10{margin-left:83.33333333%}.col-xs-offset-9{margin-left:75%}.col-xs-offset-8{margin-left:66.66666667%}.col-xs-offset-7{margin-left:58.33333333%}.col-xs-offset-6{margin-left:50%}.col-xs-offset-5{margin-left:41.66666667%}.col-xs-offset-4{margin-left:33.33333333%}.col-xs-offset-3{margin-left:25%}.col-xs-offset-2{margin-left:16.66666667%}.col-xs-offset-1{margin-left:8.33333333%}.col-xs-offset-0{margin-left:0}@media (min-width:768px){.col-sm-1,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9{float:left}.col-sm-12{width:100%}.col-sm-11{width:91.66666667%}.col-sm-10{width:83.33333333%}.col-sm-9{width:75%}.col-sm-8{width:66.66666667%}.col-sm-7{width:58.33333333%}.col-sm-6{width:50%}.col-sm-5{width:41.66666667%}.col-sm-4{width:33.33333333%}.col-sm-3{width:25%}.col-sm-2{width:16.66666667%}.col-sm-1{width:8.33333333%}.col-sm-pull-12{right:100%}.col-sm-pull-11{right:91.66666667%}.col-sm-pull-10{right:83.33333333%}.col-sm-pull-9{right:75%}.col-sm-pull-8{right:66.66666667%}.col-sm-pull-7{right:58.33333333%}.col-sm-pull-6{right:50%}.col-sm-pull-5{right:41.66666667%}.col-sm-pull-4{right:33.33333333%}.col-sm-pull-3{right:25%}.col-sm-pull-2{right:16.66666667%}.col-sm-pull-1{right:8.33333333%}.col-sm-pull-0{right:auto}.col-sm-push-12{left:100%}.col-sm-push-11{left:91.66666667%}.col-sm-push-10{left:83.33333333%}.col-sm-push-9{left:75%}.col-sm-push-8{left:66.66666667%}.col-sm-push-7{left:58.33333333%}.col-sm-push-6{left:50%}.col-sm-push-5{left:41.66666667%}.col-sm-push-4{left:33.33333333%}.col-sm-push-3{left:25%}.col-sm-push-2{left:16.66666667%}.col-sm-push-1{left:8.33333333%}.col-sm-push-0{left:auto}.col-sm-offset-12{margin-left:100%}.col-sm-offset-11{margin-left:91.66666667%}.col-sm-offset-10{margin-left:83.33333333%}.col-sm-offset-9{margin-left:75%}.col-sm-offset-8{margin-left:66.66666667%}.col-sm-offset-7{margin-left:58.33333333%}.col-sm-offset-6{margin-left:50%}.col-sm-offset-5{margin-left:41.66666667%}.col-sm-offset-4{margin-left:33.33333333%}.col-sm-offset-3{margin-left:25%}.col-sm-offset-2{margin-left:16.66666667%}.col-sm-offset-1{margin-left:8.33333333%}.col-sm-offset-0{margin-left:0}}@media (min-width:992px){.col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9{float:left}.col-md-12{width:100%}.col-md-11{width:91.66666667%}.col-md-10{width:83.33333333%}.col-md-9{width:75%}.col-md-8{width:66.66666667%}.col-md-7{width:58.33333333%}.col-md-6{width:50%}.col-md-5{width:41.66666667%}.col-md-4{width:33.33333333%}.col-md-3{width:25%}.col-md-2{width:16.66666667%}.col-md-1{width:8.33333333%}.col-md-pull-12{right:100%}.col-md-pull-11{right:91.66666667%}.col-md-pull-10{right:83.33333333%}.col-md-pull-9{right:75%}.col-md-pull-8{right:66.66666667%}.col-md-pull-7{right:58.33333333%}.col-md-pull-6{right:50%}.col-md-pull-5{right:41.66666667%}.col-md-pull-4{right:33.33333333%}.col-md-pull-3{right:25%}.col-md-pull-2{right:16.66666667%}.col-md-pull-1{right:8.33333333%}.col-md-pull-0{right:auto}.col-md-push-12{left:100%}.col-md-push-11{left:91.66666667%}.col-md-push-10{left:83.33333333%}.col-md-push-9{left:75%}.col-md-push-8{left:66.66666667%}.col-md-push-7{left:58.33333333%}.col-md-push-6{left:50%}.col-md-push-5{left:41.66666667%}.col-md-push-4{left:33.33333333%}.col-md-push-3{left:25%}.col-md-push-2{left:16.66666667%}.col-md-push-1{left:8.33333333%}.col-md-push-0{left:auto}.col-md-offset-12{margin-left:100%}.col-md-offset-11{margin-left:91.66666667%}.col-md-offset-10{margin-left:83.33333333%}.col-md-offset-9{margin-left:75%}.col-md-offset-8{margin-left:66.66666667%}.col-md-offset-7{margin-left:58.33333333%}.col-md-offset-6{margin-left:50%}.col-md-offset-5{margin-left:41.66666667%}.col-md-offset-4{margin-left:33.33333333%}.col-md-offset-3{margin-left:25%}.col-md-offset-2{margin-left:16.66666667%}.col-md-offset-1{margin-left:8.33333333%}.col-md-offset-0{margin-left:0}}@media (min-width:1200px){.col-lg-1,.col-lg-10,.col-lg-11,.col-lg-12,.col-lg-2,.col-lg-3,.col-lg-4,.col-lg-5,.col-lg-6,.col-lg-7,.col-lg-8,.col-lg-9{float:left}.col-lg-12{width:100%}.col-lg-11{width:91.66666667%}.col-lg-10{width:83.33333333%}.col-lg-9{width:75%}.col-lg-8{width:66.66666667%}.col-lg-7{width:58.33333333%}.col-lg-6{width:50%}.col-lg-5{width:41.66666667%}.col-lg-4{width:33.33333333%}.col-lg-3{width:25%}.col-lg-2{width:16.66666667%}.col-lg-1{width:8.33333333%}.col-lg-pull-12{right:100%}.col-lg-pull-11{right:91.66666667%}.col-lg-pull-10{right:83.33333333%}.col-lg-pull-9{right:75%}.col-lg-pull-8{right:66.66666667%}.col-lg-pull-7{right:58.33333333%}.col-lg-pull-6{right:50%}.col-lg-pull-5{right:41.66666667%}.col-lg-pull-4{right:33.33333333%}.col-lg-pull-3{right:25%}.col-lg-pull-2{right:16.66666667%}.col-lg-pull-1{right:8.33333333%}.col-lg-pull-0{right:auto}.col-lg-push-12{left:100%}.col-lg-push-11{left:91.66666667%}.col-lg-push-10{left:83.33333333%}.col-lg-push-9{left:75%}.col-lg-push-8{left:66.66666667%}.col-lg-push-7{left:58.33333333%}.col-lg-push-6{left:50%}.col-lg-push-5{left:41.66666667%}.col-lg-push-4{left:33.33333333%}.col-lg-push-3{left:25%}.col-lg-push-2{left:16.66666667%}.col-lg-push-1{left:8.33333333%}.col-lg-push-0{left:auto}.col-lg-offset-12{margin-left:100%}.col-lg-offset-11{margin-left:91.66666667%}.col-lg-offset-10{margin-left:83.33333333%}.col-lg-offset-9{margin-left:75%}.col-lg-offset-8{margin-left:66.66666667%}.col-lg-offset-7{margin-left:58.33333333%}.col-lg-offset-6{margin-left:50%}.col-lg-offset-5{margin-left:41.66666667%}.col-lg-offset-4{margin-left:33.33333333%}.col-lg-offset-3{margin-left:25%}.col-lg-offset-2{margin-left:16.66666667%}.col-lg-offset-1{margin-left:8.33333333%}.col-lg-offset-0{margin-left:0}}
 </style>
<body class="drawer drawer--right">
<header class="drawer-navbar barra_topo" role="banner">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
        <div class="container text-justify">
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
            <!--<div class='row'>
                <p>
                    TARC – Tarifa de Abertura e Renovação de Crédito
                </p>
            </div>
            <div class='row table-responsive'>
                <table class="table table-bordered" style="font-size: 12px !important;">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col" class="text-left">Normal</th>
                            <th scope="col"></th>
                            <th scope="col" class="text-left">Progressiva</th>
                            <th scope="col"></th>
                            <th scope="col" class="text-left">Parcial</th>
                            <th scope="col" class="text-left">X</th>
                            <th scope="col" class="text-left">Isenta</th>
                        </tr>
                    </thead>
                </table>
            </div>-->
            <div class='row'>
                <p>
                    Taxa de Deságio por Prazo (dias)
                </p>
            </div>
            <div class='row table-responsive'>
                <table class="table table-bordered" style="font-size: 12px !important;">
                    <thead>
                        <tr>
                            <th scope="col" class="text-left">Vencimento</th>
                            <th scope="col" class="text-left">Mensal</th>
                            <th scope="col" class="text-left">Anual</th>
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
            <!--<div class='row table-responsive'>
                <table class="table table-bordered" style="font-size: 12px !important;">
                    <thead>
                        <tr>
                            <th scope="col">Moeda</th>
                            <th scope="col">Real</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 12px !important;">
                        <tr>
                            <td>Tipo de documento</td>
                            <td>Boleto bancário</td>
                        </tr>
                    </tbody>
                </table>
            </div> -->
            <div class='row table-responsive'>
                <table class="table table-bordered" style="font-size: 12px !important;">
                    <thead>
                        <tr>
                            <th scope="col" class="text-left">Quantidade</th>
                            <th scope="col" class="text-left">
                                Valor total do borderô
                            </th>
                        </tr>
                    </thead>
                    <?php  
                    $valor_liberado = number_format($valor_liberado, 2, ',', '.');
                    $valor_total_devido = number_format($valor_total_devido, 2, ',', '.');
                    ?>
                    <tbody style="font-size: 12px !important;">
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
                            <th scope="col" class="text-left">Somatório de Vencimentos</th>
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
            </p>
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
                    @php $parcela = 1; @endphp
                    @foreach($parcelas as $parcela)
                        @foreach($parcela as $sc)
                            @php $parcela++;
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
                                    {{$sc->numero}}
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
                            <td>{{$solicitante->taxa_desagio * $qtd_parcelas}}</td>
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
                            <td>{{$solicitante->taxa_desagio}} %</td>
                            <td>{{$solicitante->taxa_desagio * $qtd_parcelas}} %</td>
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
        </div>
	</body>
</html>
