<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cliente;
use App\Cliente_Socio;
use App\Cliente_Files;
use App\Cliente_Conta;
use App\User;
use App\Enderecos;
use App\Solicitacao;
use App\Http\Controllers\SolicitacaoController;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ClienteController extends Controller
{
    public function index(Request $request){
        //Listagem de Clientes
        $clientes = Cliente::select('cliente.*','users.*')
        ->leftJoin('users','users.id_cliente','cliente.id')
        ->where('users.id_cliente','!=','null')
        ->where('users.tipo','cliente')
        ->where('cliente.tipo','!=','null')
        ->where('cliente.cnpj','!=','null')
        ->orderBy('users.id_cliente','desc')
        ->paginate($request->session()->get('paginate'));
        //dd($clientes);
        return view('admin/clientes')->with(compact('clientes'));
    }

    public function filter(Request $request){
        $procure    = $request->input('procure');
        $paginas    = $request->input('paginas');
        if(isset($paginas)){
            $request->session()->pull('key', 'default');
            session(['paginate' => $paginas]);
        }

        $clientes = Cliente::select('cliente.*','users.*')
        ->leftJoin('users','users.id_cliente','cliente.id')
        ->where('users.id_cliente','!=','null')
        ->where('users.tipo','cliente')
        ->where('cliente.tipo','!=','null')
        ->where('OfficialName','like', '%'.$procure.'%')
        ->orderBy('users.id_cliente','desc')
        ->paginate($request->session()->get('paginate'));

        return view('admin/clientes')->with(compact('clientes','paginas','procure'));
    }

    public function delete($id){
        Cliente::where('id',$id)->delete();
        return redirect()->route('admin.clientes');
    }

    public function cliente($id){
        $empresa                    = Cliente::where('id','=',$id)->first();
        $empresa->endereco          = Enderecos::where('id_cliente',$id)->where('tipo','juridica')->first();
        
        $socios          = Cliente_Socio::where('id_cliente','=',$id)->get();
        foreach($socios as $socio) {
            if($socio->nome == $empresa->Name){
                $socio->documento = $empresa->documento;
                $socio->save();
                $socio->endereco          = Enderecos::where('id_cliente',$socio->id_cliente)->where('tipo','fisica')->first();
                if($socio->endereco == null){
                    $socio->endereco          = Enderecos::where('id_cliente',$socio->id_cliente)->where('tipo','juridica')->first();
                }
            }else{
                $socio->endereco          = Enderecos::where('id_socio',$socio->id)->where('tipo','fisica')->first();
                if($socio->endereco == null){
                    $socio->endereco          = Enderecos::where('id_socio',$socio->id)->where('tipo','juridica')->first();
                }
            }
            if(isset($socio->endereco->Endereco_Pais) && $socio->endereco->Endereco_Pais == 'Brazil'){
                $socio->endereco->Endereco_Pais = 'BRASIL';
            }
        }

        $contratos      = Cliente_Files::where('cliente_id','=',$id)->where('file_type','=','contrato_social')->first();
        $faturamento    = Cliente_Files::where('cliente_id','=',$id)->where('file_type','=','faturamento')->first();
        $alteracoes     = Cliente_Files::where('cliente_id','=',$id)->where('file_type','=','alteracao_contrato')->first();
        $procuracao     = Cliente_Files::where('cliente_id','=',$id)->where('file_type','=','procuracao')->first();
        $contas         = Cliente_Conta::where('id_cliente','=',$id)->get();
        $usuario        = User::where('id_cliente','=',$id)->first();
        return view('admin/cliente',with(compact('id','empresa','socios','contratos','faturamento','alteracoes','procuracao','contas','usuario')));
    }

    public function save(Request $request){
        $empresa    = Cliente::where('id','=',$request->id)->first();
        $user       = User::where('id_cliente','=',$request->id)->first();
        if($request->status == 'approved'){
            $user->ativo = 1;
            $user->save();
        }
        if($request->status == 'pending'){
            $user->ativo = 0;
            $user->save();
        }
        if($request->status == 'refused'){
            $user->ativo = 2;
            $user->save();
        }
        if($empresa->taxa_desagio != $request->juros){
            $ret_desagio = SolicitacaoController::novaTaxa($request,$request->id);
        }
        //Verifica se tem valor no limite de crédito
        if($empresa->limite_credito != $request->credito){
            $ret_credito = SolicitacaoController::novoCredito($request,$request->id);
        }
        //Verifica se tem valor na tarifa do bordero
        if($empresa->tarifa_bordero != $request->tarifa_bordero){
            $empresa->tarifa_bordero = $request->tarifa_bordero;
            $empresa->save();
        }

        return back()->with('success','Alterações Concluídas!');
    }

    public function solicitacoes(Request $request,$id){
        $empresa = Cliente::where('id','=',$request->id)->first();
        $borderos = Solicitacao::select('solicitacao.*','cliente.Name','cliente.OfficialName')
        ->leftJoin('cliente','cliente.id','solicitacao.id_sacado')
        ->where('solicitacao.id_solicitante','=',$id)
        ->orderBy('solicitacao.id','desc')
        ->get();
        foreach($borderos as $b){
            $b->data_gerado = ClienteController::FormataData($b->data_gerado);
            $valor_total  = str_replace(".", "", $b->valor_total);
            $valor_total  = str_replace(",", ".", $valor_total);
            $valor_total_juros  = str_replace(".", "", $b->valor_total_juros);
            $valor_total_juros  = str_replace(",", ".", $valor_total_juros);
            $subtracao  = $valor_total-$valor_total_juros;
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
                $array[$b->nro_bordero]['Name'] = substr($array[$b->nro_bordero]['Name'],0,50).'...';
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

        return view('admin/cliente/solicitacoes')->with(compact('borderos','id','empresa','array'));
    }

    public function filterSolicitacoes(Request $request,$id){
        
        $empresa = Cliente::where('id','=',$request->id)->first();
        $procure    = $request->input('procure');
        $paginas    = $request->input('paginas');
        if(isset($paginas)){
            $request->session()->pull('key', 'default');
            session(['paginate' => $paginas]);
        }
        if(isset($procure)){
            $borderos = Solicitacao::select('solicitacao.*','cliente.Name','cliente.OfficialName')
            ->leftJoin('cliente','cliente.id','solicitacao.id_sacado')
            ->where('solicitacao.nro_bordero','=',$procure)
            ->where('solicitacao.id_solicitante',$id)
            ->orderBy('solicitacao.id','desc')
            ->get();
            foreach($borderos as $b){
                $b->data_gerado = ClienteController::FormataData($b->data_gerado);
                $valor_total  = str_replace(".", "", $b->valor_total);
                $valor_total  = str_replace(",", ".", $valor_total);
                $valor_total_juros  = str_replace(".", "", $b->valor_total_juros);
                $valor_total_juros  = str_replace(",", ".", $valor_total_juros);
                $subtracao  = $valor_total-$valor_total_juros;
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
                    $array[$b->nro_bordero]['Name'] = substr($array[$b->nro_bordero]['Name'],0,50).'...';
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
            ->orderBy('solicitacao.id','desc')
            ->where('solicitacao.id_solicitante',$id)
            ->get();
            foreach($borderos as $b){
                $b->data_gerado = ClienteController::FormataData($b->data_gerado);
                $valor_total  = str_replace(".", "", $b->valor_total);
                $valor_total  = str_replace(",", ".", $valor_total);
                $valor_total_juros  = str_replace(".", "", $b->valor_total_juros);
                $valor_total_juros  = str_replace(",", ".", $valor_total_juros);
                $subtracao  = $valor_total-$valor_total_juros;
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
                    $array[$b->nro_bordero]['Name'] = substr($array[$b->nro_bordero]['Name'],0,50).'...';
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
        return view('admin/cliente/solicitacoes')->with(compact('borderos','id','paginas','procure','empresa'));
    }

    public function register(Request $request){
        //Instância de Cliente        
        $cliente = new Cliente;
        $cliente->etapa = 1;
        $cliente->save();

        //Instância de Usuário
        $user = new User;
        $user->id_cliente   = $cliente->id;
        $user->tipo         = 'cliente';
        $user->save();

        $admin = true;
        return view('cliente/steps/confirmar',with(compact('cliente','user','admin')));
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
