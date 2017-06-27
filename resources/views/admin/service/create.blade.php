@extends('admin.layout.base')
@section('title')
Add promocode
@endsection
@section('content')
<div class="ui text container">
  <h1 class="ui header">Add promocode</h1>
  {!! Form::open(['url' => 'office/promocode/', 'method' => 'POST', 'class' => 'ui form']) !!}
  <table class="ui structured table">
    <tr>
      <td><b>Code</b></td>
      <td class="twelve wide">
        <input type="text" name="code">
      </td>
    </tr>
    <tr>
      <td><b>Value</b></td>
      <td>
        <input type="text" name="value">
      </td>
    </tr>
    <tr>
      <td><b>Status</b></td>
      <td>
      {!! Form::select('is_activated', App\Enums\IsActivated::all(),null ,['class' => 'ui fluid dropdown']) !!}
      </td>
    </tr>
    <tr>
      <td><b>Kind</b></td>
      <td>
      {!! Form::select('is_public', App\Enums\IsPublic::all(),null ,['class' => 'ui fluid dropdown']) !!}
      </td>
    </tr>
    <tr>
      <td><b>Claim Cap</b></td>
      <td>
        <input type="number" name="claim_cap">
      </td>
    </tr>
    <tfoot class="full-width">
      <tr>
        <th colspan="2">
          <button type="submit" class="ui purple labeled icon button">
            Add <i class="plus icon"></i>
          </button>
          @if (url()->previous() == url()->current())
            <a href="/office/promocode/" class="ui cancel basic button">
              Back to promocodes
            </a>
          @else
            <a href="{{url()->previous()}}" class="ui cancel basic button">
              Cancel
            </a>
          @endif
        </th>
      </tr>
    </tfoot>
  </table>
  {!! Form::close() !!}
</div>
@endsection
