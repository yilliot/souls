@extends('auth.layout')

@section('title')
    {{trans('auth.signup.title')}} @parent
@endsection

@section('content-blank')
<h1 class="text-center uppercase pt-5">{{config('app.name')}} - {{trans('auth.signup.title')}}</h3>
<form method="POST" action="/auth/complete_profile" class="ui form p-5">
  {{ csrf_field() }}
  @include('auth.flash')

  <div class="field {{$errors->has('email') ? 'error' : ''}}">
    <div class="ui left icon input">
      {{ Form::text('email', \Auth::user()->email, ['placeholder' => trans('auth.signup.email')]) }}
      <i class="mail icon"></i>
    </div>
    @if ($errors->has('email'))
      <label > * {{ $errors->first('email') }}</label>
    @endif
  </div>

  <div class="ui horizontal divider">{{trans('auth.signup.basic_info')}}</div>

  <div class="field {{$errors->has('nickname') ? 'error' : ''}}">
    <label>{{trans('auth.signup.nickname')}}</label>
    {{ Form::text('nickname', null, ['placeholder' => 'e.g : James / Eric / 振鹏'])}}
    @if ($errors->has('nickname'))
      <label > * {{ $errors->first('nickname') }}</label>
    @endif
  </div>

  <div class="field {{$errors->has('nric') ? 'error' : ''}}">
    <label>{{ trans('auth.signup.nric') }}</label>
    {{ Form::text('nric', $nric, ['placeholder' => 'e.g. 900101-01-0000'])}}
    @if ($errors->has('nric'))
      <label > * {{ $errors->first('nric') }}</label>
    @endif
  </div>
  <div class="field {{$errors->has('nric_fullname') ? 'error' : ''}}">
    <label>{{ trans('auth.signup.nric_fullname') }}</label>
    {{ Form::text('nric_fullname', null, ['placeholder' => trans('auth.signup.nric_fullname_placeholder')])}}
    @if ($errors->has('nric_fullname'))
      <label > * {{ $errors->first('nric_fullname') }}</label>
    @endif
  </div>


  <div class="field {{$errors->has('address1') ? 'error' : ''}}">
    <label>{{ trans('auth.signup.address') }}</label>
    <div class="ui left icon input">
      {{ Form::text('address1', null, ['placeholder' => trans('auth.signup.address1') ])}}
      <i class="home icon"></i>
    </div>
    @if ($errors->has('address1'))
      <label > * {{ $errors->first('address1') }}</label>
    @endif
  </div>
  <div class="field {{$errors->has('address2') ? 'error' : ''}}">
    {{ Form::text('address2', null, ['placeholder' => trans('auth.signup.address2')])}}
    @if ($errors->has('address2'))
      <label > * {{ $errors->first('address2') }}</label>
    @endif
  </div>
  <div class="field {{$errors->has('postal_code') ? 'error' : ''}}">
    {{ Form::text('postal_code', null, ['placeholder' => trans('auth.signup.postal_code')])}}
    @if ($errors->has('postal_code'))
      <label > * {{ $errors->first('postal_code') }}</label>
    @endif
  </div>

  <div class="field {{$errors->has('contact') ? 'error' : ''}}">
    <label>{{ trans('auth.signup.contact') }}</label>
    <div class="field">
      {{ Form::text('contact', null, ['placeholder' => 'e.g : 0167654321'])}}
    </div>
    @if ($errors->has('contact'))
      <label > * {{ $errors->first('contact') }}</label>
    @endif
  </div>
  <div class="field {{$errors->has('birthday') ? 'error' : ''}}">

    <label>{{ trans('auth.signup.birthday') }}</label>
    <div class="ui left icon input">
      <input type="date" name="birthday" value="{{old('birthday')}}" placeholder="yyyy-mm-dd">
      <i class="birthday icon"></i>
    </div>
    @if ($errors->has('birthday'))
      <label > * {{ $errors->first('birthday') }}</label>
    @endif
  </div>
  <div class="field {{$errors->has('cellgroup_id') ? 'error' : ''}}">
    {{ Form::select('cellgroup_id', \App\Models\CG::get()->pluck('name', 'id'), null, ['class'=>'ui compact search dropdown', 'id'=>'cellgroup', 'placeholder' => trans('auth.signup.cellgroup')] ) }}
    @if ($errors->has('cellgroup_id'))
      <label > * {{ $errors->first('cellgroup_id') }}</label>
    @endif
  </div>

  <div class="ui hidden divider"></div>

  <div class="field">
    <button class="ui black fluid huge button">{{trans('auth.signup.btn_signup')}}</button>
  </div>

<div class="ui hidden divider"></div>

</form>
@endsection