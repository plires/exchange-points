@extends('layouts.user-layout')

@section('content')
<div class="container login">
    <div class="row">

        <div class="col-md-12 text-center">
            <img class="img-fluid logo" src="{{ asset('/img/login/logo-principal.png') }}" alt="logo monster">
        </div>

        <div class="col-sm-12 col-md-8 col-lg-6 formulario">
            <h1>Resetear Contraseña</h1>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group row">
                    <div class="col-md-12">
                        <input id="email" type="email" placeholder="Email registrado" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0 text-center">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">
                            Enviar nueva contraseña
                        </button>
                    </div>
                </div>

                <div class="form-group row mb-0">

                    <div class="col-md-12 text-center">
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="btn btn-link transition" href="{{ route('login') }}">Login</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="btn btn-link transition" href="{{ route('register') }}">Registrate</a>
                            </li>
                        @endif
                    </div>

                </div>

            </form>

        </div>
    </div>
</div>
@endsection
