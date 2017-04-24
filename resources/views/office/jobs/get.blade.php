@extends('office.layout.base')
@section('title')
Service details
@endsection
@section('content')
<h1 class="ui header">Service details</h1>

<div class="ui stackable column grid">
  <div class="five wide column">
    <div class="ui fluid card">
      <div class="content">
        <h2 class="ui header">{{$job->seller->legal_full_name}}</h2>
        <div class="meta">
          <div class="ui list">
            <div class="item"> <i class="user icon"></i> <div class="content">{{prefix()->wrap($job->seller)}}</div></div>
            <div class="item"> <i class="info circle icon"></i> <div class="content">{{$job->seller->legal_id}}</div></div>
            <div class="item"> <i class="payment icon"></i> <div class="content">{{$job->seller->bank_account_number}}</div></div>
            <div class="item"> <i class="university icon"></i> <div class="content">{{$job->seller->bank_name}}</div></div>
          </div>
        </div> {{-- meta --}}
      </div> {{-- content --}}
      <div class="content">
        <h4 class="ui header">Seller Actions</h4>
      </div>
      @if ($job->seller->approval_code==0)
        <a href="/office/seller/verify/{{$job->seller->id}}" class="ui basic extra content button">Verify Seller</a>
      @endif
      <div class="content">
        <h4 class="ui header">Service Actions</h4>
      </div>
      @if ($job->approval_code==0)
        <div class="ui basic extra content modalcaller button" data-modal-id="approve_job">Approve Service</div>
        <a href="/office/job/reject/{{$job->id}}" class="ui basic extra content button">Reject Service</a>
      @endif
      @if ($job->approval_code==1)
        <div class="ui basic extra content modalcaller button" data-modal-id="freeze_job">Freeze Service</div>
      @endif

    </div> {{-- ui fluid card --}}
  </div>
  <div class="eleven wide column">
    <div class="ui segments">
      <div class="ui clearing padded red segment">
        
        <table class="ui very basic table">
          <tr>
            <td>Category</td>
            <td>
              {{$job->category_group}} :: {{$job->category}} 
            </td>
          </tr>
          <tr>
            <td>Areas</td>
            <td>
              @foreach ($job->jobAreaIds as $jobArea)
              {{$jobArea}}
              @endforeach
            </td>
          </tr>
          <tr>
            <td>Title</td>
            <td> {{$job->title}} </td>
          </tr>
          <tr>
            <td>Description</td>
            <td> {{$job->description}} </td>
          </tr>
          <tr>
            <td>Approval Code</td>
            <td> {{$job->approval_code_translate}} </td>
          </tr>
          <tr>
            <td>Is Accepting Appointment (from seller)</td>
            <td> {{$job->is_accept_appointment_translate}} </td>
          </tr>
          <tr>
            <td>Is Freezed</td>
            <td> {{$job->is_freezed_translate}} </td>
          </tr>
          <tr>
            <td>Photo</td>
            <td>
              <div class="ui tiny images">
              @for ($i = 1; $i < 5; $i++)
                @if ($job_photopath = $job->{'photo'.$i.'_path'})
                  <img src="{{'/files/' . $job_photopath}}" alt="" class="ui image">
                @endif
              @endfor
              </div>
            </td>
          </tr>
          <tr>
            <td>Amount</td>
            <td> RM {{$job->amount}} </td>
          </tr>
          <tr>
            <td>Minutes</td>
            <td> {{mins2HrsMins($job->minutes)}} </td>
          </tr>
        </table>
      </div>

    </div>
  </div>
</div>

{!! Form::open(['url' => '/office/job/approve/'.$job->id, 'class' => 'ui small approve_job modal']) !!}
  <div class="header capitalized">
    Service Approval
  </div>
  <div class="center aligned content">
    <p>Confirm approval of this service - <b>{{ $job }}</b>:</p>
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

{!! Form::open(['url' => '/office/job/freeze/'.$job->id, 'class' => 'ui small freeze_job modal']) !!}
  <div class="header capitalized">
    Service Freeze
  </div>
  <div class="center aligned content">
    <p>Confirm freeze of this service - <b>{{ $job }}</b>:</p>
  </div>
  <div class="actions">
    <button type="submit" class="ui negative right labeled icon button">
      Freeze <i class="lightning icon"></i>
    </button>
    <div class="ui cancel basic button">
      Cancel
    </div>
  </div>
{!! Form::close() !!}

@endsection
