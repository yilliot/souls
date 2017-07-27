@extends('member.layout')

@section('title')
Forecast
@endsection

@section('content')
  <div id="forecast-container" class="ui piled inverted segment text container">
    <a href="/session/lang/zh">中文</a> |
    <a href="/session/lang/en">English</a>
    <h1 class="ui center aligned icon header">
      <div>
        <img id="logo" src="/images/hcc-logo-black320.png" alt="HCCJB">
      </div>
      <div class="neon-green content">
          <span class="glow">{{$soul->nickname}}</span>
          <div class="sub neon-green header">
          	{{ trans('member.forecast.please_select_service') }}
          </div>
        </div>
    </h1>
    @include('member.part.flash')
    {{ Form::open(['url' => '/member/forecast/service', 'method' => 'post', 'class' => 'ui inverted form', 'id' => 'member-forecast', 'files' => true]) }}
	  <input name="soul_id" type="hidden" value="{{$soul->id}}">
	  <input name="cellgroup_id" type="hidden" value="{{$soul->cellgroup->id}}">
	  <div class="ui form">
	      <div class="field">
	        <label>{{trans('member.forecast.available_service')}}</label>
	        <table class="ui inverted unstackable compact small table">
	       	  <tr>
	       	  	<th colspan="2">{{trans('member.forecast.services')}}</th>
	       	  </tr>
	        @forelse($services as $service)
	        	<tr>
	        	  <td>
		        	<div>
			        	{{$service->at->format('d/m/Y (D)')}} <br> {{$service->speaker->name}} 
				        @if($service->topic != null)
					        <br>
							{{$service->topic}}
				        @endif
				    </div>
			      </td>
				  <td class="right aligned">
			        <div class="ui checkbox">
			          {!! Form::checkbox('services[]', $service->id) !!}
			        </div>
      			  </td>
				</tr>
			@empty
			  <td colspan="2">
			  	{{trans('member.forecast.attend_all')}}
			  </td>
	        @endforelse
	    	</table>
	      </div>
	      <div class="field">
	        <label>{{trans('member.forecast.will_attend_service')}}</label>
	        <table class="ui inverted unstackable compact small table">
		        <tr>
		        	<th>
		        		{{trans('member.forecast.services')}}
		        	</th>
		        	<th>
		        		{{trans('member.forecast.visitors')}}
		        	</th>
		        	<th colspan="2">
		        	</th>
		        </tr>
		        @forelse($serviceAttendances as $serviceAttendance)
	        	  	<tr>
				      <td>
				        <div>
				        	{{$serviceAttendance->service->at->format('d/m/Y (D)')}} <br> {{$serviceAttendance->service->speaker->name}}
				        </div>
				      </td>
				      <td class="visitors" data-visitor="{{$serviceAttendance->id}}">
				      	{{$serviceAttendance->visitors->count()}}
				      	<div class="ui inverted popup" id="{{$serviceAttendance->id}}">
						  <div class="header">{{trans('member.forecast.visitorslist')}}</div>
							<table class="ui inverted unstackable compact small invitedvisitor table">
							  @forelse($serviceAttendance->visitors as $visitor)
						      <tr>
						      	<td>
								    {{$visitor->name}}  	
								  </br>
							    </td>
							    <td class="right aligned delVisitorCaller" data-visitor="{{$visitor->name}}" data-visitor-id="{{$visitor->id}}">
							    	<i class="remove icon"></i>
							    </td>
							  </tr>
							  @empty
							  <tr>
							    <td>
								  {{trans('member.forecast.novisitors')}}
							    </td>
							  </tr>
							  @endforelse
						  	</table>
						</div>
				      </td>
				      <td>
				      	<div class="addVisitorCaller" data-attendance="{{$serviceAttendance->id}}" data-servicedate="{{$serviceAttendance->service->at->format('d/m/Y (D)')}}">
				      	  <i class="add icon"></i>
				      	</div>
				      </td>
			          <td class="right aligned">
			          	<div class="delServiceCaller" data-attendance="{{$serviceAttendance->id}}" data-servicedate="{{$serviceAttendance->service->at->format('d/m/Y (D)')}}">
            			  <i class="remove icon"></i>
            			</div>
			          </td>
	        		</tr>
		        @empty
		        <tr>
		        	<td colspan="4">
		        		{{trans('member.forecast.noforecast')}}
		        	</td>
		        </tr>
		        @endforelse
	        </table>
	      </div>
  	  </div>
	  <div class="ui hidden divider"></div>

      <div class="field">
        <button class="ui inverted basic fluid huge button">{{trans('member.forecast.register')}}</button>
      </div>

    </form>
  </div>

{!! Form::open(['url' => '/member/forecast/delservice', 'class' => 'ui small delservice modal']) !!}
  <input name="soul_id" type="hidden" value="{{$soul->id}}">
  <input type="hidden" name="id" id="attendance_id">
  <div class="header capitalized serviceDate" style="color:black">
    
  </div>
  <div class="center aligned content" style="color:black">
    {{trans('member.forecast.confirm_cancel')}}
  </div>
  <div class="actions">
    <button type="submit" class="ui negative right labeled icon button">
      Delete <i class="checkmark icon"></i>
    </button>
    <div class="ui cancel basic button">
      Cancel
    </div>
  </div>
{!! Form::close() !!}

{!! Form::open(['url' => '/member/forecast/visitor', 'class' => 'ui small addvisitor modal']) !!}
  <input name="soul_id" type="hidden" value="{{$soul->id}}">
  <input type="hidden" name="id" id="attendance_id">
  <div class="header capitalized serviceDate" style="color:black">
    
  </div>
  <div class="center aligned content" style="color:black">
	<table class="ui visitor table">
      <tr>
        <td>
          <div class="ui fluid input">
          	<input type="text" name="visitors[]" val="" placeholder="{{trans('member.forecast.what_is_his/her_name')}}">
          </div>
        </td>
      </tr>
    </table>
    <div class="ui button fluid green addNewVisitor">
      <i class="add icon"></i>
      {{trans('member.forecast.add')}}
	</div>
  </div>
  <div class="actions">
    <button type="submit" class="ui positive right labeled icon button">
      {{trans('member.forecast.invite')}} <i class="checkmark icon"></i>
    </button>
    <div class="ui cancel basic button">
      Cancel
    </div>
  </div>
{!! Form::close() !!}

{!! Form::open(['url' => '/member/forecast/delvisitor', 'class' => 'ui small delvisitor modal']) !!}
  <input name="soul_id" type="hidden" value="{{$soul->id}}">
  <input type="hidden" name="id" id="visitor_id">
  <div class="header capitalized visitorName" style="color:black">
    
  </div>
  <div class="center aligned content" style="color:black">
    {{trans('member.forecast.visitor_confirm_cancel')}}
  </div>
  <div class="actions">
    <button type="submit" class="ui negative right labeled icon button">
      {{trans('member.forecast.delete')}} <i class="checkmark icon"></i>
    </button>
    <div class="ui cancel basic button">
      {{trans('member.forecast.cancel')}}
    </div>
  </div>
{!! Form::close() !!}
@endsection

@section('script')
  <script src="/js/member.forecast.js"></script>
@endsection