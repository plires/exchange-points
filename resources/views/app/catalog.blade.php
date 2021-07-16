@extends('layouts.user-layout')

@section('title', 'Canje de puntos')

@section('content')

	<section class="catalogo catalogo_canje">

		<!-- Nav -->
		@include('app.partials.nav')

		<!-- Cart -->
		@include('app.partials.cart')

		<!-- Header -->
		@include('app.partials.header')

		<!-- Modal Product -->
		@include('app.partials.modal-product')

		<!-- Slide Superior -->
		<section class="slide_superior container-fluid primer_contenido">
			<div class="row">
				<div class="col-md-12 p-0">
					<img id="slide_1" src="#" class="d-block w-100" alt="slide 1">
				</div>
			</div>
		</section>
		<!-- Slide Superior end -->
		
		<!-- Galeria Productos -->
		<section class="container">
		  <div class="row">
		    <div v-for="product in products" :key="product.id" class="col-12 col-sm-6 col-md-4 col-lg-3 text-center">

		    	<div @click="showModal(product.id)" class="content_product_catalogo transition">

		    		<div class="content_image_catalogo">
		      		<img class="img-fluid" :src="showImage(product.image)" :alt="product.name">
		    		</div>

		    		<div class="content_data_producto">
		    			<h4>@{{ product.name }}</h4>
		    			<h5><span>@{{ product.price.toLocaleString('de-DE') }}</span> Monster Miles</h5>
		    		</div>

		    	</div>

		    </div>
		  </div>
	  </section>
		<!-- Galeria Productos end -->

	</section>

@endsection
<!-- /.row -->

@section('js')
  <script src="{{ asset('js/app/catalog.js') }}"></script>
@endsection