@extends('layout.main')

@section('css-reservas')
<link rel="stylesheet" href="{{asset('/css/reservas.css')}}">
@endsection

@section('content')
    @if(session('reservaRegistrada'))
        <input type="hidden" id="inputSucesso">
    @endif

    @if($errors->all())
        <div id="modalErro" class="modal">
            <div class="modal-content">
                <div class="modal-body">
                    {!! implode('', $errors->all('<div>:message</div>')) !!}      
                </div>
            </div>
        </div>
    @endif

    <div class="container-fluid principal">
        <div style="text-align: right;">
            <button class="btn btn-danger mt-4" id="botaoModal">
                <i class="fa fa-list"></i> Visualizar reservas 
            </button>
        </div>

        <div class="titulo text-center">
            <p class="mt-3" style="color: white;">Reservas</p>
        </div>
            @if($reserva_marcada->count() > 0)
                <div id="meuModal" class="modal">
                    <div class="modal-content">
                        <span class="close" data-dismiss="modal">&times;</span>
                        <div class="modal-body">
                            @if($reserva_marcada->count() == 1)
                                <p>Você possui reserva marcada! Te esperamos aqui no dia
                                    @foreach($reserva_marcada as $reservaAtual)
                                        <p>{{ date('d/m/Y', strtotime($reservaAtual->data_reserva)) }} às {{ date('H:i', strtotime($reservaAtual->data_reserva)) }} horas.</p>
                                    @endforeach
                                </p>
                            @elseif($reserva_marcada->count() > 1)
                                <p>Você possui reservas marcadas nos dias:</p>
                                @foreach($reserva_marcada as $reservaAtual)
                                    <p>{{ date('d/m/Y', strtotime($reservaAtual->data_reserva)) }} às {{ date('H:i', strtotime($reservaAtual->data_reserva)) }} horas.</p>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div id="meuModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <div class="modal-body">
                            <p>Você não possui nenhuma reserva marcada no nosso restaurante :(</p>
                        </div>
                    </div>
                </div>
            @endif
        <div class="row conteudoLinha">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xm-6 mt-5">
                <div class="texto-esquerda">
                    @if($reservasParaTabela->count() > 0)
                        <div class="py-2">
                            <p class="h5" style="font-family: roboto">Lista de reservas já agendadas:</p>
                        </div>
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table table-sm table-striped text-dark table-light">
                                <thead class="bg-warning text-white">
                                    <tr>
                                        <th scope="col">Data</th>
                                        <th scope="col">Mesa</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-danger text-white">
                                    @foreach($reservasParaTabela as $reserva)
                                        @foreach($mesaReservada as $mesaR)
                                            @if($mesaR->id_mesa == $reserva->id_mesa)
                                                <tr>
                                                    <td>{{ date('d/m/Y', strtotime($reserva->data_reserva)) }} às {{ date('H:i', strtotime($reserva->data_reserva)) }}</td>
                                                    @if($mesaR->qtd_cadeiras == 1)
                                                        <td>Mesa {{$mesaR->tipo_mesa}} para {{$mesaR->qtd_cadeiras}} pessoa</td>
                                                    @else                          
                                                        <td>Mesa {{$mesaR->tipo_mesa}} para {{$mesaR->qtd_cadeiras}} pessoas</td>
                                                    @endif
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-light" style="font-family: roboto">
                            Bem-vindo(a) à aba de reservas! Aqui, você pode realizar reservas em nosso restaurante a qualquer horário entre 10:00
                            e 00:00, desde que a mesa de sua escolha não tenha sido reservada para o mesmo horário! Esta mensagem somente é exibida
                            caso não exista nenhuma reserva ativa no momento, então... aproveite!
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xm-6 mt-5">
                <div class="container-form text-right">
                    <form action="store" method="post">
                        {{ csrf_field() }}

                        <div class="form-group text-lg-right">
                            <label style="font-style:bold;" class="text-left warning">CPF:</label>
                            <input id="inputCpf" class="form-control col-lg-12 inputRed" type="text" name="cpf" placeholder="Digite seu CPF" required>
                        </div>

                        @if(session('horaMenor'))
                            <div class="alert alert-danger text-left" role="alert">
                                {{session('horaMenor')}}
                            </div>
                        @endif
                        <div class="form-group">
                            <label style="font-style:bold;" class="text-left warning">Data da reserva</label>
                            <input id="inputDataReserva" name="data_reserva" class="form-control col-lg-12 inputYellow"
                                type="datetime-local" min="{{ date('Y-m-d')}}T{{date('H:i') }}"
                                max="{{date('Y-m-d', strtotime('+2 Years')) . 'T23:00:00'}}" onkeypress="return false;" required>
                        </div>

                        <div class="form-group">
                            <label class="text-left">Selecione a mesa</label>
                            <select name="mesa" class="form-control col-lg-12 inputRed"; required>
                                @foreach($mesa as $mesaAtual)
                                <option id="" value="{{ $mesaAtual->id_mesa }}">
                                    {{ ucfirst($mesaAtual->tipo_mesa) }}
                                    para
                                    {{ ucfirst($mesaAtual->qtd_cadeiras) }}
                                    @if($mesaAtual->qtd_cadeiras == 1)
                                    pessoa
                                    @else
                                    pessoas
                                    @endif
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group text-left">
                            <input type="submit" class=" col-lg-12 btn  btn-warning" value="cadastrar reserva">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('post-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    // Função para colocar uma máscara no CPF
    $(document).ready(function () {
        $('#inputCpf').mask('000.000.000-00');
    });

    // Função para abrir o modal de erro assim que a página carregar
    $(window).on('load',function(){
        $('#modalErro').modal('show');
        $('.modal-backdrop').remove();

        if ($("#inputSucesso").length != 0){
            $("#meuModal").modal('show');
            $('.modal-backdrop').remove();
        }
    });

    var modal = document.getElementById("meuModal");
    var btn = document.getElementById("botaoModal");
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
    modal.style.display = "block";
    }

    span.onclick = function() {
    modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

</script>
@endsection