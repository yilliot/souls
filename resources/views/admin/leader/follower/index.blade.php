@extends('admin.layout')
@section('title')
Followers
@endsection
@section('content')
<a href="/admin/leader/follower/add" class="ui teal button right floated">Add followers</a>
<h1 class="ui header">Followers</h1>
<table class="ui table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Contact</th>
      <th>Birthday</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
  @forelse ($followers as $follower)
  @php
    $soul = $follower->follower;
  @endphp
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
        {{ $soul->birthday }}
      </td>
      <td>
        <div class="ui small icon buttons">
          <span class="modalcaller ui red button" data-modal-val="{{json_encode(['follower_id' => $soul->id])}}" data-modal-text="{{json_encode(['name' => $soul->nickname])}}">
            <i class="trash icon"></i>
          </span>
        </div>
      </td>
    </tr>
  @empty
    <tr>
      <td colspan="5"> No follower, add one now. </td>
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
      {{csrf_field()}}
      <input type="hidden" class="data val follower_id" name="follower_id" value="">
      <button class="ui red button">Delete</button>
      <div class="ui cancel button">Cancel</div>
    </form>
  </div>
</div>

@endsection
