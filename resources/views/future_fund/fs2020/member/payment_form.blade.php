@extends('future_fund.ff2020.layout')

@section('title')
Future Soul
@endsection

@section('content')
<h1 id="header" class="header">{{trans('futuresoul.target_personal')}} <br> {{$pledge->amount-$collected_sum}} </h1>

<div style="padding-top: 20px"></div>
<div style="clear:both"></div>

<div class="ui horizontal divider">{{$pledge->name}}'s <br> {{trans('futuresoul.payment_form')}} </div>

@include('event.bible_reading.part.flash')
<form action="/ff/{{$ff_code}}/{{$pledge_code}}/payment" method="post" class="ui form">
  {{ csrf_field() }}
<div class="ui labeled fluid huge input">
  <input type="text" name="amount" placeholder="1">
  <div class="ui label">
    new soul
  </div>
</div>
<div class="ui fluid mini input">
  <input type="text" name="remarks" placeholder=" ** new friend name 新朋友名字">
</div>
<div style="padding-top: 20px"></div>
<button class="ui secondary huge fluid button">{{trans('futuresoul.submit')}}</button>
</form>
<div style="padding-top: 80px"></div>

@endsection