<!DOCTYPE html>
<html lang="pt-br" style="height: 100%;">
<!--Eu comentei os códigos que a gente ainda não tá usando kkk, e o caminho no asset() só funciona
aqui, então é pra adaptar-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- O título do site é complementado com uma variável de subtítulo não obrigatória, que possui seu valor definido de acordo com cada página -->
    <title>Eccezionale MVC {{ $subtitulo ?? '' }}</title>
    <!-- Arquivos de CSS essenciais são trazidos diretamente pelos links -->
    <link rel="icon" href="{{ asset('img/kitchen.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/footer.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <!-- Cada página dessas possui seu CSS próprio, que só é carregado quando a página em questão está sendo exibida -->
    @yield('css-home')
    @yield('css-registro')
    @yield('css-comidas')
    @yield('css-carrinho')
    @yield('css-reservas')
    @yield('css-contato')
    @yield('css-fechado')
</head>

<body style="height: 100%;">
    <!-- Inclusão do navbar -->
    @include('layout.navbar')

    <div class="w-100 d-flex flex-column align-items-end h-100">
        <!-- A inclusão do conteúdo de outras páginas é feita dentro de uma div, para ajudar sua exibição -->
        <div class="w-100">
            <div class="row no-gutters justify-content-center pt-4 pt-md-5">
                <div class="col-12 pt-5">
                    <!-- Inclusão do conteúdo principal de outras páginas -->
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- Inclusão do footer -->
        @include('layout.footer')
    </div>

    <!-- jQuery -->
    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="{{ asset('/js/popper.min.js') }}"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{ asset('/js/mdb.min.js') }}"></script>
    <!-- Arquivo javascript opcional -->
    <script type="text/javascript" src="{{ asset('/js/script.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>
    <!-- O javascript de outras páginas é trazido para cá -->
    @yield('post-script')
</body>

</html>
