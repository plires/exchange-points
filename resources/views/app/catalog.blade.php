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
		      <h1>PRODUCTOS DESTACADOS</h1>
		    </div>
		  </div>
	  </section>
		<!-- Titulo end -->

		<!-- Galeria Destacados -->
		<section class="galeria_destacados container">
			<div class="responsive">

				<div 
				class="text-center content_destacados transition" 
				v-for="productFeatured in products_featured" 
				:key="productFeatured.id">

					<div @click="showModal(productFeatured.id)" class="shadow transition">
						<div class="content_image">
							<img 
	    					src="{{ asset('img/user/productos/sin-stock.png') }}" 
	    					v-if="productFeatured.availability == 0" 
	    					class="sin_stock" 
	    					:alt=" 'sin stock ' + productFeatured.name">
							<img class="img-fluid" :src="showImage(productFeatured.image)" :alt="productFeatured.id">
						</div>
						<div class="content_title">
							<h5 v-cloak>@{{ productFeatured.name }}</h5>
							<h6><span v-cloak>@{{ productFeatured.price.toLocaleString('de-DE') }}</span> Monster Miles</h6>
						</div>
					</div>
					
				</div>
					
			</div>
		</section>
		<!-- Galeria Destacados end -->
		
		<!-- Galeria Productos -->
		<section class="container">
		  <div class="row">
		    <div v-for="product in products" :key="product.id" class="col-12 col-sm-6 col-md-4 col-lg-3 text-center">

		    	<div @click="showModal(product.id)" class="content_product_catalogo transition">

		    		<div class="content_image_catalogo">
	    				<img 
	    					src="{{ asset('img/user/productos/sin-stock.png') }}" 
	    					v-if="product.availability == 0" 
	    					class="sin_stock" 
	    					:alt=" 'sin stock ' + product.name">
		      		<img class="img-fluid" :src="showImage(product.image)" :alt="product.name">
		    		</div>

		    		<div class="content_data_producto">
		    			<h4 v-cloak>@{{ product.name }}</h4>
		    			<h5><span v-cloak>@{{ product.price.toLocaleString('de-DE') }}</span> Monster Miles</h5>
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