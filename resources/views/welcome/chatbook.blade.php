@extends('welcome.layout')

@section('title')
  Welcome Chatbook 
@endsection

@include('welcome.parts.navigation_bar')

@section('content')

<section class="mt-4 mb-4">
{!! Form::open(['url' => '/welcome/chatbook/edit', 'method' => 'POST', 'autocomplete' => 'off']) !!}
<h4 class="ui dividing header">Chatbook</h4>
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
                  <input type="radio" name="example4" checked="checked">
                  <label>Once a week</label>
                </div>
              </div>
              <div class="field">
                <div class="ui radio checkbox">
                  <input type="radio" name="example4">
                  <label>2-3 times a week</label>
                </div>
              </div>
              <div class="field">
                <div class="ui radio checkbox">
                  <input type="radio" name="example4">
                  <label>Once a day</label>
                </div>
              </div>
              <div class="field">
                <div class="ui radio checkbox">
                  <input type="radio" name="example4">
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
                  <input type="radio" name="example5" checked="checked">
                  <label>Once a week</label>
                </div>
              </div>
              <div class="field">
                <div class="ui radio checkbox">
                  <input type="radio" name="example5">
                  <label>2-3 times a week</label>
                </div>
              </div>
              <div class="field">
                <div class="ui radio checkbox">
                  <input type="radio" name="example5">
                  <label>Once a day</label>
                </div>
              </div>
              <div class="field">
                <div class="ui radio checkbox">
                  <input type="radio" name="example5">
                  <label>Twice a day</label>
                </div>
              </div>
            </div>
          </div> 
        </td>
      </tr>
    </tbody>
    <tbody style="display: none;">
      <tr>
        <td>
          No services, change filter or come back later
        </td>
      </tr>
    </tbody>
  </table>
	
<div style="display: flex; justify-content: center;">
  <button class="ui green deny button mr-4 mb-2">
    {{ trans('welcome.welcome.submit') }}
  </button>
</div>
	
{!! Form::close() !!}      
</section>

@endsection