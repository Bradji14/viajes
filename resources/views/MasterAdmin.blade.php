<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta name="description" content="@yield('description')">
    <!-- styles -->
    @include('layouts.admin.styles')
    @yield('styles')
    <style>
      .loading {
        position: fixed;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        background-color: #fff;
        z-index: 999999999999;
        display: flex;
      }
      .loading > video {margin: auto;}
      .sidenav .active .dropdown-toggle i, .sidenav .dropdown.active .active i, .sidenav .dropdown.active .nav-link-text, .sidenav .dropdown.active .dropdown-toggle:after {color: #fff;}
    </style>
</head>
<body class="g-sidenav-show  bg-gray-200" data-path="{{url('/')}}" id="root">
  @include('layouts.admin.aside')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    @include('layouts.admin.navbar')
    <!-- End Navbar -->
    <main class="py-4">
      @yield('content')
    </main>
  </main>
  <content class="loading">
    <video width="800px" height="600px" autoplay muted>
      <source src="{{asset('videos/travel-loader.mp4')}}" type="video/mp4">
    </video>
  </content>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" defer integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" defer integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('/theme/assets/js/material-lite.js?v=1')}}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" defer integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js" defer></script>
@yield('scripts')
<script>
function LoadingReady(){
     $('.loading').delay(800).fadeOut();
  } 
    document.addEventListener('DOMContentLoaded', function(event) {
    LoadingReady();
    });
    
    </script>
</html>
