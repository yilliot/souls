@extends('event.bible_reading.layout')

@section('title')
Bible Reading Home
@endsection

@section('content')

  <a href="/event/bible_reading/checkin"> {{trans('event.bible_reading.checkin')}} </a> | 
  <a href="/event/bible_reading/history/my"> {{trans('event.bible_reading.my_record')}} </a> |
  <a href="/event/bible_reading/logout"> {{trans('event.bible_reading.logout')}} </a> 

  @include('event.bible_reading.part.logo')
  @include('event.bible_reading.part.flash')
  @include('event.bible_reading.part.progress', ['amount' => $amount])
  
  <div class="ui header">
    {{ trans('event.bible_reading.old_test') }}
  </div>
  <div class="ui styled fluid accordion">
  @foreach($old_test as $book => $chapter)
    <div class="title">
        <i class="dropdown icon"></i>
        {{ trans('event.bible_reading.bible_books.' . $book) }}
    </div>
    <div class="content">
      <div class="">
        <div style="display: flex;justify-content: center;flex-wrap: wrap;">
        @for($i = 1 ;$i <= $chapter; $i++)
            <a style="display:block; min-width: 40px; padding: 12px 0;margin-bottom: 6px" href="{{Request::url()}}/{{$book}}/{{$i}}" class="ui {{ $status[$book][$i] ? 'black':'' }} circular button">{{$i}}</a>
        @endfor
        </div>
      </div>
    </div>
  @endforeach
  </div>
  <div class="ui header">
    {{ trans('event.bible_reading.new_test') }}
  </div>
  <div class="ui styled fluid accordion">
  @foreach($new_test as $book => $chapter)
    <div class="title">
        <i class="dropdown icon"></i>
        {{ trans('event.bible_reading.bible_books.' . $book) }}
    </div>
    <div class="content">
      <div class="">
        <div style="display: flex;justify-content: center;flex-wrap: wrap;">
        @for($i = 1 ;$i <= $chapter; $i++)
          <div class="column p-clear">
              <a style="display:block; min-width: 40px; padding: 12px 0;margin-bottom: 6px" href="{{Request::url()}}/{{$book}}/{{$i}}" class="ui {{ $status[$book][$i] ? 'black':'' }} circular button">{{$i}}</a>
          </div>
        @endfor
        </div>
      </div>
    </div>
  @endforeach
  </div>
  <div class="ui hidden divider"></div>
@endsection
