<section class="transition" id="cart">
	<button @click="toogleCart" type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
	<h3>Carrito</h3>

	<ul v-if="Object.keys(cart).length === 0">

    <li class="m-0 d-flex justify-content-center">
    	<div class="sin_items">
      	<p>No hay productos</p>
    	</div>
    </li>
    
  </ul>

  <ul v-else>

    <li v-for="(productCart, index) in cart" :key="productCart.id">

    	<div class="content_item">

    		<div class="datos">
    			<div>
	    			<p class="nombre_prod">@{{ productCart.name }}</p>
	    			<p class="price_prod">@{{ productCart.quantity }} X @{{ productCart.price }}</p>
    			</div>

    			<div class="quantity">
			      <button class="btnCartRemoveProduct btn btn-primary transition" @click="removeProduct(productCart)">-</button> 
			      <span>@{{ productCart.quantity }}</span> 
			      <button class="btnCartAddProduct btn btn-primary transition" @click="addProduct(productCart)">+</button>
	    		</div>

    		</div>

    		<div class="image h-100">
    			<img class="img-fluid" :src="showImage(productCart.image)" :alt="productCart.name">
    		</div>

    	</div>

    </li>
    
  </ul>

  <p v-if="alert != ''" class="alerta">@{{ this.alert }}</p>

  <!-- Total -->
  <div v-if="alert == ''" class="totales">
    <h6 v-if="total != 0" class="mb-2">Puntos totales a canjear: $ @{{ total }}</h6>
  </div>

  <button v-if="Object.keys(cart).length != 0" type="button" id="btn_finalizar_pedido" class="btn btn-primary transition" @click="showConfirmation()">Canjear</button>

</section>