@extends('MasterAgencias')
@section('title', 'Circuitos')
@section('description','Agencia')
@section('styles')
  <style>
    .sbox .material-symbols-outlined {
      font-size: 18px;
      padding: 0px 5px;
      margin-left: -22px;
    }
    /* break point mobile */
    @media only screen and (max-width: 992px) {
      .sbox {margin-top: 10px;}
      .hero {
        background: #0d6efd;
        min-height: 380px;
        padding-bottom: 12%;
        background-image: url('https://media.staticontent.com/media/pictures/ac250e36-5700-4b60-8dac-934a961ff431'), linear-gradient(90deg, #1984e2 20%, #1984e2 100%);
        background-size: 150%, auto;
      }
      .searchbox {
        padding: 16px 12px;
        background: #000000c9;
        border-radius: 16px;
        margin: 0 16px;
      }

    }
    /* break point desktop */
    @media only screen and (min-width: 993px) {
      .hero {
        min-height: 340px;
        width: 100%;
        padding: 80px 20px;
        background: #1984e2;
        background: #1984e2;
        background-image: url('https://media.staticontent.com/media/pictures/ac250e36-5700-4b60-8dac-934a961ff431'), linear-gradient(90deg, #1984e2 20%, #1984e2 100%);
        background-size: 68%, auto;
      }
      .searchbox {
        background: #000000c9;
        border-radius: 12px;
        padding: 28px 20px;
      }
      .sbox {margin-top: 8px;}
    }
  </style>
@endsection
@section('content')
@include('agencias.circuitos.layouts.search')
<!-- search box container -->
<div class="ac-wrapper"></div>
@endsection
@section('scripts')
  <script>

  </script>
@endsection
