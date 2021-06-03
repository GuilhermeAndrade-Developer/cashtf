<style>
    #modalInteresse .modal-body{
        margin: 0px;
        padding: 30px 50px !important;
    }
    #modalInteresse .titulo{
        color: #F11070;
        font-size: 30px;
    }
    #modalInteresse .button-close-modal button{
        background-color: white;
        border-color: white;
    }
    #modalInteresse .button-close-modal i{
        font-size: 18px;
    }
    #modalInteresse .button-ok{   
        font-family: qanelas_n;
        color: #fff;
        padding: 10px 100px;
        font-size: 15px;
        background: transparent radial-gradient(closest-side at 66% 18%, #F11070 0%, #F11070 100%) 0% 0% no-repeat padding-box;
        box-shadow: 0px 3px 6px #0000001A;
    }
    #modalInteresse hr{
        margin-top: 0px;
        margin-bottom: 20px;
        border: 0;
        border-top: 1px solid #eee;
        border-color: #F11070;
    }
</style>

<!-- Modal -->
<div class="modal" id="modalInteresse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="overlay"></div>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="text-right button-close-modal">
                <button data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="text-center titulo"><img src="{{asset('images/cadastrado_p_icn.png')}}" style="width: 30px; padding-bottom: 5px;"><span>  OBRIGADO PELO INTERESSE</span></div>
                    <hr>
                    <p class="text-center" style="margin-bottom: 40px;">Recebemos os seus dados e em breve entraremos em contato para mais informações.</p>
                </div>
                <div class="text-center mt20">
                    <button data-dismiss="modal" class="button-ok">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>