<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta name="description" content="@yield('description')">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" />
    <!-- custom theme -->
    <style>
      .bd-gutter {
        --bs-gutter-x: 3rem;
      }
      .bd-navbar .navbar-toggler:first-child {
        margin-left: -.5rem;
      }
      .bd-navbar .navbar-toggler {
        padding: 0;
        margin-right: -.5rem;
        border: 0;
      }
      .navbar-dark, .offcanvas-lg {background: #0073b7  ;}
      .bd-navbar .dropdown-item.current {
        font-weight: 600;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23292b2c' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem top 0.6rem;
        background-size: .75rem .75rem;
      }
      .bd-navbar .dropdown-menu {
        --bs-dropdown-min-width: 12rem;
        --bs-dropdown-link-hover-bg: rgba(var(--bd-violet-rgb), .1);
        --bs-dropdown-font-size: .875rem;
      }
      .dropdown {
        padding-left: 28px;
      }
      .dropdown-item {
        padding: 6px 42px;
      }
      .dropdown span {position: absolute;left: 0}
      @media only screen and (max-width: 992px) {
        .offcanvas-body .navbar-toggler,.offcanvas-body .nav-link {
          padding-right: .25rem;
          padding-left: .25rem;
          color: rgba(255,255,255,0.85);
        }
        .bd-navbar .navbar-toggler.active, .bd-navbar .nav-link.active {
          font-weight: 600;
          color: #fff;
        }
        .active > .icon-navbar {
          border: solid 2px;
          border-radius: 16px;
        }
        .nav-link > .icon-navbar {
          width: 32px;
          height: 32px;
          padding: 3px;
        }.navbar-nav .dropdown-toggle.show {width: fit-content;}
        .dropdown-menu .material-symbols-outlined {padding-left: 38px;}
      }
      @media only screen and (min-width: 992px) {
        .icon-navbar{text-align: center;width: 32px;height: 32px;padding: 3px;margin: 0 auto;}
        .nav-item > .active .icon-navbar {
          background: #055da5;
          color: #fff;
          border-radius: 28px;
        }
        .dropdown-menu .material-symbols-outlined {padding-left: 10px;}
      }
    </style>
    <style>
      .material-symbols-outlined {
        font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 48
      }
    </style>
    @yield('styles')
</head>
<body id="path" data-url="{{url('/')}}">
  @include('agencias.layouts.navbar')
  @yield('content')
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
@yield('scripts')
</html>
