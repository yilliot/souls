@extends('session.layout')

@section('title')
Invitation
@endsection

@section('content')
<style>
  .full-height {
      height: 100vh;
  }

  .flex-center {
      align-items: center;
      display: flex;
      justify-content: center;
  }

  .position-ref {
      position: relative;
  }

  .top-right {
      position: absolute;
      right: 10px;
      top: 18px;
  }

</style>
<div id="secure" style="z-index:999; position: fixed; top:0;left:0;right:0;">
  <a href="/auth/redirect/nric?redirect_url=/invite/member" class="ui mini red fluid button">click here if you're a member</a>
</div>

<div class="ui horizontal divider">church wide public events</div>
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
<textarea id="calendar-link" style='width:100%'>https://calendar.google.com/calendar/ical/kle1k9qibv6pgcu0dvh9gh2gkk%40group.calendar.google.com/public/basic.ics</textarea>
<button class="ui mini teal fluid button" id="calendar-link-button" onclick="copy_link()">Click to Copy Link</button>
<script>
  function copy_link() {
    document.getElementById('calendar-link-button').innerText = 'Link Copied';
    document.getElementById('calendar-link').select();
    document.execCommand("copy");
  }
</script>
<iframe class="full-height" src="https://calendar.google.com/calendar/embed?src=kle1k9qibv6pgcu0dvh9gh2gkk%40group.calendar.google.com&ctz=Asia%2FSingapore" style="border: 0" width="100%" frameborder="0" scrolling="no"></iframe>
@endsection
