@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="w-100 text-center">{{ __('Verificação do endereço de e-mail
                    ') }}
                    </h3>
                </div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Um link de verificação foi enviado para o seu endereço de e-mail.') }}
                        </div>
                    @endif

                    <p class="w-100 text-center">{{ __('Antes de prosseguir, será necessário fazer uma verificação de e-mail.') }}
                    {{ __('') }}</p>
                    <div class="text-center">
                        <a href="{{ route('verification.resend') }}" class="btn btn-success margin"> {{ __('clique aqui para solicitar o e-mail de verificação') }}</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

