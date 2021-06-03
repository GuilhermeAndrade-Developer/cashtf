@extends('layouts.admin.cliente_view.topo_bordero')
@section('content')

<style>

	input:-webkit-autofill {
			-webkit-text-fill-color: #000 !important;
	}
	#cpf:valid { background-color: #f11270; color: #fff; border: none; }
	#cpf:-webkit-autofill {
			-webkit-text-fill-color: #fff !important;
	}
	#contratosocial:valid { background-color: #1ca7fc; color: #fff; border: none; } 
	#alteracoescontratuais:valid { background-color: #1ca7fc; color: #fff; border: none; }
	#faturamento:valid { background-color: #1ca7fc; color: #fff; border: none; }

	select#bordero_cliente{
			height: 36px;
			border: initial;
			width: 50px;
	}
	.input-group-addon_lixeira {
			font-size: 14px;
			font-weight: 400;
			line-height: 1;
			color: #555;
			text-align: center;
			background-color: #eee;
			border: 1px solid #ccc;
			border-radius: 4px;
	}
</style>

<div class="div_geral_socio_procurador">
<div class="container-fluid">
		
</div>
<form id="filtros" action="" method="GET" >
		<div class="mt80_bordero_cliente flex_pai_buscar_bordero_cliente">
				<input type="hidden" id="status" name="status" class="hidden" value="{{ isset($status)? $status : '' }}"> 
				<div class="fundo_title_bordero_cliente b_t_color white">
						<div class="flex_1_bordero_cliente_title">
								<span class="fonte_bordero_title_cliente">
										BOLETO
								</span>
						</div>
				</div>
		</div>
</form>
<div class="container-fluid text-center billet_zone d_flex j_center a_center f_column">
		Deseja gerar os a partir das<br> notas fiscais aprovadas?
		<a class="b_s_dark_color white confirm" href="{{route('admin.boleto.create',$nro_bordero)}}">SIM</a>
</div>
</div>
@endsection