@extends('auth.layout')

@section('title')
    {{trans('attendance.forecast.title')}} @parent
@endsection

@section('content-blank')
<h2> {{ trans('attendance.forecast.greet') }} </h2>

<div class="header">{{$service->topic}}</div>
<div>{{$service->at->format('(D) d M, h:iA')}} @ {{$service->venue}}</div>

<div class="ui divider"></div>

<h2>You're <span id="user_action">not responsed yet.</span></h2>

<form action="/attendance/forecast/service/{{$service->id}}" class="ui form">
  {{csrf_field()}}
  <div class="ui fluid buttons">
    <button class="ui positive button">Going</button>
    <button class="ui negative button">Not going</button>
    <button class="ui button">To be confirmed</button>
  </div>
</form>

<h2 class="ui header">What's up, {{$cg}}!
  <div class="sub header">3 Going</div>
</h2>

<table class="ui very basic very compact unstackable table">
  <tbody>
  @foreach ($members as $member)
    <tr>
      <td>{{$member}}</td>
      <td class="positive">
        <i class="circle icon"></i>
        <i class="circle outline icon"></i>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>

@endsection