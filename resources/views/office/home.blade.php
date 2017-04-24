@extends('office.layout.base')
@section('content')
<div class="ui segment">
  <h1 class="ui header">Stats</h1>
  <table class="ui basic table">
    <thead>
      <tr>
        <th></th>
        <th>Pending</th>
        <th>Active</th>
        <th>Rejected</th>
      </tr>
    </thead>
    <tr>
      <td>Sellers</td>
      <td>{{ App\Models\UserSeller::where('approval_code', 0)->count() }}</td>
      <td>{{ App\Models\UserSeller::where('approval_code', 1)->count() }}</td>
      <td>{{ App\Models\UserSeller::where('approval_code', 2)->count() }}</td>
    </tr>
    <tr>
      <td>Jobs</td>
      <td>{{ App\Models\Job::where('approval_code', 0)->count() }}</td>
      <td>{{ App\Models\Job::where('approval_code', 1)->count() }}</td>
      <td>{{ App\Models\Job::where('approval_code', 2)->count() }}</td>
    </tr>
  </table>
</div>
@endsection
