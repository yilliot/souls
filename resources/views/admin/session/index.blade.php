@extends('admin.layout')
@section('title')
Sessions
@endsection
@section('content')
<a href="/admin/session/add" class="ui teal button right floated">Create session</a>
<h1 class="ui header">Sessions</h1>
<div class="ui segment">
  {!! Form::open(['url' => url()->current(), 'class' => 'ui form', 'method' => 'GET']) !!}
    <div class="inline field">
      <label for="">From</label>
      <input type="date" name="onward" value="{{$filter['onward']}}">
      <label for="">Onward</label>
    </div>
    <div class="clearfix field">
      <a href="{{ url()->current() }}" class="ui basic right floated right labeled icon tiny button">
        Reset <i class="undo icon"></i>
      </a>
      <button class="ui teal right floated right labeled icon tiny button">
        Filter <i class="filter icon"></i>
      </button>
      <div class="ui hidden divider"></div>
      <div class="ui hidden divider"></div>
    </div>
  {!! Form::close() !!}
</div>
<table class="ui table">
  <thead>
    <tr>
      <th>When</th>
      <th class="three wide">Topic</th>
      <th>Speaker/Host</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
  @forelse ($chunk_sessions as $key => $sessions)
    <thead>
      <tr>
        <th colspan="5" class="center aligned">
          {{$key}}
        </th>
      </tr>
    </thead>
    @foreach ($sessions as $session)
      <tr>
        <td>
          {{$session->start_at->format('M d')}}
          @if ($session->is_church_wide)
            <i class="teal users icon"></i>
          @endif
          <br> {{$session->start_at->format('h:i a')}}
        </td>
        <td>
          <h4 class="ui header">
            {{$session->title}}
            <div class="sub header">
              {{$session->type}}
            </div>
          </h4>
        </td>
        <td> {{$session->speaker}} </td>
        <td>
          <div class="ui small icon buttons">
            <a href="/admin/session/edit/{{$session->id}}" class="ui teal button">
              <i class="edit icon"></i>
            </a>
            <a href="/admin/session/{{$session->id}}/invitations" class="ui orange button">
              <i class="users icon"></i>
            </a>
          </div>
        </td>
      </tr>
    @endforeach
  @empty
    <tr>
      <td colspan="5"> No sessions, change filter or come back later </td>
    </tr>
  @endforelse
  </tbody>
</table>
{{ $page_sessions->links() }}
@endsection
