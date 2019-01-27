@extends('session.layout')

@section('title')
Invitation
@endsection

@section('content')

<div id="secure" style="z-index:999; position: fixed; top:0;left:0;right:0;">
  {{-- <a href="/auth/redirect/nric?redirect_url=/invite/member" class="ui mini red fluid button">click here if you're a member</a> --}}
</div>

<div class="ui horizontal divider">{{$soul}}'s calendar</div>
<table class="ui very compact unstackable table">
  <thead>
    <tr>
      <th>Date</th>
      <th></th>
      <th>Time/Venue</th>
      <th>RSVP</th>
    </tr>
  </thead>
@forelse ($sessions as $session)
  @php
    $invitation = $invitations->where('session_id', $session->id)->first();
    $color = '';
    if ($invitation) {
      if ($invitation->is_coming === 0) $color = 'negative';
      elseif ($invitation->is_coming === 1) $color = 'positive';
    }
  @endphp
  <tr class="{{$color}}">
    <td>
      <div>{{$session->start_at->format('d M')}}</div>
      <div>{{$session->start_at->format('D')}}</div>
    </td>
    <td>
      {{$session}}
      @if ($session->type)
        <div>({{$session->type}})</div>
      @endif
    </td>
    <td>
      <div>{{$session->start_at->format('h:i A')}}</div>
      @if ($session->venue)
        <div>{{$session->venue}}</div>
      @endif
    </td>
    <td>
      <form action="/invite/response" method="POST">
      {{ csrf_field() }}
      <input type="hidden" name="session_id" value="{{$session->id}}">
      <input type="hidden" name="soul_id" value="{{$soul->id}}">
      <div class="ui mini buttons">
      @if ($invitation)
        @if ($invitation->is_coming === 0)
          <button type='submit' name='action' value="1" class="ui teal button">changed mind, going</button>
        @elseif ($invitation->is_coming === 1)
          <button type='submit' name='action' value="0" class="ui pink button">changed mind, not going</button>
        @else
          <button type='submit' name='action' value="1" class="ui teal button">Going</button>
          <button type='submit' name='action' value="0" class="ui pink button">Not Going</button>
        @endif
      @else
        <button type='submit' name='action' value="1" class="ui teal button">Going</button>
        <button type='submit' name='action' value="0" class="ui pink button">Not Going</button>
      @endif
      </div>
      </form>
      <div>
        @if ($invitation)
          @if ($invitation->is_coming === 0)
            <div>not going</div>
          @elseif ($invitation->is_coming === 1)
            <div>going</div>
          @else
            please response
          @endif
        @else
          please response
        @endif

      </div>
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

@endsection
