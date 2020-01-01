@extends('future_fund.ff2020.layout')

@section('title')
Future Fund
@endsection

@section('content')
<h1 id="header" class="header">{{trans('futurefund.target')}} <br> RM {{number_format(250000, 2)}} </h1>

<div style="padding-top: 20px"></div>
<div style="clear:both"></div>

<div style="float:left">
  <h4 class="ui header"> {{trans('futurefund.collected')}} </h4>
  <div>RM {{number_format($session_collected, 2)}}</div>
</div>
<div style="float:right; text-align: right">
  <h4 class="ui header">{{trans('futurefund.total_pledge')}}</h4>
  <div>RM {{number_format($session_total, 2)}}</div>
</div>
<div style="clear:both"></div>
@if ($session_total)
<div class="ui indicating progress" data-percent="{{$session_collected/$session_total*100}}">
  <div class="bar">
    <div class="progress"></div>
  </div>
  <div class="label">{{$session->name}}</div>
</div>
<div style="padding-top: 10px"></div>
@endif


@endsection
