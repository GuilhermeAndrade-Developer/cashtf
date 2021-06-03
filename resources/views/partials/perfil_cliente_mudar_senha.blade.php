<style>
    input#userEmail{
        background-color: #f4f4f4;
        border: none;   
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
            <form name="formUser" class="dflex1">
                <label for="userEmail">E-MAIL</label>
                <input type="text" id="userEmail" name="userEmail" ng-model="user.email" ng-pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/" readonly placeholder="E-Mail...">
                <div class="custom-error"  ng-show="formUser.userEmail.$error.pattern">
                    <span style="color:red">Formato de e-mail inválido.</span>
                </div>
            </form>
            <div class="dflex1">
            </div>
        </div>
        <div class="flexpai mt20">
            <div class="dflex1">
                <label for="alterarsenha">NOVA SENHA</label>
                <input type="password" id="alterarsenha" ng-model="novaSenha" name="alterarsenha" required>
            </div>
            <div class="ph10"></div>
            <div class="dflex1">
                <label for="confirmarsenha">CONFIRMAR SENHA</label>
                <input type="password" id="confirmarsenha" ng-model="confirmarSenha" name="confirmarsenha" required>
            </div>
            <div class="div_w80">
                <div class="alinhalixeira">
                    <div class="fundoconfirmar">
                        <i ng-click="alteraSenha()" class="btn las la-check-circle iconeconfirma"></i>
                    </div>
                </div> 
            </div>
            <div class="dflex1"></div>
        </div>
    </div>
</div>