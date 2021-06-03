<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\User;
use App\Cliente_Files;
use App\Cliente;
use App\Enderecos;
use App\Mail\Registrado;
use Illuminate\Support\Facades\Mail;
use Storage;
use Hash;

class UsuarioController extends Controller
{
    public function index(){
        if(Auth::user()->tipo == 'admin'){
            return view('admin/perfil');
        }else{
            $cliente    = Cliente::where('id','=',Auth::user()->id_cliente)->first();
            $documentos = Cliente_Files::where('cliente_id', Auth::user()->id_cliente)->get();
            $user    = User::where('id','=',Auth::user()->id)->first();
            if(($user->google_id != null && $user->google_id != 'unlinked') || ($user->facebook_id != null && $user->facebook_id != 'unlinked') || ($user->linkedin_id != null && $user->linkedin_id != 'unlinked')){
                $user->redeSocial = 1;
            } else {
                $user->redeSocial = 0;
            }
            foreach($documentos as $d){
                $d['created_at'] = UsuarioController::FormataData($d['created_at']);
            }
            return view('cliente/perfil')->with(compact('documentos', 'cliente', 'user'));
        }

    }

    public function updatePerfil(Request $request){   
        //($request);   
        $user = User::where('id', Auth::user()->id)->first();        

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $path           = $request->imagem->getClientOriginalName();
            $filename       = time().$path;
            $request->file('imagem')->move('images/usuarios', $filename);

            /*$oldFile        = $user->imagem;
            $user->imagem = $filename;

            Storage::disk('local')->delete('user/'.$oldFile);*/
            $user->imagem = $filename;
        } 
        
        $user->name      = $request['name'];
        $user->email     = $request['email'];
        
        if($request['password'] != ''){
            $user->password  = Hash::make($request['password']); 
        }

        $user->save();

        return redirect()->back()->with(['message' => "Usuário atualizado com sucesso!"]);
    }

    public function verificaEmail(Request $request){
        $data_recebe = json_decode(file_get_contents("php://input"));
        $user = $data_recebe->user;

        $oldUser = User::where('id', Auth::user()->id)->first();

        if($oldUser->email != $user->email){
            $procura = User::where('email', '=', $user->email)->where('id', '!=', Auth::user()->id)->first();
            if($procura){
                print('existe');
            } else{
                print('novo');
            }
        }
    }

    public function updatePerfilCliente(Request $request){   
        //($request);     
        $data_recebe = json_decode(file_get_contents("php://input"));
        $user = $data_recebe->user;

        $oldUser = User::where('id', Auth::user()->id)->first();
        
        if($oldUser->email != $user->email){
            $oldUser->email_verified_at = null;
            $token = random_bytes(8);
            $token = bin2hex($token);
            $oldUser->token = $token;
            $data = (['token' => $token, 'email' => $user->email]);
            $oldUser->email     = $user->email;
            Mail::to($user->email)->send(new Registrado($data));
            Auth::logout();
        }

        $novaSenha = $data_recebe->novaSenha;
        $oldUser->password = Hash::make($novaSenha);
        
        $oldUser->save();
    }

    public function updateImagem(Request $request){   
        //($request);     
        $user = User::where('id', Auth::user()->id)->first();        

        $path           = $request->file('item_file')[0]->getClientOriginalName();
        $filename       = time().$path;
        $caminho = "images/usuarios";
        $user->imagem = $filename;

        $request->file('item_file')[0]->move($caminho, $filename);

        $user->save();
    }

    public function removeSocial(Request $request){
        //dd($request);
        $data_recebe = json_decode(file_get_contents("php://input"));
        $id = $data_recebe->id_social;
        
        $facebook = User::where('facebook_id', $id)->first();
        $google = User::where('google_id', $id)->first();
        $linkedin = User::where('linkedin_id', $id)->first();

        if($facebook){
            $facebook->facebook_id = 'unlinked';
            $facebook->save();
        } else if($google) {
            $google->google_id = 'unlinked';
            $google->save();
        } else if($linkedin) {
            $linkedin->linkedin_id = 'unlinked';
            $linkedin->save();
        }

        print('Deu certo!');
    }

    public function validateForm(Request $request){
        $rules = [
            // 'title' => ['required'],
            // 'content' => ['required']
        ];

        $messages = [
            'required' => 'O campo :attribute deve ser informado'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return $validator;
        }

        return true;
    }

    function FormataData($data){
        if(isset($data)){
            return implode("/", array_reverse(explode("-", substr($data, 0, 10))));
        }else{
            return '';
        }
    }

    public function updateDocumentos(Request $request){
        $tipo_file 			= $_POST['tipo_file'];
		if($_FILES["file"]["name"] != ''){
			$arquivo       	= '';
            $arquivo       	= UsuarioController::SobeArquivo($_FILES['file']['name'], $_FILES['file']['tmp_name'], 'uploads/contratos/');

            $insere_arquivo = new Cliente_Files();
            $insere_arquivo->cliente_id     = Auth::user()->id_cliente;
            $insere_arquivo->file_type      = $tipo_file;
            $insere_arquivo->created_at     = date("y-m-d");
            $insere_arquivo->source         = $arquivo;
            $insere_arquivo->save();
            return redirect()->back();
		} 
    }

    function SobeArquivo($nomeimg, $nomeimg_temp, $pasta){
		$imagem 		= $nomeimg; 		//$_FILES['txtimagem']['name'];
		$imgtemp 		= $nomeimg_temp; 	//$_FILES['txtimagem']['tmp_name']; 
		$file_info = pathinfo($imagem);
		$novonome = md5($imagem . date('G:i:s')) .'.'. $file_info['extension'];
		$destino = $pasta . $novonome;

		// Converte a extensão para minúsculo
		$extensao = strtolower ( $file_info['extension'] );

		if ( strstr ( '.jpg;.jpeg;.gif;.png;.pdf;.word', $extensao ) ) {
			if(move_uploaded_file($imgtemp, $destino)){
				return $novonome;
			}else{
				return null;
			}
		}else{
			return null;
		}
	}

}
