<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Boleto;
use App\Solicitacao;
use App\Enderecos;
use App\Cliente;
use App\Cliente_Conta;
use App\Solicitacao_Parcela;
use App\Http\Controllers\SolicitacaoController;
use Illuminate\Support\Facades\Mail;
use App\Mail\BoletosDisponiveis;

class BoletoController extends Controller
{

    //Consultar Boleto via idIntegração
    public function boleto(){
        $url = "https://plugboleto.com.br/api/v1/boletos?limit=5&idintegracao=cE6v94-R0Q";
        //https://homologacao.cobrancabancaria.tecnospeed.com.br/api/v1/boletos?IdIntegracao=HylCKRX7be,H1leBL4XWx
        $token ="13db0d245f8b6ea351a571dcb9d6129b";
        $cnpj ="35.262.759/0001-27";
        //http://br2.php.net/manual/pt_BR/function.curl-setopt.php
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
            "cnpj-sh: 35.262.759/0001-27",
            "token-sh: 13db0d245f8b6ea351a571dcb9d6129b",
            "cnpj-cedente: 35.262.759/0001-27"
        ));
        curl_setopt($curl, CURLOPT_POST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $retorno = curl_exec($curl);
        //Alteração
        curl_close($curl);
        dd(json_decode($retorno));

    }

    public function updateStatus($idintegracao){
        //Feito em Produção
    }

    //Criar Cedente via API
    public function createCedente(){
        $url = "https://homologacao.plugboleto.com.br/api/v1/cedentes";
        $data = '{
            "CedenteRazaoSocial": "Empresa Ltda",
            "CedenteNomeFantasia": "Empresa",
            "CedenteCPFCNPJ": "14868336000185",
            "CedenteEnderecoLogradouro": "Av. Analista Jucá de Souza",
            "CedenteEnderecoNumero": "123",
            "CedenteEnderecoComplemento": "sala 987",
            "CedenteEnderecoBairro": "Centro",
            "CedenteEnderecoCEP": "87012345",
            "CedenteEnderecoCidadeIBGE": "4115200",
            "CedenteTelefone": "(44) 3033-1234",
            "CedenteEmail": "cobranca@boleto.com.br"
        }';
        //http://br2.php.net/manual/pt_BR/function.curl-setopt.php
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=UTF-8",
            "cnpj-sh: 35.262.759/0001-27",
            "token-sh: 13db0d245f8b6ea351a571dcb9d6129b",
        ));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $retorno = curl_exec($curl);
        //Alteração
        curl_close($curl);
        dd(json_decode($retorno));
    }

    //Gerar Boleto 
    public function createBoleto($id){
        //Informações da Solicitação 
        $borderos = Solicitacao::select('solicitacao.*','cliente.Name as nome_sacador','cliente.limite_credito as credito',
            'cliente.OfficialName as nome_empresa_sacador')
            ->leftJoin('cliente','cliente.id','solicitacao.id_solicitante')
            ->where('solicitacao.nro_bordero','=',$id)
            ->get();

        foreach($borderos as $solicitacao){

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
                }else{
                    $enderecoSacado = Enderecos::where('id_cliente',$sacado[0]->id)->first();
                }
                
                $parcelas       = Solicitacao_Parcela::where('id_solicitacao','=',$solicitacao->id)->get();
                $formata        = new SolicitacaoController;
                foreach($parcelas as $p){
                    $p['vencimento'] = $formata->FormataData($p['vencimento']);
                }
                $valor_total 	= '';
                $juros 			= '';
            }

            //homolog   = https://homologacao.plugboleto.com.br/api/v1/boletos/lote
            //producao  = https://plugboleto.com.br/api/v1/boletos/lote
            $url = "https://plugboleto.com.br/api/v1/boletos/lote";
            $nparcela = 1;

            if(isset($sacado[0]->cnpj) && strlen($sacado[0]->cnpj) >5){
                $documento = $sacado[0]->cnpj;
            }else{
                $documento = $sacado[0]->cpf;
            }

            foreach($parcelas as $p){
                $boleto = new Boleto;
                $boleto->id_solicitacao = $solicitacao->id;
                $boleto->id_parcela = $p->id;
                $boleto->status = 'REGISTRADO';
                $boleto->save();     
                $venceu = $p->vencimento;
                $venceu = str_replace('/', '-', $venceu);
                $venceu = date('d-m-Y', strtotime($venceu));
                $atraso     = date('d/m/Y', strtotime('+1 day', strtotime($venceu)));
                $protesto   = date('d/m/Y', strtotime('+15 days', strtotime($venceu)));
                $valor_total  = str_replace(".", "", $p->valor_parcela);
                $valor_total  = str_replace(",", ".", $valor_total);
                $jurospdia  = ($valor_total*0.05)/30;
                $jurospdia  = number_format($jurospdia, 2, ',', '.');
                $data[] = [
                        "CedenteContaNumero" => "26541",
                        "CedenteContaNumeroDV"=> "1",
                        "CedenteConvenioNumero"=> "3225170",
                        "CedenteContaCodigoBanco"=> "001",
                        "SacadoCPFCNPJ"=> $documento,
                        "SacadoEmail"=> $sacado[0]->email,
                        "SacadoEnderecoNumero"=> $enderecoSacado->Endereco_Nro,
                        "SacadoEnderecoBairro"=> $enderecoSacado->Endereco_Bairro,
                        "SacadoEnderecoCEP"=> $enderecoSacado->Endereco_CEP,
                        "SacadoEnderecoCidade"=> $enderecoSacado->Endereco_Mun,
                        "SacadoEnderecoComplemento"=> $enderecoSacado->Endereco_Complemento,
                        "SacadoEnderecoLogradouro"=> $enderecoSacado->Endereco_Lgr,
                        "SacadoEnderecoPais"=> $enderecoSacado->Endereco_Pais,
                        "SacadoEnderecoUF"=> $enderecoSacado->Endereco_UF,
                        "SacadoNome"=> isset($sacado[0]->OfficialName) ? $sacado[0]->OfficialName : (isset($sacado[0]->Name) ? $sacado[0]->Name : ''),
                        "SacadoTelefone"=> null,
                        "SacadoCelular"=> null,
                        "TituloSacadorAvalista"=> isset($solicitante[0]->OfficialName) ? $solicitante[0]->OfficialName : (isset($solicitante[0]->Name) ? $solicitante[0]->Name : ''),
                        "TituloDataEmissao"=> date('d/m/Y'),
                        "TituloDataVencimento"=> $p->vencimento,
                        "TituloMensagem02"=> "",
                        "TituloMensagem02"=> "JRS: Vl p/Dia Atraso R$".$jurospdia." A PARTIR DE:".$atraso,
                        "TituloMensagem03"=> "MULTA DE 5,00 % A PARTIR DE ".$atraso,
                        "TituloMensagem04"=> "PROCEDA 0S AJUSTES DE VALORES PERTINENTES.",
                        "TituloMensagem05"=> "",
                        "TituloMensagem06"=> "PROTESTO: ".$protesto.".A PARTIR DESSA, CONSULTE BB P/ PGTO",
                        "TituloNossoNumero"=> $boleto->id,
                        "TituloNumeroDocumento"=> "".$boleto->id."-".$nparcela,
                        "TituloValor"=> $p->valor_parcela,
                        "TituloVariacaoCarteira"=> "027",
                        "TituloDocEspecie"=> "04",
                        "TituloLocalPagamento"=> "Pagável em qualquer banco até o vencimento.",
                        "TituloCodigoMulta"=> "2",
                        "TituloValorMultaTaxa"=> "5,00",
                        "TituloDataMulta"=> $atraso,
                        "TituloCodigoJuros"=> "1",
                        "TituloValorJuros"=> $jurospdia,
                        "TituloDataJuros"=> $atraso,
                        "TituloInscricaoSacadorAvalista" => isset($solicitante[0]->cnpj) ? $solicitante[0]->cnpj : $solicitante[0]->cpf,
                        "TituloCodProtesto" => "2",
                        "TituloPrazoProtesto" => "15"
                    ];
                $nparcela++;
            }
            //Evitar disparos de boleto em produção
            /*dd($data);
            $data = json_encode($data);
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=UTF-8",
                "cnpj-sh: 35.262.759/0001-27",
                "token-sh: 13db0d245f8b6ea351a571dcb9d6129b",
                "cnpj-cedente: 35.262.759/0001-27"
            ));
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            $retorno = curl_exec($curl);
            curl_close($curl);
            $retorno = json_decode($retorno);
            //dd($retorno);
            foreach($retorno->_dados->_sucesso as $s){
                $boletos[] = $s->idintegracao;
                $integracao = Boleto::where('id',$s->TituloNossoNumero)->first();
                $integracao->id_integracao = $s->idintegracao;
                $integracao->save();    
            }
            //dd($retorno);
            sleep(20);
            $protocolo  = BoletoController::protocoloPDF($boletos);
            sleep(10);

            $protocolo = json_decode($protocolo);
            $data = ['name' => isset($solicitante[0]->Name) ? $solicitante[0]->Name : (isset($solicitante[0]->OfficialName) ? $solicitante[0]->OfficialName : '')];
            Mail::to($solicitante[0]->email)->send(new BoletosDisponiveis($data));
            sleep(10);
            //homolog   = https://homologacao.plugboleto.com.br/api/v1/boletos/impressao/lote/:protocolo
            //producao  = https://plugboleto.com.br/api/v1/boletos/impressao/lote/:protocolo
            header("Location: https://plugboleto.com.br/api/v1/boletos/impressao/lote/".$protocolo->_dados->protocolo);
            die();*/
            }       

        return redirect()->back(); 
    }


    //Solicitar protocolo para gerar boleto
    public function protocoloPDF($boletos){
        //homolog   = https://homologacao.plugboleto.com.br/api/v1/boletos/impressao/lote
        //producao  = https://plugboleto.com.br/api/v1/boletos/impressao/lote
        $url = "https://plugboleto.com.br/api/v1/boletos/impressao/lote";
        $data = [
            "TipoImpressao" => "99",
            "Boletos" => $boletos
        ];
        $data = json_encode($data);     
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=UTF-8",
            "cnpj-sh: 35.262.759/0001-27",
            "token-sh: 13db0d245f8b6ea351a571dcb9d6129b",
            "cnpj-cedente: 35.262.759/0001-27"
        ));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $retorno = curl_exec($curl);
        //Alteração
        curl_close($curl);
        return $retorno;
    }

    public function remessaBaixa(){
        $url = "https://plugboleto.com.br/api/v1/boletos/baixa/lote";
        $data = ['Ry1xcgI68','AkUhxalCR','EsRVTA1aI','L8KnWnozZ','PgvFekLw2','XMKk28hVm','oFZoIZikEJ','Xct7ZICr2t','2FRkJOxMoY','e3_5XMSPFi','7HqpefFtrY','bMZiqOW69Q','ydSqpsRuIV','EWfnaRrPME','tbew9I1KW','-zAAFAd4xe','dkj9-yKhi8','oXsNIB7-In','9AhWUUM0f','_Zed2RjHd'];
        $data = json_encode($data);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=UTF-8",
            "cnpj-sh: 35.262.759/0001-27",
            "token-sh: 13db0d245f8b6ea351a571dcb9d6129b",
            "cnpj-cedente: 35.262.759/0001-27"
        ));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $retorno = curl_exec($curl);
        //Alteração
        curl_close($curl);
        dd($retorno);
    }

    public function consultaBaixa(){
        $url = "https://plugboleto.com.br/api/v1/boletos/baixa/lote/rKliHH82AS";
        //$data = ['Ry1xcgI68','AkUhxalCR','EsRVTA1aI','L8KnWnozZ','PgvFekLw2','XMKk28hVm','oFZoIZikEJ','Xct7ZICr2t','2FRkJOxMoY','e3_5XMSPFi','7HqpefFtrY','bMZiqOW69Q','ydSqpsRuIV','EWfnaRrPME','tbew9I1KW','-zAAFAd4xe','dkj9-yKhi8','oXsNIB7-In','9AhWUUM0f','_Zed2RjHd'];
        //$data = json_encode($data);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=UTF-8",
            "cnpj-sh: 35.262.759/0001-27",
            "token-sh: 13db0d245f8b6ea351a571dcb9d6129b",
            "cnpj-cedente: 35.262.759/0001-27"
        ));
        curl_setopt($curl, CURLOPT_POST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $retorno = curl_exec($curl);
        //Alteração
        curl_close($curl);
        dd($retorno);
    }
    public function gerarRemessa($boletos){
        /*
         Homologação:
            https://homologacao.plugboleto.com.br/api/v1/remessas/lote

        Produção:

            https://plugboleto.com.br/api/v1/remessas/lote
        */
        //dd($boletos);
        $url = "https://plugboleto.com.br/api/v1/remessas/lote";
        $data = json_encode($boletos);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=UTF-8",
            "cnpj-sh: 35.262.759/0001-27",
            "token-sh: 13db0d245f8b6ea351a571dcb9d6129b",
            "cnpj-cedente: 35.262.759/0001-27"
        ));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $retorno = curl_exec($curl);
        //Alteração
        curl_close($curl);
        return $retorno;
    }

    public function arquivoRetorno(){
        //homolog   = https://homologacao.plugboleto.com.br/api/v1/retornoshttps://homologacao.plugboleto.com.br/api/v1/retornos
        //producao  = https://plugboleto.com.br/api/v1/retornos
        $url = "https://plugboleto.com.br/api/v1/retornos";
        $file = base64_encode('MDFSRU1FU1NBMDFDT0JSQU5DQSAgICAgICAwNDMxNjAwMDI2NTQxMTAwMDAwMFpBTVBST0dOQSBTRUNVUklUSVpBRE9SQSBTLkEuIDAwMUJBTkNPRE9CUkFTSUwgIDI0MDgyMDAwMDAwMDEgICAgICAgICAgICAgICAgICAgICAgMzIyNTE3MCAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDAwMDAwMQ0KNzAyMzUyNjI3NTkwMDAxMjcwNDMxNjAwMDI2NTQxMTMyMjUxNzBDeXFIMDE1ZEsgICAgICAgICAgICAgICAgMzIyNTE3MDAwMDAwMDEyNjkwMDAwICAgICAgIDAwMDAwMDAwMDAgICAgIDE3MDEyMDAgICAgICAgMTEwOTIwMDAwMDAwMDE3MzExNjAwMTAwMDAgMDFOMjQwODIwMDcwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMjczNTE2MjM5MDAwMTkyUiBWIFJJQUxUTyBBVVRPTUFDQU8gRUlSRUxJICAgICAgICAgICAgIFJVQSBMQU1FTkhBIExJTlMsIDMyMDAsIERFIDIyOTEvMjI5MiBBTyBQQVJPTElOICAgICA4MDIyMDA4MUNVUklUSUJBICAgICAgIFBSSlJTOlZsIHAvRGlhIEF0cmFzbyBSJDIsNzAgQSBQQVJUSVIgREU6MSAgIDAwMDAwMg0KOSAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDAwMDAwMw0K');
        $file = base64_encode($file);
        dd($file);
        $data = ["arquivo" => $file];
        //dd(json_encode($data));
        //dd($data);
        $data = json_encode($data);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=UTF-8",
            "cnpj-sh: 35.262.759/0001-27",
            "token-sh: 13db0d245f8b6ea351a571dcb9d6129b",
            "cnpj-cedente: 35.262.759/0001-27"
        ));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $retorno = curl_exec($curl);
        //Alteração
        curl_close($curl);
        dd($retorno);
        return $retorno;
    }

    public function notificacao($retorno){
        $data = json_decode($retorno);
        if( $data->tipoWH == 'notifica_liquidou'    || $data->tipoWH == 'notifica_registrou'   ||
            $data->tipoWH == 'notifica_baixou'      || $data->tipoWH == 'notifica_rejeitou'    ||
            $data->tipoWH == 'notifica_alterou'     ){
            
            $boleto = Boleto::where('id_integracao',$data->titulo->idintegracao)->get();
            if($boleto){
                foreach($boleto as $b){
                    $b->status = $data->titulo->situacao;
                    $b->save();
                }
            }
            return 200;
        }
    }


    //Personalizar boleto
    public function personalizar(){
        $url = "https://homologacao.plugboleto.com.br/api/v1/cedentes/boletos/personalizar";
        $data = '{"conteudo": "<p>Cnpj: dale</p>",
        "layout": "normal"}';
        dd(json_decode($data));
        $data = json_encode($data);     
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=UTF-8",
            "cnpj-sh: 35.262.759/0001-27",
            "token-sh: 13db0d245f8b6ea351a571dcb9d6129b",
            "cnpj-cedente: 14868336000185"
        ));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $retorno = curl_exec($curl);
        //Alteração
        curl_close($curl);
        return $retorno;
    }

    //Criar conta via API
    public function createConta(){
        $url = "https://homologacao.plugboleto.com.br/api/v1/cedentes/contas";
        $data = '{
            "ContaCodigoBanco": "341",
            "ContaAgencia": "1234",
            "ContaAgenciaDV": "1",
            "ContaNumero": "59698",
            "ContaNumeroDV": "3",
            "ContaTipo": "CORRENTE",
            "ContaCodigoBeneficiario": "59698"
            }';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=UTF-8",
            "cnpj-sh: 35.262.759/0001-27",
            "token-sh: 13db0d245f8b6ea351a571dcb9d6129b",
            "cnpj-cedente: 14868336000185"
        ));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $retorno = curl_exec($curl);
        //Alteração
        curl_close($curl);
        dd($retorno);
    }

    //Criar convenio via API
    public function createConvenio(){
        $url = "https://homologacao.plugboleto.com.br/api/v1/cedentes/contas/convenios";
        $data = '{
            "ConvenioNumero": "7889604745",
            "ConvenioDescricao": "Convenio da tecnospeed",
            "ConvenioCarteira": "109",
            "ConvenioEspecie": "R$",
            "ConvenioPadraoCNAB": "400",
            "ConvenioNumeroRemessa": "1",
            "ConvenioReiniciarDiariamente": false,
            "Conta": 8212
          }';
        //dd(json_decode($data));
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=UTF-8",
            "cnpj-sh: 35.262.759/0001-27",
            "token-sh: 13db0d245f8b6ea351a571dcb9d6129b",
            "cnpj-cedente: 14868336000185"
        ));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $retorno = curl_exec($curl);
        //Alteração
        curl_close($curl);
        dd(json_decode($retorno));
    }

    //Consultar conta
    public function getConta(){
        $url = "https://homologacao.plugboleto.com.br/api/v1/cedentes/contas";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=UTF-8",
            "cnpj-sh: 35.262.759/0001-27",
            "token-sh: 13db0d245f8b6ea351a571dcb9d6129b",
            "cnpj-cedente: 14868336000185"
        ));
        curl_setopt($curl, CURLOPT_POST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $retorno = curl_exec($curl);
        //Alteração
        curl_close($curl);
        dd(json_decode($retorno));
    }

    //Consultar convenio
    public function getConvenio(){
        $url = "https://homologacao.plugboleto.com.br/api/v1/cedentes/contas/convenios";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=UTF-8",
            "cnpj-sh: 35.262.759/0001-27",
            "token-sh: 13db0d245f8b6ea351a571dcb9d6129b",
            "cnpj-cedente: 14868336000185"
        ));
        curl_setopt($curl, CURLOPT_POST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $retorno = curl_exec($curl);
        //Alteração
        curl_close($curl);
        dd(json_decode($retorno));
    }

    public function consultaRemessa(){
        $url = "https://plugboleto.com.br/api/v1/boletos/altera/lote/TPnFAbU5N";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=UTF-8",
            "cnpj-sh: 35.262.759/0001-27",
            "token-sh: 13db0d245f8b6ea351a571dcb9d6129b",
            "cnpj-cedente: 35.262.759/0001-27"
        ));
        curl_setopt($curl, CURLOPT_POST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $retorno = curl_exec($curl);
        //Alteração
        curl_close($curl);
        dd(json_decode($retorno));
    }
}
