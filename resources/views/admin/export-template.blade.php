@extends('layouts.admin-layout')

@section('title', 'Exportación de Plantilla')

@section('content')
  
  <div class="row points">

    <div class="col-12 col-md-6 m-auto">

      <h1 class="mb-5 mt-3 text-center">Exportación de Plantilla</h1>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Exportar</h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body card-primary card-outline table-responsive">

          <div class="callout callout-danger">
            <h5>Leer!</h5>

            <p>
              Desde este sector podrás descargar una plantilla master en excel para subir posteriormente y modificar puntos de usuarios de manera masiva.
              Las columnas descargadas deben permanecer intactas y sólo podrá editarse la última coluna (puntos)
            </p>
          </div>


          <div class="text-center">
            <a href="{{ route('admin.export-template') }}" target="_blank" type="button" class="mt-5 btn btn-primary">
              <i class="fas fa-file-excel"></i>
              <i class="fas fa-arrow-down mr-2"></i>DESCARGAR EXCEL TEMPLATE
            </a>
          </div>

        </div>
        <!-- /.card-body -->

      </div>
      <!-- /.card -->
    </div>
  </div>

@endsection
<!-- /.row -->

@section('js')
  <script src="{{ asset('js/admin/export-template-excel.js') }}"></script>
@endsection