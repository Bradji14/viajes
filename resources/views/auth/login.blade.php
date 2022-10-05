<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('auth.layout.header')
</head>
<body class="bg-gray-200">
  <div class="page-header align-items-start min-vh-100" style="background-image: url({{asset('/images/capadocia_edc45da2.jpg')}});">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container my-auto">
      @include('auth.layout.main')
    </div>
    <footer class="footer position-absolute bottom-2 py-2 w-100">
      <div class="container">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-12 col-md-12 my-auto">
            <div class="copyright text-center text-sm text-white text-lg-center">
              © <script>
                document.write(new Date().getFullYear())
              </script>,
              Designed by
              <a href="https://dimensiondigital.net/" class="font-weight-bold text-white" target="_blank">Creative Agency</a>
              for a better web.
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
 </body>
 @include('auth.layout.scripts')
</html>
