@extends('layouts.admin-layout')

@section('title', 'Sección de Puntos Asignados')

@section('content')
  
  <div class="row users">

    <div class="col-12 col-md-10 m-auto">

      <h1 class="mb-5 mt-3 text-center">Visualizacion de Puntos Asignados</h1>

      <div class="card">
        <div class="card-header">

            <div class="form-group">
              <label>Buscador</label>
              <select id="selectSearchByUser" class="form-control select2 select2bs4" style="width: 100%;">
                <option data-id="0" selected="selected">Seleccionar Usuario</option>

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
                <th class="text-center">Cantidad Otorgada</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Hora</th>
                <th class="text-center">Responsable</th>
                <th class="text-center">Acción</th>
              </tr>
            </thead>

            <paginate :key="user_id" name="transactions" :list="transactions" :per="15" tag="tbody">

              <tr v-for="transaction in paginated('transactions')" :key="transaction.id">
                <td v-cloak>@{{ getNameUser(transaction.user_id) }}</td>
                <td class="text-center" v-cloak>@{{ transaction.quantity }}</td>
                <td class="text-center" v-cloak>@{{ getDateFormated(transaction.created_at) }}</td>
                <td class="text-center" v-cloak>@{{ getTimeFormated(transaction.created_at) }}</td>
                <td class="text-center" v-cloak>@{{ transaction.author }}</td>
                <td class="text-center">
                  <button @click="deleteTransaction(transaction.id)" type="button" class="btn btn-outline-danger btn-sm">Eliminar</button>
                </td>
              </tr>

            </paginate>

          </table>
          <div class="text-center">
            <paginate-links for="transactions" :limit="10" :show-step-links="true" :show-step-links="true" :classes="{'ul': 'pagination', 'li': 'page-item', 'a': 'page-link'}"></paginate-links>
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
  <script src="{{ asset('js/admin/admin-points-assigned.js') }}"></script>
@endsection