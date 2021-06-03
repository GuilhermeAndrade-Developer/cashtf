@if ($message = Session::get('sucesso'))
<div class="alert alert-success alert-block">
    <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('erro'))
<div class="alert alert-danger alert-block">
    <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('aviso'))
<div class="alert alert-warning alert-block">
	<strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
	<strong>{{ $message }}</strong>
</div>
@endif


@if ($errors->any())
<div class="alert alert-danger">
	Favor verificar informações inseridas 
</div>
@endif