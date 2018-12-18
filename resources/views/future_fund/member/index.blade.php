@extends('future_fund.member.layout')

@section('title')
Future Fund
@endsection

@section('content')
<h1 id="header" class="header bg-size">距离目标尚差 <br> RM {{number_format($session_total-$session_collected, 2)}} </h1>
<div class="bg-size bg-image bg-image-fade"></div>
<div class="bg-size bg-image" style="width:{{$session_collected/$session_total*100}}%"></div>
<div style="padding-top: 200px"></div>
<div style="clear:both"></div>

<div style="float:left">
  <h4 class="ui header">已收 Collected Amount</h4>
  <div>RM {{number_format($session_collected, 2)}}</div>
</div>
<div style="float:right; text-align: right">
  <h4 class="ui header">总数 Total Pledge</h4>
  <div>RM {{number_format($session_total, 2)}}</div>
</div>
<div style="clear:both"></div>
<div class="ui indicating progress" data-percent="{{$session_collected/$session_total*100}}">
  <div class="bar">
    <div class="progress"></div>
  </div>
  <div class="label">{{$session->name}}</div>
</div>
<div style="padding-top: 10px"></div>


@endsection
