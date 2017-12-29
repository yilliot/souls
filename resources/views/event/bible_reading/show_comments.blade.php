@extends('event.bible_reading.layout')

@section('title')
Bible Reading Home
@endsection

@section('content')
  
	<div id="signup-container" class="ui inverted segment text container">

    <a href="/event/bible_reading"> <i class="home icon"></i> </a> |
    <a href="/session/lang/zh">中文</a> |
    <a href="/session/lang/en">English</a> |
    <a href="/event/bible_reading/checkin"> {{trans('event.bible_reading.checkin')}} </a> | 
    <a href="/event/bible_reading/history"> {{trans('event.bible_reading.history')}} </a> |
    @if($type != 'soul')
    <a href="/event/bible_reading/history/my"> {{trans('event.bible_reading.my_record')}} </a> |
    @endif
    <a href="/event/bible_reading/logout"> {{trans('event.bible_reading.logout')}} </a> 

    @include('event.bible_reading.part.logo')
    @include('event.bible_reading.part.flash')
    @if(isset($amount))
    @include('event.bible_reading.part.progress', ['amount' => $amount])
    @endif

    @forelse($comments as $comment)
    @include('event.bible_reading.part.comment', ['comment' => $comment])
    @empty
    <tr>
      <td colspan="4">
        <div class="ui inverted red basic segment">
          @if($type == 'chapter')
          {{trans('event.bible_reading.chapter_no_result')}}
          @else
          {{trans('event.bible_reading.soul_no_result')}}
          @endif
        </div>
      </td>
    </tr>
    @endforelse
    

	</div>
@endsection
