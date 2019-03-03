@extends('admin.layout')
@section('title')
Create session
@endsection
@section('content')
<div class="ui text container">
  <h1 class="ui header">Create session</h1>
  {!! Form::open(['url' => 'admin/session/add', 'method' => 'POST', 'class' => 'ui form']) !!}
  <table class="ui structured table">
    <tr>
      <td><b>Type</b></td>
      <td>
        {{ Form::select('type', \App\Models\Session\SessionType::all()->pluck('name', 'id')->prepend(['0'=>'-']), null, ['class' => 'ui fluid dropdown', 'id' => 'input-type']) }}
      </td>
    </tr>
    <tr id="input-row-cg" class="hide">
      <td><b>Connect Group ?</b></td>
      <td>
        {{ Form::select('cg_id', \App\Models\CG::all()->pluck('name', 'id')->prepend(['0'=>'-']), null, ['class' => 'ui fluid dropdown']) }}
      </td>
    </tr>
    <tr>
      <td><b>Start Date</b></td>
      <td class="twelve wide">
        <input type="date" name="start_date">
      </td>
    </tr>
    <tr>
      <td><b>Start Time</b></td>
      <td>
        <input type="time" name="start_time" value="17:00">
      </td>
    </tr>
    <tr>
      <td><b>End Date</b></td>
      <td class="twelve wide">
        <input type="date" name="end_date">
      </td>
    </tr>
    <tr>
      <td><b>End Time</b></td>
      <td>
        <input type="time" name="end_time" value="19:00">
      </td>
    </tr>
    <tr>
      <td><b>Speaker</b></td>
      <td>
        {{ Form::select('speaker', \App\Models\Session\SessionSpeaker::all()->pluck('name', 'id')->prepend(['0'=>'-']), null, ['class' => 'ui fluid dropdown'] ) }}
      </td>
    </tr>
    <tr>
      <td><b>Venue</b></td>
      <td>
        {{ Form::select('venue', \App\Models\Session\SessionVenue::all()->pluck('name', 'id')->prepend(['0'=>'-']), null, ['class' => 'ui fluid dropdown'] ) }}
      </td>
    </tr>
    <tr>
      <td><b>Title</b></td>
      <td>
        {{ Form::text('title') }}
      </td>
    </tr>
    <tr>
      <td><b>Is Church Wide</b></td>
      <td>
        {{ Form::select('is_church_wide', \App\Enums\Boolean::all(), null, ['class' => 'ui fluid dropdown', 'id' => 'input-is_church_wide']) }}
      </td>
    </tr>
    <tr>
      <td><b>Remarks</b></td>
      <td>
        <textarea name="remarks" rows="3">{{old('remarks')}}</textarea>
      </td>
    </tr>
    <tfoot class="full-width">
      <tr>
        <th colspan="2">
          <button type="submit" class="ui purple labeled icon button">
            Create <i class="plus icon"></i>
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

@section('script')
<script>
  $(function(){
    let input_is_church_wide = $('#input-is_church_wide').dropdown();
    $('#input-type').change(function(obj) {
      document.getElementById('input-row-cg').classList.add("hide");
      if (obj.target.value == '4')
        document.getElementById('input-row-cg').classList.remove("hide");

      if (obj.target.value == '4') {
        input_is_church_wide.set('selected', 0);
        alert(document.getElementById('input-is_church_wide').value);
      }
      else {
        input_is_church_wide.set('selected', 1);
        alert(document.getElementById('input-is_church_wide').value);
      }
    });
  });
</script>
@endsection
