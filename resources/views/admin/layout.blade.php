<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title> @yield('title') : {{ config('app.name', 'Laravel') }}</title>
  <link href="{{ asset('semantic/semantic.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
  <div class="ui fixed inverted menu">
    <div class="ui container">
      <a href="/admin" class="header item">
        OASIS
      </a>

      <a class="{{Request::is('admin/session*')?'active':''}} item" href="/admin/session">Sessions</a>
      <a class="{{Request::is('admin/soul*')?'active':''}} item" href="/admin/soul">Souls</a>
      <a class="{{Request::is('admin/ff*')?'active':''}} item" href="/admin/ff">Future</a>

      <div class="right menu">
        <div class="ui simple dropdown item">
          {{ Auth::user() }}
          <i class="dropdown icon"></i>
          <div class="menu">
            <a class="item" href="#"><i class="add user icon"></i>Add Admin</a>
            <div class="divider"></div>
            <a class="item" href="#"><i class="edit icon"></i>Update Profile</a>
            {{ Form::open(['url' => '/auth/logout', 'method' => 'POST', 'class' => "item clicksubmit"]) }}
              <i class="sign out icon"></i>Logout
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="maincontent" class="ui main container">
  @include('parts.flash')
  @yield('content')

  <div class="marginated ui fluid container engraved footer">
    <div class="ui center aligned basic padded segment">
      <p class="bottom free"> &copy; Copyright {{date('Y')}} OASIS All rights reserved.</p>
      <p class="top free">All trademarks and service marks are the properties of their respective owners.</p>
    </div>
  </div>

  </div>
  <script src="/js/manifest.js"></script>
  <script src="/js/vendor.js"></script>
  <script src="/js/admin.js"></script>
  @yield('script')
</body>
</html>