@extends('member.layout')

@section('title')
Forecast
@endsection

@section('content')
  <div id="forecast-container" class="ui piled inverted segment text container">
    <a href="/session/lang/zh">中文</a> |
    <a href="/session/lang/en">English</a>
    <h1 class="ui center aligned icon header">
      <div>
        <img id="logo" src="/images/hcc-logo-black320.png" alt="HCCJB">
      </div>
      <div class="neon-green content">
          <span class="glow">Forecast</span>
          <div class="sub neon-green header">
          </div>
        </div>
    </h1>
    @include('member.part.flash')
    {{ Form::open(['url' => '/member/forecast', 'method' => 'post', 'class' => 'ui inverted form', 'id' => 'member-forecast', 'files' => true]) }}

      <div class="field {{$errors->has('nric') ? 'error' : ''}}">
        <label>{{ trans('member.forecast.nric') }}</label>
        <div class="ui left icon input">
          {{ Form::text('nric', session('nric'), ['id' => 'nric','placeholder' => 'e.g : 901001-01-1234 / S01234567B'])}}
          <i class="user icon"></i>
        </div>
        @if ($errors->has('nric'))
          <label > * {{ $errors->first('nric') }}</label>
        @endif
      </div>

      <div class="ui hidden divider"></div>

      <div class="field">
        <button class="ui inverted basic fluid huge button">{{trans('member.forecast.register')}}</button>
      </div>
    </form>
  </div>
@endsection

@section('script')
  <script src="/js/member.forecast.js"></script>
@endsection