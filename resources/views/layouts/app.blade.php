<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Kursmatch</title>

        <!-- CSS And JavaScript -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/kursmatch.css') }}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="{{ asset('js/jquery.ui.touch-punch.min.js') }}"></script>
    </head>

    <body class=".bg-light">
        <div class="container">
            <nav class="navbar navbar-default">
                <!-- Navbar Contents -->
            </nav>
            <div class="row justify-content-center" id="nav">
              <div class="col-1"></div>
              <div class="col-4">
                <div id="logos">
                  <img src="{{ asset('img/logo-fakultaet-vwl.svg') }}" width="170" height="50" class="logo" alt="Logo Uni Mannheim VWL">
                  <span id="logoand">&</span>
                  <img src="{{ asset('img/zew_logo_deutsch_noclaim.svg') }}" width="80" height="80" class="logo" alt="Logo ZEW">
                </div>
              </div>
              <div class="col-4">
                <h3>Seminar Allocation Tool<small class="text-muted"></small></h3>
              </div>
            </div>
            <p class="lead"></p>

            @yield('content')

        </div>

        <br>
        <br>
        <br>

        <footer>
          <div class="container">
          <div class="row">
          <div class="col-4">@lang('messages.footer_text_help')</div>
          <div class="col-5"></div>
          <div class="col-3">
            <span>@lang('messages.footer_text_copyright')</span>
          </div>
          </div>
        </div>
        </footer>
    </body>
</html>
