@extends('auth.layout')

@section('title')
    {{trans('attendance.forecast.title')}} @parent
@endsection

@section('content-blank')
<h1> {{ trans('attendance.forecast.greet') }} </h1>

<div class="ui cards">
  @foreach ($services as $service)
  <div class="ui fluid card">
    <div class="content">
      <div class="header">{{$service->topic}}</div>
      <div class="description">
        <div>{{$service->at->format('(D) d M, h:iA')}} @ {{$service->venue}}</div>
        <div>{{$service->speaker}}</div>
      </div>
    </div>
    <a href="/attendance/forecast/service/{{$service->id}}" class="ui bottom attached primary button">
      <i class="eye icon"></i>
      RSVP
    </a>
  </div>
  @endforeach

</div>

@endsection