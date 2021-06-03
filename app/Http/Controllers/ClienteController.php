<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\Analise;
use App\Mail\AnaliseAdmin;
use App\Mail\NovoUsuario;
use App\Solicitacao;
use App\Solicitacao_Parcela;
use App\Cliente;
use App\Conjuge;
use App\Cliente_Files;
use App\Cliente_Socio;
use App\Cliente_Conta;
use App\Cliente_Spc;
use App\Dados_Profissionais;
use App\User;
use App\Enderecos;
use App\Veiculos;
use App\Info_Financeira;
use App\Antecedente_Criminal;
use App\Indicador_Atividade;
use Auth;
use DB;
use PDO;

class ClienteController extends Controller
{
    //$TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
    public function __construct()
    {
    }

    function FormataData($data){
        if(isset($data)){
            return implode("/", array_reverse(explode("-", substr($data, 0, 10))));
        }else{
            return '';
        }
    }

    public function index(Request $request){
        if(Auth::user()->tipo == 'admin'){
            $borderos = Solicitacao::select('solicitacao.*','cliente.Name','cliente.OfficialName')
            ->leftJoin('cliente','cliente.id','solicitacao.id_sacado')
            //->where('solicitacao.id','=',$id)
            ->orderBy('solicitacao.id','desc')
            ->paginate($request->session()->get('paginate'));
            foreach($borderos as $b){
                $b->data_gerado = ClienteController::FormataData($b->data_gerado);
                $valor_total  = str_replace(".", "", $b->valor_total);
                $valor_total  = str_replace(",", ".", $valor_total);
                $valor_total_juros  = str_replace(".", "", $b->valor_total_juros);
                $valor_total_juros  = str_replace(",", ".", $valor_total_juros);
                $subtracao  = $valor_total-$valor_total_juros;
                $b->desagio  = number_format($subtracao, 2, ',', '.');
            } 
            return redirect()->route('admin.solicitacoes')->with(compact('borderos'));
        }
        
        $aprovadas      = count(Solicitacao::where('id_status','=',1)->where('id_solicitante','=',Auth::user()->id_cliente)->get());
        $pendentes      = count(Solicitacao::where('id_status','=',2)->where('id_solicitante','=',Auth::user()->id_cliente)->get());
        $recusadas      = count(Solicitacao::where('id_status','=',3)->where('id_solicitante','=',Auth::user()->id_cliente)->get());

        //Valor do Limite de Crédito
        $limite_cliente = Cliente::where('id', '=', Auth::user()->id_cliente)->value('limite_credito');
        ($limite_cliente);
        if(!isset($limite_cliente)){
            $limite_cliente = "0";
        }else{
            if(str_contains($limite_cliente, '.')){
                $replace = Str::replaceFirst('.', '', $limite_cliente);
                $limite_cliente = (double)Str::replaceFirst(',', '.', $replace);
            } else{
                $limite_cliente = (double)Str::replaceFirst(',', '.', $limite_cliente);
            }
        }

        $solicitacoes=Solicitacao::where('id_solicitante','=', Auth::user()->id_cliente)->get();

        //dd($solicitacoes['valor_total']);
        $valor_aprovado = 0.0;
        $valor_analise = 0.0;
        $valor_recusado = 0.0;
        foreach($solicitacoes as $solicitacao){
            if($solicitacao->id_status == '1'){
                if(str_contains($solicitacao['valor_total'], '.')){
                    $replace = Str::replaceFirst('.', '', $solicitacao['valor_total']);
                    $valor = (double)Str::replaceFirst(',', '.', $replace);
                } else{
                    $valor = (double)Str::replaceFirst(',', '.', $solicitacao['valor_total']);
                }
                $valor_aprovado += $valor;
            } else if ($solicitacao->id_status == '2'){
                if(str_contains($solicitacao['valor_total'], '.')){
                    $replace = Str::replaceFirst('.', '', $solicitacao['valor_total']);
                    $valor = (double)Str::replaceFirst(',', '.', $replace);
                } else{
                    $valor = (double)Str::replaceFirst(',', '.', $solicitacao['valor_total']);
                }
                $valor_analise += $valor;
            } else{
                if(str_contains($solicitacao['valor_total'], '.')){
                    $replace = Str::replaceFirst('.', '', $solicitacao['valor_total']);
                    $valor = (double)Str::replaceFirst(',', '.', $replace);
                } else{
                    $valor = (double)Str::replaceFirst(',', '.', $solicitacao['valor_total']);
                }
                $valor_recusado += $valor;
            }
        }

        $limite_atual = $limite_cliente-$valor_aprovado;
        $exibir_limite = number_format($limite_atual, 2, ',', '.');
        $valor_aprovado = number_format($valor_aprovado, 2, ',', '.');
        $valor_analise = number_format($valor_analise, 2, ',', '.');
        $valor_recusado = number_format($valor_recusado, 2, ',', '.');

        $exibir_taxa = Cliente::where('id', '=', Auth::user()->id_cliente)->value('taxa_desagio');
        //dd($exibir_taxa);
        return view('cliente/index',with(compact('aprovadas','pendentes','recusadas','exibir_limite','exibir_taxa','valor_aprovado','valor_analise','valor_recusado')));
    }

    static function getEmpresa(){
        if(Auth::user()){
            $nomeEmpresa    = Cliente::where('id','=',Auth::user()->id_cliente)->value('OfficialName');
            return $nomeEmpresa;
        } else {
            return 'EMPRESA';
        }
    }

    public function analisePendente(){
        return view('partials/analise');
    }

    public function addSolicitacao(Request $request){
        if(isset($request->id)){
            $id = $request->id;
            session()->put('id', $request->id);
        }else{
            $id = Auth::user()->id_cliente;
        }
        return view('cliente/nova_solicitacao',with(compact('id')));
    }

    public function uploadXML(Request $request){
        $data_hoje = date('Y-m-d');
        //Valida se o cliente ja possui um juros definindo verificando a ultima solicitacao
        if(isset($tipo)){
            $lasttax = Solicitacao::where('id_solicitante','=',Auth::user()->id)->get();
            if($lasttax->rowCount() > 0){
                $valor_juros_definido = $lasttax[0]->juros;
            }else{
                $valor_juros_definido = 1.99;
            }
        }else{
            $valor_juros_definido = 1.99;
        }

    
        /* $vencimento_inicial     = $data_recebe->vencimento_inicial;
        $valor                  = $data_recebe->valor;
        $quantidade_parcela     = $data_recebe->quantidade_parcela;
        $xml                    = $data_recebe->arquivo_nome;
        $d                      = [];
        
        for ($i = 0; $i < $quantidade_parcela; $i++) {

            $diff_dias          = 0;
            $juros_definido     = 0;
            $valor_oficial      = 0;
            $valor_com_juros    = 0;
            $stamp              = strtotime($vencimento_inicial);
            if ($i != 0) {
                $v_inicial      = date("Y-m-d", strtotime("+" . $i . " month", $stamp));
            } else {
                $v_inicial      = $vencimento_inicial;
            }
        }*/
            
        if ($request->xml != '') {
            $xml                    = '';
            $xml                    = $request->file('xml')->getClientOriginalName();
            $xml_arquivo            = simplexml_load_file($request->file('xml'));
            $id_nota                = '';
            $dados                  = [];

            //dd($xml_arquivo);
            
            foreach ($xml_arquivo as $registro) :
                $id_nota = strval($registro->infNFe['Id'][0]);
                $d = [];
                $d['emit'] = array(
                'cnpj' => strval($registro->infNFe->emit->CNPJ),
                'xNome' => strval($registro->infNFe->emit->xNome),
                'xFant' => strval($registro->infNFe->emit->xFant),
                'IE' => strval($registro->infNFe->emit->IE)
                );
            
                $d['avulsa'] = array(
                'CNPJ' => strval($registro->infNFe->avulsa->CNPJ),
                'xOrgao' => strval($registro->infNFe->avulsa->xOrgao),
                'matr' => strval($registro->infNFe->avulsa->matr),
                'xAgente' => strval($registro->infNFe->avulsa->xAgente),
                'UF' => strval($registro->infNFe->avulsa->UF),
                'repEmi' => strval($registro->infNFe->avulsa->repEmi)
                );
            
                $d['dest'] = array(
                'xNome' => strval($registro->infNFe->dest->xNome),
                'xLgr' => strval($registro->infNFe->dest->enderDest->xLgr),
                'nro' => strval($registro->infNFe->dest->enderDest->nro),
                'xCpl' => strval($registro->infNFe->dest->enderDest->xCpl),
                'xBairro' => strval($registro->infNFe->dest->enderDest->xBairro),
                'cMun' => strval($registro->infNFe->dest->enderDest->cMun),
                'xMun' => strval($registro->infNFe->dest->enderDest->xMun),
                'UF' => strval($registro->infNFe->dest->enderDest->UF),
                'CEP' => strval($registro->infNFe->dest->enderDest->CEP),
                'cPais' => strval($registro->infNFe->dest->enderDest->cPais),
                'xPais' => strval($registro->infNFe->dest->enderDest->xPais),
                'indIEDest' => strval($registro->infNFe->dest->indIEDest)
            );

            /*if(validaCNPJ(strval($registro->infNFe->dest->CNPJ))){
                $d['dest']["CNPJ"] = strval($registro->infNFe->dest->CNPJ);
            };

            if(validaCPF(strval($registro->infNFe->dest->CPF))){
                $d['dest']["CPF"] = strval($registro->infNFe->dest->CPF);
            };*/

            $d['totalGeral'] = array(
                'totalGeralSimples' => 0,
                'totalGeralJuros' => 0
            );

            $valor_original_nota = ((strval($registro->infNFe->pag->detPag->vPag))?strval($registro->infNFe->pag->detPag->vPag):0);
            $valor_original = 0;
            //Faturas fat ou dup
            //dd($registro->infNFe->cobr);
            foreach ($registro->infNFe->cobr as $fats) {
                foreach ($fats as $f) {
                    //dd(!$f->nFat);
                    if (!$f->nFat) {
                        $valor_original += strval($f->vDup);
                        if (strtotime($f->dVenc) >= strtotime($data_hoje)) {
                            $diff_dias = 0;
                            $juros_definido = 0;
                            $valor_oficial = 0;
                            $valor_com_juros = 0;

                            $diff_dias          = number_format((strtotime($f->dVenc) - strtotime($data_hoje)) / 86400, 0);
                            $juros_definido     = number_format((((($valor_juros_definido / 30) * $diff_dias) * 100) / 100), 4);
                            $juros_formatado    = number_format((((($valor_juros_definido / 30) * $diff_dias) * 100) / 100), 2);
                            $valor_oficial      = strval($f->vDup);
                            $valor_com_juros    = $valor_oficial - (($juros_definido * $valor_oficial) / 100);

                            $d['cobr'][] = array(
                                'nDup' => strval($f->nDup),
                                'dVenc' => strval(FormataData($f->dVenc)),
                                'vDup' => number_format($valor_oficial, 2, ',', '.'),
                                'vTotal' => number_format($valor_com_juros, 2, ',', '.'),
                                'vJurosReal' => number_format(($valor_oficial - $valor_com_juros), 2, ',', '.'),
                                'vJuros' => $juros_formatado
                            );

                            $d['totalGeral'] = array(
                                'totalGeralSimples' => $d['totalGeral']['totalGeralSimples'] + $valor_oficial,
                                'totalGeralJuros' => $d['totalGeral']['totalGeralJuros'] + $valor_com_juros
                            );
                        }
                    }
                }
            }

            $juros_geral = (($d['totalGeral']['totalGeralSimples'] != 0)?($d['totalGeral']['totalGeralSimples'] - $d['totalGeral']['totalGeralJuros']) / $d['totalGeral']['totalGeralSimples'] * 100:0);
            $d['totalGeral'] = array(
                'xml_file' => $xml,
                'totalGeralSimples' => number_format($d['totalGeral']['totalGeralSimples'], 2, ',', '.'),
                'totalGeralJuros' => number_format($d['totalGeral']['totalGeralJuros'], 2, ',', '.'),
                'jurosTotal' => number_format($juros_geral, 2),
                'valorSoma' => number_format($valor_original, 2, ',', '.'),
                'valorOriginalNota' => number_format($valor_original_nota, 2, ',', '.'),
                'jurosAplicado' => $valor_juros_definido
            );
            
            $d['idNota'] = $id_nota;
            
            $dados[] = $d;
            break;
        endforeach;
        //dd($dados);
        return redirect()->action(
            'ClienteController@loadFields',['dados' => $dados]
        );
    }
    }

    public function loadFields(Request $request){
        //dd($request->dados);
        $emit = $request->dados[0]['emit'];
        $avulsa = $request->dados[0]['avulsa'];
        $total_geral = $request->dados[0]['totalGeral'];
        $dest = $request->dados[0]['dest'];
        $id_nota = $request->dados[0]['idNota'];

        $contas = Cliente_Conta::where('id_cliente','=',Auth::user()->id_cliente)->get();
        return view('cliente/nova_solicitacao',with(compact('emit','avulsa','dest','total_geral','id_nota','contas')));
    }

    public function perfil(Request $request){
        return view('cliente/perfil', with(compact('empresa','documentos')));
    }

    public function ativoCredito(){
        return view('auth/ativo');
    }

    public function addDocumento(Request $request){
        $id         = $request->id;
        $telefone   = $request->telefone;
        if (!ClienteController::validaCPF($request->cpf)) {
            $error = 1;
            return view('cliente/steps/cpf')->with(compact('error', 'id', 'telefone'));
        }
        
        if (!ClienteController::validaCNPJ($request->cnpj)) {
            $error = 2;
            return view('cliente/steps/cpf')->with(compact('error', 'id', 'telefone'));
        }

        $valida_existe = Cliente::where('cpf', $request->cpf)->orWhere('cnpj', '=', $request->cnpj)->get();
        if($valida_existe->count() > 0){
            $error = 3;
            return view('cliente/steps/cpf')->with(compact('error', 'id', 'telefone'));
        }
        
        Cliente::create(['cpf' => $request->cpf ,'cnpj' => $request->cnpj, 'telefone' => $request->telefone, 'etapa' => 1]);
        $ultimo = Cliente::orderBy('id','desc')->first();
        $user = User::where('id','=',$request->id)->first();
        $user->id_cliente = $ultimo->id;
        $ultimo->email = $user->email;
        $ultimo->save();
        $user->save();
        return redirect()->route('register.confirmar',with(compact('ultimo')))->with(compact('ultimo'));
    }

    public function confirmar(Request $request,$id){
        $cliente = Cliente::where('id','=',$id)->first();
        $user = User::where('id_cliente','=',$id)->first();
        $admin = false;
        return view('cliente/steps/confirmar',with(compact('cliente','user','admin')));
    }
    
    public function confirmarTeste(Request $request,$id){
        $cliente = Cliente::where('id','=',$id)->first();
        $user = User::where('id_cliente','=',$id)->first();
        return view('cliente/steps/changes/confirmar',with(compact('cliente','user')));
    }

    // ----------   NOVA FUNCAO PARA SER UTILIZADA NO CADASTRO DE SÓCIOADMIN OU PROCURADOR -----------------------
    public function createSocioProc(Request $request){
        //dd($request);
        $data_recebe = json_decode(file_get_contents("php://input"));
        $fisica[]   = $data_recebe->fisica;
        $cpf        = $data_recebe->cpf;
        $idCliente = $request->idcliente;
        $endereco = $fisica[0]->Address;

        //dd($fisica, $endereco);

        try{
            $cliente = Cliente::where('id', $idCliente)->first();
            
            //dados do bigdata
            $cliente->BirthCountry = isset($fisica[0]->BirthCountry)? $fisica[0]->BirthCountry : null;
            $cliente->BirthState = isset($fisica[0]->BirthState)? $fisica[0]->BirthState : null;
            $cliente->MotherName = isset($fisica[0]->MotherName)? $fisica[0]->MotherName : null;
            $cliente->FatherName = isset($fisica[0]->FatherName)? $fisica[0]->FatherName : null;
            $cliente->HasObitIndication = isset($fisica[0]->HasObitIndication)? $fisica[0]->HasObitIndication : null;

            //dados do formulario
            $cliente->tipo = isset($fisica[0]->tipo)? $fisica[0]->tipo : 'socioAdmin';

            $cliente->cpf = $cpf;
            $cliente->rg = isset($fisica[0]->AlternativeIdNumbers->RGSP)? $fisica[0]->AlternativeIdNumbers->RGSP : null;
            $cliente->orgaoEmissor = isset($fisica[0]->orgaoEmissor)? $fisica[0]->orgaoEmissor : null;
            $cliente->Name = isset($fisica[0]->Name)? $fisica[0]->Name : null;
            $cliente->nationality = isset($fisica[0]->BirthCountry)? $fisica[0]->BirthCountry : null;
            $cliente->passport = isset($fisica[0]->passport)? $fisica[0]->passport : null;
            $cliente->BirthDate = isset($fisica[0]->BirthDate)? $fisica[0]->BirthDate : null;
            $cliente->Gender = isset($fisica[0]->Gender)? $fisica[0]->Gender : null;
            $cliente->email = isset($fisica[0]->email)? $fisica[0]->email : null;
            $cliente->EstadoCivil = isset($fisica[0]->estadoCivil)? $fisica[0]->estadoCivil : null;
            $cliente->BirthState = isset($endereco->State)? $endereco->State : null;

            $user = User::where('id_cliente','=',$idCliente)->first();
            $user->name = $fisica[0]->Name;
            $user->save();

            //dd($cliente);
            $cliente->etapa = 2;
            $cliente->save();

            //criaçao de endereco
            ClienteController::novoEndereco($endereco, $idCliente, null, 'fisica');

            $procuraSocio = Cliente_Socio::where('id_cliente','=',$idCliente)->first();
            if(!$procuraSocio){
                //duplicação do cliente em cliente_socio guardando a conjuge
                $cl_socio = New Cliente_Socio;
                $cl_socio->id_cliente = $idCliente;
                $cl_socio->cpf = $cpf;
                $cl_socio->rg = isset($fisica[0]->AlternativeIdNumbers->RGSP)? $fisica[0]->AlternativeIdNumbers->RGSP : null;
                $cl_socio->orgaoEmissor = $fisica[0]->orgaoEmissor;
                $cl_socio->nome = isset($fisica[0]->Name)? $fisica[0]->Name : null;
                $cl_socio->nationality = isset($fisica[0]->BirthCountry)? $fisica[0]->BirthCountry : null;
                $cl_socio->passport = isset($fisica[0]->passport)? $fisica[0]->passport : null;
                $cl_socio->birthDate = isset($fisica[0]->BirthDate)? $fisica[0]->BirthDate : null;
                $cl_socio->gender = isset($fisica[0]->Gender)? $fisica[0]->Gender : null;
                $cl_socio->email = isset($fisica[0]->email)? $fisica[0]->email : null;
                $cl_socio->estadoCivil = isset($fisica[0]->estadoCivil)? $fisica[0]->estadoCivil : null;

                //conjuge
                $cl_socio->conjuge_cpf = isset($fisica[0]->conjuge_cpf)? $fisica[0]->conjuge_cpf : null;
                $cl_socio->conjuge_rg = isset($fisica[0]->conjuge_rg)? $fisica[0]->conjuge_rg : null;
                $cl_socio->conjuge_nome = isset($fisica[0]->conjuge_nome)? $fisica[0]->conjuge_nome : null;
                $cl_socio->conjuge_nationality = isset($fisica[0]->conjuge_nationality)? $fisica[0]->conjuge_nationality : null;
                $cl_socio->conjuge_profissao = isset($fisica[0]->conjuge_profissao)? $fisica[0]->conjuge_profissao : null;
                $cl_socio->conjuge_email = isset($fisica[0]->conjuge_email)? $fisica[0]->conjuge_email : null;
                
                $cl_socio->ativo = 1;

                //dd($cl_socio);

                $cl_socio->save();
            } else {
                $procuraSocio->cpf = $cpf;
                $procuraSocio->rg = isset($fisica[0]->AlternativeIdNumbers->RGSP)? $fisica[0]->AlternativeIdNumbers->RGSP : null;
                $procuraSocio->orgaoEmissor = isset($fisica[0]->orgaoEmissor)? $fisica[0]->orgaoEmissor : null;
                $procuraSocio->nome = isset($fisica[0]->Name)? $fisica[0]->Name : null;
                $procuraSocio->nationality = isset($fisica[0]->BirthCountry)? $fisica[0]->BirthCountry : null;
                $procuraSocio->passport = isset($fisica[0]->passport)? $fisica[0]->passport : null;
                $procuraSocio->birthDate = isset($fisica[0]->BirthDate)? $fisica[0]->BirthDate : null;
                $procuraSocio->gender = isset($fisica[0]->Gender)? $fisica[0]->Gender : null;
                $procuraSocio->email = isset($fisica[0]->email)? $fisica[0]->email : null;
                $procuraSocio->estadoCivil = isset($fisica[0]->estadoCivil)? $fisica[0]->estadoCivil : null;
                
                //conjuge
                $procuraSocio->conjuge_cpf = isset($fisica[0]->conjuge_cpf)? $fisica[0]->conjuge_cpf : null;
                $procuraSocio->conjuge_rg = isset($fisica[0]->conjuge_rg)? $fisica[0]->conjuge_rg : null;
                $procuraSocio->conjuge_nome = isset($fisica[0]->conjuge_nome)? $fisica[0]->conjuge_nome : null;
                $procuraSocio->conjuge_nationality = isset($fisica[0]->conjuge_nationality)? $fisica[0]->conjuge_nationality : null;
                $procuraSocio->conjuge_profissao = isset($fisica[0]->conjuge_profissao)? $fisica[0]->conjuge_profissao : null;
                $procuraSocio->conjuge_email = isset($fisica[0]->conjuge_email)? $fisica[0]->conjuge_email : null;

                $procuraSocio->ativo = 1;

                $procuraSocio->save();
            }

        }catch (\Throwable $th) {
            print $th;
        }
    }

    // --------------------- NOVA FUNÇÃO PARA CADASTRO DE SOCIOS -----------------------------------
    public function addSocios(Request $request){
        //dd($request);
        $data_recebe = json_decode(file_get_contents("php://input"));
        $socio = $data_recebe->socios;
        $idCliente = $request->idcliente;
        $endereco = $socio->Address;

        //dd($socio);
        if ($socio->id == '' and $socio->nome != '' and $socio->cpf != '') {
            try{
                $newSocio = New Cliente_Socio;

                $newSocio->id_cliente = $idCliente;
                $newSocio->cpf = isset($socio->cpf)? $socio->cpf : null;
                $newSocio->rg = isset($socio->rg)? $socio->rg : null;
                $newSocio->orgaoEmissor = isset($socio->orgaoEmissor)? $socio->orgaoEmissor : null;
                $newSocio->nome = isset($socio->nome)? $socio->nome : null;
                $newSocio->nationality = isset($socio->nationality)? $socio->nationality : null;
                $newSocio->passport = isset($socio->passport)? $socio->passport : null;
                $newSocio->birthDate = isset($socio->birthDate)? $socio->birthDate : null;
                $newSocio->gender = isset($socio->gender)? $socio->gender : null;
                $newSocio->email = isset($socio->email)? $socio->email : null;
                $newSocio->estadoCivil = isset($socio->estadoCivil)? $socio->estadoCivil : null;
                $newSocio->ativo = 1;

                //conjuge
                $newSocio->conjuge_cpf = isset($socio->conjuge_cpf)? $socio->conjuge_cpf : null;
                $newSocio->conjuge_rg = isset($socio->conjuge_rg)? $socio->conjuge_rg : null;
                $newSocio->conjuge_nome = isset($socio->conjuge_nome)? $socio->conjuge_nome : null;
                $newSocio->conjuge_nationality = isset($socio->conjuge_nationality)? $socio->conjuge_nationality : null;
                $newSocio->conjuge_profissao = isset($socio->conjuge_profissao)? $socio->conjuge_profissao : null;
                $newSocio->conjuge_email = isset($socio->conjuge_email)? $socio->conjuge_email : null;

                //dd($newSocio);
                $newSocio->save();

                //criaçao de endereco
                ClienteController::novoEndereco($endereco, $idCliente, $newSocio->id, 'fisica');
                print $newSocio->id;
                
            } catch (\Throwable $th) {
                echo $th;
            }
        } else {
            if($socio->nome == '' or $socio->cpf == ''){
                echo('Preencher os campos obrigatórios');
            } else {
                //Update socio->id
                $oldSocio = Cliente_Socio::where('id','=',$socio->id)->first();
                $oldSocio->cpf = isset($socio->cpf)? $socio->cpf : null;
                $oldSocio->rg = isset($socio->rg)? $socio->rg : null;
                $oldSocio->orgaoEmissor = isset($socio->orgaoEmissor)? $socio->orgaoEmissor : null;
                $oldSocio->nome = isset($socio->nome)? $socio->nome : null;
                $oldSocio->nationality = isset($socio->nationality)? $socio->nationality : null;
                $oldSocio->passport = isset($socio->passport)? $socio->passport : null;
                $oldSocio->birthDate = isset($socio->birthDate)? $socio->birthDate : null;
                $oldSocio->gender = isset($socio->gender)? $socio->gender : null;
                $oldSocio->email = isset($socio->email)? $socio->email : null;
                $oldSocio->estadoCivil = isset($socio->estadoCivil)? $socio->estadoCivil : null;
                $oldSocio->ativo = 1;
                
                //conjuge
                $oldSocio->conjuge_cpf = isset($socio->conjuge_cpf)? $socio->conjuge_cpf : null;
                $oldSocio->conjuge_rg = isset($socio->conjuge_rg)? $socio->conjuge_rg : null;
                $oldSocio->conjuge_nome = isset($socio->conjuge_nome)? $socio->conjuge_nome : null;
                $oldSocio->conjuge_nationality = isset($socio->conjuge_nationality)? $socio->conjuge_nationality : null;
                $oldSocio->conjuge_profissao = isset($socio->conjuge_profissao)? $socio->conjuge_profissao : null;
                $oldSocio->conjuge_email = isset($socio->conjuge_email)? $socio->conjuge_email : null;
                

                $oldSocio->save();

                print $oldSocio->id;
            }
        }
    }

    public function createCompany(Request $request){
        if(isset($request->idcliente)){
            $cliente = Cliente::where('id', $request->idcliente)->first();
        }else{
            $cliente = Cliente::where('id', Auth::user()->id_cliente)->first();
        }

        //$pdo = DB::connection()->getPdo();
        $data_recebe = json_decode(file_get_contents("php://input"));
        $juridica[] = $data_recebe->juridica;
        $cnpj       = $data_recebe->cnpj;
        $endereco = $juridica[0]->Address;

        //dados do bigdata
        $cliente->ClosedDate = isset($juridica[0]->ClosedDate)? $juridica[0]->ClosedDate : null;
        $cliente->IsHeadquarter = isset($juridica[0]->IsHeadquarter)? $juridica[0]->IsHeadquarter : null;
        $cliente->HeadquarterState = $juridica[0]->HeadquarterState;
        $cliente->TaxIdStatus = isset($juridica[0]->TaxIdStatus)? $juridica[0]->TaxIdStatus : null;
        $cliente->TaxIdOrigin = isset($juridica[0]->TaxIdOrigin)? $juridica[0]->TaxIdOrigin: null;
        $cliente->TaxRegime = $juridica[0]->TaxRegime;
        $cliente->CreationDate = $juridica[0]->CreationDate;
        $cliente->LastUpdateDate = $juridica[0]->LastUpdateDate;

        //dados vindo por formulario
        $cliente->cnpj = $request->cnpj;
        $cliente->OfficialName =    isset($juridica[0]->OfficialName)? $juridica[0]->OfficialName : null;
        $cliente->TradeName = isset($juridica[0]->TradeName)? $juridica[0]->TradeName : null;
        $cliente->FoundedDate = isset($juridica[0]->FoundedDate)? $juridica[0]->FoundedDate : null;
        $cliente->mainActivity = isset($juridica[0]->mainActivity)? $juridica[0]->mainActivity : null;
        $cliente->secondActivity = isset($juridica[0]->secondActivity)? $juridica[0]->secondActivity : null;
        $cliente->etapa = 3;
        $cliente->save();

        ClienteController::novoEndereco($endereco, $cliente->id, null, 'juridica');

        return $cliente;
    }

    public function novoEndereco($endereco, $id, $idSocio, $type){
        //dd($endereco->juridica['Address']['ZipCode']);
        $procuraEndereco = Enderecos::where('id_cliente','=',$id)->where('id_socio', '=', $idSocio)->where('tipo', '=', $type)->first();

        if(!$procuraEndereco){
            $novo_endereco = new Enderecos();
            $novo_endereco->id_cliente              = $id;
            $novo_endereco->id_socio                = $idSocio;
            $novo_endereco->tipo                    = $type;
            $novo_endereco->Endereco_Lgr            = $endereco->AddressMain;
            $novo_endereco->Endereco_Nro            = isset($endereco->Number)? $endereco->Number: null;
            $novo_endereco->Endereco_Complemento    = isset($endereco->Complement)? $endereco->Complement: null;
            $novo_endereco->Endereco_Bairro         = $endereco->Neighborhood;
            $novo_endereco->Endereco_Mun            = $endereco->City;
            $novo_endereco->Endereco_UF             = $endereco->State;
            $novo_endereco->Endereco_CEP            = $endereco->ZipCode;
            $novo_endereco->Endereco_Pais           = $endereco->Country;
            //dd($novo_endereco);
            $novo_endereco->save();
        } else {
            $procuraEndereco->Endereco_Lgr            = $endereco->AddressMain;
            $procuraEndereco->Endereco_Nro            = isset($endereco->Number)? $endereco->Number: null;
            $procuraEndereco->Endereco_Complemento    = isset($endereco->Complement)? $endereco->Complement: null;
            $procuraEndereco->Endereco_Bairro         = $endereco->Neighborhood;
            $procuraEndereco->Endereco_Mun            = $endereco->City;
            $procuraEndereco->Endereco_UF             = $endereco->State;
            $procuraEndereco->Endereco_CEP            = $endereco->ZipCode;
            $procuraEndereco->Endereco_Pais           = $endereco->Country;
            $procuraEndereco->save();
        }
        
    }

    // função pra direcionar qualquer arquivo
    public function uploadArquivo(Request $request){
        //dd($request);
        try {
            $tipo_arquivo = $request->tipo;
            $idCliente = $request->id;
            $idSocio = $request->idSocio;

            //renomear o arquivo
            if($tipo_arquivo == 'documento_socio'){
                $path           = $request->file->getClientOriginalName();
            } else{
                $path           = $request->file('item_file')[0]->getClientOriginalName();
            }

            $filename       = time().$path;

            $salvar = false;
            if($tipo_arquivo == 'faturamento'){
                $caminho = "uploads/faturamentos";
                $salvar = true;

            } else if($tipo_arquivo == 'contrato_social'){
                $caminho = "uploads/contratos";
                $salvar = true;

            } else if($tipo_arquivo == 'alteracao_contrato'){
                $caminho = "uploads/alteracoes";
                $salvar = true;
                
            } else if($tipo_arquivo == 'documentoBase'){
                $caminho = "uploads/socios";
                $cliente = Cliente::where('id', $idCliente)->first();
                $cliente->documento = $filename;
                $cliente->save();

            } else if($tipo_arquivo == 'procuracao'){
                $caminho = "uploads/procuracoes";
                $salvar = true;
                
            } else if($tipo_arquivo == 'documento_socio'){
                $caminho = "uploads/socios";
                $socio = Cliente_Socio::where('id', $idSocio)->first();
                $socio->documento = $filename;
                $socio->save();
            }

            if($salvar){
                $cliente_files = new Cliente_files;
                $cliente_files->cliente_id = $idCliente;
                $cliente_files->file_type = $tipo_arquivo;
                $cliente_files->created_at = date("y-m-d");
                $cliente_files->source = $filename;
                $cliente_files->save();
            }
            
            //mover o arquivo
            if($tipo_arquivo == 'documento_socio'){
                $request->file->move($caminho, $filename);
            } else{
                $request->file('item_file')[0]->move($caminho, $filename);
            }

        } catch (\Throwable $th) {
            print $th;
        } 
    }

    public function atualizarDadosJuridica(Request $request){
        $data_recebe = json_decode(file_get_contents("php://input"));
        $juridica[] = $data_recebe->juridica;
        $endereco = $juridica[0]->Address;
    
        try {
            $empresa = Cliente::where('id', '=', $juridica[0]->id)->first();

            $empresa->tipo             = isset($juridica[0]->tipo)          ?   $juridica[0]->tipo          :   $empresa->tipo;
            $empresa->cnpj             = isset($juridica[0]->cnpj)          ?   $juridica[0]->cnpj          :   $empresa->cnpj;
            $empresa->OfficialName     = isset($juridica[0]->OfficialName)  ?   $juridica[0]->OfficialName  :   $empresa->OfficialName;
            $empresa->TradeName        = isset($juridica[0]->TradeName)     ?   $juridica[0]->TradeName     :   $empresa->TradeName;
            $empresa->FoundedDate      = isset($juridica[0]->FoundedDate)   ?   $juridica[0]->FoundedDate   :   $empresa->FoundedDate;
            $empresa->mainActivity     = isset($juridica[0]->mainActivity)  ?   $juridica[0]->mainActivity  :   $empresa->mainActivity;
            $empresa->secondActivity   = isset($juridica[0]->secondActivity)?   $juridica[0]->secondActivity:   $empresa->secondActivity;
            $empresa->save();

            $procuraEndereco = Enderecos::where('id_cliente','=',$juridica[0]->id)->where('id_socio', '=', null)->where('tipo', '=', 'juridica')->first();

            $procuraEndereco->Endereco_Lgr            = isset($endereco->Endereco_Lgr)          ? $endereco->Endereco_Lgr           : $procuraEndereco->Endereco_Lgr;
            $procuraEndereco->Endereco_Nro            = isset($endereco->Endereco_Nro)          ? $endereco->Endereco_Nro           : $procuraEndereco->Endereco_Nro;
            $procuraEndereco->Endereco_Complemento    = isset($endereco->Endereco_Complemento)  ? $endereco->Endereco_Complemento   : $procuraEndereco->Endereco_Complemento;
            $procuraEndereco->Endereco_Bairro         = isset($endereco->Endereco_Bairro)       ? $endereco->Endereco_Bairro        : $procuraEndereco->Endereco_Bairro;
            $procuraEndereco->Endereco_Mun            = isset($endereco->Endereco_Mun)          ? $endereco->Endereco_Mun           : $procuraEndereco->Endereco_Mun;
            $procuraEndereco->Endereco_UF             = isset($endereco->Endereco_UF)           ? $endereco->Endereco_UF            : $procuraEndereco->Endereco_UF;
            $procuraEndereco->Endereco_CEP            = isset($endereco->Endereco_CEP)          ? $endereco->Endereco_CEP           : $procuraEndereco->Endereco_CEP;
            $procuraEndereco->Endereco_Pais           = isset($endereco->Endereco_Pais)         ? $endereco->Endereco_Pais          : $procuraEndereco->Endereco_Pais;
            $procuraEndereco->save();
            
        } catch (\Throwable $th) {
            print 'erro';
        }
    }

    public function atualizaContas(Request $request){
        $contas = $request->contas;
        //dd($request->idcliente);
        if(isset($request->idcliente)){
            $idcliente = $request->idcliente;
        }else{
            $idcliente = Auth::user()->id_cliente;
        }

        foreach ($contas as $conta) {
            if ($conta['agencia'] != '' and $conta['conta'] != '' and $conta['digito'] != '' and $conta['banco'] != '') {
                if($conta['id'] == ''){    
                    $c = new Cliente_Conta();
                    $c->id_cliente = $idcliente;
                    $c->agencia = $conta['agencia'];
                    $c->conta = $conta['conta'];
                    $c->digito = $conta['digito'];
                    $c->banco = $conta['banco'];
                    $c->ativo = 1;
                    $c->save();
                } else {
                    $oldConta = Cliente_Conta::where('id', $conta['id'])->first();
                    $oldConta->agencia = $conta['agencia'];
                    $oldConta->conta = $conta['conta'];
                    $oldConta->digito = $conta['digito'];
                    $oldConta->banco = $conta['banco'];
                    $oldConta->ativo = 1;
                    $oldConta->save();
                }
            }
        }

    }

    public function atualizaSocios(Request $request){
        $data_recebe = json_decode(file_get_contents("php://input"));
        $socio = $data_recebe->socios;
        $idCliente = Auth::user()->id_cliente;
        $endereco = $socio->Address;

        try{
            if ($socio->id == '') {
                try{
                    $newSocio = New Cliente_Socio;

                    $newSocio->id_cliente = $idCliente;
                    $newSocio->cpf = isset($socio->cpf)? $socio->cpf : null;
                    $newSocio->rg = isset($socio->rg)? $socio->rg : null;
                    $newSocio->orgaoEmissor = isset($socio->orgaoEmissor)? $socio->orgaoEmissor : null;
                    $newSocio->nome = isset($socio->nome)? $socio->nome : null;
                    $newSocio->nationality = isset($socio->nationality)? $socio->nationality : null;
                    $newSocio->passport = isset($socio->passport)? $socio->passport : null;
                    $newSocio->birthDate = isset($socio->birthDate)? $socio->birthDate : null;
                    $newSocio->gender = isset($socio->gender)? $socio->gender : null;
                    $newSocio->email = isset($socio->email)? $socio->email : null;
                    $newSocio->estadoCivil = isset($socio->estadoCivil)? $socio->estadoCivil : null;
                    $newSocio->ativo = 1;

                    //conjuge
                    $newSocio->conjuge_cpf = isset($socio->conjuge_cpf)? $socio->conjuge_cpf : null;
                    $newSocio->conjuge_rg = isset($socio->conjuge_rg)? $socio->conjuge_rg : null;
                    $newSocio->conjuge_nome = isset($socio->conjuge_nome)? $socio->conjuge_nome : null;
                    $newSocio->conjuge_nationality = isset($socio->conjuge_nationality)? $socio->conjuge_nationality : null;
                    $newSocio->conjuge_profissao = isset($socio->conjuge_profissao)? $socio->conjuge_profissao : null;
                    $newSocio->conjuge_email = isset($socio->conjuge_email)? $socio->conjuge_email : null;

                    //dd($newSocio);
                    $newSocio->save();

                    print $newSocio->id;

                    //criaçao de endereco
                    $novo_endereco = new Enderecos();
                    $novo_endereco->id_cliente              = $idCliente;
                    $novo_endereco->id_socio                = $newSocio->id;
                    $novo_endereco->tipo                    = 'fisica';
                    $novo_endereco->Endereco_Lgr            = isset($endereco->Endereco_Lgr)          ? $endereco->Endereco_Lgr           : null;
                    $novo_endereco->Endereco_Nro            = isset($endereco->Endereco_Nro)          ? $endereco->Endereco_Nro           : null;
                    $novo_endereco->Endereco_Complemento    = isset($endereco->Endereco_Complemento)  ? $endereco->Endereco_Complemento   : null;
                    $novo_endereco->Endereco_Bairro         = isset($endereco->Endereco_Bairro)       ? $endereco->Endereco_Bairro        : null;
                    $novo_endereco->Endereco_Mun            = isset($endereco->Endereco_Mun)          ? $endereco->Endereco_Mun           : null;
                    $novo_endereco->Endereco_UF             = isset($endereco->Endereco_UF)           ? $endereco->Endereco_UF            : null;
                    $novo_endereco->Endereco_CEP            = isset($endereco->Endereco_CEP)          ? $endereco->Endereco_CEP           : null;
                    $novo_endereco->Endereco_Pais           = isset($endereco->Endereco_Pais)         ? $endereco->Endereco_Pais          : null;
                    $novo_endereco->save();
                    
                } catch (\Throwable $th) {
                    echo $th;
                }
            } else {
                //Update socio->id
                $oldSocio = Cliente_Socio::where('id','=',$socio->id)->first();

                $oldSocio->cpf = isset($socio->cpf)? $socio->cpf : $oldSocio->cpf;
                $oldSocio->rg = isset($socio->rg)? $socio->rg : $oldSocio->rg;
                $oldSocio->orgaoEmissor = isset($socio->orgaoEmissor)? $socio->orgaoEmissor : $oldSocio->orgaoEmissor;
                $oldSocio->nome = isset($socio->nome)? $socio->nome : $oldSocio->nome;
                $oldSocio->nationality = isset($socio->nationality)? $socio->nationality : $oldSocio->nationality;
                $oldSocio->passport = isset($socio->passport)? $socio->passport : $oldSocio->passport;
                $oldSocio->birthDate = isset($socio->birthDate)? $socio->birthDate : $oldSocio->birthDate;
                $oldSocio->gender = isset($socio->gender)? $socio->gender : $oldSocio->gender;
                $oldSocio->email = isset($socio->email)? $socio->email : $oldSocio->email;
                $oldSocio->estadoCivil = isset($socio->estadoCivil)? $socio->estadoCivil : $oldSocio->estadoCivil;
                $oldSocio->ativo = 1;
                
                //conjuge
                $oldSocio->conjuge_cpf = isset($socio->conjuge_cpf)? $socio->conjuge_cpf : $oldSocio->conjuge_cpf;
                $oldSocio->conjuge_rg = isset($socio->conjuge_rg)? $socio->conjuge_rg : $oldSocio->conjuge_rg;
                $oldSocio->conjuge_nome = isset($socio->conjuge_nome)? $socio->conjuge_nome : $oldSocio->conjuge_nome;
                $oldSocio->conjuge_nationality = isset($socio->conjuge_nationality)? $socio->conjuge_nationality : $oldSocio->conjuge_nationality;
                $oldSocio->conjuge_profissao = isset($socio->conjuge_profissao)? $socio->conjuge_profissao : $oldSocio->conjuge_profissao;
                $oldSocio->conjuge_email = isset($socio->conjuge_email)? $socio->conjuge_email : $oldSocio->conjuge_email;
            
                $oldSocio->save();

                print $oldSocio->id;

                $procuraEndereco = Enderecos::where('id_cliente','=',$idCliente)->where('id_socio', '=', $oldSocio->id)->where('tipo', '=', 'fisica')->first();

                $procuraEndereco->Endereco_Lgr            = isset($endereco->Endereco_Lgr)          ? $endereco->Endereco_Lgr           : $procuraEndereco->Endereco_Lgr;
                $procuraEndereco->Endereco_Nro            = isset($endereco->Endereco_Nro)          ? $endereco->Endereco_Nro           : $procuraEndereco->Endereco_Nro;
                $procuraEndereco->Endereco_Complemento    = isset($endereco->Endereco_Complemento)  ? $endereco->Endereco_Complemento   : $procuraEndereco->Endereco_Complemento;
                $procuraEndereco->Endereco_Bairro         = isset($endereco->Endereco_Bairro)       ? $endereco->Endereco_Bairro        : $procuraEndereco->Endereco_Bairro;
                $procuraEndereco->Endereco_Mun            = isset($endereco->Endereco_Mun)          ? $endereco->Endereco_Mun           : $procuraEndereco->Endereco_Mun;
                $procuraEndereco->Endereco_UF             = isset($endereco->Endereco_UF)           ? $endereco->Endereco_UF            : $procuraEndereco->Endereco_UF;
                $procuraEndereco->Endereco_CEP            = isset($endereco->Endereco_CEP)          ? $endereco->Endereco_CEP           : $procuraEndereco->Endereco_CEP;
                $procuraEndereco->Endereco_Pais           = isset($endereco->Endereco_Pais)         ? $endereco->Endereco_Pais          : $procuraEndereco->Endereco_Pais;
                $procuraEndereco->save();

            }
            
        } catch (\Throwable $th) {
            print 'erro';
        }
    }

    public function atualizaCliente(Request $request){
        $data_recebe = json_decode(file_get_contents("php://input"));
        $mainSocio = $data_recebe->mainSocio;
        $idCliente = Auth::user()->id_cliente;
        $endereco = $mainSocio->Address;

        try{
            $empresa = Cliente::where('id', '=', $idCliente)->first();
            
            $empresa->cpf = isset($mainSocio->cpf)? $mainSocio->cpf : $empresa->cpf;
            $empresa->rg = isset($mainSocio->rg)? $mainSocio->rg : $empresa->rg;
            $empresa->orgaoEmissor = isset($mainSocio->orgaoEmissor)? $mainSocio->orgaoEmissor : $empresa->orgaoEmissor;
            $empresa->Name = isset($mainSocio->nome)? $mainSocio->nome : $empresa->Name;
            $empresa->nationality = isset($mainSocio->nationality)? $mainSocio->nationality : $empresa->nationality;
            $empresa->passport = isset($mainSocio->passport)? $mainSocio->passport : $empresa->passport;
            $empresa->BirthDate = isset($mainSocio->birthDate)? $mainSocio->birthDate : $empresa->BirthDate;
            $empresa->Gender = isset($mainSocio->gender)? $mainSocio->gender : $empresa->Gender;
            $empresa->email = isset($mainSocio->email)? $mainSocio->email : $empresa->email;
            $empresa->EstadoCivil = isset($mainSocio->estadoCivil)? $mainSocio->estadoCivil : $empresa->EstadoCivil;
            $empresa->save();

            //Update socio
            $oldSocio = Cliente_Socio::where('id','=',$mainSocio->id)->first();

            $oldSocio->cpf = isset($mainSocio->cpf)? $mainSocio->cpf : $oldSocio->cpf;
            $oldSocio->rg = isset($mainSocio->rg)? $mainSocio->rg : $oldSocio->rg;
            $oldSocio->orgaoEmissor = isset($mainSocio->orgaoEmissor)? $mainSocio->orgaoEmissor : $oldSocio->orgaoEmissor;
            $oldSocio->nome = isset($mainSocio->nome)? $mainSocio->nome : $oldSocio->nome;
            $oldSocio->nationality = isset($mainSocio->nationality)? $mainSocio->nationality : $oldSocio->nationality;
            $oldSocio->passport = isset($mainSocio->passport)? $mainSocio->passport : $oldSocio->passport;
            $oldSocio->birthDate = isset($mainSocio->birthDate)? $mainSocio->birthDate : $oldSocio->birthDate;
            $oldSocio->gender = isset($mainSocio->gender)? $mainSocio->gender : $oldSocio->gender;
            $oldSocio->email = isset($mainSocio->email)? $mainSocio->email : $oldSocio->email;
            $oldSocio->estadoCivil = isset($mainSocio->estadoCivil)? $mainSocio->estadoCivil : $oldSocio->estadoCivil;
            $oldSocio->ativo = 1;
            
            //conjuge
            $oldSocio->conjuge_cpf = isset($mainSocio->conjuge_cpf)? $mainSocio->conjuge_cpf : $oldSocio->conjuge_cpf;
            $oldSocio->conjuge_rg = isset($mainSocio->conjuge_rg)? $mainSocio->conjuge_rg : $oldSocio->conjuge_rg;
            $oldSocio->conjuge_nome = isset($mainSocio->conjuge_nome)? $mainSocio->conjuge_nome : $oldSocio->conjuge_nome;
            $oldSocio->conjuge_nationality = isset($mainSocio->conjuge_nationality)? $mainSocio->conjuge_nationality : $oldSocio->conjuge_nationality;
            $oldSocio->conjuge_profissao = isset($mainSocio->conjuge_profissao)? $mainSocio->conjuge_profissao : $oldSocio->conjuge_profissao;
            $oldSocio->conjuge_email = isset($mainSocio->conjuge_email)? $mainSocio->conjuge_email : $oldSocio->conjuge_email;
        
            $oldSocio->save();

            $procuraEndereco = Enderecos::where('id_cliente','=',$idCliente)->where('id_socio', '=', null)->where('tipo', '=', 'fisica')->first();

            $procuraEndereco->Endereco_Lgr            = isset($endereco->Endereco_Lgr)          ? $endereco->Endereco_Lgr           : $procuraEndereco->Endereco_Lgr;
            $procuraEndereco->Endereco_Nro            = isset($endereco->Endereco_Nro)          ? $endereco->Endereco_Nro           : $procuraEndereco->Endereco_Nro;
            $procuraEndereco->Endereco_Complemento    = isset($endereco->Endereco_Complemento)  ? $endereco->Endereco_Complemento   : $procuraEndereco->Endereco_Complemento;
            $procuraEndereco->Endereco_Bairro         = isset($endereco->Endereco_Bairro)       ? $endereco->Endereco_Bairro        : $procuraEndereco->Endereco_Bairro;
            $procuraEndereco->Endereco_Mun            = isset($endereco->Endereco_Mun)          ? $endereco->Endereco_Mun           : $procuraEndereco->Endereco_Mun;
            $procuraEndereco->Endereco_UF             = isset($endereco->Endereco_UF)           ? $endereco->Endereco_UF            : $procuraEndereco->Endereco_UF;
            $procuraEndereco->Endereco_CEP            = isset($endereco->Endereco_CEP)          ? $endereco->Endereco_CEP           : $procuraEndereco->Endereco_CEP;
            $procuraEndereco->Endereco_Pais           = isset($endereco->Endereco_Pais)         ? $endereco->Endereco_Pais          : $procuraEndereco->Endereco_Pais;
            $procuraEndereco->save();
            
        } catch (\Throwable $th) {
            print 'erro';
        }
    }

    //Conta
    public function contas(Request $request){
        //dd($request->id);
        if(isset($request->id)){
            $idcliente = $request->id;
        }else{
            $idcliente = Auth::user()->id_cliente;
        }

        $contas = Cliente_Conta::where('id_cliente', '=',$idcliente)->get();
        //dd($contas);
        print json_encode($contas);
    }

    public function socios(Request $request){
        if(isset($_GET['id'])){
            $idcliente = $_GET['id'];
        }else{
            $idcliente = Auth::user()->id_cliente;
        }

        $cliente = Cliente::where('id',$idcliente)->first();
        $socios = Cliente_Socio::where('id_cliente', '=', $idcliente)->where('ativo', '=', 1)->where('cpf','!=',$cliente->cpf)->get();
        foreach($socios as $socio) {
            $socio['Address'] = Enderecos::where('id_cliente', '=', $idcliente)->where('id_socio', '=', $socio->id)->first();
            if(isset($socio['Address']['Endereco_Pais']) && $socio['Address']['Endereco_Pais'] == 'Brazil'){
                $socio['Address']['Endereco_Pais'] = 'BRASIL';
            }
        }
        
        print json_encode($socios);
    }

    public function empresa(Request $request){
        $empresa    = Cliente::where('id','=',Auth::user()->id_cliente)->first();
        $empresa['Address'] = Enderecos::where('id_cliente', '=', Auth::user()->id_cliente)->where('tipo', '=', "juridica")->first();

        print json_encode($empresa);
    }

    public function mainSocio(Request $request){
        $cliente    = Cliente::where('id','=',Auth::user()->id_cliente)->first();
        $mainSocio    = Cliente_Socio::where('id_cliente','=',Auth::user()->id_cliente)->where('nome','=',$cliente->Name)->first();
        $mainSocio['Address'] = Enderecos::where('id_cliente', '=', Auth::user()->id_cliente)->where('tipo', '=', "fisica")->where('id_socio', '=', null)->first();

        print json_encode($mainSocio);
    }

    public function user(Request $request){
        $user    = User::where('id','=',Auth::user()->id)->first();
        if(($user->google_id != null && $user->google_id != 'unlinked') || ($user->facebook_id != null && $user->facebook_id != 'unlinked') || ($user->linkedin_id != null && $user->linkedin_id != 'unlinked')){
            $user->redeSocial = 1;
        } else {
            $user->redeSocial = 0;
        }
        print json_encode($user);
    }

    public function updateConta(Request $request){
        $contas = $request->contas;
        //dd($request);
        if(isset($request->idcliente)){
            $idcliente = $request->idcliente;
        }

        $cliente = Cliente::where('id',$idcliente)->first();
        $cliente->etapa = 5;
        $cliente->save();

        // $user = User::where('id_cliente', '=', $cliente->id)->first();
        // $user->ativo = 1;
        // $user->save();

        foreach ($contas as $conta) {
            if (!isset($conta['id']) and $conta['agencia'] != '' and $conta['conta'] != '' and $conta['digito'] != '' and $conta['banco'] != '') {
                $c = new Cliente_Conta();
                $c->id_cliente = $idcliente;
                $c->agencia = $conta['agencia'];
                $c->conta = $conta['conta'];
                $c->digito = $conta['digito'];
                $c->banco = $conta['banco'];
                $c->ativo = 1;
                $c->save();
            }
        }

        $sql_contas = Cliente_Conta::where('id_cliente', $idcliente)->get();
        foreach ($sql_contas as $s) {
            $encontrou = 0;
            foreach ($contas as $conta) {
                if(isset($conta['id'])){
                    if ($s['id'] == $conta['id'] or $conta['id'] == '') {
                        $encontrou = 1;
                    }
                }
            }
            if ($encontrou == 0) {
                $atualiza = Cliente_Conta::find($s['id']);
                $atualiza->ativo = 1;
                $atualiza->save();
            }
        }

        //Cliente Novo
        $cliente = Cliente::where('id','=',$idcliente)->first();
        $data = (['name' => $cliente->Name]);
        if(env('APP_ENV') == 'local') {
            Mail::to('root2@local.com')->send(new NovoUsuario($data));
        } else {
            Mail::to('business@cashtf.com')->send(new NovoUsuario($data));
        }

        //Mail::to('adriano@peexell.com.br')->send(new NovoUsuario($data));
       $sucesso = '{"sucesso" : true}';
       return $sucesso;

    }


    // Consulta no BigData
    public function step1(Request $request,$id, $type){
        //Chamado nos steps, ao confirmar cpf e cnpj
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $cliente = Cliente::where('id','=',$id)->first();
        if($type == "cpf"){
            $array = array("Datasets" => "basic_data", "q" => "doc{ $cliente->cpf }", "AccessToken" => "$TOKEN");
            $url = 'https://bigboost.bigdatacorp.com.br/peoplev2';
            $fisico = ClienteController::realizaChamada($url, $array);
            return $fisico;
        }

        if($type == "cnpj"){
            $array = array("Datasets" => "basic_data", "q" => "doc{ $cliente->cnpj }", "AccessToken" => "$TOKEN");
            $url = 'https://bigboost.bigdatacorp.com.br/companies';
            $juridico = ClienteController::realizaChamada($url, $array);
            return $juridico;
        }
        //dd();
        return view('cliente/steps/confirmar',with(compact('fisico','juridico','id','cliente')));

    }

    // Consulta no BigData para socios e conjuges
    public function consultaCpf(Request $request){
        $data_recebe = json_decode(file_get_contents("php://input"));
        $cpf = $data_recebe->cpf;

        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "basic_data", "q" => "doc{ $cpf }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/peoplev2';
        $fisico = ClienteController::realizaChamada($url, $array);
        return $fisico;
    }

    public function consultaCnpj(Request $request){
        $data_recebe = json_decode(file_get_contents("php://input"));
        $cnpj = $data_recebe->cnpj;

        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "basic_data", "q" => "doc{ $cnpj }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/companies';
        $juridico = ClienteController::realizaChamada($url, $array);
        return $juridico;
    }

    //DADOS PESSOA FISICA + SOCIOS
    public function passo1(Request $request){
        dd($request);


    }

    public function step2(Request $request,$id){        
        $cliente = Cliente::where('id','=',$id)->first();
        return view('cliente/steps/docs',with(compact('id','cliente')));
    }

    public function contratoFaturamento(Request $request){
        //dd($request);
        $type_file = $request->acao;
        $idcliente = $request->id;
        $pdo = DB::connection()->getPdo();
        $data_recebe = json_decode(file_get_contents("php://input"));
        //dd($request->file('item_file')[0]);
        try {
            for($f=0; $f < count($_FILES["item_file"]['name']); $f++){
                if($type_file == 'faturamento'){
                    $caminho = "faturamentos";
                } else if($type_file == 'contrato_social'){
                    $caminho = "contratos";
                } else {
                    $caminho = "alteracoes";
                }

                $name = $request->file('item_file')[0]->getClientOriginalName();
                $name = pathinfo($name);
                //muda o nome do arquivo
                $name = md5($name['filename'] . date('G:i:s')) .'.'. $name['extension'];
                $request->file('item_file')[0]->move(public_path().'/uploads/'.$caminho, $name);

                $cliente_files = new Cliente_files;
                $cliente_files->cliente_id = $idcliente;
                $cliente_files->file_type = $type_file;
                $cliente_files->created_at = date("y-m-d");
                $cliente_files->source = $name;
                $cliente_files->save();
            }   
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function step3(Request $request, $id){
        $cliente = Cliente::where('id','=',$id)->first();

        return view('cliente/steps/socios',with(compact('id','cliente')));
    }

    public function sociosRemove(Request $request) {
        //dd($request);
        Cliente_socio::where('id',$request->id)->delete();
    }

    public function contasRemove(Request $request) {
        Cliente_Conta::where('id',$request->id)->delete();
    }

    public function sociosAdd(Request $request){
            $pdo = DB::connection()->getPdo();
            //$data_recebe = json_decode(file_get_contents("php://input"));
            $socios = $request->socios;

            foreach($socios as $socio){
                if ($socio['id'] == '' and $socio['nome'] != '' and $socio['cpf'] != '') {

                    $sql_insere =  NEW Cliente_socio;
                    $sql_insere->id_cliente = Auth::user()->id_cliente;
                    $sql_insere->nome = $socio['nome'];
                    $sql_insere->cpf = $socio['cpf'];
                    $sql_insere->email = isset($socio['email']) ? $socio['email'] : null;
                    $sql_insere->ativo = 1;
                    $sql_insere->save();
                    $lastInsertId = $sql_insere->id;

                    print $lastInsertId;
                    if(isset($socio['conjuge'][0]['nome']) && isset($socio['conjuge'][0]['cpf'])) {
                        $conjuge = New Conjuge;
                        $conjuge->nome = $socio['conjuge'][0]['nome'];
                        $conjuge->email = $socio['conjuge'][0]['email'];
                        $conjuge->cpf = $socio['conjuge'][0]['cpf'];
                        $conjuge->id_cliente = $lastInsertId;
                        $conjuge->save();
                    }
                }

        }

        $sql_socios = Cliente_Socio::where('id_cliente', Auth::user()->id_cliente)->get();
        foreach ($sql_socios as $s) {
            $encontrou = 0;
            foreach ($socios as $socio) {
                if ($s['id'] == $socio['id'] or $socio['id'] == '') {
                    $encontrou = 1;
                }
            }
            if ($encontrou == 0) {
                $atualiza = Cliente_Socio::find($s['id']);
                $atualiza->ativo = 0;
                $atualiza->save();
            }
        }
    }

    public function documentoSocio(Request $request){
        //$pdo = DB::connection()->getPdo();
        $data_recebe = json_decode(file_get_contents("php://input"));
        //dd($request->files);
        if ($request->files != '') {
                
                $sociocpf          = $request->sociocpf;
                $idcliente        = $request->idcliente;
                $name=$request->file->getClientOriginalName();
                $name = pathinfo($name);
                //muda o nome do arquivo
                $name = md5($name['filename'] . date('G:i:s')) .'.'. $name['extension'];
                $request->file->move(public_path().'/uploads/socios', $name);
                $att_cliente_socio = Cliente_socio::where('id_cliente','=',$idcliente)->where('cpf','=',$sociocpf)->first();
                $att_cliente_socio->update(['documento' => $name]);
            
        }
    }

    public function step4(Request $request, $id){
        $cliente = Cliente::where('id','=',$id)->first();
        return view('cliente/steps/contas',with(compact('id','cliente')));
    }

    public function updateContas(Request $request){
        //dd($request);
        $pdo = DB::connection()->getPdo();
        $data_recebe = json_decode(file_get_contents("php://input"));
        //dd($data_recebe);
        $contas = $data_recebe->contas;
        foreach ($contas as $conta) {
            $existe = Cliente_Conta::where('conta','=',$conta->conta)->first();
            if(count($existe) == 0){
                if ($conta->id == '' and $conta->agencia != '' and $conta->conta != '' and $conta->digito != '' and $conta->banco != '') {
                    $sql_insere = $pdo->prepare('INSERT INTO cliente_conta (id_cliente, agencia, conta, digito, banco, ativo)
                        VALUES (:id_cliente, :agencia, :conta, :digito, :banco, :ativo)');
                    $sql_insere->bindValue(':id_cliente', Auth::user()->id_cliente);
                    $sql_insere->bindValue(':agencia', $conta->agencia);
                    $sql_insere->bindValue(':conta', $conta->conta);
                    $sql_insere->bindValue(':digito', $conta->digito);
                    $sql_insere->bindValue(':banco', $conta->banco);
                    $sql_insere->bindValue(':ativo', 1);
                    $sql_insere->execute();
                }
            }
        }

        $sql_contas = $pdo->prepare('SELECT * FROM cliente_conta WHERE id_cliente = :id_cliente');
        $sql_contas->bindValue(':id_cliente', Auth::user()->id_cliente);
        $sql_contas->execute();
        while ($s = $sql_contas->fetch()) {
            $encontrou = 0;
            foreach ($contas as $conta) {
                if ($s['id'] == $conta->id or $conta->id == '') {
                    $encontrou = 1;
                }
            }
            if ($encontrou == 0) {
                $sql_atualiza = $pdo->prepare('UPDATE cliente_conta SET ativo = 0 WHERE id = :id LIMIT 1');
                $sql_atualiza->bindValue(':id', $s['id']);
                $sql_atualiza->execute();
            }
        }
        //Auth::loginUsingId($usuario->id);
        //return redirect()->route('cliente.index');
    }

    public function deleteConta(Request $request){
        $pdo = DB::connection()->getPdo();
        $data_recebe = json_decode(file_get_contents("php://input"));

        dd($request->input(),$data_recebe);
    }
    public function sucessoCadastro(Request $request){
        $id = User::where('id_cliente','=',$request->id)->first();
        //DD($request->id);
        Auth::loginUsingId($id->id);

        //Linha normalmente não é utilizada mas caso o Auth falhe ela deve cair aqui
        return redirect()->route('cliente.index');
    }

    public function companies(Request $request){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "basic_data", "q" => "doc{ $request->doc }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/companies';
        $data = ClienteController::realizaChamada($url, $array);
        return $data;
    }

    public function peoplev2(Request $request){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "basic_data", "q" => "doc{ $request->doc }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/peoplev2';
        $data = ClienteController::realizaChamada($url, $array);
        return $data;
    }
    
    public function cadastraXml(Request $request){
        $dados = $request->dados;
        $dados['id_cliente_conta'] = $request->conta;
        if(!isset($dados['cobr'])){
            $retorno = '{"retorno": "erro dados cobr"}';
            return $retorno;
        }

        $idsession = $request->session()->get('id');
        if(isset($idsession)){
            $cliente    = Cliente::where('id','=',$idsession)->first();
        }else{
            $cliente    = Cliente::where('id','=',Auth::user()->id_cliente)->first();
        }
        
        
        if($cliente){
            $valor_juros_definido = $cliente->taxa_desagio;
        }else{
            $valor_juros_definido = env('JUROS_DEFINIDO');
        }
        
        // Terminar refatorar
        try {
            $sql_valida_conta = Cliente_Conta::where('id', $dados['id_cliente_conta'])->where('id_cliente', $cliente->id)->first();

            if (!$sql_valida_conta) {
                $retorno = '{"retorno": "erro valida conta"}';
                return $retorno;
            }

            if(isset($dados['dest']['CPF']) && ClienteController::validaCPF($dados['dest']['CPF'])){
                $sql_consulta = Cliente::where('cpf', $dados['dest']['CPF'])->first();
            }else{
                $sql_consulta = Cliente::where('cnpj', $dados['dest']['CNPJ'])->first();
            }
            //dd($sql_consulta);
            if ($sql_consulta) {
                $sql_consulta->tipo       = 'sacado';
                if(isset($dados['dest']['CPF']) && ClienteController::validaCPF($dados['dest']['CPF'])){
                    $sql_consulta->CPF       = $dados['dest']['CPF'];
                }else{
                    $sql_consulta->CNPJ       = $dados['dest']['CNPJ'];
                }
                $sql_consulta->Name       = $dados['dest']['xNome'];
                if(isset($dados['dest']['fone'])) $sql_consulta->telefone   = $dados['dest']['fone'];
                $sql_consulta->save();
                $id_sacado = $sql_consulta->id;
            } else{
                if(isset($dados['dest']['CPF']) && ClienteController::validaCPF($dados['dest']['CPF'])){
                    $sacado = new Cliente();
                    $sacado->tipo       = 'sacado';
                    $sacado->CPF        = $dados['dest']['CPF'];
                    $sacado->Name       = $dados['dest']['xNome'];
                    if(isset($dados['dest']['fone'])) $sacado->telefone   = $dados['dest']['fone'];
                    $sacado->save();
                    $id_sacado = $sacado->id;
                }else{
                    $sacado = new Cliente();
                    $sacado->tipo       = 'sacado';
                    $sacado->CNPJ       = $dados['dest']['CNPJ'];
                    $sacado->Name       = $dados['dest']['xNome'];
                    if(isset($dados['dest']['fone'])) $sacado->telefone   = $dados['dest']['fone'];
                    $sacado->save();
                    $id_sacado = $sacado->id;
                }

                //Adiciona endereço vinculado ao sacado
                $sql_adiciona_endereco = new Enderecos();
                $sql_adiciona_endereco->id_cliente              = $id_sacado;
                $tipo = 'juridica';
                if(isset($dados['dest']['CPF']) && ClienteController::validaCPF($dados['dest']['CPF'])){
                    $tipo = "fisica";
                };
                $sql_adiciona_endereco->tipo                    = $tipo;
                $sql_adiciona_endereco->Endereco_Lgr            = $dados['dest']['xLgr'];
                $sql_adiciona_endereco->Endereco_Nro            = $dados['dest']['nro'];
                $sql_adiciona_endereco->Endereco_Complemento    = $dados['dest']['xCpl'];
                $sql_adiciona_endereco->Endereco_Bairro         = $dados['dest']['xBairro'];
                $sql_adiciona_endereco->Endereco_Mun            = $dados['dest']['xMun'];
                $sql_adiciona_endereco->Endereco_UF             = $dados['dest']['UF'];
                $sql_adiciona_endereco->Endereco_CEP            = $dados['dest']['CEP'];
                $sql_adiciona_endereco->Endereco_Pais           = $dados['dest']['xPais'];
                $sql_adiciona_endereco->save();
            }
            
            //Continuar refatorar
            $sql_solicitacao                            = new Solicitacao();
            $sql_solicitacao->id_solicitante            = $cliente->id;
            $sql_solicitacao->id_sacado                 = $id_sacado;
            $sql_solicitacao->id_status                 = 2;
            $sql_solicitacao->id_cliente_conta          = $dados['id_cliente_conta'];
            $sql_solicitacao->juros                     = $valor_juros_definido;
            $sql_solicitacao->data_gerado               = date('Y-m-d');
            $sql_solicitacao->data_emissao              = $dados['ide']['dhEmi'];
            // $sql_solicitacao->data_movimento            = date('Y-m-d H:i:s');
            $sql_solicitacao->valor_total               = $dados['totalGeral']['totalGeralSimples'] ;
            $sql_solicitacao->tac                       = $dados['totalGeral']['tacSoma'];
            $sql_solicitacao->valor_total_juros         = $dados['totalGeral']['totalGeralJuros'];
            $sql_solicitacao->juros_total               = $dados['totalGeral']['jurosTotal'];
            $sql_solicitacao->arquivo_xml               = $dados['totalGeral']['xml_file'];
            $sql_solicitacao->id_nota                   = $dados['idNota'];
            $sql_solicitacao->nro_bordero               = $dados['totalGeral']['nro_bordero'];
            $sql_solicitacao->save();

            $id_solicitacao = $sql_solicitacao->id;
            $contDup = 1;
            if(isset($dados['cobr'])){
                foreach ($dados['cobr'] as $c) {
                    $sql_salva_parcela                  = new Solicitacao_Parcela();
                    $sql_salva_parcela->id_solicitacao  = $id_solicitacao;
                    if(isset($c['nDup'])){
                        $sql_salva_parcela->numero          = $c['nDup'];
                        $contDup++;
                    }else{
                        $sql_salva_parcela->numero          = $contDup;
                        $contDup++;
                    }
                    $sql_salva_parcela->vencimento      = ClienteController::ReformataData($c['dVenc']);
                    $sql_salva_parcela->valor_parcela   = $c['vDup'];
                    $sql_salva_parcela->valor_juros     = $c['vTotal'];
                    $sql_salva_parcela->juros           = $c['vJuros'];
                    $sql_salva_parcela->save();
                }
            }
            
            //dd($id_solicitacao);
            $destinatario   = Cliente::where('id','=',$cliente->id)->first();
            $url = env('APP_URL').'cliente/solicitacao/'.$sql_solicitacao->id;
            $data = (['name' => $cliente->Name, 'url' => $url]);

            //Mail::to(Auth::user()->email)->send(new Analise($data));


            $retorno = '{"retorno": "sucesso"}';

            return $retorno;
        } catch (\Throwable $th) {
            //dd($th);
            $retorno = '{"retorno": '.$th.'}';

            return $retorno;
        }
    }

    public function emailSucesso(Request $request){
        $idsession = $request->session()->get('id');
        if(isset($idsession)){
            $cliente    = Cliente::where('id','=',$idsession)->first();
        }else{
            $cliente    = Cliente::where('id','=',Auth::user()->id_cliente)->first();
        }
        
        $url = env('APP_URL').'cliente/index';
        $data = (['name' => $cliente->Name, 'url' => $url]);

        if(env('APP_ENV') == 'local') {
            Mail::to('root2@local.com')->send(new Analise($data));
            //Email admin
            Mail::to('root@local.com')->send(new AnaliseAdmin($data));
        } else {
            Mail::to($cliente->email)->send(new Analise($data));
            //Trocar para o email do admin
            Mail::to('root@local.com')->send(new AnaliseAdmin($data));
        }
        
        $retorno = '{"retorno": "sucesso"}';

        return $retorno;
    }

    function ReformataData($data){
        if(isset($data)){
            $data_atual     = explode('/', $data);
            $data_atual     = array_reverse($data_atual);
            $data_reformada = [];
            foreach ($data_atual as $d) {
                $data_reformada[] = trim($d);
            }
            return implode('-', $data_reformada); 
        }else{
            return '';
        }
    } 

    public function testeEndereco(Request $request){
        $data = ClienteController::confirmarEndereco($request->doc);
        return $data;
    }

    public function addEndereco(Request $request){
        $data = ClienteController::confirmarEndereco($request->doc);
        $dados = json_decode($data);
        $pdo = DB::connection()->getPdo();
        //dd($data);
            if(isset($dados->Result[0]->Addresses[0]->AddressMain)){

                $addressObj = ([
                            'Endereco_Lgr' => $dados->Result[0]->Addresses[0]->AddressMain ,
                            'Endereco_Nro' => $dados->Result[0]->Addresses[0]->Number,
                            'Endereco_Complemento'=> $dados->Result[0]->Addresses[0]->Complement,
                            'Endereco_Bairro' => $dados->Result[0]->Addresses[0]->Neighborhood ,
                            'Endereco_Mun' => $dados->Result[0]->Addresses[0]->City,
                            'Endereco_UF' => $dados->Result[0]->Addresses[0]->State ,
                            'Endereco_CEP' => $dados->Result[0]->Addresses[0]->ZipCode,
                            'Endereco_Pais' => $dados->Result[0]->Addresses[0]->Country
                ]);
                // dd( $addressObj);
                $sql_cliente = $pdo->prepare('SELECT * FROM cliente WHERE id = :id_cliente LIMIT 1');
                $sql_cliente->bindValue(':id_cliente', $request->idcliente);
                $sql_cliente->execute();
                //dd($sql_cliente);
                if ($sql_cliente->rowCount() > 0) {
                    $sql_atualiza_cliente = $pdo->prepare(
                        'UPDATE cliente SET 
                            etapa = :etapa,
                            id_status_cliente = :id_status_cliente
                            WHERE id = :id_cliente LIMIT 1'
                    );
                    $sql_atualiza_cliente->bindValue(':etapa', 3);
                    $sql_atualiza_cliente->bindValue(':id_status_cliente', 1);
                    $sql_atualiza_cliente->bindValue(':id_cliente', $request->idcliente);
                    $sql_atualiza_cliente->execute();

                    //Cria endereço fisico
                    $sql_cria_endereco_fisico = $pdo->prepare(
                        'INSERT INTO enderecos (
                            id_cliente,
                            tipo,
                            Endereco_Lgr,
                            Endereco_Nro,
                            Endereco_Complemento,
                            Endereco_Bairro,
                            Endereco_Mun,
                            Endereco_UF,
                            Endereco_CEP,
                            Endereco_Pais
                        ) VALUES (
                            :id_cliente,
                            :tipo,
                            :Endereco_Lgr,
                            :Endereco_Nro,
                            :Endereco_Complemento,
                            :Endereco_Bairro,
                            :Endereco_Mun,
                            :Endereco_UF,
                            :Endereco_CEP,
                            :Endereco_Pais
                        )');
                    $sql_cria_endereco_fisico->bindValue(':id_cliente', $request->idcliente);
                    $sql_cria_endereco_fisico->bindValue(':tipo', 'fisica');
                    $sql_cria_endereco_fisico->bindValue(':Endereco_Lgr', $addressObj['Endereco_Lgr']);
                    $sql_cria_endereco_fisico->bindValue(':Endereco_Nro', $addressObj['Endereco_Nro']);
                    $sql_cria_endereco_fisico->bindValue(':Endereco_Complemento', $addressObj['Endereco_Complemento']);
                    $sql_cria_endereco_fisico->bindValue(':Endereco_Bairro', $addressObj['Endereco_Bairro']);
                    $sql_cria_endereco_fisico->bindValue(':Endereco_Mun', $addressObj['Endereco_Mun']);
                    $sql_cria_endereco_fisico->bindValue(':Endereco_UF', $addressObj['Endereco_UF']);
                    $sql_cria_endereco_fisico->bindValue(':Endereco_CEP', $addressObj['Endereco_CEP']);
                    $sql_cria_endereco_fisico->bindValue(':Endereco_Pais', $addressObj['Endereco_Pais']);
                    $sql_cria_endereco_fisico->execute();
            }else{
                $sql_cria_endereco_fisico = $pdo->prepare(
                    'INSERT INTO enderecos (
                        id_cliente,
                        tipo,
                        Endereco_Lgr,
                        Endereco_Nro,
                        Endereco_Complemento,
                        Endereco_Bairro,
                        Endereco_Mun,
                        Endereco_UF,
                        Endereco_CEP,
                        Endereco_Pais
                    ) VALUES (
                        :id_cliente,
                        :tipo,
                        :Endereco_Lgr,
                        :Endereco_Nro,
                        :Endereco_Complemento,
                        :Endereco_Bairro,
                        :Endereco_Mun,
                        :Endereco_UF,
                        :Endereco_CEP,
                        :Endereco_Pais
                    )');
                $sql_cria_endereco_fisico->bindValue(':id_cliente', $request->idcliente);
                $sql_cria_endereco_fisico->bindValue(':tipo', 'fisica');
                $sql_cria_endereco_fisico->bindValue(':Endereco_Lgr', "");
                $sql_cria_endereco_fisico->bindValue(':Endereco_Nro', "");
                $sql_cria_endereco_fisico->bindValue(':Endereco_Complemento', "");
                $sql_cria_endereco_fisico->bindValue(':Endereco_Bairro', "");
                $sql_cria_endereco_fisico->bindValue(':Endereco_Mun', "");
                $sql_cria_endereco_fisico->bindValue(':Endereco_UF', "");
                $sql_cria_endereco_fisico->bindValue(':Endereco_CEP', "");
                $sql_cria_endereco_fisico->bindValue(':Endereco_Pais', "");
                $sql_cria_endereco_fisico->execute();

                //dd($sql_cria_endereco_fisico);
            }
        }
    }

    public function addEnderecoJuridica(Request $request){
            $data = ClienteController::enderecoJuridica($request->doc);
            $dados = json_decode($data);
            $dados = null;
            $pdo = DB::connection()->getPdo();
            //echo 'teste';
            if(env('APP_ENV') == 'local') {
                $dados = null;
                $exemplo = (object) ['AddressMain' => 'teste',
                    'Number' => 50,
                    'Complement' => 'teste',
                    'Neighborhood' => 'teste',
                    'City' => 'teste',
                    'State' => 'teste',
                    'ZipCode' => 'teste',
                    'Country' => 'teste' ];
                $dados->Result[0]->Addresses[0] = $exemplo;
            }

            //var_dump(json_encode($dados));
            //dd($dados);
            // die();
            if(isset($dados->Result[0]->Addresses[0]->AddressMain)){

                $addressObj = ([
                            'Endereco_Lgr' => $dados->Result[0]->Addresses[0]->AddressMain ,
                            'Endereco_Nro' => $dados->Result[0]->Addresses[0]->Number,
                            'Endereco_Complemento'=> $dados->Result[0]->Addresses[0]->Complement,
                            'Endereco_Bairro' => $dados->Result[0]->Addresses[0]->Neighborhood ,
                            'Endereco_Mun' => $dados->Result[0]->Addresses[0]->City,
                            'Endereco_UF' => $dados->Result[0]->Addresses[0]->State ,
                            'Endereco_CEP' => $dados->Result[0]->Addresses[0]->ZipCode,
                            'Endereco_Pais' => $dados->Result[0]->Addresses[0]->Country
                ]);
                // dd( $addressObj);
                $sql_cliente = $pdo->prepare('SELECT * FROM cliente WHERE id = :id_cliente LIMIT 1');
                $sql_cliente->bindValue(':id_cliente', $request->idcliente);
                $sql_cliente->execute();
                //dd($sql_cliente);
                if ($sql_cliente->rowCount() > 0) {
                    $sql_atualiza_cliente = $pdo->prepare(
                        'UPDATE cliente SET 
                            etapa = :etapa,
                            id_status_cliente = :id_status_cliente
                            WHERE id = :id_cliente LIMIT 1'
                    );
                    $sql_atualiza_cliente->bindValue(':etapa', 3);
                    $sql_atualiza_cliente->bindValue(':id_status_cliente', 1);
                    $sql_atualiza_cliente->bindValue(':id_cliente', $request->idcliente);
                    $sql_atualiza_cliente->execute();

                    //Cria endereço fisico
                    $sql_cria_endereco_juridico = $pdo->prepare(
                        'INSERT INTO enderecos (
                            id_cliente,
                            tipo,
                            Endereco_Lgr,
                            Endereco_Nro,
                            Endereco_Complemento,
                            Endereco_Bairro,
                            Endereco_Mun,
                            Endereco_UF,
                            Endereco_CEP,
                            Endereco_Pais
                        ) VALUES (
                            :id_cliente,
                            :tipo,
                            :Endereco_Lgr,
                            :Endereco_Nro,
                            :Endereco_Complemento,
                            :Endereco_Bairro,
                            :Endereco_Mun,
                            :Endereco_UF,
                            :Endereco_CEP,
                            :Endereco_Pais
                        )');
                    $sql_cria_endereco_juridico->bindValue(':id_cliente', $request->idcliente);
                    $sql_cria_endereco_juridico->bindValue(':tipo', 'juridica');
                    $sql_cria_endereco_juridico->bindValue(':Endereco_Lgr', $addressObj['Endereco_Lgr']);
                    $sql_cria_endereco_juridico->bindValue(':Endereco_Nro', $addressObj['Endereco_Nro']);
                    $sql_cria_endereco_juridico->bindValue(':Endereco_Complemento', $addressObj['Endereco_Complemento']);
                    $sql_cria_endereco_juridico->bindValue(':Endereco_Bairro', $addressObj['Endereco_Bairro']);
                    $sql_cria_endereco_juridico->bindValue(':Endereco_Mun', $addressObj['Endereco_Mun']);
                    $sql_cria_endereco_juridico->bindValue(':Endereco_UF', $addressObj['Endereco_UF']);
                    $sql_cria_endereco_juridico->bindValue(':Endereco_CEP', $addressObj['Endereco_CEP']);
                    $sql_cria_endereco_juridico->bindValue(':Endereco_Pais', $addressObj['Endereco_Pais']);
                    $sql_cria_endereco_juridico->execute();
            }else{
                $sql_cria_endereco_juridico = $pdo->prepare(
                    'INSERT INTO enderecos (
                        id_cliente,
                        tipo,
                        Endereco_Lgr,
                        Endereco_Nro,
                        Endereco_Complemento,
                        Endereco_Bairro,
                        Endereco_Mun,
                        Endereco_UF,
                        Endereco_CEP,
                        Endereco_Pais
                    ) VALUES (
                        :id_cliente,
                        :tipo,
                        :Endereco_Lgr,
                        :Endereco_Nro,
                        :Endereco_Complemento,
                        :Endereco_Bairro,
                        :Endereco_Mun,
                        :Endereco_UF,
                        :Endereco_CEP,
                        :Endereco_Pais
                    )');
                $sql_cria_endereco_juridico->bindValue(':id_cliente', $request->idcliente);
                $sql_cria_endereco_juridico->bindValue(':tipo', 'juridica');
                $sql_cria_endereco_juridico->bindValue(':Endereco_Lgr', "");
                $sql_cria_endereco_juridico->bindValue(':Endereco_Nro', "");
                $sql_cria_endereco_juridico->bindValue(':Endereco_Complemento', "");
                $sql_cria_endereco_juridico->bindValue(':Endereco_Bairro', "");
                $sql_cria_endereco_juridico->bindValue(':Endereco_Mun', "");
                $sql_cria_endereco_juridico->bindValue(':Endereco_UF', "");
                $sql_cria_endereco_juridico->bindValue(':Endereco_CEP', "");
                $sql_cria_endereco_juridico->bindValue(':Endereco_Pais', "");
                $sql_cria_endereco_juridico->execute();
            }

        }

        $array = array('retorno' => 'success');
        print json_encode($array);
    }



    //Pessoa Fisica
    public function confirmarEndereco($doc){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        
        $array = array("Datasets" => "addresses", "q" => "doc{ $doc }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/peoplev2';
        $data = ClienteController::realizaChamada($url, $array);
        //dd($data);
        return $data;
    }

    public function confirmarTelefone(Request $request){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        
        $array = array("Datasets" => "phones", "q" => "doc{ $request->cpf }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/peoplev2';
        $telefone = ClienteController::realizaChamada($url, $array);
    }

    public function scoreFisica(Request $request){
        //dd($request->input());
        
        if(env('APP_ENV') == 'local') {
            $score_fisico = '{"Result":[{"MatchKeys":"doc{41791208878}","CreditData":[{"Origin":"SPC","QueryDate":"2020-03-27T00:00:00","BasicData":{"TaxIdNumber":"41791208878","TaxIdCountry":"Brazil","AlternativeIdNumbers":{"VoterRegistration":""},"Name":"ADRIANO Teste Update","Gender":"M","BirthDate":"1999-10-13T00:00:00","Age":20,"ZodiacSign":"LIBRA","MotherName":"FRANCISCA ALVES DO CARMO","TaxIdStatus":"REGULAR","TaxIdOrigin":"SPC","TaxIdStatusDate":"0001-01-01T00:00:00"},"PersonalRelationships":[{"RelatedEntityName":"FRANCISCA ALVES DO CARMO","RelationshipType":"MOTHER","RelationshipLevel":"DIRECT"}],"Emails":[],"Phones":[],"Addresses":[],"TotalDebts":0.0,"TotalCount":0,"TotalPreviousQueries":1,"PreviousQueries":[{"Origin":"CDL - SAO PAULO / SP","QueryDate":"2020-03-27T00:00:00","Name":"BIG DATA CORP","CityAndState":{"City":"RIO DE JANEIRO","State":"RJ"}}],"Occurrences":[],"Score":{"Name":"SCORE 12 MONTHS","Class":"C","Horizon":"12","Probability":"19.5","Score":"59","ScoreType":"NOT RESTRICTED","Reason":"NAO HA REGISTROS DE DEBITO PARA O CPF: 417.912.088-78. A CADA 100 COMPRADORES CLASSIFICADOS NA CLASSE DE RISCO \"C\", 19 PODERA(AO) APRESENTAR REGISTROS DE INADIMPLENCIA NOS PROXIMOS 12 MESES. ESTA INFORMACAO NAO E RESTRITIVA, MAS DE APOIO A CONCESSAO DE CREDITO.","AdditionalOutputData":{}}}]}],"QueryId":"45911d78-60ec-41cc-abf1-efbd54f65649","ElapsedMilliseconds":25000.0,"Status":{"ondemand_credit_spc_score_12_months":[{"Code":0,"Message":"OK"}]}}';
        } else {
            $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
            $array = array("Datasets" => "ondemand_credit_spc_score_12_months", "q" => "doc{ $request->cpf }", "AccessToken" => "$TOKEN");
            $url = 'https://bigboost.bigdatacorp.com.br/peoplev2';
            $score_fisico = ClienteController::realizaChamada($url, $array);
        }
        
        $dados = json_decode($score_fisico);

        if ($dados->Status->ondemand_credit_spc_score_12_months[0]->Code == '-114' && $dados->Status->ondemand_credit_spc_score_12_months[0]->Code == '-1201'){
            //Tratar mensagem de erro em consulta!!
            return redirect()->back();
        }
        
        $registro = Cliente_Spc::where('documento','=',$request->cpf)->get();

        if(count($registro) == 0){
            Cliente_Spc::create([
                'documento' => $request->cpf,
                'name' => $dados->Result[0]->CreditData[0]->BasicData->Name,
                'class' => $dados->Result[0]->CreditData[0]->Score->Class,
                'horizon' => $dados->Result[0]->CreditData[0]->Score->Horizon,
                'probability' => $dados->Result[0]->CreditData[0]->Score->Probability,
                'score' => $dados->Result[0]->CreditData[0]->Score->Score,
                'score_type' => $dados->Result[0]->CreditData[0]->Score->ScoreType,
                'reason' => $dados->Result[0]->CreditData[0]->Score->Reason,
                'ultima_consulta' =>  date('Y-m-d'),
            ]);   
        }else{
            Cliente_Spc::find($registro[0]->id)->update([
                'documento' => $request->cpf,
                'name' => $dados->Result[0]->CreditData[0]->BasicData->Name,
                'class' => $dados->Result[0]->CreditData[0]->Score->Class,
                'horizon' => $dados->Result[0]->CreditData[0]->Score->Horizon,
                'probability' => $dados->Result[0]->CreditData[0]->Score->Probability,
                'score' => $dados->Result[0]->CreditData[0]->Score->Score,
                'score_type' => $dados->Result[0]->CreditData[0]->Score->ScoreType,
                'reason' => $dados->Result[0]->CreditData[0]->Score->Reason,
                'ultima_consulta' =>  date('Y-m-d'),
        ]);
        }
        
        return redirect()->back();
    }

    public function dadosProfissionais(Request $request){
        //dd($request->id);
        
        if(env('APP_ENV') == 'local') {
            $dados = '{"Result":[{"MatchKeys":"doc{42957260875}","ProfessionData":{"Professions":[{"Sector":"PRIVATE - 8299799","Country":"BRAZIL","CompanyIdNumber":"05774280000109","CompanyName":"WG7-CONSULTORIA E TREINAMENTO DE PESSOAL LTDA","Area":"UNKNOWN","Level":"UNKNOWN","Status":"INACTIVE","IncomeRange":"SEM INFORMACAO","Income":0.0,"StartDate":"2015-04-22T00:00:00Z","EndDate":"2016-06-19T00:00:00Z","CreationDate":"2017-09-11T00:00:00Z","LastUpdateDate":"2017-09-11T00:00:00Z"},{"Sector":"PRIVATE - 9511800","Country":"BRAZIL","CompanyIdNumber":"27794843000163","CompanyName":"TIAGO MATOS VOLTA DE ALMEIDA 42957260875","Area":"9511800","Level":"SELF-EMPLOYED","Status":"ACTIVE","IncomeRange":"2 A 4 SM","Income":3000.0,"StartDate":"2017-05-23T00:00:00Z","EndDate":"0001-01-01T00:00:00","CreationDate":"0001-01-01T00:00:00","LastUpdateDate":"2020-02-19T00:00:00Z"}],"TotalProfessions":2,"TotalActiveProfessions":1,"TotalIncome":3000.0,"TotalIncomeRange":"2 A 4 SM","IsEmployed":true}}],"QueryId":"1b0117f3-884b-459d-9726-93ea13526298","ElapsedMilliseconds":45.0,"Status":{"occupation_data":[{"Code":0,"Message":"OK"}]}}';
        } else {
            $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        
            $array = array("Datasets" => "occupation_data", "q" => "doc{ $request->cpf }", "AccessToken" => "$TOKEN");
            $url = 'https://bigboost.bigdatacorp.com.br/peoplev2';
            $dados = ClienteController::realizaChamada($url, $array);
        }
        
        $dados = json_decode($dados);
        //dd($dados);
        if ($dados->Status->occupation_data[0]->Code == '-114' && $dados->Status->occupation_data[0]->Code == '-1201'){
            //Tratar mensagem de erro em consulta!!
            return redirect()->back();
        }
        
        $registro = Dados_Profissionais::where('documento','=',$request->cpf)->get();
            if(isset($dados->Result[0]->ProfessionData->Professions)){
                foreach($dados->Result[0]->ProfessionData->Professions as $profession){
                    //dd($profession);
                    if(count($registro) == 0){ 
                            Dados_Profissionais::create([
                                'documento' => $request->cpf,
                                'Sector' => $profession->Sector,
                                'Country' => $profession->Country,
                                'CompanyIdNumber' => $profession->CompanyIdNumber,
                                'CompanyName' => $profession->CompanyName,
                                'Area' => $profession->Area,
                                'Level' => $profession->Level,
                                'Status' => $profession->Status,
                                'IncomeRange' => $profession->IncomeRange,
                                'Income' => $profession->Income,
                                'StartDate' => $profession->StartDate,
                                'EndDate' => $profession->EndDate,
                                'CreationDate' => $profession->CreationDate,
                                'LastUpdateDate' => date('Y-m-d'),
                                'id_cliente' => $request->id              
                            ]);
                        
                    }else{
                        Dados_Profissionais::find($registro[0]->id)->update([
                            'documento' => $request->cpf,
                            'Sector' => $profession->Sector,
                            'Country' => $profession->Country,
                            'CompanyIdNumber' => $profession->CompanyIdNumber,
                            'CompanyName' => $profession->CompanyName,
                            'Area' => $profession->Area,
                            'Level' => $profession->Level,
                            'Status' => $profession->Status,
                            'IncomeRange' => $profession->IncomeRange,
                            'Income' => $profession->Income,
                            'StartDate' => $profession->StartDate,
                            'EndDate' => $profession->EndDate,
                            'CreationDate' => $profession->CreationDate,
                            'LastUpdateDate' => date('Y-m-d'),
                            'id_cliente' => $request->id 
                        ]);
                    }
                }
            }

        return redirect()->back()->with('etapaFisica', 6);
    }

    public function kycPeople(Request $request){
        
        $array = array("Datasets" => "kyc", "q" => "doc{ $request->cpf }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/peoplev2';
        $kyc_people = ClienteController::realizaChamada($url, $array);
    }

    public function processosJudAdmPeople(Request $request){
        
        $array = array("Datasets" => "processes", "q" => "doc{ $request->cpf }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/peoplev2';
        $proc_jud_adm_people = ClienteController::realizaChamada($url, $array);
    }

    public function relacionamentosEconomicos(Request $request){
        
        $array = array("Datasets" => "business_relationships", "q" => "doc{ $request->cpf }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/peoplev2';
        ClienteController::realizaChamada($url, $array);
    }

    public function relacionamentosPessoais(Request $request){
        
        $array = array("Datasets" => "related_people", "q" => "doc{ $request->cpf }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/peoplev2';
        ClienteController::realizaChamada($url, $array);
    }

    public function infoFinanceira(Request $request){
        
        //dd($data);
        if(env('APP_ENV') == 'local') {
            $data = '{"Result":[{"MatchKeys":"doc{42957260875}","FinantialData":{"TotalAssets":"ABAIXO DE 100K","TaxReturns":[{"Year":"2015","Status":"SALDO INEXISTENTE DE IMPOSTO A PAGAR OU A RESTITUIR","Bank":"","Branch":"0000","Batch":"","IsVipBranch":false,"CaptureDate":"2018-05-28T00:00:00Z","CreationDate":"2018-05-28T00:00:00Z","LastUpdateDate":"2018-05-28T00:00:00Z"},{"Year":"2017","Status":"SALDO INEXISTENTE DE IMPOSTO A PAGAR OU A RESTITUIR","Bank":"","Branch":"0000","Batch":"","IsVipBranch":false,"CaptureDate":"2018-05-01T00:00:00Z","CreationDate":"2018-05-01T00:00:00Z","LastUpdateDate":"2018-05-01T00:00:00Z"},{"Year":"2018","Status":"SALDO INEXISTENTE DE IMPOSTO A PAGAR OU A RESTITUIR","Bank":"","Branch":"0000","Batch":"","IsVipBranch":false,"CaptureDate":"2019-06-18T00:00:00Z","CreationDate":"2019-06-18T00:00:00Z","LastUpdateDate":"2019-06-18T00:00:00Z"},{"Year":"2019","Status":"SALDO INEXISTENTE DE IMPOSTO A PAGAR OU A RESTITUIR","Bank":"","Branch":"0000","Batch":"","IsVipBranch":false,"CaptureDate":"2020-01-27T00:00:00Z","CreationDate":"2020-01-27T00:00:00Z","LastUpdateDate":"2020-01-27T00:00:00Z"}],"IncomeEstimates":{"COMPANY OWNERSHIP":"2 A 4 SM","MTE":"2 A 4 SM","IBGE":"ATE 2 SM","BIGDATA":"SEM INFORMACAO"},"CreationDate":"2017-02-24T00:00:00Z","LastUpdateDate":"2019-12-25T00:00:00Z"}}],"QueryId":"3c0085fa-bdb2-4835-a4e6-d1262cde74bf","ElapsedMilliseconds":37.0,"Status":{"financial_data":[{"Code":0,"Message":"OK"}]}}';
        } else {
            $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
            //dd($request);
            $array = array("Datasets" => "financial_data", "q" => "doc{ $request->cpf }", "AccessToken" => "$TOKEN");
            $url = 'https://bigboost.bigdatacorp.com.br/peoplev2';
            $data = ClienteController::realizaChamada($url, $array);
        }  
        
        $dados = json_decode($data);
        //dd($dados);
        if ($dados->Status->financial_data[0]->Code == '-114' && $dados->Status->financial_data[0]->Code == '-1201'){
            //Tratar mensagem de erro em consulta!!
            return redirect()->back();
        }
        
        if(isset($dados->Result[0]->FinantialData->TaxReturns[0])){
            foreach($dados->Result[0]->FinantialData->TaxReturns as $Tax){
                $registro = Info_Financeira::where('Year','=',$Tax->Year)->where('id_cliente','=',$request->id)->get();
                if(count($registro) == 0){
                    Info_Financeira::create([
                        'id_cliente' => $request->id,
                        'documento' => $request->cpf,
                        'TotalAssets' => $dados->Result[0]->FinantialData->TotalAssets,
                        'Year' => $Tax->Year,
                        'Bank' => $Tax->Bank,
                        'Branch' => $Tax->Branch,
                        'Batch' => $Tax->Batch,
                        'IsVipBranch' => $Tax->IsVipBranch,
                        'Status' => $Tax->Status,
                        'CompanyOwnership' => '',
                        'MTE' =>  $dados->Result[0]->FinantialData->IncomeEstimates->MTE,
                        'IBGE' =>  $dados->Result[0]->FinantialData->IncomeEstimates->IBGE,
                        'BIGDATA' =>  $dados->Result[0]->FinantialData->IncomeEstimates->BIGDATA,
                        'CreationDate' => $dados->Result[0]->FinantialData->CreationDate,
                        'LastUpdateDate' => date('Y-m-d')
                    ]);
                }else{
                    Info_Financeira::find($registro[0]->id)->update([
                        'id_cliente' => $request->id,
                        'documento' => $request->cpf,
                        'TotalAssets' => $dados->Result[0]->FinantialData->TotalAssets,
                        'Year' => $Tax->Year,
                        'Bank' => $Tax->Bank,
                        'Branch' => $Tax->Branch,
                        'Batch' => $Tax->Batch,
                        'IsVipBranch' => $Tax->IsVipBranch,
                        'Status' => $Tax->Status,
                        'CompanyOwnership' => '',
                        'MTE' =>  $dados->Result[0]->FinantialData->IncomeEstimates->MTE,
                        'IBGE' =>  $dados->Result[0]->FinantialData->IncomeEstimates->IBGE,
                        'BIGDATA' =>  $dados->Result[0]->FinantialData->IncomeEstimates->BIGDATA,
                        'CreationDate' => $dados->Result[0]->FinantialData->CreationDate,
                        'LastUpdateDate' => date('Y-m-d')
                    ]);
                }
            }
        }
        
        return redirect()->back()->with('etapaFisica', 7);
    }

    public function veiculos(Request $request){
        
        if(env('APP_ENV') == 'local') {
            $data = '{
            "Result": [
              {
                "MatchKeys": "doc{xxxxxxxxxxx}",
                "vehiclesData": [
                  {
                    "Category": "CARROS",
                    "Brand": "AGRALE",
                    "Model": "MARRUA AM 100 2.8 CS TDI DIESEL",
                    "FipeCode": "0600032",
                    "ModelYear": "2015",
                    "FuelType": "DIESEL",
                    "AvgPrice": "113.114,00",
                    "ReferenceMonth": "FEVEREIRO",
                    "ReferenceYear": "2019",
                    "CreationDate": "2019-03-01T04:33:09Z",
                    "LastUpdateDate": "2019-03-01T04:33:09Z"
                  }
                ]
              }
            ],
            "QueryId": "4376a78e-9658-4134-95fc-b7bad2e3f3e2",
            "ElapsedMilliseconds": 44,
            "Status": {
              "vehicles": [
                {
                  "Code": 0,
                  "Message": "OK"
                }
              ]
            }
          }';
        } else {
            $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
            $array = array("Datasets" => "vehicles", "q" => "doc{ $request->cpf }", "AccessToken" => "$TOKEN");
            $url = 'https://bigboost.bigdatacorp.com.br/peoplev2';
            $data = ClienteController::realizaChamada($url, $array);
        }
        
          $dados = json_decode($data);

          //dd($dados);

        if ($dados->Status->vehicles[0]->Code == '-114' && $dados->Status->vehicles[0]->Code == '-1201'){
            //Tratar mensagem de erro em consulta!!
            return redirect()->back();
        }
        
        $registro = Veiculos::where('documento','=',$request->cpf)->where('id_cliente','=',$request->id)->get();
        if(isset($dados->Result[0]->vehiclesData[0])){
            if(count($registro) == 0){
                Veiculos::create([
                    'id_cliente' => $request->id,
                    'documento' => $request->cpf,
                    'Category' => $dados->Result[0]->vehiclesData[0]->Category,
                    'Brand' => $dados->Result[0]->vehiclesData[0]->Brand,
                    'Model' => $dados->Result[0]->vehiclesData[0]->Model,
                    'FipeCode' => $dados->Result[0]->vehiclesData[0]->FipeCode,
                    'ModelYear' => $dados->Result[0]->vehiclesData[0]->ModelYear,
                    'FuelType' => $dados->Result[0]->vehiclesData[0]->FuelType,
                    'AvgPrice' => $dados->Result[0]->vehiclesData[0]->AvgPrice,
                    'ReferenceMonth' => $dados->Result[0]->vehiclesData[0]->ReferenceMonth,
                    'ReferenceYear' => $dados->Result[0]->vehiclesData[0]->ReferenceYear,
                    'CreationDate' => $dados->Result[0]->vehiclesData[0]->CreationDate,
                    'LastUpdateDate' => date('Y-m-d'),
                ]);
            }else{
                Veiculos::find($registro[0]->id)->update([
                    'id_cliente' => $request->id,
                    'documento' => $request->cpf,
                    'Category' => $dados->Result[0]->vehiclesData[0]->Category,
                    'Brand' => $dados->Result[0]->vehiclesData[0]->Brand,
                    'Model' => $dados->Result[0]->vehiclesData[0]->Model,
                    'FipeCode' => $dados->Result[0]->vehiclesData[0]->FipeCode,
                    'ModelYear' => $dados->Result[0]->vehiclesData[0]->ModelYear,
                    'FuelType' => $dados->Result[0]->vehiclesData[0]->FuelType,
                    'AvgPrice' => $dados->Result[0]->vehiclesData[0]->AvgPrice,
                    'ReferenceMonth' => $dados->Result[0]->vehiclesData[0]->ReferenceMonth,
                    'ReferenceYear' => $dados->Result[0]->vehiclesData[0]->ReferenceYear,
                    'CreationDate' => $dados->Result[0]->vehiclesData[0]->CreationDate,
                    'LastUpdateDate' => date('Y-m-d'),
                ]);
            }
        }
        //return redirect()->back()->with('aviso','Nenhum dado encontrado');
        return redirect()->back()->with('etapaFisica', 11);

    }

    public function antecedentesCriminais(Request $request){
        
        //dd($data);
        if(env('APP_ENV') == 'local') {
            $data = '{"Result":[{"MatchKeys":"doc{42957260875}","OnlineCertificates":[{"Origin":"PFAntecedente","InputParameters":"doc{ 429.572.608-75 }","ProtocolNumber":"20319022020","BaseStatus":"NADA CONSTA","AdditionalOutputData":{"IdNumber":"42957260875","Status":"NADA CONSTA","CertificateNumber":"20319022020","CertificateText":"A Polícia Federal CERTIFICA, após pesquisa no Sistema Nacional de Informações Criminais - SINIC, que até a presente data, NÃO CONSTA decisão judicial condenatória com trânsito em julgado* em nome de TIAGO MATOS VOLTA DE ALMEIDA, nascido(a) aos 30/12/1994","EmissionDate":"15:02 de 15/04/2020","Validity":"90 DAYS","ValidUntil":"14/07/2020","RawData":"https://s3.amazonaws.com/BigDataCorp/BigBoost/Evidences/On_Demand/PfAntecedente/b10ce45a-cc88-4914-86c0-3be667ec7fe5_42957260875.pdf"},"QueryDate":"2020-04-15T18:02:34.0742932Z"}]}],"QueryId":"b10ce45a-cc88-4914-86c0-3be667ec7fe5","ElapsedMilliseconds":30266.0,"Status":{"ondemand_pf_antecedente":[{"Code":0,"Message":"OK"}]}}';
         } else {
            $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
            $array = array("Datasets" => "ondemand_pf_antecedente", "q" => "doc{ $request->cpf }", "AccessToken" => "$TOKEN");
            $url = 'https://bigboost.bigdatacorp.com.br/peoplev2';
            $data = ClienteController::realizaChamada($url, $array);
         }
        
        $dados = json_decode($data);
        //dd($dados);
        if ($dados->Status->ondemand_pf_antecedente[0]->Code == '-114' && $dados->Status->ondemand_pf_antecedente[0]->Code == '-1201'){
            //Tratar mensagem de erro em consulta!!
            return redirect()->back();
        }
        
        $registro = Antecedente_Criminal::where('documento','=',$request->cpf)->where('id_cliente','=',$request->id)->get();
        //dd($dados);
        if(isset($dados->Result[0]->OnlineCertificates[0])){
            if(count($registro) == 0){
                Antecedente_Criminal::create([
                    'id_cliente' => $request->id,
                    'documento' => $request->cpf,
                    'Origin'=> $dados->Result[0]->OnlineCertificates[0]->Origin, 
                    'Status' => $dados->Result[0]->OnlineCertificates[0]->AdditionalOutputData->Status, 
                    'IdNumber' => $dados->Result[0]->OnlineCertificates[0]->AdditionalOutputData->IdNumber,
                    'CertificateText' => $dados->Result[0]->OnlineCertificates[0]->AdditionalOutputData->CertificateText, 
                    'CertificateNumber' => $dados->Result[0]->OnlineCertificates[0]->AdditionalOutputData->CertificateNumber, 
                    'EmissionDate' => $dados->Result[0]->OnlineCertificates[0]->AdditionalOutputData->EmissionDate, 
                    'Validity' => $dados->Result[0]->OnlineCertificates[0]->AdditionalOutputData->Validity,
                    'LastUpdateDate' => date('Y-m-d'),
                ]);
            }else{
                Antecedente_Criminal::find($registro[0]->id)->update([
                    'id_cliente' => $request->id,
                    'documento' => $request->cpf,
                    'Origin'=> $dados->Result[0]->OnlineCertificates[0]->Origin, 
                    'Status' => $dados->Result[0]->OnlineCertificates[0]->AdditionalOutputData->Status, 
                    'IdNumber' => $dados->Result[0]->OnlineCertificates[0]->AdditionalOutputData->IdNumber,
                    'CertificateText' => $dados->Result[0]->OnlineCertificates[0]->AdditionalOutputData->CertificateText, 
                    'CertificateNumber' => $dados->Result[0]->OnlineCertificates[0]->AdditionalOutputData->CertificateNumber, 
                    'EmissionDate' => $dados->Result[0]->OnlineCertificates[0]->AdditionalOutputData->EmissionDate, 
                    'Validity' => $dados->Result[0]->OnlineCertificates[0]->AdditionalOutputData->Validity,
                    'LastUpdateDate' => date('Y-m-d'),
                ]);
            }
        }
        
        return redirect()->back()->with('etapaFisica', 12);
    }

    public function certidaoDebitoFisico(Request $request){
        $array = array("Datasets" => "ondemand_rf_status", "q" => "doc{ $request->cpf }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/peoplev2';
        ClienteController::realizaChamada($url, $array);
    }

    //Pessoa Juridica
    public function scoreJuridica(Request $request){
        //dd($request->input());
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "ondemand_credit_spc_score_12_months", "q" => "doc{ $request->cnpj }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/companies';
        $score_juridico = ClienteController::realizaChamada($url, $array);
        //dd($score_juridico);
        //$score_juridico = '{"Result":[{"MatchKeys":"doc{28955044000194}","CreditData":[{"Origin":"SPC","QueryDate":"2020-03-27T00:00:00","BasicData":{"TaxIdNumber":"28955044000194","TaxIdCountry":"Brazil","AlternativeIdNumbers":{},"OfficialName":"PEEXELL DIGITAL SOLUTIONS Teste","TradeName":"CADASTRO NAO LOCALIZADO","FoundedDate":"2017-10-27T00:00:00","Age":2.0,"TaxIdStatus":"ATIVA","TaxIdOrigin":"SPC","Activities":[{"IsMain":true,"Code":"6201501","Activity":"DESENVOLVIMENTO DE PROGRAMAS DE COMPUTADOR SOB ENCOMENDA"}],"LegalNature":{"Code":"2062","Activity":"SOCIEDADE EMPRESARIA LIMITADA"},"AdditionalOutputData":{"Spelling_0":"PEEXELL DIGITAL SOLUTIONS LTDA ME","Spelling_1":"PEEXELL DIGITAL SOLUTIONS LTDA"}},"Emails":[],"Phones":[],"Addresses":[{"AddressMain":"AL CAMBUCI","Number":"000076","Complement":"","Neighborhood":"RESIDENCIAL FLORESTA SAO VICENTE","ZipCode":"12919520","City":"BRAGANCA PAULISTA","State":"SP","Country":"Brazil","OwnHeadquarters":false}],"TotalDebts":0.0,"TotalCount":0,"TotalPreviousQueries":2,"PreviousQueries":[{"Origin":"SERASA EXPERIAN","QueryDate":"2020-02-05T00:00:00","Name":"DESENVOLVE SP","CityAndState":{"City":"SAO PAULO","State":"SP","OwnHeadquarters":false}},{"Origin":"SERASA EXPERIAN","QueryDate":"2020-01-02T00:00:00","Name":"CEF","CityAndState":{"City":"BRASILIA","State":"DF","OwnHeadquarters":false}}],"Occurrences":[],"Score":{"Name":"SCORE 12 MONTHS","Class":"A","Horizon":"12","Probability":"2.92609754669197","Score":"92","ScoreType":"NEW","Reason":"NAO HA REGISTROS DE DEBITO PARA O CNPJ: 28.955.044/0001-94. A CADA 100 COMPRADORES CLASSIFICADOS NA CLASSE DE RISCO \"A\", 2 PODERA(AO) APRESENTAR REGISTROS DE INADIMPLENCIA NOS PROXIMOS 12 MESES. ESTA INFORMACAO NAO E RESTRITIVA, MAS DE APOIO A CONCESSAO DE CREDITO.","AdditionalOutputData":{}}}]}],"QueryId":"72baa873-b86b-4735-a85b-d6ececf5dab8","ElapsedMilliseconds":26003.0,"Status":{"ondemand_credit_spc_score_12_months":[{"Code":0,"Message":"OK"}]}}';
        $dados = json_decode($score_juridico);
        //dd($dados);
        if ($dados->Status->ondemand_credit_spc_score_12_months[0]->Code == '-114' && $dados->Status->ondemand_credit_spc_score_12_months[0]->Code == '-1201'){
            //Tratar mensagem de erro em consulta!!
            return redirect()->back();
        }
        
        $registro = Cliente_Spc::where('documento','=',$request->cnpj)->get();
        
        if(count($registro) == 0){
            Cliente_Spc::create([
                'documento' => $request->cnpj,
                'name' => $dados->Result[0]->CreditData[0]->BasicData->OfficialName,
                'class' => $dados->Result[0]->CreditData[0]->Score->Class,
                'horizon' => $dados->Result[0]->CreditData[0]->Score->Horizon,
                'probability' => $dados->Result[0]->CreditData[0]->Score->Probability,
                'score' => $dados->Result[0]->CreditData[0]->Score->Score,
                'score_type' => $dados->Result[0]->CreditData[0]->Score->ScoreType,
                'reason' => $dados->Result[0]->CreditData[0]->Score->Reason,
                'ultima_consulta' =>  date('Y-m-d'),
            ]);   
        }else{
            Cliente_Spc::find($registro[0]->id)->update([
                'documento' => $request->cnpj,
                'name' => $dados->Result[0]->CreditData[0]->BasicData->OfficialName,
                'class' => $dados->Result[0]->CreditData[0]->Score->Class,
                'horizon' => $dados->Result[0]->CreditData[0]->Score->Horizon,
                'probability' => $dados->Result[0]->CreditData[0]->Score->Probability,
                'score' => $dados->Result[0]->CreditData[0]->Score->Score,
                'score_type' => $dados->Result[0]->CreditData[0]->Score->ScoreType,
                'reason' => $dados->Result[0]->CreditData[0]->Score->Reason,
                'ultima_consulta' =>  date('Y-m-d'),
        ]);
        }

        return redirect()->back();
    }

    public function enderecoJuridica($doc){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "addresses", "q" => "doc{ $doc }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/companies';
        $data = ClienteController::realizaChamada($url, $array);

        //dd($data);
        return $data;
    }

    public function enderecoJuridicaFields(Request $request){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "addresses_extended", "q" => "doc{ $request->doc }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/companies';
        $data = ClienteController::realizaChamada($url, $array);

        return $data;
    }
    
    public function grupoEconomicoCompleto(Request $request){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "economic_group_full", "q" => "doc{ $request->cnpj }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/companies';
        $data = ClienteController::realizaChamada($url, $array);

        $dados = json_decode($data);
    }
    
    public function grupoEconomicoCompletoXtn(Request $request){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "economic_group_full_extended", "q" => "doc{ $request->cnpj }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/companies';
        $data = ClienteController::realizaChamada($url, $array);

        $dados = json_decode($data);
    }

    public function grupoEconomicoN1(Request $request){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "economic_group_first_level", "q" => "doc{ $request->cnpj }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/companies';
        $data = ClienteController::realizaChamada($url, $array);

        $dados = json_decode($data);
    }

    public function grupoEconomicoN1Xnt(Request $request){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "economic_group_first_level_extended", "q" => "doc{ $request->cnpj }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/companies';
        $data = ClienteController::realizaChamada($url, $array);

        $dados = json_decode($data);
    }

    public function grupoEconomicoN2(Request $request){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "economic_group_second_level", "q" => "doc{ $request->cnpj }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/companies';
        $data = ClienteController::realizaChamada($url, $array);

        $dados = json_decode($data);
    }
    public function grupoEconomicoN2Xtn(Request $request){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "economic_group_second_level_extended", "q" => "doc{ $request->cnpj }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/companies';
        $data = ClienteController::realizaChamada($url, $array);

        $dados = json_decode($data);
    }
    public function grupoEconomicoN3(Request $request){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "economic_group_third_level", "q" => "doc{ $request->cnpj }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/companies';
        $data = ClienteController::realizaChamada($url, $array);

        $dados = json_decode($data);
    }
    public function grupoEconomicoN3Xtn(Request $request){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "economic_group_third_level_extended", "q" => "doc{ $request->cnpj }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/companies';
        $data = ClienteController::realizaChamada($url, $array);

        $dados = json_decode($data);
    }
    public function indicadorAtividade(Request $request){
       
        if(env('APP_ENV') == 'local') {
            $data = '{"Result":[{"MatchKeys":"doc{90581604000161}","ActivityIndicators":{"EmployeesRange":"SEM VINCULOS","IncomeRange":"EMPRESA NAO ATIVA","HasActivity":false,"ActivityLevel":0.0,"FirstLevelEconomicGroupAverageActivityLevel":0.0,"FirstLevelEconomicGroupMaxActivityLevel":0.0,"FirstLevelEconomicGroupMinActivityLevel":0.0,"HasRecentAddress":false,"HasRecentPhone":false,"HasRecentEmail":false,"HasRecentPassages":false,"HasActiveDomain":false,"HasActiveSSL":false,"HasCorporateEmail":false,"NumberOfBranches":0}}],"QueryId":"7cca3b81-6cc8-4154-97e5-8f8787beb6ea","ElapsedMilliseconds":39.0,"Status":{"activity_indicators":[{"Code":0,"Message":"OK"}]}}';
        } else {
            $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
            $array = array("Datasets" => "activity_indicators", "q" => "doc{ $request->cnpj }", "AccessToken" => "$TOKEN");
            $url = 'https://bigboost.bigdatacorp.com.br/companies';
            $data = ClienteController::realizaChamada($url, $array);
        }
        
        //dd($data);
        $dados = json_decode($data);
        //dd($dados);

        if ($dados->Status->activity_indicators[0]->Code == '-114' && $dados->Status->activity_indicators[0]->Code == '-1201'){
            //Tratar mensagem de erro em consulta!!
            return redirect()->back();
        }
        
        $registro = Indicador_Atividade::where('documento','=',$request->cnpj)->get();
        
        if(count($registro) == 0){
            Indicador_Atividade::create([
                'id_cliente' => $request->id,
                'documento' => $request->cnpj,
                'EmployeesRange' => $dados->Result[0]->ActivityIndicators->EmployeesRange,
                'IncomeRange' => $dados->Result[0]->ActivityIndicators->IncomeRange,
                'HasActivity' => $dados->Result[0]->ActivityIndicators->HasActivity,
                'ActivityLevel' => $dados->Result[0]->ActivityIndicators->ActivityLevel,
                'FirstLevelEconomicGroupAverageActivityLevel' => $dados->Result[0]->ActivityIndicators->FirstLevelEconomicGroupAverageActivityLevel,
                'FirstLevelEconomicGroupMaxActivityLevel' => $dados->Result[0]->ActivityIndicators->FirstLevelEconomicGroupMaxActivityLevel,
                'FirstLevelEconomicGroupMinActivityLevel' => $dados->Result[0]->ActivityIndicators->FirstLevelEconomicGroupMinActivityLevel,
                'HasRecentAddress' => $dados->Result[0]->ActivityIndicators->HasRecentAddress,
                'HasRecentPhone' => $dados->Result[0]->ActivityIndicators->HasRecentPhone,
                'HasRecentEmail' => $dados->Result[0]->ActivityIndicators->HasRecentEmail,
                'HasRecentPassages' => $dados->Result[0]->ActivityIndicators->HasRecentPassages,
                'HasActiveDomain' => $dados->Result[0]->ActivityIndicators->HasActiveDomain,
                'HasActiveSSL' => $dados->Result[0]->ActivityIndicators->HasActiveSSL,
                'HasCorporateEmail' => $dados->Result[0]->ActivityIndicators->HasCorporateEmail,
                'NumberOfBranches' => $dados->Result[0]->ActivityIndicators->NumberOfBranches,
                'LastUpdateDate'  => date('Y-m-d'),
            ]);   
        }else{
            Indicador_Atividade::find($registro[0]->id)->update([
                'id_cliente' => $request->id,
                'documento' => $request->cnpj,
                'EmployeesRange' => $dados->Result[0]->ActivityIndicators->EmployeesRange,
                'IncomeRange' => $dados->Result[0]->ActivityIndicators->IncomeRange,
                'HasActivity' => $dados->Result[0]->ActivityIndicators->HasActivity,
                'ActivityLevel' => $dados->Result[0]->ActivityIndicators->ActivityLevel,
                'FirstLevelEconomicGroupAverageActivityLevel' => $dados->Result[0]->ActivityIndicators->FirstLevelEconomicGroupAverageActivityLevel,
                'FirstLevelEconomicGroupMaxActivityLevel' => $dados->Result[0]->ActivityIndicators->FirstLevelEconomicGroupMaxActivityLevel,
                'FirstLevelEconomicGroupMinActivityLevel' => $dados->Result[0]->ActivityIndicators->FirstLevelEconomicGroupMinActivityLevel,
                'HasRecentAddress' => $dados->Result[0]->ActivityIndicators->HasRecentAddress,
                'HasRecentPhone' => $dados->Result[0]->ActivityIndicators->HasRecentPhone,
                'HasRecentEmail' => $dados->Result[0]->ActivityIndicators->HasRecentEmail,
                'HasRecentPassages' => $dados->Result[0]->ActivityIndicators->HasRecentPassages,
                'HasActiveDomain' => $dados->Result[0]->ActivityIndicators->HasActiveDomain,
                'HasActiveSSL' => $dados->Result[0]->ActivityIndicators->HasActiveSSL,
                'HasCorporateEmail' => $dados->Result[0]->ActivityIndicators->HasCorporateEmail,
                'NumberOfBranches' => $dados->Result[0]->ActivityIndicators->NumberOfBranches,
                'LastUpdateDate'  => date('Y-m-d'),
        ]);
        }
        
        return redirect()->back()->with('etapaJuridica', 7);
    }

    public function kycComp(Request $request){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "kyc", "q" => "doc{ $request->cnpj }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/companies';
        $data = ClienteController::realizaChamada($url, $array);

        $dados = json_decode($data);
    }
    public function kycCompFunc(Request $request){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "employees_kyc", "q" => "doc{ $request->cnpj }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/companies';
        $data = ClienteController::realizaChamada($url, $array);

        $dados = json_decode($data);
    }
    public function kycCompSocios(Request $request){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "owners_kyc", "q" => "doc{ $request->cnpj }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/companies';
        $data = ClienteController::realizaChamada($url, $array);

        $dados = json_decode($data);
    }
    public function procJudAdm(Request $request){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "processes", "q" => "doc{ $request->cnpj }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/companies';
        $data = ClienteController::realizaChamada($url, $array);

        $dados = json_decode($data);    }
    public function procJudSocios(Request $request){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "owners_lawsuits", "q" => "doc{ $request->cnpj }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/companies';
        $data = ClienteController::realizaChamada($url, $array);

        $dados = json_decode($data);
    }
    public function relacionamentos(Request $request){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "relationships", "q" => "doc{ $request->cnpj }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/companies';
        $data = ClienteController::realizaChamada($url, $array);

        $dados = json_decode($data);
    }
    public function simplesNacional(Request $request){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "ondemand_simples", "q" => "doc{ $request->cnpj }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/companies';
        $data = ClienteController::realizaChamada($url, $array);

        $dados = json_decode($data);
    }
    public function representanteLegal(Request $request){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "ondemand_legal_representative", "q" => "doc{ $request->cnpj }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/companies';
        $data = ClienteController::realizaChamada($url, $array);

        $dados = json_decode($data);
    }
    public function certidaoDebitoJuridico(Request $request){
        $TOKEN = 'cd741022-66c0-45ec-80f5-e1001115adac';
        $array = array("Datasets" => "ondemand_rf_status", "q" => "doc{ $request->cnpj }", "AccessToken" => "$TOKEN");
        $url = 'https://bigboost.bigdatacorp.com.br/companies';
        $data = ClienteController::realizaChamada($url, $array);

        $dados = json_decode($data);
    }




    function realizaChamada($url, $array){
        if(env('APP_ENV') === 'local') {
            if($url == 'https://bigboost.bigdatacorp.com.br/peoplev2') {
                $dados = '{"Result":[{"MatchKeys":"doc{41791208878}","BasicData":{"TaxIdNumber":"41791208878","TaxIdCountry":"BRAZIL","AlternativeIdNumbers":{},"Name":"NOME USUÁRIO","Aliases":{"CommonName":"ADRIANO SOUSA","StandardizedName":"ADRIANO XRISTIAM ALVE SOUSA"},"Gender":"M","NameWordCount":5,"NameUniquenessScore":1.0,"FirstNameUniquenessScore":0.001,"FirstAndLastNameUniquenessScore":0.001,"BirthDate":"1999-10-14T00:00:00Z","Age":20,"ZodiacSign":"LIBRA","ChineseSign":"Rabbit","BirthCountry":"BRASILEIRA","BirthState":"SP","MotherName":"NOME MAE","FatherName":"NOME PAI","TaxIdStatus":"REGULAR","TaxIdOrigin":"RECEITA FEDERAL","HasObitIndication":false,"TaxIdStatusDate":"2020-02-04T00:00:00Z","CreationDate":"2016-08-23T00:00:00Z","LastUpdateDate":"2020-02-04T00:00:00Z"}}],"QueryId":"390da3c1-fdc9-4214-8d36-113fcf6e9596","ElapsedMilliseconds":28.0,"Status":{"basic_data":[{"Code":0,"Message":"OK"}]}}';
            } else if($url == 'https://bigboost.bigdatacorp.com.br/companies') {
                $dados = '{"Result":[{"MatchKeys":"doc{28955044000194}","BasicData":{"TaxIdNumber":"28955044000194","TaxIdCountry":"Brazil","AlternativeIdNumbers":{},"OfficialName":"PEEXELL - DIGITAL SOLUTIONS LTDA","TradeName":"PEEXELL","Aliases":{},"NameUniquenessScore":1.0,"OfficialNameUniquenessScore":1.0,"TradeNameUniquenessScore":-1.0,"FoundedDate":"2017-10-27T00:00:00Z","Age":2.0,"IsHeadquarter":true,"HeadquarterState":"SP","TaxIdStatus":"ATIVA","TaxIdOrigin":"Receita Federal","TaxIdStatusDate":"2020-02-14T00:00:00Z","TaxIdStatusRegistrationDate":"2017-10-27T00:00:00Z","TaxRegime":"SIMPLES","TaxRegimes":{"Simples":true},"Activities":[{"IsMain":true,"Code":"6201501","Activity":"DESENVOLVIMENTO DE PROGRAMAS DE COMPUTADOR SOB ENCOMENDA"},{"IsMain":false,"Code":"6202300","Activity":"DESENVOLVIMENTO E LICENCIAMENTO DE PROGRAMAS DE COMPUTADOR CUSTOMIZAVEIS"},{"IsMain":false,"Code":"6203100","Activity":"DESENVOLVIMENTO E LICENCIAMENTO DE PROGRAMAS DE COMPUTADOR NAO CUSTOMIZAVEIS"},{"IsMain":false,"Code":"7319099","Activity":"OUTRAS ATIVIDADES DE PUBLICIDADE NAO ESPECIFICADAS ANTERIORMENTE"}],"LegalNature":{"Code":"2062","Activity":"SOCIEDADE EMPRESARIA LIMITADA"},"CreationDate":"2018-08-16T00:00:00Z","LastUpdateDate":"2020-02-20T00:00:00Z","AdditionalOutputData":{"Capital":"TRINTA MIL REAIS","CapitalRS":"30000.00"}}}],"QueryId":"60973a3f-06a4-48a6-98a5-0af74ff3ecb7","ElapsedMilliseconds":140.0,"Status":{"basic_data":[{"Code":0,"Message":"OK"}]}}';
            }
        } else {
            $json = json_encode($array);
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $dados = curl_exec($ch);
        }
        return $dados;
    }

    function SobeArquivo($nomeimg, $nomeimg_temp, $pasta){
		$imagem 		= $nomeimg; 		//$_FILES['txtimagem']['name'];
		$imgtemp 		= $nomeimg_temp; 	//$_FILES['txtimagem']['tmp_name']; 
		$file_info = pathinfo($imagem);
		$novonome = md5($imagem . date('G:i:s')) .'.'. $file_info['extension'];
		$destino = $pasta . $novonome;
	
		// Converte a extensão para minúsculo
		$extensao = strtolower ( $file_info['extension'] );
	
		if(strstr('.doc;.pdf;.jpeg;.jpg', $extensao)){
			if(move_uploaded_file($imgtemp, $destino)){
				return $novonome;
			}else{
				return null;
			}
		}else{
			return null;
		}
	}



    function validaCNPJ($cnpj = null) {

        // Verifica se um número foi informado
        if(empty($cnpj)) {
            return false;
        }
    
        // Elimina possivel mascara
        $cnpj = preg_replace("/[^0-9]/", "", $cnpj);
        $cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);
        
        // Verifica se o numero de digitos informados é igual a 11 
        if (strlen($cnpj) != 14) {
            return false;
        }
        
        // Verifica se nenhuma das sequências invalidas abaixo 
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cnpj == '00000000000000' || 
            $cnpj == '11111111111111' || 
            $cnpj == '22222222222222' || 
            $cnpj == '33333333333333' || 
            $cnpj == '44444444444444' || 
            $cnpj == '55555555555555' || 
            $cnpj == '66666666666666' || 
            $cnpj == '77777777777777' || 
            $cnpj == '88888888888888' || 
            $cnpj == '99999999999999') {
            return false;
            
         // Calcula os digitos verificadores para verificar se o
         // CPF é válido
         } else {   
         
            $j = 5;
            $k = 6;
            $soma1 = 0;
            $soma2 = 0;
    
            for ($i = 0; $i < 13; $i++) {
    
                $j = $j == 1 ? 9 : $j;
                $k = $k == 1 ? 9 : $k;
    
                $soma2 += ($cnpj[$i] * $k);
    
                if ($i < 12) {
                    $soma1 += ($cnpj[$i] * $j);
                }
    
                $k--;
                $j--;
    
            }
    
            $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
            $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;
    
            return (($cnpj[12] == $digito1) and ($cnpj[13] == $digito2));
         
        }
    }
    
    function validaCPF($cpf = null) {
    
        // Verifica se um número foi informado
        if(empty($cpf)) {
            return false;
        }
    
        // Elimina possivel mascara
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
        
        // Verifica se o numero de digitos informados é igual a 11 
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se nenhuma das sequências invalidas abaixo 
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cpf == '00000000000' || 
            $cpf == '11111111111' || 
            $cpf == '22222222222' || 
            $cpf == '33333333333' || 
            $cpf == '44444444444' || 
            $cpf == '55555555555' || 
            $cpf == '66666666666' || 
            $cpf == '77777777777' || 
            $cpf == '88888888888' || 
            $cpf == '99999999999') {
            return false;
         // Calcula os digitos verificadores para verificar se o
         // CPF é válido
         } else {   
            
            for ($t = 9; $t < 11; $t++) {
                
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    return false;
                }
            }
    
            return true;
        }
    }
}
