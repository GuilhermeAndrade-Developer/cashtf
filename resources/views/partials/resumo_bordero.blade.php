<style>
input:-webkit-autofill {
    -webkit-text-fill-color: #000 !important;
}
#cpf:valid { background-color: #f11270; color: #fff; border: none; }
#cpf:-webkit-autofill {
    -webkit-text-fill-color: #fff !important;
}
#contratosocial:valid { background-color: #1ca7fc; color: #fff; border: none; } 
#alteracoescontratuais:valid { background-color: #1ca7fc; color: #fff; border: none; }
#faturamento:valid { background-color: #1ca7fc; color: #fff; border: none; }
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
    </div>
    <div class="div_pai_solicitar_fundo_bordero mt20">
        <span class="fonte_boletos">
            RESUMO DO BORDERÔ
        </span>
    </div>
    <div class="div_pai_analisar_fundo_azul_selecionada ">
        <div class="flex1_text_center">
            <span>SACADO</span>
        </div>
        <div class="flex2_text_center">
            <span>CPF/CNPJ</span>
        </div>
        <!--<div class="flex1_text_center">
            <span>NFE</span>
        </div>
        <div class="flex1_text_center">
            <span>DATA DA NFE</span>
        </div>-->
        <div class="flex1_text_center">
            <span>VALOR</span>
        </div>
        <div class="flex1_text_center">
            <span>JUROS</span>
        </div>
        <div class="flex1_text_center">
            <span>IOF</span>
        </div>
        <div class="flex1_text_center">
            <span>TAC</span>
        </div>
        <div class="flex1_text_center">
            <span>PRAZO MÉDIO</span>
        </div>
        <div class="flex1_text_center">
            <span>A RECEBER</span>
        </div>
        <div class="flex1_text_center">
            <span>% JUROS</span>
        </div>
    </div>
    <!-- Foreach -->
    <div ng-class="!($index % 2) ? 'div_pai_analisar_fundo_cinza_selecionada' : 'div_pai_analisar_fundo_branco_selecionada'" ng-repeat="d in dados">
        <div class="flex1_text_center">
            <span alt="<% d.dest.xNome %>" title="<% d.dest.xNome %>"><% d.dest.xNome | limitTo:12 %></span>
        </div>
        <div class="flex2_text_center">
            <span ng-if="d.dest.CNPJ"><% d.dest.CNPJ %></span>
            <span ng-if="d.dest.CPF"><% d.dest.CPF %></span>
        </div>
        <!--<div class="flex1_text_center">
            <span><% d.idNota | limitTo:5 %></span>
        </div>
        <div class="flex1_text_center">
            <span>14/07/2020</span>
        </div>-->
        <div class="flex1_text_center">
            <span>R$ <% d.totalGeral.totalGeralSimples %></span>
        </div>
        <div class="flex1_text_center">
            <span>R$ <% d.jurosSub %></span>
        </div>
        <div class="flex1_text_center">
            <span>R$ 0,00</span>
        </div>
        <div class="flex1_text_center">
            <span>R$ <% d.totalGeral.tacSoma %></span>
        </div>
        <div class="flex1_text_center">
            <span><% d.diff %></span>
        </div>
        <div class="flex1_text_center">
            <span>R$ <% d.totalGeral.totalGeralJuros %></span>
        </div>
        <div class="flex1_text_center">
            <span><% d.totalGeral.jurosAplicado | number:2 %> %</span>
        </div>
    </div>
    <!-- Endforeach -->
    <div class="div_pai_analisar_fundo_rosa_selecionada mb150">
        <div class="flex3_text_center">
            <span><b>TOTAL LÍQUIDO ANTECIPADO:</b></span>
        </div>
        <div class="flex1_text_center">
        </div>
        <div class="flex1_text_center">
        </div>
        <div class="flex1_text_center">
        </div>
        <div class="flex1_text_center">
        </div>
        <div class="flex1_text_center">
        </div>
       
        <div class="flex1_text_center">
            <span><b>R$ <% totalAntecipado %></b></span>
        </div>
        <div class="flex1_text_center">
        </div>
    </div>
</div>



