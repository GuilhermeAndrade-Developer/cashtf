<style>
    .social_row{
        display: flex;
        margin-bottom:10px;
    }

    .fundolixeiraperfil{
        background-color: #ff5757;
        width: 32px;
        text-align: center;
        height: 38px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .fundo_facebook{
        flex:1;
    }

    .fundo_linkedin{
        background-color: #0e76a8;
        height: 38px;
        display: flex;
        align-items: center;
        flex:1;
    }

    .fundo_google{
        background-color: #d34836;
        height: 38px;
        display: flex;
        align-items: center;
        flex:1;
    }

</style>

<div class="container-fluid">  
    <div class="div_pai_alterar_foto_perfil">
        <div class="alinha_bloco_cliente">
            <div>
                <img src="{{isset(Auth::user()->imagem) ? asset('images/usuarios/'.Auth::user()->imagem) : asset('images/place_holder_avatar.jpg')}}" class="estilo_foto_cliente" id="preview">
            
            </div>
            <div class="ml20">
                <label for="choose-file" class="btn fundo_alterar_foto">
                    ALTERAR FOTO
                    <input id="choose-file" name="imagem" style="display: none;" type="file" class="fileimagem" onchange="openFile(event)">
                </label>
                <div>
                    TAMANHO IDEAL: 200X200px
                </div>
                <div>
                    FORMATOS: JPG ou PNG
                </div>

            </div>
        </div>
    </div>
    <div class="form_socio_procurador mt40 mb150">
        <div class="flexpai mt20">
            <div class="dflex1">
                <label for="nomecompletoperfil">NOME COMPLETO</label>
                <input type="text" id="nomecompletoperfil" ng-model="user.name" readonly placeholder="Nome...">
            </div>
            <div class="ph10"></div>
            <div ng-show="user.redeSocial==1" class="dflex1">
                <label>CONTAS VINCULADAS</label>
                <div ng-show="user.facebook_id != null && user.facebook_id != 'unlinked'" class="social_row">
                    <div class="fundo_facebook">
                        <i class="lab la-facebook icone_facebook"></i>
                        <span class="fonte_usuario_facebook">Conta do Facebook</span>
                    </div>
                    <div class="div_w80">
                        <div class="alinhalixeira">
                            <div class="fundolixeiraperfil">
                                <i ng-click="clickDesvincular(user.facebook_id)" class="btn fa fa-trash-o iconelixeira"></i>
                            </div>
                        </div> 
                    </div>
                </div>
                <div ng-show="user.linkedin_id != null && user.linkedin_id != 'unlinked'" class="social_row">
                    <div class="fundo_linkedin">
                        <i class="lab la-linkedin icone_facebook"></i>
                        <span class="fonte_usuario_facebook">Conta do Linkedin</span>
                    </div>
                    <div class="div_w80">
                        <div class="alinhalixeira">
                            <div class="fundolixeiraperfil">
                                <i ng-click="clickDesvincular(user.linkedin_id)" class="btn fa fa-trash-o iconelixeira"></i>
                            </div>
                        </div> 
                    </div>
                </div>
                <div ng-show="user.google_id != null && user.google_id != 'unlinked'" class="social_row">
                    <div class="fundo_google">
                        <i class="lab la-google icone_facebook"></i>
                        <span class="fonte_usuario_facebook">Conta do Google</span>
                    </div>
                    <div class="div_w80">
                        <div class="alinhalixeira">
                            <div class="fundolixeiraperfil">
                                <i ng-click="clickDesvincular(user.google_id)" class="btn fa fa-trash-o iconelixeira"></i>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="dflex1"></div>
        </div>
    </div>
</div>
