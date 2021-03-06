@extends('layouts.admin-layout')

@section('title', 'Sección de Usuarios')

@section('content')
  
  {{-- Modal User --}}
  @include('admin.partials.modal-user')

  <div class="row users">

    <div class="col-12 col-md-10 m-auto">

      <h1 class="mb-5 mt-3 text-center">Control de Usuarios</h1>

      <div class="d-flex justify-content-end mb-3">
        <button 
          type="button" 
          class="btn btn-primary" 
          data-toggle="modal" 
          data-target="#modal-user"
          @click="resetUserForm()" >
          AGREGAR USUARIO<i class="ml-2 fas fa-user-plus"></i>
        </button>
      </div>

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
                <th>Email</th>
                <th class="text-center">Tipo</th>
                <th class="text-center">Documento</th>
                <th class="text-center">Habilitado</th>
                <th class="text-center">Acciones</th>
              </tr>
            </thead>

            <paginate :key="filteredUsers.length" name="users" :list="filteredUsers" :per="15" tag="tbody">

              <tr v-for="user in paginated('users')" :key="user.id">
                <td><a @click="showFormUserEdit(user.id)" href="#" v-cloak>@{{user.lastname}}</a></td>
                <td v-cloak>@{{user.email}}</td>
                <td class="text-center" v-cloak>@{{ getRoleUser(user.role_id) }}</td>
                <td class="text-center" v-cloak>@{{ user.document }}</td>
                <td class="text-center" v-cloak>
                  <div v-if="user.role_id !=1" class="custom-control custom-switch">
                    <input 
                      type="checkbox" 
                      class="custom-control-input" 
                      :checked="user.confirmed"
                      :id="user.id"
                      @click="changeUserConfirmed(user.id, user.confirmed)"
                      >
                    <label class="custom-control-label" :for="user.id"></label>
                  </div>                  
                </td>
                <td class="content_btn_actions">
                  <button @click="showFormUserEdit(user.id)" type="button" class="btn btn-outline-warning btn-sm">Editar</button>
                  <button @click="deleteUser(user.id)" type="button" class="btn btn-outline-danger btn-sm">Eliminar</button>
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
  <script src="{{ asset('js/admin/admin-users.js') }}"></script>
@endsection