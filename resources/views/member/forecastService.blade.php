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
	    <div class="two fields">
	      <div class="field">
	        <label>{{trans('member.forecast.available_service')}}</label>
	        <table class="ui inverted unstackable compact small table">
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
	        @endforelse
	    	</table>
	      </div>
	      <div class="field">
	        <label>{{trans('member.forecast.will_attend_service')}}</label>
	        @forelse($serviceAttendances as $serviceAttendance)
		        <div class="ui fluid inverted button">
		        	{{$serviceAttendance->service->at->format('d/m/Y (D)')}} <br> {{$serviceAttendance->service->speaker->name}}
		        </div>
	        @empty
	        @endforelse
	      </div>
	    </div>
  	  </div>
	  <div class="ui hidden divider"></div>

      <div class="field">
        <button class="ui inverted basic fluid huge button">{{trans('member.forecast.register')}}</button>
      </div>

    </form>
  </div>
@endsection

@section('script')
  <script src="/js/member.forecast.js"></script>
@endsection