@extends('event.just_begin.layout')

@section('title')
3KM 成绩单
@endsection

@section('content')
  <div id="signup-container" class="ui piled inverted segment text container">

    <h1 class="ui center aligned icon header">
      <div>
        <img id="logo" src="/images/hcc-logo-black320.png" alt="OASIS">
      </div>
      <div class="neon-green content">
          <span class="glow">3KM</span>
          <div class="sub neon-green header">
            {{trans('event.just_begin.just_begin')}}
          </div>
        </div>
    </h1>
    <h2 class="header">
      成绩单
    </h2>

    @include('event.just_begin.part.flash')
    {{ Form::open(['url' => '/event/3km/claim', 'method' => 'get', 'class' => 'ui inverted form', 'id' => 'just-begin-checkin', 'files' => true]) }}

      <div class="field {{$errors->has('nric') ? 'error' : ''}}">
        <label>{{ trans('event.just_begin.nric') }}</label>
        {{ Form::text('nric', null, ['class' => '', 'placeholder' => 'e.g : 901001-01-1234 / S01234567B'])}}
        @if ($errors->has('nric'))
          <label > * {{ $errors->first('nric') }}</label>
        @endif
      </div>

      <div class="ui hidden divider"></div>

      <div class="field">
        <button class="ui inverted basic fluid huge button">搜索</button>
      </div>
      <div class="field">
        <a href="/event/3km/signup">{{trans('event.just_begin.signup_now')}}</a>
      </div>
    </form>
  </div>
@endsection