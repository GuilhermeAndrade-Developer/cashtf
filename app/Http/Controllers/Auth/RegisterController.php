<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\Registrado;
use App\Mail\PasswordReset;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request){

        $user = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefone' => $request->telefone,
            'facebook_id' => $request->facebook_id,
            'google_id' => $request->google_id,
            'linkedin_id' => $request->linkedin_id
        ];
        
        $valida_email = User::where('email', '=', $request->email)->get();
        if($valida_email->count() > 0){
            $error = '1';
            return redirect()->route('register', with(compact('error')));
        }

        User::create($user);
        $telefone = $request->telefone;

        $novoUser = User::orderBy('id','desc')->first();
        $id = $novoUser->id;

        if(isset($novoUser->facebook_id) || isset($novoUser->google_id) || isset($novoUser->linkedin_id)){
            $novoUser->markEmailAsVerified();
            return view('cliente/steps/cpf', with(compact('telefone', 'id')));
        } else{
            //validar email

            $token = random_bytes(8);
            $token = bin2hex($token);
            
            $novoUser->token = $token;
            $novoUser->save();

            $data = (['token' => $token, 'email' => $novoUser->email]);

            $email = $novoUser->email;

            Mail::to($novoUser->email)->send(new Registrado($data));

            //mostrar modal de envio de email para confirmação de cadastro
            $modalvalor=1;
            $previousUrl = app('url')->previous();
            return redirect()->to($previousUrl.'?'. http_build_query(['modal'=>$modalvalor, 'email' => $email]));
        }

        //Auth::loginUsingId($id->id);
    }

    public function reenviarEmail(Request $request){

        //dd($request);
        
        $user = User::where('email', $request->email)->first();

        $data = (['token' => $user->token, 'email' => $user->email]);

        $email = $user->email;

        Mail::to($user->email)->send(new Registrado($data));

        $modalvalor=1;
        $previousUrl = app('url')->previous();
        return redirect()->to($previousUrl.'?'. http_build_query(['modal'=>$modalvalor, 'email' => $email]));

    }

    public function verifyUser(Request $request, $token){
        $verifyUser = User::where('token', $token)->first();
        if(isset($verifyUser) ){
            if(!isset($verifyUser->email_verified_at)) {
                $verifyUser->markEmailAsVerified();
                $verifyUser->token = null;
                $verifyUser->save();
                return view('partials.success');
            } else {
                return view('partials.success');
            }
        } else {
            return redirect('/login')->with('status', "usuário não encontrado.");
        }
    }

    public function sendResetEmail(Request $request){
        //dd($request);
        $user = User::where('email', $request->email)->first();

        if($user){
            $token = random_bytes(8);
            $token = bin2hex($token);
            
            $user->token = $token;
            $user->save();

            $data = (['token' => $token, 'email' => $user->email, 'nome' => $user->name]);

            Mail::to($user->email)->send(new PasswordReset($data));

            return redirect()->back()->with('status', 'E-mail enviado!');
        } else {
            return redirect()->back()->with('status', 'E-mail não encontrado!');
        }
    }

    public function resetPassword(Request $request, $token){
        $user = User::where('token', $token)->first();
        if(isset($user) ){
            return view('/partials/reset')->with(compact('user'));
        } else {
            return redirect('/login')->with('status', "usuário não encontrado.");
        }
    }

    public function changePassword(Request $request){
        //dd($request);
        $user = User::where('id', $request->id)->first();
        $senha = Hash::make($request->senha);
        
        if(isset($user) ){
            $user->password = $senha;
            $user->token = null;
            $user->save();
            return redirect('/login')->with('status', "Senha Atualizada com Sucesso.");
        } else {
            return redirect('/login')->with('status', "usuário não encontrado.");
        }
    }
    
    public function paginaCpf($telefone, $id){
        return view('cliente/steps/cpf', with(compact('telefone', 'id')));
    }

    public function paginaAnalise($name){
        return view('/partials/analise')->with(compact('name'));
    }

    public function confirmar(){
        return view('cliente/steps/confirmar');
    }

}
