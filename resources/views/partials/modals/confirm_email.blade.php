
<style>
    .div-register{
        background-color: rgba(0, 0, 0, .8);
        width: 100%;
        height: 100%;
        position: fixed;
        left: 0px;
        top: 0px;
        display: flex; 
        justify-content: center;
        align-items: center;
        z-index: 999;
    }
    .close-modal-register{
        position: absolute;
        right: 15px;
        top: 15px;
    }
</style>
<div class="div-register" id="div-register">
    <div id="modal-confirm-email" style="background-color: #FFF; padding: 60px 20px; z-index: 9999; position: relative;">
        <div class="div_modal_absolute">
            <button type="button" class="close mr-2 close-modal-register" onclick="$('#div-register').hide();">
                <span aria-hidden="true">&times;</span>
            </button>

            <div class="text-center">
                {{-- <div><i class="fa fa-exclamation-circle" style="font-size: 100px; color: #f11070;"></i></div> --}}
                
                <h4 class="font-weight-bold" style="font-weight: 500; font-size: 24px; margin-top: 40px;">CONFIRME O SEU E-MAIL</h4>
                <div class="h5 mt30 mb30 title_modal" style="line-height: 17px;">
                    Verifique a sua caixa de entrada ou SPAM.<br>
                    Abra o e-mail enviado pela cashTF e<br>
                    clique no link para confimar.
                </div>
            </div>
            <div style="margin-top: 20px; display: flex;">
                <div class="text-center mobile father" style="flex: 1; padding: 10px;">
                    <div class="text-center">
                        @if(isset($_GET['email']))
                        <a href="{{route('reenviar.email', ['email'=>$_GET['email']])}}">
                            <div class="text-center">
                                <button type="submit" class="btn btn-block button_pink" style="padding: 6px 60px;">
                                    <span style="letter-spacing: 2px;">
                                        REENVIAR E-MAIL
                                    </span>
                                </button>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>
                <div class="text-center mobile father margin_mob_reenv_email" style="flex: 1; padding: 10px;">
                    <div class="text-center">
                        <a href="{{route('home')}}">
                            <div class="text-center">
                                <button type="submit" class="btn btn-block button_pink_active" style="padding: 6px 60px;">
                                    <span style="letter-spacing: 2px;">
                                        CONTINUAR
                                    </span>
                                </button>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>	
</div>