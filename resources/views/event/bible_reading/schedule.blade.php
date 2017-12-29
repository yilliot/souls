@extends('event.bible_reading.layout')

@section('title')
Bible Reading Home
@endsection

@section('content')
  
  <div id="signup-container" class="ui piled inverted segment text container">

    <a href="/event/bible_reading"> <i class="home icon"></i> </a> |
    <a href="/session/lang/zh">中文</a> |
    <a href="/session/lang/en">English</a> |
    <a href="/event/bible_reading/signup"> {{trans('event.bible_reading.signup')}} </a> |
    <a href="/event/bible_reading/checkin"> {{trans('event.bible_reading.checkin')}} </a> | 
    <a href="/event/bible_reading/history/my"> {{trans('event.bible_reading.my_record')}} </a>
    | <a href="/event/bible_reading/signout"> {{trans('event.bible_reading.signout')}} </a> 

    @include('event.bible_reading.part.logo')
    @include('event.bible_reading.part.flash')
    
    <table class="ui table">
      <thead>
        <tr>
          <th>Weeks</th>
          <th>Mon</th>
          <th>Tue</th>
          <th>Wed</th>
          <th>Thur</th>
          <th>Fri</th>
          <th>Sat</th>
          <th>Sun</th>
        </tr>
      </thead>
      
    </table>

  </div>
@endsection
