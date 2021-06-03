@extends('layouts.cliente.topo')
@section('content')
    <style>
        .div_fechamentos{
            box-shadow: 0px 0px 10px #ccc;
            padding: 20px;
            color: #fff;
        }   
        .color_wine{ color: #9f0200; }  
        .painel_titulo{
            font-size: 18px;
        }
        .painel_numero {
            font-size: 30px;
            font-weight: 500;
        }
        .pl_pr{
            padding-right: 0px;
            padding-left: 0px;      
        }
        .txt-periodo img {
            vertical-align: bottom;
        }
        .box_branco3{
            box-shadow: 0px 0px 10px #ccc;
            background-color: #fff;
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 7px;
            padding-bottom: 7px;
            max-width: 445px;
        }  
        .img_card_home {
            float: left;
            margin-left: -28px;
            
        }
        .block_content{
            background-position: left bottom; background-repeat: no-repeat; background-size: auto 100px; height: 150px;
        }
        .block_content_desagio{
            background-position: left bottom; background-repeat: no-repeat; background-size: auto 100px; height: 150px;
        }
    </style>
    
    <div class="container-fluid fluid-person pb60 padding_top_default">
        <div class="row mt20">
            <div class="col-md-4 mt20">
                <a href="{{route('cliente.solicitacoes.filtro','status=1')}}">
                    <div class="block_content" style="background-image: url('{{asset('images/solicitacoes_aprovadas_home_icn.png')}}');">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <h3 class="title_block_home_admin fonte_verde">SOLICITAÇÕES APROVADAS</h3>           
                            </div>
                            <div class="col-md-12 text-right">
                                <h3 class="number_block_home_admin fonte_verde fwn">{{$aprovadas}}</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mt20">
                <a href="{{route('cliente.solicitacoes.filtro','status=2')}}">
                    <div class="block_content" style="background-image: url('{{asset('images/solicitacoes_pendentes_home_icn.png')}}');">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <h3 class="title_block_home_admin fonte_amarela">SOLICITAÇÕES PENDENTES</h3>
                            </div>
                            <div class="col-md-12 text-right">
                                <h3 class="number_block_home_admin fonte_amarela fwn">{{$pendentes}}</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mt20">
                <a href="{{route('cliente.solicitacoes.filtro','status=3')}}">
                    <div class="block_content" style="background-image: url('{{asset('images/solicitacoes_recusadas_home_icn.png')}}');">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <h3 class="title_block_home_admin fonte_vermelha">SOLICITAÇÕES RECUSADAS</h3>
                            </div>
                            <div class="col-md-12 text-right">
                                <h3 class="number_block_home_admin fonte_vermelha fwn">{{$recusadas}}</h3>
                            </div>  
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mt20">
                <a href="{{route('cliente.solicitacoes.novo')}}">
                    <div class="block_content" style="background-image: url('{{asset('images/adicionar_solicitacao_bg_card_icn.png')}}');">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <h3 class="title_block_home_admin fonte_rosa">SOLICITAR ANTECIPAÇÃO</h3>
                            </div>
                            <div class="col-md-12 text-right">
                                <h3 class="number_block_home_admin fonte_vermelha fwn"></h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mt20">
                <div class="block_content" style="background-image: url('{{asset('images/total_antecipado_dashboard_icn.png')}}');">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <h3 class="title_block_home_admin fonte_verde">TOTAL ANTECIPADO</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <span class="valor_block_home_admin fonte_verde fwn">R$ {{$valor_aprovado}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="div-info-card">
                                <div class="info-title-card">
                                    <span class="status_block_home_admin fonte_amarela fwn">EM ANÁLISE</span>
                                </div>
                                <div class="info-number-card">
                                    <span class="status_block_home_admin fonte_amarela fwn">R$ {{$valor_analise}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="div-info-card" style="margin-top: -5px;">
                                <div class="info-title-card">
                                    <span class="status_block_home_admin fonte_vermelha fwn">RECUSADO</span>
                                </div>
                                <div class="info-number-card">
                                    <span class="status_block_home_admin fonte_vermelha fwn">R$ {{$valor_recusado}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt20">
                <div class="block_content" style="background-image: url('{{asset('images/limite_de_credito_dashboard_icn.png')}}');">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <h3 class="title_block_home_admin fonte_azul">LIMITE DE CRÉDITO</h3>
                        </div>
                        <div class="col-md-12 text-right">
                            <span class="valor_block_home_admin fonte_azul fwn">R$ {{$exibir_limite}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt20">
                <div class="block_content" style="background-image: url('{{asset('images/taxa_de_desagio_dashboard_icn.png')}}');">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <h3 class="title_block_home_admin fonte_azul">TAXA DE DESÁGIO</h3>
                        </div>
                        <div class="col-md-12 text-right">
                            <span class="valor_block_home_admin fonte_azul fwn">{{$exibir_taxa}}%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /container -->
@endsection
