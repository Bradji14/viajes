@extends('MasterAgencias')
@section('title', 'Detalles circuito')
@section('description','Agencia')
@section('styles')
  <style>
    .sbox .material-symbols-outlined {
      font-size: 18px;
      padding: 0px 5px;
      margin-left: -22px;
    }
    .cluster-item {margin: 18px auto;}
    /* break point mobile */
    @media only screen and (max-width: 992px) {
      .sbox {margin-top: 10px;}
      .hero {
        background-color: #085499;
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
        width: 100%;
        background-color: #085499;
      }
      .searchbox {
        padding: 28px 20px;
      }
      .sbox {margin-top: 8px;}
    }
  </style>
@endsection
@section('content')
<div class="container-fluid py-4" id="app"></div>
@endsection
@section('scripts')
  <script>
    let path = $('#path').data('url')+'/circuitos'; let app = $('#app');
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const slug = urlParams.get('slug')
    //ajax
    /*
    $.getJSON(path+'/getItems', {slug: slug}, function(json, textStatus) {
        if (json.tipo == 500) {
          window.location.replace(path);
        }else if(json.tipo == 200){
          // ok
        }
    }); */
    // example
    let items = '<div class="col-sm-12 col-md-6 col-lg-4 cluster-item">'+
      '<div class="card">'+
        '<img src="https://media.staticontent.com/media/pictures/3e3965df-b8da-4f42-9b58-66a9bc60a3eb/409x210?op=NONE&enlarge=false&gravity=ce_0_0&quality=80&dpr=1.5" class="card-img-top" alt="...">'+
        '<div class="card-body">'+
          '<h5 class="card-title">Card title</h5>'+
          '<p class="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>'+
          '<a href="'+(path+'/exampleID/url-tag')+'" class="btn btn-primary">Go somewhere</a>'+
        '</div>'+
      '</div>'+
    '</div>';
    app.append('<div class="row">'+items+'</div>');
  </script>
@endsection
