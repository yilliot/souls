@extends('future_fund.ff2020.layout')

@section('title')
Future Fund
@endsection

@section('content')

<div class="ui horizontal divider">{{$pledge->name}}'s {{trans('futuresoul.pledge_amount')}} </div>

@include('event.bible_reading.part.flash')
<form action="/ff/{{$ff_code}}/{{$pledge->code}}/amount" method="post" class="ui form">
  {{ csrf_field() }}
<div class="ui labeled fluid huge input">
  <input type="text" name="amount" placeholder="5">
  <div class="ui label">
    new souls
  </div>
</div>
<div class="ui fluid mini input">
  <div>remarks : {!!nl2br($pledge->remarks)!!}</div>
</div>
<button class="ui secondary huge fluid button">{{trans('futuresoul.submit')}}</button>
</form>
<div style="padding-top: 80px"></div>

@endsection