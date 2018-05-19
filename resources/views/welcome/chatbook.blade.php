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
      @foreach ($chatQuestions as $chatQuestion)
      <tr>
        <td>
          <div class="ui form">
            <div class="grouped fields">
              <label>{{$chatQuestion->question}}</label>
              {{-- {{dd(json_encode(['有', '没有']))}} --}}
              @foreach ($chatQuestion->options as $option)
              <div class="field">
                <div class="ui radio checkbox">
                  <input type="radio" name="example3" checked="checked">
                  <label>{{$option}}</label>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </td>
      </tr>
      @endforeach
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