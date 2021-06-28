<div class="modal fade" id="modal-exchanged">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="bg-warning modal-header">
        <h4 class="modal-title">Agregar Canje Manualmente</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Errores -->
      @include('admin.partials.errors')

      <form id="exchangedForm" class="needs-validation" novalidate>
        @csrf
        <div class="modal-body">
          <!-- general form elements -->
          <div class="card">
            
            <!-- /.card-header -->
            <!-- form start -->
              <div class="card-body">

                <div class="form-row mb-5">
                  <div class="form-group col-md-8">
                    <label>Usuario</label>
                    <select id="selectSearchByNewUser" class="form-control select2 select2bs4" style="width: 100%;">
                      <option></option>

                      <option 
                        v-for="userNew in usersNews" 
                        :data-id = userNew.id
                        :key = "userNew.id">
                        @{{ userNew.name }}
                      </option>

                    </select>
                  </div>

                  <div class="form-group col-md-4">
                    <label for="points">Puntos</label>
                    <input disabled type="text" class="form-control" name="points" id="points" v-model="userObject.points">
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-12">
                    <select id="selectSearchByProduct" class="form-control select2 select2bs4" style="width: 100%;">
                      <option></option>

                      <option 
                        v-for="product in products" 
                        :data-id = product.id
                        :key = "product.id">
                        @{{ product.name }}
                      </option>

                    </select>
                  </div>

                </div>

                <div class="form-row">

                  <ul class="p-0 w-100">

                    <li v-for="product in productsCart" :key="product.id" class="m-0 d-flex justify-content-center">

                      <div class="form-group col-md-8">
                        <input disabled type="text" class="form-control" :value="product.name">
                      </div>
                      
                      <div class="form-group col-md-2">
                        <input disabled type="text" class="form-control" :value="product.price">
                      </div>

                      <div class="form-group col-md-2 d-flex justify-content-end align-items-center">
                        <button @click="removeProduct(product)" type="button" class="btn btn-danger btn-sm">-</button>
                        <span class="badge badge-primary product_name_cart"> 
                          <span class="badge badge-success product_quantity_cart">@{{ product.quantity }}</span> 
                        </span>
                        <button @click="addProduct(product.id)" type="button" class="btn btn-success btn-sm">+</button>
                      </div>
                    </li>
                    
                  </ul>

                  <div class="w-100 d-flex justify-content-end">
                    <p>Total del Canje: $ @{{ subtotal }}</p>
                  </div>

                </div>

              </div>
              <!-- /.card-body -->
              
          </div>
          <!-- /.card -->
        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" type="submit" @click.prevent="sendExchanged" name="send" class="btn btn-warning">Guardar Canje</button>
        </div>
      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>