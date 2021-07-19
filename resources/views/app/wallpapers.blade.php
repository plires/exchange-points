@extends('layouts.user-layout')

@section('title', 'wallpapers')

@section('content')

	<section class="catalogo catalogo_canje wallpapers">

		<!-- Nav -->
		@include('app.partials.nav')

		<!-- Cart -->
		{{-- @include('app.partials.cart') --}}

		<!-- Header -->
		@include('app.partials.header')

		<!-- Slide Superior -->
		<section class="slide_superior container-fluid primer_contenido">
			<div class="row">
				<div class="col-md-12 p-0">

					<div id="slide_destacados" class="carousel slide" data-ride="carousel">
					  <ol class="carousel-indicators">
					    <li data-target="#slide_destacados" data-slide-to="0" class="active"></li>
					    <li data-target="#slide_destacados" data-slide-to="1"></li>
					    <li data-target="#slide_destacados" data-slide-to="2"></li>
					  </ol>
					  <div class="carousel-inner">
					    <div class="carousel-item active">
					      <img id="slide_1" src="#" class="d-block w-100" alt="slide 1">
					    </div>
					    <div class="carousel-item">
					      <img id="slide_2" src="#" class="d-block w-100" alt="slide 2">
					    </div>
					    <div class="carousel-item">
					      <img id="slide_3" src="#" class="d-block w-100" alt="slide 3">
					    </div>
					  </div>
					  <a class="carousel-control-prev" href="#slide_destacados" role="button" data-slide="prev">
					    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					  </a>
					  <a class="carousel-control-next" href="#slide_destacados" role="button" data-slide="next">
					    <span class="carousel-control-next-icon" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					  </a>
					</div>

				</div>
			</div>
		</section>
		<!-- Slide Superior end -->

		<!-- Titulo -->
		<section class="container">
		  <div class="row">
		    <div class="col-md-12">
		      <h1>WALLPAPERS</h1>
		    </div>
		  </div>
	  </section>
		<!-- Titulo end -->
		
		<!-- Wallpapers -->
		<section class="container">
		  <div class="row">
		    <div class="col-12">

		    	Lorem ipsum dolor sit, amet consectetur adipisicing elit. Odit voluptate, vitae dolor sint suscipit amet, aspernatur nam architecto cum sunt, molestiae! Quas et minus, ullam, accusantium exercitationem cumque nemo pariatur.

		    </div>
		  </div>
	  </section>
		<!-- Wallpapers end -->

	</section>

@endsection
<!-- /.row -->

@section('js')
  <script src="{{ asset('js/app/catalog.js') }}"></script>
@endsection