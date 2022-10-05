<header class="navbar navbar-expand-lg bg-light bd-navbar sticky-top" style="">
  <nav class="container-xxl bd-gutter flex-wrap flex-lg-nowrap" aria-label="Main navigation">
    <a class="navbar-toggler p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#bdSidebar" aria-controls="bdSidebar" aria-label="Toggle docs navigation">
      <span class="material-symbols-outlined">headset_mic</span>
      <span class="d-none fs-6 pe-1">Teléfono</span>
    </a>
    <!-- brand -->
    <a class="navbar-brand p-0 me-0 me-lg-2" href="{{url('/home')}}" aria-label="Bootstrap">
      <img src="{{asset('/brand/travel2go-original.png')}}" height="30" width="127">
    </a>
    <!-- button menú mobile -->
    <button class="navbar-toggler d-flex d-lg-none order-3 p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-label="Toggle navigation">
      <span class="material-symbols-outlined">menu</span>
    </button>
    <!-- canvas menú -->
    <div class="offcanvas-lg offcanvas-end flex-grow-1" tabindex="-1" id="bdNavbar" aria-labelledby="bdNavbarOffcanvasLabel" data-bs-scroll="true">
      <div class="offcanvas-header px-4 pb-0">
        <img src="{{asset('/brand/travel2go-light.png')}}" height="24px" class="offcanvas-title">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close" data-bs-target="#bdNavbar"></button>
      </div>
      <!-- content -->
      <div class="offcanvas-body p-4 pt-0 p-lg-0">
        <hr class="d-lg-none text-white-50">
        <ul class="navbar-nav px-lg-4 flex-row flex-wrap bd-navbar-nav">
          <li class="nav-item col-6 col-lg-auto">
            <a class="nav-link py-2 px-0 d-lg-flex flex-lg-column px-lg-2 {{ (request()->is('home')) ? 'active' : '' }}" href="{{url('/home')}}">
              <div class="icon-navbar">
                <span class="material-symbols-outlined">home</span>
              </div>
              <div class="label-navbar">Home</div>
            </a>
          </li>
          <li class="nav-item col-6 col-lg-auto">
            <a class="nav-link py-2 px-0 d-lg-flex flex-lg-column px-lg-2 {{ (request()->is('hoteles')) ? 'active' : '' }} disabled" href="#">
              <div class="icon-navbar">
                <span class="material-symbols-outlined">hotel</span>
              </div>
              <div class="label-navbar">Hoteles</div>
            </a>
          </li>
          <li class="nav-item col-6 col-lg-auto">
            <a class="nav-link py-2 px-0 px-lg-2 d-lg-flex flex-lg-column {{ (request()->is('circuitos*')) ? 'active' : '' }}" href="{{url('/circuitos')}}" >
              <div class="icon-navbar">
                <span class="material-symbols-outlined">map</span>
              </div>
              <div class="label-navbar">Circuitos</div>
            </a>
          </li>
          <li class="nav-item col-6 col-lg-auto">
            <a class="nav-link py-2 px-0 px-lg-2 d-lg-flex flex-lg-column {{ (request()->is('tours')) ? 'active' : '' }} disabled" href="#" >
              <div class="icon-navbar">
                <span class="material-symbols-outlined">hiking</span>
              </div>
              <div class="label-navbar">Tours</div>
            </a>
          </li>
          <li class="nav-item col-6 col-lg-auto">
            <a class="nav-link py-2 px-0 px-lg-2 d-lg-flex flex-lg-column disabled" href="#" >
              <div class="icon-navbar">
                <span class="material-symbols-outlined">airport_shuttle</span>
              </div>
              <div class="label-navbar">Traslados</div>
            </a>
          </li>
        </ul>
        <hr class="d-lg-none text-white-50">
        <ul class="navbar-nav flex-row align-items-center flex-wrap ms-md-auto">
          <li class="nav-item dropdown">
            <a class="btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static" title="Menú">
              <span class="material-symbols-outlined">person</span>
              {{ Auth::user()->name }}
              <span class="visually-hidden">Agencia</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item current" aria-current="true" href="#">
                  <span class="material-symbols-outlined">library_books</span>
                  Mis Reservas
                </a>
              </li>
              <li>
                  <a class="dropdown-item" href="#">
                    <span class="material-symbols-outlined">account_circle</span>
                    Perfil
                  </a>
              </li>
              <li>
                  <a class="dropdown-item" href="#">
                    <span class="material-symbols-outlined">info</span>
                    Info
                  </a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  <span class="material-symbols-outlined">logout</span>
                    {{ __('Salir') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
