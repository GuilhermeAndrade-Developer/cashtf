<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Solicitacao;
use App\Cliente;
use App\Taxa;
use Auth;
use DateTime;
use App\Mail\ContactEmail;
use App\Mail\RemetenteInvista;

use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request){
        $idioma = Input::get('i');
        if($idioma != ''){
            $request->session()->put('idioma', $idioma);
        }

        // COMMON QUESTIONS
        $all_questions = [
            ['quest' => 'O que é a CashTF?', 'answer' => 'Somos uma Fintech 100% transparente e com foco no crescimento de nossos clientes. Realizamos, de forma totalmente digital e segura, operações de antecipação de recebíveis, as quais apoiam a gestão do fluxo de caixa. Desta forma, a cashTF contribui para o desenvolvimento do seu negócio. Antecipamos seus recebíveis com eficiência, transparência e agilidade, liberando-o de burocracias e outros empecilhos e permitindo que você possa dedicar-se integralmente à gestão de sua empresa.'],
            ['quest' => 'Quais vendas eu posso antecipar pela cashTF?', 'answer' => 'Você poderá antecipar recebíveis de notas fiscais de produtos cujo pagamento será realizado por boleto com prazo de vencimento entre 5 e 150 dias.'],
            ['quest' => 'Qual é o nosso diferencial competitivo?', 'answer' => 'Por sermos uma empresa Securitizadora (registro nr. 43300063828) , ou seja, uma empresa NÃO financeira, não temos custas de IOF para o cliente / empresa, atuamos na compra de direitos creditórios (títulos), além de termos uma transação totalmente online, assim temos como partilhar dos MENORES juros de deságio do mercado, sem taxas ou tarifas sobre as transações.'],
            ['quest' => 'O que acontece se meu cliente não pagar o boleto em dia?', 'answer' => 'Caso o cliente não pague até o dia do vencimento, insidirá multa e juros até o efetivo pagamento, caso o sacado não pague até 10 dias posterior ao vencimento entraremos em contato com você para solucionarmos conjuntamente o não-pagamento.'],
            ['quest' => 'O que fazer para começar a utilizar a cashTF?', 'answer' => 'Com apenas os números do CNPJ e CPF como sócio ou procurador da empresa você já valida os dados para posterior inclusão dos documentos seus e da empresa.
            Após isso, no máximo até 1 dia útil você saberá as condições de sua antecipação.'],
            ['quest' => 'Qual o prazo para receber o valor da venda dos recebíveis?', 'answer' => 'Uma vez assinado o e-mail de confirmação da operação, você poderá visualizar seu dinheiro na conta em até 60 minutos. Esse tempo vale para operações enviadas até às 16h em dias úteis comerciais.'],
            ['quest' => 'Qual é o máximo e o mínimo de antecipação?', 'answer' => 'Não existe um valor mínimo. Você escolhe quanto quer antecipar mensalmente de acordo com sua necessidade. Existe, no entanto, um valor máximo definido para cada cliente, esse máximo é o limite atribuído automaticamente no momento do cadastro da empresa.'],
            ['quest' => 'O que devo fazer depois do meu cadastro aprovado?', 'answer' => 'Você deverá solicitar a antecipação através de suas notas por meio do arquivo .XML na plataforma, simule operações e selecione as parcelas que deseja antecipar, Selecione a conta bancária na qual deseja receber o dinheiro, Confirme a operação pela plataforma e por e-mail (um e-mail de confirmação será enviado), aguarde seu dinheiro na conta selecionada.'],
            ['quest' => 'O que está incluso no seu % de antecipação?', 'answer' => 'Emissão de boletos para seu cliente; Consultas de restrições; Assinaturas de Contratos; Custas de antecipação; Todos os impostos (não cobramos IOF); TUDO. O percentual de deságio na venda dos seus recebíveis é a única taxa que é cobrada nas suas operações de antecipação.'],
            ['quest' => 'Qual é a taxa cobrada pela cashTF?', 'answer' => 'O custo da operação é definido para cada empresa após a fase de análise de cadastro, através de automatização e geração de um score do cliente. No entanto, em caso de aprovação da solicitação, garantimos a competitividade de nossas taxas em relação ao mercado.']
        ];

        $all_questions_en = [
            ['quest' => 'What is cashTF?', 'answer' => 'We are a Fintech 100% transparent and focused on the growth of our customers. We carry out, in a totally digital and secure manner, prepayment of receivables operations, which support cash flow management. In this way, cashTF contributes to the development of your business. We anticipate your receivables with efficiency, transparency and agility, freeing you from bureaucracy and other obstacles and allowing you to dedicate yourself fully to the management of your company.'],
            ['quest' => 'What sales can I anticipate for cashTF?', 'answer' => 'You will be able to prepay receivables for invoices for products whose payment will be made by boleto with a maturity period between 5 and 150 days.'],
            ['quest' => 'What is our competitive advantage?', 'answer' => 'As we are a Securitization company (registration no. 43300063828), that is, a NON-financial company, we do not have IOF costs for the client / company, we act in the purchase of credit rights (bonds), in addition to having a transaction entirely online, as well we can share the LOWEST discount interest in the market, with no fees or tariffs on transactions.'],
            ['quest' => 'What happens if my client does not pay the bill on time?', 'answer' => 'If the customer does not pay by the due date, he / she will impose a fine and interest until the effective payment, if the drawee does not pay within 10 days after the due date, we will contact you to jointly resolve the non-payment.
            '],
            ['quest' => 'What to do to start using cashTF?', 'answer' => 'With just the CNPJ and CPF numbers as a partner or attorney of the company you already validate the data for later inclusion of your and company documents.
            After that, no later than 1 business day you will know the conditions of your advance.'],
            ['quest' => 'What is the deadline for receiving the sale value of receivables?', 'answer' => 'Once the transaction confirmation email is signed, you can view your money in the account within 60 minutes. This time is valid for operations sent until 4:00 pm on business days.'],
            ['quest' => 'What is the maximum and minimum anticipation?', 'answer' => 'There is no minimum value. You choose how much you want to advance monthly according to your need. There is, however, a maximum value defined for each customer, this maximum is the limit automatically assigned when registering the company.'],
            ['quest' => 'What should I do after my registration is approved?', 'answer' => 'You must request the advance through your notes through the .XML file on the platform, simulate operations and select the installments you want to anticipate, select the bank account where you want to receive the money, confirm the operation via the platform and by email (a confirmation email will be sent), wait for your money in the selected account.'],
            ['quest' => 'What is included in your% anticipation?', 'answer' => 'Issue of slips to your customer; Restriction queries; Contract Signatures; Anticipation costs; All taxes (we do not charge IOF); ALL. The discount percentage on the sale of its receivables is the only fee that is charged on its prepayment operations.'],
            ['quest' => 'What is the fee charged by cashTF?', 'answer' => 'The cost of the operation is defined for each company after the registration analysis phase, through automation and the generation of a customer score. However, if the request is approved, we guarantee the competitiveness of our rates in relation to the market.']
        ];

        $page = 'home';
        if(session('idioma') == 'pt' || session('idioma') == ''){
            return view('index', compact('page', 'all_questions'));
        }else{
            return view('index_en', compact('page', 'all_questions_en'));
        }
    }

    public function graficoInvestidor (Request $request) {
        $valor = (int)$request->query('valor');
        $taxas = Taxa::select('nome') ->orderBy('valor','ASC')->get();
        $selic = Taxa::select('valor')->where("nome", 'selic')->first();
        $cdi = Taxa::select('valor')->where("nome", 'cdi')->first();
        $poupanca = Taxa::select('valor')->where("nome", 'poupanca')->first();

        $taxa_selic = ($selic->valor / 12) / 100;
        $taxa_cdi = ($cdi->valor / 12) / 100;
        $taxa_poupanca = ($poupanca->valor / 12) / 100;

        if ($valor >= 5000 && $valor < 30000) $taxa_cdi += ($taxa_cdi / 10) * 3;
        if ($valor >= 30000 && $valor < 100000) $taxa_cdi += ($taxa_cdi / 10) * 5;
        if ($valor >= 100000) $taxa_cdi += ($taxa_cdi / 10) * 7;
        if ($valor >= 1000000) $taxa_cdi += ($taxa_cdi / 10) * 10;

        $grafico = [];
        $grafico["taxas"] = $taxas->map(function ($taxa) { return $taxa->nome; });
        $grafico["data"] = [];
        $now = date('m/Y');
        $last_date = date('m/Y', strtotime('+30 years'));

        $valor_acumulado_selic = $valor;
        $valor_acumulado_cdi = $valor;
        $valor_acumulado_poupanca = $valor;

        $last_value = 0;
        $valores = [$valor];

        for($i = 1; $i <= 30; $i++) {
            $date_year = date('m/Y', strtotime('+' . strVal($i) . 'years'));
            for ($j = 0; $j < 12; $j++) {
                $valor_acumulado_selic += $valor_acumulado_selic * $taxa_selic;
                $valor_acumulado_cdi += $valor_acumulado_selic * $taxa_cdi;
                $valor_acumulado_poupanca += $valor_acumulado_poupanca * $taxa_poupanca;
            }
            if ($valor_acumulado_cdi > $last_value) $last_value = $valor_acumulado_cdi;
            if ($valor_acumulado_selic > $last_value) $last_value = $valor_acumulado_selic;
            if (Str::endsWith($date_year, ['5', '0']) || $i == 1) $grafico["data"][$date_year] = [ "poupanca" => $valor_acumulado_poupanca, "cdi" => $valor_acumulado_cdi, "selic" => $valor_acumulado_selic ];
        }
        $valores[] = round($last_value, -3);
        $grafico["valores_min_max"] = $valores;

        return response()->json($grafico);
    }

    public function termos(){
        $page = 'conditions';
        return view('termos', compact('page'));
    }

    public function reset_password(){
        $page = 'reset_password';
        return view('partials.reset', compact('page'));
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

    function FormataData($data){
        if(isset($data)){
            return implode("/", array_reverse(explode("-", substr($data, 0, 10))));
        }else{
            return '';
        }
    }

    function SobeXml($nomeimg, $nomeimg_temp, $pasta){
		$imagem 		= $nomeimg; 		//$_FILES['txtimagem']['name'];
		$imgtemp 		= $nomeimg_temp; 	//$_FILES['txtimagem']['tmp_name']; 
		$file_info = pathinfo($imagem);
		$novonome = md5($imagem . date('G:i:s')) .'.'. $file_info['extension'];
		$destino = $pasta . $novonome;
		// Converte a extensão para minúsculo
		$extensao = strtolower ( $file_info['extension'] );

		if ( strstr ( '.xml', $extensao ) ) {
			if(move_uploaded_file($imgtemp, $destino)){
                dd('sucesso');
				return $novonome;
			}else{
				return null;
			}
		}else{
			return null;
		}
    }
    
    function salvaXML($xml){
        if($xml->isValid()){
            $path           = $xml->getClientOriginalName();
            $filename       = time().$path;
            $xml->move('uploads/xml', $filename);
            return $filename;
        }else{
            dd('notValid');
        }
    }

    public function parcelas(Request $request){
        $valor_juros_definido   = env('JUROS_DEFINIDO');
        $data_recebe            = $request->all();
        $vencimento_inicial     = HomeController::ReformataData($data_recebe['vencimento_inicial']);
        $valor                  = $data_recebe['valor'];
        $quantidade_parcela     = $data_recebe['quantidade_parcela'];
        $d                      = [];
        $data_hoje              = date('Y-m-d');
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
    
            if (strtotime($v_inicial) >= strtotime($data_hoje)) {
                $diff_dias          = number_format((strtotime($v_inicial) - strtotime($data_hoje)) / 86400, 0);
                $juros_definido     = number_format((((($valor_juros_definido / 30) * $diff_dias) * 100) / 100), 4);
                $juros_formatado    = number_format((((($valor_juros_definido / 30) * $diff_dias) * 100) / 100), 2);
                $valor_oficial      = str_replace('.', '', $valor);
                $valor_oficial      = str_replace(',', '.', $valor_oficial);
                $valor_com_juros    = $valor_oficial - (($juros_definido * $valor_oficial) / 100);
    
                $d['cobr'][] = array(
                    'nDup' => strval($i + 1),
                    'dVenc' => strval(HomeController::FormataData($v_inicial)),
                    'vDup' => number_format($valor_oficial, 2, ',', '.'),
                    'vTotal' => number_format($valor_com_juros, 2, ',', '.'),
                    'vJurosReal' => number_format(($valor_oficial - $valor_com_juros), 2, ',', '.'),
                    'vJuros' => $juros_formatado
                );
                if($i == 0){
                    $d['totalGeral'] = array(
                        'totalGeralSimples' => $valor_oficial,
                        'totalGeralJuros' => $valor_com_juros
                    );
                }else{
                    $d['totalGeral'] = array(
                        'totalGeralSimples' => $d['totalGeral']['totalGeralSimples'] + $valor_oficial,
                        'totalGeralJuros' => $d['totalGeral']['totalGeralJuros'] + $valor_com_juros
                    );
                }
            }
        }
    
        $juros_geral = ($d['totalGeral']['totalGeralSimples'] - $d['totalGeral']['totalGeralJuros']) / $d['totalGeral']['totalGeralSimples'] * 100;
        $d['totalGeral'] = array(
            'xml_file' => '',
            'totalGeralSimples' => number_format($d['totalGeral']['totalGeralSimples'], 2, ',', '.'),
            'totalGeralJuros' => number_format($d['totalGeral']['totalGeralJuros'], 2, ',', '.'),
            'jurosTotal' => number_format($juros_geral, 2),
            'jurosAplicado' => $valor_juros_definido
        );
    
    
        print json_encode($d);
    }

    public function parcelasInterna(Request $request){
        $idsession = $request->session()->get('id');
        if(isset($idsession)){
            $cliente                = Cliente::where('id','=',$idsession)->first();
        }else{
            $cliente                = Cliente::where('id','=',Auth::user()->id_cliente)->first();
        }
        
        if($cliente){
            $valor_juros_definido = $cliente->taxa_desagio;
        }else{
            $valor_juros_definido = 1.99;
        }
        
        if(!isset($cliente->tarifa_bordero)){
            $cliente->tarifa_bordero = "00,00";
        }

        $nro_bordero = Solicitacao::where('nro_bordero','!=','null')->orderBy('nro_bordero','DESC')->first();

        $data_recebe            = $request->all();
        $valor                  = $request->valor;
        $quantidade_parcela     = $request->quantidade_parcela;
        $d                      = [];
        $data_hoje              = date('Y-m-d');
        $vencimento_inicial     = date('Y-m-d', strtotime('+30 days'));
        $xml                    = $request->arquivo_nome;
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
    
            if (strtotime($v_inicial) >= strtotime($data_hoje)) {
                $diff_dias          = number_format((strtotime($v_inicial) - strtotime($data_hoje)) / 86400, 0);
                $juros_definido     = number_format((((($valor_juros_definido / 30) * $diff_dias) * 100) / 100), 4);
                $juros_formatado    = number_format((((($valor_juros_definido / 30) * $diff_dias) * 100) / 100), 2);
                $valor_oficial      = str_replace('.', '', $valor);
                $valor_oficial      = str_replace(',', '.', $valor_oficial);
                $valor_com_juros    = $valor_oficial - (($juros_definido * $valor_oficial) / 100);
                $tarifa_bordero     = intval($cliente->tarifa_bordero);
                $valor_com_juros2   = $valor_com_juros - $tarifa_bordero;
                $jurosTotal         = number_format(($valor_oficial - $valor_com_juros), 2, ',', '.');
                $d['cobr'][] = array(
                    'nDup' => strval($i + 1),
                    'dVenc' => strval(HomeController::FormataData($v_inicial)),
                    'vDup' => number_format($valor_oficial, 2, ',', '.'),
                    'vTotal' => number_format($valor_com_juros2, 2, ',', '.'),
                    'vJurosReal' => number_format(($valor_oficial - $valor_com_juros), 2, ',', '.'),
                    'vJuros' => $juros_formatado
                );
                if($i == 0){
                    $d['totalGeral'] = array(
                        'totalGeralSimples' => $valor_oficial,
                        'totalGeralJuros'   => $valor_com_juros2
                    );
                }else{
                    $d['totalGeral'] = array(
                        'totalGeralSimples' => $d['totalGeral']['totalGeralSimples'] + $valor_oficial,
                        'totalGeralJuros'   => $d['totalGeral']['totalGeralJuros'] + $valor_com_juros2
                    );
                }
            }
        }
        //dd($d);
        if($d['totalGeral']['totalGeralSimples'] != 0){
            $juros_geral = ($d['totalGeral']['totalGeralSimples'] - $d['totalGeral']['totalGeralJuros']) / $d['totalGeral']['totalGeralSimples'] * 100;
        }else{
            $juros_geral = 0;
        }

        $d['totalGeral'] = array(
            'xml_file' => $xml,
            'totalGeralSimples' => number_format($d['totalGeral']['totalGeralSimples'], 2, ',', '.'),
            'totalGeralJuros' => number_format($d['totalGeral']['totalGeralJuros'], 2, ',', '.'),
            'jurosTotal' => number_format($juros_geral, 2),
            'jurosAplicado' => $valor_juros_definido,
            'tac' => $cliente->tarifa_bordero,
            'nro_bordero' => $nro_bordero->nro_bordero + 1,
        );
    
    
        print json_encode($d);
    }
    
    public function importaXml(Request $request){
        $data_hoje = date('Y-m-d');
        $valor_juros_definido = env('JUROS_DEFINIDO');

        if ($_FILES['file']['name'] != '') {
            $xml                    = '';
            $xml                    = HomeController::SobeXml($_FILES['file']['name'], $_FILES['file']['tmp_name'], 'uploads/xml/');
            $xml_arquivo            = simplexml_load_file('uploads/xml/' . $xml);
            $id_nota                = '';

            //$xml_arquivo            = simplexml_load_file('../../uploads/xml/1d7a5b4c58a5759df4d7c7591dd6debc.xml');
            $dados                  = [];

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

                if(HomeController::validaCNPJ(strval($registro->infNFe->dest->CNPJ))){
                    $d['dest']["CNPJ"] = strval($registro->infNFe->dest->CNPJ);
                };

                if(HomeController::validaCPF(strval($registro->infNFe->dest->CPF))){
                    $d['dest']["CPF"] = strval($registro->infNFe->dest->CPF);
                };

                $d['totalGeral'] = array(
                    'totalGeralSimples' => 0,
                    'totalGeralJuros' => 0
                );

                $valor_original_nota = ((strval($registro->infNFe->pag->detPag) && strval($registro->infNFe->pag->detPag->vPag))?strval($registro->infNFe->pag->detPag->vPag):0);
                $valor_original = 0;
                //Faturas fat ou dup
                $diff_nfe = 0;
                foreach ($registro->infNFe->cobr as $fats) {
                    foreach ($fats as $f) {
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
                                $diff_nfe           = $diff_dias+$diff_nfe;

                                $d['cobr'][] = array(
                                    'nDup' => strval($f->nDup),
                                    'dVenc' => strval(HomeController::FormataData($f->dVenc)),
                                    'vDup' => number_format($valor_oficial, 2, ',', '.'),
                                    'vTotal' => number_format($valor_com_juros, 2, ',', '.'),
                                    'vJurosReal' => number_format(($valor_oficial - $valor_com_juros), 2, ',', '.'),
                                    'vJuros' => $juros_formatado,
                                    'diffDias' => $diff_dias
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
                    'jurosAplicado' => $valor_juros_definido,
                    'diffNfe'      => $diff_nfe/count($registro->infNFe->cobr)
                );
                
                $d['idNota'] = $id_nota;
                $d['idNota_reduzida'] = Str::limit($id_nota, 5);
                
                $dados[] = $d;
                break;
            endforeach;

            print json_encode($dados[0]);
        }
    }
   
    public function importaXmlInterno(Request $request){
        $data_hoje = date('Y-m-d');
        $idsession = $request->session()->get('id');
        if(isset($idsession)){
            $ultima_solicitacao = Solicitacao::where('id_solicitante', $idsession)->latest('id')->first();
            $cliente                = Cliente::where('id','=',$idsession)->first();
        }else{
            $ultima_solicitacao = Solicitacao::where('id_solicitante', Auth::user()->id_cliente)->latest('id')->first();
            $cliente                = Cliente::where('id','=',Auth::user()->id_cliente)->first();
        }

        if($cliente){
            $valor_juros_definido = $cliente->taxa_desagio;
        }else{
            $valor_juros_definido = 1.99;
        }

        if(!isset($cliente->tarifa_bordero)){
            $cliente->tarifa_bordero = "00,00";
        }

        $nro_bordero = Solicitacao::where('nro_bordero','!=','null')->orderBy('nro_bordero','DESC')->first();

        $dadoscont = 0;
        $dados                  = [];
        foreach($request->file as $file){
            if ($file != '') {
                //dd($file->get());
                $xml                    = '';
                //$xml                    = HomeController::SobeXml($file->getClientOriginalName(), $file->getClientOriginalName(), 'uploads/xml/');
                $xml                    = HomeController::salvaXML($file);
                $xml_arquivo            = simplexml_load_file('uploads/xml/' . $xml);
                //dd($xml_arquivo);
                $id_nota                = '';
                //$xml_arquivo            = simplexml_load_file('../../uploads/xml/1d7a5b4c58a5759df4d7c7591dd6debc.xml');

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
                    
                    //Separando a data
                    $data =  strval($registro->infNFe->ide->dhEmi);
                    $data = explode("T",$data);
                    //Formatando a data
                    $data = strtotime($data[0]);
                    $data = date('d/m/Y',$data);
                    
                    $d['ide'] = array(
                        'dhEmi' => $data
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
                        'cPais' => strval($registro->infNFe->dest->enderDest->cPais),
                        'xPais' => strval($registro->infNFe->dest->enderDest->xPais),
                        'indIEDest' => strval($registro->infNFe->dest->indIEDest)
                    );

                    $cepFormat = strval($registro->infNFe->dest->enderDest->CEP);
                    $cepFormat = preg_replace("/\D/", '', $cepFormat);
                    $cepFormat = preg_replace("/(\d{5})(\d{3})/", "\$1-\$2", $cepFormat);
                    $d['dest']["CEP"] = $cepFormat;

                    $foneFormat = strval($registro->infNFe->dest->enderDest->fone);
                    $foneFormat = preg_replace("/\D/", '', $foneFormat);
                    $foneFormat = "(".substr($foneFormat,0,2).") ".substr($foneFormat,2,-4)." - ".substr($foneFormat,-4);
                    $d['dest']["fone"] = $foneFormat;

                    if(HomeController::validaCNPJ(strval($registro->infNFe->dest->CNPJ))){
                        $cnpjFormat = strval($registro->infNFe->dest->CNPJ);

                        $cnpjFormat = preg_replace("/\D/", '', $cnpjFormat);
                        $cnpjFormat = preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpjFormat);

                        $d['dest']["CNPJ"] = $cnpjFormat;
                    };

                    if(HomeController::validaCPF(strval($registro->infNFe->dest->CPF))){
                        $cpfFormat = strval($registro->infNFe->dest->CPF);

                        $cpfFormat = preg_replace("/\D/", '', $cpfFormat);
                        $cpfFormat = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cpfFormat);

                        $d['dest']["CPF"] = $cpfFormat;
                    };

                    $d['totalGeral'] = array(
                        'totalGeralSimples' => 0,
                        'totalGeralJuros' => 0
                    );

                    $valor_original_nota = ((strval($registro->infNFe->pag->detPag) && strval($registro->infNFe->pag->detPag->vPag))?strval($registro->infNFe->pag->detPag->vPag):0);
                    $valor_original = 0;
                    //Faturas fat ou dup
                    $soma_de_juros  = 0;
                    $diff_nfe       = 0;
                    $conta          = 0;
                    foreach ($registro->infNFe->cobr as $fats) {
                        foreach ($fats as $f) {
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
                                    $tarifa_bordero     = intval($cliente->tarifa_bordero);
                                    $valor_com_juros2   = $valor_com_juros - $tarifa_bordero;
                                    $diff_nfe           = $diff_dias+$diff_nfe;
                                    $conta++;

                                    $soma_de_juros      = $juros_formatado;

                                    $d['cobr'][] = array(
                                        'nDup' => strval($f->nDup),
                                        'dVenc' => strval(HomeController::FormataData($f->dVenc)),
                                        'vDup' => number_format($valor_oficial, 2, ',', '.'),
                                        'vTotal' => number_format($valor_com_juros2, 2, ',', '.'),
                                        'vJurosReal' => number_format(($valor_oficial - $valor_com_juros), 2, ',', '.'),
                                        'vJuros' => $juros_formatado,
                                        'diffDias' => $diff_dias
                                    );
                                    $d['totalGeral'] = array(
                                        'totalGeralSimples' => $d['totalGeral']['totalGeralSimples'] + $valor_oficial,
                                        'totalGeralJuros' => $d['totalGeral']['totalGeralJuros'] + $valor_com_juros2
                                    );
                                }
                            }
                        }
                    }

                    if($conta == 0){
                        $conta++;
                    }

                    $juros_geral = (($d['totalGeral']['totalGeralSimples'] != 0)?($d['totalGeral']['totalGeralSimples'] - $d['totalGeral']['totalGeralJuros']) / $d['totalGeral']['totalGeralSimples'] * 100:0);
                    $d['totalGeral'] = array(
                        'xml_file' => $xml,
                        'totalGeralSimples' => number_format($d['totalGeral']['totalGeralSimples'], 2, ',', '.'),
                        'totalGeralJuros' => number_format($d['totalGeral']['totalGeralJuros'], 2, ',', '.'),
                        'jurosTotal' => number_format($juros_geral, 2),
                        'valorSoma' => number_format($valor_original, 2, ',', '.'),
                        'valorOriginalNota' => number_format($valor_original_nota, 2, ',', '.'),
                        'jurosAplicado' => $valor_juros_definido,
                        'jurosSomado'   => $soma_de_juros,
                        'tac'      => $cliente->tarifa_bordero,
                        'nro_bordero' => $nro_bordero->nro_bordero + 1, 
                    );
                    
                    $d['idNota'] = $id_nota;
                    $d['idNota_reduzida'] = Str::limit($id_nota, 5);
                    
                    $dados[$dadoscont] = $d;
                    break;
                endforeach;
                //print json_encode($dados);
            }
            $dadoscont++;
        }
        return json_encode($dados);
    }

    public function atualizaParcelas(Request $request){

        $data_recebe = json_decode(file_get_contents("php://input"));
        if(!empty($data_recebe->data_venc)){
            $venc_parcela   = str_replace('/', '-', $data_recebe->data_venc);
        }else{
            $venc_parcela = date('d-m-Y');
        }

        $data_hoje = date('d-m-Y');

        if(!empty($data_recebe->valor)){
            $valor_parcela      = str_replace('.', '', $data_recebe->valor);
            $valor_parcela = str_replace(',', '.', $valor_parcela);
        }else{
            $erro = '{"erro" : "valor da parcela inválido"}';
            return $erro;
        }
        if(!empty($data_recebe->total)){
            $valor_total = str_replace('.', '', $data_recebe->total);
            $valor_total = str_replace(',', '.', $valor_total);
        }else{
            $erro = '{"erro" : "valor total inválido"}';
            return $erro;
        }

        if(!empty($data_recebe->total_juros)){
            $valor_total_juros = str_replace('.', '', $data_recebe->total_juros);
            $valor_total_juros = str_replace(',', '.', $valor_total_juros);
        }else{
            $erro = '{"erro" : "valor total/juros inválido"}';
            return $erro;
        }

        $cliente = Cliente::where('id','=',Auth::user()->id_cliente)->first();

        if($cliente){
            $valor_juros_definido = $cliente->taxa_desagio;
        }else{
            $valor_juros_definido = 1.99;
        }

        if (strtotime($venc_parcela) >= strtotime($data_hoje)) {
            $diff_dias = 0;
            $juros_definido = 0;
            $valor_oficial = 0;
            $valor_com_juros = 0;

            $diff_dias          = number_format((strtotime($venc_parcela) - strtotime($data_hoje)) / 86400, 0);
            $juros_definido     = number_format((((($valor_juros_definido / 30) * $diff_dias) * 100) / 100), 4);
            $juros_formatado    = number_format((((($valor_juros_definido / 30) * $diff_dias) * 100) / 100), 2);
            $valor_com_juros    = $valor_parcela - (($juros_definido * $valor_parcela) / 100);
            
            $valor_total = number_format(($valor_total + $valor_parcela), 2, ',', '.');
            $valor_total_juros = number_format(($valor_total_juros + $valor_com_juros), 2, ',', '.');
            $juros = number_format(($valor_parcela - $valor_com_juros), 2, ',', '.');
            $valor_com_juros = number_format($valor_com_juros, 2, ',', '.');
            $valor_parcela = number_format($valor_parcela, 2, ',', '.');

            $dados = [];
            $dados['vJuros'] = $valor_com_juros;
            $dados['juros'] = $juros;
            $dados['vTotalJuros'] = $valor_total_juros;
            $dados['vTotal'] = $valor_total;
            $dados['dias'] = $diff_dias;
            $dados['porcJuros'] = $juros_formatado;
            $dados['vDupForm'] = $valor_parcela;
            //dd($dados);
            print json_encode($dados);
        }
    }

    public function removeParcela(Request $request){

        $data_recebe = json_decode(file_get_contents("php://input"));
        //dd($data_recebe);
        if(empty($data_recebe->valor) || $data_recebe->valor == 0){
            $erro = '{"erro" : "Valor zerado"}';
            return $erro;
        } 
        if(!empty($data_recebe->valor)){
            $valor_parcela      = str_replace('.', '', $data_recebe->valor);
            $valor_parcela = str_replace(',', '.', $valor_parcela);
        }else{
            $erro = '{"erro" : "valor da parcela inválido"}';
            return $erro;
        }
        if(!empty($data_recebe->total)){
            $valor_total = str_replace('.', '', $data_recebe->total);
            $valor_total = str_replace(',', '.', $valor_total);
        }else{
            $erro = '{"erro" : "valor total inválido"}';
            return $erro;
        }

        if(!empty($data_recebe->total_juros)){
            $valor_total_juros = str_replace('.', '', $data_recebe->total_juros);
            $valor_total_juros = str_replace(',', '.', $valor_total_juros);
        }else{
            $erro = '{"erro" : "valor total/juros inválido"}';
            return $erro;
        }

        if(!empty($data_recebe->valor_parcela)){
            $valor_juros_parcela = str_replace('.', '', $data_recebe->valor_parcela);
            $valor_juros_parcela = str_replace(',', '.', $valor_juros_parcela);
        }else{
            $erro = '{"erro" : "valor parcela anterior inválido"}';
            return $erro;
        }
        
        $valor_total = number_format(($valor_total - $valor_parcela), 2, ',', '.');
        $valor_total_juros = number_format(($valor_total_juros - $valor_juros_parcela), 2, ',', '.');

        $dados = [];
        $dados['vTotalJuros'] = $valor_total_juros;
        $dados['vTotal'] = $valor_total;

        print json_encode($dados);
    }

    public function atualizaDatas(Request $request){
        $data   = $request->dados;
        $total  = $request->total;
        $diff   = 0;
        $i      = 0;
        //dd($dados);
        foreach($data as $d){
            $data_venc      = HomeController::ReformataData($d['dVenc']);
            $data_venc      = new DateTime($data_venc);
            $data_atual     = new DateTime();
            $diff           = date_diff($data_atual, $data_venc);
            //$valor          = 
        }
        if($diff->y > 0){
            $diff->m = ($diff->y*12) + $diff->m;
        }

        if($diff->m > 0){
            $diff->d = ($diff->m*30) + $diff->d;
        }

        /*$cliente = Cliente::where('id','=',Auth::user()->id_cliente)->first();

        if($cliente){
            $juros = $cliente->taxa_desagio;
        }else{
            $juros = 1.99;
        }

        $desagio = ($juros/30)*$diff->d;*/
        $new = str_replace('.', '', $total['totalGeralSimples']);
        $new = str_replace(',', '.',$new);
        $new2 = str_replace('.', '', $total['totalGeralJuros']);
		$new2 = str_replace(',', '.',$new2);
        $jurosSub   = $new - $new2;
        //dd($jurosSub);
        $diff       = '{"diff" : '.$diff->d.', "juros" : '.$jurosSub.'}';

        return $diff;
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
    /* página about */
    public function about(Request $request){
        $idioma = Input::get('i');
        if($idioma != ''){
            $request->session()->put('idioma', $idioma);
        }
        
        $page = 'about';
        if(session('idioma') == 'pt' || session('idioma') == ''){
            return view('about', compact('page')); 
        }else{
            return view('about_en', compact('page'));
        }
    }
    /* página invest */
    public function invest(Request $request){
        $idioma = Input::get('i');
        if($idioma != ''){
            $request->session()->put('idioma', $idioma);
        }

        $duvidas = [
            ['titulo' => 'Qual é a garantia de investir na cashTF?', 'descricao' => 'Temos uma carteira de recebíveis bastante sólida para a garantia do investidor, somos uma plataforma que através da inteligência artificial analisamos fraudes e risco das operações de antecipação e mantemos a carteira de títulos bastante pulverizada, assim minimizando os riscos. Por isso hoje nossa taxa de inadimplência é ZERO.'],
            ['titulo' => 'O que são debêntures?', 'descricao' => 'A debênture é um investimento de renda fixa emitido por uma empresa, que por sua vez, pode ser privada ou estatal. Basicamente, ela funciona como um empréstimo do seu dinheiro para a companhia. Em troca, você recebe uma taxa de rentabilidade que é acertada na hora da compra.'],
            ['titulo' => 'Quanto tempo devo deixar o investimento em debêntures?', 'descricao' => 'O investimento em renda fixa(Debêntures), com baixo risco, as cartelas têm o vencimento em 2 anos, permanência mínima de 6 meses e liquidez em 30 dias, os resgates podem ser antecipados com alteração nas taxas de rentabilidade aplicada nas debêntures.'],
            ['titulo' => 'Posso fazer uma TED de qualquer conta?', 'descricao' => 'A transferência bancária deve ser feita somente pela conta da pessoa física ou jurtídica cadastrada na plataforma.'],
            ['titulo' => 'Qual é a tributação sobre o meu investimento?', 'descricao' => 'De acordo com a Receita Federal a alíquota de Imposto de Renda (IR) é somente gerada sobre o RENDIMENTO, conforme data de vencimento ou resgate da aplicação. Até 180 dias, alíquota de IR de 22,5%; de 181 até 360 dias, alíquota de 20%; de 361 até 720 dias, alíquota de 17,5% e; acima de 721 dias, alíquota de 15,0%.'],
            ['titulo' => 'Qual valor mínimo investir?', 'descricao' => 'O valor mínimo para investir é de R$ 1.000,00 com o rendimento de 130% do CDI, já acima do rendimento do mercado.'],
            ['titulo' => 'Como devo proceder para começar a investir na cashTF?', 'descricao' => 'Faça seu cadastro simplificado no site, escolha o valor e o grau de investimento (cliente STARTER, PRO, ELITE e PREMIUM), faça a transferência bancária ou solicite um boleto para pagamento de seu investimento. Depois é só esperar os rendimentos!'],
            ['titulo' => 'A cashTF cobra taxa ou tarifa para abertura de conta?', 'descricao' => 'Não cobramos tarifas ou taxas tanto para abertura de conta, quanto para antecipação dos seus recebíveis.'],
            
        ];

        $duvidas_en = [
            ['titulo' => 'What is the guarantee of investing with cashTF?', 'descricao' => 'We have a portfolio of receivables that is pretty solid for the investor guarantee, we are a platform that through the artificial intelligence we analyze frauds and the risks of anticipation operations, and we keep our securities portfolio quite pulverized, so this way we minimize the risks. Thats why our default rate is ZERO.'],
            ['titulo' => 'What does debentures means?', 'descricao' => 'Debentures is a type of investment that have fixed income issued by a company, in turn, can be private or state-owned. Basically, it works as a loan of your money for the company. In charge, you receive a rate of return, which we agree in the hour that you buy it.'],
            ['titulo' => 'How much time do I have to invest in debentures?', 'descricao' => 'The fixed income investment(debentures), with low risk taking, the cards have a due date of 2 years, permanence time of 6 months and liquidity of 30 days, the rescue can be anticipated with a change in the profitability rates applied to the debentures.'],
            ['titulo' => 'Can I make a TED with any account?', 'descricao' => 'The bank transfer should be done only by the individual account or legal person registered in the platform.'],
            ['titulo' => 'What is the taxation on my investment?', 'descricao' => 'According to the Federal Revenue Service, the rate of Income Tax (IR) is only generated on the INCOME, according to the date of maturity or redemption of the investment. Up to 180 days, income tax rate of 22.5%; from 181 to 360 days, rate of 20%; from 361 to 720 days, rate of 17.5% and; above 721 days, rate of 15.0%.'],
            ['titulo' => 'What is the minimum amount to invest?', 'descricao' => 'The minimum amount to invest it is R$ 1.000,00 with the yield of 130% of the CDI, already above the market performance.'],
            ['titulo' => 'How should I proceed to start investing with cashTF?', 'descricao' => 'First register your account simplified on the website, then choose the amount and the investment rate (clients can be STARTER, PRO, ELITE and PREMIUM), make your bank transfer or request a bill for the payment of your investment. After that just wait to receive the yields!'],
            ['titulo' => 'cashTF charges fee or tariff to open an account?', 'descricao' => 'No, we don’t charge any types of fees or tariffs neither on opening accounts nor for your receivables anticipation.'],
        ];

        $page = 'invest';

        if(session('idioma') == 'pt' || session('idioma') == ''){
            return view('invest', compact('page', 'duvidas')); 
        }else{
            return view('invest_en', compact('page', 'duvidas_en'));
        }
    } 

    public function sendContact(Request $req) {
        
        Mail::to('rodrigo.zamprogna@cashtf.com')->send(new ContactEmail($req));
        Mail::to($req->email)->send(new RemetenteInvista($req));
        return redirect('/invista')->with('modal', true);
    }
    

}

