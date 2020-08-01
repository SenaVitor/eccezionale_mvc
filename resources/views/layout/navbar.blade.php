<!-- Navbar do site! -->
<nav class="col-lg-12 col-sm-12 col-xm-12 menu navbar navbar navbar-expand-lg fixed-top">
    <a id="logo" class="navbar-brand" href="{{ route('home') }}"><img
            src="{{ asset('img/logo.png') }}" width="50%"></a>
    <button id="botao" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01"
        aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
        <img src="{{ asset('img/logo.png') }}" width="50%">
    </button>
    <div class="col-lg-4 col-sm-4 col-xm-2 collapse navbar-collapse text-center" id="navbarsExample01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home') }}">Página inicial</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('reserva') }}">Reserva</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('comida') }}">Delivery</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('contato') }}">Contato</a>
            </li>
            <!--Se o usuário estiver logado, o código abaixo será exibido-->
            @if(Auth::check())
                <li class="nav-item active row">
                    <div class="col-md-12 school-options-dropdown text-center">
                        <div class="dropdown btn-group">
                            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                title="{{ Auth::user()->name }}">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <a id="linkDoMenu" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Sair</a>
                            </ul>
                        </div>
                    </div>
                </li>

                <!--Form escondido para realizar o POST do Logout-->
                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                    style="display: none;">
                    @csrf
                </form>
            <!--Se não houver usuário logado, o código abaixo que será exibido-->
            @else
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('login') }}">Logar</a>
                </li>
            @endif
        </ul>
    </div>
</nav>
