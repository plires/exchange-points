@extends('layouts.user-layout')

@section('title', 'wallpapers')

@section('content')

	<section class="catalogo catalogo_canje wallpapers">

		<!-- Nav -->
		@include('app.partials.nav')

		<!-- Cart -->
		@include('app.partials.cart')

		<!-- Header -->
		@include('app.partials.header')

		<!-- Modal User -->
		@include('app.partials.modal-user')

		<!-- Modal Confirmation -->
		@include('app.partials.modal-confirmation')

		<!-- Slide Superior -->
		@include('app.partials.slide-superior')

		<!-- Titulo -->
		<section class="container titulo_wallpaper">
		  <div class="row">
		    <div class="col-md-12">
		      <h1>WALLPAPERS</h1>
		    </div>
		  </div>
	  </section>
		<!-- Titulo end -->
		
		<!-- Wallpapers Desktop -->
		<section class="wallpaper_desktop container mt-5">

			<div class="row">
				<div class="col-12">
					<h2>Desktop</h2>
				</div>
			</div>

		  <div class="row">

		    <div class="col-md-6 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-desktop-1' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-desktop-1.jpg') }}" alt="wallpaper desktop 1">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-desktop-1' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-md-6 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-desktop-2' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-desktop-2.jpg') }}" alt="wallpaper desktop 2">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-desktop-2' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-md-6 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-desktop-3' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-desktop-3.jpg') }}" alt="wallpaper desktop 3">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-desktop-3' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-md-6 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-desktop-4' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-desktop-4.jpg') }}" alt="wallpaper desktop 4">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-desktop-4' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-md-6 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-desktop-5' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-desktop-5.jpg') }}" alt="wallpaper desktop 5">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-desktop-5' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-md-6 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-desktop-6' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-desktop-6.jpg') }}" alt="wallpaper desktop 6">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-desktop-6' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-md-6 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-desktop-7' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-desktop-7.jpg') }}" alt="wallpaper desktop 7">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-desktop-7' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-md-6 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-desktop-8' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-desktop-8.jpg') }}" alt="wallpaper desktop 8">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-desktop-8' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-md-6 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-desktop-9' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-desktop-9.jpg') }}" alt="wallpaper desktop 9">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-desktop-9' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-md-6 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-desktop-10' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-desktop-10.jpg') }}" alt="wallpaper desktop 10">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-desktop-10' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-md-6 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-desktop-11' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-desktop-11.jpg') }}" alt="wallpaper desktop 11">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-desktop-11' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-md-6 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-desktop-12' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-desktop-12.jpg') }}" alt="wallpaper desktop 12">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-desktop-12' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

			</div>
	  </section>
		<!-- Wallpapers Desktop end -->

		<!-- Wallpapers Mobile -->
		<section class="wallpaper_mobile container mt-5">

			<div class="row">
				<div class="col-12">
					<h2>Mobile</h2>
				</div>
			</div>

		  <div class="row">

		  	<div class="col-6 col-md-4 col-lg-3 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-mobile-1' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-mobile-1.jpg') }}" alt="wallpaper mobile 1">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-mobile-1' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-6 col-md-4 col-lg-3 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-mobile-2' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-mobile-2.jpg') }}" alt="wallpaper mobile 2">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-mobile-2' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-6 col-md-4 col-lg-3 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-mobile-3' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-mobile-3.jpg') }}" alt="wallpaper mobile 3">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-mobile-3' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-6 col-md-4 col-lg-3 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-mobile-4' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-mobile-4.jpg') }}" alt="wallpaper mobile 4">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-mobile-4' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-6 col-md-4 col-lg-3 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-mobile-5' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-mobile-5.jpg') }}" alt="wallpaper mobile 5">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-mobile-5' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-6 col-md-4 col-lg-3 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-mobile-6' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-mobile-6.jpg') }}" alt="wallpaper mobile 6">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-mobile-6' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-6 col-md-4 col-lg-3 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-mobile-7' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-mobile-7.jpg') }}" alt="wallpaper mobile 7">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-mobile-7' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-6 col-md-4 col-lg-3 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-mobile-8' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-mobile-8.jpg') }}" alt="wallpaper mobile 8">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-mobile-8' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-6 col-md-4 col-lg-3 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-mobile-9' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-mobile-9.jpg') }}" alt="wallpaper mobile 9">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-mobile-9' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-6 col-md-4 col-lg-3 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-mobile-10' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-mobile-10.jpg') }}" alt="wallpaper mobile 10">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-mobile-10' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-6 col-md-4 col-lg-3 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-mobile-11' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-mobile-11.jpg') }}" alt="wallpaper mobile 11">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-mobile-11' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-6 col-md-4 col-lg-3 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-mobile-12' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-mobile-12.jpg') }}" alt="wallpaper mobile 12">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-mobile-12' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-6 col-md-4 col-lg-3 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-mobile-13' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-mobile-13.jpg') }}" alt="wallpaper mobile 13">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-mobile-13' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-6 col-md-4 col-lg-3 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-mobile-14' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-mobile-14.jpg') }}" alt="wallpaper mobile 14">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-mobile-14' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		    <div class="col-6 col-md-4 col-lg-3 text-center">
		    	<a href="{{ '/download-wallpaper/wallpaper-mobile-15' }}" class="transition">
	    			<img class="img-fluid transition" src="{{ asset('img/user/wallpapers/wallpaper-mobile-15.jpg') }}" alt="wallpaper mobile 15">
	    		</a>
	    		<a href="{{ '/download-wallpaper/wallpaper-mobile-15' }}" class="btn btn-primary transition">Descargar</a>
		    </div>

		  </div>
	  </section>
		<!-- Wallpapers Mobile end -->

	</section>

@endsection
<!-- /.row -->

@section('js')
	<script src="{{ asset('js/moment.min.js') }}"></script>
  <script src="{{ asset('js/es.js') }}"></script>
  <script src="{{ asset('js/app/wallpaper.js') }}"></script>
@endsection