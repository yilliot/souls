@extends('event.usher.layout')

@section('title')
  detail
@endsection


@section('content')

<form class="ui form">
  <h4 class="ui dividing header">Newcomer form list</h4>
  <div class="field">
    <label>Name</label>
    <div class="two fields">
      <div class="field">
        <input type="text" name="shipping[first-name]" placeholder="First Name">
      </div>
      <div class="field">
        <input type="text" name="shipping[last-name]" placeholder="Last Name">
      </div>
    </div>
  </div>
  <div class="field">
    <label>Address</label>
    <div class="fields">
      <div class="sixteen wide field">
        <input type="text" name="shipping[address]" placeholder="Street Address">
      </div>
    </div>
  </div>
   <div class="field">
    <label>NRIC/ Passport</label>
    <div class="fields">
      <div class="sixteen wide field">
        <input type="text" name="NRIC/ PASSPORT" placeholder="NRIC/ PASSPORT">
      </div>
    </div>
  </div>
    <div class="field">
    <label>Email</label>
    <div class="fields">
      <div class="sixteen wide field">
        <input type="text" name="email" placeholder="email">
      </div>
    </div>
  </div>
    <div class="field">
    <label>phone</label>
    <div class="fields">
      <div class="sixteen wide field">
        <input type="text" name="phone" placeholder="phone">
      </div>
    </div>
  </div>
     <div class="field">
    <label>inviter</label>
    <div class="fields">
      <div class="sixteen wide field">
        <input type="text" name="inviter" placeholder="inviter">
      </div>
    </div>
  </div>
     <div class="field">
    <label>inviter</label>
    <div class="fields">
      <div class="sixteen wide field">
        <input type="text" name="inviter" placeholder="inviter">
      </div>
    </div>
  </div>
<div class="field">
  <label class="mt-2">Are u the first time came to chruch?</label>
  <select class="ui dropdown">
    <option>Yes</option>
    <option>No</option>
  </select>
</div>

  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="check_box_agreement" required>
    <label class="form-check-label pl-1" for="check_box_agreement">Agreement</label>
  </div>

<button type="submit">Submit</button>
 </form>

@endsection