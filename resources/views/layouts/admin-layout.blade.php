<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">
<head>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }} | @yield('title')</title>

  @yield('css')

  <!-- Css -->
  <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">

</head>
<body class="hold-transition sidebar-mini">
  <div id="app" class="wrapper">

    <!-- Spinner -->
    @include('admin.partials.spinner')

    <!-- Navbar -->
    @include('admin.partials.nav')
    <!-- Navbar end -->

    <!-- Main Sidebar Container -->
    @include('admin.partials.aside')
    <!-- Main Sidebar Container end -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      {{-- @include('admin.partials.page-header') --}}
      <!-- Content Header (Page header) end -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">

          @yield('content')
          
        </div>
      </div>
      <!-- Main content end -->
      
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar Right -->
    @include('admin.partials.aside-right')
    <!-- Control Sidebar Right end -->

    <!-- Main Footer -->
    @include('admin.partials.footer')
    <!-- Main Footer end -->
    
  </div>
  <!-- ./wrapper -->

<!-- js -->
@yield('js')
</body>
</html>
