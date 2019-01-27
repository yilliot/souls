@extends('session.layout')

@section('title')
Invitation
@endsection

@section('content')

<div id="secure" style="z-index:999; position: fixed; top:0;left:0;right:0;">
  <a href="/auth/redirect/nric?redirect_url=/invite/member" class="ui mini red fluid button">click here if you're a member</a>
</div>

<h1 class="ui header">church wide public events</h1>
<table class="ui very compact unstackable table">
  <thead>
    <tr>
      <th>Date</th>
      <th></th>
      <th>Start at</th>
      <th>Venue</th>
    </tr>
  </thead>
@forelse ($sessions as $session)
  <tr>
    <td>
      <div>{{$session->start_at->format('d M')}}</div>
      <div>{{$session->start_at->format('D')}}</div>
    </td>
    <td>
      {{$session}}
      <div>({{$session->type}})</div>
    </td>
    <td>
      <div>{{$session->start_at->format('h:i A')}}</div>
    </td>
    <td>
      @if ($session->venue)
        {{$session->venue}}
      @endif
    </td>
  </tr>
@empty
  <tr>
    <td>
      No events? impossible. come back later.
    </td>
  </tr>
@endforelse
</table>

    <a href="https://calendar.google.com/calendar/ical/kle1k9qibv6pgcu0dvh9gh2gkk%40group.calendar.google.com/public/basic.ics">Calendar link</a>
    <textarea style='width:100%'>https://calendar.google.com/calendar/ical/kle1k9qibv6pgcu0dvh9gh2gkk%40group.calendar.google.com/public/basic.ics</textarea>
<iframe src="https://calendar.google.com/calendar/embed?src=kle1k9qibv6pgcu0dvh9gh2gkk%40group.calendar.google.com&ctz=Asia%2FSingapore" style="border: 0" width="100%" height="100%" frameborder="0" scrolling="no"></iframe>
@endsection
