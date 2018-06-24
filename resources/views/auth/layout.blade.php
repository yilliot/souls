<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta charset="UTF-8">
  <title>
    @section('title')
      on {{config('app.name')}}
    @show
  </title>
  <link href="{{ asset('semantic/semantic.min.css') }}" rel="stylesheet">

</head>
<body>
@include('parts.flash')

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="{{ asset('css/auth.css') }}" />
@yield('content-blank')

</body>
</html>