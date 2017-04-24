@extends('office.layout.base')
@section('title')
Reject Services
@endsection
@section('content')
<h1 class="ui header">Reject Services</h1>
{!! Form::open(['url' => 'office/job/reject/'. $job->id , 'method' => 'POST', 'class' => 'ui form']) !!}
<div class="ui segments">
  <div class="ui clearing padded red segment">
    
    <table class="ui structured table">
      <thead>
        <tr>
          <th></th>
          <th></th>
          <th class="seven wide">Reject Code</th>
        </tr>
      </thead>
      <tr>
        <td>Category</td>
        <td>
          {{$job->category_group}} :: {{$job->category}} 
        </td>
        <td>
          {!! Form::select('category[reject_code]', App\Enums\Categories::forOptionalForm(), $codes->get('category') ,['class' => 'ui fluid dropdown']) !!}
        </td>
      </tr>
      @foreach ($job->jobAreaIds as $index => $jobArea)
      <tr>
        @if ($index==0)
          <td rowspan="{{$job->jobAreaIds->count()}}">Areas</td>
        @endif
        <td>
          {{$jobArea}}
        </td>
        <td>
          {!! Form::select('area['.$jobArea->area_id.']', App\Enums\JobRejectCodes::forOptionalForm([App\Enums\JobRejectCodes::PROHIBITED]), $codes->get('area.'.$jobArea->area_id) ,['class' => 'ui fluid dropdown']) !!}
        </td>
      </tr>
      @endforeach
      <tr>
        <td>Title</td>
        <td> {{$job->title}} </td>
        <td>
          {!! Form::select('title[reject_code]', App\Enums\JobRejectCodes::forOptionalForm(), $codes->get('title') ,['class' => 'ui fluid dropdown']) !!}
        </td>
      </tr>
      <tr>
        <td>Description</td>
        <td> {{$job->description}} </td>
        <td>
          {!! Form::select('description[reject_code]', App\Enums\JobRejectCodes::forOptionalForm(), $codes->get('description') ,['class' => 'ui fluid dropdown']) !!}
        </td>
      </tr>
      @for ($i = 1; $i < 5; $i++)
        @if ($job_photopath = $job->{'photo'.$i.'_path'})
      <tr>
        @if ($i==1)
          <td rowspan="4">Photo</td>
        @endif
        <td>
          <div class="ui tiny images">
              <img src="{{'/files/' . $job_photopath}}" alt="" class="ui image">
          </div>
        </td>
        <td>
          {!! Form::select('photo'.$i.'_path[reject_code]', App\Enums\JobRejectCodes::forOptionalForm(), $codes->get('photo'.$i.'_path') ,['class' => 'ui fluid dropdown']) !!}
        </td>
      </tr>
        @endif
      @endfor
      <tr>
        <td>Price</td>
        <td> RM {{$job->amount}} </td>
        <td>
          {!! Form::select('amount[reject_code]', App\Enums\JobRejectCodes::forOptionalForm([App\Enums\JobRejectCodes::UNREASONABLE]), $codes->get('amount') ,['class' => 'ui fluid dropdown']) !!}
        </td>
      </tr>
      <tr>
        <td>Duration</td>
        <td> {{mins2HrsMins($job->minutes)}} </td>
        <td>
          {!! Form::select('duration[reject_code]', App\Enums\JobRejectCodes::forOptionalForm([App\Enums\JobRejectCodes::UNREASONABLE]), $codes->get('duration') ,['class' => 'ui fluid dropdown']) !!}
        </td>
      </tr>
      <tfoot class="full-width">
        <tr>
          <th colspan="3">
            <button type="submit" class="ui negative right labeled icon button">
              Reject <i class="remove icon"></i>
            </button>
            @if (url()->previous() == url()->current())
              <a href="/office/job/{{$job->id}}" class="ui cancel basic button">
                Back to service
              </a>
            @else
              <a href="{{url()->previous()}}" class="ui cancel basic button">
                Cancel
              </a>
            @endif
          </th>
        </tr>
      </tfoot>
    </table>
  </div>

</div>
{!! Form::close() !!}


{!! Form::open(['url' => '/office/job/approve/'.$job->id, 'class' => 'ui small approve_job modal']) !!}
  <div class="header capitalized">
    Job Approval
  </div>
  <div class="center aligned content">
    <p>Confirm approval of this job - <b>{{ $job }}</b>:</p>
  </div>
  <div class="actions">
    <button type="submit" class="ui positive right labeled icon button">
      Approve <i class="checkmark icon"></i>
    </button>
    <div class="ui cancel basic button">
      Cancel
    </div>
  </div>
{!! Form::close() !!}

@endsection
