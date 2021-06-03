<style>
    .control {
        font-family: arial;
        display: block;
        position: relative;
        padding-left: 30px;
        margin-bottom: 5px;
        padding-top: 3px;
        cursor: pointer;
        font-size: 16px;
    }
    .control input {
        position: absolute;
        z-index: -1;
        opacity: 0;
    }
    .control_indicator {
        position: absolute;
        top: 6px;
        left: 0;
        height: 20px;
        width: 20px;
        background: #ffffff;
        border: 1px solid #f11270;
        border-radius: undefinedpx;
    }
    .control:hover input ~ .control_indicator,
    .control input:focus ~ .control_indicator {
        background: #ffffff;
    }

    .control input:checked ~ .control_indicator {
        background: #ffffff;
    }
    .control:hover input:not([disabled]):checked ~ .control_indicator,
    .control input:checked:focus ~ .control_indicator {
        background: #ffffff;
    }
    .control input:disabled ~ .control_indicator {
        background: #e6e6e6;
        opacity: 0;
        pointer-events: none;
    }
    .control_indicator:after {
        box-sizing: unset;
        content: '';
        position: absolute;
        display: none;
    }
    .control input:checked ~ .control_indicator:after {
        display: block;
    }
    .control-radio .control_indicator {
        border-radius: 50%;
    }

    .control-radio .control_indicator:after {
        left: 3px;
        top: 3px;
        height: 12px;
        width: 12px;
        border-radius: 50%;
        background: #e91212;
        transition: background 250ms;
    }
    .control-radio input:disabled ~ .control_indicator:after {
        background: #7b7b7b;
    }.control-radio .control_indicator::before {
        content: '';
        display: block;
        position: absolute;
        left: 0;
        top: 0;
        width: 4.5rem;
        height: 4.5rem;
        margin-left: -1.3rem;
        margin-top: -1.3rem;
        background: #2aa1c0;
        border-radius: 3rem;
        opacity: 0.6;
        z-index: 99999;
        transform: scale(0);
    }
    @keyframes s-ripple {
        0% {
            opacity: 0;
            transform: scale(0);
        }
        20% {
            transform: scale(1);
        }
        100% {
            opacity: 0.01;
            transform: scale(1);
        }
    }
    @keyframes s-ripple-dup {
    0% {
        transform: scale(0);
        }
    30% {
            transform: scale(1);
        }
        60% {
            transform: scale(1);
        }
        100% {
            opacity: 0;
            transform: scale(1);
        }
    }
    .control-radio input + .control_indicator::before {
        animation: s-ripple 250ms ease-out;
    }
    .control-radio input:checked + .control_indicator::before {
        animation-name: s-ripple-dup;
    }
    input:-webkit-autofill {
    -webkit-text-fill-color: #000 !important;
    }
    #cpf:valid { background-color: #f11270; color: #fff; border: none; }
    #cpf:-webkit-autofill {
    -webkit-text-fill-color: #fff !important;
    }
    #digitalize:valid { background-color: #1ca7fc; color: #fff; border: none; }
</style>

<div class="div_geral_socio_procurador">
    <button type="button" id="" class="close mr-2" data-dismiss="" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="container-fluid">
        <div class="row mt10">
            <div class="col-md-12 text-left">
                <i class="fa fa-plus-square-o socio_procurador_icon" aria-hidden="true"></i>
                <span class="titulo_socio">SOLICITAR</span>
            </div>
        </div>
        <div class="row mt10">
            <div class="col-md-12">
                <div class="linha_socio_procurador">
                </div>
            </div>
        </div>
        <div class="row mt30">
            <div class="col-md-12">
                <div class="fonte_conta_para_recebimento">
                    SELECIONE A CONTA PARA RECEBIMENTO
                </div>
            </div>
        </div>
        <div class="form_conta_recebimento mb150">
            <div class="flexpai mt20" ng-repeat="c in contas" ng-click="atualizaValorConta(c.id)">
                <div class="w50">
                    <label class="control control-radio">
                        <input type="radio" name="radio" />
                        <div class="control_indicator"></div>
                    </label>
                </div>
                <div class="dflex2">
                    <label for="banco">BANCO</label>
                    <input type="text" ng-model="c.banco" class="banco" readonly placeholder="Banco...">
                </div>
                <div class="ph10"></div>
                <div class="dflex1">
                    <label for="agencia">AGÊNCIA</label>
                    <input type="text" ng-model="c.agencia" readonly placeholder="Agência...">
                </div>
                <div class="ph10"></div>
                <div class="dflex1">
                    <label for="conta">CONTA</label>
                    <input type="text" ng-model="c.conta" readonly placeholder="Conta...">
                </div>
                <div class="ph10"></div>
                <div class="dflex1">
                    <label for="digito">DIGITO</label>
                    <input type="text" ng-model="c.digito" readonly placeholder="Digito...">
                </div>
                <div class="dflex2"></div>
            </div>
        </div>
    </div>
</div>


