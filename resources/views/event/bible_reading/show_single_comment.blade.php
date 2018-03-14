@extends('event.bible_reading.layout')

@section('title')
Bible Reading Record
@endsection

@section('content')
  |
  @if(!session('nric'))
  <a href="/event/bible_reading/signup"> {{trans('event.bible_reading.signup')}} </a> |
  @endif
  <a href="/event/bible_reading/checkin"> {{trans('event.bible_reading.checkin')}} </a> | 
  <a href="/event/bible_reading/history"> {{trans('event.bible_reading.history')}} </a>
  @if(session('nric'))
  | <a href="/event/bible_reading/logout"> {{trans('event.bible_reading.logout')}} </a> 
  @endif 

  @include('event.bible_reading.part.logo')
  @include('event.bible_reading.part.flash')

  @include('event.bible_reading.part.comment', ['comment' => $comment])

  <div class="ui hidden divider"></div>
@endsection
