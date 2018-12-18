@extends('future_fund.member.layout')

@section('title')
Future Fund
@endsection

@section('content')

<h1 id="header" class="header bg-size">个人目标尚差 <br> RM {{number_format($pledge->amount-$collected_sum, 2)}} </h1>
<div class="bg-size bg-image bg-image-fade"></div>
<div class="bg-size bg-image" style="width:{{$collected_sum/$pledge->amount*100}}%"></div>
<div style="padding-top: 200px"></div>
<div style="clear:both"></div>

<div class="ui horizontal divider">{{$pledge->name}}'s <br> 缴付表 </div>

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
<button class="ui secondary huge fluid button">Pay 缴付</button>
</form>
<div style="padding-top: 80px"></div>

@endsection