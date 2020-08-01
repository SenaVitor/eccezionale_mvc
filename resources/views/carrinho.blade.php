@extends('layout.main')
<!--O CSS da view do Carrinho é inserido pelo seu arquivo externo, e essa linha
é enviada para o main.blade.php-->
@section('css-carrinho')
<link rel="stylesheet" href="{{ asset('css/carrinho.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
<!-- Se o carrinho não estiver vazio, o CSS da página muda, em parte, para o seguinte -->
@if($carrinho->count() > 0)
    <style>
        body {
            background-image: url("img/pattern.jpg");
            background-size: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            background-blend-mode: overlay;
        }

    </style>
@endif
@endsection

@section('content')
<!--Modal de confirmação da retirada da comida do carrinho-->
<div class="modal fade" id="modalConfirmarDelecao" tabindex="-1">
    <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Você deseja remover esta comida do carrinho?</p>
            </div>

            <!--Body-->
            <div class="modal-body">
                <i class="fas fa-times fa-4x animated rotateIn"></i>
            </div>

            <!--Footer-->
            <div class="modal-footer flex-center">
                <!-- É esse botão que de fato chama a função de deletar do carrinho -->
                <button class="btn btn-outline-danger" onclick="confirmarDelecao();">Sim</button>
                <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">Não</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Fim do modal de confirmação de retirada da comida do carrinho-->


<!--Div principal-->
<div class="container pt-3">
    @if($carrinho->count() < 1)
        <div class="container divCarrinhoVazio text-center">
            <a href="{{ route('comida') }}" class="linkCarrinhoVazio">
                <p class="h2 pt-3">Parece que seu carrinho está vazio! Que tal encomendar alguma comida?</p>
                <img src="{{asset('/img/carrinhoVazio.png')}}" alt="" width="50%" class="img-fluid">
                <!-- Essa div só será exibida se o carrinho estiver vazio-->
            </a>
        </div>
        <!-- Se o carrinho não estiver vazio, os códigos abaixo são carregados -->
    @else
        <!-- O form manda para a rota carrinho_encomendar, definida no web.php -->
        <form action="{{ route('carrinho_encomendar') }}" method="POST">
            @csrf

            <!-- Modal de confirmação da compra (Tem que estar dentro do form, pois ele que dá o submit) -->
            <div class="modal fade" id="modalConfirmarCompra" tabindex="-1">
                <div class="modal-dialog modal-sm modal-notify modal-success" role="document">
                    <!-- Conteúdo -->
                    <div class="modal-content text-center">
                        <!--Header-->
                        <div class="modal-header d-flex justify-content-center">
                            <p class="heading">Você deseja realizar a encomenda?</p>
                        </div>

                        <!--Body-->
                        <div class="modal-body">
                            <i class="fas fa-check fa-4x animated rotateIn"></i>
                        </div>

                        <!--Footer-->
                        <div class="modal-footer flex-center">
                            <!-- Esse botão que dá o submit no formulário, realizando a encomenda -->
                            <button type="submit" class="btn btn-outline-success">Sim</button>
                            <a type="button" class="btn  btn-success waves-effect" data-dismiss="modal">Não</a>
                        </div>
                    </div>
                    <!-- Fim do conteúdo -->
                </div>
            </div>
            <!-- Fim do modal de confirmação da compra -->

            <!-- Tabela de exibição dos itens do carrinho -->
            <table class="table table-sm table-striped" style="text-align: center;">

                <thead class="theadCarrinho">
                    <tr>
                        <th scope="col">Comida</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Preço</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    <!--Isso é um "for" normal, como usamos em Java. Ele é utilizado para percorrer os registros do carrinho-->
                    @for($i = 0; $i < $carrinho->count(); $i++)
                        <tr class="inputComida" id="tr{{ $carrinho[$i]->id_comida }}">
                            <!--Esse input escondido é usado para o valor do ID da comida ser obtido.
                            Para cada registor, o nome do input muda de acordo com o ID da comida.
                            Por isso o uso do "for" ao invés do "foreach"-->
                            <input type="hidden" id="{{ $carrinho[$i]->id_comida }}"
                                value="{{ $carrinho[$i]->id_comida }}" name="carrinho[{{ $i }}][id_comida]">

                            <td scope="row">
                                {{ $carrinho[$i]->comida->nome_comida }}
                            </td>
                            <td>
                                <input type="number" class="inputQuantidade"
                                    id="qtd{{ $carrinho[$i]->id_comida }}"
                                    value="{{ $carrinho[$i]->quantidade_delivery }}"
                                    onchange="checarQuantidade({{ $carrinho[$i]->id_comida }});"
                                    name="carrinho[{{ $i }}][quantidade_delivery]">
                            </td>
                            <td>
                                R$ <span class="inputPreco">{{ $carrinho[$i]->comida->preco_comida }}</span>
                            </td>

                            <td>
                                <!-- Botão de retirar do carrinho. Ele chama o modal de retirar, e ao mesmo
                                tempo chama a função de retirar do carrinho. Porém essa função só é efetuada
                                se o valor do input escondido for true, o que é definido dentro do modal -->
                                <button type="button"
                                    onclick="retirarDoCarrinho({{ $carrinho[$i]->id_comida }});"
                                    class="botaoRetirar btn-danger" id="botaoRetirar">x</button>
                                <!-- Esse input escondido possui uma variável booleana de confirmação, que é
                                tida como false, mas quando é trocada para true pela função, é usada na função
                                de retirar do carrinho-->
                                <input type="hidden" value="false" id="inputConfirmacao">
                            </td>
                        </tr>
                    @endfor
                    <tr>
                        <td colspan="4" class="tdTotal">
                            <!--Aqui o total a ser pago é exibido, e também é contido num input escondido
                        que terá seu valor enviado para o POST do formulário.-->
                            Total: R$ <span id="total">{{ $total }}</span>
                            <input type="hidden" id="totalInput" name="preco_total" value="{{ $total }}">
                        </td>
                    </tr>
                </tbody>
            </table>

            <!--Div comum para a inserção do endereço-->
            <div class="bg-white p-3 rounded">
                <p class="h5">Informe o endereço da entrega:</p>
                @if($errors->all())
                    <div class="alert alert-danger" role="alert">
                        {!! implode('', $errors->all('<div>:message</div>')) !!}
                    </div>
                @endif
                <div class="row pt-3" id="divEndereco">
                    <div class="form-group col-md-2">
                        <label class="font-weight-bold" for="inputCep">CEP<span class="obrigatorio">*</span>:</label>
                        <input type="text" class="form-control" id="inputCep" placeholder="CEP" name="cep" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="font-weight-bold" for="inputNumero">Número<span
                                class="obrigatorio">*</span>:</label>
                        <input type="text" class="form-control" id="inputNumero" placeholder="Número" name="numero"
                            required>
                    </div>
                    <div class="form-group col-md-7">
                        <label class="font-weight-bold" for="inputComplemento">Complemento:</label>
                        <input type="text" class="form-control" id="inputComplemento" placeholder="Complemento"
                            name="complemento">
                    </div>
                </div>

                <!--Valor fixo do frete, que será adicionado ao total na hora do POST-->
                <div class="form-group" style="font-weight: bold">
                    <label for="exampleInputEmail1">Frete (será adicionado ao total):</label>
                    <p>R$ 5,00</p>
                </div>
            </div>

            <!--Botão centralizado para realizar o pedido-->
            <div class="text-center py-2">
                <button type="button" class="btn btn-sm btn-danger" onclick="pedirDelivery();">
                    Ordenar pedido
                    <br>
                    <i class="fa fa-motorcycle" aria-hidden="true"></i>
                </button>
            </div>
        </form>
    @endif
</div>
@endsection
<!--Todo o javascript contido nessa sessão será enviado para final do arquivo main.blade.php-->
@section('post-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    // Desabilita a tecla ENTER na hora de comprar
    $("form").keypress(function (e) {
        if (e.which == 13) {
            return false;
        }
    });

    // Função para colocar uma máscara no CEP
    $(document).ready(function () {
        $('#inputCep').mask('00000-000');
    });

    // Essa função checa o valor digitado pelo usuário na quantidade de comida. Sempre que o valor muda,
    // ele checa se o valor é menor que 1, e se for (o que não faz sentido, pedir -5 comidas), o valor
    // do input é definido como 1.
    function checarQuantidade(idQuantidade) {
        if (document.getElementById("qtd" + idQuantidade).value <= 1) {
            document.getElementById("qtd" + idQuantidade).value = 1;
        }
        calcularTotal();
    }

    // Essa função calcula o total a ser pago, multiplicando a quantidade pelo preço de cada comida e
    // incrementando o valor total numa variável só.
    function calcularTotal() {
        var total = 0;
        // Essa função cria um array com os valores dos inputs, e incrementa todos esses valores na variável
        // de total.
        [...document.querySelectorAll(".inputComida")].forEach(function pretoTotal(e) {
            var quantidade = e.querySelector(".inputQuantidade").value;
            var valor = e.querySelector(".inputPreco").textContent;

            total += quantidade * valor;
        });
        //Se o total de comidas no carrinho for 0, a página é recarregada
        if (total == 0) {
            location.reload();
        }
        // O valor total é setado tanto na div para ser exibido, quanto no valor do input para o POST
        document.getElementById("total").textContent = total;
        document.getElementById("totalInput").value = total;
    }

    // Essa função muda o valor do input de confirmação escondido para true, e clica automaticamente
    // no botão para retirar do carrinho
    function confirmarDelecao() {
        document.getElementById("inputConfirmacao").value = "true";
        $("#modalConfirmarDelecao").modal('hide');
        $("#botaoRetirar").click();
    }

    // Função para retirar, de fato, a comida do carrinho
    function retirarDoCarrinho(idComidaCarrinho) {
        var idComida = idComidaCarrinho;

        // Essa função abre o modal de confirmar a deleção
        $("#modalConfirmarDelecao").modal('show');

        // A variável de confirmação tem seu valor definido a partir do input escondido
        var confirmacao = document.getElementById("inputConfirmacao").value;

        // Se o valor for true (definido assim ao clicar em "Sim" no modal), o código de deleção é efetuado
        // E sem atualizar a página, por meio de jquery e um pouco de ajax
        if (confirmacao == "true") {
            $.post("{{ action('CarrinhoController@retirarComida') }}", {
                idComida: idComida
            // Se der tudo certo, o código dentro do .done é efetuado
            }).done(function sucesso(retirarComida) {
                // O "tr" no qual a comida deletada estava, é removido via jquery
                $("#tr" + idComida).remove();
                // console.log(retirarComida);
                // O total é recalculado
                calcularTotal();
            // Se der tudo errado, o código dentro do .fail é executado
            }).fail(function erroRetirar(retirarComida) {
                alert("Ocorreu um erro desconhecido! Por favor, entre em contato.");
                // console.log(retirarComida);
            });
        }
    }

    // Essa função só serve para abrir o modal de confirmar o pedido do Delivery :v
    function pedirDelivery() {
        $("#modalConfirmarCompra").modal('show');
    }

</script>
@endsection
