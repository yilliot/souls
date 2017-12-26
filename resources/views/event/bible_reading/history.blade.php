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
    @include('event.bible_reading.part.progress', ['amount' => $amount])
    
    <div class="ui styled fluid accordion">
      <div class="active title">
        <i class="dropdown icon"></i>
        {{ trans('event.bible_reading.old_test') }}
      </div>
      <div class="active content">
        <div class="accordion">
        @foreach($old_test as $book => $chapter)
          <div class="title">
              <i class="dropdown icon"></i>
              {{ trans('event.bible_reading.bible_books.' . $book) }}
          </div>
          <div class="content">
            <div class="ui doubling eight column grid m-auto">
            @for($i = 1 ;$i <= $chapter; $i++)
              <div class="column p-clear">
                
                <a href="{{Request::url()}}/{{$book}}/{{$i}}" class="ui chapter {{ $status[$book][$i-1] ? 'red':'' }} button">{{$i}}</a>
              </div>
            @endfor
            </div>
          </div>
        @endforeach
        </div>
      </div>
      <div class="title">
        <i class="dropdown icon"></i>
        {{ trans('event.bible_reading.new_test') }}
      </div>
      <div class="content">
        <div class="accordion">
        @foreach($new_test as $book => $chapter)
          <div class="title">
              <i class="dropdown icon"></i>
              {{ trans('event.bible_reading.bible_books.' . $book) }}
          </div>
          <div class="content">
            <div class="ui doubling eight column grid m-auto">
            @for($i = 1 ;$i <= $chapter; $i++)
              <div class="column p-clear">
                <a href="{{Request::url()}}/{{$book}}/{{$i}}" class="ui chapter {{ $status[$book][$i-1] ? 'red':'' }} button">{{$i}}</a>
              </div>
            @endfor
            </div>
          </div>
        @endforeach
        </div>
      </div>
    </div>

	</div>
@endsection
