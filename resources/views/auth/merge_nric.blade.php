@extends('auth.layout')

@section('content-blank')
<form class="ui form">
  @csrf_field()
  <div class="field">
    <label for="nric">welcome to the new island, let us know your NRIC/Passport ID to continue:</label>
    <input name="nric" type="text" placeholder="930101-01-0000">
  </div>
  <button class="ui fluid button">Lets go</button>
</form>
@endsection