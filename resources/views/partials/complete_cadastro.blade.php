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
        ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: #fff !important;
            opacity: 1; /* Firefox */
        }
        :-ms-input-placeholder { /* Internet Explorer 10-11 */
            color: #fff !important;
        }

        ::-ms-input-placeholder { /* Microsoft Edge */
            color: #fff !important;
        }
    </style>

    <div class="div_geral_complete">
        <div class="primeira_div container padding-form">
            <div class="row">
                <div class="col-md-12 text-center mb40">
                    <img src="{{asset('images/logo_white.png')}}" style="width: 200px;">
                </div>
                <div class="col-md-12 text-center">
                    <span style="color: #fff; font-size: 23px;">
                        Por Favor, complete o seu cadastro.
                    </span>
                </div>
                <div class="col-md-offset-3 col-md-6 plr100 mt30">
                    <form class="login_form" method="post" onsubmit="return ValidaCadastro()" action="{{route('register.add')}}">
                        <div class="row">
                            <div class="col-md-12 mt20">
                                <div class="input-group">
                                    <span class="input-group-addon input_padrao pr0"><i class="fa fa-user"></i></span>
                                    <input type="text" name="cpf" class="form-control campo_quadrado input_padrao" placeholder="Digite o seu CPF..." autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-12 mt50">
                                <div class="input-group">
                                    <span class="input-group-addon input_padrao pr0"><i class="fa fa-file-text"></i></span>
                                    <input type="text" name="cnpj" id="cnpj" class="form-control campo_quadrado input_padrao" placeholder="Digite o seu CNPJ..." autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12 mt60">
                            <input type="submit" class="btn btn-block button_pink" style="letter-spacing: 2px;" name="botao_cadastrar" value="PRÓXIMO">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection