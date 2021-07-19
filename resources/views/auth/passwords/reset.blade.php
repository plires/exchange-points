@extends('layouts.user-layout')

@section('content')
<div class="container login">
    <div class="row">

        <div class="col-md-12 text-center">
            <img class="img-fluid logo" src="{{ asset('/img/login/logo-principal.png') }}" alt="logo monster">
        </div>

        <div class="col-sm-12 col-md-8 col-lg-6 formulario">
            <h1>Nueva contraseña</h1>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group row">

                        <div class="col-md-12">
                            <input id="email" type="email" placeholder="Tu email registrado" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-md-12">
                            <input id="password" type="password" placeholder="nueva contraseña" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-md-12">
                            <input id="password-confirm" type="password" placeholder="repetí la contraseña" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">
                                Cambiar contraseña
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
