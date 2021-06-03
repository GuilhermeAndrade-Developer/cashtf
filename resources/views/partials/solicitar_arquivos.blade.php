<div class="div_geral_socio_procurador">
    <button type="button" id="" class="close mr-2" data-dismiss="" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="container-fluid">
        <div class="row mt10">
            <div class="col-md-6 text-left">
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
            <div class="col-md-12 text-center">
                <span class="adicione_os_arquivos">PARA SOLICITAR, ADICIONE AQUI<br>UM OU MAIS ARQUIVOS DAS NOTAS FISCAIS</span>
            </div>
        </div>
        <div class="box_solicite_arquivos">
            <div>
                <div class="borda estilo_borda">
                    <div class="flex_arquivos">
                        <img src="{{asset('images/envie_xml_rosa_icn.png')}}" style="margin-bottom: 16px;">
                        <span class="alinha_texto">
                            <span style="color: #F11070;">PARA ADICIONAR</span>,
                            <b>ESCOLHA</b> OS ARQUIVOS EM XML
                        </span>
                    </div>
                    <div class="W300"></div>
                    <div class="W240">
                        <label class="btn btn-block button_enviar_arquivos custom" for="xml">SELECIONAR ARQUIVO XML</label>
                        <input type="file" name="xml" id="xml" file-input="myFile" multiple style="display: none;" accept=".xml">
                    </div>
                </div>
            </div>
        </div>
        <div class="box_solicite_arquivos" ng-repeat="d in dados">
            <div class="flex_azul">
                <div class="flex_nota">
                    <% d.totalGeral.xml_file %>
                </div>
                <div class="W300"></div>
                <div class="flex_end_azul">
                    <i class="fa fa-trash lixeira_box_azul" ng-click="removeDados($index)"></i>
                </div>
            </div>
        </div>
    </div>
</div>


