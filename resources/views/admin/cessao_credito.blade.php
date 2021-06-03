<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
</head>
<style>
    .container{width:90%;padding-right:45px;padding-left:45px;margin-right:auto;margin-left:auto;}
    .row{margin-right:25px;margin-left:5px;}
    .text-capitalize{text-transform:capitalize!important;}
    .text-center{text-align:center;}
    .text-justify{text-align: justify;}
    .upper{text-transform: uppercase;}
</style>
<body class="drawer drawer--right upper">
    <div class="container text-justify">
        <div class="row" style="margin-top: 50px; padding-bottom: 25px;">
            <h4 class="text-capitalize text-center"><b>INSTRUMENTO PARTICULAR DE CESSÃO DE CRÉDITOS E OUTRAS AVENÇAS</b></h1>
        </div>
        <div class="row">
            <p><b>CEDENTE: {{isset($solicitante) ? $solicitante->OfficialName : ''}}, CNPJ: {{isset($solicitante) ? $solicitante->cnpj : ''}}</b>, Endereço:  {{isset($endereco) ? $endereco->Endereco_Lgr : ''}}, {{isset($endereco) ? $endereco->Endereco_Nro : ''}}, {{isset($endereco) ?  $endereco->Endereco_Complemento : ''}}, CEP: {{isset($endereco) ? $endereco->Endereco_CEP : ''}}, Bairro: {{isset($endereco) ? $endereco->Endereco_Bairro : ''}}, Cidade: {{isset($endereco) ? $endereco->Endereco_Mun : ''}}, País: {{isset($endereco) ? $endereco->Endereco_Pais : ''}}, neste ato representada conforme os seus atos constitutivos.<p>
            <p><b>CESSIONÁRIO: ZAMPROGNA SECURITIZADORA S/A, CNPJ: 35.262.759/0001-27</b>, Endereço: RUA JÚLIO CAMPOS, 591, APARTAMENTO 904, CEP: 99200-000, Bairro: CENTRO, Cidade: GUAPORÉ-RS, neste ato representada conforme os seus atos constitutivos.</p>
            <p><b>FIADORES: </b></p>
            @foreach($socios as $c)
                @if($c->nome == $solicitante->Name)
                <p>{{$c->nome}}, CPF: {{$c->cpf}}, RG: {{$c->rg}}, Orgão Emissor: {{$c->orgaoEmissor}}, Nacionalidade: {{$c->nationality}}, empresário, Endereço:  {{isset($enderecof) ? $enderecof->Endereco_Lgr : ''}}, {{isset($enderecof) ? $enderecof->Endereco_Nro : ''}}, {{isset($enderecof) ?  $enderecof->Endereco_Complemento : ''}}, CEP: {{isset($enderecof) ? $enderecof->Endereco_CEP : ''}}, Bairro: {{isset($enderecof) ? $enderecof->Endereco_Bairro : ''}}, Cidade: {{isset($enderecof) ? $enderecof->Endereco_Mun : ''}}, País: {{isset($enderecof) ? $enderecof->Endereco_Pais : ''}}
                    @if(isset($c->conjuge_nome))
                        , casado com {{$c->conjuge_nome}}, CPF: {{$c->conjuge_cpf}}, RG: {{$c->conjuge_rg}}, Nacionalidade: {{$c->conjuge_nationality}}, {{$c->conjuge_profissao}}.
                    @endif
                </p>
                @else
                <p>{{$c->nome}}, CPF: {{$c->cpf}}, RG: {{$c->rg}}, Orgão Emissor: {{$c->orgaoEmissor}}, Nacionalidade: {{$c->nationality}}, empresário , Endereço:  {{isset($c->enderecos) ? $c->enderecos->Endereco_Lgr : ''}}, {{isset($c->enderecos) ? $c->enderecos->Endereco_Nro : ''}}, {{isset($c->enderecos) ?  $c->enderecos->Endereco_Complemento : ''}}, CEP: {{isset($c->enderecos) ? $c->enderecos->Endereco_CEP : ''}}, Bairro: {{isset($c->enderecos) ? $c->enderecos->Endereco_Bairro : ''}}, Cidade: {{isset($c->enderecos) ? $c->enderecos->Endereco_Mun : ''}}, País: {{isset($c->enderecos) ? $c->enderecos->Endereco_Pais : ''}}
                    @if(isset($c->conjuge_nome))
                        , casado com {{$c->conjuge_nome}}, CPF: {{$c->conjuge_cpf}}, RG: {{$c->conjuge_rg}}, Nacionalidade: {{$c->conjuge_nationality}}, {{$c->conjuge_profissao}}.

                    @else
                    , {{$c->estadoCivil}}.
                    @endif            
                </p>
                @endif
            @endforeach
            <p>As partes acima qualificadas têm entre si, justo e convencionado o presente Instrumento Particular de Contrato de Cessão de Créditos e Outras Avenças, que passa a vigorar de acordo com as cláusulas e condições seguintes:</p>
            
            <h4 class="text-capitalize text-center"><b>OBJETO</b></h4>
            <p>
            <b> I – </b>O objeto do presente contrato é a cessão de créditos à <b>CESSIONÁRIA</b> oriundos de recebíveis lastreados por duplicatas, cheques, contratos de fornecimentos, notas promissórias e quaisquer outros instrumentos que consubstanciem créditos a receber da <b>CEDENTE</b>: 
            </p>
            <p>
            <b>II – </b>O <b>CEDENTE</b> se responsabiliza pela existência, validade e adimplência de todos os créditos que vier a ceder à <b>CESSIONÁRIA</b> em virtude deste contrato, sob pena de responsabilização integral pelos créditos cedidos, além de multa no valor equivalente ao crédito cedido.
            </p>
            <h4 class="text-capitalize text-center"><b>CONDIÇÕES DE CESSÃO</b></h4>

            <p>    
            <b>III – </b>O <b>CEDENTE</b>, por este instrumento, possuirá até o limite de R$ <b>{{$credito}}</b> mensais pré-aprovados para a cessão de créditos à <b>CESSIONÁRIA</b>.
            </p>   
            <p><b>Parágrafo Primeiro: </b>O valor de cada operação será objeto de ordem de serviço em separado em forma eletrônica, denominada BORDERÔ, contendo o nome do <b>CEDENTE</b>, a identificação do crédito, o valor da cessão, e a identificação do Devedor, as quais integram o presente contrato para todos os fins. O BORDERÔ será assinado eletronicamente por representante(s) do <b>CEDENTE</b>.</p>
            <p><b>Parágrafo Segundo:</b> é a contra-proposta eletrônica de negócio do <b>CESSIONÁRIO</b> para o <b>CEDENTE</b>, utilizando formulário eletrônico específico, aceita pelo financiado, por meio da aposição da(s) assinatura(s) eletrônica(s) através da empresa Clicksign, por intermédio da solução eletrônica do financiador, denominada <b>cashTF.com</b>.</p>

            <p><b>Parágrafo Terceiro: </b>Nos termos do artigo 104 do Código Civil, as partes atribuem, por mútuo acordo, sem nenhum dolo ou coação, validade aos negócios jurídicos realizados por intermédio do BORDERÔ, com utilização de assinatura(s) eletrônica(s) ou assinatura(s) digital (ais) do(s)representante(s) do <b>CEDENTE</b>, assim com validade jurídica.
            </p>
            <p><b>Parágrafo Quarto:</b> O <b>CESSIONÁRIO</b> pode, a seu exclusivo critério, dispensar o <b>CEDENTE</b> de apresentar o BORDERÔ, assumindo este, o encargo de Fiel Depositário do mesmo.
            </p>
            <p><b>Parágrafo Quinto: </b>O <b>CESSIONÁRIO</b> reserva-se o direito de selecionar os Títulos que serão cedidos, podendo recusar os que não atendam Às suas exigências operacionais, ou que não estejam revestidos das Formalidades legais.
            </p>
            <p><b>Parágrafo Sexto: </b>O BORDERÔ emitido pelo <b>CEDENTE</b> integra o presente Contrato, formando com ele um todo único e indivisível para todos os fins de direito.
            </p>
            <p><b>Parágrafo Sétimo: </b>o <b>CEDENTE</b>, sem prejuízo de eventual Responsabilidade criminal de seus dirigentes, funcionários e Prepostos, responde, de forma exclusiva, civilmente, por perdas e Danos perante o financiador, o sacado e perante eventuais terceiros, Pela integridade e legitimidade das informações e dos dados Constantes de todos os documentos – tais como, mas não se limitando, A borderôs, borderôs eletrônicos, títulos e documentos Comprobatórios dos negócios que ensejaram a emissão dos referidos Títulos – que forem repassados ao financiador, seja por via física ou Eletrônica, seja por intermédio de quaisquer outros meios avençados ou que venham a ser ajustados formalmente, por escrito, entre as Partes.</p>
            <p><b>Parágrafo Oitavo: </b>na hipótese de serem entregues pelo <b>CEDENTE</b> ao <b>CESSIONÁRIO</b> documentos fraudulentos, espúrios, Inexistentes, ou por erro, é reservado a este, uma vez tomando o <b>CESSIONÁRIO</b> conhecimento de tais inconformidades, o direito de não realizar o desconto não só do título nestas condições, mas também, cautelarmente, de não prosseguir com quaisquer cessões existentes em carteira.</p>
            <p><b>Parágrafo Nono: </b>Enquanto não adimplido o crédito eventualmente não pago pelo devedor do título cedido, o <b>CESSIONÁRIO</b> poderá suspender quaisquer operações de aquisição de créditos do <b>CEDENTE</b>.
            </p>
            <p><b>Parágrafo Décimo: </b>Pelo não pagamento do crédito inadimplido pelo devedor do título cedido, o <b>CEDENTE</b> arcará com multa de 20% sobre o valor do crédito, acrescido de juros de mora de 1% ao mês e correção monetária pela variação positiva do IPCA/IBGE.
            </p>
            <p><b>IV –</b> A liberação de valores referentes à cessão somente ocorrerá após a <b>CESSIONÁRIA</b> verificar a validade e existência dos créditos cedidos, o que ocorrerá em um prazo de até 5 dias.
            </p>
            <p><b> V – </b>Após o prazo definido no item acima, o valor acordado será liberado diretamente na conta bancária ou conta digital indicada pelo <b>CEDENTE</b>
            </p>
            <p><b>VI – </b>O <b>CEDENTE</b> compromete-se, no prazo improrrogável de 24h a contar da ordem de serviço a comunicar o Devedor sobre a cessão do crédito realizada, para fins do disposto no art. 290, do Código Civil.
            </p>
            <p> <b>VII – </b>Ao realizar a cessão, o <b>CESSIONÁRIO</b> sub-roga-se em todos os direitos e garantias do crédito originalmente concebido ao <b>CEDENTE</b>.
            </p>
            <p><b>Parágrafo Primeiro: </b>o <b>CEDENTE</b> se responsabiliza-se pela solvência dos Devedores dos respectivos títulos cedidos. Na ocorrência de Valores não pagos pelos devedores nos respectivos vencimentos dos Títulos cedidos, inclusive aqueles que vierem a vencer após o Término de vigência deste contrato, o <b>CESSIONÁRIO</b> debitará o valor correspondente ao crédito das contas digitais mantidas junto a <b>cashtf.com</b> ou, se caso, o <b>CEDENTE</b> não tiver contas digitais poderá ser cobrado via notificação extrajudicial ou judicial com possibilidade de negativação junto aos órgãos protetores de crédito (SERASA, SPC, etc). </p>
            <p><b> Parágrafo Segundo: </b>O prazo de reembolso é de 2 dias úteis após o vencimento do título não pago pelo devedor e poderá, a qualquer tempo, ser alterado. Para tanto, o <b>CEDENTE</b> deverá efetuar solicitação por escrito ao <b>CESSIONÁRIO</b> que, concordando com o novo prazo, comunicá-loá ao por meio eletrônico, ficando as operações já contratadas e ainda não pagas, automaticamente, sob a nova condição.</p>
            <p><b>Parágrafo Terceiro: </b>Pelo reembolso dos títulos cedidos e não pagos pelos devedores, responderão os FIADORES assumindo a responsabilidade pelo cumprimento de todas as obrigações desse Contrato.</p>

            <p> <b>Parágrafo Quarto: </b>A presente Fiança é outorgada e será interpretada de acordo com as Leis Brasileiras em vigor. Para tal efeito, os FIADORES expressa e formalmente renunciam aos privilégios e benefícios do Código Civil, Lei 10.406/2002, previstos nos artigos 827, 834, 835, 837, 838 e 839.</p>

            <p><b>Parágrafo Quinto: </b>Em caso de ausência, morte, exoneração, interdição, insolvência ou falência dos FIADORES, obriga-se o <b>CEDENTE</b>, no prazo de 30 (trinta) dias, apresentar substituto idôneo ou outra forma de garantia a juízo do <b>CESSIONÁRIO</b>.</p>

            <p><b>Parágrafo Sexto: </b>O <b>CEDENTE</b> autoriza o <b>CESSIONÁRIO</b> a descontar, pela adimplência dos créditos cedidos, quaisquer importâncias levadas, a qualquer título, a crédito da conta digital mantida junto a <b>cashTF.com</b>.</p>

            <p><b>VIII – </b>Fica o <b>CESSIONÁRIO</b>, após a cessão, autorizado à realização de protesto ou negativação sobre os títulos vencidos e não pagos pelos devedores.</p>
            

            <h4 class="text-capitalize text-center"><b>DO PRAZO DO CONTRATO</b></h4>

            <p><b> IX – </b>O presente instrumento terá duração de 12 (doze meses), podendo ao final ser renovado por igual período.

            <p><b> Parágrafo primeiro:</b> Não tendo, qualquer das partes, a intenção de renovação deste instrumento, deverá notificar a outra com pelo menos 30 (trinta) dias de antecedência.</p>

            <p><b>Parágrafo segundo: </b>O presente instrumento também poderá ser rescindido por qualquer das partes a qualquer momento, desde que também notificado a contraparte no prazo de 30 (trinta) dias. A rescisão deste instrumento não afetará as cessões já realizadas.</p>

            <h4 class="text-capitalize text-center"><b>CONDIÇÕES GERAIS</b></h4>

            <p><b>X – </b>As partes contratantes declaram aceitar o presente instrumento particular em todos os seus expressos termos e condições, tal qual se acha redigido, com fins a perfectibilizar a cessão e transferência do crédito e todos os direitos dos créditos supra descritos do <b>CEDENTE</b> para o <b>CESSIONÁRIO</b>.</p>

            <p><b>XI –</b> O presente Instrumento Particular de Contrato de Cessão de Créditos e Outras Avenças está regulado e regido pelos Artigos 286 e seguintes do Código Civil, sendo que o <b>CEDENTE</b> cede e transfere a integralidade do seu crédito, de forma irrevogável e irretratável,  para o <b>CESSIONÁRIO</b>, o qual se sub-roga a todos os direitos e ações.</p>

            <p><b>XII –</b> O <b>CEDENTE</b> fica obrigado a informar ao <b>CESSIONÁRIO</b> toda e qualquer alteração em seus dados cadastrais.</p>

            <p><b>XIII -</b> As partes celebram o presente instrumento em caráter irrevogável e irretratável, comprometendo-se por si, seus herdeiros e/ou sucessores.</p>

            <p><b>XIV – </b>As partes estabelecem o Foro de Guaporé/RS como o competente para dirimir quaisquer dúvidas ou disputas relativas ao presente instrumento, excluindo quaisquer outros por mais privilegiados que sejam.</p>
            <p class="text-center" style="padding-top: 20px;">
        <?
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $data = strftime('%d de %B de %Y', strtotime('today'));
        ?>
        Guaporé-RS, <?echo $data; ?>
        </p>
            <p class="text-center" style="padding-top: 20px;">______________________________________________</p>
            <p class="text-center"><b>CEDENTE</b></p>
            <p class="text-center" style="padding-top: 20px;">______________________________________________</p>
            <p class="text-center" ><b>ZAMPROGNA SECURITIZADORA S/A</b></p>
            <p><b>FIADORES: </b></p>
            @foreach($socios as $socio)
            <p class="text-center" style="padding-top: 20px;">______________________________________________</p>
            <p class="text-center"><b>{{$socio->nome}}</b></p>
                @if(isset($socio->conjuge_nome))
                    <p class="text-center" style="padding-top: 20px;">______________________________________________</p>
                    <p class="text-center"><b>{{$socio->conjuge_nome}}</b></p>
                @endif
            @endforeach   
            <p>Testemunhas:</p>
                <div class="" style="width: 100%">
                    <br />
                    <div class='line' style='border-bottom: 1px solid black; width: 50%;'>
                    </div>
                    <p>Ricardo Eliseu Miotto</p>
                    <p>CPF: 016.020.890-43</p>
                    <br />
                </div>
                <div class="" style="width: 100%; padding-top: 2px;">
                    <br />
                    <div class='line' style='border-bottom: 1px solid black; width: 50%;'>
                    </div>
                    <p>Neiva Lourdes Gado</p>
                    <p>CPF: 389.815.640-00</p>
                    <br />
                </div>
        </div>
    </div>
</body>
</html>
