@extends('member.layout')

@section('title')
Forecast
@endsection

@section('content')
  <div id="forecast-container" class="ui piled inverted segment text container">
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
          {{ Form::text('nric', session('nric'), ['placeholder' => 'e.g : 901001-01-1234 / S01234567B'])}}
          <i class="user icon"></i>
        </div>
        @if ($errors->has('nric'))
          <label > * {{ $errors->first('nric') }}</label>
        @endif
      </div>

      <div class="field {{$errors->has('services_id') ? 'error' : ''}}">
        <label>{{ trans('member.forecast.services_to_attend') }}</label>
        @foreach($services as $service)
        <div class="ui checked checkbox">
          <input checked="" type="checkbox">
          <label>{{ $service->at->format('Y-m-j') }}
            @if($service->topic != null)
            :{{ $service->topic }}
            @endif
          </label>
        </div>
        <br>
        @endforeach
        @if ($errors->has('services_id'))
          <label > * {{ $errors->first('services_id') }}</label>
        @endif
      </div>

      <div class="ui hidden divider"></div>

      <div class="field">
        <button class="ui inverted basic fluid huge button">{{trans('event.just_begin.checkin')}}</button>
      </div>
    </form>
  </div>
  </div>
@endsection