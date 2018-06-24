@extends('auth.layout')

@section('title')
    New signup @parent
@endsection

@section('content-blank')
<h1>Ah, first time here huh?</h1>
<div>We'll need some information from you to continue with the signup.</div>
<form class="ui form" method="POST" action="/auth/signup">
  {{ csrf_field() }}

  {{ Form::open(['url' => '/event/bible_reading/signup', 'method' => 'post', 'class' => 'ui form', 'id' => 'bible-reading-signup']) }}

    <div class="field {{$errors->has('nickname') ? 'error' : ''}}">
      <label>{{trans('event.bible_reading.nickname')}}</label>
      {{ Form::text('nickname', null, ['placeholder' => 'e.g : James / Eric / 振鹏'])}}
      @if ($errors->has('nickname'))
        <label > * {{ $errors->first('nickname') }}</label>
      @endif
    </div>

    <div class="field {{$errors->has('nric') ? 'error' : ''}}">
      <label>{{ trans('event.bible_reading.nric') }}</label>
      <div class="ui left icon input">
        {{ Form::text('nric', null, ['placeholder' => 'e.g : 901001-01-1234 / S01234567B'])}}
        <i class="user icon"></i>
      </div>
      @if ($errors->has('nric'))
        <label > * {{ $errors->first('nric') }}</label>
      @endif
    </div>
    <div class="field {{$errors->has('nric_fullname') ? 'error' : ''}}">
      <label>{{ trans('event.bible_reading.nric_fullname') }}</label>
      {{ Form::text('nric_fullname', null, ['placeholder' => trans('event.bible_reading.nric_fullname_placeholder')])}}
      @if ($errors->has('nric_fullname'))
        <label > * {{ $errors->first('nric_fullname') }}</label>
      @endif
    </div>
    <div class="field {{$errors->has('email') ? 'error' : ''}}">
      <label>{{ trans('event.bible_reading.email') }}</label>
      <div class="ui left icon input">
        {{ Form::text('email', null, ['placeholder' => 'e.g : your_name@mail.com']) }}
        <i class="mail icon"></i>
      </div>
      @if ($errors->has('email'))
        <label > * {{ $errors->first('email') }}</label>
      @endif
    </div>
    <div class="field {{$errors->has('address1') ? 'error' : ''}}">
      <label>{{ trans('event.bible_reading.address') }}</label>
      <div class="ui left icon input">
        {{ Form::text('address1', null, ['placeholder' => trans('event.bible_reading.address1') ])}}
        <i class="home icon"></i>
      </div>
      @if ($errors->has('address1'))
        <label > * {{ $errors->first('address1') }}</label>
      @endif
    </div>
    <div class="field {{$errors->has('address2') ? 'error' : ''}}">
      {{ Form::text('address2', null, ['placeholder' => trans('event.bible_reading.address2')])}}
      @if ($errors->has('address2'))
        <label > * {{ $errors->first('address2') }}</label>
      @endif
    </div>
    <div class="field {{$errors->has('postal_code') ? 'error' : ''}}">
      {{ Form::text('postal_code', null, ['placeholder' => trans('event.bible_reading.postal_code')])}}
      @if ($errors->has('postal_code'))
        <label > * {{ $errors->first('postal_code') }}</label>
      @endif
    </div>

    <div class="field {{$errors->has('contact') ? 'error' : ''}}">
      <label>{{ trans('event.bible_reading.contact') }}</label>
      <div class="field">
        {{ Form::select('contact_code', \App\Enums\ContactCountryCodes::all(), null, ['class' => 'ui compact dropdown label', 'id'=>'contact-code'] )}}
      </div>
      <div class="field">
        {{ Form::text('contact', null, ['placeholder' => 'e.g : 0167654321'])}}
      </div>
      @if ($errors->has('contact'))
        <label > * {{ $errors->first('contact') }}</label>
      @endif
    </div>
    <div class="field {{$errors->has('birthday') ? 'error' : ''}}">

      <label>{{ trans('event.bible_reading.birthday') }}</label>
      <div class="ui left icon input">
        <input type="date" name="birthday" value="{{old('birthday')}}" placeholder="yyyy-mm-dd">
        <i class="birthday icon"></i>
      </div>
      @if ($errors->has('birthday'))
        <label > * {{ $errors->first('birthday') }}</label>
      @endif
    </div>
    <div class="field {{$errors->has('cellgroup_id') ? 'error' : ''}}">
      {{ Form::select('cellgroup_id', \App\Models\Cellgroup::get()->pluck('name', 'id'), null, ['class'=>'ui compact search dropdown', 'id'=>'cellgroup', 'placeholder' => trans('event.bible_reading.cellgroup')] ) }}
      @if ($errors->has('cellgroup_id'))
        <label > * {{ $errors->first('cellgroup_id') }}</label>
      @endif
    </div>

    <div class="ui hidden divider"></div>

    <div class="field">
      <button class="ui black fluid huge button">{{trans('event.bible_reading.signup')}}</button>
    </div>
  {{ Form::close() }}
  <div class="ui hidden divider"></div>


</form>
@endsection