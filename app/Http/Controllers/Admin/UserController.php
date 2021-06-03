<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Hash;

class UserController extends Controller
{
    public function index(){
        //Página de perfil do admin
        $admin = Auth::user();
        dd($admin);
        return redirect()->back();
    }

    public function update(Request $request){
        //Update de perfil do admin
        $user = User::where('id', Auth::user()->id)->first();
        if($request['password'] != ''){
            if($request['password'] == $request['confirma_senha']){
                $user->password  = Hash::make($request['password']);
            }else{
                return back()->with(['error' => "Senhas não coincidem"]);
            }
             
        }        

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $path           = $request->imagem->getClientOriginalName();
            $filename       = time().$path;
            $request->file('imagem')->move('images/usuarios', $filename);
            $user->imagem = $filename;
        } 
        
        $user->name      = $request['name'];
        $user->email     = $request['email'];
        
        $user->save();

        return back()->with(['success' => "Usuário atualizado com sucesso!"]);
    }
}
