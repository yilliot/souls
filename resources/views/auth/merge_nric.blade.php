@extends('auth.layout')

@section('title')
    Merge NRIC @parent
@endsection

@section('content-blank')
<h1>Welcome onboard to Oasis!</h1>
<form class="ui form" method="POST" action="/auth/merge/nric">
  {{ csrf_field() }}
  <div class="field">
    <label for="nric">let us know your NRIC/Passport ID to continue</label>
    <div class="ui divider"></div>
    <input name="nric" type="text" placeholder="930101-01-1234">
  </div>
  <button class="ui fluid yellow button">Let's go</button>
</form>
@endsection