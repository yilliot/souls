@extends('auth.layout')

@section('title')
    {{trans('auth.merge_nric.title')}} @parent
@endsection

@section('content-blank')
<h1 class="text-center uppercase pt-5">{{config('app.name')}} - {{trans('auth.signup.title')}}</h3>
<form method="POST" action="/auth/signup/nric" class="ui form p-5">
  {{ csrf_field() }}
  @include('auth.flash')

  <table class="ui compact fluid table">
    <tr>
      <td>{{ trans('auth.signup.nickname')}}</td>
      <td>{{ $soul->nickname }}</td>
    </tr>
    <tr>
      <td>{{ trans('auth.signup.nric')}}</td>
      <td>{{ $soul->nric }}</td>
    </tr>
    <tr>
      <td>{{ trans('auth.signup.nric_fullname')}}</td>
      <td>{{ $soul->nric_fullname }}</td>
    </tr>
    <tr>
      <td>{{ trans('auth.signup.contact')}}</td>
      <td>{{ $soul->contact }}</td>
    </tr>
    <tr>
      <td>{{ trans('auth.signup.birthday')}}</td>
      <td>{{ $soul->birthday }}</td>
    </tr>
  </table>

  <div class="ui horizontal divider"> {{trans('auth.signup.login_info')}} </div>

  <input type="hidden" name="soul_id" value="{{$soul->id}}">
  
  <div class="field {{$errors->has('email') ? 'error' : ''}}">
    <div class="ui left icon input">
      {{ Form::text('email', $soul->email, ['placeholder' => trans('auth.signup.email')]) }}
      <i class="mail icon"></i>
    </div>
    @if ($errors->has('email'))
      <label > * {{ $errors->first('email') }}</label>
    @endif
  </div>

  <div class="field {{$errors->has('password') ? 'error' : ''}}">
    <div class="ui input">
      {{ Form::password('password', ['placeholder' => trans('auth.login.password')]) }}
    </div>
    @if ($errors->has('password'))
      <label > * {{ $errors->first('password') }}</label>
    @endif
  </div>
  <div class="field">
    <button class="ui black fluid huge button">{{trans('auth.signup.btn_signup')}}</button>
  </div>

<div class="ui hidden divider"></div>

</form>

@endsection