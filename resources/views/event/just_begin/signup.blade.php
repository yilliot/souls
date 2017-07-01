@extends('event.just_begin.layout')

@section('title')
3KM Sign up
@endsection

@section('content')
  <div id="signup-container" class="ui piled inverted segment text container">

    <a href="/session/lang/zh">中文</a> |
    <a href="/session/lang/en">English</a>

    <h1 class="ui center aligned header">
      <div>
        <img id="logo" src="/images/hcc-logo-black320.png" alt="HCCJB">
      </div>
      <div class="neon-green content">
          <span class="glow">3KM</span>
          <div class="sub neon-green header">
            {{trans('event.just_begin.just_begin')}}
          </div>
        </div>
    </h1>
    <h2 class="header">
      {{trans('event.just_begin.signup')}}
    </h2>
    @include('event.just_begin.part.flash')

    {{ Form::open(['url' => '/event/3km/signup', 'method' => 'post', 'class' => 'ui inverted form', 'id' => 'just-begin-signup']) }}

      <div class="field {{$errors->has('nickname') ? 'error' : ''}}">
        <label>{{trans('event.just_begin.nickname')}}</label>
        {{ Form::text('nickname', null, ['placeholder' => 'e.g : James / Eric / 振鹏'])}}
        @if ($errors->has('nickname'))
          <label > * {{ $errors->first('nickname') }}</label>
        @endif
      </div>

      <div class="field {{$errors->has('nric') ? 'error' : ''}}">
        <label>{{ trans('event.just_begin.nric') }}</label>
        <div class="ui left icon input">
          {{ Form::text('nric', null, ['placeholder' => 'e.g : 901001-01-1234 / S01234567B'])}}
          <i class="user icon"></i>
        </div>
        @if ($errors->has('nric'))
          <label > * {{ $errors->first('nric') }}</label>
        @endif
      </div>
      <div class="field {{$errors->has('nric_fullname') ? 'error' : ''}}">
        <label>{{ trans('event.just_begin.nric_fullname') }}</label>
        {{ Form::text('nric_fullname', null, ['placeholder' => 'Your NRIC / Passport full name'])}}
        @if ($errors->has('nric_fullname'))
          <label > * {{ $errors->first('nric_fullname') }}</label>
        @endif
      </div>
      <div class="field {{$errors->has('email') ? 'error' : ''}}">
        <label>{{ trans('event.just_begin.email') }}</label>
        <div class="ui left icon input">
          {{ Form::text('email', null, ['placeholder' => 'e.g : your_name@mail.com']) }}
          <i class="mail icon"></i>
        </div>
        @if ($errors->has('email'))
          <label > * {{ $errors->first('email') }}</label>
        @endif
      </div>
      <div class="field {{$errors->has('address1') ? 'error' : ''}}">
        <label>{{ trans('event.just_begin.address') }}</label>
        <div class="ui left icon input">
          {{ Form::text('address1', null, ['placeholder' => trans('event.just_begin.address1') ])}}
          <i class="home icon"></i>
        </div>
        @if ($errors->has('address1'))
          <label > * {{ $errors->first('address1') }}</label>
        @endif
      </div>
      <div class="field {{$errors->has('address2') ? 'error' : ''}}">
        {{ Form::text('address2', null, ['placeholder' => trans('event.just_begin.address2')])}}
        @if ($errors->has('address2'))
          <label > * {{ $errors->first('address2') }}</label>
        @endif
      </div>
      <div class="field {{$errors->has('postal_code') ? 'error' : ''}}">
        {{ Form::text('postal_code', null, ['placeholder' => trans('event.just_begin.postal_code')])}}
        @if ($errors->has('postal_code'))
          <label > * {{ $errors->first('postal_code') }}</label>
        @endif
      </div>

      <div class="field {{$errors->has('contact') ? 'error' : ''}}">
        <label>{{ trans('event.just_begin.contact') }}</label>
        <div class="field">
          {{ Form::select('contact_code', \App\Enums\ContactCountryCodes::all(), null, ['class' => 'ui compact dropdown label'] )}}
        </div>
        <div class="field">
          {{ Form::text('contact', null, ['placeholder' => 'e.g : 0167654321'])}}
        </div>
        @if ($errors->has('contact'))
          <label > * {{ $errors->first('contact') }}</label>
        @endif
      </div>
      <div class="field {{$errors->has('birthday') ? 'error' : ''}}">

        <label>{{ trans('event.just_begin.birthday') }}</label>
        <div class="ui left icon input">
          <input type="date" name="birthday" value="{{old('birthday')}}" placeholder="yyyy-mm-dd">
          <i class="birthday icon"></i>
        </div>
        @if ($errors->has('birthday'))
          <label > * {{ $errors->first('birthday') }}</label>
        @endif
      </div>
      <div class="field {{$errors->has('cellgroup_id') ? 'error' : ''}}">
        {{ Form::select('cellgroup_id', \App\Models\Cellgroup::get()->pluck('name', 'id'), null, ['class'=>'ui compact search dropdown', 'placeholder' => 'Cellgroup'] ) }}
        @if ($errors->has('cellgroup_id'))
          <label > * {{ $errors->first('cellgroup_id') }}</label>
        @endif
      </div>

      <div class="ui hidden divider"></div>

      <div class="field">
        <button class="ui inverted basic fluid huge button">{{trans('event.just_begin.signup')}}</button>
      </div>
      <div class="field">
        <a href="/event/3km/checkin">{{trans('event.just_begin.signup_already')}}</a>
      </div>
    {{ Form::close() }}
  </div>
@endsection

@section('script')
<link rel="stylesheet" href="/css/jquery-ui-1.12.1.custom/jquery-ui.min.css">
<script src='/css/jquery-ui-1.12.1.custom/jquery-ui.min.js'></script>
<script>
jQuery(function($) {
    var $inputs = $('input[type="date"]');

    if (!$inputs.length) return;

    /*
     * The browser does not support the HTML5 date type.
     *
     * We add the datepicker as a fallback.
     */
    if ('date' !== $inputs.get(0).type) {
        $inputs.addClass('datepicker');
    }

    $( ".datepicker" ).datepicker({
      'dateFormat' : 'yy-mm-dd',
      'changeMonth': true,
      'changeYear': true,
      'defaultDate' : '-25y'
    });
});
</script>
@endsection
