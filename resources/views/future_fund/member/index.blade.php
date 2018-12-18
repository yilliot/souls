@extends('future_fund.member.layout')

@section('title')
Future Fund
@endsection

@section('content')
<div style="padding-top: 50px"></div>
RM {{$session_collected-$session_total}} to go
<div style="float:left">
  <h4 class="ui header">Collected Amount</h4>
  <div>RM {{$session_collected}}</div>
</div>
<div style="float:right; text-align: right">
  <h4 class="ui header">Total Pledge</h4>
  <div>RM {{$session_total}}</div>
</div>
<div style="clear:both"></div>
<div class="ui indicating progress" data-percent="{{$session_collected/$session_total*100}}">
  <div class="bar">
    <div class="progress"></div>
  </div>
  <div class="label">{{$session->name}}</div>
</div>
<div style="padding-top: 50px"></div>

@endsection
