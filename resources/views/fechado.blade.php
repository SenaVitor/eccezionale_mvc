@extends('layout.main')
<!-- CSS da página, que será enviado ao main.blade.php -->
@section('css-fechado')
<style>
    .deliveryAberto {
        transition: 1s all ease;
        width: 280px;
        height: 300px;
    }
    .deliveryAberto:hover {
        transition: 1s all ease;
        width: 300px;
        height: 320px;
    }
</style>
@endsection

<!-- Essa página é exibida se um usuário tentar pedir um delivery após as 23:00 e antes de 5:00 -->
@section('content')
<div class="content text-center" style="width: 100%;">
    <!-- Verificação da hora pelas funções do Laravel -->
    <!-- Se o usuário tentar acessar essa página pela URL, e o restaurante ainda estiver aberto, essa div é exibida -->
    @if(date('H:i:s') < '23:00' && date('H:i:s') > '05:00')
        <h1>O que você está fazendo aqui? Os deliveries ainda estão disponíveis!</h1>
        <a href="{{ route('comida') }}"><img src="{{ asset('img/aberto.png') }}"
                alt="" class="img-responsive deliveryAberto" width="280px" height="300px"></a>
    <!-- Se não, é exibida uma mensagem de que o restaurante está fechado para deliveries -->
    @else
        <h1>Infelizmente, os Deliveries estão indisponíveis até as 5:00!</h1>
        <img src="{{ asset('img/fechado.png') }}" alt="" class="img-responsive" width="280px"
            height="300px">
    @endif
</div>
@endsection
