@extends('event.bible_reading.layout')

@section('title')
Bible Reading Login
@endsection

@section('content')

  @include('event.bible_reading.part.logo')
  
  <h2 class="header">
    {{trans('event.bible_reading.login')}}
  </h2>
  @include('event.bible_reading.part.flash')

  {{ Form::open(['url' => '/event/bible_reading/nric', 'method' => 'post', 'class' => 'ui form', 'id' => 'bible-reading-signup']) }}

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
      <button class="ui black fluid huge button">{{trans('event.bible_reading.login')}}</button>
    </div>
  {{ Form::close() }}
    <div class="ui hidden divider"></div>
@endsection
