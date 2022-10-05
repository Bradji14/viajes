<div class="row">
  <div class="col-lg-4 col-md-8 col-12 mx-auto">
    <div class="card z-index-0 fadeIn3 fadeInBottom opacity-75">
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1 text-center">
          <img src="{{asset('/brand/travel2go-light.png')}}" height="54px" width="229px">
        </div>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('login') }}" class="text-start">
            @csrf
            <div class="input-group input-group-outline my-3">
                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email"
                  value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- password -->
            <div class="input-group input-group-outline mb-3">
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password"
                  required autocomplete="current-password" placeholder="Contraseña">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- rememberMe-->
            <div class="form-check form-switch d-flex align-items-center mb-3">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label mb-0 ms-3" for="remember">Remember me</label>
            </div>
            <!-- button -->
            <div class="row mb-0">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary bg-gradient-primary">Iniciar sesión</button>
                    <!--
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif -->
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- -->
