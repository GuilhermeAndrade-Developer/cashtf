@extends('layouts.cliente.borderoInfo')

@section('content')
    <script>document.querySelector('header #resumo').classList.add('active');</script>

    <main class="app-g bordero-info">
        <div class="conteudo">
            <div class="title b_f_color">RESUMO DO BORDERÔ</div>

            <table class="table custom resumo">
                <thead>
                    <tr>
                        <th>RAZÃO SOCIAL</th>
                        <th>CNPJ</th>
                        <th>NFE</th>
                        <th>DATA DA NFE</th>
                        <th>VALOR</th>
                        <th>JUROS</th>
                        <th>IOF</th>
                        <th>TAC</th>
                        <th>PRAZO MÉDIO</th>
                        <th>A RECEBER</th>
                        <th>DESÁGIO</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>COCA LTDA</td>
                        <td>21.156.546Œ0001-00</td>
                        <td>18</td>
                        <td>17/07/2020</td>
                        <td>R$ 1.500,00</td>
                        <td>R$  75,00</td>
                        <td>0,00</td>
                        <td>R$ 10,00</td>
                        <td>29</td>
                        <td>R$ 1.470,00</td>
                        <td>1.99%</td>
                    </tr>

                    <tr>
                        <td>COCA LTDA</td>
                        <td>21.156.546Œ0001-00</td>
                        <td>18</td>
                        <td>17/07/2020</td>
                        <td>R$ 1.500,00</td>
                        <td>R$  75,00</td>
                        <td>0,00</td>
                        <td>R$ 10,00</td>
                        <td>29</td>
                        <td>R$ 1.470,00</td>
                        <td>1.99%</td>
                    </tr>

                    <tr class="warn">
                        <td>COCA LTDA</td>
                        <td>21.156.546Œ0001-00</td>
                        <td>18</td>
                        <td>17/07/2020</td>
                        <td>R$ 1.500,00</td>
                        <td>R$  75,00</td>
                        <td>0,00</td>
                        <td>R$ 10,00</td>
                        <td>29</td>
                        <td>R$ 1.470,00</td>
                        <td>1.99%</td>
                    </tr>
                </tbody>

                <tfoot>
                    <tr class="b_f_color">
                        <td colspan="9">TOTAL LIQUIDO ANTECIPADO</td>
                        <td>R$ 4.338,35</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </main>

@endsection
