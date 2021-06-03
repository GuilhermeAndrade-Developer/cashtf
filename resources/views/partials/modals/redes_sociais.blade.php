
<div id="modal-redes-sociais">
    <div class="overlay"></div>
    <div class="div_modal_absolute">
        <div class="col-md-12 mobile">
            <button ng-click="modalDesvincular=0" type="button" id="close-modal" class="close mr-2" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <div class="text-center">
            
            <h4 class="font-weight-bold" style="font-weight: 500; font-size: 24px; margin-top: 40px;">ENTRAR UTILIZANDO</h4>
           
        </div>
        <div class="col-md-12 bg-none plr100 mt20 mb20">
            <label ng-show="user.facebook_id != null && user.facebook_id != 'unlinked' && user.facebook_id != idSocial" ng-click="authFacebook()" for="face" class="log_btn mt10 face">
                <i class="lab la-facebook-square"></i>
                <span>Facebook</span>
            </label>
            <label ng-show="user.linkedin_id != null && user.linkedin_id != 'unlinked' && user.linkedin_id != idSocial" ng-click="authLinkedin()" for="linkedin" class="log_btn mt10 linkedin">
                <i class="lab la-linkedin"></i>
                <span>Linkedin</span>
            </label>
            <label ng-show="user.google_id != null && user.google_id != 'unlinked' && user.google_id != idSocial" ng-click="authGoogle()" for="google" class="log_btn mt10 google">
                <img src="{{asset('images/google.png')}}" style="width: 22px;">
                <span>Google</span>
            </label>
            <label ng-click="modalDesvincular=2" class="log_btn mt10 email">
                <i class="fa fa-envelope-o"></i>
                <span>E-mail</span>
            </label>
        </div>

        <div class="text-center title_modal">
            *Para entrar utilizando outra rede social, é necessário vinculá-la primeiro no login principal.
        </div>
    </div>
</div>	