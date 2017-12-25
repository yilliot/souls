@extends('event.bible_reading.layout')

@section('title')
Bible Reading Home
@endsection

@section('content')
  
	<div id="signup-container" class="ui piled inverted segment text container">

    <a href="/session/lang/zh">中文</a> |
    <a href="/session/lang/en">English</a> |
    <a href="/event/bible_reading/signup"> {{trans('event.bible_reading.signup')}} </a> |
    <a href="/event/bible_reading/checkin"> {{trans('event.bible_reading.checkin')}} </a> | 
    <a href="/event/bible_reading/history"> {{trans('event.bible_reading.history')}} </a>

    @include('event.bible_reading.part.logo')
    @include('event.bible_reading.part.flash')

    <h2 class="header">{{trans('event.bible_reading.result')}}</h2>
    <div class="ui ordered list">
   
    </div>

    <div class="ui divider"></div>

    <h2 class="header">{{trans('event.bible_reading.today_records')}}</h2>

	</div>
@endsection