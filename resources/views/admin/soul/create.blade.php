@extends('admin.layout')
@section('title')
Add soul
@endsection
@section('content')
<div class="ui text container">
  <h1 class="ui header">Add soul</h1>
  {!! Form::open(['url' => 'admin/soul/', 'method' => 'POST', 'class' => 'ui form']) !!}
  <table class="ui structured table">
    <tr>
      <td><b>Cellgroup</b></td>
      <td>
        {{ Form::select('cellgroup', \App\Models\Cellgroup::all()->pluck('name', 'id'), null, ['class' => 'ui fluid dropdown']) }}
      </td>
    </tr>
    <tr>
      <td><b>birthday</b></td>
      <td class="twelve wide">
        <input type="date" name="birthday">
      </td>
    </tr>
    <tr>
      <td><b>Baptism</b></td>
      <td>
        {{ Form::select('baptism', \App\Models\Baptism::all()->pluck('name', 'id'), null, ['class' => 'ui fluid dropdown'] ) }}
      </td>
    </tr>
    <tr>
      <td><b>Baptism Serial</b></td>
      <td>
        {{ Form::text('baptism_serial') }}
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
            Back to souls
          </a>
        </th>
      </tr>
    </tfoot>
  </table>
  {!! Form::close() !!}
</div>
@endsection
