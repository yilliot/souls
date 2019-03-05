@extends('admin.layout')
@section('title')
Add payment
@endsection
@section('content')
<div class="ui text container">
  <h1 class="ui header">Add payment for {{$pledge->name}}</h1>
  {!! Form::open(['url' => 'admin/ff/payment/create/' . $pledge->id, 'method' => 'POST', 'class' => 'ui form']) !!}
  <table class="ui structured unstackable table">
    <tr class="field {{$errors->has('amount') ? 'error' : ''}}">
      <td><b>Amount</b></td>
      <td>
        {{ Form::text('amount', null) }}
        @if ($errors->has('amount'))
          <span class="ui red pointing label"> {{ $errors->first('amount') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{$errors->has('remarks') ? 'error' : ''}}">
      <td><b>Remark</b></td>
      <td>
        {{ Form::text('remarks', null) }}
        @if ($errors->has('remarks'))
          <span class="ui red pointing label"> {{ $errors->first('remarks') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{$errors->has('is_cleared') ? 'error' : ''}}">
      <td>
        <b>Is Cleared</b>
      </td>
      <td>
        {{ Form::select('is_cleared', \App\Enums\Boolean::all(), null, ['class' => 'ui fluid dropdown']) }}
        @if ($errors->has('is_cleared'))
          <span class="ui red pointing label"> {{ $errors->first('is_cleared') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{$errors->has('is_cancelled') ? 'error' : ''}}">
      <td>
        <b>Is Cancelled</b>
      </td>
      <td>
        {{ Form::select('is_cancelled', \App\Enums\Boolean::all(), old('is_cancelled', 0), ['class' => 'ui fluid dropdown']) }}
        @if ($errors->has('is_cancelled'))
          <span class="ui red pointing label"> {{ $errors->first('is_cancelled') }}</span>
        @endif
      </td>
    </tr>

    <tfoot class="full-width">
      <tr>
        <th colspan="2">
          <button type="submit" class="ui purple labeled icon button">
            Add <i class="plus icon"></i>
          </button>
          <a href="/admin/ff/pledge/{{$pledge->id}}" class="ui cancel basic button">
            Back to pledge
          </a>
        </th>
      </tr>
    </tfoot>
  </table>
  {!! Form::close() !!}
</div>
@endsection
