<div class="modal fade" id="modal-exchangedDetail">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="bg-primary modal-header">
        <h4 class="modal-title">Detalle del Canje</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <div class="card">
          
            <div class="card-body">

              <div class="form-row m-0">
                <div class="col-8">
                  <label>Producto</label>
                </div>
                <div class="col-2">
                  <label>Cant.</label>
                </div>

                <div class="col-2">
                  <label>Puntos</label>
                </div>
              </div>

              <div v-for="row in exchangesDetail" :key="row.id" class="form-row mb-2">
                <div class="col-1">
                  <img class="img-fluid image_list" :src="showImage(row.product_id)" :alt="'producto monster miles ' +row.id">
                </div>
                <div class="form-group col-7">
                  <input disabled type="text" class="form-control" :value="getNameProduct(row.product_id)">
                </div>
                <div class="form-group col-2">
                  <input disabled type="text" class="form-control text-center" :value="row.quantity">
                </div>

                <div class="form-group col-2">
                  <input disabled type="text" class="form-control text-center" :value="row.price">
                </div>
              </div>

              <div class="form-row mb-2 mt-5">
                <div class="form-group col-8 d-flex justify-content-start align-items-center">
                  <p class="m-0">Totales</p>
                </div>
                <div class="form-group col-2">
                  <input disabled type="text" class="form-control text-center" :value="countItems">
                </div>

                <div class="form-group col-2">
                  <input disabled type="text" class="form-control text-center" :value="total">
                </div>
              </div>

            </div>
            <!-- /.card-body -->
            
        </div>
        <!-- /.card -->
      </div>

      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>