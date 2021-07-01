@extends('layouts.user-layout')

@section('content')

<section class="login">

    <div class="container">
        
        <div class="row">

            <div class="col-md-12 text-center">
                <img class="img-fluid logo" src="{{ asset('/img/login/logo-monster.png') }}" alt="logo monster">
            </div>


            <div class="col-sm-12 col-md-8 col-lg-6 formulario">
                <h1>LOGIN</h1>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group row">

                        <div class="col-md-12">
                            <input class="form-control @error('email') is-invalid @enderror" 
                                id="email" 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                placeholder="Email" 
                                required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <input class="form-control @error('password') is-invalid @enderror"
                                id="password" 
                                type="password" 
                                placeholder="Password" 
                                name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" 
                                    type="checkbox" 
                                    name="remember" 
                                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    Recordarme
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary transition">
                                Ingresar
                            </button>
                        </div>

                        <div class="col-md-12 text-center">
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

</loginn>

@endsection



