@extends('admin.layout')
@section('title')
Add pledge
@endsection
@section('content')
<div class="ui text container">
  <h1 class="ui header">Add pledge</h1>
  {!! Form::open(['url' => 'admin/ff/'.$id.'/pledge/create', 'method' => 'POST', 'class' => 'ui form']) !!}
  <table class="ui structured table">
    <tr class="field {{$errors->has('name') ? 'error' : ''}}">
      <td>
        <b>Name</b>
      </td>
      <td>
        {{ Form::text('name', null) }}
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
        {{ Form::text('amount', null) }}
        @if ($errors->has('amount'))
          <span class="ui red pointing label"> {{ $errors->first('amount') }}</span>
        @endif
      </td>
    </tr>

    <tfoot class="full-width">
      <tr>
        <th colspan="2">
          <button type="submit" class="ui purple labeled icon button">
            Add <i class="plus icon"></i>
          </button>
          <a href="/admin/ff/{{$id}}" class="ui cancel basic button">
            Back to pledges
          </a>
        </th>
      </tr>
    </tfoot>
  </table>
  {!! Form::close() !!}
</div>
@endsection
