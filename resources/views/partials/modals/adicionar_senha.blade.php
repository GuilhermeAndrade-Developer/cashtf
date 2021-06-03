<div id="modal-adicionar-senha">
    <div class="overlay"></div>
    <div class="div_modal_absolute">
        <div class="col-md-12 mobile">
            <button ng-click="modalDesvincular=0" type="button" id="close-modal" class="close mr-2" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <div class="text-center">
            
            
            <h4 class="font-weight-bold" style="font-weight: 500; font-size: 24px;">ADICIONAR SENHA</h4>
            <div class="h5 mt30 mb30 title_modal">
                Para desvincular a sua conta da rede social,<br>você precisa definir uma nova senha.
            </div>
        </div>
        <div class="text-center col-md-12 mobile father">
            <div class="text-center div_form">
                <form method="POST">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="input-group mb10">
                                <span class="input-group-addon input_padrao pr0"><i class="fa fa-lock"></i></span>
                                <input id="email-reset-password" type="password" ng-model="novaSenha" class="form-control campo_quadrado input_padrao" name="email" required autocomplete="email" autofocus placeholder="Nova senha...">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group mb10">
                                <span class="input-group-addon input_padrao pr0"><i class="fa fa-lock"></i></span>
                                <input id="email-reset-password" type="password" ng-model="confirmarSenha" class="form-control campo_quadrado input_padrao" name="email" required autocomplete="email" autofocus placeholder="Confirme a senha...">
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <div class="text-center">
                            <button ng-click="finalizaDesvincular()" type="submit" class="btn btn-block button_pink">
                                CONFIRMAR
                            </button>
                        </div>
                    </div>
                </form>
            </div>		
        </div>
    </div>
</div>	