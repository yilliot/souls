@extends('future_fund.member.layout')

@section('title')
Future Fund
@endsection

@section('content')
<h1 id="header" class="header bg-size">距离目标 <br> RM {{number_format($session_total-$session_collected, 2)}} </h1>
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

<div class="ui horizontal divider">{{$pledge->name}}'s <br> Pledge details 细明 </div>

<table class="ui unstackable table">
  <thead>
    <tr>
      <th class="center aligned">总数 <br> Total Pledge</th>
      <th class="center aligned">已收 <br> Collected</th>
      <th class="center aligned">尚差 <br> Remain</th>
    </tr>
  </thead>
  <tr>
    <td class="center aligned">RM {{number_format($pledge_total, 2)}}</td>
    <td class="center aligned">RM {{number_format($pledge_collected, 2)}}</td>
    <td class="center aligned">RM {{number_format(($pledge_total - $pledge_collected), 2)}}</td>
  </tr>
</table>

<table class="ui unstackable compact table">
  <thead>
    <tr>
      <th class="center aligned">Date</th>
      <th class="center aligned">Amount</th>
      <th class="center aligned">Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($payments as $payment)
    <tr class="{{$payment->is_cleared ? 'positive' : ''}} {{!$payment->is_cleared && !$payment->is_cancelled ? 'negative' : ''}}">
      <td>
        {{$payment->created_at->format('jS M, D') }} <br>
        <span class="ui mini label">{{$payment->created_at->diffForHumans()}}</span>
      </td>
      <td class="right aligned" style="width:140px;">
        @if ($payment->is_cancelled)
          <span style="text-decoration: line-through; color: #AAA;">
            RM {{number_format($payment->amount, 2)}}
          </span>
        @else
          RM {{number_format($payment->amount, 2)}}
        @endif
      </td>
      <td class="center aligned">
        @if ($payment->is_cleared)
          <ui class="ui teal small label">CLEARED</ui>
        @else
          @if ($payment->is_cancelled)
            <ui class="ui grey small label">CANCELLED</ui>
          @else
            <ui class="ui yellow small label">FLOAT</ui>
          @endif
        @endif
      </td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <th>Total</th>
      <th colspan="2" class="right aligned"> RM {{number_format($payments->where('is_cancelled', false)->sum('amount'), 2)}} </th>
    </tr>
  </tfoot>
</table>
<a href="/ff/{{$ff_code}}/{{$pledge_code}}/payment" class="ui small fluid teal big button">记录缴付 Record payment</a>

<div style="padding-top: 50px"></div>

@endsection