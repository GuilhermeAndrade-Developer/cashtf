<?php
use App\Mail\Teste;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Rotas Site //Dev
Route::get('/index', 'HomeController@index')->name('home');
Route::get('/termos','HomeController@termos')->name('termos');
Route::get('/quem_somos','HomeController@about')->name('about');
Route::get('/invista','HomeController@invest')->name('invest');
Route::post('/parcelas','HomeController@parcelas')->name('parcelas');
Route::post('/parcelasInterna','HomeController@parcelasInterna')->name('parcelasInterna');
Route::post('/sobexml','HomeController@importaXml')->name('sobexml');
Route::post('/sobexmlinterno','HomeController@importaXmlInterno')->name('sobexmlinterno');
Route::post('/envia', 'HomeController@sendContact')->name('formcontato');

Route::any('atualiza/parcelas','HomeController@atualizaParcelas')->name('atualiza.parcelas');
Route::any('remove/parcela','HomeController@removeParcela')->name('remove.parcela');
Route::post('atualiza/datas','HomeController@atualizaDatas')->name('atualiza.data');

Route::get('/home/grafico-investidor', 'HomeController@graficoInvestidor');

Route::get('/cliente/contas','ClienteController@contas')->name('cliente.contas');
Route::any('/cliente/update_contas','ClienteController@updateConta')->name('cliente.update.contas');
Route::any('cliente/contas/update','ClienteController@updateContas')->name('cliente.update.conta');
Route::any('/cliente/contas/delete','ClienteController@deleteConta')->name('cliente.contas.delete');
Route::any('/cliente/documentos','UsuarioController@updateDocumentos')->name('cliente.documento.update')->middleware('auth');
Route::get('/cliente/socios','ClienteController@socios')->name('cliente.socios');
Route::post('/cliente/update_socios','ClienteController@updateSocios')->name('cliente.update.socios');
Route::any('/cliente/socios/novo','ClienteController@sociosAdd')->name('socios.novo');
Route::any('/cliente/socios/remove','ClienteController@sociosRemove')->name('socios.remove');

//deletar conta bancaria
Route::any('/cliente/contas/remove','ClienteController@contasRemove')->name('contas.remove');

//REGISTRO
Route::any('/register/add','Auth\RegisterController@create')->name('register.add');
Route::any('/user/verificar/{token}', 'Auth\RegisterController@verifyUser');

//rotas reset senha
Route::post('/user/emailReset','Auth\RegisterController@sendResetEmail')->name('reset.email');
Route::any('/user/reset/{token}', 'Auth\RegisterController@resetPassword');
Route::post('/user/change','Auth\RegisterController@changePassword')->name('change.password');

//rotas do middleware
Route::get('/register/step/{telefone}/{id}','Auth\RegisterController@paginaCpf')->name('cliente.step.cpf');
Route::get('/register/analise/{name}','Auth\RegisterController@paginaAnalise')->name('analise.credito');

Route::any('/register/cpf','Auth\RegisterController@cpf')->name('register.cpf');
Route::post('/register/cpf/novo','ClienteController@addDocumento')->name('register.add.cpf');
Route::get('/register/confirmar/{id}','ClienteController@confirmar')->name('register.confirmar');
Route::post('/register/validaDados', 'ApiController@validaDados')->name('api.validadados');
    //Step1
Route::any('/register/confirmar/{id}/{type}/S1','ClienteController@step1')->name('register.step1');
Route::any('/register/consulta/cpf','ClienteController@consultaCpf')->name('register.consultaCpf');
Route::any('/register/consulta/cnpj','ClienteController@consultaCnpj')->name('register.consultaCnpj');
Route::post('/register/confirmado/','ClienteController@createSocioProc')->name('register.novo.cliente');
    //Step2
Route::get('/register/confirmar/{id}/S2','ClienteController@step2')->name('register.step2');
Route::post('/register/confirmado/empresa','ClienteController@createCompany')->name('register.novo.empresa');
Route::post('/register/confirmado/S2','ClienteController@contratoFaturamento')->name('register.contrato.faturamento');
Route::post('/register/confirmado/S2','ClienteController@uploadArquivo')->name('register.upload.arquivo');
    //Step3
Route::get('/register/confirmar/{id}/S3','ClienteController@step3')->name('register.step3');
Route::post('register/confirmado/S3','ClienteController@addSocios')->name('register.socios');
Route::post('register/socios/upload','ClienteController@documentoSocio')->name('register.socios.upload');
    //Step4
Route::post('/register/confirmado/conjuge','ClienteController@addConjuge')->name('register.conjuge');
    //Step5
Route::get('/register/confirmar/{id}/S4','ClienteController@step4')->name('register.step4');
Route::post('/register/confirmado/S4','ClienteController@finalizar')->name('register.finalizar');
    //Finalizado
Route::get('/cliente/analise','ClienteController@analisePendente')->name('analise.pendente');

    //Login
Route::get('/register/authenticate','ClienteController@sucessoCadastro')->name('register.sucesso');
Route::get('/reenviar/email','Auth\RegisterController@reenviarEmail')->name('reenviar.email');
//Reset password
Route::get('password/reset/{token?}','Auth\ResetPasswordController@showResetForm');
Route::get('password/setEmail','Auth\ResetPasswordController@setEmail')->name('client.newpassword');
Route::post('password/email','Auth\ResetPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('password/reset','Auth\ResetPasswordController@reset');

Route::get('/ativo','ClienteController@ativoCredito')->name('ativo.credito');
//CLIENTE
Route::get('cliente/index','ClienteController@index')->name('cliente.index')->middleware('auth');
    //Solicitacoes
Route::get('cliente/solicitacoes','SolicitacaoController@index')->name('cliente.solicitacoes')->middleware('auth');
Route::get('cliente/solicitacoes/novo','ClienteController@addSolicitacao')->name('cliente.solicitacoes.novo')->middleware('auth');
Route::post('cliente/solicitacoes/novo/xml','ClienteController@uploadXML')->name('cliente.solicitacoes.xml')->middleware('auth');
Route::get('cliente/solicitacoes/novo/load','ClienteController@loadFields')->name('cliente.solicitacoes.load')->middleware('auth');
Route::get('cliente/solicitacoes/filtro','SolicitacaoController@filtros')->name('cliente.solicitacoes.filtro')->middleware('auth');

Route::get('cliente/solicitacao/{id}','SolicitacaoController@solicitacao')->name('cliente.solicitacoes.view')->middleware('auth');
Route::get('cliente/infoSolicitacao/{id}','SolicitacaoController@infoSolicitacao')->name('cliente.info.solicitacao')->middleware('auth');
Route::get('cliente/resumoBordero/{id}','SolicitacaoController@resumoBordero')->name('cliente.resumo.bordero')->middleware('auth');
Route::any('cliente/solicitacao/{id}/delete','SolicitacaoController@delete')->name('cliente.solicitacao.delete')->middleware('auth');

    //Perfil
Route::get('cliente/perfil','UsuarioController@index')->name('cliente.perfil')->middleware('auth');
Route::get('/cliente/empresa','ClienteController@empresa')->name('cliente.empresa');
Route::get('/cliente/mainSocio','ClienteController@mainSocio')->name('cliente.mainSocio');
Route::get('/cliente/user','ClienteController@user')->name('cliente.user');
Route::post('/cliente/atualizaJuridica','ClienteController@atualizarDadosJuridica')->name('cliente.atualiza.juridica');
Route::any('/cliente/atualizaContas','ClienteController@atualizaContas')->name('cliente.atualiza.contas');
Route::any('/cliente/atualizaSocios','ClienteController@atualizaSocios')->name('cliente.atualiza.socios');
Route::any('/cliente/atualizaCliente','ClienteController@atualizaCliente')->name('cliente.atualiza.cliente');

Route::post('cliente/perfil/update','UsuarioController@updatePerfilCliente')->name('cliente.perfil.update')->middleware('auth');
Route::post('cliente/perfil/imagem','UsuarioController@updateImagem')->name('cliente.perfil.imagem')->middleware('auth');
Route::post('cliente/perfil/verificaEmail','UsuarioController@verificaEmail')->name('cliente.verifica.email')->middleware('auth');

//Rotas Admin
Route::get('admin/index','Admin\HomeController@index')->name('admin.index')->middleware(['auth','admin']);
Route::get('admin/index/filtro','Admin\HomeController@filter')->name('admin.index.filter')->middleware(['auth','admin']);
    //Clientes
Route::get('admin/clientes','Admin\ClienteController@index')->name('admin.clientes')->middleware(['auth','admin']);
Route::get('admin/clientes/register','Admin\ClienteController@register')->name('admin.register.confirmar');
Route::get('admin/clientes/filter','Admin\ClienteController@filter')->name('admin.clientes.filter')->middleware(['auth','admin']);
Route::get('admin/clientes/{id}','Admin\ClienteController@cliente')->name('admin.clientes.view')->middleware(['auth','admin']);
Route::get('admin/clientes/delete/{id}','Admin\ClienteController@delete')->name('admin.clientes.delete')->middleware(['auth','admin']);
Route::get('admin/clientes/bordero','AdminController@clienteBordero')->name('admin.clientes.bordero')->middleware(['auth','admin']);
Route::post('admin/clientes/{id}/credito','SolicitacaoController@novoCredito')->name('admin.clientes.credito')->middleware(['auth','admin']);
Route::post('admin/clientes/{id}/taxa','SolicitacaoController@novaTaxa')->name('admin.clientes.taxa')->middleware(['auth','admin']);
Route::post('admin/clientes/{id}/save','Admin\ClienteController@save')->name('admin.cliente.save')->middleware(['auth','admin']);
Route::get('admin/cliente/{id}/solicitacoes','Admin\ClienteController@solicitacoes')->name('admin.cliente.solicitacoes')->middleware(['auth','admin']);
Route::get('admin/cliente/{id}/solicitacoes/filter','Admin\ClienteController@filterSolicitacoes')->name('admin.cliente.solicitacoes.filter')->middleware(['auth','admin']);
    //Solicitacoes
Route::get('admin/borderos','Admin\BorderoController@index')->name('admin.solicitacoes')->middleware(['auth','admin']);
Route::get('admin/solicitacoes/filter','Admin\BorderoController@filter')->name('admin.solicitacoes.filter')->middleware(['auth','admin']);
Route::get('admin/solicitacao/{id}','Admin\BorderoController@bordero')->name('admin.solicitacoes.view')->middleware(['auth','admin']);
Route::get('/admin/solicitacao/{id}/resumo','Admin\BorderoController@resumo')->name('admin.solicitacoes.resumo')->middleware(['auth','admin']);
Route::get('/admin/solicitacao/{id}/boletos','Admin\BorderoController@boleto')->name('admin.solicitacoes.boletos')->middleware(['auth','admin']);
Route::get('admin/bordero/{id}','SolicitacaoController@bordero')->name('bordero')->middleware(['auth','admin']);
Route::get('bordero/{id}/imprimir','SolicitacaoController@imprimirBordero')->name('imprimir.bordero');
Route::get('cessao/{id}','SolicitacaoController@cessao')->name('cessao');
Route::get('admin/solicitacoes/filtro','SolicitacaoController@filtros')->name('admin.solicitacoes.filtro')->middleware(['auth','admin']);
Route::post('admin/solicitacoes/{id}/update/credito','SolicitacaoController@atualizaCredito')->name('admin.update.credito')->middleware(['auth','admin']);
Route::post('admin/solicitacoes/{id}/update/juros','SolicitacaoController@atualizaJuros')->name('admin.update.juros')->middleware(['auth','admin']);
Route::post('admin/solicitacao/{id}/update/status','SolicitacaoController@atualizaStatus')->name('admin.update.status')->middleware(['auth','admin']);
Route::get('admin/solicitacao/delete/{id}','Admin\BorderoController@delete')->name('admin.solicitacao.delete')->middleware(['auth','admin']);
Route::get('admin/solicitacao/{id}/contrato','Admin\BorderoController@sendContract')->name('admin.solicitacao.contrato')->middleware(['auth','admin']);

    //Perfil
Route::get('admin/perfil','UsuarioController@index')->name('admin.perfil')->middleware(['auth','admin']);
Route::post('admin/perfil/{id}/update','Admin\UserController@update')->name('admin.perfil.update')->middleware('auth');

//Consultas
Route::post('/companies', 'ClienteController@companies')->name('api.companies');
Route::post('/peoplev2', 'ClienteController@peoplev2')->name('api.peoplev2');
Route::post('/cadastraXml', 'ClienteController@cadastraXml')->name('api.cadastraXml');
Route::post('/scoreFisica', 'ClienteController@scoreFisica')->name('api.scoreFisica');
Route::post('/scoreJuridica', 'ClienteController@scoreJuridica')->name('api.scoreJuridica');
Route::post('/scoreFisica/sacado','ClienteController@scoreFisica')->name('api.scoreFisica.sac');
Route::post('/scoreJuridica/sacado','ClienteController@scoreJuridica')->name('api.scoreJuridica.sac');
Route::post('/endereco','ClienteController@addEndereco')->name('api.endereco');
Route::post('/endereco/juridica','ClienteController@addEnderecoJuridica')->name('api.endereco.juridica');
Route::post('/endereco/juridica/fields','ClienteController@enderecoJuridicaFields')->name('api.endereco.juridica.fields');
Route::post('/dadosProfissionais/{id}', 'ClienteController@dadosProfissionais')->name('api.dadosProfissionais');
Route::post('/veiculos/{id}','ClienteController@veiculos')->name('api.veiculos');
Route::post('/financeira/{id}','ClienteController@infoFinanceira')->name('api.infoFinanceira');
Route::post('/criminal/{id}','ClienteController@antecedentesCriminais')->name('api.criminal');
Route::post('/indicadorAtividade/{id}','ClienteController@indicadorAtividade')->name('api.indicaAtiv');

//Auth/Facebook
Route::any('auth/fb/redirect', 'AuthFacebookController@redirect')->name('auth.facebook');
Route::any('auth/fb/callback', 'AuthFacebookController@callback');

//Auth/Linkedin
Route::any('auth/linkedin/redirect', 'AuthLinkedinController@redirect')->name('auth.linkedin');
Route::any('auth/linkedin/callback', 'AuthLinkedinController@callback');

//Auth/Google
Route::any('auth/google/redirect', 'AuthGoogleController@redirect')->name('auth.google');
Route::any('auth/google/callback', 'AuthGoogleController@callback');

//Remove social link
Route::any('social/remove', 'UsuarioController@removeSocial')->name('remove.social');

//Boleto-APITeste
Route::get('/teste/boleto','BoletoController@boleto')->name('boleto');
Route::get('/teste/cedente/conta','BoletoController@getConta')->name('cedente.conta');
Route::get('/teste/cedente/convenio','BoletoController@getConvenio')->name('cedente.convenio');
Route::any('/teste/boleto/cedente','BoletoController@createCedente')->name('boleto.cedente');
Route::any('/teste/boleto/create','BoletoController@createBoleto')->name('boleto.create');
Route::any('/teste/boleto/conta','BoletoController@createConta')->name('boleto.conta');
Route::any('/teste/boleto/convenio','BoletoController@createConvenio')->name('boleto.convenio');
Route::any('/teste/boleto/personalizar','BoletoController@personalizar')->name('boleto.personalizar');
Route::get('/teste/remessa','BoletoController@consultaRemessa')->name('boleto.remessa');
Route::get('/teste/arquivo','BoletoController@arquivoRetorno')->name('boleto.arquivo');
Route::any('teste/remessa/baixa','BoletoController@remessaBaixa')->name('boleto.remessa.baixa');
Route::any('teste/remessa/baixa/consulta','BoletoController@consultaBaixa')->name('boleto.remessa.baixa.consulta');
//Boleto Integração
//Route::get('/admin/solicitacao/{id}/boletos','SolicitacaoController@boleto')->name('admin.solicitacao.boletos')->middleware(['auth','admin']);
Route::any('/admin/solicitacao/{id}/boletos/create','BoletoController@createBoleto')->name('admin.boleto.create')->middleware(['auth','admin']);
Route::any('/admin/solicitacao/boletos/protocolo','BoletoController@protocoloPDF')->name('admin.boleto.protocolo')->middleware(['auth','admin']);
Route::get('/admin/solicitacao/{id}/boletos/status','SolicitacaoController@boletoStatus')->name('admin.solicitacao.boletos.status')->middleware(['auth','admin']);
Route::get('/admin/solicitacao/notifica/status','BoletoController@notificacao')->name('admin.solicitacao.boletos.notificacao');

//Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/', 'HomeController@index')->name('index');

Route::get('/register/confirmar/novo/{id}','ClienteController@confirmarTeste')->name('register.confirmar.teste');

Route::get('/development', function () {
    return view('admin.cliente.bordero', ['page' => 'teste']);
});

Route::get('/rotas','Admin\UserController@index');

//teste endereco
Route::post('/endereco','ClienteController@testeEndereco')->name('teste.endereco');
//email sucesso
Route::any('/email/sucesso', 'ClienteController@emailSucesso')->name('email.sucesso');