@extends('event.bible_reading.layout')

@section('title')
Bible Reading Check in
@endsection

@section('content')
  
	<div id="signup-container" class="ui piled inverted segment text container">

    <a href="/event/bible_reading"> <i class="home icon"></i> </a> |
    <a href="/session/lang/zh">中文</a> |
    <a href="/session/lang/en">English</a> |
    <a href="/event/bible_reading/history"> {{trans('event.bible_reading.history')}} </a>

    @include('event.bible_reading.part.logo')
    @include('event.bible_reading.part.flash')

    <div class="field">
	    <a href="/event/bible_reading/signup">{{trans('event.just_begin.signup_now')}}</a>
	  </div>
	</div>
@endsection
