@extends('MasterAdmin')
@section('title', 'Home')
@section('description','Administrador')
@section('styles')
@endsection
@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                  <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Home</h6>
                  </div>
                </div>

                  <div class="card-body">
                      You are a Admin User.
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
@section('scripts')
@endsection
