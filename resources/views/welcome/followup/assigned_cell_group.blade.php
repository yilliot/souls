@extends('welcome.layout')

@section('title')
	Assigned Cell Group
@endsection

@include('welcome.parts.navigation_bar')

@section('content')

{!! Form::open(['url' => '/followup/cell-group/edit', 'method' => 'POST', 'autocomplete' => 'off']) !!}

<table class="ui table">
  	<thead>
    	<tr>
    		<th>
      			Assign Cell Group
    		</th>
    	</tr>
  	</thead>
  	<tbody>
		<tr>
  			<td>
		  		<div class="ui form">
		    		<div class="field">
	      			<select class="ui dropdown">
				        <option>E1</option>
				        <option>E2</option>  
				        <option>E3</option>
				        <option>E4</option>
				        <option>S1</option>
	        			<option>W1</option>
	      			</select>
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
			</td>
		</tr>
	</tbody>
</table>

{!! Form::close() !!}

@endsection