@extends('event.just_begin.layout')

@section('title')
3KM Check in
@endsection

@section('content')
  <div id="signup-container" class="ui piled inverted segment text container">

    <a href="/session/lang/zh">中文</a> |
    <a href="/session/lang/en">English</a>

    <h1 class="ui center aligned icon header">
      <div>
        <img id="logo" src="/images/hcc-logo-black320.png" alt="HCCJB">
      </div>
      <div class="neon-green content">
          <span class="glow">3KM {{trans('event.just_begin.checkin')}}</span>
          <div class="sub neon-green header">
            {{trans('event.just_begin.just_begin')}}
          </div>
        </div>
    </h1>
    @include('event.just_begin.part.flash')
    {{ Form::open(['url' => '/event/3km/checkin', 'method' => 'post', 'class' => 'ui inverted form', 'id' => 'just-begin-checkin', 'files' => true]) }}

      <div class="field {{$errors->has('nric') ? 'error' : ''}}">
        <label>{{ trans('event.just_begin.nric') }}</label>
        <div class="ui left icon input">
          {{ Form::text('nric', session('nric'), ['placeholder' => 'e.g : 901001-01-1234 / S01234567B'])}}
          <i class="user icon"></i>
        </div>
        @if ($errors->has('nric'))
          <label > * {{ $errors->first('nric') }}</label>
        @endif
      </div>

      <div class="field {{$errors->has('km') ? 'error' : ''}}">
        <label>{{ trans('event.just_begin.meters') }} ({{ trans('event.just_begin.in_km') }} )</label>
        <div class="ui right labeled left icon input">
          <i class="road icon"></i>
          <input type="number" name="km" step="0.001" class="text-centered" value="{{old('km')}}" placeholder="e.g : 3.52">
          <div class="ui label">KM</div>
        </div>
        @if ($errors->has('km'))
          <label > * {{ $errors->first('km') }}</label>
        @endif
      </div>

      <div class="field {{$errors->has('screenshot_path') ? 'error' : ''}}">
        <label>{{ trans('event.just_begin.screenshot_path') }}</label>
        <div class="ui left icon input">
          <input name="screenshot_path" type="file">
          <i class="photo icon"></i>
        </div>
        @if ($errors->has('screenshot_path'))
          <label > * {{ $errors->first('screenshot_path') }}</label>
        @endif
      </div>

      <div class="ui hidden divider"></div>

      <div class="field">
        <button class="ui inverted basic fluid huge button">{{trans('event.just_begin.checkin')}}</button>
      </div>
      <div class="field">
        <a href="/event/3km/signup">{{trans('event.just_begin.signup_now')}}</a>
      </div>
    </form>
  </div>
@endsection