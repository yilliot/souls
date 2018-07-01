<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no">
  <meta charset="UTF-8">
  <title>
    @section('title')
      on {{config('app.name')}}
    @show
  </title>
  <link href="{{ asset('semantic/semantic.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/zz.css') }}" rel="stylesheet">

</head>
<body>
@include('parts.flash')

<!-- Latest compiled and minified CSS -->
<script src="/js/manifest.js"></script>
<script src="/js/vendor.js"></script>
<script src="/js/app.js"></script>
@yield('content-blank')
<div class="ui divider"></div>
@if (session('locale') == 'zh')
  <a href="/session/lang/en">English</a>
@else
  <a href="/session/lang/zh">中文</a>
@endif

</body>
</html>