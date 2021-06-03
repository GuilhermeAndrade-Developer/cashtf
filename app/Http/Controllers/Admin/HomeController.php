<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Clientes;
use App\Solicitacao;
use App\Solicitacao_Parcela;
use App\Charts\HomeChart;
use App\Boleto;
use DateTime;

class HomeController extends Controller
{
    public function index(){
        //Contador de Clientes
        $clientes['aprovados'] = count(User::select('users.*','cliente.*','cliente.tipo as tipo_cliente')
        ->leftJoin('cliente','cliente.id','users.id_cliente')
        ->where('users.id_cliente','!=','null')
        ->where('users.tipo','cliente')
        ->where('users.ativo','1')
        ->where('cliente.tipo','!=','null')
        ->orderBy('users.id_cliente','desc')
        ->get());
        $clientes['recusados'] = count(User::select('users.*','cliente.*','cliente.tipo as tipo_cliente')
        ->leftJoin('cliente','cliente.id','users.id_cliente')
        ->where('users.id_cliente','!=','null')
        ->where('users.tipo','cliente')
        ->where('users.ativo','2')
        ->where('cliente.tipo','!=','null')
        ->orderBy('users.id_cliente','desc')
        ->get());
        $clientes['pendentes'] = count(User::select('users.*','cliente.*','cliente.tipo as tipo_cliente')
        ->leftJoin('cliente','cliente.id','users.id_cliente')
        ->where('users.id_cliente','!=','null')
        ->where('users.tipo','cliente')
        ->where('users.ativo','0')
        ->where('cliente.tipo','!=','null')
        ->orderBy('users.id_cliente','desc')
        ->get());
        //Cliente::where('tipo','socioAdmin')->orWhere('tipo','procurador')->paginate($request->session()->get('paginate'));
        //Contador de Solicitações
        $solicitacoes['aprovados'] = count(Solicitacao::where('id_status','1')->orWhere('id_status','4')->orWhere('id_status','5')->orWhere('id_status','6')->get());
        $solicitacoes['pendentes'] = count(Solicitacao::where('id_status','2')->get());
        $solicitacoes['recusados'] = count(Solicitacao::where('id_status','3')->get());

        //Contador de Investidores
        $investidores['aprovados'] = count(User::where('ativo','1')->where('tipo','investidor')->get());
        $investidores['recusados'] = count(User::where('ativo','2')->where('tipo','investidor')->get());
        $investidores['pendentes'] = count(User::where('ativo','0')->where('tipo','investidor')->get());

        //Gerando relatório dos últimos 6 meses
        $dados = HomeController::report();
        $chart = $dados['chart'];
        //dd($chart);
        //Solicitações Pendentes
        $pendentes = count(Solicitacao::where('id_status', '2')->get());
        session()->put('pendentes', $pendentes);
        session(['paginate' => 10]);
        return view('admin/index',with(compact('clientes','investidores','solicitacoes','dados','chart')));
    }

    public function filter(Request $request){
         //Contador de Clientes
         $clientes['aprovados'] = count(User::where('ativo','1')->where('tipo','cliente')->get());
         $clientes['recusados'] = count(User::where('ativo','2')->where('tipo','cliente')->get());
         $clientes['pendentes'] = count(User::where('ativo','0')->where('tipo','cliente')->get());
 
         //Contador de Solicitações
         $solicitacoes['aprovados'] = count(Solicitacao::where('id_status','1')->get());
         $solicitacoes['pendentes'] = count(Solicitacao::where('id_status','2')->get());
         $solicitacoes['recusados'] = count(Solicitacao::where('id_status','3')->get());
 
         //Contador de Investidores
         $investidores['aprovados'] = count(User::where('ativo','1')->where('tipo','investidor')->get());
         $investidores['recusados'] = count(User::where('ativo','2')->where('tipo','investidor')->get());
         $investidores['pendentes'] = count(User::where('ativo','0')->where('tipo','investidor')->get());

        //Filtro de data
        $inicio = explode("/", $request->data_inicial);
        $fim    = explode("/", $request->data_final);
        $filtro['inicio'] = new DateTime();
        $filtro['inicio']->setDate($inicio[2], $inicio[1], $inicio[0]);
        $filtro['fim'] = new DateTime();
        $filtro['fim']->setDate($fim[2], $fim[1], $fim[0]);
        
        //Gerando relatório dos últimos 6 meses
        $dados = HomeController::report($filtro);
        $chart = $dados['chart'];
        //Solicitações Pendentes
        $pendentes = count(Solicitacao::where('id_status', '2')->get());
        return view('admin/index',with(compact('clientes','investidores','solicitacoes','dados','chart')));
    }

    function report($filtro = null){
        //Relatório de Ativos
        $totais     = 0;
        $pendentes  = 0;
        $pagos      = 0;
        $atrasados  = 0;

        $boletos = Boleto::select('boleto.*','solicitacao_parcela.*')->leftJoin('solicitacao_parcela','solicitacao_parcela.id','boleto.id_parcela')->get();

        foreach($boletos as $b){

            $total  = str_replace(".", "", $b->valor_parcela);
            $total  = str_replace(",", ".", $total);
            $totais  = $totais+$total;

            if($b->status == 'ENVIADO' || $b->status == 'REGISTRADO'){
                $total      = str_replace(".", "", $b->valor_parcela);
                $total      = str_replace(",", ".", $total);
                $pendentes  = $pendentes+$total;
            }
            else if($b->status == 'PAGO'){
                $total  = str_replace(".", "", $b->valor_parcela);
                $total  = str_replace(",", ".", $total);
                $pagos  = $pagos+$total;
            }
            else if($b->status == 'ATRASADO'){
                $total      = str_replace(".", "", $b->valor_parcela);
                $total      = str_replace(",", ".", $total);
                $atrasados  = $atrasados+$total;
            }
        }

        $ativos['pendentes']    = number_format($pendentes, 2, ',', '.');
        $ativos['pagos']        = number_format($pagos, 2, ',', '.');
        $ativos['atrasados']    = number_format($atrasados, 2, ',', '.');
        $ativos['totais']       = number_format($totais, 2, ',', '.');
        //Gerando dados para o gráfico basico
        if($filtro != null){
            $datas[0]    = $filtro['inicio']->format('F');
            $datas[1]    = $filtro['fim']->format('F');
            $datas_query[0]    = $filtro['inicio']->format('Y-m-d');
            $datas_query[1]    = $filtro['fim']->format('Y-m-d');
            $datas_query[2]    = $filtro['inicio']->format('Y-m-t');
            $datas_query[3]    = $filtro['fim']->format('Y-m-t');
            $count = 1;            
             
                $boletos = Boleto::select('boleto.*','solicitacao_parcela.*')->leftJoin('solicitacao_parcela','solicitacao_parcela.id','boleto.id_parcela')
                ->where('solicitacao_parcela.vencimento','>',$datas_query[0])
                ->where('solicitacao_parcela.vencimento','<',$datas_query[2])
                ->get();
                $pendentes  = 0;
                $pagos      = 0;
                $atrasados  = 0;
                
                foreach($boletos as $b){
                    if($b->status == 'ENVIADO' || $b->status == 'REGISTRADO'){
                        $total      = str_replace(".", "", $b->valor_parcela);
                        $total      = str_replace(",", ".", $total);
                        $pendentes  =  $pendentes+$total;
                    }
                    else if($b->status == 'PAGO'){
                        $total  = str_replace(".", "", $b->valor_parcela);
                        $total  = str_replace(",", ".", $total);
                        $pagos   = $pagos +$total;
                    }
                    else if($b->status == 'ATRASADO'){
                        $total      = str_replace(".", "", $b->valor_parcela);
                        $total      = str_replace(",", ".", $total);
                        $atrasados  = $atrasados+$total;
                    }
                }
    
                $valores['pagos'][]          = intval($pagos);
                $valores['pendentes'][]      = intval($pendentes);
                $valores['atrasados'][]      = intval($atrasados);
                
                $pendentes  = 0;
                $pagos      = 0;
                $atrasados  = 0;

                $boletos = Boleto::select('boleto.*','solicitacao_parcela.*')->leftJoin('solicitacao_parcela','solicitacao_parcela.id','boleto.id_parcela')
                ->where('solicitacao_parcela.vencimento','>',$datas_query[1])
                ->where('solicitacao_parcela.vencimento','<',$datas_query[3])
                ->get();
                
                foreach($boletos as $b){
                    if($b->status == 'ENVIADO' || $b->status == 'REGISTRADO'){
                        $total      = str_replace(".", "", $b->valor_parcela);
                        $total      = str_replace(",", ".", $total);
                        $pendentes  =  $pendentes+$total;
                    }
                    else if($b->status == 'PAGO'){
                        $total  = str_replace(".", "", $b->valor_parcela);
                        $total  = str_replace(",", ".", $total);
                        $pagos   = $pagos +$total;
                    }
                    else if($b->status == 'ATRASADO'){
                        $total      = str_replace(".", "", $b->valor_parcela);
                        $total      = str_replace(",", ".", $total);
                        $atrasados  = $atrasados+$total;
                    }
                }
                
                $valores['pagos'][]          = intval($pagos);
                $valores['pendentes'][]      = intval($pendentes);
                $valores['atrasados'][]      = intval($atrasados);
            
            $chart = [];
            
            $chart[] = ['"'.$datas[1].'"',$valores['pagos'][1],$valores['pendentes'][1],$valores['atrasados'][1]];
            $chart[] = ['"'.$datas[0].'"',$valores['pagos'][0],$valores['pendentes'][0],$valores['atrasados'][0]];
            
        }else{
            $meses              = [1,2,3,4,5];
            $datas[0]           = new DateTime;
            $datas[0]           = $datas[0]->format('F');
            $datas_query[0]     = new DateTime;
            $datas_query[0]     = $datas_query[0]->format('Y-m-d');
            foreach($meses as $c){
                $datas[$c]          = new DateTime('-'.$c.' months');
                $datas_query[$c]    = new DateTime('-'.$c.' months');
                $datas[$c]          = $datas[$c]->format('F');
                $datas_query[$c]    = $datas_query[$c]->format('Y-m-d');
            }

            $count = count($datas_query);

            foreach($datas_query as $key => $value){
                $boletos = Boleto::select('boleto.*','solicitacao_parcela.*')->leftJoin('solicitacao_parcela','solicitacao_parcela.id','boleto.id_parcela')
                ->where('solicitacao_parcela.vencimento','>=','%'.$value.'%')
                ->where('solicitacao_parcela.vencimento','<=','%'.$datas_query[$count-1].'%')
                ->get();
                foreach($boletos as $b){
                    if($b->status == 'ENVIADO' || $b->status == 'REGISTRADO'){
                        $total      = str_replace(".", "", $b->valor_parcela);
                        $total      = str_replace(",", ".", $total);
                        $pendentes  =  $pendentes+$total;
                    }
                    else if($b->status == 'PAGO'){
                        $total  = str_replace(".", "", $b->valor_parcela);
                        $total  = str_replace(",", ".", $total);
                        $pagos   = $pagos +$total;
                    }
                    else if($b->status == 'ATRASADO'){
                        $total      = str_replace(".", "", $b->valor_parcela);
                        $total      = str_replace(",", ".", $total);
                        $atrasados  = $atrasados+$total;
                    }
                }

                $valores['pagos'][]          = intval($pagos);
                $valores['pendentes'][]      = intval($pendentes);
                $valores['atrasados'][]      = intval($atrasados);

                $pendentes  = 0;
                $pagos      = 0;
                $atrasados  = 0;
            }
            
            $chart = [];
            foreach($datas as $key => $value){
                $chart[] = ['"'.$value.'"',$valores['pagos'][$key],$valores['pendentes'][$key],$valores['atrasados'][$key]];
            }
        }

        $chart = array_reverse($chart);
        //Lembrar de trocar as cores e a rota
        if(isset($filtro)){
            return with(['chart' => $chart,'ativos' => $ativos,'inicio' => $filtro['inicio'],'fim' => $filtro['fim']]);
        }
        return with(['chart' => $chart,'ativos' => $ativos]);
    }

}
