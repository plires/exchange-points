<div class="modal fade" id="modalProduct" tabindex="-1" aria-labelledby="modalProductLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <div class="content_modal">

          <div class="image">
            <img 
              src="{{ asset('img/user/productos/sin-stock.png') }}" 
              v-if="product_availability == 0" 
              class="sin_stock" 
              :alt=" 'sin stock ' + product_name">
            <img class="img-fluid" :src="showImage(product_image)" :alt="product_name">
          </div>

          <div class="data_product">
            
            <h2 v-cloak>@{{ product_name }}</h2>
            <h3><span v-cloak>@{{ product_price.toLocaleString('de-DE') }}</span> Monster Miles</h3>
            <p class="description" v-cloak>@{{ product_description }}</p>

            <div v-if="product_availability != 0" class="operations_product">
              <p class="titulo_operaciones">SELECCIONAR</p>
              <div class="content_btn">

                <div v-if="cart[product.name]">
                  <button id="btnRemove" @click="removeProduct(product)" class="btn btn-primary">
                    -
                  </button>
                  <span v-cloak>@{{ cart[product.name].quantity }}</span>
                </div>
                <button id="btnAdd" @click="addProduct(product)" class="btn btn-primary">
                  +
                </button>

              </div>
            </div>

            <div v-if="product_availability != 0" id="btnCanjeModal" class="canjear text-center">
              <button 
                v-if="Object.keys(cart).length != 0"
                type="button" id="btn_finalizar_pedido" 
                class="btn btn-primary transition" 
                data-toggle="modal" 
                data-target="#modalconfirmation"
                @click="hiddenModalProduct"
                ><i class="fas fa-shopping-cart"></i> Canjear
              </button>
            </div>

            <p class="alert_modal" v-cloak>@{{ alert }}</p>

          </div>


        </div>

      </div>
    </div>
  </div>
</div>