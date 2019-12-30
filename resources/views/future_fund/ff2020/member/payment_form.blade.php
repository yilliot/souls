@extends('future_fund.ff2020.layout')

@section('title')
Future Fund
@endsection

@section('content')
<h1 id="header" class="header">{{trans('futurefund.target_personal')}} <br> RM {{number_format($pledge->amount-$collected_sum, 2)}} </h1>

<div style="padding-top: 20px"></div>
<div style="clear:both"></div>

<div class="ui horizontal divider">{{$pledge->name}}'s <br> {{trans('futurefund.payment_form')}} </div>

@include('event.bible_reading.part.flash')
<form action="/ff/{{$ff_code}}/{{$pledge_code}}/payment" method="post" class="ui form">
  {{ csrf_field() }}
<div class="ui labeled fluid huge input">
  <div class="ui label">
    RM
  </div>
  <input type="text" name="amount" placeholder="1000.00">
</div>
<div class="ui fluid mini input">
  <input type="text" name="remarks" placeholder=" ** remarks 备注">
</div>
<div style="padding-top: 20px"></div>
<button class="ui secondary huge fluid button">{{trans('futurefund.submit')}}</button>
</form>
<div style="padding-top: 80px"></div>

@endsection