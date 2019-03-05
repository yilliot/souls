@extends('admin.layout')
@section('title')
Add followers
@endsection
@section('content')
<h1 class="ui header">Add followers</h1>
<table class="ui table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Contact</th>
      <th>Leaders</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
  @forelse ($souls as $soul)
    <tr>
      <td>
        {{ prefix()->wrap($soul) }}
      </td>
      <td>
        <h5 class="ui header">
          {{ $soul->nickname }}
          <div class="sub uppercased header">{{ $soul->nric_fullname }}</div>
        </h5>
      </td>
      <td>
        {{ $soul->contact }}
      </td>
      <td>
        @foreach ($soul->leaders as $leader)
          {{ $leader }}
        @endforeach
      </td>
      <td>
        @if ($soul->leaders->where('id', \Auth::user()->soul_id)->count()==0)
          <form action="/admin/leader/follower/add" method="post">
            {{csrf_field()}}
            <input type="hidden" name="leader_id" value="{{\Auth::user()->soul_id}}">
            <input type="hidden" name="follower_id" value="{{$soul->id}}">
            <div class="ui small icon buttons">
              <button class="ui green button">
                <i class="add icon"></i>
              </button>
            </div>
          </form>
        @endif
      </td>
    </tr>
  @empty
    <tr>
      <td colspan="5"> No souls... </td>
    </tr>
  @endforelse
  </tbody>
</table>
<div class="ui modal">
  <div class="header">Delete Your Follower</div>
  <div class="content">
    <p>Are you sure you want to delete <span class="data text name">-</span> from your follower?</p>
  </div>
  <div class="actions">
    <form action="/admin/leader/follower/remove" method="post">
      <input type="hidden" class="data val id" value="">
      <button class="ui red button">Delete</button>
      <div class="ui cancel button">Cancel</div>
    </form>
  </div>
</div>

@endsection
