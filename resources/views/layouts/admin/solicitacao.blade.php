{{-- Score Fisica/Solicitante --}}
@section('ssf')
@if(!isset($score_fisico_sol))
<div ng-show="solicitante_fisica == 0">
@if(isset($solicitante))
    @if($solicitante[0]->cpf != '')
				<div class="col-md-12 text-center mt20 fonte_analisar">
					<span>
						SPC BRASIL COM SCORE
					</span>
				</div>
				<div class="col-md-12 text-center mt50">
				<form method="post" id="scoreFisica" action="{{route('api.scoreFisica', $solicitante[0]->cpf)}}">
					@csrf
					<a onclick="scoreFisica()" class="botao_verificar">
						VERIFICAR
					</a>
				</form>
					<div class='col-md-12' ng-show="erro_consulta == 1">
						<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
					</div>
				</div>
			</div>
			@endif
@else
        <div class="col-md-12 text-center fonte_analisar">
                                <span>
                                    CPF NÃO ESTA PREENCHIDO
                                </span>
                            </div>
@endif
			<div ng-show="solicitante_fisica == 1">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-3">
							<label class="texto_formulario">Nome</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreFisicaSacador.Name" placeholder="Nome" readonly />
						</div>
						<div class="col-md-3">
							<label class="texto_formulario">Classe</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreFisicaSacador.Class" placeholder="Class" readonly />
						</div>
						<div class="col-md-3">
							<label class="texto_formulario">Horizonte</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreFisicaSacador.Horizon" placeholder="Horizon" readonly />
						</div>
						<div class="col-md-3">
							<label class="texto_formulario">Probabilidade</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreFisicaSacador.Probability" placeholder="Probability" readonly />
						</div>
						<div class="col-md-3">
							<label class="texto_formulario">Score</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreFisicaSacador.Score" placeholder="Score" readonly />
						</div>
						<div class="col-md-3">
							<label class="texto_formulario">Score Tipo</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreFisicaSacador.ScoreType" placeholder="ScoreType" readonly />
						</div>
						<div class="col-md-6">
							<label class="texto_formulario">Razão</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreFisicaSacador.Reason" placeholder="Reason" readonly />
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<a onclick="scoreFisica()" class="botao_verificar" style='float: right; margin-right: 8px; margin-top: 15px;'>
						CONSULTAR NOVAMENTE
					</a>
				</div>
				<div class='col-md-12'>
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Data da última consulta: {{isset($score_fisico_sol) ? $score_fisico_sol[0]->ultima_consulta : ''}}</i>
				</div>
				<div class='col-md-12' ng-show="erro_consulta == 1">
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
				</div>
			</div>
@else
<div class="col-md-12">
				<div class="row">
					<div class="col-md-3">
						<label class="texto_formulario">Nome</label>
						<input type="text" class="form-control input_default" placeholder="Nome" value="{{isset($score_fisico_sol) ? $score_fisico_sol[0]->name : ''}}" readonly />
					</div>
					<div class="col-md-3">
						<label class="texto_formulario">Classe</label>
						<input type="text" class="form-control input_default" placeholder="Class" value="{{isset($score_fisico_sol) ? $score_fisico_sol[0]->class : ''}}" readonly />
					</div>
					<div class="col-md-3">
						<label class="texto_formulario">Horizonte</label>
						<input type="text" class="form-control input_default" placeholder="Horizon" value="{{isset($score_fisico_sol) ? $score_fisico_sol[0]->horizon : ''}}" readonly />
					</div>
					<div class="col-md-3">
						<label class="texto_formulario">Probabilidade</label>
						<input type="text" class="form-control input_default" placeholder="Probability" value="{{isset($score_fisico_sol) ? $score_fisico_sol[0]->probability : ''}}" readonly />
					</div>
					<div class="col-md-3">
						<label class="texto_formulario">Score</label>
						<input type="text" class="form-control input_default" placeholder="Score" value="{{isset($score_fisico_sol) ? $score_fisico_sol[0]->score : ''}}" readonly />
					</div>
					<div class="col-md-3">
						<label class="texto_formulario">Score Tipo</label>
						<input type="text" class="form-control input_default" placeholder="ScoreType" value="{{isset($score_fisico_sol) ? $score_fisico_sol[0]->score_type : ''}}" readonly />
					</div>
					<div class="col-md-6">
						<label class="texto_formulario">Razão</label>
						<input type="text" class="form-control input_default" placeholder="Reason" value="{{isset($score_fisico_sol) ? $score_fisico_sol[0]->reason : ''}}" readonly />
					</div>
				</div>
			</div>
			<div class="col-md-12">
			<form method="post" id="scoreFisica" action="{{route('api.scoreFisica', $solicitante[0]->cpf)}}">
					@csrf
				<a onclick="scoreFisica()" class="botao_verificar" style='float: right; margin-right: 8px; margin-top: 15px;'>
					CONSULTAR NOVAMENTE
				</a>
			</form>
			</div>
			<div class='col-md-12'>
				<i style='float: right; margin-right: 8px; margin-top: 15px;'>Data da última consulta: {{isset($score_fisico_sol) ? $score_fisico_sol[0]->ultima_consulta : ''}} </i>
			</div>
			<div class='col-md-12' ng-show="erro_consulta == 1">
				<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
			</div>
@endif
@endsection


{{-- Score Juridica/Solicitante --}}
@section('ssj')
@if(!isset($score_juridico_sol))
<div ng-show="solicitante_juridica == 0">
@if(isset($solicitante))
    @if($solicitante[0]->cnpj != '')
				<div class="col-md-12 text-center mt20 fonte_analisar">
					<span>
						SPC BRASIL COM SCORE
					</span>
				</div>
				<div class="col-md-12 text-center mt50">
				<form method="post" id="scoreJuridica" action="{{route('api.scoreJuridica', $solicitante[0]->id)}}">
					@csrf
					<input type="hidden" name="cnpj" value="{{$solicitante[0]->cnpj}}">
					<a onclick="scoreJuridica()" class="botao_verificar">
						VERIFICAR
					</a>
				</form>
					<div class='col-md-12' ng-show="erro_consulta == 1">
						<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cnpj informado.</i>
					</div>
				</div>
			</div>
			@endif
@else
        <div class="col-md-12 text-center fonte_analisar">
                                <span>
                                    CPF NÃO ESTA PREENCHIDO
                                </span>
                            </div>
@endif
			<div ng-show="solicitante_juridica == 1">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-3">
							<label class="texto_formulario">Nome</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreJuridicoSacador.Name" placeholder="Nome" readonly />
						</div>
						<div class="col-md-3">
							<label class="texto_formulario">Classe</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreJuridicoSacador.Class" placeholder="Class" readonly />
						</div>
						<div class="col-md-3">
							<label class="texto_formulario">Horizonte</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreJuridicoSacador.Horizon" placeholder="Horizon" readonly />
						</div>
						<div class="col-md-3">
							<label class="texto_formulario">Probabilidade</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreJuridicoSacador.Probability" placeholder="Probability" readonly />
						</div>
						<div class="col-md-3">
							<label class="texto_formulario">Score</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreJuridicoSacador.Score" placeholder="Score" readonly />
						</div>
						<div class="col-md-3">
							<label class="texto_formulario">Score Tipo</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreJuridicoSacador.ScoreType" placeholder="ScoreType" readonly />
						</div>
						<div class="col-md-6">
							<label class="texto_formulario">Razão</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreJuridicoSacador.Reason" placeholder="Reason" readonly />
						</div>
					</div>
				</div>
			</div>
@else
<div class="col-md-12">
				<div class="row">
				<div class="col-md-3">
						<label class="texto_formulario">Nome</label>
						<input type="text" class="form-control input_default" placeholder="Nome" value="{{isset($score_juridico_sol) ? $score_juridico_sol[0]->name : ''}}" readonly />
					</div>
					<div class="col-md-3">
						<label class="texto_formulario">Classe</label>
						<input type="text" class="form-control input_default" placeholder="Class" value="{{isset($score_juridico_sol) ? $score_juridico_sol[0]->class : ''}}" readonly />
					</div>
					<div class="col-md-3">
						<label class="texto_formulario">Horizonte</label>
						<input type="text" class="form-control input_default" placeholder="Horizon" value="{{isset($score_juridico_sol) ? $score_juridico_sol[0]->horizon : ''}}" readonly />
					</div>
					<div class="col-md-3">
						<label class="texto_formulario">Probabilidade</label>
						<input type="text" class="form-control input_default" placeholder="Probability" value="{{isset($score_juridico_sol) ? $score_juridico_sol[0]->probability : ''}}" readonly />
					</div>
					<div class="col-md-3">
						<label class="texto_formulario">Score</label>
						<input type="text" class="form-control input_default" placeholder="Score" value="{{isset($score_juridico_sol) ? $score_juridico_sol[0]->score : ''}}" readonly />
					</div>
					<div class="col-md-3">
						<label class="texto_formulario">Score Tipo</label>
						<input type="text" class="form-control input_default" placeholder="ScoreType" value="{{isset($score_juridico_sol) ? $score_juridico_sol[0]->score_type : ''}}" readonly />
					</div>
					<div class="col-md-6">
						<label class="texto_formulario">Razão</label>
						<input type="text" class="form-control input_default" placeholder="Reason" value="{{isset($score_juridico_sol) ? $score_juridico_sol[0]->reason : ''}}" readonly />
					</div>
				</div>
				<div class="col-md-12">
				<form method="post" id="scoreJuridica" action="{{route('api.scoreJuridica', $solicitante[0]->id)}}">
					@csrf
					<input type="hidden" name="cnpj" value="{{$solicitante[0]->cnpj}}">
					<a onclick="scoreJuridica()" class="botao_verificar" style='float: right; margin-right: 8px; margin-top: 15px;'>
						CONSULTAR NOVAMENTE
					</a>
				</form>
				</div>
				<div class='col-md-12'>
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Data da última consulta: {{isset($score_juridico_sol) ? $score_juridico_sol[0]->ultima_consulta : ''}}</i>
				</div>
				<div class='col-md-12' ng-show="erro_consulta == 1">
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cnpj informado.</i>
				</div>
			</div>
@endif
@endsection

{{-- Score Fisica/Sacado --}}
@section('sfs')
@if(!isset($score_fisico_sac))
<div ng-show="sacado_fisico == 0">
@if(isset($sacado))
    @if($sacado[0]->cpf != '')
					<div class="col-md-12 text-center mt20 fonte_analisar">
						<span>
							SPC BRASIL COM SCORE
						</span>
					</div>
					<div class="col-md-12 text-center mt50">
					<form method="post" id="scoreFisicaSac" action="{{route('api.scoreFisica.sac', $sacado[0]->id)}}">
					@csrf
					<input type="hidden" name="cpf" value="{{$sacado[0]->cpf}}">
					<a onclick="scoreFisicaSac()" class="botao_verificar">
						VERIFICAR
					</a>
					</form>
						<div class='col-md-12' ng-show="erro_consulta == 1">
							<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
						</div>
					</div>
	@endif
@else
        <div class="col-md-12 text-center fonte_analisar">
                                <span>
                                    CPF NÃO ESTA PREENCHIDO
                                </span>
                            </div>
@endif
    <div ng-show="sacado_fisico == 1">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-3">
							<label class="texto_formulario">Nome</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreFisicaSacado.Name" placeholder="Nome" readonly />
						</div>
						<div class="col-md-3">
							<label class="texto_formulario">Classe</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreFisicaSacado.Class" placeholder="Class" readonly />
						</div>
						<div class="col-md-3">
							<label class="texto_formulario">Horizonte</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreFisicaSacado.Horizon" placeholder="Horizon" readonly />
						</div>
						<div class="col-md-3">
							<label class="texto_formulario">Probabilidade</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreFisicaSacado.Probability" placeholder="Probability" readonly />
						</div>
						<div class="col-md-3">
							<label class="texto_formulario">Score</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreFisicaSacado.Score" placeholder="Score" readonly />
						</div>
						<div class="col-md-3">
							<label class="texto_formulario">Score Tipo</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreFisicaSacado.ScoreType" placeholder="ScoreType" readonly />
						</div>
						<div class="col-md-6">
							<label class="texto_formulario">Razão</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreFisicaSacado.Reason" placeholder="Reason" readonly />
						</div>
					</div>
				</div>
				<div class="col-md-12">
				<form method="post" id="scoreFisicaSac" action="{{isset($sacado) ? route('api.scoreFisica.sac', $sacado[0]->id) : ''}}">
					@csrf
					<input type="hidden" name="cpf" value="{{isset($sacado) ? $sacado[0]->cpf : ''}}">
					<a class="botao_verificar" style='float: right; margin-right: 8px; margin-top: 15px;'>
					CONSULTAR NOVAMENTE
				</a>
			</form>
				</div>
				<div class='col-md-12'>
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Data da última consulta: {{isset($score_juridico_sac) ? $score_juridico_sac[0]->ultima_consulta : ''}}</i>
				</div>
				<div class='col-md-12' ng-show="erro_consulta == 1">
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
				</div>
			</div>
@else
<div class="col-md-12">
				<div class="row">
					<div class="col-md-3">
						<label class="texto_formulario">Nome</label>
						<input type="text" class="form-control input_default" placeholder="Nome" value="{{isset($score_fisico_sac) ? $score_fisico_sac[0]->name : ''}}" readonly />
					</div>
					<div class="col-md-3">
						<label class="texto_formulario">Classe</label>
						<input type="text" class="form-control input_default" placeholder="Class" value="{{isset($score_fisico_sac) ? $score_fisico_sac[0]->class : ''}}" readonly />
					</div>
					<div class="col-md-3">
						<label class="texto_formulario">Horizonte</label>
						<input type="text" class="form-control input_default" placeholder="Horizon" value="{{isset($score_fisico_sac) ? $score_fisico_sac[0]->horizon : ''}}" readonly />
					</div>
					<div class="col-md-3">
						<label class="texto_formulario">Probabilidade</label>
						<input type="text" class="form-control input_default" placeholder="Probability" value="{{isset($score_fisico_sac) ? $score_fisico_sac[0]->probability : ''}}" readonly />
					</div>
					<div class="col-md-3">
						<label class="texto_formulario">Score</label>
						<input type="text" class="form-control input_default" placeholder="Score" value="{{isset($score_fisico_sac) ? $score_fisico_sac[0]->score : ''}}" readonly />
					</div>
					<div class="col-md-3">
						<label class="texto_formulario">Score Tipo</label>
						<input type="text" class="form-control input_default" placeholder="ScoreType" value="{{isset($score_fisico_sac) ? $score_fisico_sac[0]->score_type : ''}}" readonly />
					</div>
					<div class="col-md-6">
						<label class="texto_formulario">Razão</label>
						<input type="text" class="form-control input_default" placeholder="Reason" value="{{isset($score_fisico_sac) ? $score_fisico_sac[0]->reason : ''}}" readonly />
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<form method="post" id="scoreFisicaSac" action="{{route('api.scoreFisica.sac', $sacado[0]->id)}}">
					@csrf
					<input type="hidden" name="cpf" value="{{$sacado[0]->cpf}}">
				<a onclick="scoreFisicaSac()" class="botao_verificar" style='float: right; margin-right: 8px; margin-top: 15px;'>
					CONSULTAR NOVAMENTE
				</a>
			</form>
			</div>
			<div class='col-md-12'>
				<i style='float: right; margin-right: 8px; margin-top: 15px;'>Data da última consulta: {{isset($score_juridico_sac) ? $score_juridico_sac[0]->ultima_consulta : ''}}</i>
			</div>
			<div class='col-md-12' ng-show="erro_consulta == 1">
				<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
			</div>
@endif
@endsection

{{-- Score Juridica/Sacado --}}
@section('sjs')
@if(!isset($score_juridico_sac))
<div ng-show="sacado_juridica == 0">
@if(isset($sacado))
    @if($sacado[0]->cnpj != '')
				<div class="col-md-12 text-center mt20 fonte_analisar">
					<span>
						SPC BRASIL COM SCORE
					</span>
				</div>
				<div class="col-md-12 text-center mt50">
				<form method="post" id="scoreJuridicaSac" action="{{route('api.scoreJuridica.sac', $sacado[0]->id)}}">
					@csrf
					<input type="hidden" name="cnpj" value="{{$sacado[0]->cnpj}}">
					<a onclick="scoreJuridicaSac()" class="botao_verificar">
						VERIFICAR
					</a>
				</form>
					<div class='col-md-12' ng-show="erro_consulta == 1">
						<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cnpj informado.</i>
					</div>
				</div>
			</div>
			@endif
@else
        <div class="col-md-12 text-center fonte_analisar">
                                <span>
                                    CNPJ NÃO ESTA PREENCHIDO
                                </span>
                            </div>
@endif
			<div ng-show="sacado_juridica == 1">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-3">
							<label class="texto_formulario">Nome</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreJuridicoSacador.Name" placeholder="Nome" readonly />
						</div>
						<div class="col-md-3">
							<label class="texto_formulario">Classe</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreJuridicoSacador.Class" placeholder="Class" readonly />
						</div>
						<div class="col-md-3">
							<label class="texto_formulario">Horizonte</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreJuridicoSacador.Horizon" placeholder="Horizon" readonly />
						</div>
						<div class="col-md-3">
							<label class="texto_formulario">Probabilidade</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreJuridicoSacador.Probability" placeholder="Probability" readonly />
						</div>
						<div class="col-md-3">
							<label class="texto_formulario">Score</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreJuridicoSacador.Score" placeholder="Score" readonly />
						</div>
						<div class="col-md-3">
							<label class="texto_formulario">Score Tipo</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreJuridicoSacador.ScoreType" placeholder="ScoreType" readonly />
						</div>
						<div class="col-md-6">
							<label class="texto_formulario">Razão</label>
							<input type="text" class="form-control input_default" ng-model="dadosScoreJuridicoSacador.Reason" placeholder="Reason" readonly />
						</div>
					</div>
				</div>
			</div>
@else
<div class="col-md-12">
				<div class="row">
				<div class="col-md-3">
						<label class="texto_formulario">Nome</label>
						<input type="text" class="form-control input_default" placeholder="Nome" value="{{isset($score_juridico_sac) ? $score_juridico_sac[0]->name : ''}}" readonly />
					</div>
					<div class="col-md-3">
						<label class="texto_formulario">Classe</label>
						<input type="text" class="form-control input_default" placeholder="Class" value="{{isset($score_juridico_sac) ? $score_juridico_sac[0]->class : ''}}" readonly />
					</div>
					<div class="col-md-3">
						<label class="texto_formulario">Horizonte</label>
						<input type="text" class="form-control input_default" placeholder="Horizon" value="{{isset($score_juridico_sac) ?$score_juridico_sac[0]->horizon : ''}}" readonly />
					</div>
					<div class="col-md-3">
						<label class="texto_formulario">Probabilidade</label>
						<input type="text" class="form-control input_default" placeholder="Probability" value="{{isset($score_juridico_sac) ? $score_juridico_sac[0]->probability : ''}}" readonly />
					</div>
					<div class="col-md-3">
						<label class="texto_formulario">Score</label>
						<input type="text" class="form-control input_default" placeholder="Score" value="{{isset($score_juridico_sac) ? $score_juridico_sac[0]->score : ''}}" readonly />
					</div>
					<div class="col-md-3">
						<label class="texto_formulario">Score Tipo</label>
						<input type="text" class="form-control input_default" placeholder="ScoreType" value="{{isset($score_juridico_sac) ? $score_juridico_sac[0]->score_type : ''}}" readonly />
					</div>
					<div class="col-md-6">
						<label class="texto_formulario">Razão</label>
						<input type="text" class="form-control input_default" placeholder="Reason" value="{{isset($score_juridico_sac) ? $score_juridico_sac[0]->reason : ''}}" readonly />
					</div>
				</div>
				<div class="col-md-12">
				<form method="post" id="scoreJuridicaSac" action="{{isset($sacado) ? route('api.scoreJuridica.sac', $sacado[0]->id) : ''}}">
					@csrf
					<input type="hidden" name="cnpj" value="{{isset($sacado) ? $sacado[0]->cnpj : ''}}">
					<a onclick="scoreJuridicaSac()" class="botao_verificar" style='float: right; margin-right: 8px; margin-top: 15px;'>
						CONSULTAR NOVAMENTE
					</a>
				</form>
				</div>
				<div class='col-md-12'>
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Data da última consulta: {{isset($score_juridico_sac) ? $score_juridico_sac[0]->ultima_consulta : ''}}</i>
				</div>
				<div class='col-md-12' ng-show="erro_consulta == 1">
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cnpj informado.</i>
				</div>
			</div>
@endif
@endsection


{{-- Dados Profissionais/Fisico --}}
@section('dpf')
@if(!isset($dpf))
	@if(isset($solicitante))
    	@if($solicitante[0]->cpf != '')
				<div class="col-md-12 text-center mt20 fonte_analisar">
					<span>
						DADOS PROFISSIONAIS
					</span>
				</div>
				<div class="col-md-12 text-center mt50">
				<form method="post" id="dadosProfissionais" action="{{route('api.dadosProfissionais', $solicitante[0]->id)}}">
					@csrf
					<input type="hidden" name="cpf" value="{{$solicitante[0]->cpf}}">
					<a onclick="dadosProfissionais()" class="botao_verificar">
						VERIFICAR
					</a>
				</form>
					<div class='col-md-12' ng-show="erro_consulta == 1">
						<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
					</div>
				</div>
	@else
        <div class="col-md-12 text-center fonte_analisar">
                                <span>
                                    CPF NÃO ESTA PREENCHIDO
                                </span>
                            </div>
		@endif
	@endif
@else
		<div class="col-md-12">
			<div class="dflex fwrap">
				<div class="flex1">
					<label class="texto_formulario">Setor</label>
					<input type="text" class="form-control input_default" placeholder="Setor" value="{{isset($dpf) ? $dpf[0]->Sector : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">País</label>
					<input type="text" class="form-control input_default" placeholder="País" value="{{isset($dpf) ? $dpf[0]->Country : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Nome da Empresa</label>
					<input type="text" class="form-control input_default" placeholder="Nome da Empresa" value="{{isset($dpf) ? $dpf[0]->CompanyName : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Área</label>
					<input type="text" class="form-control input_default" placeholder="Área" value="{{isset($dpf) ? $dpf[0]->Area : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Nível</label>
					<input type="text" class="form-control input_default" placeholder="Nível" value="{{isset($dpf) ? $dpf[0]->Level : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Status</label>
					<input type="text" class="form-control input_default" placeholder="Status" value="{{isset($dpf) ? $dpf[0]->Status : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Alcance de Renda</label>
					<input type="text" class="form-control input_default" placeholder="Alcance" value="{{isset($dpf) ? $dpf[0]->IncomeRange : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Renda</label>
					<input type="text" class="form-control input_default" placeholder="Renda" value="{{isset($dpf) ? $dpf[0]->Income : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Data de Entrada</label>
					<input type="text" class="form-control input_default" placeholder="Data de Entrada" value="{{isset($dpf) ? $dpf[0]->StartDate : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Data de Saída</label>
					<input type="text" class="form-control input_default" placeholder="Data de Saída" value="{{isset($dpf) ? $dpf[0]->EndDate : ''}}" readonly />
				</div>
			</div>
				<div class="col-md-12">
					<form method="post" id="dadosProfissionais" action="{{route('api.dadosProfissionais', $solicitante[0]->id)}}">
						@csrf
						<input type="hidden" name="cpf" value="{{$solicitante[0]->cpf}}">
						<a onclick="dadosProfissionais()" class="botao_verificar" style='float: right; margin-right: 8px; margin-top: 15px;'>
							CONSULTAR NOVAMENTE
						</a>
					</form>
				</div>
				<div class='col-md-12'>
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Data da última consulta: {{isset($dpf) ? $dpf[0]->LastUpdateDate : ''}}</i>
				</div>
				<div class='col-md-12' ng-show="erro_consulta == 1">
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
				</div>
			</div>
		@endif
@endsection

{{-- Dados Profissionais/Fisico/SACADO --}}
@section('dpfs')
@if(!isset($dpfs))
	@if(isset($sacado))
    	@if($sacado[0]->cpf != '')
				<div class="col-md-12 text-center mt20 fonte_analisar">
					<span>
						DADOS PROFISSIONAIS
					</span>
				</div>
				<div class="col-md-12 text-center mt50">
				<form method="post" id="dadosProfissionaisSac" action="{{route('api.dadosProfissionais', $sacado[0]->id)}}">
					@csrf
					<input type="hidden" name="cpf" value="{{$sacado[0]->cpf}}">
					<a onclick="dadosProfissionaisSac()" class="botao_verificar">
						VERIFICAR
					</a>
				</form>
					<div class='col-md-12' ng-show="erro_consulta == 1">
						<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
					</div>
				</div>
	@else
        <div class="col-md-12 text-center fonte_analisar">
        	<span>
            	CPF NÃO ESTA PREENCHIDO
            </span>
        </div>
		@endif
	@endif
@else
		<div class="col-md-12">
			<div class="dflex fwrap">
				<div class="flex1">
					<label class="texto_formulario">Setor</label>
					<input type="text" class="form-control input_default" placeholder="Setor" value="{{isset($dpfs) ? $dpfs[0]->Sector : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">País</label>
					<input type="text" class="form-control input_default" placeholder="País" value="{{isset($dpfs) ? $dpfs[0]->Country : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Nome da Empresa</label>
					<input type="text" class="form-control input_default" placeholder="Nome da Empresa" value="{{isset($dpfs) ? $dpfs[0]->CompanyName : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Área</label>
					<input type="text" class="form-control input_default" placeholder="Área" value="{{isset($dpfs) ? $dpfs[0]->Area : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Nível</label>
					<input type="text" class="form-control input_default" placeholder="Nível" value="{{isset($dpfs) ? $dpfs[0]->Level : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Status</label>
					<input type="text" class="form-control input_default" placeholder="Status" value="{{isset($dpfs) ? $dpfs[0]->Status : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Alcance de Renda</label>
					<input type="text" class="form-control input_default" placeholder="Alcance" value="{{isset($dpfs) ? $dpfs[0]->IncomeRange : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Renda</label>
					<input type="text" class="form-control input_default" placeholder="Renda" value="{{isset($dpfs) ? $dpfs[0]->Income : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Data de Entrada</label>
					<input type="text" class="form-control input_default" placeholder="Data de Entrada" value="{{isset($dpfs) ? $dpfs[0]->StartDate : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Data de Saída</label>
					<input type="text" class="form-control input_default" placeholder="Data de Saída" value="{{isset($dpfs) ? $dpfs[0]->EndDate : ''}}" readonly />
				</div>
			</div>
				<div class="col-md-12">
					<form method="post" id="dadosProfissionaisSac" action="{{isset($sacado) ? route('api.dadosProfissionais', $sacado[0]->id) : ''}}">
						@csrf
						<input type="hidden" name="cpf" value="{{isset($sacado) ? $sacado[0]->cpf  : ''}}">
						<a onclick="dadosProfissionaisSac()" class="botao_verificar" style='float: right; margin-right: 8px; margin-top: 15px;'>
							CONSULTAR NOVAMENTE
						</a>
					</form>
				</div>
				<div class='col-md-12'>
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Data da última consulta: {{isset($dpfs) ? $dpfs[0]->LastUpdateDate : ''}}</i>
				</div>
				<!--<div class='col-md-12' ng-show="erro_consulta == 1">
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
				</div>-->
			</div>
		@endif
@endsection


{{-- Veiculos/Fisico/SOLICITANTE --}}
@section('vef')
@if(!isset($vef))
	@if(isset($solicitante))
    	@if($solicitante[0]->cpf != '')
				<div class="col-md-12 text-center mt20 fonte_analisar">
					<span>
						VEÍCULOS
					</span>
				</div>
				<div class="col-md-12 text-center mt50">
				<form method="post" id="veiculos" action="{{route('api.veiculos', $solicitante[0]->id)}}">
					@csrf
					<input type="hidden" name="cpf" value="{{$solicitante[0]->cpf}}">
					<a onclick="veiculos()" class="botao_verificar">
						VERIFICAR
					</a>
					@include('layouts/messages')
				@yield('content')
				</form>	
				</div>			
	@else
        <div class="col-md-12 text-center fonte_analisar">
        	<span>
            	CPF NÃO ESTA PREENCHIDO
            </span>
        </div>
		@endif
	@endif
@else
		<div class="col-md-12">
			<div class="dflex fwrap">
				<div class="flex1">
					<label class="texto_formulario">Categoria</label>
					<input type="text" class="form-control input_default" placeholder="Categoria" value="{{isset($vef) ? $vef[0]->Category : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Marca</label>
					<input type="text" class="form-control input_default" placeholder="Marca" value="{{isset($vef) ? $vef[0]->Brand : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Modelo</label>
					<input type="text" class="form-control input_default" placeholder="Modelo" value="{{isset($vef) ? $vef[0]->Model : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Código FIPE</label>
					<input type="text" class="form-control input_default" placeholder="FIPE" value="{{isset($vef) ? $vef[0]->FipeCode : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Ano do Modelo</label>
					<input type="text" class="form-control input_default" placeholder="Ano do modelo" value="{{isset($vef) ? $vef[0]->ModelYear : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Tipo de Combustível</label>
					<input type="text" class="form-control input_default" placeholder="Combustível" value="{{isset($vef) ? $vef[0]->FuelType : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Preço Médio</label>
					<input type="text" class="form-control input_default" placeholder="Preço Médio" value="{{isset($vef) ? $vef[0]->AvgPrice : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Mês de Referência</label>
					<input type="text" class="form-control input_default" placeholder="Mês de Referência" value="{{isset($vef) ? $vef[0]->ReferenceMonth : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Ano de Referência</label>
					<input type="text" class="form-control input_default" placeholder="Ano de Referência" value="{{isset($vef) ? $vef[0]->ReferenceYear : ''}}" readonly />
				</div>
			</div>
		</div>
				<div class="col-md-12">
					<form method="post" id="veiculos" action="{{route('api.veiculos', $solicitante[0]->id)}}">
						@csrf
						<input type="hidden" name="cpf" value="{{$solicitante[0]->cpf}}">
						<a onclick="veiculos()" class="botao_verificar" style='float: right; margin-right: 8px; margin-top: 15px;'>
							CONSULTAR NOVAMENTE
						</a>
					</form>
				</div>
				<div class='col-md-12'>
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Data da última consulta: {{isset($vef) ? $vef[0]->LastUpdateDate : ''}}</i>
				</div>
				<!--<div class='col-md-12' ng-show="erro_consulta == 1">
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
				</div>-->
		@endif
@endsection

{{-- Veiculos/Fisico/SACADO --}}
@section('vefs')
@if(!isset($vefs))
	@if(isset($sacado))
    	@if($sacado[0]->cpf != '')
				<div class="col-md-12 text-center mt20 fonte_analisar">
					<span>
						VEÍCULOS
					</span>
				</div>
				<div class="col-md-12 text-center mt50">
				<form method="post" id="veiculosSac" action="{{route('api.veiculos', $sacado[0]->id)}}">
					@csrf
					<input type="hidden" name="cpf" value="{{$sacado[0]->cpf}}">
					<a onclick="veiculosSac()" class="botao_verificar">
						VERIFICAR
					</a>
				</form>
					<div class='col-md-12' ng-show="erro_consulta == 1">
						<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
					</div>
				</div>
	@else
        <div class="col-md-12 text-center fonte_analisar">
        	<span>
            	CPF NÃO ESTA PREENCHIDO
            </span>
        </div>
		@endif
	@endif
@else
		<div class="col-md-12">
			<div class="dflex fwrap">
				<div class="flex1">
					<label class="texto_formulario">Categoria</label>
					<input type="text" class="form-control input_default" placeholder="Categoria" value="{{isset($vefs) ? $vefs[0]->Category : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Marca</label>
					<input type="text" class="form-control input_default" placeholder="Marca" value="{{isset($vefs) ? $vefs[0]->Brand : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Modelo</label>
					<input type="text" class="form-control input_default" placeholder="Modelo" value="{{isset($vefs) ? $vefs[0]->Model : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Código FIPE</label>
					<input type="text" class="form-control input_default" placeholder="FIPE" value="{{isset($vefs) ? $vefs[0]->FipeCode : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Ano do Modelo</label>
					<input type="text" class="form-control input_default" placeholder="Ano do modelo" value="{{isset($vefs) ? $vefs[0]->ModelYear : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Tipo de Combustível</label>
					<input type="text" class="form-control input_default" placeholder="Combustível" value="{{isset($vefs) ? $vefs[0]->FuelType : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Preço Médio</label>
					<input type="text" class="form-control input_default" placeholder="Preço Médio" value="{{isset($vefs) ? $vefs[0]->AvgPrice : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Mês de Referência</label>
					<input type="text" class="form-control input_default" placeholder="Mês de Referência" value="{{isset($vefs) ? $vefs[0]->ReferenceMonth : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Ano de Referência</label>
					<input type="text" class="form-control input_default" placeholder="Ano de Referência" value="{{isset($vefs) ? $vefs[0]->ReferenceYear : ''}}" readonly />
				</div>
			</div>
		</div>
				<div class="col-md-12">
					<form method="post" id="veiculosSac" action="{{isset($sacado) ? route('api.veiculos', $sacado[0]->id) : ''}}">
						@csrf
						<input type="hidden" name="cpf" value="{{isset($sacado) ? $sacado[0]->cpf : ''}}">
						<a onclick="veiculosSac()" class="botao_verificar" style='float: right; margin-right: 8px; margin-top: 15px;'>
							CONSULTAR NOVAMENTE
						</a>
					</form>
				</div>
				<div class='col-md-12'>
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Data da última consulta: {{isset($vefs) ? $vefs[0]->LastUpdateDate : ''}}</i>
				</div>
				<!--<div class='col-md-12' ng-show="erro_consulta == 1">
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
				</div>-->
		@endif
@endsection


{{-- Informações Financeiras/Fisico/SOLICITANTE --}}
@section('iff')
@if(!isset($iff))
	@if(isset($solicitante))
    	@if($solicitante[0]->cpf != '')
				<div class="col-md-12 text-center mt20 fonte_analisar">
					<span>
						INFORMAÇÕES FINANCEIRAS
					</span>
				</div>
				<div class="col-md-12 text-center mt50">
				<form method="post" id="infoFinanceira" action="{{route('api.infoFinanceira', $solicitante[0]->id)}}">
					@csrf
					<input type="hidden" name="cpf" value="{{$solicitante[0]->cpf}}">
					<a onclick="infoFinanceira()" class="botao_verificar">
						VERIFICAR
					</a>
				</form>
					<div class='col-md-12' ng-show="erro_consulta == 1">
						<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
					</div>
				</div>
	@else
        <div class="col-md-12 text-center fonte_analisar">
                                <span>
                                    CPF NÃO ESTA PREENCHIDO
                                </span>
                            </div>
		@endif
	@endif
@else
		<div class="col-md-12">
			<div class="dflex fwrap">
				<div class="flex1">
					<label class="texto_formulario">Total de Ativos</label>
					<input type="text" class="form-control input_default" placeholder="Total de Ativos" value="{{isset($iff) ? $iff[0]->TotalAssets : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Ano</label>
					<input type="text" class="form-control input_default" placeholder="Ano" value="{{isset($iff) ? $iff[0]->Year : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Status</label>
					<input type="text" class="form-control input_default" placeholder="Status" value="{{isset($iff) ? $iff[0]->Status : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Banco</label>
					<input type="text" class="form-control input_default" placeholder="Banco" value="{{isset($iff) ? $iff[0]->Bank : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Ramo</label>
					<input type="text" class="form-control input_default" placeholder="Ramo" value="{{isset($iff) ? $iff[0]->Branch : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Lote</label>
					<input type="text" class="form-control input_default" placeholder="Lote" value="{{isset($iff) ? $iff[0]->Batch : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Ramo VIP</label>
					<input type="text" class="form-control input_default" placeholder="Ramo VIP" value="{{isset($iff) ? $iff[0]->IsVipBranch : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">MTE</label>
					<input type="text" class="form-control input_default" placeholder="MTE" value="{{isset($iff) ? $iff[0]->MTE : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">IBGE</label>
					<input type="text" class="form-control input_default" placeholder="IBGE" value="{{isset($iff) ? $iff[0]->IBGE : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">BIGDATA</label>
					<input type="text" class="form-control input_default" placeholder="BIGDATA" value="{{isset($iff) ? $iff[0]->BIGDATA : ''}}" readonly />
				</div>
				<!--<div class="flex1">
					<label class="texto_formulario">Propriedade da Empresa</label>
					<input type="text" class="form-control input_default" placeholder="Propriedade da Empresa" value="{{isset($iff) ? $iff[0]->CompanyOwnership : ''}}" readonly />
				</div>-->
			</div>
		</div>

		<div class="col-md-12">
					<form method="post" id="infoFinanceira" action="{{route('api.infoFinanceira', $solicitante[0]->id)}}">
						@csrf
						<input type="hidden" name="cpf" value="{{$solicitante[0]->cpf}}">
						<a onclick="infoFinanceira()" class="botao_verificar" style='float: right; margin-right: 8px; margin-top: 15px;'>
							CONSULTAR NOVAMENTE
						</a>
					</form>
				</div>
				<div class='col-md-12'>
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Data da última consulta: {{isset($iff) ? $iff[0]->LastUpdateDate : ''}}</i>
				</div>
				<!--<div class='col-md-12' ng-show="erro_consulta == 1">
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
				</div>-->
		@endif
@endsection


{{-- Informações Financeiras/Fisico/SACADO --}}
@section('iffs')
@if(!isset($iffs))
	@if(isset($sacado))
    	@if($sacado[0]->cpf != '')
				<div class="col-md-12 text-center mt20 fonte_analisar">
					<span>
						INFORMAÇÕES FINANCEIRAS
					</span>
				</div>
				<div class="col-md-12 text-center mt50">
				<form method="post" id="infoFinanceiraSac" action="{{route('api.infoFinanceira', $sacado[0]->id)}}">
					@csrf
					<input type="hidden" name="cpf" value="{{$sacado[0]->cpf}}">
					<a onclick="infoFinanceiraSac()" class="botao_verificar">
						VERIFICAR
					</a>
				</form>
					<div class='col-md-12' ng-show="erro_consulta == 1">
						<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
					</div>
				</div>
	@else
        <div class="col-md-12 text-center fonte_analisar">
                                <span>
                                    CPF NÃO ESTA PREENCHIDO
                                </span>
                            </div>
		@endif
	@endif
@else
		<div class="col-md-12">
			<div class="dflex fwrap">
				<div class="flex1">
					<label class="texto_formulario">Total de Ativos</label>
					<input type="text" class="form-control input_default" placeholder="Total de Ativos" value="{{isset($iffs) ? $iffs[0]->TotalAssets : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Ano</label>
					<input type="text" class="form-control input_default" placeholder="Ano" value="{{isset($iffs) ? $iffs[0]->Year : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Status</label>
					<input type="text" class="form-control input_default" placeholder="Status" value="{{isset($iffs) ? $iffs[0]->Status : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Banco</label>
					<input type="text" class="form-control input_default" placeholder="Banco" value="{{isset($iffs) ? $iffs[0]->Bank : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Ramo</label>
					<input type="text" class="form-control input_default" placeholder="Ramo" value="{{isset($iffs) ? $iffs[0]->Branch : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Lote</label>
					<input type="text" class="form-control input_default" placeholder="Lote" value="{{isset($iffs) ? $iffs[0]->Batch : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Ramo VIP</label>
					<input type="text" class="form-control input_default" placeholder="Ramo VIP" value="{{isset($iffs) ? $iffs[0]->IsVipBranch : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">MTE</label>
					<input type="text" class="form-control input_default" placeholder="MTE" value="{{isset($iffs) ? $iffs[0]->MTE : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">IBGE</label>
					<input type="text" class="form-control input_default" placeholder="IBGE" value="{{isset($iffs) ? $iffs[0]->IBGE : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">BIGDATA</label>
					<input type="text" class="form-control input_default" placeholder="BIGDATA" value="{{isset($iffs) ? $iffs[0]->BIGDATA : ''}}" readonly />
				</div>
				<!--<div class="flex1">
					<label class="texto_formulario">Propriedade da Empresa</label>
					<input type="text" class="form-control input_default" placeholder="Propriedade da Empresa" value="{{isset($iff) ? $iff[0]->CompanyOwnership : ''}}" readonly />
				</div>-->
			</div>
		</div>

		<div class="col-md-12">
					<form method="post" id="infoFinanceiraSac" action="{{isset($sacado) ? route('api.infoFinanceira', $sacado[0]->id) : ''}}">
						@csrf
						<input type="hidden" name="cpf" value="{{isset($sacado) ? $sacado[0]->cpf : ''}}">
						<a onclick="infoFinanceiraSac()" class="botao_verificar" style='float: right; margin-right: 8px; margin-top: 15px;'>
							CONSULTAR NOVAMENTE
						</a>
					</form>
				</div>
				<div class='col-md-12'>
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Data da última consulta: {{isset($iffs) ? $iffs[0]->LastUpdateDate : ''}}</i>
				</div>
				<!--<div class='col-md-12' ng-show="erro_consulta == 1">
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
				</div>-->
		@endif
@endsection

{{-- KYC/Fisico --}}
@section('kycf')
		<div class="col-md-12">
			<div class="dflex fwrap">
				<div class="flex1">
					<label class="texto_formulario">Total de Ativos</label>
					<input type="text" class="form-control input_default" placeholder="Total de Ativos" value="{{isset($sac_jur_endereco) ? $sac_jur_endereco[0]->Endereco_Lgr : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Ano</label>
					<input type="text" class="form-control input_default" placeholder="Ano" value="{{isset($sac_jur_endereco) ? $sac_jur_endereco[0]->Endereco_Nro : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Status</label>
					<input type="text" class="form-control input_default" placeholder="Status" value="{{isset($sac_jur_endereco) ? $sac_jur_endereco[0]->Endereco_Complemento : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Banco</label>
					<input type="text" class="form-control input_default" placeholder="Banco" value="{{isset($sac_jur_endereco) ? $sac_jur_endereco[0]->Endereco_Bairro : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Ramo</label>
					<input type="text" class="form-control input_default" placeholder="Ramo" value="{{isset($sac_jur_endereco) ? $sac_jur_endereco[0]->Endereco_Mun : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Lote</label>
					<input type="text" class="form-control input_default" placeholder="Lote" value="{{isset($sac_jur_endereco) ? $sac_jur_endereco[0]->Endereco_UF : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Ramo VIP</label>
					<input type="text" class="form-control input_default" placeholder="Ramo VIP" value="{{isset($sac_jur_endereco) ? $sac_jur_endereco[0]->Endereco_CEP : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">MTE</label>
					<input type="text" class="form-control input_default" placeholder="MTE" value="{{isset($sac_jur_endereco) ? $sac_jur_endereco[0]->Endereco_Pais : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">IBGE</label>
					<input type="text" class="form-control input_default" placeholder="IBGE" value="{{isset($sac_jur_endereco) ? $sac_jur_endereco[0]->Endereco_Pais : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">BIGDATA</label>
					<input type="text" class="form-control input_default" placeholder="BIGDATA" value="{{isset($sac_jur_endereco) ? $sac_jur_endereco[0]->Endereco_Pais : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Propriedade da Empresa</label>
					<input type="text" class="form-control input_default" placeholder="Propriedade da Empresa" value="{{isset($sac_jur_endereco) ? $sac_jur_endereco[0]->Endereco_Pais : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Data de Criação</label>
					<input type="text" class="form-control input_default" placeholder="Data de Criação" value="{{isset($sac_jur_endereco) ? $sac_jur_endereco[0]->Endereco_Pais : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Data da Última Atualização</label>
					<input type="text" class="form-control input_default" placeholder="Data de Atualização" value="{{isset($sac_jur_endereco) ? $sac_jur_endereco[0]->Endereco_Pais : ''}}" readonly />
				</div>
			</div>
		</div>
@endsection

{{-- Antecedentes Criminais/Fisico/SOLICITANTE --}}
@section('acf')
@if(!isset($acf))
	@if(isset($solicitante))
    	@if($solicitante[0]->cpf != '')
				<div class="col-md-12 text-center mt20 fonte_analisar">
					<span>
						ANTECEDENTES CRIMINAIS
					</span>
				</div>
				<div class="col-md-12 text-center mt50">
				<form method="post" id="criminal" action="{{route('api.criminal', $solicitante[0]->id)}}">
					@csrf
					<input type="hidden" name="cpf" value="{{$solicitante[0]->cpf}}">
					<a onclick="criminal()" class="botao_verificar">
						VERIFICAR
					</a>
				</form>
					<div class='col-md-12' ng-show="erro_consulta == 1">
						<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
					</div>
				</div>
	@else
        <div class="col-md-12 text-center fonte_analisar">
                                <span>
                                    CPF NÃO ESTA PREENCHIDO
                                </span>
                            </div>
		@endif
	@endif
@else
		<div class="col-md-12">
			<div class="dflex fwrap">
				<div class="flex1">
					<label class="texto_formulario">Origem</label>
					<input type="text" class="form-control input_default" placeholder="Origem" value="{{isset($acf) ? $acf[0]->Origin : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Numero de Identificação</label>
					<input type="text" class="form-control input_default" placeholder="Numero de Identificação" value="{{isset($acf) ? $acf[0]->IdNumber : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Status</label>
					<input type="text" class="form-control input_default" placeholder="Status" value="{{isset($acf) ? $acf[0]->Status : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Validade</label>
					<input type="text" class="form-control input_default" placeholder=">Validade" value="{{isset($acf) ? $acf[0]->Validity : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Data de Emissão</label>
					<input type="text" class="form-control input_default" placeholder="Data de Emissão" value="{{isset($acf) ? $acf[0]->EmissionDate : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Número de Certificado</label>
					<input type="text" class="form-control input_default" placeholder="Número de Certificado" value="{{isset($acf) ? $acf[0]->CertificateNumber : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Certificado</label>
					<input type="text" class="form-control input_default" placeholder="Certificado" value="{{isset($acf) ? $acf[0]->CertificateText : ''}}" readonly />
				</div>
			</div>
		</div>

		<div class="col-md-12">
					<form method="post" id="criminal" action="{{route('api.criminal', $solicitante[0]->id)}}">
						@csrf
						<input type="hidden" name="cpf" value="{{$solicitante[0]->cpf}}">
						<a onclick="criminal()" class="botao_verificar" style='float: right; margin-right: 8px; margin-top: 15px;'>
							CONSULTAR NOVAMENTE
						</a>
					</form>
				</div>
				<div class='col-md-12'>
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Data da última consulta: {{isset($acf) ? $acf[0]->LastUpdateDate : ''}}</i>
				</div>
				<!--<div class='col-md-12' ng-show="erro_consulta == 1">
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
				</div>-->
		@endif
@endsection

{{-- Antecedentes Criminais/Fisico/SACADO --}}
@section('acfs')
@if(!isset($acfs))
	@if(isset($sacado))
    	@if($sacado[0]->cpf != '')
				<div class="col-md-12 text-center mt20 fonte_analisar">
					<span>
						ANTECEDENTES CRIMINAIS
					</span>
				</div>
				<div class="col-md-12 text-center mt50">
				<form method="post" id="criminalSac" action="{{route('api.criminal', $sacado[0]->id)}}">
					@csrf
					<input type="hidden" name="cpf" value="{{$sacado[0]->cpf}}">
					<a onclick="criminalSac()" class="botao_verificar">
						VERIFICAR
					</a>
				</form>
					<div class='col-md-12' ng-show="erro_consulta == 1">
						<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
					</div>
				</div>
	@else
        <div class="col-md-12 text-center fonte_analisar">
                                <span>
                                    CPF NÃO ESTA PREENCHIDO
                                </span>
                            </div>
		@endif
	@endif
@else
		<div class="col-md-12">
			<div class="dflex fwrap">
				<div class="flex1">
					<label class="texto_formulario">Origem</label>
					<input type="text" class="form-control input_default" placeholder="Origem" value="{{isset($acfs) ? $acfs[0]->Origin : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Numero de Identificação</label>
					<input type="text" class="form-control input_default" placeholder="Numero de Identificação" value="{{isset($acfs) ? $acfs[0]->IdNumber : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Status</label>
					<input type="text" class="form-control input_default" placeholder="Status" value="{{isset($acfs) ? $acfs[0]->Status : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Validade</label>
					<input type="text" class="form-control input_default" placeholder=">Validade" value="{{isset($acfs) ? $acfs[0]->Validity : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Data de Emissão</label>
					<input type="text" class="form-control input_default" placeholder="Data de Emissão" value="{{isset($acfs) ? $acfs[0]->EmissionDate : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Número de Certificado</label>
					<input type="text" class="form-control input_default" placeholder="Número de Certificado" value="{{isset($acfs) ? $acfs[0]->CertificateNumber : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Certificado</label>
					<input type="text" class="form-control input_default" placeholder="Certificado" value="{{isset($acfs) ? $acfs[0]->CertificateText : ''}}" readonly />
				</div>
			</div>
		</div>

		<div class="col-md-12">
					<form method="post" id="criminalSac" action="{{isset($sacado) ? route('api.criminal', $sacado[0]->id) : ''}}">
						@csrf
						<input type="hidden" name="cpf" value="{{isset($sacado) ? $sacado[0]->cpf : ''}}">
						<a onclick="criminalSac()" class="botao_verificar" style='float: right; margin-right: 8px; margin-top: 15px;'>
							CONSULTAR NOVAMENTE
						</a>
					</form>
				</div>
				<div class='col-md-12'>
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Data da última consulta: {{isset($acfs) ? $acfs[0]->LastUpdateDate : ''}}</i>
				</div>
				<!--<div class='col-md-12' ng-show="erro_consulta == 1">
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
				</div>-->
		@endif
@endsection

{{-- Indicadores de Atividade/Juridico/SOLICITANTE --}}
@section('iaj')
@if(!isset($iaj))
	@if(isset($solicitante))
    	@if($solicitante[0]->cnpj != '')
				<div class="col-md-12 text-center mt20 fonte_analisar">
					<span>
						INDICADORES DE ATIVIDADE
					</span>
				</div>
				<div class="col-md-12 text-center mt50">
				<form method="post" id="indicaAtiv" action="{{route('api.indicaAtiv', $solicitante[0]->id)}}">
					@csrf
					<input type="hidden" name="cnpj" value="{{$solicitante[0]->cnpj}}">
					<a onclick="indicaAtiv()" class="botao_verificar">
						VERIFICAR
					</a>
				</form>
					<div class='col-md-12' ng-show="erro_consulta == 1">
						<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
					</div>
				</div>
	@else
        <div class="col-md-12 text-center fonte_analisar">
                                <span>
                                    CNPJ NÃO ESTA PREENCHIDO
                                </span>
                            </div>
		@endif
	@endif
@else
		<div class="col-md-12">
			<div class="dflex fwrap">
				<div class="flex1">
					<label class="texto_formulario">Alcance de empregados</label>
					<input type="text" class="form-control input_default" placeholder="Alcance de Empregados" value="{{isset($iaj) ? $iaj[0]->EmployeesRange : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Alcance de renda</label>
					<input type="text" class="form-control input_default" placeholder="Numero de Identificação" value="{{isset($iaj) ? $iaj[0]->IncomeRange : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Tem atividade</label>
					<input type="text" class="form-control input_default" placeholder="Status" value="{{isset($iaj) || $iaj[0]->HasActivity == 0 ? 'Não' : 'Sim'}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Nivel de atividade</label>
					<input type="text" class="form-control input_default" placeholder=">Validade" value="{{isset($iaj) ? $iaj[0]->ActivityLevel : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Tem endereço recente</label>
					<input type="text" class="form-control input_default" placeholder="Data de Emissão" value="{{isset($iaj) || $iaj[0]->HasRecentAddress == 0 ? 'Não' : 'Sim'}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Tem telefone recente</label>
					<input type="text" class="form-control input_default" placeholder="Data de Emissão" value="{{isset($iaj) || $iaj[0]->HasRecentPhone == 0 ? 'Não' : 'Sim'}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Tem email recente</label>
					<input type="text" class="form-control input_default" placeholder="Data de Emissão" value="{{isset($iaj) || $iaj[0]->HasRecentEmail == 0 ? 'Não' : 'Sim'}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Tem passagem recente</label>
					<input type="text" class="form-control input_default" placeholder="Data de Emissão" value="{{isset($iaj) || $iaj[0]->HasRecentPassages == 0 ? 'Não' : 'Sim'}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Tem domínio ativo</label>
					<input type="text" class="form-control input_default" placeholder="Data de Emissão" value="{{isset($iaj) || $iaj[0]->HasActiveDomain == 0 ? 'Não' : 'Sim'}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Tem SSL ativo</label>
					<input type="text" class="form-control input_default" placeholder="Data de Emissão" value="{{isset($iaj) || $iaj[0]->HasActiveSSL == 0 ? 'Não' : 'Sim'}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Tem email corporativo</label>
					<input type="text" class="form-control input_default" placeholder="Data de Emissão" value="{{isset($iaj) || $iaj[0]->HasCorporateEmail == 0 ? 'Não' : 'Sim'}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Numero de Ramos</label>
					<input type="text" class="form-control input_default" placeholder="Data de Emissão" value="{{isset($iaj) ? $iaj[0]->NumberOfBranches : ''}}" readonly />
				</div>
			</div>
		</div>

		<div class="col-md-12">
					<form method="post" id="indicaAtiv" action="{{route('api.indicaAtiv', $solicitante[0]->id)}}">
						@csrf
						<input type="hidden" name="cnpj" value="{{$solicitante[0]->cnpj}}">
						<a onclick="indicaAtiv()" class="botao_verificar" style='float: right; margin-right: 8px; margin-top: 15px;'>
							CONSULTAR NOVAMENTE
						</a>
					</form>
				</div>
				<div class='col-md-12'>
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Data da última consulta: {{isset($iaj) ? $iaj[0]->LastUpdateDate : ''}}</i>
				</div>
				<!--<div class='col-md-12' ng-show="erro_consulta == 1">
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
				</div>-->
		@endif
@endsection

{{-- Indicadores de Atividade/Juridico/SACADO --}}
@section('iajs')
@if(!isset($iajs))
	@if(isset($sacado))
    	@if($sacado[0]->cnpj != '')
				<div class="col-md-12 text-center mt20 fonte_analisar">
					<span>
						INDICADORES DE ATIVIDADE
					</span>
				</div>
				<div class="col-md-12 text-center mt50">
				<form method="post" id="indicaAtivSac" action="{{route('api.indicaAtiv', $sacado[0]->id)}}">
					@csrf
					<input type="hidden" name="cnpj" value="{{$sacado[0]->cnpj}}">
					<a onclick="indicaAtivSac()" class="botao_verificar">
						VERIFICAR
					</a>
				</form>
					<div class='col-md-12' ng-show="erro_consulta == 1">
						<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
					</div>
				</div>
	@else
        <div class="col-md-12 text-center fonte_analisar">
                                <span>
                                    CNPJ NÃO ESTA PREENCHIDO
                                </span>
                            </div>
		@endif
	@endif
@else
		<div class="col-md-12">
			<div class="dflex fwrap">
				<div class="flex1">
					<label class="texto_formulario">Alcance de empregados</label>
					<input type="text" class="form-control input_default" placeholder="Alcance de Empregados" value="{{isset($iajs) ? $iajs[0]->EmployeesRange : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Alcance de renda</label>
					<input type="text" class="form-control input_default" placeholder="Numero de Identificação" value="{{isset($iajs) ? $iajs[0]->IncomeRange : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Tem atividade</label>
					<input type="text" class="form-control input_default" placeholder="Status" value="{{isset($iajs) || $iajs[0]->HasActivity == 0 ? 'Não' : 'Sim'}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Nivel de atividade</label>
					<input type="text" class="form-control input_default" placeholder=">Validade" value="{{isset($iajs) ? $iajs[0]->ActivityLevel : ''}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Tem endereço recente</label>
					<input type="text" class="form-control input_default" placeholder="Data de Emissão" value="{{isset($iajs) || $iajs[0]->HasRecentAddress == 0 ? 'Não' : 'Sim'}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Tem telefone recente</label>
					<input type="text" class="form-control input_default" placeholder="Data de Emissão" value="{{isset($iajs) || $iajs[0]->HasRecentPhone == 0 ? 'Não' : 'Sim'}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Tem email recente</label>
					<input type="text" class="form-control input_default" placeholder="Data de Emissão" value="{{isset($iajs) || $iajs[0]->HasRecentEmail == 0 ? 'Não' : 'Sim'}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Tem passagem recente</label>
					<input type="text" class="form-control input_default" placeholder="Data de Emissão" value="{{isset($iajs) || $iajs[0]->HasRecentPassages == 0 ? 'Não' : 'Sim'}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Tem domínio ativo</label>
					<input type="text" class="form-control input_default" placeholder="Data de Emissão" value="{{isset($iajs) || $iajs[0]->HasActiveDomain == 0 ? 'Não' : 'Sim'}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Tem SSL ativo</label>
					<input type="text" class="form-control input_default" placeholder="Data de Emissão" value="{{isset($iajs) || $iajs[0]->HasActiveSSL == 0 ? 'Não' : 'Sim'}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Tem email corporativo</label>
					<input type="text" class="form-control input_default" placeholder="Data de Emissão" value="{{isset($iajs) || $iajs[0]->HasCorporateEmail == 0 ? 'Não' : 'Sim'}}" readonly />
				</div>
				<div class="flex1">
					<label class="texto_formulario">Numero de Ramos</label>
					<input type="text" class="form-control input_default" placeholder="Data de Emissão" value="{{isset($iajs) ? $iajs[0]->NumberOfBranches : ''}}" readonly />
				</div>
			</div>
		</div>

		<div class="col-md-12">
					<form method="post" id="indicaAtivSac" action="{{isset($sacado) ? route('api.indicaAtiv', $sacado[0]->id) : ''}}">
						@csrf
						<input type="hidden" name="cnpj" value="{{isset($sacado) ? $sacado[0]->cnpj : ''}}">
						<a onclick="indicaAtivSac()" class="botao_verificar" style='float: right; margin-right: 8px; margin-top: 15px;'>
							CONSULTAR NOVAMENTE
						</a>
					</form>
				</div>
				<div class='col-md-12'>
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Data da última consulta: {{isset($iajs) ? $iajs[0]->LastUpdateDate : ''}}</i>
				</div>
				<!--<div class='col-md-12' ng-show="erro_consulta == 1">
					<i style='float: right; margin-right: 8px; margin-top: 15px;'>Erro ao consultar o cpf informado.</i>
				</div>-->
		@endif
@endsection

{{-- 
	//Include nas views
	@include('layouts/messages')
	@yield('content')
--}}
