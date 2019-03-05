@extends('admin.layout')
@section('title')
Update pledge
@endsection
@section('content')
<div class="ui text container">
  <h1 class="ui header">Update pledge</h1>
  {!! Form::open(['url' => 'admin/ff/pledge/update/' . $pledge->id, 'method' => 'POST', 'class' => 'ui form']) !!}
  <table class="ui structured unstackable table">
    <tr class="field {{$errors->has('name') ? 'error' : ''}}">
      <td>
        <b>Name</b>
      </td>
      <td>
        {{ Form::text('name', old('name', $pledge->name)) }}
        @if ($errors->has('name'))
          <span class="ui red pointing label"> {{ $errors->first('name') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{$errors->has('amount') ? 'error' : ''}}">
      <td>
        <b>Amount</b>
      </td>
      <td>
        {{ Form::text('amount', old('amount', $pledge->amount)) }}
        @if ($errors->has('amount'))
          <span class="ui red pointing label"> {{ $errors->first('amount') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{$errors->has('is_banned') ? 'error' : ''}}">
      <td>
        <b>Is Banned</b>
      </td>
      <td>
        {{ Form::select('is_banned', \App\Enums\Boolean::all(), old('is_banned', $pledge->is_banned), ['class' => 'ui fluid dropdown']) }}
        @if ($errors->has('is_banned'))
          <span class="ui red pointing label"> {{ $errors->first('is_banned') }}</span>
        @endif
      </td>
    </tr>
    <tfoot class="full-width">
      <tr>
        <th colspan="2">
          <button type="submit" class="ui purple labeled icon button">
            Update <i class="pencil icon"></i>
          </button>
          <a href="/admin/ff/{{$pledge->session_id}}" class="ui cancel basic button">
            Back to {{$pledge->session->name}}
          </a>
        </th>
      </tr>
    </tfoot>
  </table>
  {!! Form::close() !!}
</div>
@endsection
