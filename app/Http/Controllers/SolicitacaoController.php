<?php

namespace App\Http\Controllers;

use App\Mail\Aprovado;
use App\Mail\Recusado;
use App\Mail\Analise;
use App\Mail\Credito;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Solicitacao;
use App\Enderecos;
use App\Veiculos;
use App\Cliente;
use App\Cliente_Spc;
use App\Cliente_Conta;
use App\Solicitacao_Parcela;
use App\Dados_Profissionais;
use App\Info_Financeira;
use App\User;
use App\Conjuge;
use App\Cliente_Socio;
use App\Antecedente_Criminal;
use App\Indicador_Atividade;
use App\Boleto;
use Auth;
use PDF;
use Storage;


class SolicitacaoController extends Controller
{
    public function index(){
        if(Auth::user()->tipo != 'admin'){
            $solicitacoes = Solicitacao::select('solicitacao.*','cliente.OfficialName as nome_solicitante','cliente.Name as nome_sacado','status.nome as nome_status')
            ->leftJoin('cliente','cliente.id','solicitacao.id_solicitante')
            ->leftJoin('status','status.id','solicitacao.id_status')
            ->where('id_solicitante','=', Auth::user()->id_cliente)
            ->paginate(10)->appends(request()->query());

            foreach($solicitacoes as $s){
                $s['data_gerado'] = SolicitacaoController::FormataData($s['data_gerado']);
                $nome_novo          = Cliente::where('id',$s->id_sacado)->first();
                $one = $s->valor_total;
                $two = $s->valor_total_juros;
                $new = str_replace('.', '', $one);
                $new = str_replace(',', '.', $new);
                $new2 = str_replace('.', '', $two);
                $new2 = str_replace(',', '.', $new2);
                $novo = $new - $new2;
                $s->desagio ='R$'.number_format($novo, 2, ',', '.');
                $s->valor_total     = 'R$ '.$s->valor_total;
                $s->valor_total_juros     = 'R$ '.$s->valor_total_juros;
                $s->juros_total     = 'R$ '.$s->juros_total;
                if(isset($nome_novo)){
                    $s->sacado_nome     = $nome_novo->Name;
                }else{
                    $s->sacado_nome     = "NOME NÃO INFORMADO";
                }
            }
            //dd($solicitacoes);
            //Falta formatar a data que ta sendo retornada
            return view('partials/bordero_cliente',with(compact('solicitacoes')));

        }else{
            $solicitacoes = Solicitacao::select('solicitacao.*','cliente.OfficialName as nome_solicitante','cliente.Name as nome_sacado','status.nome as nome_status')
            ->leftJoin('cliente','cliente.id','solicitacao.id_solicitante')
            ->leftJoin('status','status.id','solicitacao.id_status')
            ->paginate(10);

            foreach($solicitacoes as $s){
                $s['data_gerado'] = SolicitacaoController::FormataData($s['data_gerado']);
                $nome_novo          = Cliente::where('id',$s->id_sacado)->first();
                $one = $s->valor_total;
                $two = $s->valor_total_juros;
                $new = str_replace('.', '', $one);
                $new = str_replace(',', '.', $new);
                $new2 = str_replace('.', '', $two);
                $new2 = str_replace(',', '.', $new2);
                $novo = $new - $new2;
                $s->desagio = 'R$'.number_format($novo, 2, ',', '.');
                $s->valor_total     = 'R$'.$s->valor_total;
                $s->valor_total_juros     = 'R$'.$s->valor_total_juros;

                if(isset($nome_novo)){
                    $s->sacado_nome     = $nome_novo->Name;
                }else{
                    $s->sacado_nome     = "NOME NÃO INFORMADO";
                }
            }
            //dd($solicitacoes);
            //Falta formatar a data que ta sendo retornada
            return view('admin/solicitacoes',with(compact('solicitacoes')));
        }
    }

    public function boleto($id){
        //dd($id);
        //Informações da Solicitação 
        $solicitacao = Solicitacao::select('solicitacao.*','cliente.Name as nome_sacador','cliente.limite_credito as credito',
            'cliente.OfficialName as nome_empresa_sacador')
            ->leftJoin('cliente','cliente.id','solicitacao.id_solicitante')
            ->where('solicitacao.id','=',$id)
            ->first();

        $conta = Cliente_Conta::where('id',$solicitacao->id_cliente_conta)->first();

        if($solicitacao){
            //Informações do Solicitante
            $solicitante       = Cliente::where('id','=',$solicitacao->id_solicitante)->get();
            if(count($solicitante) == 0){
               $solicitante = null;
            }

            //Informações Sacado
            $sacado = Cliente::where('id','=',$solicitacao->id_sacado)->get();

            if(count($sacado) == 0){
                $sacado = null;
            }

            $parcelas       = Solicitacao_Parcela::where('id_solicitacao','=',$id)->get();
            foreach($parcelas as $p){
                $p['vencimento'] = SolicitacaoController::FormataData($p['vencimento']);
            }
            $valor_total 	= '';
            $juros 			= '';
        }
        //dd($parcelas);
        return view('partials/enviar_boletos')->with(compact('parcelas','sacado','solicitacao'));
    }

    public function boletoStatus($id){
        //dd($id);
        //Informações da Solicitação 
        $solicitacao = Solicitacao::select('solicitacao.*','cliente.Name as nome_sacador','cliente.limite_credito as credito',
            'cliente.OfficialName as nome_empresa_sacador')
            ->leftJoin('cliente','cliente.id','solicitacao.id_solicitante')
            ->where('solicitacao.id','=',$id)
            ->first();

        $conta = Cliente_Conta::where('id',$solicitacao->id_cliente_conta)->first();

        if($solicitacao){
            //Informações do Solicitante
            $solicitante       = Cliente::where('id','=',$solicitacao->id_solicitante)->get();
            if(count($solicitante) == 0){
               $solicitante = null;
            }

            //Informações Sacado
            $sacado = Cliente::where('id','=',$solicitacao->id_sacado)->get();

            if(count($sacado) == 0){
                $sacado = null;
            }

            $parcelas       = Solicitacao_Parcela::where('id_solicitacao','=',$id)->get();
            foreach($parcelas as $p){
                $p['vencimento']    = SolicitacaoController::FormataData($p['vencimento']);
                $boleto             = Boleto::where('id_parcela',$p->id)->first(['status']);
                $p['status']        = $boleto->status;
            }
            $valor_total 	= '';
            $juros 			= '';
        }


        //dd($parcelas);
        return view('partials/boletos')->with(compact('parcelas','sacado','solicitacao'));
    }

    public function filtros(Request $request){
        $paginas = $request->input('paginas');
        if($paginas == null){
            $paginas = 10;
        }
        $procure = $request->input('procure');
        $status = $request->input('status');
        if(Auth::user()->tipo != 'admin'){
            $solicitacoes = Solicitacao::select('solicitacao.*','cliente.OfficialName as nome_solicitante','cliente.Name as nome_sacado','status.nome as nome_status')
            ->leftJoin('cliente','cliente.id','solicitacao.id_solicitante')
            ->leftJoin('status','status.id','solicitacao.id_status')
            ->where('id_solicitante','=',Auth::user()->id_cliente)
            ->where(function($solicitacoes) use ($procure, $status, $paginas)  {
                if(isset($procure)) {
                    $solicitacoes->where('solicitacao.id','LIKE', '%'.$procure.'%');
                }
                if(isset($status)) {
                    $solicitacoes->where('solicitacao.id_status','=',$status);
                }
            })
            ->paginate($paginas)->appends(request()->query());

            foreach($solicitacoes as $s){
                $s['data_gerado'] = SolicitacaoController::FormataData($s['data_gerado']);
                $nome_novo          = Cliente::where('id',$s->id_sacado)->first();
                $one = $s->valor_total;
                $two = $s->valor_total_juros;
                $new = str_replace('.', '', $one);
                $new = str_replace(',', '.', $new);
                $new2 = str_replace('.', '', $two);
                $new2 = str_replace(',', '.', $new2);
                $novo = $new - $new2;
                $s->desagio = 'R$'.number_format($novo, 2, ',', '.');
                $s->valor_total     = 'R$ '.$s->valor_total;
                $s->valor_total_juros     = 'R$ '.$s->valor_total_juros;
                $s->juros_total     = 'R$ '.$s->juros_total;
                if(isset($nome_novo)){
                    $s->sacado_nome     = $nome_novo->Name;
                }else{
                    $s->sacado_nome     = "NOME NÃO INFORMADO";
                }
            }

            //Falta formatar a data que ta sendo retornada
            return view('partials/bordero_cliente',with(compact('solicitacoes', 'procure', 'status', 'paginas')));
        }else{
            $solicitacoes = Solicitacao::select('solicitacao.*','cliente.OfficialName as nome_solicitante','cliente.Name as nome_sacado','status.nome as nome_status')
            ->leftJoin('cliente','cliente.id','solicitacao.id_solicitante')
            ->leftJoin('status','status.id','solicitacao.id_status')
            ->where('solicitacao.id_status','=',$request->input('id'))
            ->paginate(10);

            foreach($solicitacoes as $s){
                $s['data_gerado'] = SolicitacaoController::FormataData($s['data_gerado']);
                $nome_novo          = Cliente::where('id',$s->id_sacado)->first();
                $one = $s->valor_total;
                $two = $s->valor_total_juros;
                $new = str_replace('.', '', $one);
                $new = str_replace(',', '.', $new);
                $new2 = str_replace('.', '', $two);
                $new2 = str_replace(',', '.', $new2);
                $novo = $new - $new2;
                $s->desagio = 'R$'.number_format($novo, 2, ',', '.');
                $s->valor_total     = 'R$'.$s->valor_total;
                $s->valor_total_juros     = 'R$'.$s->valor_total_juros;
                if(isset($nome_novo)){
                    $s->sacado_nome     = $nome_novo->Name;
                }else{
                    $s->sacado_nome     = "NOME NÃO INFORMADO";
                }
            }
            //Falta formatar a data que ta sendo retornada
            return view('admin/solicitacoes',with(compact('solicitacoes')));
        }
    }

    //nova função consulta solicitação
    public function infoSolicitacao($id){
        $solicitacao = Solicitacao::select('solicitacao.*','cliente.Name as nome_sacador','cliente.limite_credito as credito',
            'cliente.OfficialName as nome_empresa_sacador')
            ->leftJoin('cliente','cliente.id','solicitacao.id_solicitante')
            ->where('solicitacao.id','=',$id)
            ->first();

        $solicitacao->data_gerado = SolicitacaoController::FormataData($solicitacao->data_gerado);

        $conta = Cliente_Conta::where('id',$solicitacao->id_cliente_conta)->first();

        //Informações do Sacado
        $sacado       = Cliente::where('id','=',$solicitacao->id_sacado)->first();

        //formatatelefone
        if($sacado->telefone){
            $sacado->telefone = preg_replace("/\D/", '', $sacado->telefone);
            $sacado->telefone = "(".substr($sacado->telefone,0,2).") ".substr($sacado->telefone,2,-4)." - ".substr($sacado->telefone,-4);
        }

        //formatacnpj
        if($sacado->cnpj){
            $sacado->cnpj = preg_replace("/\D/", '', $sacado->cnpj);
            $sacado->cnpj = preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5",$sacado->cnpj);
        }
  
        //formatacpf
        if($sacado->cpf){
            $sacado->cpf = preg_replace("/\D/", '', $sacado->cpf);
            $sacado->cpf = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $sacado->cpf);
        }

        //Informações do Solicitante
        $solicitante       = Cliente::where('id','=',$solicitacao->id_solicitante)->first();

        //Endereco do Sacado/Fisico    
        $endereco_sacado_fisica   = Enderecos::where('id_cliente','=',$solicitacao->id_sacado)->where('id_socio','=',null)->where('tipo','=',"fisica")->first();
        if(isset($endereco_sacado_fisica)){
            //formatacep
            $endereco_sacado_fisica->Endereco_CEP = preg_replace("/\D/", '', $endereco_sacado_fisica->Endereco_CEP);
            $endereco_sacado_fisica->Endereco_CEP = preg_replace("/(\d{5})(\d{3})/", "\$1-\$2", $endereco_sacado_fisica->Endereco_CEP);
        }
        //Endereco do Sacado/Juridico
        $endereco_sacado_juridica = Enderecos::where('id_cliente','=',$solicitacao->id_sacado)->where('id_socio','=',null)->where('tipo','=',"juridica")->first();
        if(isset($endereco_sacado_juridica)){
            //formatacep
            $endereco_sacado_juridica->Endereco_CEP = preg_replace("/\D/", '', $endereco_sacado_juridica->Endereco_CEP);
            $endereco_sacado_juridica->Endereco_CEP = preg_replace("/(\d{5})(\d{3})/", "\$1-\$2", $endereco_sacado_juridica->Endereco_CEP);
        }
        
        $parcelas       = Solicitacao_Parcela::where('id_solicitacao','=',$id)->get();
        foreach($parcelas as $p){
            $p['vencimento'] = SolicitacaoController::FormataData($p['vencimento']);
        }
        $valor_total 	= '';
        $juros 			= '';

        $id_nota_reduzida = Str::limit($solicitacao->id_nota, 5);

        if(Auth::user()->tipo != 'admin'){
            return view('partials/bordero_cliente_nfe20',with(compact(
                'id','sacado', 'solicitante', 'id_nota_reduzida',
                'endereco_sacado_fisica','endereco_sacado_juridica',
                'parcelas','valor_total','juros',
                'solicitacao','conta'))
            );
        }
    }

    public function resumoBordero($id){
        $solicitacao = Solicitacao::select('solicitacao.*','cliente.Name as nome_solicitante','cliente.limite_credito as credito',
            'cliente.OfficialName as nome_empresa_solicitante')
            ->leftJoin('cliente','cliente.id','solicitacao.id_solicitante')
            ->where('solicitacao.id','=',$id)
            ->first();

        $solicitacao->data_gerado = SolicitacaoController::FormataData($solicitacao->data_gerado);

        $sacado       = Cliente::where('id','=',$solicitacao->id_sacado)->first();
        //formatacnpj
        if(!empty($sacado->cnpj)){
            $sacado->cnpj = preg_replace("/\D/", '', $sacado->cnpj);
            $sacado->cnpj = preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5",$sacado->cnpj);
        }
  
        //formatacpf
        if(!empty($sacado->cpf)){
            $sacado->cpf = preg_replace("/\D/", '', $sacado->cpf);
            $sacado->cpf = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $sacado->cpf);
        }

        $parcelas       = Solicitacao_Parcela::where('id_solicitacao','=',$id)->get();
        foreach($parcelas as $p){
            $today = date('Y/m/d');
            $solicitacao->diff_dias          = number_format((strtotime($p->vencimento) - strtotime($today)) / 86400, 0);
            //dd($p->vencimento, $today, $p->diff_dias);
            $p['vencimento'] = SolicitacaoController::FormataData($p['vencimento']);
        }
        $solicitacao->diff_dias     = number_format($solicitacao->diff_dias/count($parcelas),0);
        $solicitacao->juros_total   = number_format($solicitacao->juros_total,2);
        //($novo, 2, ',', '.');
        $new = str_replace('.', '', $solicitacao->valor_total);
		$new = str_replace(',', '.', $new);
		$new2 = str_replace('.', '', $solicitacao->valor_total_juros);
		$new2 = str_replace(',', '.', $new2);
		$novo = $new - $new2;
		$solicitacao->juros_valor = number_format($novo, 2, ',', '.');
        //$solicitacao->juros_valor   = $solicitacao->juros_valor.",00";
        //dd($solicitacao->juros_valor);
        $id_nota_reduzida = Str::limit($solicitacao->id_nota, 5);
        $Name_reduzido = Str::limit($sacado->Name, 8);
        $OfficialName_reduzido = Str::limit($sacado->OfficialName, 8);
        $valor_total 	= '';
        $juros 			= '';
        //dd($solicitacao);
        if(Auth::user()->tipo != 'admin'){
            return view('partials/resumo_bordero_cliente',with(compact(
                'id','valor_total','juros', 'id_nota_reduzida', 'Name_reduzido', 'OfficialName_reduzido',
                'solicitacao', 'sacado', 'parcelas'))
            );
        }
    }

    public function solicitacao($id){
        //Informações da Solicitação 
        $solicitacao = Solicitacao::select('solicitacao.*','cliente.Name as nome_sacador','cliente.limite_credito as credito',
            'cliente.OfficialName as nome_empresa_sacador')
            ->leftJoin('cliente','cliente.id','solicitacao.id_solicitante')
            ->where('solicitacao.id','=',$id)
            ->first();

        $conta = Cliente_Conta::where('id',$solicitacao->id_cliente_conta)->first();

        if($solicitacao){
            //Informações do Solicitante
            $solicitante       = Cliente::where('id','=',$solicitacao->id_solicitante)->get();
            if(count($solicitante) == 0){
               $solicitante = null;
            }

            //Endereco do Solicitante/Fisico    
            $sol_fis_endereco   = Enderecos::where('id_cliente','=',$solicitacao->id_solicitante)
            ->where('tipo','=',"fisica")
            ->get();
            //Endereco do Solicitante/Juridico
            $sol_jur_endereco   = Enderecos::where([['id_cliente','=',$solicitacao->id_solicitante],['tipo','=',"juridica"]])
            ->get();

            if(count($sol_fis_endereco) == 0){
                $sol_fis_endereco   = null;
            }
            if(count($sol_jur_endereco) == 0){
                $sol_jur_endereco   = null;
            }

            if($solicitante != null){
                //Score Solicitante/Fisico
                $score_fisico_sol       = Cliente_Spc::where('documento','=',$solicitante[0]->cpf)->get();
                //Score Solicitante/Juridico
                $score_juridico_sol       = Cliente_Spc::where('documento','=',$solicitante[0]->cnpj)->get();

                if(count($score_fisico_sol ) == 0){
                    $score_fisico_sol   = null;
                    
                }
                if(count($score_juridico_sol ) == 0 ){
                    $score_juridico_sol    = null;
                }
            }else{
                $score_juridico_sol = null;
                $score_fisico_sol   = null;
            }

            //Informações Sacado
            $sacado = Cliente::where('id','=',$solicitacao->id_sacado)->get();

            if(count($sacado) == 0){
                $sacado = null;
            }

            //Endereco do Sacado/Fisico    
            $sac_fis_endereco   = Enderecos::where('id_cliente','=',$solicitacao->id_sacado)
            ->where('tipo','=','fisica')
            ->get();

            //Endereco do Sacado/Juridico
            $sac_jur_endereco   = Enderecos::where('id_cliente','=',$solicitacao->id_sacado)
            ->where('tipo','=','juridica')
            ->get();

            if(count($sac_fis_endereco) == 0){
                $sac_fis_endereco   = null;
            }
            if(count($sac_jur_endereco) == 0){
                $sac_jur_endereco   = null;
            }

            if($sacado != null){
                //Score Sacado/Fisico
                $score_fisico_sac       = Cliente_Spc::where('documento','=',$sacado[0]->cpf)->get();
                //Score Sacado/Juridico
                $score_juridico_sac       = Cliente_Spc::where('documento','=',$sacado[0]->cnpj)->get();

                if(count($score_fisico_sac ) == 0){
                    $score_fisico_sac   = null;
                    
                }
                if(count($score_juridico_sac ) == 0 ){
                    $score_juridico_sac    = null;
                }  
            }else{
                $score_juridico_sac = null;
                $score_fisico_sac   = null;
            }

            $parcelas       = Solicitacao_Parcela::where('id_solicitacao','=',$id)->get();
            foreach($parcelas as $p){
                $p['vencimento'] = SolicitacaoController::FormataData($p['vencimento']);
            }
            $valor_total 	= '';
            $juros 			= '';

            //Dados Profissionais
            $dpf = Dados_Profissionais::where('id_cliente','=',$solicitacao->id_solicitante)->where('Status','=','ACTIVE')->orderby('id','DESC')->get();
            if(count($dpf) == 0){
                $dpf   = null;
                
            }

            $dpfs = Dados_Profissionais::where('id_cliente','=',$solicitacao->id_sacado)->where('Status','=','ACTIVE')->orderby('id','DESC')->get();
            if(count($dpfs) == 0){
                $dpfs   = null;
                
            }

            //Veiculos
            $vef = Veiculos::where('id_cliente','=',$solicitacao->id_solicitante)->get();
            if(count($vef) == 0){
                $vef   = null;
                
            }

            $vefs = Veiculos::where('id_cliente','=',$solicitacao->id_sacado)->get();
            if(count($vefs) == 0){
                $vefs   = null;
                
            }

            //Informacoes Financeiras
            $iff = Info_Financeira::where('id_cliente','=',$solicitacao->id_solicitante)->orderBy('id','DESC')->get();
            if(count($iff) == 0){
                $iff   = null;
                
            }

            $iffs = Info_Financeira::where('id_cliente','=',$solicitacao->id_sacado)->orderBy('id','DESC')->get();
            if(count($iffs) == 0){
                $iffs   = null;
                
            }

            //Antecedentes Criminais
            $acf = Antecedente_Criminal::where('id_cliente','=',$solicitacao->id_solicitante)->orderBy('id','DESC')->get();
            if(count($acf) == 0){
                $acf   = null;
                
            }

            $acfs = Antecedente_Criminal::where('id_cliente','=',$solicitacao->id_sacado)->orderBy('id','DESC')->get();
            if(count($acfs) == 0){
                $acfs   = null;
                
            }

            //Indicadores de Atividade
            $iaj = Indicador_Atividade::where('id_cliente','=',$solicitacao->id_solicitante)->orderBy('id','DESC')->get();
            if(count($iaj) == 0){
                $iaj   = null;
                
            }

            $iajs = Indicador_Atividade::where('id_cliente','=',$solicitacao->id_sacado)->orderBy('id','DESC')->get();
            if(count($iajs) == 0){
                $iajs   = null;
                
            }

            $boleto = count(Boleto::where('id_solicitacao',$id)->get());

            if($boleto == 0){
                $boleto = null;
            }
            //dd($solicitante[0]->cpf);

            if(Auth::user()->tipo != 'admin'){
                return view('cliente/solicitacao',with(compact(
                    'id','solicitante','sacado',
                    'sol_fis_endereco','sol_jur_endereco',
                    'sac_fis_endereco','sac_jur_endereco',
                    'score_juridico_sol','score_fisico_sol',
                    'score_juridico_sac','score_fisico_sac',
                    'parcelas','valor_total','juros',
                    'solicitacao','dpf','dpfs','vef','vefs',
                    'iff','iffs','acf','acfs','iaj','iajs','conta','boleto'))
                );
            }else{
                return view('admin/solicitacao',with(compact(
                    'id','solicitante','sacado',
                    'sol_fis_endereco','sol_jur_endereco',
                    'sac_fis_endereco','sac_jur_endereco',
                    'score_juridico_sol','score_fisico_sol',
                    'score_juridico_sac','score_fisico_sac',
                    'parcelas','valor_total','juros',
                    'solicitacao','dpf','dpfs','vef','vefs',
                    'iff','iffs','acf','acfs','iaj','iajs','conta','boleto'))
                );
            }
        }else{
            return redirect('admin/solicitacoes');
        }
    }

    public function atualizaCredito(Request $request,$id){
        if(isset($request->credito)){
            $solicitacao        = Solicitacao::where('id','=',$request->solicitacao)->first();
            Cliente::where('id','=',$id)->update(['cliente.limite_credito' => $request->credito]);
            $solicitante        = Cliente::where('id','=',$id)->first();
            $socios             = Cliente_Socio::where('id_cliente','=',$id)->get();
            $conjuges           = Conjuge::all(); 
            $credito            = $request->credito;
            $nome_sacador       = $solicitacao['nome'];
            $empresa_sacador    = $solicitacao['nome_empresa_sacador'];
            $cpf_sacador        = $solicitacao['cpf'];
            $email_sacador      = User::where('id_cliente','=',$id)->first();
            $nascimento_sacador = $solicitacao['data_nascimento'];
            $endereco           = Enderecos::where('id_cliente','=',$id)->where('tipo','=','juridica')->first();

            if(!isset($endereco)){
                $endereco       = Enderecos::where('id_cliente','=',$id)->where('tipo','=','fisica')->first();
            }

            //Dados CashTF
            $empresa_default    = 'Zamprogna Securitizadora S/A';
            $cnpj_default       = '35.262.759/0001-27';
            $email_default      = 'business@cashtf.com';


            //Data Limite
            $data_limite = date('Y-m-d', strtotime('+ 89days'));
            //Gera o PDF
            $nome_arquivo           = 'cessao_credito'.date('Ymdhis').'.pdf';
            $nome_caminho           = storage_path('app/public/pdfs/'.$nome_arquivo);

            $pdf                    = PDF::loadView('admin/cessao_credito',with(compact('solicitante','endereco','credito','socios','conjuges'))); 
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
                            "message" => "Segue documento para formalização do limite de crédito junto a cashTF, por favor assine o documento. 
                            Depois da assinatura, acesse o site com seu login e senha e inclua sua primeira solicitação!",
                            "skip_documentation" => true
                        ],
                        [
                            "email" => $email_sacador->email, 
                            "sign_as" => "sign", 
                            "auths" => [
                                "email" 
                            ], 
                            "company_name" => $empresa_sacador,
                            "name" => $nome_sacador, 
                            "documentation" => $cpf_sacador, 
                            //"birthday" => ReformataData($nascimento_sacador), 
                            "has_documentation" => true, 
                            "send_email" => true, 
                            "message" => "Segue documento para formalização do limite de crédito junto a cashTF, por favor assine o documento. 
                            Depois da assinatura, acesse o site com seu login e senha e inclua sua primeira solicitação!" 
                        ],
                        [
                            "email" => "ricardomiotto@live.com", 
                            "sign_as" => "sign", 
                            "auths" => [
                                "email" 
                            ], 
                            "company_name" => "",
                            "name" => "Ricardo Miotto", 
                            "documentation" => "016.020.890-43", 
                            //"birthday" => ReformataData($nascimento_sacador), 
                            "has_documentation" => true, 
                            "send_email" => true, 
                            "message" => "Segue documento para formalização do limite de crédito junto a cashTF, por favor assine o documento. 
                            Depois da assinatura, acesse o site com seu login e senha e inclua sua primeira solicitação!" 
                        ],
                        [
                            "email" => "neivagado@gmail.com", 
                            "sign_as" => "sign", 
                            "auths" => [
                                "email" 
                            ], 
                            "company_name" => "",
                            "name" => "Neiva Gado", 
                            "documentation" => "389.815.640-00", 
                            //"birthday" => ReformataData($nascimento_sacador), 
                            "has_documentation" => true, 
                            "send_email" => true, 
                            "message" => "Segue documento para formalização do limite de crédito junto a cashTF, por favor assine o documento. 
                            Depois da assinatura, acesse o site com seu login e senha e inclua sua primeira solicitação!" 
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

            $data = (['name' => $solicitante->Name]);
            Mail::to($email_sacador->email)->send(new Credito($data)); 

        }
        return redirect()->back();
    }

    public static function novoCredito(Request $request,$id){
        //Necessario Credito/Cliente
        if(isset($request->credito)){
            Cliente::where('id','=',$id)->update(['cliente.limite_credito' => $request->credito, 'cliente.id_status_cliente' => 1]);
            User::where('id_cliente','=',$id)->update(['users.ativo' => 1]);

            $solicitante        = Cliente::where('id','=',$id)->first();
            $socios             = Cliente_Socio::where('id_cliente','=',$id)->get();
            //$conjuges           = Conjuge::all(); 
            $credito            = $request->credito;
            $nome_sacador       = $solicitante->Name;
            $empresa_sacador    = $solicitante->OfficialName;
            $cpf_sacador        = $solicitante->cpf;
            $email_sacador      = User::where('id_cliente','=',$id)->first();
            $nascimento_sacador = $solicitante->data_nascimento;
            $endereco           = Enderecos::where('id_cliente','=',$id)->where('tipo','=','juridica')->first();
            $enderecof           = Enderecos::where('id_cliente','=',$id)->where('tipo','=','fisica')->first();

            foreach($socios as $s){
                $enderecos = Enderecos::where('id_socio',$s->id)->first();
                $s->enderecos = $enderecos;
                if(isset($s->enderecos->Endereco_Pais) && ($s->enderecos->Endereco_Pais == "Brazil" || $s->enderecos->Endereco_Pais == "BRAZIL")){
                    $s->enderecos->Endereco_Pais = "Brasil";
                }
            }
            
            if(isset($enderecof) && $enderecof->Endereco_Pais == "Brazil"){
                $enderecof->Endereco_Pais = "Brasil";
            } 
            
            //dd($email_sacador);
            if(!isset($endereco)){
                $endereco       = Enderecos::where('id_cliente','=',$id)->where('tipo','=','fisica')->first();
            }else if($endereco->Endereco_Pais == "Brazil"){
                $endereco->Endereco_Pais = "Brasil";
            }
            //Dados CashTF
            $empresa_default    = 'Zamprogna Securitizadora S/A';
            $cnpj_default       = '35.262.759/0001-27';
            $email_default      = 'business@cashtf.com';
            //dd($socios,$solicitante);

            //Data Limite
            $data_limite = date('Y-m-d', strtotime('+ 89days'));
            //Gera o PDF
            $nome_arquivo           = 'cessao_credito'.date('Ymdhis').'.pdf';
            $nome_caminho           = storage_path('app/public/pdfs/'.$nome_arquivo);

            $pdf                    = PDF::loadView('admin/cessao_credito',with(compact('solicitante','endereco','credito','socios','enderecof'))); 
            Storage::put('public/pdfs/'.$nome_arquivo, $pdf->output());
            $b64Doc = chunk_split(base64_encode(file_get_contents($nome_caminho)));
                $signer =[
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
                        "message" => "Segue documento para formalização do limite de crédito junto a cashTF, por favor assine o documento. 
                        Depois da assinatura, acesse o site com seu login e senha e inclua sua primeira solicitação!",
                        "skip_documentation" => true
                    ],
                    [
                        "email" => "ricardomiotto@live.com", 
                        "sign_as" => "sign", 
                        "auths" => [
                            "email" 
                        ], 
                        "company_name" => "",
                        "name" => "Ricardo Miotto", 
                        "documentation" => "016.020.890-43", 
                        //"birthday" => ReformataData($nascimento_sacador), 
                        "has_documentation" => true, 
                        "send_email" => true, 
                        "message" => "Segue documento para formalização do limite de crédito junto a cashTF, por favor assine o documento. 
                        Depois da assinatura, acesse o site com seu login e senha e inclua sua primeira solicitação!" 
                    ],
                    [
                        "email" => "neivagado@gmail.com", 
                        "sign_as" => "sign", 
                        "auths" => [
                            "email" 
                        ], 
                        "company_name" => "",
                        "name" => "Neiva Gado", 
                        "documentation" => "389.815.640-00", 
                        //"birthday" => ReformataData($nascimento_sacador), 
                        "has_documentation" => true, 
                        "send_email" => true, 
                        "message" => "Segue documento para formalização do limite de crédito junto a cashTF, por favor assine o documento. 
                        Depois da assinatura, acesse o site com seu login e senha e inclua sua primeira solicitação!" 
                    ]
                ];
            foreach($socios as $c){
                if($c->cpf == $solicitante->cpf || $c->cnpj == $solicitante->cnpj){
                    $signer[] = 
                    [
                        "email" => $c->email, 
                        "sign_as" => "sign", 
                        "auths" => [
                            "email" 
                            ], 
                        "company_name" => "",
                        "name" => $c->nome, 
                        "documentation" => $c->cpf, 
                        //"birthday" => ReformataData($nascimento_sacador), 
                        "has_documentation" => true, 
                        "send_email" => true, 
                        "message" => "Segue documento para formalização do limite de crédito junto a cashTF, por favor assine o documento. 
                        Depois da assinatura, acesse o site com seu login e senha e inclua sua primeira solicitação!" 
                    ];
                    $signer[] = 
                    [
                        "email" => $c->email, 
                        "sign_as" => "sign", 
                        "auths" => [
                            "email" 
                            ], 
                        "company_name" => "",
                        "name" => $c->nome, 
                        "documentation" => $c->cpf, 
                        //"birthday" => ReformataData($nascimento_sacador), 
                        "has_documentation" => true, 
                        "send_email" => true, 
                        "message" => "Segue documento para formalização do limite de crédito junto a cashTF, por favor assine o documento. 
                        Depois da assinatura, acesse o site com seu login e senha e inclua sua primeira solicitação!" 
                    ];
                }else{
                    $signer[] = 
                    [
                        "email" => $c->email, 
                        "sign_as" => "sign", 
                        "auths" => [
                            "email" 
                            ], 
                        "company_name" => "",
                        "name" => $c->nome, 
                        "documentation" => $c->cpf, 
                        //"birthday" => ReformataData($nascimento_sacador), 
                        "has_documentation" => true, 
                        "send_email" => true, 
                        "message" => "Segue documento para formalização do limite de crédito junto a cashTF, por favor assine o documento. 
                        Depois da assinatura, acesse o site com seu login e senha e inclua sua primeira solicitação!" 
                    ];
                }

                
                if(isset($c->conjuge_nome)){
                    $signer[] = [
                        "email" => $c->conjuge_email, 
                        "sign_as" => "sign", 
                        "auths" => [
                            "email" 
                            ], 
                        "company_name" => "",
                        "name" => $c->conjuge_nome, 
                        "documentation" => $c->conjuge_cpf, 
                        //"birthday" => ReformataData($nascimento_sacador), 
                        "has_documentation" => true, 
                        "send_email" => true, 
                        "message" => "Segue documento para formalização do limite de crédito junto a cashTF, por favor assine o documento. 
                        Depois da assinatura, acesse o site com seu login e senha e inclua sua primeira solicitação!" 
                    ];
                }
                
            }

            //DD($signer);
            $jayParsedAry = [
                "document" => [
                    "path" => "/".$nome_arquivo, 
                    "content_base64" => 'data:application/pdf;base64,'.$b64Doc,
                    "deadline_at" => $data_limite."T14:30:59-03:00", 
                    "auto_close" => true, 
                    "locale" => "pt-BR", 
                    "signers" => $signer                    
                ] 
            ];    
            //dd($jayParsedAry);
            // SANDBOX
            $TOKEN              = '73b72bff-b595-40dc-ad41-b39c7a516309';
            $URL_DEFAULT        = 'https://sandbox.clicksign.com/';

            // PROD
            //$TOKEN              = 'd8de5e6b-4300-4867-82f5-31e034907823';
            //$URL_DEFAULT        = 'https://app.clicksign.com/';

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
            $data = (['name' => $solicitante->Name]);
            if(isset($email_sacador->email)){
                Mail::to($email_sacador->email)->send(new Credito($data));
            }
            
        }

        return redirect()->back();
    }

    public function cessao($id){
        $socios             = Cliente_Socio::where('id_cliente','=',$id)->get();
        $solicitante        = Cliente::where('id','=',$id)->first();
        $endereco           = Enderecos::where('id_cliente','=',$id)->where('tipo','=','juridica')->first();
        $enderecof          = Enderecos::where('id_cliente','=',$id)->where('tipo','=','fisica')->first();
        foreach($socios as $s){
            $enderecos = Enderecos::where('id_socio',$s->id)->first();
            $s->enderecos = $enderecos;
            if(isset($s->enderecos->Endereco_Pais) && ($s->enderecos->Endereco_Pais == "Brazil" || $s->enderecos->Endereco_Pais == "BRAZIL")){
                $s->enderecos->Endereco_Pais = "Brasil";
            }
        }
        if(isset($enderecof) && $enderecof->Endereco_Pais == "Brazil"){
            $enderecof->Endereco_Pais = "Brasil";
        }     
        if(!isset($endereco)){
            $endereco       = Enderecos::where('id_cliente','=',$id)->where('tipo','=','fisica')->first();
        }else if($endereco->Endereco_Pais == "Brazil"){
            $endereco->Endereco_Pais = "Brasil";
        }
        $credito = 100;
        return view('admin/cessao_credito',with(compact('solicitante','endereco','credito','socios','enderecof')));
    }

    public function atualizaJuros(Request $request,$id){
        if(isset($request->juros)){
            Solicitacao::where('id','=',$id)->update(['solicitacao.juros' => $request->juros]);
        }
        return redirect()->back();
    }

    public static function novaTaxa(Request $request,$id){
        if(isset($request->juros)){
            Cliente::where('id','=',$id)->update(['cliente.taxa_desagio' => $request->juros]);
        }
        return redirect()->back();
    }

    public function atualizaStatus(Request $request,$id){
        if(isset($request->status)){
            Solicitacao::where('id','=',$id)->update(['solicitacao.id_status' => $request->status]);
            $email              = Cliente::select('email')->where('id','=',$request->solicitante)->first();
            $solicitacao        = Solicitacao::where('id','=',$id)->get();
            $nome_sacador       = $solicitacao[0]['nome'];
            $empresa_sacador    = $solicitacao[0]['nome_empresa_sacador'];
            $cpf_sacador        = $solicitacao[0]['cpf'];
            $email_sacador      = Cliente::where('id','=',$solicitacao[0]->id_solicitante)->first();
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

            $percent_total = ($valor_total_devido - $valor_liberado) * 100;
            
            //Gera o PDF
            $nome_arquivo           = 'bordero'.date('Ymdhis').'.pdf';
            $nome_caminho           = storage_path('app/public/pdfs/'.$nome_arquivo);

            $pdf                    = PDF::loadView('admin/imprimir_bordero',compact(
                'solicitacao','solicitante',
                'sacado','solicitacoes_contas',
                'conta','solicitacoes',
                'valor_total_devido','valor_liberado',
                'percent_total','qtd_parcelas','id'
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
                            "email" => $email_sacador->email, 
                            "sign_as" => "sign", 
                            "auths" => [
                                "email" 
                            ], 
                            "company_name" => $empresa_sacador,
                            "name" => $nome_sacador, 
                            "documentation" => $cpf_sacador, 
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

    public function delete($id){
        $solicitacao = Solicitacao::findOrFail($id);
        if($solicitacao->id_status != 1){
            $solicitacao->delete();
        }
        return redirect()->back();
    }
    
    public function bordero($id){
        $bordero = Solicitacao::select('solicitacao.*','cliente.Name as nome_sacador','cliente.limite_credito as credito',
        'cliente.OfficialName as nome_empresa_sacador')
        ->leftJoin('cliente','cliente.id','solicitacao.id_solicitante')
        ->where('solicitacao.nro_bordero','=',$id)
        ->get();
        $solicitante        = Cliente::where('id','=',$bordero[0]->id_solicitante)->first();
        //Dados CashTF
        $empresa_default    = 'Zamprogna Securitizadora S/A';
        $cnpj_default       = '35.262.759/0001-27';
        $email_default      = 'business@cashtf.com';
        $sacado             = [];
        foreach($bordero as $b){
            $b->data_gerado = SolicitacaoController::FormataData($b->data_gerado);
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

        return view('admin/bordero',with(compact(
            'bordero','solicitante',
            'sacado','parcelas',
            'valor_total_devido','valor_liberado',
            'percent_total','qtd_parcelas','id','diff_valor','porc_final','porc_restante'
        )));

    }

    public function imprimirBordero($id){
        $solicitacao            = Solicitacao::where('id','=',$id)->get();
        $solicitante            = Cliente::where('id','=',$solicitacao[0]->id_solicitante)->get();
        $sacado                 = Cliente::where('id','=',$solicitacao[0]->id_sacado)->get();
        $solicitacoes_contas    = Solicitacao_Parcela::join('solicitacao','solicitacao.id','solicitacao_parcela.id_solicitacao')  
            ->join('cliente','cliente.id','solicitacao.id_sacado')
            ->where('id_solicitacao','=',$id)->get();
        $conta                  = Cliente_Conta::where('id_cliente','=',$solicitacao[0]->id_sacado)->get();
        $solicitacoes           = Solicitacao_Parcela::where('id_solicitacao','=',$id)->get();
        $solicitacao[0]->data_gerado = SolicitacaoController::FormataData($solicitacao[0]->data_gerado);
        $valor_total_devido     = 0;
        $valor_liberado         = 0;
        $percent_total          = 0;
        $qtd_parcelas           = 0;

        foreach($solicitacoes as $s){
            $valTotal_formated  = str_replace(".", "", $s->valor_parcela);
            $valTotal_formated  = str_replace("", "", $valTotal_formated);
            $valorTotal_juros   = str_replace(".", "", $s->valor_juros);
            $valorTotal_juros   = str_replace("", "", $valorTotal_juros);
            //$valor_total_devido = $valor_total_devido + (($valTotal_formated - $valorTotal_juros) + $valTotal_formated);;
            $valor_total_devido = 1;
            //$valor_liberado     = $valor_liberado + $valorTotal_juros;
            $valor_liberado     = 1;
            $qtd_parcelas++;
        }

        $percent_total = ($valor_total_devido - $valor_liberado) * 100;

        set_time_limit(300);
        $pdf = PDF::loadView('admin/imprimir_bordero',compact(
            'solicitacao','solicitante',
            'sacado','solicitacoes_contas',
            'conta','solicitacoes',
            'valor_total_devido','valor_liberado',
            'percent_total','qtd_parcelas','id'
        ));  
        return $pdf->setPaper('', 'landscape')->stream('bordero.pdf');   

    }

    function FormataData($data){
        if(isset($data)){
            return implode("/", array_reverse(explode("-", substr($data, 0, 10))));
        }else{
            return '';
        }
    }
}