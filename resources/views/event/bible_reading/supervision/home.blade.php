@extends('event.bible_reading.supervision.layout')

@section('title')
Cellgroup Leader Supervision
@endsection

@section('content')

@include('event.bible_reading.part.logo')

<div class="ui hidden divider"></div>
<a href="{{ Request::url() }}?cellgroup=1" class="ui fluid button">W1</a>
<div class="ui hidden divider"></div>
<a href="{{ Request::url() }}?cellgroup=2" class="ui fluid button">S1</a>
<div class="ui hidden divider"></div>
<a href="{{ Request::url() }}?cellgroup=3" class="ui fluid button">E1</a>
<div class="ui hidden divider"></div>
<a href="{{ Request::url() }}?cellgroup=4" class="ui fluid button">E1</a>
<div class="ui hidden divider"></div>
  
@endsection
