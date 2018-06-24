@extends('auth.layout')

@section('title')
    {{trans('attendance.forecast.title')}} @parent
@endsection

@section('content-blank')
<h2> {{ trans('attendance.forecast.guest.greet') }} </h2>

<div class="header">{{$service->topic}}</div>
<div>{{$service->at->format('(D) d M, h:iA')}} @ {{$service->venue}}</div>

<div class="ui divider"></div>

<h2>I'm bringing...</h2>
<form action="/attendance/forecast/service/{{$service->id}}" class="ui form">
  {{csrf_field()}}
  <div class="ui labeled icon mini fluid button clone-next">
    <i class="add icon"></i> add one more
  </div>
  <div class="field"><input type="text" placeholder="name of your friend"></div>
  <button class="ui primary fluid button">Ok</button>
</form>
@endsection