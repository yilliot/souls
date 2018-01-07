<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title> @yield('title') : {{ config('app.name', 'Laravel') }}</title>
  <link href="{{ asset('semantic/semantic.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/event.bible-reading.css') }}" rel="stylesheet">
  <link href="{{ asset('css/event.bible-reading.supervision.css') }}" rel="stylesheet">
</head>
<body>
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
      <p class="bottom free"> &copy; Copyright {{date('Y')}} HCCJB All rights reserved.</p>
      <p class="top free">All trademarks and service marks are the properties of their respective owners.</p>
    </div>
  </div>


  </div>
  <script src="/js/manifest.js"></script>
  <script src="/js/vendor.js"></script>
  <script src="/js/event.bible-reading.js"></script>
  @yield('script')
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.11&appId=284805762045136';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>