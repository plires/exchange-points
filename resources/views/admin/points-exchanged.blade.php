@extends('layouts.admin-layout')

@section('title', 'Sección de Puntos Canjeados')

@section('content')

  {{-- Modal Exchanged --}}
  @include('admin.partials.modal-exchanged')
  @include('admin.partials.modal-exchangedDetails')
  
  <div class="row exchanged">

    <div class="col-12 col-md-10 m-auto">

      <h1 class="mb-5 mt-3 text-center">Visualizacion de Puntos Canjeados</h1>

      <div class="d-flex justify-content-end mb-3">
        <button 
          type="button" 
          class="btn btn-primary" 
          data-toggle="modal" 
          data-target="#modal-exchanged"
          @click="resetExchangeForm()" >
          AGREGAR CANJE MANUALMENTE<i class="ml-2 fas fa-user-plus"></i>
        </button>
      </div>

      <div class="card">
        <div class="card-header">
            <div class="form-group">
              <label>Buscador</label>
              <select id="selectSearchByUser" class="form-control select2 select2bs4" style="width: 100%;">
                <option></option>

                <option 
                  :data-id = user.id
                  v-for="user in users" 
                  :key = "user.id"
                  v-cloak>
                  @{{ user.lastname }}
                </option>

              </select>
            </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body card-primary card-outline table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>Apellido</th>
                <th class="text-center">Documento</th>
                <th class="text-center">Puntos Canjeados</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Hora</th>
                <th class="text-center">Acción</th>
              </tr>
            </thead>

            <paginate :key="user_id" name="exchanges" :list="exchanges" :per="15" tag="tbody">

              <tr v-for="exchange in paginated('exchanges')" :key="exchange.id">
                <td v-cloak v-cloak>@{{ getNameUser(exchange.user_id) }}</td>
                <td class="text-center" v-cloak>@{{ getDocumentUser(exchange.user_id) }}</td>
                <td class="text-center" v-cloak>@{{ exchange.points_quantity }}</td>
                <td class="text-center" v-cloak>@{{ getDateFormated(exchange.created_at) }}</td>
                <td class="text-center" v-cloak>@{{ getTimeFormated(exchange.created_at) }}</td>
                <td class="text-center">
                  <button 
                  type="button" 
                  data-toggle="modal" 
                  data-target="#modal-exchangedDetail"
                  @click="viewDetailExchange(exchange.id)"
                  class="btn btn-outline-success btn-sm">Ver
                  </button>
                  <button 
                  @click="deleteExchange(exchange.id)" 
                  type="button" 
                  class="btn btn-outline-danger btn-sm">Eliminar
                  </button>
                </td>
              </tr>

            </paginate>

          </table>
          <div class="text-center">
            <paginate-links for="exchanges" :limit="10" :show-step-links="true" :show-step-links="true" :classes="{'ul': 'pagination', 'li': 'page-item', 'a': 'page-link'}"></paginate-links>
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
  <script src="{{ asset('js/admin/admin-points-exchanged.js') }}"></script>
@endsection