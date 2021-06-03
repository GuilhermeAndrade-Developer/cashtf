<div id="modal-adicionar-email">
	<div class="overlay"></div>
	<div class="div_modal_absolute">
		<div class="col-md-12 mobile">
			<button ng-click="modalDesvincular=0" type="button" id="close-modal" class="close mr-2" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		
		<div class="text-center mt10">
			<h4 class="font-weight-bold" style="font-weight: 500; font-size: 24px;">ADICIONAR E-MAIL</h4>
			<div class="h5 mt30 mb30 title_modal">
                Para desvincular a sua conta da rede social,<br>você precisa confirmar/alterar o e-mail.
            </div>
		</div>
		<div class="text-center col-md-12 mobile father mt20">
			<div class="text-center div_form">
				<form name="formUser" method="POST">
					

					<div class="form-group row">
						<div class="col-md-12">
							<div class="input-group mb10">
								<span class="input-group-addon input_padrao pr0"><i class="fa fa-envelope"></i></span>
								<input type="text" id="userEmail" name="userEmail" ng-model="user.email" class="form-control campo_quadrado input_padrao" ng-pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/" required placeholder="E-Mail...">
							</div>
						</div>
						<div class="title_modal"  ng-show="formUser.userEmail.$error.pattern">
							Formato de e-mail inválido.
						</div>
					</div>

					<div class="text-center">
						<div class="text-center">
							<button ng-click="verificaEmail()" type="submit" class="btn btn-block button_pink">
								CONFIRMAR
							</button>
						</div>
					</div>
				</form>
			</div>		
		</div>
	</div>
</div>	