<div class="modal fade" id="modalProduct" tabindex="-1" aria-labelledby="modalProductLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <div class="content_modal">

          <div class="image">
            <img class="img-fluid" :src="showImage(product_image)" :alt="product_name">
          </div>

          <div class="data_product">
            
            <h2>@{{ product_name }}</h2>
            <h3><span>@{{ product_price.toLocaleString('de-DE') }}</span> Monster Miles</h3>
            <p class="description">@{{ product_description }}</p>

            <div class="operations_product">
              <p class="titulo_operaciones">SELECCIONAR</p>
              <div class="content_btn">

                <div v-if="cart[product.name]">
                  <button id="btnRemove" @click="removeProduct(product)" class="btn btn-primary">
                    <i class="fas fa-cart-arrow-down"></i>
                  </button>
                  <span>@{{ cart[product.name].quantity }}</span>
                </div>
                <button id="btnAdd" @click="addProduct(product)" class="btn btn-primary">
                  <i class="fas fa-cart-plus"></i>
                </button>

              </div>
            </div>

            <p class="alert_modal">@{{ alert }}</p>

          </div>


        </div>

      </div>
    </div>
  </div>
</div>