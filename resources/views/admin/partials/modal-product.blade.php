<div class="modal fade" id="modal-product">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div :class="[modeProductEdit ? 'bg-warning' : 'bg-primary', 'modal-header']">
        <h4 class="modal-title">@{{ titleFormProduct }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Errores -->
      @include('admin.partials.errors')

      <form id="productForm" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        <div class="modal-body">
          <!-- general form elements -->
          <div class="card">
            
            <!-- /.card-header -->
            <!-- form start -->
              <div class="card-body">

                <div class="form-row">
                  <div class="form-group text-center col-md-12">
                    <img id="image_content" src="{{ asset('img/no-image.gif') }}" width="200" alt="imagen producto" class="img-fluid">
                  </div>

                  <div class="input-group col-md-12 mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroupFileAddon01">Subir</span>
                    </div>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="image" id="image" aria-describedby="inputGroupFileAddon01">
                      <label class="custom-file-label" for="image">Seleccionar Imágen</label>
                    </div>
                  </div>
                  
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="name">SKU *</label>
                    <input required type="text" class="form-control" name="sku" id="sku" placeholder="SKU (*)" v-model="formProduct.sku">
                  </div>

                  <div class="form-group col-md-6">
                    <label for="name">Nombre *</label>
                    <input required type="text" class="form-control" name="name" id="name" placeholder="Nombre (*)" v-model="formProduct.name">
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="description">Descripción</label>
                    <textarea class="form-control" rows="3" name="description" id="description" placeholder="Ingrese descripción del producto (opcional)" v-model="formProduct.description"></textarea>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="price">Precio *</label>
                    <input required type="number" class="form-control" name="price" id="price" placeholder="Precio (*)" v-model="formProduct.price" min="1" pattern="^[0-9]+">
                  </div>

                  <div class="form-group col-md-6">
                    <label for="availability">Stock *</label>
                    <input required type="number" class="form-control" name="availability" id="availability" placeholder="Stock (*)" v-model="formProduct.availability" min="1" pattern="^[0-9]+">
                  </div>
                </div>

                <div class="form-group">
                  <label for="category_id">Categoría *</label>
                  <select required class="custom-select form-control-border" id="category_id" name="category_id" v-model="formProduct.category_id">
                    <option value="0">Seleccionar Categoría</option>
                    <option 
                      v-for="category in categories" 
                      :key="category.id" 
                      :value="category.id">
                        @{{ category.name }}
                    </option>
                  </select>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" v-model="formProduct.is_active">
                      <label class="form-check-label" for="is_active">
                        Tildar para habilitar este producto
                      </label>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="0" name="featured" id="featured" v-model="formProduct.featured">
                      <label class="form-check-label" for="featured">
                        Tildar para destacar este producto
                      </label>
                    </div>
                  </div>
                </div>
                
              </div>
              <!-- /.card-body -->
              
          </div>
          <!-- /.card -->
        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button v-if="!modeProductEdit" type="button" type="submit" @click.prevent="sendProduct" name="send" class="btn btn-primary">Agregar</button>
          <button v-else type="button" type="submit" @click.prevent="sendProduct" name="send" class="btn btn-warning">Guardar Cambios</button>
        </div>
      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>