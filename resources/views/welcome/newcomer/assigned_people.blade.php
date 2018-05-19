@extends('welcome.layout')

@section('title')
  Assigned Followupper
@endsection

@include('welcome.parts.navigation_bar')

@section('content')

{{-- cell group assign --}}

<table class="ui table">
  <thead>
    <tr>
      <th>
        {{ trans('welcome.welcome.assigned_people') }}
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <div class="ui form">
          <div class="field">
            <select class="ui dropdown">
              @foreach ($followuplists as $followuplist)
                <option>{{$followuplist['name']}}</option>
              @endforeach
            </select>
          </div>
        </div>
        {!! Form::open(['url' => '/pastoral/newcomer/post', 'method' => 'POST', 'autocomplete' => 'off']) !!}
        <div class="actions mb-2" style="float: right;">
          <a role="button" href="/pastoral/newcomer/" class="ui black deny button">
            Cancel
          </a>
          <button class="ui green deny button mr-3" style="float: right;">
            {{ trans('welcome.welcome.submit') }}
          </button>
        </div>
        {!! Form::close() !!}
      </td>
    </tr>
  </tbody>
</table>

{{-- end of cell group assign --}}

@endsection