@extends('auth.layout')

@section('title')
    {{trans('attendance.forecast.title')}} @parent
@endsection

@section('content-blank')
<h2> {{ trans('attendance.forecast.greet2') }} </h2>

<div class="header">{{$service->topic}}</div>
<div>{{$service->at->format('(D) d M, h:iA')}} @ {{$service->venue}}</div>

<div class="ui divider"></div>

<h2>{{trans("attendance.forecast.you-re")}}<span id="user_action">{{trans("attendance.forecast.not-responded-yet")}}</span></h2>

<form action="/attendance/forecast/service/{{$service->id}}" class="ui form">
  {{csrf_field()}}
  <div class="ui fluid buttons">
    <button class="ui positive button">{{trans("attendance.forecast.going")}}</button>
    <button class="ui negative button">{{trans("attendance.forecast.not-going")}}</button>
    <button class="ui button">{{trans("attendance.forecast.tbc")}}</button>
  </div>
</form>
<div class="ui hidden divider"></div>
<a class="ui primary fluid mini button" href="/attendance/forecast/service/{{$service->id}}/guests">{{trans("attendance.forecast.bring-someone")}}</a>

<h2 class="ui header">What's up, {{$cg}}!
  <div class="sub header">3 {{trans("attendance.forecast.going")}}</div>
</h2>

<table class="ui very basic very compact unstackable table">
  <tbody>
  @foreach ($members as $member)
    <tr>
      <td>{{$member}} </td>
      <td class="positive">
        {{-- <i class="circle outline icon"></i> --}}
        <i class="circle icon"></i>
      </td>
      <td>
        <div>Guest 01</div>
        <div>Guest 02</div>
        <div>Guest 03</div>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>

@endsection