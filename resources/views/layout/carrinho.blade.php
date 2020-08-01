@extends('layout.main')

@section('css-carrinho')
<link rel="stylesheet" href="{{ asset('css/carrinho.css') }}">
@endsection

@section('content')
<div class="container">
    <table class="table table-sm table-striped" style="text-align: center;">
        <thead class="theadCarrinho">
            <tr>
                <th scope="col">Comida</th>
                <th scope="col">Quantidade</th>
            </tr>
        </thead>
        <tbody>
            <tr></tr>
            @foreach($carrinho as $item)
                <tr>
                    <th scope="row">{{ $item->id_comida }}</th>
                    <td>
                        <button id="botaoMenos" class="btn btn-sm btn-danger"
                            onclick="decrementar({{ $item->id_comida }});
                        precoTotal({{ $item->id_comida }});">-</button> 
                        <input type="text" class="inputQuantidade" id="{{ $item->id_comida }}"
                            value="{{ $item->quantidade_delivery }}">
                        <button class="btn btn-sm btn-success"
                            onclick="incrementar({{ $item->id_comida }});">+</button>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        Preço: R$<input type="text" id="id_precoComida" value="15" class="inputQuantidade" readonly>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td>Total: R$255</td>
            </tr>
        </tbody>
    </table>

    <center>
        <button class="btn btn-sm btn-danger" id="pedirDelivery">
            Ordenar pedido
            <br>
            <i class="fa fa-motorcycle" aria-hidden="true"></i>
        </button>
    </center>
</div>
 @section('post-script')#
<script>
    function decrementar(id_quantidadeComida) {
        document.getElementById(id_quantidadeComida).value--;
        if (document.getElementById(id_quantidadeComida).value <= 1) {
            document.getElementById(id_quantidadeComida).value = 1;
        }
    }

    function incrementar(id_quantidadeComida) {
        document.getElementById(id_quantidadeComida).value++;
    }

    function precoTotal(id_quantidadeComida) {
        var qtd = document.getElementById(id_quantidadeComida).value;
        var preco = document.getElementById("id_precoComida").value;
        document.getElementById("precoTotal").value = qtd * preco;
    }

</script>
@endsection
@endsection