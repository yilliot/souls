<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title> @yield('title') : {{ config('app.name') }}</title>
  <link href="{{ asset('semantic/semantic.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/future-fund.css') }}?1904" rel="stylesheet">
</head>
<body>
  @yield('pre-body')
  <div id="maincontent" class="ui main container">
    <div id="bible-reading-container">
      @yield('content')
      <div>
        <a href="/session/lang/zh">中文</a> |
        <a href="/session/lang/en">English</a>
      </div>
    </div>

  <div class="marginated ui fluid container engraved footer">
    <div class="ui center aligned basic padded segment">
      <p class="bottom free"> &copy; Copyright {{date('Y')}} OASIS All rights reserved.</p>
      <p class="top free">All trademarks and service marks are the properties of their respective owners.</p>
    </div>
  </div>


  </div>
  <script src="/js/manifest.js"></script>
  <script src="/js/vendor.js"></script>
  <script src="/js/future-fund.js"></script>
  @yield('script')
</body>
</html>