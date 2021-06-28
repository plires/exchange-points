@extends('layouts.user-layout')

@section('title', 'Canje de puntos')

@section('content')
  
  <section class="container">
	  <div class="row">
	    <div class="col-md-12 text-center">
	      <h1>@{{ title }}</h1>
	    </div>
	  </div>
  </section>

@endsection
<!-- /.row -->

@section('js')
  <script src="{{ asset('js/user/exchange.js') }}"></script>
@endsection