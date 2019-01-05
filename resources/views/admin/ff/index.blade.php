@extends('admin.layout')
@section('title')
Souls
@endsection
@section('content')
{{-- <a href="/admin/ff/create" class="ui teal button right floated">New sessions</a> --}}
<h1 class="ui header">Future Funds</h1>
<div class="ui segment">
    {!! Form::select('is_active', ['0' => 'Not active', '1' => 'Active', 'all' => 'All'], $filter['is_active'], ['class' => 'ui dropdown']) !!}
    <div class="clearfix field">
      <a href="{{ url()->current() }}" class="ui basic right floated right labeled icon tiny button">
        Reset <i class="undo icon"></i>
      </a>
      <button class="ui teal right floated right labeled icon tiny button">
        Filter <i class="filter icon"></i>
      </button>
    </div>
    <div class="ui hidden divider"></div>
  {!! Form::close() !!}
</div>
<table class="ui very compact table">
  <thead>
    <tr>
      <th >{!! sort_by('id', 'ID' ) !!}</th>
      <th  class="three wide">Name</th>
      <th >Amount</th>
      <th >Status</th>
      <th >Created at</th>
      <th >Actions</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($ffs as $ff)
      <tr>
        <td>
          {{ prefix()->wrap($ff) }}
        </td>
        <td>
          <h5 class="ui header">
            {{ $ff->name }}
          </h5>
        </td>
        <td>
          RM {{ $ff->pledges->sum('amount') }}
        </td>
        <td>
          <div>
            @if ($ff->is_active)
              <div class="ui green label">active</div>
            @else
              <div class="ui grey label">not active</div>
            @endif
          </div>
        </td>
        <td>
          {{ $ff->created_at->format('Y-m-d') }}
        </td>
        <td>
          <div class="ui small icon buttons">
            <a href="/admin/ff/{{$ff->id}}" class="ui button">
              <i class="users icon"></i>
            </a>
          </div>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="5"> No future fund session, change filter or come back later </td>
      </tr>
    @endforelse
  </tbody>
</table>
{{ $ffs->appends($filter)->links() }}
@endsection
