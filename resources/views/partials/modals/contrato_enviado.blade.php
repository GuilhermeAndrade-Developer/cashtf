<div id="modal-solicitacao-enviada">
    <div class="div_modal_absolute div_modal_confirma">
        <div class="col-md-12 mobile">
            
        </div>
        
        <div class="text-center">
             <div><img src="{{asset('images/cadastrado_branco.png')}}" style="width: 60px;"></div>
            
            <h4 class="font-weight-bold" style="font-weight: 500; font-size: 24px; margin-top: 20px; color: white;">CONTRATO ENVIADO</h4>
            <div class="h5 mt20 mb30 title_modal" style="line-height: 17px;">
                O contrato foi enviado para o email do cliente para<br>
                que seja feita a assinatura digital.<br>
            </div>
        </div>
        <div style="margin-bottom: 40px; margin-top: 20px;">
            <div class="text-center col-md-12 mobile father">
                <div class="text-center">
                    <div class="text-center">
                        <a href="{{Auth::user() ? (Auth::user()->tipo == 'admin' ? route('admin.solicitacoes') : route('cliente.solicitacoes')) : route('cliente.solicitacoes')}}">
                            <span>
                                ENTENDI
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>	