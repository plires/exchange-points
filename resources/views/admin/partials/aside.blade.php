<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{ asset('img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Monster Miles</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex flex-column justify-content-center">

      <div class="d-flex justify-content-cener">
        <div class="image">
          <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">@{{ authUser.name }}</a>
        </div>
      </div>

      <a class="mt-3" 
        href="{{ route('logout') }}" 
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
      </a>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
    </form>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        {{-- Usuarios --}}
        <li class="nav-item">
          <a href="{{ route('admin.users.index') }}" class="nav-link">
            <i class="fas fa-user-friends mr-1"></i>
            USUARIOS
          </a>
        </li>
        {{-- Usuarios end --}}

        {{-- Puntos --}}
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-user-friends mr-1"></i>
            PUNTOS
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="{{ route('admin.points.index') }}" class="nav-link">
                <i class="fas fa-users-cog"></i>
                <p>Visualización</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.show-export-template') }}" class="nav-link">
                <i class="fas fa-users-cog"></i>
                <p>Exportación Masiva</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.show-import-template') }}" class="nav-link">
                <i class="fas fa-users-cog"></i>
                <p>Importacion Masiva</p>
              </a>
            </li>
          </ul>
        </li>
        {{-- Puntos end --}}

        {{-- Visualizacion de Canjes --}}
        <li class="nav-item">
          <a href="{{ route('admin.points-exchanged.index') }}" class="nav-link">
            <i class="fas fa-user-friends mr-1"></i>
            CANJES REALIZADOS
          </a>
        </li>
        {{-- Visualizacion de Canjes --}}

        {{-- Puntos Asignados --}}
        <li class="nav-item">
          <a href="{{ route('admin.points-assigned.index') }}" class="nav-link">
            <i class="fas fa-user-friends mr-1"></i>
            PUNTOS ASIGNADOS
          </a>
        </li>
        {{-- Puntos Asignados --}}

        {{-- Productos --}}
        <li class="nav-item">
          <a href="{{ route('admin.products.index') }}" class="nav-link">
            <i class="fas fa-user-friends mr-1"></i>
            PRODUCTOS
          </a>
        </li>
        {{-- Productos --}}

        {{-- Categorias --}}
        <li class="nav-item">
          <a href="{{ route('admin.categories.index') }}" class="nav-link">
            <i class="fas fa-user-friends mr-1"></i>
            CATEGORÍAS
          </a>
        </li>
        {{-- Categorias --}}

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>