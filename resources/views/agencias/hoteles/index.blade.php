@extends('MasterAgencias')
@section('title', 'Home')
@section('description','Agencia')
@section('styles')
  <style>
    /* break point mobile */
    @media only screen and (max-width: 992px) {

    }
    /* break point desktop */
    @media only screen and (min-width: 992px) {
      .hero {
        min-height: 340px;
        width: 100%;
        padding: 80px 20px;
        background: #1984e2;
      }
      .searchbox {
        background: #00000082;
        border-radius: 12px;
        padding: 28px 20px;
      }
      .sbox {margin-top: 8px;}
    }
  </style>
@endsection
@section('content')
@include('agencias.hoteles.layouts.search')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are a User.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection
