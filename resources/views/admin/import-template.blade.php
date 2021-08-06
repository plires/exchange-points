@extends('layouts.admin-layout')

@section('title', 'Importación de Plantilla')

@section('content')
  
  <div class="row points">

    <div class="col-12 col-md-6 m-auto">

      <h1 class="mb-5 mt-3 text-center">Importación de Plantilla</h1>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Importar</h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body card-primary card-outline table-responsive">

          <!-- Errores -->
          @include('admin.partials.errors')

          <form id="importForm" enctype="multipart/form-data" class="needs-validation" novalidate>
          @csrf
            <!-- general form elements -->
            <div class="card">
              
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">

                  <div class="form-row">

                    <div class="input-group col-md-12 mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Subir</span>
                      </div>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file-template" id="file-template" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="file-template">Seleccionar Plantilla Excel</label>
                      </div>
                    </div>
                    
                  </div>

                </div>
                <!-- /.card-body -->
                
            </div>
            <!-- /.card -->

            <div class="d-flex justify-content-end">
              <button id="btn_upload_excel" type="button" type="submit" @click.prevent="uploadTemplate" name="send" class="btn btn-primary">Subir Excel</button>
            </div>

          </form>          

        </div>
        <!-- /.card-body -->

      </div>
      <!-- /.card -->
    </div>
  </div>

@endsection
<!-- /.row -->

@section('js')
  <script src="{{ asset('js/admin/import-template-excel.js') }}"></script>
@endsection