@extends('future_fund.ff2020.layout')

@section('title')
Future Fund
@endsection

@section('content')
<div id="secure" style="z-index:999; position: fixed; top:0;left:0;right:0;">
  @if ($pledge->soul && !$pledge->soul->user)
    <a href="/auth/merge/nric?nric={{$pledge->soul->nric}}" class="ui mini red fluid button">secure your data by adding password</a>
  @elseif(!$pledge->soul)
    <a href="/ff/{{$ff_code}}/{{$pledge->code}}/signup" class="ui mini red fluid button">secure your data with create an account</a>
  @endif
</div>

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
<div class="ui indicating progress" data-percent="{{$session_collected/$session_total*100}}">
  <div class="bar">
    <div class="progress"></div>
  </div>
  <div class="label">{{$session->name}}</div>
</div>
<div style="padding-top: 10px"></div>

<div class="ui horizontal divider">{{$pledge->name}}'s <br> {{trans('futurefund.pledge_details')}} </div>

<table class="ui unstackable table">
  <thead>
    <tr>
      <th class="center aligned"> {{trans('futurefund.total_pledge')}} </th>
      <th class="center aligned"> {{trans('futurefund.collected')}} </th>
      <th class="center aligned"> {{trans('futurefund.balance')}} </th>
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
      <th class="center aligned">{{trans('futurefund.date')}}</th>
      <th class="center aligned">{{trans('futurefund.amount')}}</th>
      <th class="center aligned">{{trans('futurefund.status')}}</th>
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
      <th>{{trans('futurefund.total')}}</th>
      <th colspan="2" class="right aligned"> RM {{number_format($payments->where('is_cancelled', false)->sum('amount'), 2)}} </th>
    </tr>
  </tfoot>
</table>
<a href="/ff/{{$ff_code}}/{{$pledge_code}}/payment" class="ui small fluid teal big button"> {{trans('futurefund.record_payment')}}</a>

<div style="padding-top: 50px"></div>

@endsection