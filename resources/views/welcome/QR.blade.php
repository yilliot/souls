@extends('welcome.layout')

@section('title')
  Welcome QR Code
@endsection

@include('welcome.parts.navigation_bar')

@section('content')

<div>
	<div class="mt-5 mb-5">
		<div style="text-align: center;" ">Scan this QR code to continue</div>
		<div class="">
			<img class="image-center mt-2" src="http://qreateandtrack.com/files/2009/12/website.png" />
		</div>
	</div>
</div>
@endsection