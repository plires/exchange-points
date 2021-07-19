@extends('layouts.user-layout')

@section('title', 'Gracias por registrarse')

@section('content')

	<section class="login registro_pendiente">

		<!-- Galeria Productos -->
		<section class="container">
		  <div class="row content">

		  	<div class="col-md-12 text-center">
            <img class="img-fluid logo" src="{{ asset('/img/login/logo-principal.png') }}" alt="logo monster">
        </div>

		  	<div class="col-md-12">
		  		<h1>Registro pendiente de aprobación</h1>
		  		<p>Muchas gracias por registrarse en la plataforma Monster Miles. Tu proceso de registro ya esta en curso.</p>

		  		<p>Recibirás una notificación cuando el administrador verifique y apruebe tu solicitud.</p>

		  		<p>Mientras tanto, te invitamos a seguir navegando en nuestro <a target="_blank" rel="noopener noreferrer" class="transition" href="https://www.monsterenergy.com/">sitio</a></p>
		  	</div>
		    
		  </div>
	  </section>
		<!-- Galeria Productos end -->

	</section>

@endsection
<!-- /.row -->