<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Cliente;

use Redirect;
use Auth;
use Socialite;

class AuthLinkedinController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
 
    /**
     * Redirect the user to the Linkedin authentication page.
     *
     * @return Response
     */
    public function redirect()
    {
        return Socialite::driver('linkedin')->scopes(['r_liteprofile', 'r_emailaddress'])->redirect();
    }
  
    /**
     * Obtain the user information from Linkedin.
     *
     * @return Response
     */
    public function callback(Request $request)
    {
        if($request->has('error')){
            return redirect()->to('/login');
        } 
        $user = Socialite::driver('linkedin')->stateless()->user();
        $authUser = User::where('linkedin_id', $user->id)->first();
        if ($authUser) {
            if($authUser->ativo == 1){
                Auth::login($authUser, true);
                return redirect('/login');
            } else {
                if(isset($authUser->id_cliente)){
                    $cliente = Cliente::where('id', $authUser->id_cliente)->first();
                    if($cliente->etapa == 5){
                        $name=$cliente->Name;
                        Auth::logout();
                        return view('/partials/analise')->with(compact('name'));
                    } else {
                        return redirect()->route('register.confirmar',with(compact('cliente')))->with(compact('cliente'));
                    }
                } else {
                    $telefone = $authUser->telefone;
                    $id = $authUser->id;
                    return view('cliente/steps/cpf', with(compact('telefone', 'id')));
                }
                
            }
        }

        $valida_email = User::where('email', '=', $user->email)->get();

        if($valida_email->count() > 0){
            //update linkedin_id
            $userOld = User::where('email', $user->email)->first();
            if($userOld->linkedin_id == 'unlinked'){
                return redirect()->to('/login')->with('status', 'Este login foi desvinculado pelo usuário.');
            } else{
                $userOld->linkedin_id = $user->id;
                
                $userOld->save();

                if($userOld->ativo == 1){
                    Auth::login($userOld, true);
                    return redirect('/login');
                } else {
                    if(isset($userOld->id_cliente)){
                        $cliente = Cliente::where('id', $userOld->id_cliente)->first();
                        if($cliente->etapa == 5){
                            $name=$cliente->Name;
                            Auth::logout();
                            return view('/partials/analise')->with(compact('name'));
                        } else {
                            return redirect()->route('register.confirmar',with(compact('cliente')))->with(compact('cliente'));
                        }
                    } else {
                        $telefone = $userOld->telefone;
                        $id = $userOld->id;
                        return view('cliente/steps/cpf', with(compact('telefone', 'id')));
                    }
                    
                }
            }
        } else{
            //Criar o usuário
            $email = $user->email;
            $linkedin_id = $user->id;
            return redirect()->route('register', with(compact('linkedin_id', 'email')));
        }
    }
}
