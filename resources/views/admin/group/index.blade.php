@extends('admin.layout')
@section('title')
Groups
@endsection
@section('content')
<a href="/admin/group/create" class="ui teal button right floated">New group</a>
<h1 class="ui header">Groups</h1>

<table class="ui very compact table">
  <thead>
    <tr>
      <th >{!! sort_by('id', 'ID' ) !!}</th>
      <th >Name</th>
      <th >Leader</th>
      <th >Status</th>
      <th >Created at</th>
      <th >Actions</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($groups as $group)
      <tr>
        <td>
          {{ prefix()->wrap($group) }}
        </td>
        <td>
          <h5 class="ui header">
            {{ $group->name }}
          </h5>
        </td>
        <td>
          <h5 class="ui header">
          @if ($group->leader)
            {{ $group->leader }}
          @endif
            @if ($group->colead1)
            <div class="sub uppercased header">
              {{ $group->colead1 }}
            </div>
            @endif
            @if ($group->colead2)
            <div class="sub uppercased header">
              {{ $group->colead2 }}
            </div>
            @endif
          </h5>
        </td>
        <td>
          <div>
            @if ($group->is_active)
              <div class="ui green label">active</div>
            @else
              <div class="ui grey label">not active</div>
            @endif
          </div>
          <div>
            @if ($group->baptism_serial)
              <div class="ui icon teal label">
                <i class="theme icon"></i>
                {{$group->baptism_serial}}
              </div>
            @endif
          </div>
        </td>
        <td>
          {{ $group->created_at->format('Y-m-d') }}
        </td>
        <td>
          <div class="ui small icon buttons">
            <a href="/admin/group/{{$group->id}}/edit" class="ui teal button">
              <i class="edit icon"></i>
            </a>
            <a href="/admin/group/{{$group->id}}" class="ui button">
              <i class="eye icon"></i>
            </a>
          </div>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="5"> No groups, change filter or come back later </td>
      </tr>
    @endforelse
  </tbody>
</table>
{{ $groups->appends($filter)->links() }}
@endsection
