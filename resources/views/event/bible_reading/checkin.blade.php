@extends('event.bible_reading.layout')

@section('title')
Bible Reading Check in
@endsection

@section('content')
  
  <div id="signup-container" class="ui inverted segment text container">

    <a href="/event/bible_reading"> <i class="home icon"></i> </a> |
    <a href="/session/lang/zh">中文</a> |
    <a href="/session/lang/en">English</a> |
    <a href="/event/bible_reading/history"> {{trans('event.bible_reading.history')}} </a>

    @include('event.bible_reading.part.logo')
    @include('event.bible_reading.part.flash')

    {{ Form::open(['url' => '/event/bible_reading/checkin', 'method' => 'post', 'class' => 'ui inverted form', 'id' => 'bible-reading-checkin', 'files' => true]) }}

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
          <div class="ui doubling eight column grid m-auto" id="chapters"></div>
          <div class="ui horizontal divider font-white">Remark</div>
          <div class="ui red fluid button">{{ trans('event.bible_reading.main_chapter') }}</div>
          <div class="ui primary fluid button">{{ trans('event.bible_reading.secondary_chapter') }}</div>
        </div>

        @if ($errors->has('check_in_chapter'))
          <label > * {{ $errors->first('check_in_chapter') }}</label>
        @endif
      </div>

      <div class="field {{$errors->has('comment') ? 'error' : ''}}">
        <label>{{ trans('event.bible_reading.comment') }}</label>
        <div class="ui fluid input">
          {{ Form::textarea('comment') }}
        </div>
        @if ($errors->has('comment'))
          <label > * {{ $errors->first('comment') }}</label>
        @endif
      </div>

      <div class="ui hidden divider"></div>

      <div class="field">
        <button class="ui inverted basic fluid huge button">{{trans('event.bible_reading.checkin')}}</button>
      </div>
      <div class="field">
        <a href="/event/bible_reading/signup">{{trans('event.bible_reading.signup_now')}}</a>
      </div>
    </form>
  </div>
@endsection