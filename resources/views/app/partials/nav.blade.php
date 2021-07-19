<nav id="navigation" class="transition">
	<ul>
		<li>
			<a class="transition" href="./">
				<i class="far fa-list-alt mr-2"></i>Catálogo</a>
		</li>
		<li>
			<a class="transition" 
			  href="{{ route('logout') }}" 
			  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
			  title="Salir"><i class="fas fa-sign-out-alt mr-2"></i>Salir
			</a>
		</li>
	</ul>
</nav>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>


