@extends('admin.layout')
@section('title')
Update service
@endsection
@section('content')
<div class="ui text container">
  <h1 class="ui header">Update service</h1>
  {!! Form::open(['url' => 'admin/service/'.$service->id, 'method' => 'POST', 'class' => 'ui form']) !!}
  {{ method_field('PUT') }}
  <table class="ui structured table">
    <tr>
      <td><b>Service Date</b></td>
      <td class="twelve wide">
        <input type="date" name="at" value="{{ $service->at->toDateString() }}">
      </td>
    </tr>
    <tr>
      <td><b>Type</b></td>
      <td>
        {{ Form::select('type', \App\Models\ServiceType::all()->pluck('name', 'id'), $service->type_id, ['class' => 'ui fluid dropdown']) }}
      </td>
    </tr>
    <tr>
      <td><b>Speaker</b></td>
      <td>
        {{ Form::select('speaker', \App\Models\ServiceSpeaker::all()->pluck('name', 'id'), $service->speaker, ['class' => 'ui fluid dropdown'] ) }}
      </td>
    </tr>
    <tr>
      <td><b>Venue</b></td>
      <td>
        {{ Form::select('venue', \App\Models\ServiceVenue::all()->pluck('name', 'id'), $service->venue_id, ['class' => 'ui fluid dropdown'] ) }}
      </td>
    </tr>
    <tr>
      <td><b>Topic</b></td>
      <td>
        {{ Form::text('topic', $service->topic, ['class' => 'ui input']) }}
      </td>
    </tr>
    <tfoot class="full-width">
      <tr>
        <th colspan="2">
          <button type="submit" class="ui purple labeled icon button">
            Save <i class="plus icon"></i>
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
