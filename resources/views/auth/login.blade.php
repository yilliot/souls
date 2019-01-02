@extends('auth.layout')

@section('title')
    {{trans('auth.login.title')}} @parent
@endsection

@section('content-blank')
<h1 class="text-center uppercase pt-5">{{config('app.name')}} - {{trans('auth.login.title')}}</h3>
<form action="/auth/login" method="post" class="ui form p-5">
  {{ csrf_field() }}
  @include('auth.flash')

  <div class="field">
    <input name="email" type="text" value="{{old('email')}}" placeholder="{{trans('auth.login.email')}}" />
  </div>
  <div class="field">
    <input name="password" type="password" placeholder="{{trans('auth.login.password')}}" />
  </div>
  <div class="field">
    <button class="ui teal fluid button">
      {{trans('auth.login.title')}}
    </button>
  </div>
  <div class="ui horizontal divider">OR</div>
  <a class="ui fluid black button" href="/auth/signup">
      {{trans('auth.signup.title')}}
  </a>
  <div class="ui horizontal divider">OR</div>
  <a class="ui facebook fluid button" href="/auth/facebook">
      <i class="facebook icon"></i>
      {{trans('auth.login.btn_fb')}}
  </a>

</form>
@endsection