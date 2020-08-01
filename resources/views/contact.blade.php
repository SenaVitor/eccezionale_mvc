@extends('layout.main')
<!-- Sessão de CSS da página, que será enviada para o main.blade.php-->
@section('css-contato')
<!-- Além do <style>, também são necessários estes imports para o funcionamento da página -->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
<link rel="stylesheet" href="{{asset('/css/contact.css')}}">
<style>
body {
    background-image: url(../img/mockupFachada.png);
    background-size: 100% 100%;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-color: rgba(0, 0, 0, 0.5);
    background-blend-mode: overlay;
}
</style>
@endsection

<!-- Fim da sessão de CSS e início da principal -->

@section('content')
<div class="container pt-3">
    <!-- Se uma mensagem for enviada com sucesso, essa div é exibida -->
    @if(session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
    @endif


    <div class="texto-contato">
        <div class="row">
            <!-- Se o usuário estiver logado, seu nome será exibido na mensagem de boas vindas -->
            @if(Auth::check())
            <div class="titulo-contato col-md-12">
                <h1>Olá, {{Auth::user()->name}}! Nos envie uma mensagem!</h1>
            </div>
            <!-- Se não, a mensagem padrão será exibida -->
            @else
            <div class="titulo-contato col-md-12">
                <h1> Nos envie uma mensagem!</h1>
            </div>
            @endif
        </div>

        <div class="row">
            <div class="descricao-contato col-lg-5">
                <p>O Eccezionale MVC está aberto durante 24h para responder sua mensagem o quanto antes, em sua maior
                    clareza!</p>
            </div>
        </div>
    </div>

    <div class="pb-5">
        <!-- Nesta linha, o formulário é aberto -->
        {!! Form::open(array('route' => 'postcontact','method'=>'POST')) !!}

        <!-- Se o usuário estiver logado, os inputs de nome e email são escondidos, e seus valores são definidos
            a partir dos dados do usuário no banco -->
        @if(Auth::check())
        {!! Form::text('name', Auth::user()->name, array('placeholder' => '','class' => 'form-control
        transparent-input', 'autocomplete' => 'off', 'style' => 'display: none'))!!}
        {!! Form::text('email', Auth::user()->email, array('placeholder' => '','class' => 'form-control
        transparent-input', 'autocomplete' => 'off', 'style' => 'display: none'))!!}
        <!-- Se não, o usuário precisa preenchê-los para poder enviar uma mensagem -->
        @else
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                <div class="form-group">
                    <strong>Nome:</strong>
                    {!! Form::text('name', null, array('placeholder' => '','class' => 'form-control
                    transparent-input','autocomplete' => 'off',
                    'required'))
                    !!}
                    {!! $errors->first('name', '<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6 col-sm-12 col-md-12 col-lg-4">
                <div class="form-group">
                    <strong>Email:</strong>
                    {!! Form::text('email', null, array('placeholder' => '','class' => 'form-control transparent-input',
                    'autocomplete' => 'off',
                    'required'))
                    !!}
                    {!! $errors->first('email', '<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            <div class=" divMensagem col-xs-6 col-sm-6 col-md-12 col-lg-7">
                <div class="form-group">
                    <strong style:{color:white;}>Mensagem:</strong>
                    {!! Form::textarea('message', null, array('placeholder' => '','class' =>
                    'form-control transparent-input','style'=>'height:90px', 'required')) !!}
                    {!! $errors->first('message', '<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
        </div>

        <!-- Nesta div é dado o submit do formulário, a partir do botão de salvar -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                {!! Form::submit('Enviar',['class'=>'btn btn-warning col-lg']) !!}
            </div>
            <!-- O formulário é fechado aqui -->
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

<!-- Fim da sessão principal e início da sessão de javascript desta página -->

@section('post-script')
<script>
// Esse if verifica se há alguma mensagem da biblioteca toastr, e é responsável por exibí-la
@if(Session::has('message'))
var type = "{{ Session::get('alert-type', 'info') }}";
switch (type) {
    case 'info':
        toastr.info("{{ Session::get('message') }}");
        break;

    case 'warning':
        toastr.warning("{{ Session::get('message') }}");
        break;
    case 'success':
        toastr.success("{{ Session::get('message') }}");
        break;
    case 'error':
        toastr.error("{{ Session::get('message') }}");
        break;
}
@endif
</script>
<!-- Essas duas bibliotecas javascript também são necessárias -->
<script src="http://demo.expertphp.in/js/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@endsection