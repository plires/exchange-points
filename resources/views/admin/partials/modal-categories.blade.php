<div class="modal fade" id="modal-category">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div :class="[modeCategoryEdit ? 'bg-warning' : 'bg-primary', 'modal-header']">
        <h4 class="modal-title">@{{ titleFormCategory }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Errores -->
      @include('admin.partials.errors')

      <form id="categoryForm" class="needs-validation" novalidate>
        @csrf
        <div class="modal-body">
          <!-- general form elements -->
          <div class="card">
            
            <!-- /.card-header -->
            <!-- form start -->
              <div class="card-body">

                <div class="form-group col-md-12">
                  <label for="name">Nombre Categoría *</label>
                  <input required type="text" class="form-control" id="name" id="name" placeholder="Nombre (*)" v-model="formCategories.name">
                </div>

                <div class="form-group col-md-12">
                  <label for="description">Descripción</label>
                  <textarea class="form-control" rows="3" name="description" id="description" placeholder="Ingrese descripción del producto (opcional)" v-model="formCategories.description"></textarea>
                </div>

              </div>
              <!-- /.card-body -->
              
          </div>
          <!-- /.card -->
        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button v-if="!modeCategoryEdit" type="button" type="submit" @click.prevent="sendCategory" name="send" class="btn btn-primary">Agregar</button>
          <button v-else type="button" type="submit" @click.prevent="sendCategory" name="send" class="btn btn-warning">Guardar Cambios</button>
        </div>
      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>