@extends('layouts.user-layout')

@section('content')

<section class="login">

    <div class="container">
        
        <div class="row">

            <div class="col-md-12 text-center">
                <img class="img-fluid logo" src="{{ asset('/img/login/logo-principal.png') }}" alt="logo monster">
            </div>


            <div class="col-sm-12 col-md-10 col-lg-8 formulario">
                <h1>REGISTRO</h1>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group row">

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nombre" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" placeholder="Apellido" required autocomplete="lastname">

                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-md-6">
                            <input id="document" type="text" class="form-control @error('document') is-invalid @enderror" name="document" value="{{ old('document') }}" placeholder="Documento Identidad" required autocomplete="document" autofocus>

                            @error('document')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña" required autocomplete="new-password">
                        </div>

                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">
                                Registrar
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
                            @if (Route::has('password.request'))
                                <a class="btn btn-link transition" href="{{ route('password.request') }}">
                                    Olvidaste tu password?
                                </a>
                            @endif
                        </div>

                    </div>
                </form>

            </div>

        </div>

    </div>

</section>

@endsection
