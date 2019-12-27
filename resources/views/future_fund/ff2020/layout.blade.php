<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title> @yield('title') : {{ config('app.name') }}</title>

  <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
  <link href="{{ asset('semantic/semantic.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/future-fund.css') }}?v=1904" rel="stylesheet">
</head>
<body>

  <style>
    #right-start {
      height: 100vh;
      overflow: auto;
    }

  </style>

  <div id="maincontent" class="ui main container">
    @yield('content')
    
    <div class="ui divider"></div>
    <div class="p-5">
      @if (session('locale') == 'en')
        <a href="/session/lang/zh">中文</a>
      @else
        <a href="/session/lang/en">English</a>
      @endif
    </div>
    <!-- RIGHT END -->
  </div>

  <script src="/js/manifest.js"></script>
  <script src="/js/vendor.js"></script>
  <script src="/js/future-fund.js"></script>
  @yield('script')
</body>
</html>