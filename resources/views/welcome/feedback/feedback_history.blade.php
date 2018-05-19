@extends('welcome.layout')

@section('title')
  Chatbook History
@endsection

@include('welcome.parts.navigation_bar')

@section('content')


<section class="mt-4 mb-4">
  <form class="ui form">
    <h4 class="ui dividing header">Chatbook History</h4>
    <div class="field">
      <div class="field">
        <label>How often do you use checkboxes?</label>
        <div class="form-control" style="color: #6c757d!important;">Once a week</div>
      </div>
      <div class="field">
        <label>How often do you use checkboxes?</label>
        <div class="form-control" style="color: #6c757d!important;">2-3 times a week</div>
      </div>
      <div class="field">
        <label>How often do you use checkboxes?</label>
        <div class="form-control" style="color: #6c757d!important;">Once a day</div>
      </div>
      <div class="field">
        <label>How often do you use checkboxes?</label>
        <div class="form-control" style="color: #6c757d!important;">Twice a day</div>
      </div>
    </div>
  </form>
  
</section>

  <div style="display: flex; justify-content: center;">
    <a role="button" href="/welcome/feedback/record/history" class="ui black deny button mb-5">
      OK
    </a>
  </div>

@endsection