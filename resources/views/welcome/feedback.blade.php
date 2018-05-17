@extends('welcome.layout')

@section('title')
  Welcome Feedback
@endsection

@include('welcome.parts.navigation_bar')

@section('content')

<h3>Feedback Form</h3>

<section class="mt-4 mb-4">
<table class="ui unstackable table">
  <tbody>
    <tr>
      <td>
        <div class="ui form">
          <div class="grouped fields">
            <label>How often do you use checkboxes?</label>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="example2" checked="checked">
                <label>Once a week</label>
              </div>
            </div>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="example2">
                <label>2-3 times a week</label>
              </div>
            </div>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="example2">
                <label>Once a day</label>
              </div>
            </div>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="example2">
                <label>Twice a day</label>
              </div>
            </div>
          </div>
        </div>				
      </td>
    </tr>
    <tr>
      <td>
        <div class="ui form">
          <div class="grouped fields">
            <label>How often do you use checkboxes?</label>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="example3" checked="checked">
                <label>Once a week</label>
              </div>
            </div>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="example3">
                <label>2-3 times a week</label>
              </div>
            </div>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="example3">
                <label>Once a day</label>
              </div>
            </div>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="example3">
                <label>Twice a day</label>
              </div>
            </div>
          </div>
        </div>   
      </td>
    </tr>
    <tr>
      <td>
        <div class="ui form">
          <div class="grouped fields">
            <label>How often do you use checkboxes?</label>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="example3" checked="checked">
                <label>Once a week</label>
              </div>
            </div>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="example3">
                <label>2-3 times a week</label>
              </div>
            </div>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="example3">
                <label>Once a day</label>
              </div>
            </div>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="example3">
                <label>Twice a day</label>
              </div>
            </div>
          </div>
        </div>     
      </td>
      </tr>
      <tr>
      <td>
            <div class="ui form">
          <div class="grouped fields">
            <label>How often do you use checkboxes?</label>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="example3" checked="checked">
                <label>Once a week</label>
              </div>
            </div>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="example3">
                <label>2-3 times a week</label>
              </div>
            </div>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="example3">
                <label>Once a day</label>
              </div>
            </div>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="example3">
                <label>Twice a day</label>
              </div>
            </div>
          </div>
        </div> 
      </td>
    </tr>
  </tbody>
  </table>      
</section>
@endsection