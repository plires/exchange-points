<div class="modal fade" id="modal-points">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="bg-warning modal-header">
        <h4 class="modal-title">Modificación de puntos</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Errores -->
      @include('admin.partials.errors')

      <form id="pointsForm" class="needs-validation" novalidate>
        @csrf
        <div class="modal-body">
          <!-- general form elements -->
          <div class="card">
            
            <!-- /.card-header -->
            <!-- form start -->
              <div class="card-body">

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="name">Nombre *</label>
                    <input disabled type="text" class="form-control" id="name" id="name" v-model="formPoints.name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="email">Email *</label>
                    <input disabled type="text" class="form-control" id="email" id="email" v-model="formPoints.email">
                  </div>                  
                </div>

                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="points_old">Puntos Actuales</label>
                    <input disabled type="text" class="form-control" id="points_old" name="points_old" v-model="formPoints.points_old">
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="points">Sumar o Restar Puntos *</label>
                    <input required type="number" pattern="^[0-9]+" class="form-control" id="points" id="points" placeholder="números enteros negativos o positivos" v-model="formPoints.points">
                    <div class="invalid-feedback">
                      Ingresá un nombre.
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
          <button type="button" type="submit" @click.prevent="sendPoints" name="send" class="btn btn-warning">Guardar Puntos</button>
        </div>
      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>