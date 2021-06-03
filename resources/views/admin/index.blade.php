@extends('layouts.admin.topo')
@section('content')
    <style>
        body {
            background-color: #F7F7F7 !important;
        }
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
    </style>
    <div class="container-fluid pt80 b_s_color">
        <form method="GET" action="{{route('admin.index.filter')}}" autocomplete="off" name="filter" id="filter">
            <div class="row">
                <div class="col-md-12 d_flex j_end p10">
                    <div class="period_filter b_white d_flex a_center j_start">
                        <i class="las la-calendar"></i>
                        <p>PERÍODO:</p>
                        <p>ÚLTIMO MÊS</p>
                        <input class="pickerdate" type="text" id="inicio" name="data_inicial" placeholder="00/00/0000" value="{{isset($_GET['data_inicial']) ? $_GET['data_inicial'] : ''}}" onchange="filtro()" required>
                        <p>A</p>
                        <input class="pickerdate" type="text" id="fim" name="data_final" placeholder="00/00/0000" value="{{isset($_GET['data_final']) ? $_GET['data_final'] : ''}}" onchange="filtro()" required>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container-fluid fluid-person pb60">
        <div class="row mt20">
            <div class="col-md-12 mt20 d_flex j_start">
                <a href="{{route('admin.clientes')}}" class="link_dash f_1">
                    <div class="block_content">
                        <div class="row">
                            <div class="col-md-12 mb10 text-right d_flex a_center j_start">
						        <i class="las la-briefcase icon_dash"></i>
                                <h3 class="title_dash">CLIENTES</h3>           
                            </div>
                            <div class="col-md-12 text-right d_flex a_start j_center f_column">
						        <p class="statistics m_green">
                                    APROVADOS
                                    <span>{{$clientes['aprovados']}}</span>
                                </p>         
						        <p class="statistics m_yellow">
                                    PENDENTES
                                    <span>{{$clientes['pendentes']}}</span>
                                </p>         
						        <p class="statistics m_red">
                                    RECUSADOS
                                    <span>{{$clientes['recusados']}}</span>
                                </p>         
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{route('admin.solicitacoes')}}" class="link_dash f_1">
                    <div class="block_content">
                        <div class="row">
                            <div class="col-md-12 mb10 text-right d_flex a_center j_start">
						        <i class="las la-list-alt icon_dash f_color"></i>
                                <h3 class="title_dash f_color">BORDERÔS</h3>           
                            </div>
                            <div class="col-md-12 text-right d_flex a_start j_center f_column">
						        <p class="statistics m_green">
                                    APROVADOS
                                    <span>{{$solicitacoes['aprovados']}}</span>
                                </p>         
						        <p class="statistics m_yellow">
                                    PENDENTES
                                    <span>{{$solicitacoes['pendentes']}}</span>
                                </p>         
						        <p class="statistics m_red">
                                    RECUSADOS
                                    <span>{{$solicitacoes['recusados']}}</span>
                                </p>         
                            </div>
                        </div>
                    </div>
                </a>
                <!--<a href="" class="link_dash f_1">
                    <div class="block_content">
                        <div class="row">
                            <div class="col-md-12 mb10 text-right d_flex a_center j_start">
						        <i class="las la-user-tie icon_dash t_color"></i>
                                <h3 class="title_dash t_color">INVESTIDORES</h3>           
                            </div>
                            <div class="col-md-12 text-right d_flex a_start j_center f_column">
						        <p class="statistics m_green">
                                    APROVADOS
                                    <span>0</span>
                                </p>         
						        <p class="statistics m_yellow">
                                    PENDENTES
                                    <span>0</span>
                                </p>         
						        <p class="statistics m_red">
                                    RECUSADOS
                                    <span>0</span>
                                </p>         
                            </div>
                        </div>
                    </div>
                </a>-->
                <div class="f_1"></div>
                <div class="f_1"></div>
            </div>
        </div>
        <div class="row mt20">
            <div class="col-md-12 mt20 d_flex j_start">
                <div class="block_grafic f_1">
                    <div class="row">
                        <div class="col-md-12 d_flex j_start mt30">
                            <p class="semi_bold spotlight">
                                ATIVOS TRANSACIONADOS ATÉ A DATA<br>
                                <span class="b_s_dark_color">R$ {{$dados['ativos']['totais']}}</span>
                            </p>         
                            <p class="semi_bold m_green">
                                VALOR OPERADO<br>
                                <span>(no período)<br></span>
                                <span class="bold qty">R$ {{$dados['ativos']['pagos']}}</span>
                            <p class="semi_bold m_yellow">
                                VALOR A RECEBER<br>
                                <span>(no período)<br></span>
                                <span class="bold qty">R$ {{$dados['ativos']['pendentes']}}<br></span>
                            <p class="semi_bold m_red">
                                VALOR EM ATRASO<br>
                                <span>(no período)<br></span>
                                <span class="bold qty">R$ {{$dados['ativos']['atrasados']}}<br></span>
                            </p>                
                        </div>
                        <div class="col-md-12 text-right d_flex">
                            <div id="chart_div" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
function filtro(){
    var inicio = document.getElementById('inicio').value;
    var fim = document.getElementById('fim').value;
    console.log(inicio,fim);
    if(inicio !== "" && fim !== ""){
        document.filter.submit();
    }else{
        return false;
    }
 }
</script>
@endsection