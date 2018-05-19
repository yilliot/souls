@extends('welcome.layout')

@section('title')
  Comment
@endsection

@include('welcome.parts.navigation_bar')

@section('content')

<table class="ui table">
	<thead>
	  <tr class="content" style="display: flex !important; justify-content: space-between !important;">
	    <th class="header w-100">
	      Comment 
	    </th>
	  </tr>
	</thead>
	<tbody>
	  <tr>     
 		<td>
		  {!! Form::open(['url' => '/followup/comment/edit', 'method' => 'POST', 'autocomplete' => 'off']) !!}
		  <div class="ui form">
		    <div class="field">
		      <textarea></textarea>
		    </div>
		  </div>
		  <div class="actions" style="float: right;">
	        <a role="button" href="/followup" class="ui black deny button">
	          Cancel
	        </a>
		    <button type="submit" class="ui green deny button mr-3 mb-2" style="float: right;">
		      {{ trans('welcome.welcome.submit') }}  
		    </button>
		  </div>
		  {!! Form::close() !!}
 		</td>
	  </tr> 
	</tbody>
</table>
@endsection