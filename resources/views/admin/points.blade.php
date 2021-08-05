@extends('layouts.admin-layout')

@section('title', 'Sección de Puntos de Usuarios')

@section('content')
  
  {{-- Modal User --}}
  @include('admin.partials.modal-points')

  <div class="row points">

    <div class="col-12 col-md-10 m-auto">

      <h1 class="mb-5 mt-3 text-center">Puntos de Usuarios</h1>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Usuarios</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input v-model="lastNameUser" type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body card-primary card-outline table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>Apellido</th>
                <th class="text-center">Documento</th>
                <th class="text-center">Puntos</th>
                <th class="text-right">Acciones</th>
              </tr>
            </thead>

            <paginate :key="lastNameUser" name="users" :list="filteredUsers" :per="15" tag="tbody">

              <tr v-for="user in paginated('users')" :key="user.id">
                <td>

                  <a v-if="user.role_id !=1"
                    data-toggle="modal" 
                    data-target="#modal-points" 
                    @click="fillInputsformPoints(user.id)" 
                    href="#" 
                    v-cloak>@{{user.lastname}}
                  </a>

                  <span v-else
                    v-cloak>@{{user.lastname}}
                  </span>
                </td>
                <td class="text-center" v-cloak>@{{ user.document }}</td>
                <td class="text-center" v-cloak>@{{ user.points }}</td>
                <td class="content_btn_actions">
                  <button v-if="user.role_id !=1" data-toggle="modal" data-target="#modal-points" @click="fillInputsformPoints(user.id)" type="button" class="btn btn-outline-warning btn-sm">Agregar / Quitar Puntos</button>
                </td>
              </tr>

            </paginate>

          </table>
          <div class="text-center">
            <paginate-links for="users" :show-step-links="true" :classes="{'ul': 'pagination', 'li': 'page-item', 'a': 'page-link'}"></paginate-links>
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
  <script src="{{ asset('js/moment.min.js') }}"></script>
  <script src="{{ asset('js/es.js') }}"></script>
  <script src="{{ asset('js/admin/admin-points.js') }}"></script>
@endsection