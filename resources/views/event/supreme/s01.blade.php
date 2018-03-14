@extends('event.supreme.layout')

@section('title')
Supreme - Vote
@endsection

@section('content')
  <div id="supreme-container" class="ui text container">

    <h1 class="ui center aligned icon header">
      <div>
        <img id="logo" src="/images/supreme-vote/logo.png">
      </div>
    </h1>
    {{ Form::open(['url' => '/event/vote/supreme', 'method' => 'post', 'class' => 'ui inverted form']) }}

      <div class="ui hidden divider"></div>

      <input type="hidden" name="option" id="form-option" value="1">

      <div class="ui vertical fluid huge buttons">
        <button class="ui button option" data-option='1'>A. Jennifer</button>
        <button class="ui button option" data-option='2'>B. Future</button>
        <button class="ui button option" data-option='3'>C. Eddie</button>
        <div class="ui hidden divider"></div>
        <button class="ui fluid huge button">Submit</button>
      </div>
    </form>
  </div>
@endsection
