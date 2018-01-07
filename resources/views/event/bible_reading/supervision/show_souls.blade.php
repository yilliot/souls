@extends('event.bible_reading.supervision.layout')

@section('title')
Cellgroup Leader Supervision
@endsection

@section('content')

@include('event.bible_reading.part.logo')

<table class="ui table">
	@forelse($souls as $soul)
	@include('event.bible_reading.supervision.part.soul', ['soul' => $soul])
	@empty
	<tr>
		<td colspan="4">
		  <div class="ui inverted red basic segment">
		    No souls in this cellgroup
		  </div>
		</td>
	</tr>
	@endforelse
</table>

@endsection
