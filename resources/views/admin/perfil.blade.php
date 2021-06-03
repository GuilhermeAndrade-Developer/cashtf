@extends('layouts.admin.topo')
@section('content')
	<div class="container-fluid fluid-person pb60 padding_top_default">
		<div class="row mt120">
			<div class="col-md-offset-3 col-md-6 text-center">
				<h3 class="title_page">
					PERFIL
				</h3>
			</div>
		</div>
		<form action="{{route('admin.perfil.update',Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
		@csrf
			<div class="mt20">
			@include('layouts.admin.return')
				<div class="row">
					<div class="col-md-6">
						<img src="{{asset('images/usuarios')}}/{{Auth::user()->imagem}}" class="img_perfil_box" id="preview">
						<div class="div_perfil">
							<div>
								<label for="choose-file" class="botao_salvar_menor">
									<i>ALTERAR FOTO</i>
								</label>
                				<input id="choose-file" style="display: none;" type="file" class="form-control" name="imagem" onchange="openFile(event)" accept="image/*">
							</div>
							<label><i>TAMANHO IDEAL: 200px X 200px<br>FORMATOS: JPG ou PNG</i></label>
						</div>
					</div>
					<div class="col-md-6 text-right">
                        <button type="submit" class="botao_salvar ml35" name="botao_salvar">
                            <i class="fa fa-save"></i> SALVAR
                        </button>
					</div>
				</div>
				<div class="row mt20">
					<div class="col-md-6">
						<label class="texto_formulario">NOME COMPLETO</label>
						<input type="text" class="form-control input_default" name="name" value="{{Auth::user()->name}}" required>
						<input type="hidden" class="form-control input_default" name="id_usuario" value="{{Auth::user()->id}}">
					</div>
					<div class="col-md-6">
						<label class="texto_formulario">SENHA</label>
						<input type="password" class="form-control input_default" name="password" id="senha">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label class="texto_formulario">E-MAIL</label>
						<input type="email" class="form-control input_default" name="email" value="{{Auth::user()->email}}" readonly />
					</div>
					<div class="col-md-6">
						<label class="texto_formulario">CONFIRMAR SENHA</label>
						<input type="password" class="form-control input_default" name="confirma_senha" id="confirma_senha" onkeyup="validaSenhas();">
						<label class="lblpsw" style="color: red;">Senhas diferentes</label>
					</div>
				</div>
			</div>
		</form>
	</div>
	<script type="text/javascript">
		function validaSenhas(){
			if($('#senha').val() == $('#confirma_senha').val()){
				$('.lblpsw').hide(); 
			}else if($('#senha').val() != $('#confirma_senha').val()){
				$('.lblpsw').show();
			}
		}
	</script>
@endsection