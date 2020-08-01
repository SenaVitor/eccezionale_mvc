<!--Essa página extende o layout do arquivo main.blade.php, que está dentro da pasta layout-->
@extends('layout.main')
<!-- Todos o css dentro dessa sessão vai parar no main.blade.php -->
@section('css-comidas')
<link href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@600&display=swap" rel="stylesheet">
<style>
    body {
        background-image: url("img/pattern.jpg");
        background-size: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        background-blend-mode: overlay;
    }

</style>
<!-- O arquivo de css externo da página das comidas também é carregado nesta sessão -->
<link rel="stylesheet" href="{{ asset('/css/comidas.css') }}">
@endsection

<!--Todo o código principal para ser enviado ao main.blade.php.-->
@section('content')

<!-- Div do botão do carrinho no topo da página. Nada de especial, além da rota definida no <a> -->
<div style="text-align: right;">
    <a href="{{ route('carrinho') }}" style="border: none;">
        <button class="btn btn-sm btn-dark">
            Carrinho <i class="fa fa-shopping-cart"></i>
        </button>
    </a>
</div>

<!-- Div do topo, acima das comidas -->
<div class="" style="text-align: center;">
    <!--Se o usuário tiver encomendado uma comida com sucesso, essa mensagem aparecerá quando ele voltar do carrinho-->
    @if(session('msgSucesso'))
        <div class="alert alert-success" role="alert">
            {{ session('msgSucesso') }}
        </div>
    @endif

    <h1 class="tituloDelivery">Delivery</h1>
    <h6 class="subtituloDelivery">Escolha seu tipo de comida</h6>
    <!--Botões que irão chamar os tipos de comida-->
    <button class="btn btn-warning btn-sm botaoComida" onclick="alema();">Alemã</button>
    <button class="btn btn-success btn-sm botaoComida" onclick="italiana();">Italiana</button>
    <button class="btn btn-danger btn-sm botaoComida" onclick="japonesa();">Japonesa</button>
</div>

<!-- Linha que divide o topo do site das comidas -->
<hr class="hrComidas">

<!-- Modal de enviar a Comida ao carrinho -->
<div class="modal fade" id="comidaModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header backgroundOpaco">
                <h5 class="modal-title" id="exampleModalLongTitle">Mandar para o Carrinho</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modalComprarComida">
                <!-- Esse input escondido recebe o id da comida -->
                <input type="hidden" id="idComida" value="">

                <div class="form-group">
                    <label for="nomeComida" class="font-weight-bold">Comida:</label>
                    <p id="nomeComida"></p>
                </div>
                <div class="form-group">
                    <label for="precoComida" class="font-weight-bold">Preço:</label>
                    <p id="precoComida"></p>
                </div>
                <div class="form-group">
                    <label for="descricaoComida" class="font-weight-bold">Descrição:</label>
                    <p id="descricaoComida"></p>
                </div>

                <!--Essa div de erro só é exibida se o usuário fizer algo errado-->
                <div class="alert alert-danger" role="alert"
                    style="display: none; word-break: break-word; white-space: pre-line;" id="divErro">
                </div>

                <div class="form-group">
                    <label for="quantidadeComida" class="font-weight-bold">Quantidade:</label>
                    <input type="number" id="quantidadeComida" class="form-control" placeholder="Informe a quantidade"
                        onchange="checarQtdMinima();" required>
                </div>
            </div>
            <div class="modal-footer backgroundOpaco">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                <!-- Esse botão envia a comida selecionada para o carrinho -->
                <button type="button" class="btn btn-success" onclick="enviarParaOCarrinho();">Enviar</button>
            </div>
        </div>
    </div>
</div>
<!-- Fim do modal de enviar a comida ao carrinho -->

<!--Modal de "Comida Adicionada ao Carrinho" que aparece após a comida ser enviada ao carrinho -->
<div class="modal fade right" id="carrinhoModal" tabindex="-1">
    <div class="modal-dialog modal-side modal-bottom-right" role="document">
        <div class="modal-content">
            <div class="modal-header backgroundOpaco">
                <h4 class="modal-title w-100" id="myModalLabel">Carrinho</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body backgroundOpaco">
                Comida adicionada ao carrinho!
            </div>
            <div class="modal-footer backgroundOpaco">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                <!--Ao clicar nesse botão, o usuário é redirecionado para a rota da página do carrinho-->
                <a href="{{ route('carrinho') }}" style="border: none;">
                    <button type="button" class="btn btn-success">Ir para o carrinho</button>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Fim do modal de comida adicionada ao carrinho -->


<!---------------------- DIV PRINCIPAL ---------------------->

<!--Código pra gerar as tabelas dentro de um card. É usado um laço de repetição pra gerar os cards baseado no
número de comidas existentes na tabela -->
<div class="container" id="comidasAlemas" style="visibility: hidden;">
    <div class="row mx-4 mx-sm-0 justify-content-center">
        <!--Para cada comida alemã no banco, é criado um card na div de comidas alemãs-->
        <!--O mesmo se aplica para as demais comidas italianas e japonesas, naturalmente-->
        @foreach($comidaAlemanha as $add)
            <div class="card col col-12 col-md-5 col-lg-3 mx-md-2 my-2">
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <!-- A imagem da comida é carregada acima de tudo -->
                            <img src="{{ asset($add->imagem_comida) }}" class="card-img-top" alt="..."
                                id="imagensComidas" width="100%" height="300px">
                            <tr>
                                <td class="text-center" colspan="2">
                                    <!--Esse botão chama o método modalComprar(), e passa como parâmetro vários dados da comida.
                                        Isso se aplica às outras divs de comidas italiana e japonesa-->
                                    <button class="btn btn-warning btn-sm botaoComprarComidas"
                                        onclick="modalComprar('{{ $add->id_comida }}', '{{ $add->nome_comida }}', '{{ $add->preco_comida }}', '{{ $add->descricao_comida }}');">Comprar</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Nome:</th>
                                <td>{{ $add->nome_comida }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Preço:</th>
                                <td>R$ {{ $add->preco_comida }}</td>
                            </tr>

                            <tr>
                                <td colspan="2">{{ $add->descricao_comida }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="container" id="comidasItalianas" style="display: none;">
    <div class="row mx-4 mx-sm-0 justify-content-center">
        @foreach($comidaItalia as $add)
            <div class="card col col-12 col-md-5 col-lg-3 mx-md-2 my-2">
                <div class="card-body">
                    <img src="{{ asset($add->imagem_comida) }}" class="card-img-top" alt="..." id="imagensComidas"
                        width="100%" height="300px">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <button class="btn btn-success btn-sm botaoComprarComidas"
                                        onclick="modalComprar('{{ $add->id_comida }}', '{{ $add->nome_comida }}', '{{ $add->preco_comida }}', '{{ $add->descricao_comida }}');">Comprar</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Nome:</th>
                                <td>{{ $add->nome_comida }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Preço:</th>
                                <td>R$ {{ $add->preco_comida }}</td>
                            </tr>

                            <tr>
                                <td colspan="2">{{ $add->descricao_comida }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="container" id="comidasJaponesas" style="display: none;">
    <div class="row mx-4 mx-sm-0 justify-content-center">
        @foreach($comidaJapao as $add)
            <div class="card col col-12 col-md-5 col-lg-3 mx-md-2 my-2">
                <div class="card-body">
                    <img src="{{ asset($add->imagem_comida) }}" class="card-img-top" alt="..." id="imagensComidas"
                        width="100%" height="300px">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <button class="btn btn-danger btn-sm botaoComprarComidas"
                                        onclick="modalComprar('{{ $add->id_comida }}', '{{ $add->nome_comida }}', '{{ $add->preco_comida }}', '{{ $add->descricao_comida }}');">Comprar</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Nome:</th>
                                <td>{{ $add->nome_comida }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Preço:</th>
                                <td>R$ {{ $add->preco_comida }}</td>
                            </tr>

                            <tr>
                                <td colspan="2">{{ $add->descricao_comida }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

<!--Todo o javascript contido nessa div vai parar no main.blade.php-->
@section('post-script')
<script>
    // Essa função revela a div de comida alemã e muda seu background
    function alema() {
        document.getElementById("comidasAlemas").style.visibility = "visible";
        document.getElementById("comidasAlemas").style.display = "block";
        document.getElementById("comidasItalianas").style.display = "none";
        document.getElementById("comidasJaponesas").style.display = "none";

        document.body.style.backgroundImage = "url('img/bgAlemanha.png')";
    }

    // Essa função revela a div de comida italiana e muda seu background
    function italiana() {
        document.getElementById("comidasAlemas").style.display = "none";
        document.getElementById("comidasItalianas").style.display = "block";
        document.getElementById("comidasJaponesas").style.display = "none";

        document.body.style.backgroundImage = "url('img/bgItalia.png')";
    }

    // Essa função revela a div de comida japonesa e muda seu background
    function japonesa() {
        document.getElementById("comidasAlemas").style.display = "none";
        document.getElementById("comidasItalianas").style.display = "none";
        document.getElementById("comidasJaponesas").style.display = "block";

        document.body.style.backgroundImage = "url('img/bgJapao.png')";
    }

    function checarQtdMinima() {
        var qtd = document.getElementById("quantidadeComida").value;
        if(qtd <= 0) {
            document.getElementById("quantidadeComida").value = 1;
        }
    }

    // Essa função popula o modal quando ele é aberto
    function modalComprar(id, nome, preco, descricao) {
        document.getElementById("idComida").value = id;
        document.getElementById("nomeComida").textContent = nome;
        document.getElementById("precoComida").textContent = "R$ " + preco;
        document.getElementById("descricaoComida").textContent = descricao;

        // Essa linha que abre o modal, a partir do #ID dele
        $('#comidaModal').modal('show');
    }

    // Essa função limpa o modal quando ele é fechado
    $('#comidaModal').on('hidden.bs.modal', function limparModal() {
        document.getElementById("idComida").value = "";
        document.getElementById("nomeComida").textContent = "";
        document.getElementById("precoComida").textContent = "";
        document.getElementById("descricaoComida").textContent = "";
        document.getElementById("quantidadeComida").value = "";
        document.getElementById("divErro").textContent = "";
        document.getElementById("divErro").style.display = "none";
    });

    // Essa função valida os dados da comida escolhida e os envia para o carrinho
    function enviarParaOCarrinho() {
        // Os valores são pegados a partir do id dos campos de comida e quantidade
        var idComida = document.getElementById("idComida").value;
        var quantidadeComida = document.getElementById("quantidadeComida").value;

        // Aqui é dado um post com jquery e ajax para que a página não atualize no processo, chamando o método
        // "adicionarCarrinho" do CarrinhoController
        $.post("{{ action('CarrinhoController@adicionarAoCarrinho') }}", {
            idComida: idComida,
            quantidadeComida: quantidadeComida
            // Se a operação for um sucesso, o código dentro do .done será executado
        }).done(function sucesso(adicionarAoCarrinho) {
            // O modal de comprar é escondido, e o modal do carrinho é exibido
            $("#comidaModal").modal('hide');
            $("#carrinhoModal").modal('show');
            // A partir daqui (.fail), os erros são tratados
        }).fail(function erroCarinho(adicionarAoCarrinho) {
            // Esse erro padrão só é exibido se o erro for realmente inesperado
            var erroPadrao =
                "Ocorreu algum erro ao pedir a comida! Se ele persistir, entre em contato conosco.";
            var erros = [];

            // Esses ifs populam o array de erros communs (quantidade inválida, por exemplo) para que eles
            // sejam exibidos organizadamente dentro da div posteriormente 
            if (adicionarAoCarrinho.hasOwnProperty("responseJSON")) {
                if (adicionarAoCarrinho.responseJSON.hasOwnProperty("errors")) {
                    Object.keys(adicionarAoCarrinho.responseJSON.errors).forEach(function todosOsErros(key) {
                        erros.push(...adicionarAoCarrinho.responseJSON.errors[key]);
                    });
                } else if (adicionarAoCarrinho.responseJSON.hasOwnProperty("message")) {
                    erros = [adicionarAoCarrinho.responseJSON.message];
                }
            }

            // Se o array de erros da página ficar vazio, algum erro mais complexo ocorreu, e a mensagem padrão é chamada
            if (erros.length === 0) {
                erros = [erroPadrao];
            }

            // Aqui os erros são enviados para dentro da div de erro, e esse join(\n) quebra a linha dos registros no array para eles serem exibidos de forma organizada
            document.getElementById("divErro").textContent = erros.join("\n");
            document.getElementById("divErro").style.display = "block";
            // console.log(adicionarAoCarrinho);
            console.log(erros);
        });
    }

</script>
@endsection