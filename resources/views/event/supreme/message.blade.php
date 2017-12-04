@extends('event.supreme.layout')

@section('title')
Supreme - Thanks
@endsection

@section('content')
  <div id="supreme-container" class="ui text container"
    style="background-image: url(/images/supreme-vote/{{session('supreme.vote')}}.jpg)" 
  >
    <h1 class="ui center aligned icon header">
      <div>
        <img id="logo" src="/images/supreme-vote/logo.png">
      </div>
    </h1>
  </div>
  <h1 class="ui text-centered inverted header">
    Thanks for voting!
  </h1>
@endsection
