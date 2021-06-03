<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cliente;

class InvestidorController extends Controller
{
    public function index(){
        //Listagem de Clientes
        $investidores =  Cliente::where('tipo','investidor')->get(['id','cnpj','cpf','OfficialName','Name']);
        dd($investidores);
        return redirect()->back();
    }

    public function filter(Request $request){
        //Aguardando front para integração 
        $filtro = $request->input('filtro');
        $investidores = Cliente::where('tipo','investidor')->where('Name','like', '%'.$filtro.'%')->paginate(50);
        dd($investidores);
        return redirect()->back();
    }

    public function delete($id){
        Cliente::where('id',$request->id)->delete();
        return redirect()->back();
    }
}
