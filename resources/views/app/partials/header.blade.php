<header class="container-fluid">
	<div class="container h-100">
	  <div class="row h-100">
	    <div class="col-md-12 h-100">

	    	<i @click="toogleNav" id="menu_hamburguesa" class="transition fas fa-bars"></i>

	    	<ul>

    			<li>
			      <div class="user mr-3">
			      	<div class="text-right">
			      		<p v-cloak>@{{ authUser.name }}</p>
			      		<p class="puntos" v-cloak>Puntos: @{{ authUser.points }}</p>
			      	</div>
			      	<i @click="toogleMenuUser" id="menu_user" class="transition fas fa-chevron-down"></i>
			      </div>

			      <div class="transition" id="edit_user">
			      	<ul>
			      		<li>
			      			<a @click="showFormUserEdit(authUser.id)" class="transition" href="#">Editar mis datos</a>
			      			<i class="fas fa-user-edit transition"></i>
			      		</li>
			      	</ul>
			      </div>

	    		</li>

	    		@if(Request::path() == '/')
					  <!-- Cart Menu -->
    				@include('app.partials.cart-menu')
					@endif

	    	</ul>
	    </div>
	  </div>
	</div>
</header>