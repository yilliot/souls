@extends('admin.layout')
@section('title')
Add service
@endsection
@section('content')
<div class="ui text container">
  <h1 class="ui header">Add service</h1>
  {!! Form::open(['url' => 'admin/service/', 'method' => 'POST', 'class' => 'ui form']) !!}
  <table class="ui structured table">
    <tr>
      <td><b>Service Date</b></td>
      <td class="twelve wide">
        <input type="date" name="at">
      </td>
    </tr>
    <tr>
      <td><b>Service Time</b></td>
      <td>
        <input type="time" name="at_time" value="17:00">
      </td>
    </tr>
    <tr>
      <td><b>Type</b></td>
      <td>
        {{ Form::select('type', \App\Models\ServiceType::all()->pluck('name', 'id'), null, ['class' => 'ui fluid dropdown']) }}
      </td>
    </tr>
    <tr>
      <td><b>Speaker</b></td>
      <td>
        {{ Form::select('speaker', \App\Models\ServiceSpeaker::all()->pluck('name', 'id'), null, ['class' => 'ui fluid dropdown'] ) }}
      </td>
    </tr>
    <tr>
      <td><b>Venue</b></td>
      <td>
        {{ Form::select('venue', \App\Models\ServiceVenue::all()->pluck('name', 'id'), null, ['class' => 'ui fluid dropdown'] ) }}
      </td>
    </tr>
    <tr>
      <td><b>Topic</b></td>
      <td>
        {{ Form::text('topic') }}
      </td>
    </tr>
    <tfoot class="full-width">
      <tr>
        <th colspan="2">
          <button type="submit" class="ui purple labeled icon button">
            Add <i class="plus icon"></i>
          </button>
          <a href="/admin/service/" class="ui cancel basic button">
            Back to services
          </a>
        </th>
      </tr>
    </tfoot>
  </table>
  {!! Form::close() !!}
</div>
@endsection
