@extends('event.bible_reading.layout')

@section('title')
Bible Reading Check in
@endsection

@section('content')
  
  <a href="/event/bible_reading/history"> {{trans('event.bible_reading.history')}} </a>

  @include('event.bible_reading.part.logo')
  @include('event.bible_reading.part.flash')

  {{ Form::open(['url' => '/event/bible_reading/checkin', 'method' => 'post', 'class' => 'ui form', 'id' => 'bible-reading-checkin', 'files' => true]) }}

    <div class="field {{$errors->has('nric') ? 'error' : ''}}">
      <label>{{ trans('event.bible_reading.nric') }}</label>
      <div class="ui left icon input">
        {{ Form::text('nric', session('nric'), ['placeholder' => 'e.g : 901001-01-1234 / S01234567B'])}}
        <i class="user icon"></i>
      </div>
      @if ($errors->has('nric'))
        <label > * {{ $errors->first('nric') }}</label>
      @endif
    </div>

    <div class="field {{$errors->has('check_in_chapter') ? 'error' : ''}}">
      <label>{{ trans('event.bible_reading.check_in_chapter') }}</label>
      <div class="ui field fluid input">

        {{ Form::select('book', 
           $books
        , null, ['class'=>'ui compact search dropdown fluid', 'id' => 'books', 'placeholder' => trans('event.bible_reading.book')] ) }}
        
      </div>

      <div class="ui field">
        <div class="ui doubling eight column grid m-auto" id="chapters" data-comment="{{ trans('event.bible_reading.comment') }}" data-comment-placeholder="{{ trans('event.bible_reading.comment_placeholder') }}"></div>
      </div>

      @if ($errors->has('check_in_chapter'))
        <label > * {{ $errors->first('check_in_chapter') }}</label>
      @endif
    </div>

    <div class="ui hidden divider"></div>

    <div class="field">
      <button class="ui black fluid huge button">{{trans('event.bible_reading.checkin')}}</button>
    </div>
    <div class="field">
      <a href="/event/bible_reading/signup">{{trans('event.bible_reading.signup_now')}}</a>
    </div>
  </form>
  <div class="ui hidden divider"></div>
@endsection