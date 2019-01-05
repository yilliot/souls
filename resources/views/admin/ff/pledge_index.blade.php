@extends('admin.layout')
@section('title')
Souls
@endsection
@section('content')
<a href="/admin/ff/{{$id}}/pledge/create" class="ui teal button right floated">New Pledge</a>
<a href="/admin/ff/{{$id}}/payment/pending" class="ui orange button right floated">Pending Payments</a>
<h1 class="ui header">Pledges</h1>
<div class="ui segment">
    {!! Form::select('is_banned', ['0' => 'Not banned', '1' => 'Banned', 'all' => 'All'], $filter['is_banned'], ['class' => 'ui dropdown']) !!}
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
      <th >Status</th>
      <th >Created at</th>
      <th >Actions</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($pledges as $pledge)
      <tr>
        <td>
          <h5 class="ui header">
            {{ prefix()->wrap($pledge) }}
            <div class="sub uppercased header">
              {{ $pledge->code }}
            </div>
          </h5>
        </td>
        <td>
          <h5 class="ui header">
            {{ $pledge->name }}
            @if ($pledge->soul)
              <div class="sub uppercased header">{{ $pledge->soul->nickname }}</div>
            @endif
          </h5>
        </td>
        <td>
          <div>
            @if ($pledge->is_banned)
              <div class="ui red label">banned</div>
            @endif
          </div>
        </td>
        <td>
          {{ $pledge->created_at->format('Y-m-d') }}
        </td>
        <td>
          <div class="ui small icon buttons">
            <a href="/admin/ff/pledge/{{$pledge->id}}" class="ui button">
              <i class="money icon"></i>
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
{{ $pledges->appends($filter)->links() }}
@endsection
