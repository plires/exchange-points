<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a target="_blank" rel="noopener noreferrer" href="/" class="brand-link">
    <img v-cloak src="{{ asset('img/admin/logo-admin.png') }}" alt="logo monster miles" style="opacity: .8">
    <span class="brand-text font-weight-light">Monster Miles</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex flex-column justify-content-center">

      <div class="d-flex justify-content-cener">
        
        <div class="info">
          <p class="d-block" v-cloak>@{{ authUser.name }}</p>
        </div>
        <a class="d-flex justify-content-cener align-items-center" 
          href="{{ route('logout') }}" 
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
          title="Salir">
          <i class="fas fa-sign-out-alt ml-3"></i>
        </a>
      </div>

    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
    </form>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        {{-- Usuarios --}}
        <li class="nav-item">
          <a href="{{ route('admin.users.index') }}" 
            class="nav-link @if (\Request::is('admin/users')) active  @endif">
            <i class="fas fa-user-friends mr-1"></i>
            USUARIOS
          </a>
        </li>
        {{-- Usuarios end --}}

        {{-- Puntos --}}
        <li class="nav-item">
          <a href="#" 
            class="nav-link 
            @if ( \Request::is('admin/points') || 
            \Request::is('admin/show_export_template') || 
            \Request::is('admin/show_import_template') ) active  @endif">
            <i class="fas fa-list-ul mr-1"></i>
            PUNTOS
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="{{ route('admin.points.index') }}" 
                class="nav-link  @if (\Request::is('admin/points')) active  @endif">
                <i class="fas fa-eye mr-1"></i>
                <p>Visualización</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.show-export-template') }}" 
                class="nav-link @if (\Request::is('admin/show_export_template')) active  @endif">
                <i class="fas fa-file-download mr-1"></i>
                <p>Exportación Masiva</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.show-import-template') }}" 
                class="nav-link @if (\Request::is('admin/show_import_template')) active  @endif">
                <i class="fas fa-upload mr-1"></i>
                <p>Importacion Masiva</p>
              </a>
            </li>
          </ul>
        </li>
        {{-- Puntos end --}}

        {{-- Puntos Asignados --}}
        <li class="nav-item">
          <a href="{{ route('admin.points-assigned.index') }}" 
            class="nav-link @if (\Request::is('admin/points-assigned')) active  @endif">
            <i class="fas fa-cart-plus mr-1"></i>
            PUNTOS ASIGNADOS
          </a>
        </li>
        {{-- Puntos Asignados --}}

        {{-- Visualizacion de Canjes --}}
        <li class="nav-item">
          <a href="{{ route('admin.points-exchanged.index') }}" 
            class="nav-link @if (\Request::is('admin/points-exchanged')) active  @endif">
            <i class="fas fa-exchange-alt mr-1"></i>
            CANJES REALIZADOS
          </a>
        </li>
        {{-- Visualizacion de Canjes --}}

        {{-- Productos --}}
        <li class="nav-item">
          <a href="{{ route('admin.products.index') }}" 
            class="nav-link @if (\Request::is('admin/products')) active  @endif">
            <i class="fas fa-dolly-flatbed mr-1"></i>
            PRODUCTOS
          </a>
        </li>
        {{-- Productos --}}

        {{-- Categorias --}}
        <li class="nav-item">
          <a href="{{ route('admin.categories.index') }}" 
            class="nav-link @if (\Request::is('admin/categories')) active  @endif">
            <i class="fas fa-boxes mr-1"></i>
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