<li>
  <div class="cart">
  	<div>
  		<i @click="toogleCart" id="menu_cart" class="transition fas fa-shopping-cart"></i>
  		<p class="totales_cart_menu" v-if="count_items_cart != 0">(@{{ count_items_cart }})</p>
  	</div>
  	<p id="points_cart">@{{ total }}</p>
  </div>		    			
</li>