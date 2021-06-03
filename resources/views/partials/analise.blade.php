
@extends('layouts.app')
@section('content')

 <style>
body{
	background-image: url("{{asset('images/Grupo 4578.jpg')}}");
	background-position: center;
	background-size: cover;
	height: 90%;
}
.copyright_login{
    color: #fff;
    font-size: 12px;
}

 </style>
	<div class="div_geral_sucess">
		
		<div class="primeira_div container padding-form">
			<div class="row mobile_custom">
				<div class="col-md-12 text-center mb20">
					<img src="{{asset('images/logo_white@2x.png')}}" style="width: 226px;">
				</div>
				
				<div class="row">
					<div class="col-md-12 bg-none text-center mt20">
                        <p class="success_msg">Olá, Usuário!<br><br>
                            Sua conta está em análise no momento.<br><br>
                            Após a liberação de limite de crédito, um e-mail será enviado com mais informações<br>
                            para a utilização do sistema e solicitação de sua primeira antecipação.
                        </p>
					</div>
				</div>
				<div class="col-md-12 bg-none text-center mt20">
					<a class="sign_button text-center" href="{{route('home')}}">IR PARA O SITE</a>
				</div>
			</div>
		</div>
	</div>

@endsection
		