@extends('admin.layout')
@section('title')
Update session
@endsection
@section('content')
<div class="ui text container">
  <h1 class="ui header">Update session</h1>
  {!! Form::open(['url' => 'admin/session/edit/'.$session->id, 'method' => 'POST', 'class' => 'ui form']) !!}
  <table class="ui structured table">
    <tr>
      <td><b>Start Date</b></td>
      <td class="twelve wide">
        <input type="date" name="start_date" value="{{ $session->start_at->toDateString() }}">
      </td>
    </tr>
    <tr>
      <td><b>Start Time</b></td>
      <td>
        <input type="time" name="start_time" value="{{ $session->start_at->toTimeString() }}">
      </td>
    </tr>
    <tr>
      <td><b>End Date</b></td>
      <td class="twelve wide">
        <input type="date" name="end_date" value="{{ $session->end_at ? $session->end_at->toDateString() : '' }}">
      </td>
    </tr>
    <tr>
      <td><b>End Time</b></td>
      <td>
        <input type="time" name="end_time" value="{{ $session->end_at ? $session->end_at->toTimeString() : '' }}">
      </td>
    </tr>
    <tr>
      <td><b>Type</b></td>
      <td>
        {{ Form::select('type', \App\Models\Session\SessionType::all()->pluck('name', 'id'), $session->type_id, ['class' => 'ui fluid dropdown']) }}
      </td>
    </tr>
    <tr>
      <td><b>Speaker</b></td>
      <td>
        {{ Form::select('speaker', \App\Models\Session\SessionSpeaker::all()->pluck('name', 'id'), $session->speaker_id, ['class' => 'ui fluid dropdown'] ) }}
      </td>
    </tr>
    <tr>
      <td><b>Venue</b></td>
      <td>
        {{ Form::select('venue', \App\Models\Session\SessionVenue::all()->pluck('name', 'id'), $session->venue_id, ['class' => 'ui fluid dropdown'] ) }}
      </td>
    </tr>
    <tr>
      <td><b>Title</b></td>
      <td>
        {{ Form::text('title', $session->title, ['class' => 'ui input']) }}
      </td>
    </tr>
    <tr>
      <td><b>Is Church Wide</b></td>
      <td>
        {{ Form::select('is_church_wide', \App\Enums\Boolean::all(), $session->is_church_wide, ['class' => 'ui fluid dropdown']) }}
      </td>
    </tr>
    <tr>
      <td><b>Connect Group ?</b></td>
      <td>
        {{ Form::select('cg_id', \App\Models\CG::all()->pluck('name', 'id')->prepend(['0'=>'-']), $session->cg_id, ['class' => 'ui fluid dropdown']) }}
      </td>
    </tr>
    <tfoot class="full-width">
      <tr>
        <th colspan="2">
          <button type="submit" class="ui purple labeled icon button">
            Update <i class="plus icon"></i>
          </button>
          <a href="/admin/session/" class="ui cancel basic button">
            Back to sessions
          </a>
        </th>
      </tr>
    </tfoot>
  </table>
  {!! Form::close() !!}
</div>
@endsection
