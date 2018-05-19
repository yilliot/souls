@extends('welcome.layout')

@section('title')
  Welcome QR Code
@endsection

@include('welcome.parts.navigation_bar')

@section('content')

<div>
	<div class="mt-5 mb-5">
		<div style="text-align: center;">Scan this QR code to continue</div>
		<div style="text-align: center;">
      {!! QrCode::size(200)->generate($url); !!}
      
		</div>
	</div>
</div>
@endsection