<!DOCTYPE html>

@if(isset($current))
  <html class="{{ $current }}" lang="{{ app()->getLocale() }}">
@else
  <html lang="{{ app()->getLocale() }}">
@endif

<head>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }} | @yield('title')</title>

  @yield('css')

  <!-- Css -->
  <link rel="stylesheet" href="{{ asset('css/app/app.css') }}">

</head>
<body>
  <div id="app">

    <!-- Spinner -->
    @include('admin.partials.spinner')

    @yield('content')
      
  </div>
    
<!-- js -->

{{-- <script src="js/user/app.js" defer></script> --}}

@yield('js')
</body>
</html>
