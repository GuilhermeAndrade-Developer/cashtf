
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
						<p class="success_msg">Seu e-mail foi confirmado com</p>
						<p class="sucesso_concluido"> SUCESSO</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 bg-none text-center mt20">
						<a href="{{route('login')}}" class="btn btn-block button_pink_active custom" style="letter-spacing: 2px;">ENTRAR</a>						
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
		