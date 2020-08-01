@extends('layout.main')
<!-- Sessão bem simples para o CSS do registro, apenas para mudar a cor dos asteriscos de obrigatoriedade-->
@section('css-registro')
<style>
    .asterisco {
        color: red;
    }
</style>
@endsection

<!-- Nada de especial sobre o registro -->
@section('content')
<div class="container pt-4 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Register') }}</div>

                <div class="card-body">
                    <!-- Rota de registro definida pelo Auth::routes() -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}<span class="asterisco">*</span>:</label>

                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="Digite seu nome" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sobrenome"
                                class="col-md-4 col-form-label text-md-right">{{ __('Sobrenome') }}<span class="asterisco">*</span>:</label>

                            <div class="col-md-6">
                                <input id="sobrenome" type="text" placeholder="Digite seu sobrenome"
                                    class="form-control @error('sobrenome') is-invalid @enderror" name="sobrenome"
                                    value="{{ old('sobrenome') }}" required autocomplete="sobrenome" autofocus>

                                @error('sobrenome')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}<span class="asterisco">*</span>:</label>

                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="Digite seu e-mail" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefone" class="col-md-4 col-form-label text-md-right">{{ __('Telefone') }}<span class="asterisco">*</span>:</label>

                            <div class="col-md-6">
                                <input id="telefone" type="tel" placeholder="Digite seu telefone (sem o 9 na frente)"
                                    class="form-control @error('telefone') is-invalid @enderror" name="telefone"
                                    value="{{ old('telefone') }}" required autocomplete="telefone" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}<span class="asterisco">*</span>:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" placeholder="Digite sua senha"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}<span class="asterisco">*</span>:</label>

                            <div class="col-md-6">
                                <input id="password-confirm" placeholder="Confirme sua senha" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger btn-md">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('post-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    $(document).ready(function () {
        $('#telefone').mask('(00) 0000-0000');
    });
</script>
@endsection