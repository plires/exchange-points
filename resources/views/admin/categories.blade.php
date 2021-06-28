@extends('layouts.admin-layout')

@section('title', 'Sección de Categorías')

@section('content')
  
  {{-- Modal Categories --}}
  @include('admin.partials.modal-categories')

  <div class="row categories">

    <div class="col-10 m-auto">

      <h1 class="mb-5 mt-3 text-center">Listado de Categorías</h1>

      <div class="d-flex justify-content-end mb-3">
        <button 
          type="button" 
          class="btn btn-primary" 
          data-toggle="modal" 
          data-target="#modal-category"
          @click="resetCategoryForm()" >
          AGREGAR CATEGORÍA<i class="ml-2 fas fa-user-plus"></i>
        </button>
      </div>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Categorías</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input v-model="nameCategory" type="text" name="table_search" class="form-control float-right" placeholder="Search">

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
                <th>Nombre</th>
                <th class="text-right">Acciones</th>
              </tr>
            </thead>

            <paginate :key="nameCategory" name="categories" :list="filteredCategories" :per="15" tag="tbody">

              <tr v-for="category in paginated('categories')" :key="category.id">
                <td>
                  <a data-toggle="modal" data-target="#modal-category" @click="showFormCategoryEdit(category.id)" href="#">@{{category.name}}
                  </a>
                </td>
                <td class="d-flex justify-content-end content_btn_actions">
                  <button @click="showModalProducts(category.id)" type="button" class="btn btn-outline-success btn-sm">Ver Productos</button>
                  <button @click="showFormCategoryEdit(category.id)" type="button" class="btn btn-outline-warning btn-sm">Editar</button>
                  <button @click="deleteCategory(category.id)" type="button" class="btn btn-outline-danger btn-sm">Eliminar</button>
                </td>
              </tr>

            </paginate>

          </table>
          <div class="text-center">
            <paginate-links for="categories" :show-step-links="true" :classes="{'ul': 'pagination', 'li': 'page-item', 'a': 'page-link'}"></paginate-links>
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
  <script src="{{ asset('js/admin/admin-categories.js') }}"></script>
@endsection