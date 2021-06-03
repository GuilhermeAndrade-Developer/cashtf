<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Solicitacao;
use App\Status;
use App\Cliente_Conta;
use App\Cliente;
use App\Enderecos;
use App\Boleto;
use App\Solicitacao_Parcela;
use App\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Str;
use PDF;
use Storage;

class BorderoController extends Controller
{
    public function index(Request $request){
        $borderos = Solicitacao::select('solicitacao.*','cliente.Name','cliente.OfficialName')
        ->leftJoin('cliente','cliente.id','solicitacao.id_sacado')
        //->where('solicitacao.id','=',$id)
        ->orderBy('solicitacao.nro_bordero','desc')
        ->get();

        $dropdown = $borderos = Solicitacao::select('solicitacao.*','cliente.Name','cliente.OfficialName','solicitacao_parcela.numero')
        ->leftJoin('cliente','cliente.id','solicitacao.id_sacado')
        ->leftJoin('solicitacao_parcela','solicitacao_parcela.id_solicitacao','solicitacao.id')
        ->orderBy('solicitacao.nro_bordero','desc')
        ->get();

        $cliente = Cliente::where('id',$borderos[0]->id_solicitante)->first();
        foreach($borderos as $b){
            $b->data_gerado = BorderoController::FormataData($b->data_gerado);
            $valor_total  = str_replace(".", "", $b->valor_total);
            $valor_total  = str_replace(",", ".", $valor_total);
            $valor_total_juros  = str_replace(".", "", $b->valor_total_juros);
            $valor_total_juros  = str_replace(",", ".", $valor_total_juros);
            $taxa_bordero  = str_replace(".", "", $cliente->tarifa_bordero);
            $taxa_bordero  = str_replace(",", ".", $taxa_bordero);
            $subtracao  = (floatval($valor_total)-floatval($valor_total_juros))-floatval($taxa_bordero);
            $b->desagio  = number_format($subtracao, 2, ',', '.');
        } 
        $array = [];
        foreach($borderos as $b){
            if(empty($array) || !array_key_exists($b->nro_bordero, $array)){
                $array[$b->nro_bordero]['id']   = $b->id;
                $array[$b->nro_bordero]['nro_bordero']   = $b->nro_bordero;
                $array[$b->nro_bordero]['Name'] = isset($b->OfficialName) ? $b->OfficialName : $b->Name;
                $array[$b->nro_bordero]['data_gerado'] = $b->data_gerado;
                $array[$b->nro_bordero]['valor_total'] = $b->valor_total;
                $array[$b->nro_bordero]['desagio'] = $b->desagio;
                $array[$b->nro_bordero]['tac'] = $b->tac;
                $array[$b->nro_bordero]['juros'] = $b->juros;
                $array[$b->nro_bordero]['valor_total_juros'] = $b->valor_total_juros;
                $array[$b->nro_bordero]['valor_total_juros'] = $b->valor_total_juros;
                $array[$b->nro_bordero]['id_status'] = $b->id_status;
                
            }else{
                $array[$b->nro_bordero]['id']   = $b->id.','.$array[$b->nro_bordero]['id'];
                $array[$b->nro_bordero]['nro_bordero']   = $b->nro_bordero;
                $array[$b->nro_bordero]['Name'] = isset($b->OfficialName) ? $b->OfficialName.','.$array[$b->nro_bordero]['Name'] : $b->Name.','.$array[$b->nro_bordero]['Name'];
                $array[$b->nro_bordero]['Name'] = substr($array[$b->nro_bordero]['Name'],0,25).'...';
                $array[$b->nro_bordero]['data_gerado'] = $b->data_gerado;
                //Soma de valores
                $valor_total1  = str_replace(".", "", $array[$b->nro_bordero]['valor_total']);
                $valor_total1  = str_replace(",", ".", $valor_total1);
                $valor_total2  = str_replace(".", "", $b->valor_total);
                $valor_total2  = str_replace(",", ".", $valor_total2);
                $array[$b->nro_bordero]['valor_total'] = ($valor_total1+$valor_total2);
                $array[$b->nro_bordero]['valor_total'] = number_format($array[$b->nro_bordero]['valor_total'], 2, ',', '.');
                //Soma de deságios
                $valor_total1  = str_replace(".", "", $array[$b->nro_bordero]['desagio']);
                $valor_total1  = str_replace(",", ".", $valor_total1);
                $valor_total2  = str_replace(".", "", $b->desagio);
                $valor_total2  = str_replace(",", ".", $valor_total2);
                $array[$b->nro_bordero]['desagio'] = ($valor_total1+$valor_total2);
                $array[$b->nro_bordero]['desagio'] = number_format($array[$b->nro_bordero]['desagio'], 2, ',', '.');
                $valor_total1  = str_replace(".", "", $array[$b->nro_bordero]['tac']);
                $valor_total1  = str_replace(",", ".", $valor_total1);
                $valor_total2  = str_replace(".", "", $b->tac);
                $valor_total2  = str_replace(",", ".", $valor_total2);
                $array[$b->nro_bordero]['tac'] = ($valor_total1+$valor_total2);
                $array[$b->nro_bordero]['tac'] = number_format($array[$b->nro_bordero]['tac'], 2, ',', '.');
                $array[$b->nro_bordero]['juros'] = $b->juros;
                $valor_total1  = str_replace(".", "", $array[$b->nro_bordero]['valor_total_juros']);
                $valor_total1  = str_replace(",", ".", $valor_total1);
                $valor_total2  = str_replace(".", "", $b->valor_total_juros);
                $valor_total2  = str_replace(",", ".", $valor_total2);
                $array[$b->nro_bordero]['valor_total_juros'] = ($valor_total1+$valor_total2);
                $array[$b->nro_bordero]['valor_total_juros'] = number_format($array[$b->nro_bordero]['valor_total_juros'], 2, ',', '.');
                $array[$b->nro_bordero]['id_status'] = $b->id_status;
            }
        }
        $array = collect($array);
        //$borderos = $this->paginate($array,$request->session()->get('paginate'));
        $borderos = $this->paginate($array,10);
        $borderos->setPath($request->url());
        return view('admin/solicitacoes')->with(compact('borderos','array','dropdown'));
    }

    public function filter(Request $request){
        $procure    = $request->input('procure');
        $paginas    = $request->input('paginas');
        if(isset($cliente)){
            $cliente = Cliente::where('id',$borderos[0]->id_solicitante)->first();
        }
        if(isset($paginas)){
            $request->session()->pull('key', 'default');
            session(['paginate' => $paginas]);
        }
        if(isset($procure)){
            $borderos = Solicitacao::select('solicitacao.*','cliente.Name','cliente.OfficialName')
            ->leftJoin('cliente','cliente.id','solicitacao.id_sacado')
            ->where('solicitacao.nro_bordero','=',$procure)
            ->orderBy('solicitacao.nro_bordero','desc')
            ->get();
            foreach($borderos as $b){
                $cliente = Cliente::where('id',$b->id_solicitante)->first();
                $b->data_gerado = BorderoController::FormataData($b->data_gerado);
                $valor_total  = str_replace(".", "", $b->valor_total);
                $valor_total  = str_replace(",", ".", $valor_total);
                $valor_total_juros  = str_replace(".", "", $b->valor_total_juros);
                $valor_total_juros  = str_replace(",", ".", $valor_total_juros);
                $taxa_bordero  = str_replace(".", "", $cliente->tarifa_bordero);
                $taxa_bordero  = str_replace(",", ".", $taxa_bordero);
                $subtracao  = ($valor_total-$valor_total_juros)-$taxa_bordero;
                $b->desagio  = number_format($subtracao, 2, ',', '.');
            }
            $array = [];

            foreach($borderos as $b){
                if(empty($array) || !array_key_exists($b->nro_bordero, $array)){
                    $array[$b->nro_bordero]['id']   = $b->id;
                    $array[$b->nro_bordero]['nro_bordero']   = $b->nro_bordero;
                    $array[$b->nro_bordero]['Name'] = isset($b->OfficialName) ? $b->OfficialName : $b->Name;
                    $array[$b->nro_bordero]['data_gerado'] = $b->data_gerado;
                    $array[$b->nro_bordero]['valor_total'] = $b->valor_total;
                    $array[$b->nro_bordero]['desagio'] = $b->desagio;
                    $array[$b->nro_bordero]['tac'] = $b->tac;
                    $array[$b->nro_bordero]['juros'] = $b->juros;
                    $array[$b->nro_bordero]['valor_total_juros'] = $b->valor_total_juros;
                    $array[$b->nro_bordero]['valor_total_juros'] = $b->valor_total_juros;
                    $array[$b->nro_bordero]['id_status'] = $b->id_status;
                    
                }else{
                    $array[$b->nro_bordero]['id']   = $b->id.','.$array[$b->nro_bordero]['id'];
                    $array[$b->nro_bordero]['nro_bordero']   = $b->nro_bordero;
                    $array[$b->nro_bordero]['Name'] = isset($b->OfficialName) ? $b->OfficialName.','.$array[$b->nro_bordero]['Name'] : $b->Name.','.$array[$b->nro_bordero]['Name'];
                    $array[$b->nro_bordero]['Name'] = substr($array[$b->nro_bordero]['Name'],0,25).'...';
                    $array[$b->nro_bordero]['data_gerado'] = $b->data_gerado;
                    //Soma de valores
                    $valor_total1  = str_replace(".", "", $array[$b->nro_bordero]['valor_total']);
                    $valor_total1  = str_replace(",", ".", $valor_total1);
                    $valor_total2  = str_replace(".", "", $b->valor_total);
                    $valor_total2  = str_replace(",", ".", $valor_total2);
                    $array[$b->nro_bordero]['valor_total'] = ($valor_total1+$valor_total2);
                    $array[$b->nro_bordero]['valor_total'] = number_format($array[$b->nro_bordero]['valor_total'], 2, ',', '.');
                    //Soma de deságios
                    $valor_total1  = str_replace(".", "", $array[$b->nro_bordero]['desagio']);
                    $valor_total1  = str_replace(",", ".", $valor_total1);
                    $valor_total2  = str_replace(".", "", $b->desagio);
                    $valor_total2  = str_replace(",", ".", $valor_total2);
                    $array[$b->nro_bordero]['desagio'] = ($valor_total1+$valor_total2);
                    $array[$b->nro_bordero]['desagio'] = number_format($array[$b->nro_bordero]['desagio'], 2, ',', '.');
                    $valor_total1  = str_replace(".", "", $array[$b->nro_bordero]['tac']);
                    $valor_total1  = str_replace(",", ".", $valor_total1);
                    $valor_total2  = str_replace(".", "", $b->tac);
                    $valor_total2  = str_replace(",", ".", $valor_total2);
                    $array[$b->nro_bordero]['tac'] = ($valor_total1+$valor_total2);
                    $array[$b->nro_bordero]['tac'] = number_format($array[$b->nro_bordero]['tac'], 2, ',', '.');
                    $array[$b->nro_bordero]['juros'] = $b->juros;
                    $valor_total1  = str_replace(".", "", $array[$b->nro_bordero]['valor_total_juros']);
                    $valor_total1  = str_replace(",", ".", $valor_total1);
                    $valor_total2  = str_replace(".", "", $b->valor_total_juros);
                    $valor_total2  = str_replace(",", ".", $valor_total2);
                    $array[$b->nro_bordero]['valor_total_juros'] = ($valor_total1+$valor_total2);
                    $array[$b->nro_bordero]['valor_total_juros'] = number_format($array[$b->nro_bordero]['valor_total_juros'], 2, ',', '.');
                    $array[$b->nro_bordero]['id_status'] = $b->id_status;
                }
            }
            $array = collect($array);
            $borderos = $this->paginate($array,$request->session()->get('paginate'));
            $borderos->setPath($request->url());
        }else{
            $borderos = Solicitacao::select('solicitacao.*','cliente.Name','cliente.OfficialName')
            ->leftJoin('cliente','cliente.id','solicitacao.id_sacado')
            ->orderBy('solicitacao.nro_bordero','desc')
            ->get();
            foreach($borderos as $b){
                $cliente = Cliente::where('id',$b->id_solicitante)->first();
                $b->data_gerado = BorderoController::FormataData($b->data_gerado);
                $valor_total  = str_replace(".", "", $b->valor_total);
                $valor_total  = str_replace(",", ".", $valor_total);
                $valor_total_juros  = str_replace(".", "", $b->valor_total_juros);
                $valor_total_juros  = str_replace(",", ".", $valor_total_juros);
                $taxa_bordero  = str_replace(".", "", $cliente->tarifa_bordero);
                $taxa_bordero  = str_replace(",", ".", $taxa_bordero);
                $subtracao  = (floatval($valor_total)-floatval($valor_total_juros))-floatval($taxa_bordero);
                $b->desagio  = number_format($subtracao, 2, ',', '.');
            }
            $array = [];
            foreach($borderos as $b){
                if(empty($array) || !array_key_exists($b->nro_bordero, $array)){
                    $array[$b->nro_bordero]['id']   = $b->id;
                    $array[$b->nro_bordero]['nro_bordero']   = $b->nro_bordero;
                    $array[$b->nro_bordero]['Name'] = isset($b->OfficialName) ? $b->OfficialName : $b->Name;
                    $array[$b->nro_bordero]['data_gerado'] = $b->data_gerado;
                    $array[$b->nro_bordero]['valor_total'] = $b->valor_total;
                    $array[$b->nro_bordero]['desagio'] = $b->desagio;
                    $array[$b->nro_bordero]['tac'] = $b->tac;
                    $array[$b->nro_bordero]['juros'] = $b->juros;
                    $array[$b->nro_bordero]['valor_total_juros'] = $b->valor_total_juros;
                    $array[$b->nro_bordero]['valor_total_juros'] = $b->valor_total_juros;
                    $array[$b->nro_bordero]['id_status'] = $b->id_status;
                    
                }else{
                    $array[$b->nro_bordero]['id']   = $b->id.','.$array[$b->nro_bordero]['id'];
                    $array[$b->nro_bordero]['nro_bordero']   = $b->nro_bordero;
                    $array[$b->nro_bordero]['Name'] = isset($b->OfficialName) ? $b->OfficialName.','.$array[$b->nro_bordero]['Name'] : $b->Name.','.$array[$b->nro_bordero]['Name'];
                    $array[$b->nro_bordero]['Name'] = substr($array[$b->nro_bordero]['Name'],0,25).'...';
                    $array[$b->nro_bordero]['data_gerado'] = $b->data_gerado;
                    //Soma de valores
                    $valor_total1  = str_replace(".", "", $array[$b->nro_bordero]['valor_total']);
                    $valor_total1  = str_replace(",", ".", $valor_total1);
                    $valor_total2  = str_replace(".", "", $b->valor_total);
                    $valor_total2  = str_replace(",", ".", $valor_total2);
                    $array[$b->nro_bordero]['valor_total'] = ($valor_total1+$valor_total2);
                    $array[$b->nro_bordero]['valor_total'] = number_format($array[$b->nro_bordero]['valor_total'], 2, ',', '.');
                    //Soma de deságios
                    $valor_total1  = str_replace(".", "", $array[$b->nro_bordero]['desagio']);
                    $valor_total1  = str_replace(",", ".", $valor_total1);
                    $valor_total2  = str_replace(".", "", $b->desagio);
                    $valor_total2  = str_replace(",", ".", $valor_total2);
                    $array[$b->nro_bordero]['desagio'] = ($valor_total1+$valor_total2);
                    $array[$b->nro_bordero]['desagio'] = number_format($array[$b->nro_bordero]['desagio'], 2, ',', '.');
                    $valor_total1  = str_replace(".", "", $array[$b->nro_bordero]['tac']);
                    $valor_total1  = str_replace(",", ".", $valor_total1);
                    $valor_total2  = str_replace(".", "", $b->tac);
                    $valor_total2  = str_replace(",", ".", $valor_total2);
                    $array[$b->nro_bordero]['tac'] = ($valor_total1+$valor_total2);
                    $array[$b->nro_bordero]['tac'] = number_format($array[$b->nro_bordero]['tac'], 2, ',', '.');
                    $array[$b->nro_bordero]['juros'] = $b->juros;
                    $valor_total1  = str_replace(".", "", $array[$b->nro_bordero]['valor_total_juros']);
                    $valor_total1  = str_replace(",", ".", $valor_total1);
                    $valor_total2  = str_replace(".", "", $b->valor_total_juros);
                    $valor_total2  = str_replace(",", ".", $valor_total2);
                    $array[$b->nro_bordero]['valor_total_juros'] = ($valor_total1+$valor_total2);
                    $array[$b->nro_bordero]['valor_total_juros'] = number_format($array[$b->nro_bordero]['valor_total_juros'], 2, ',', '.');
                    $array[$b->nro_bordero]['id_status'] = $b->id_status;
                }
            }
            $array = collect($array);
            $borderos = $this->paginate($array,$request->session()->get('paginate'));
            $borderos->setPath($request->url());
        }
         
        return view('admin/solicitacoes')->with(compact('borderos','paginas','procure'));
    }

    public function delete($id){
        Solicitacao::where('id',$id)->delete();
        return redirect()->back();
    }

    public function bordero($id){
        $bordero = Solicitacao::select('solicitacao.*','cliente.Name as nome_sacador','cliente.limite_credito as credito',
        'cliente.OfficialName as nome_empresa_sacador')
        ->leftJoin('cliente','cliente.id','solicitacao.id_solicitante')
        ->where('solicitacao.nro_bordero','=',$id)
        ->get();

        //trocar id por nro bordero

        foreach($bordero as $b){
            $b->conta       = Cliente_Conta::where('id',$b->id_cliente_conta)->first();
            $b->sacado      = Cliente::where('id','=',$b->id_sacado)->first();
            $b->solicitante = Cliente::where('id','=',$b->id_solicitante)->first();

            //formatatelefone
            if(isset($b->sacado->telefone)){
                $b->sacado->telefone = preg_replace("/\D/", '', $b->sacado->telefone);
                $b->sacado->telefone = "(".substr($b->sacado->telefone,0,2).") ".substr($b->sacado->telefone,2,-4)." - ".substr($b->sacado->telefone,-4);
            }

            //formatacnpj
            if(isset($b->sacado->cnpj)){
                $b->sacado->cnpj = preg_replace("/\D/", '', $b->sacado->cnpj);
                $b->sacado->cnpj = preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5",$b->sacado->cnpj);
            }

            //formatacpf
            if(isset($b->sacado->cpf)){
                $b->sacado->cpf = preg_replace("/\D/", '', $b->sacado->cpf);
                $b->sacado->cpf = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $b->sacado->cpf);
            }
    
            $endereco_sacado_fisica   = Enderecos::where('id_cliente','=',$b->id_sacado)->where('id_socio','=',null)->where('tipo','=',"fisica")->first();
            if(isset($endereco_sacado_fisica)){
                //formatacep
                $endereco_sacado_fisica->Endereco_CEP = preg_replace("/\D/", '', $endereco_sacado_fisica->Endereco_CEP);
                $endereco_sacado_fisica->Endereco_CEP = preg_replace("/(\d{5})(\d{3})/", "\$1-\$2", $endereco_sacado_fisica->Endereco_CEP);
            }
            //Endereco do Sacado/Juridico
            $endereco_sacado_juridica = Enderecos::where('id_cliente','=',$b->id_sacado)->where('id_socio','=',null)->where('tipo','=',"juridica")->first();
            if(isset($endereco_sacado_juridica)){
                //formatacep
                $endereco_sacado_juridica->Endereco_CEP = preg_replace("/\D/", '', $endereco_sacado_juridica->Endereco_CEP);
                $endereco_sacado_juridica->Endereco_CEP = preg_replace("/(\d{5})(\d{3})/", "\$1-\$2", $endereco_sacado_juridica->Endereco_CEP);
            }

            $b->parcelas       = Solicitacao_Parcela::where('id_solicitacao','=',$b->id)->get();
            $tac  = str_replace(".", "", $b->tac);
            $tac  = str_replace(",", ".", $tac);
            
            $counttac = $tac/count($b->parcelas);
            foreach($b->parcelas as $p){
                $p['vencimento'] = BorderoController::FormataData($p['vencimento']);
                $valor_total  = str_replace(".", "", $p['valor_parcela']);
                $valor_total  = str_replace(",", ".", $valor_total);
                $valor_total_juros  = str_replace(".", "", $p['valor_juros']);
                $valor_total_juros  = str_replace(",", ".", $valor_total_juros);
                $taxa_bordero  = str_replace(".", "", $b->solicitante->tarifa_bordero);
                $taxa_bordero  = str_replace(",", ".", $taxa_bordero);
                if(empty($taxa_bordero)){
                    $taxa_bordero = 0;
                }
                $subtracao  = ($valor_total-$valor_total_juros)-$taxa_bordero;
                $p['tac']   = number_format($taxa_bordero, 2, ',', '.');
                $p['desagio']  = number_format($subtracao, 2, ',', '.');
            }

            $b->id_nota_reduzida = Str::limit($b->id_nota, 5);
        }

        if($endereco_sacado_fisica == null){
            $endereco = $endereco_sacado_juridica;
        }else if($endereco_sacado_juridica == null){
            $endereco = $endereco_sacado_fisica;
        }else{
            $endereco = null;
        }
        $status = Status::all();
        $nro_bordero = $bordero[0]->nro_bordero;
        
        return view('admin/cliente/bordero')->with(compact('bordero','endereco','status','nro_bordero'));
    }

    public function updateStatus(Request $request,$id){
        if(isset($request->status)){
            Solicitacao::where('id','=',$id)->update(['solicitacao.id_status' => $request->status]);
            $email              = Cliente::select('email')->where('id','=',$request->solicitante)->first();
            $solicitacao        = Solicitacao::where('id','=',$id)->get();
            $nome_sacador       = $solicitacao[0]['nome'];
            $empresa_sacador    = $solicitacao[0]['nome_empresa_sacador'];
            $cpf_sacador        = $solicitacao[0]['cpf'];
            $email_sacador      = User::where('id_cliente','=',$request->solicitante)->first();
            $nascimento_sacador = $solicitacao[0]['data_nascimento'];
            //dd($request->input());
            //Corrigido
            //Dados CashTF
            $empresa_default    = 'Zamprogna Securitizadora S/A';
            $cnpj_default       = '35.262.759/0001-27';
            $email_default      = 'business@cashtf.com';
            //dd($cpf_sacador);
            $solicitacao[0]->data_gerado = SolicitacaoController::FormataData($solicitacao[0]->data_gerado);
            
            //Data Limite
            $data_limite = date('Y-m-d', strtotime('+ 89days'));


            //Gerar PDF e ClickSign
            //$solicitacao            = Solicitacao::where('id','=',$id)->get();
            $solicitante            = Cliente::where('id','=',$solicitacao[0]->id_solicitante)->get();
            $sacado                 = Cliente::where('id','=',$solicitacao[0]->id_sacado)->get();
            $solicitacoes_contas    = Solicitacao_Parcela::join('solicitacao','solicitacao.id','solicitacao_parcela.id_solicitacao')  
                ->join('cliente','cliente.id','solicitacao.id_sacado')
                ->where('id_solicitacao','=',$id)->get();
            $conta                  = Cliente_Conta::where('id_cliente','=',$solicitacao[0]->id_sacado)->get();
            $solicitacoes           = Solicitacao_Parcela::where('id_solicitacao','=',$id)->get();
            
            $valor_total_devido     = 0;
            $valor_liberado         = 0;
            $percent_total          = 0;
            $qtd_parcelas           = 0;

            foreach($solicitacoes as $s){
                $valTotal_formated  = str_replace(".", "", $s->valor_parcela);
                $valTotal_formated  = str_replace("", "", $valTotal_formated);
                $valorTotal_juros   = str_replace(".", "", $s->valor_juros);
                $valorTotal_juros   = str_replace("", "", $valorTotal_juros);
                (float)$valor_total_devido = (float)$valor_total_devido + (((float)$valTotal_formated - (float)$valorTotal_juros) + (float)$valTotal_formated);;
                //$valor_total_devido = 1;
                (float)$valor_liberado     = (float)$valor_liberado + (float)$valorTotal_juros;
                //$valor_liberado     = 1;
                $qtd_parcelas++;
            }

            $data = (['name' => $solicitante[0]->Name]);
            //dd($solicitante[0]);
            switch($request->status){
                case 1:
                    Mail::to($email_sacador->email)->send(new Aprovado($data));
                    break;
                case 2:
                    Mail::to($email_sacador->email)->send(new Analise($data)); 
                    break;
                case 3:
                    Mail::to($email_sacador->email)->send(new Recusado($data));
                    break; 
            }
        }

        return redirect()->back();
    }

    public function sendContract(Request $request,$id){
            $bordero = Solicitacao::select('solicitacao.*','cliente.Name as nome_sacador','cliente.limite_credito as credito',
            'cliente.OfficialName as nome_empresa_sacador')
            ->leftJoin('cliente','cliente.id','solicitacao.id_solicitante')
            ->where('solicitacao.nro_bordero','=',$id)
            ->where('solicitacao.id_status','=','1')
            ->get();
            
            $solicitante        = Cliente::where('id','=',$bordero[0]->id_solicitante)->first();
            //Dados CashTF
            $empresa_default    = 'Zamprogna Securitizadora S/A';
            $cnpj_default       = '35.262.759/0001-27';
            $email_default      = 'business@cashtf.com';
            $sacado             = [];
            foreach($bordero as $b){
                $b->data_gerado = BorderoController::FormataData($b->data_gerado);
                $sacado[]       = Cliente::where('id',$b->id_sacado)->first();
                $parcelas[]       = Solicitacao_Parcela::join('solicitacao','solicitacao.id','solicitacao_parcela.id_solicitacao','cliente.*')  
                ->join('cliente','cliente.id','solicitacao.id_sacado')
                ->where('id_solicitacao','=',$b->id)->get();

            }
            //Data Limite
            $data_limite = date('Y-m-d', strtotime('+ 89days'));
            //Gerar PDF e ClickSign            
            $valor_total_devido     = 0;
            $valor_liberado         = 0;
            $percent_total          = 0;
            $qtd_parcelas           = 0;
        
            foreach($parcelas as $parc){
                foreach($parc as $s){
                    $valTotal_formated  = str_replace(".", "", $s->valor_parcela);
                    $valTotal_formated  = str_replace("", "", $valTotal_formated);
                    $valorTotal_juros   = str_replace(".", "", $s->valor_juros);
                    $valorTotal_juros   = str_replace("", "", $valorTotal_juros);
                    (float)$valor_total_devido = (float)$valor_total_devido + (((float)$valTotal_formated - (float)$valorTotal_juros) + (float)$valTotal_formated);;
                    //$valor_total_devido = 1;
                    (float)$valor_liberado     = (float)$valor_liberado + (float)$valorTotal_juros;
                    //$valor_liberado     = 1;
                    $qtd_parcelas++;
                }  
            }
            $porc_final = $valor_liberado*100/$valor_total_devido;
            $diff_valor = $valor_total_devido-$valor_liberado;
            $porc_restante = 100-$porc_final;
            $diff_valor = number_format($diff_valor, 2, ',', '.');
            
            //Gera o PDF
            $nome_arquivo           = 'bordero'.date('Ymdhis').'.pdf';
            $nome_caminho           = storage_path('app/public/pdfs/'.$nome_arquivo);

            $pdf                    = PDF::loadView('admin/imprimir_bordero',compact(
                'bordero','solicitante',
                'sacado','parcelas',
                'valor_total_devido','valor_liberado',
                'percent_total','qtd_parcelas','id','porc_restante','porc_final','diff_valor',
            )); 
            Storage::put('public/pdfs/'.$nome_arquivo, $pdf->output());
            $b64Doc = chunk_split(base64_encode(file_get_contents($nome_caminho)));

            $jayParsedAry = [
                "document" => [
                    "path" => "/".$nome_arquivo, 
                    "content_base64" => 'data:application/pdf;base64,'.$b64Doc,
                    "deadline_at" => $data_limite."T14:30:59-03:00", 
                    "auto_close" => true, 
                    "locale" => "pt-BR", 
                    "signers" => [
                        [   
                            // Trocar email para o email do Rodrigo
                            // $email_default
                            "email" => $email_default, 
                            "company_name" => $empresa_default,
                            "sign_as" => "sign", 
                            "auths" => [
                                "email" 
                            ], 
                            "name" => $empresa_default, 
                            //"documentation" => $cnpj_default, 
                            //"birthday" => "1983-03-31", 
                            "has_documentation" => true, 
                            "send_email" => true, 
                            "message" => "Segue o documento para formalização da antecipação, por favor assine o documento. Dentro de alguns minutos o crédito entrará na conta indicada.",
                            "skip_documentation" => true
                        ],
                        [
                            "email" => $solicitante->email, 
                            "sign_as" => "sign", 
                            "auths" => [
                                "email" 
                            ], 
                            "company_name" => $solicitante->OfficialName,
                            "name" => $solicitante->Name, 
                            "documentation" => $solicitante->cpf, 
                            //"birthday" => ReformataData($nascimento_sacador), 
                            "has_documentation" => true, 
                            "send_email" => true, 
                            "message" => "Segue o documento para formalização da antecipação, por favor assine o documento. Dentro de alguns minutos o crédito entrará na conta indicada." 
                        ]
                    ] 
                ] 
            ];    

            // SANDBOX
            //$TOKEN              = '73b72bff-b595-40dc-ad41-b39c7a516309';
            //$URL_DEFAULT        = 'https://sandbox.clicksign.com/';

            // PROD
            $TOKEN              = 'd8de5e6b-4300-4867-82f5-31e034907823';
            $URL_DEFAULT        = 'https://app.clicksign.com/';

            $url_final = $URL_DEFAULT.'api/v1/documents?access_token='.$TOKEN;
            $json = json_encode($jayParsedAry);
            $header = array('Content-Type: application/json', 'Host: sandbox.clicksign.com', 'Accept: application/json');
            $ch = curl_init($url_final);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            $retorno = curl_exec($ch);

            //dd($retorno);

            $data = 'sucesso';
            return $data;
    }

    public function resumo($id){
        $bordero = Solicitacao::select('solicitacao.*','cliente.Name as nome_sacador','cliente.limite_credito as credito',
        'cliente.OfficialName as nome_empresa_sacador')
        ->leftJoin('cliente','cliente.id','solicitacao.id_solicitante')
        ->where('solicitacao.nro_bordero','=',$id)
        ->get();
        $valor_liquido_total = 0;
        //trocar id por nro bordero

        foreach($bordero as $b){
            $b->conta       = Cliente_Conta::where('id',$b->id_cliente_conta)->first();
            $b->sacado      = Cliente::where('id','=',$b->id_sacado)->first();
            $b->solicitante = Cliente::where('id','=',$b->id_solicitante)->first();

            //formatatelefone
            if(isset($b->sacado->telefone)){
                $b->sacado->telefone = preg_replace("/\D/", '', $b->sacado->telefone);
                $b->sacado->telefone = "(".substr($b->sacado->telefone,0,2).") ".substr($b->sacado->telefone,2,-4)." - ".substr($b->sacado->telefone,-4);
            }

            //formatacnpj
            if(isset($b->sacado->cnpj)){
                $b->sacado->cnpj = preg_replace("/\D/", '', $b->sacado->cnpj);
                $b->sacado->cnpj = preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5",$b->sacado->cnpj);
            }

            //formatacpf
            if(isset($b->sacado->cpf)){
                $b->sacado->cpf = preg_replace("/\D/", '', $b->sacado->cpf);
                $b->sacado->cpf = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $b->sacado->cpf);
            }
    
            $endereco_sacado_fisica   = Enderecos::where('id_cliente','=',$b->id_sacado)->where('id_socio','=',null)->where('tipo','=',"fisica")->first();
            if(isset($endereco_sacado_fisica)){
                //formatacep
                $endereco_sacado_fisica->Endereco_CEP = preg_replace("/\D/", '', $endereco_sacado_fisica->Endereco_CEP);
                $endereco_sacado_fisica->Endereco_CEP = preg_replace("/(\d{5})(\d{3})/", "\$1-\$2", $endereco_sacado_fisica->Endereco_CEP);
            }
            //Endereco do Sacado/Juridico
            $endereco_sacado_juridica = Enderecos::where('id_cliente','=',$b->id_sacado)->where('id_socio','=',null)->where('tipo','=',"juridica")->first();
            if(isset($endereco_sacado_juridica)){
                //formatacep
                $endereco_sacado_juridica->Endereco_CEP = preg_replace("/\D/", '', $endereco_sacado_juridica->Endereco_CEP);
                $endereco_sacado_juridica->Endereco_CEP = preg_replace("/(\d{5})(\d{3})/", "\$1-\$2", $endereco_sacado_juridica->Endereco_CEP);
            }

            $b->parcelas       = Solicitacao_Parcela::where('id_solicitacao','=',$b->id)->get();

            foreach($b->parcelas as $p){
                $today = date('Y/m/d');
                $b->diff_dias          = number_format((strtotime($p->vencimento) - strtotime($today)) / 86400, 0);
                $p['vencimento'] = BorderoController::FormataData($p['vencimento']);
            }

            $b->data_gerado = BorderoController::FormataData($b->data_gerado);
            $b->id_nota_reduzida = Str::limit($b->id_nota, 5);

            $b->diff_dias     = number_format($b->diff_dias/count($b->parcelas),0);
            $b->juros_total   = number_format($b->juros_total,2);
            $new = str_replace('.', '', $b->valor_total);
            $new = str_replace(',', '.', $new);
            $new2 = str_replace('.', '', $b->valor_total_juros);
            $new2 = str_replace(',', '.', $new2);
            $novo = $new - $new2;
            $valor_liquido_total += $new2;
            $b->juros_valor = number_format($novo, 2, ',', '.');
            $b->name_reduzido = Str::limit($b->sacado->Name, 8);
            $b->officialName_reduzido = Str::limit($b->sacado->OfficialName, 8);
            $valor_total 	= '';
            $juros 			= '';
        }
        $valor_liquido_total = number_format($valor_liquido_total, 2, ',', '.');
        if($endereco_sacado_fisica == null){
            $endereco = $endereco_sacado_juridica;
        }else if($endereco_sacado_juridica == null){
            $endereco = $endereco_sacado_fisica;
        }else{
            $endereco = null;
        }

        $nro_bordero = $bordero[0]->nro_bordero;
        
        return view('admin.cliente.resume',with(compact(
            'id','valor_total','juros',
            'bordero','nro_bordero','valor_liquido_total')));
    }

    public function boleto($id){
        $bordero = Solicitacao::select('solicitacao.*','cliente.Name as nome_sacador','cliente.limite_credito as credito',
        'cliente.OfficialName as nome_empresa_sacador')
        ->leftJoin('cliente','cliente.id','solicitacao.id_solicitante')
        ->where('solicitacao.nro_bordero','=',$id)
        ->get();
        
        //trocar id por nro bordero

        foreach($bordero as $b){
            $b->conta       = Cliente_Conta::where('id',$b->id_cliente_conta)->first();
            $b->sacado      = Cliente::where('id','=',$b->id_sacado)->first();
            $b->solicitante = Cliente::where('id','=',$b->id_solicitante)->first();

            $b->boletos     = Boleto::where('id_solicitacao',$b->id)->get();
            if(count($b->boletos) > 0){
                $sucesso = true;
            }else{
                $sucesso = false;
            }
            //formatatelefone
            if(isset($b->sacado->telefone)){
                $b->sacado->telefone = preg_replace("/\D/", '', $b->sacado->telefone);
                $b->sacado->telefone = "(".substr($b->sacado->telefone,0,2).") ".substr($b->sacado->telefone,2,-4)." - ".substr($b->sacado->telefone,-4);
            }

            //formatacnpj
            if(isset($b->sacado->cnpj)){
                $b->sacado->cnpj = preg_replace("/\D/", '', $b->sacado->cnpj);
                $b->sacado->cnpj = preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5",$b->sacado->cnpj);
            }

            //formatacpf
            if(isset($b->sacado->cpf)){
                $b->sacado->cpf = preg_replace("/\D/", '', $b->sacado->cpf);
                $b->sacado->cpf = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $b->sacado->cpf);
            }
    
            $endereco_sacado_fisica   = Enderecos::where('id_cliente','=',$b->id_sacado)->where('id_socio','=',null)->where('tipo','=',"fisica")->first();
            if(isset($endereco_sacado_fisica)){
                //formatacep
                $endereco_sacado_fisica->Endereco_CEP = preg_replace("/\D/", '', $endereco_sacado_fisica->Endereco_CEP);
                $endereco_sacado_fisica->Endereco_CEP = preg_replace("/(\d{5})(\d{3})/", "\$1-\$2", $endereco_sacado_fisica->Endereco_CEP);
            }
            //Endereco do Sacado/Juridico
            $endereco_sacado_juridica = Enderecos::where('id_cliente','=',$b->id_sacado)->where('id_socio','=',null)->where('tipo','=',"juridica")->first();
            if(isset($endereco_sacado_juridica)){
                //formatacep
                $endereco_sacado_juridica->Endereco_CEP = preg_replace("/\D/", '', $endereco_sacado_juridica->Endereco_CEP);
                $endereco_sacado_juridica->Endereco_CEP = preg_replace("/(\d{5})(\d{3})/", "\$1-\$2", $endereco_sacado_juridica->Endereco_CEP);
            }

            $b->parcelas           = Solicitacao_Parcela::select('solicitacao_parcela.*','boleto.*')
            ->join('boleto','boleto.id_parcela','solicitacao_parcela.id')
            ->where('solicitacao_parcela.id_solicitacao','=',$b->id)
            ->orderBy('solicitacao_parcela.id')
            ->get();
            foreach($b->parcelas as $p){
                $p['vencimento'] = BorderoController::FormataData($p['vencimento']);
                $valor_total  = str_replace(".", "", $p['valor_parcela']);
                $valor_total  = str_replace(",", ".", $valor_total);
                $valor_total_juros  = str_replace(".", "", $p['valor_juros']);
                $valor_total_juros  = str_replace(",", ".", $valor_total_juros);
                $subtracao  = $valor_total-$valor_total_juros;
                $p['desagio']  = number_format($subtracao, 2, ',', '.');
            }

            $b->id_nota_reduzida = Str::limit($b->id_nota, 5);
        }

        if($endereco_sacado_fisica == null){
            $endereco = $endereco_sacado_juridica;
        }else if($endereco_sacado_juridica == null){
            $endereco = $endereco_sacado_fisica;
        }else{
            $endereco = null;
        }
        
        $status = Status::all();
        $nro_bordero = $bordero[0]->nro_bordero;
        
        if($sucesso == true){
            return view('admin.cliente.billet',with(compact('bordero','endereco_sacado_juridica','endereco_sacado_fisica','nro_bordero')));
        }else{
            return view('admin.cliente.billet_confirmation',with(compact('bordero','nro_bordero')));
        }
       
    }

    public function paginate($items, $perPage, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    function FormataData($data){
        if(isset($data)){
            return implode("/", array_reverse(explode("-", substr($data, 0, 10))));
        }else{
            return '';
        }
    }
}
