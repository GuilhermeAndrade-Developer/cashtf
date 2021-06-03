<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Cliente;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = null)
    {
        if (Auth::guard($guard)->check()) {  
            //dd('chegou');
            if(Auth::user()->tipo != 'admin'){
                $user = User::where('id', '=', Auth::user()->id)->first();
                if($user->hasVerifiedEmail()){
                    if(isset($user->id_cliente)){
                        // tem cliente cadastrado com user
                        $cliente = Cliente::where('id','=',$user->id_cliente)->first();
                        if(Auth::user()->ativo == 1){
                            // completo e liberado
                            return redirect('/cliente/index');
                        } else {
                            if($cliente->etapa < 5){
                                // cliente nao completou cadastro
                                return redirect()->route('register.confirmar',with(compact('cliente')))->with(compact('cliente'));
                            } else{
                                // completou cadastro e ainda em analise
                                Auth::logout();
                                return redirect()->route('analise.pendente');
                            }
                        }
                    } else {
                        // nao tem cliente cadastrado nesse user
                        $telefone = $user->telefone;
                        $id = $user->id;
                        Auth::logout();
                        return redirect()->route('cliente.step.cpf', ['telefone' => $telefone, 'id' => $id]);
                    }
                } else {
                    $modalvalor=1;
                    Auth::logout();
                    return redirect()->route('register', ['email' => $user->email, 'modal' => $modalvalor]);
                }
            }

        }
        return $next($request);
    }
}
