@extends('layouts.admin-layout')

@section('title', 'Sección de Productos')

@section('content')
  
  {{-- Modal Product --}}
  @include('admin.partials.modal-product')

  <div class="row products">

    <div class="col-12 col-md-10 m-auto">

      <h1 class="mb-5 mt-3 text-center">Control de Productos</h1>

      <div class="d-flex justify-content-end mb-3">
        <button 
          type="button" 
          class="btn btn-primary" 
          data-toggle="modal" 
          data-target="#modal-product"
          @click="resetProductForm()" >
          AGREGAR PRODUCTO<i class="ml-2 fas fa-user-plus"></i>
        </button>
      </div>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Productos</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input v-model="nameProduct" type="text" name="table_search" class="form-control float-right" placeholder="Search">

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
                <th>SKU</th>
                <th>Nombre</th>
                <th class="text-center">Precio</th>
                <th class="text-center">Stock</th>
                <th class="text-center">Categoría</th>
                <th class="text-center">imagen</th>
                <th class="text-center">Acciones</th>
              </tr>
            </thead>

            <paginate :key="nameProduct" name="products" :list="filteredProducts" :per="15" tag="tbody">

              <tr v-for="product in paginated('products')" :key="product.id">
                <td v-cloak>@{{product.sku}}</td>
                <td><a @click="showFormEdit(product.id)" href="#" v-cloak>@{{product.name}}</a></td>
                <td class="text-center" v-cloak>@{{product.price}}</td>
                <td class="text-center" v-cloak>@{{product.availability}}</td>
                <td class="text-center" v-cloak>@{{ getCategoryProduct(product.category_id) }}</td>
                <td class="text-center">
                  <img :src="showImage(product.image)" :alt="product.name" width="50">
                </td>
                <td class="content_btn_actions">
                  <button @click="showFormEdit(product.id)" type="button" class="btn btn-outline-warning btn-sm">Editar</button>
                  <button @click="deleteProduct(product.id)" type="button" class="btn btn-outline-danger btn-sm">Eliminar</button>
                </td>
              </tr>

            </paginate>

          </table>
          <div class="text-center">
            <paginate-links for="products" :show-step-links="true" :classes="{'ul': 'pagination', 'li': 'page-item', 'a': 'page-link'}"></paginate-links>
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
<script src="{{ asset('js/admin/admin-products.js') }}"></script>
@endsection