<?php

namespace App\Http\Controllers\Admin\Helpers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BoletoController extends Controller
{
    //Chamadas da API da Tecnospeed isoladas para melhor distribuição de responsabilidade
    function call($url, $data, $post){

        $json   = json_encode($data);
        $ch     = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
            "cnpj-sh: 35.262.759/0001-27",
            "token-sh: 13db0d245f8b6ea351a571dcb9d6129b",
            "cnpj-cedente: 35.262.759/0001-27"
        ));
        curl_setopt($curl, CURLOPT_POST, $post);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        if($post == 1){
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
        }
        $dados = curl_exec($ch);

        return $dados;
    }

    public function createLote($boletos){
        //homolog   = https://homologacao.plugboleto.com.br/api/v1/boletos/lote
        //producao  = https://plugboleto.com.br/api/v1/boletos/lote
    }
    
    public function getProtocoloPDF($boletos){
        //homolog   = https://homologacao.plugboleto.com.br/api/v1/boletos/impressao/lote
        //producao  = https://plugboleto.com.br/api/v1/boletos/impressao/lote
    }

    
}
