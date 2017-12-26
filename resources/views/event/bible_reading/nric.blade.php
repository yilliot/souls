@extends('event.bible_reading.layout')

@section('title')
Bible Reading Sign up
@endsection

@section('content')
  <div id="signup-container" class="ui piled inverted segment text container">

    <a href="/event/bible_reading"> <i class="home icon"></i> </a> |
    <a href="/session/lang/zh">中文</a> |
    <a href="/session/lang/en">English</a>

    @include('event.bible_reading.part.logo')
    
    <h2 class="header">
      {{trans('event.bible_reading.signup')}}
    </h2>
    @include('event.bible_reading.part.flash')

    {{ Form::open(['url' => '/event/bible_reading/nric', 'method' => 'post', 'class' => 'ui inverted form', 'id' => 'bible-reading-signup']) }}

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
      

      <div class="ui hidden divider"></div>

      <div class="field">
        <button class="ui inverted basic fluid huge button">{{trans('event.bible_reading.login')}}</button>
      </div>
    {{ Form::close() }}
  </div>
@endsection