@extends('MasterAgencias')
@section('title', 'Circuitos')
@section('description','Agencia')
@section('styles')
  <style>
  .carousel img {
    max-height: 80vh;
    object-fit: cover;
    margin: 0 auto;
  }
  .carousel-item.active{background-color: #eef9fb;}
  .carousel-control-next-icon, .carousel-control-prev-icon {
    background-color: #222;
    border-radius: 16px;
    background-size: 60%;
  }
  .carousel-control-next, .carousel-control-prev {
    opacity: 0.95;
  }
</style>
@endsection
@section('content')
@include('agencias.home.carusel')
<div class="container-fluid py-4"></div>
@endsection
@section('scripts')
  <script>
  </script>
@endsection
