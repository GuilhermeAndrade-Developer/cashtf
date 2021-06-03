<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Solicitacao;
use App\Cliente;
use App\Cliente_Socio;
use App\Cliente_Files;
use App\Cliente_Conta;
use App\User;
use App\Conjuge;

class AdminController extends Controller
{
    public function index(){
        $aprovadas      = count(Solicitacao::where('id_status','=',1)->get());
        $pendentes      = count(Solicitacao::where('id_status','=',2)->get());
        $recusadas      = count(Solicitacao::where('id_status','=',3)->get());
        $clientes       = count(Cliente::all());
        $clientes_pendentes      = count(Cliente::where('id_status_cliente', '=', 0)->get());
        $clientes_aprovados      = count(Cliente::where('id_status_cliente', '=', 1)->get());
        return view('admin/index',with(compact('aprovadas','pendentes','recusadas','clientes', 'clientes_pendentes', 'clientes_aprovados')));
    }

    public function clientesIndex(Request $request){
        if(isset($request->filter)) {
            $clientes = Cliente::where('id_status_cliente', '=', $request->filter)->get();
        }else {
            $clientes = Cliente::all();
        }
        return view('admin/clientes',with(compact('clientes')));
    }

    public function cliente($id){
        $cliente        = Cliente::where('id','=',$id)->get();
        $socios          = Cliente_Socio::where('id_cliente','=',$id)->get();
        foreach($socios as $socio) {
            if($socio->nome == $cliente[0]->Name){
                $socio->documento = $cliente[0]->documento;
                $socio->save();
            }            
            $socio['conjuge'] = Conjuge::where('id_cliente', '=', $socio->id)->get();
        }
        
        $contratos      = Cliente_Files::where('cliente_id','=',$id)->where('file_type','=','contrato_social')->get();
        $faturamento    = Cliente_Files::where('cliente_id','=',$id)->where('file_type','=','faturamento')->get();
        $contas         = Cliente_Conta::where('id_cliente','=',$id)->get();
        $usuario          = User::where('id_cliente','=',$id)->first();  

        return view('admin/cliente',with(compact('cliente','socios','contratos','faturamento','contas','usuario')));
    }
}
