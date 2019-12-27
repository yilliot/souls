@extends('future_fund.ff2020.layout-auth')

@section('title')
    {{trans('auth.signup.title')}} @parent
@endsection

@section('content-blank')
<h1 class="text-center uppercase pt-5">{{trans('futurefund.step2')}}</h3>
<form method="POST" action="/ff/simple_soul" class="ui form p-5">
  {{ csrf_field() }}
  @include('auth.flash')
  <input type="hidden" name="ff_code" value="{{$session->code}}">
  <div class="ui horizontal divider">{{trans('futurefund.complete_basic_info')}}</div>

  <div class="field {{$errors->has('nric') ? 'error' : ''}}">
    <label>{{ trans('auth.signup.nric') }}</label>
    {{ Form::text('nric', $soul->nric, ['placeholder' => 'e.g. 900101-01-0000'])}}
    @if ($errors->has('nric'))
      <label > * {{ $errors->first('nric') }}</label>
    @endif
  </div>

  <div class="field {{$errors->has('nric_fullname') ? 'error' : ''}}">
    <label>{{ trans('auth.signup.nric_fullname') }}</label>
    {{ Form::text('nric_fullname', $soul->nric_fullname, ['placeholder' => trans('auth.signup.nric_fullname_placeholder')])}}
    @if ($errors->has('nric_fullname'))
      <label > * {{ $errors->first('nric_fullname') }}</label>
    @endif
  </div>

  <div class="field {{$errors->has('nickname') ? 'error' : ''}}">
    <label>{{trans('auth.signup.nickname')}}</label>
    {{ Form::text('nickname', $soul->nickname, ['placeholder' => 'e.g : James / Eric / 振鹏'])}}
    @if ($errors->has('nickname'))
      <label > * {{ $errors->first('nickname') }}</label>
    @endif
  </div>

  <div class="field {{$errors->has('contact') ? 'error' : ''}}">
    <label>{{ trans('auth.signup.contact') }}</label>
    <div class="field">
      {{ Form::text('contact', $soul->contact, ['placeholder' => 'e.g : 0167654321'])}}
    </div>
    @if ($errors->has('contact'))
      <label > * {{ $errors->first('contact') }}</label>
    @endif
  </div>

  <div class="ui hidden divider"></div>

  <div class="field">
    <button class="ui yellow fluid button">{{trans('futurefund.completed')}}</button>
  </div>

<div class="ui hidden divider"></div>

</form>
@endsection