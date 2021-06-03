
    <div style="display: flex; justify-content: flex-end; align-items: flex-end;">
        <div style="position: relative; z-index: -1;">
            <div style="display: flex; align-items: center; flex-direction: row;">
                <div style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
                    @if($solicitacao->id_status == 1)
                        <div style="background-color: #44dd9c; border-radius: 50px; display: flex; justify-content: center; align-items: center; height: 60px; width: 60px;">
                            <i class="fa fa-check" style="color: #fff; font-size: 25px; font-weight: bold;" aria-hidden="true"></i>
                        </div>
                    @else
                        <div style="background-color: #bfbfbf; border-radius: 50px; display: flex; justify-content: center; align-items: center; height: 60px; width: 60px;">
                            <i class="fa fa-check" style="color: #fff; font-size: 25px; font-weight: bold;" aria-hidden="true"></i>
                        </div>
                    @endif
                    <div style="position: absolute; text-align: center; top: 60px; width: 80px; font-size: 12px;">
                        APROVADO
                    </div>
                </div>
                <div style="display: flex; align-items: center;">
                    <div style="background-color: #bfbfbf; width:100px; height: 2px; margin: 0 20px;"></div>
                </div>
                <div style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
                    @if($solicitacao->id_status == 2)
                        <div style="background-color: #ffda00; border-radius: 50px; display: flex; justify-content: center; align-items: center; height: 60px; width: 60px;">
                            <i class="fa fa-spinner" style="color: #fff; font-size: 25px; font-weight: bold;" aria-hidden="true"></i>
                        </div>
                    @else
                        <div style="background-color: #bfbfbf; border-radius: 50px; display: flex; justify-content: center; align-items: center; height: 60px; width: 60px;">
                            <i class="fa fa-spinner" style="color: #fff; font-size: 25px; font-weight: bold;" aria-hidden="true"></i>
                        </div>
                    @endif
                    <div style="position: absolute; text-align: center; top: 60px; width: 162px; font-size: 12px;">
                        PENDENTE
                    </div>
                </div>
                <div style="display: flex; align-items: center;">
                    <div style="background-color: #bfbfbf; width: 100px; height: 2px; margin: 0 20px;"></div>
                </div>
                <div style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
                    @if($solicitacao->id_status == 3)
                        <div style="background-color: #f11010; border-radius: 50px; display: flex; justify-content: center; align-items: center; height: 60px; width: 60px;">
                            <i class="fa fa-close" style="color: #fff; font-size: 25px; font-weight: bold;" aria-hidden="true"></i>
                        </div>
                    @else
                        <div style="background-color: #bfbfbf; border-radius: 50px; display: flex; justify-content: center; align-items: center; height: 60px; width: 60px;">
                            <i class="fa fa-close" style="color: #fff; font-size: 25px; font-weight: bold;" aria-hidden="true"></i>
                        </div>
                    @endif
                    <div style="position: absolute; text-align: center; top: 60px; width: 80px; font-size: 12px;">
                        RECUSADO
                    </div> 
                </div>
            </div>
        </div>
    </div>
