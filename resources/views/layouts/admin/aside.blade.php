<aside class="sidenav navbar navbar-vertical navbar-expand-xs fixed-start bg-transparent ps ps--active-y bg-white" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="{{url('/admin/home')}}">
      <img src="{{asset('/brand/travel2go-original.png')}}" width="136px" height="32px" class="navbar-brand-img h-100" alt="main_logo">
    </a>
  </div>
  <hr class="horizontal light mt-0 mb-2">
  <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-dark {{ (request()->is('admin/home')) ? 'active bg-gradient-primary' : '' }}" href="{{url('/admin/home')}}">
          <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <!-- Usuarios // Admin // Empleados // Agencias -->
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-8">Administrar usuarios</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark {{ (request()->is('admin/users')) ? 'active bg-gradient-primary' : '' }}" href="{{url('/admin/users')}}">
          <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-user-shield"></i>
          </div>
          <span class="nav-link-text ms-1">Administradores</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark {{ (request()->is('ejecutivo/users')) ? 'active bg-gradient-primary' : '' }}" href="{{url('/ejecutivo/users')}}">
          <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-headset"></i>
          </div>
          <span class="nav-link-text ms-1">Ejecutivos</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark {{ (request()->is('agencias')) ? 'active bg-gradient-primary' : '' }}" href="{{url('/agencias')}}">
          <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-building"></i>
          </div>
          <span class="nav-link-text ms-1">Agencias</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-8">Modulos</h6>
      </li>
      <li class="nav-item">
        <div class="dropdown {{ (request()->is('circuitos*')) ? 'active bg-gradient-primary' : '' }}">
          <a class="btn text-dark dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-map-marked-alt"></i>
            <span class="nav-link-text ms-1">Circuitos</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item {{ (request()->is('circuitos')) ? 'active bg-gradient-primary' : '' }}" href="{{url('/circuitos')}}"><i class="fas fa-home"></i> <span>Vision General</span></a></li>
            <li><a class="dropdown-item {{ (request()->is('circuitos/servicios')) ? 'active bg-gradient-primary' : '' }}" href="{{url('/circuitos/servicios')}}"><i class="fas fa-stream"></i> <span>Servicios</span></a></li>
            <li><a class="dropdown-item {{ (request()->is('circuitos/hoteles')) ? 'active bg-gradient-primary' : '' }}" href="{{url('/circuitos/hoteles')}}"><i class="fas fa-h-square"></i> <span>Hoteles</span></a></li>
            <li><a class="dropdown-item {{ (request()->is('circuitos/proveedores')) ? 'active bg-gradient-primary' : '' }}" href="{{url('/circuitos/proveedores')}}"><i class="fas fa-briefcase"></i> <span>Proveedores</span></a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="{{url('/circuitos/servicio')}}">
          <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-stream"></i>
          </div>
          <span class="nav-link-text ms-1">Hoteles</span>
        </a>
      </li>
    </ul>
  </div>
</aside>
