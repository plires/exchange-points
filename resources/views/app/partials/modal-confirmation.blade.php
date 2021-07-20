<div class="modal fade" id="modalconfirmation" tabindex="-1" aria-labelledby="modalconfirmationLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">

      <div class="modal-body">

        <div class="col-md-12">
          <div class="product_confirmation">

            <div class="table-responsive">
              <table class="table table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th>Producto</th>
                    <th class="text-left">Nombre</th>
                    <th>Monster Miles</th>
                    <th>Cantidad</th>
                  </tr>
                </thead>
                <tbody>

                  <tr v-for="(productConfirmation, index) in cart" :key="productConfirmation.id">
                    <td>
                      <img class="img-fluid" :src="showImage(productConfirmation.image)" :alt="productConfirmation.name">
                    </td>
                    <td v-cloak class="text-left">@{{ productConfirmation.name }}</td>
                    <td v-cloak>@{{ productConfirmation.price.toLocaleString('de-DE') }}</td>
                    <td v-cloak>@{{ productConfirmation.quantity }}</td>
                  </tr>

                  <tr class="totales">
                    <td>TOTALES</td>
                    <td>&nbsp;</td>
                    <td v-cloak>@{{ total }}</td>
                    <td v-cloak>@{{ count_items_cart }}</td>
                  </tr>

                </tbody>
              </table>
            </div>

          </div>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button @click="confirmation()" type="button" class="btn btn-primary">Confirmar</button>
      </div>

    </div>
  </div>
</div>