@extends('office.layout.base')
@section('content')
<h1 class="ui header">Seller details</h1>


<div class="ui stackable column grid">
  <div class="five wide column">
    <div class="ui fluid card">
      <div class="image">
        <img src="{{$seller->legal_id_url}}">
      </div>

      @if ($seller->approval_code == App\Enums\ApprovalCodes::PENDING)
        <div class="ui red modalcaller button" data-modal-id="reject_legal_id">Reject</div>
      @endif

    </div> {{-- ui fluid card --}}
  </div> {{-- five wide column --}}
  <div class="eleven wide column">
  {!! Form::open(['url' => '/office/seller/verify/'.$seller->id, 'method' => 'POST', 'class' => 'ui form']) !!}
    <table class="ui table">
      <tr>
        <td>Legal ID</td>
        <td> <input type="text" name="legal_id" value="{{$seller->legal_id}}"> </td>
      </tr>
      <tr>
        <td>Legal Full Name</td>
        <td> <input type="text" name="legal_full_name" value="{{$seller->legal_full_name}}"> </td>
      </tr>
      <tr>
        <td>
          Approval Status
        </td>
        <td>
          {!! Form::select('approval_code', \App\Enums\ApprovalCodes::all(), $seller->approval_code, ['class' => 'ui fluid dropdown']) !!}
        </td>
      </tr>
      @if ($seller->legal_reject_code)
        <tr>
          <td>Rejected Reason</td>
          <td> {{$seller->legal_reject_code_translate}} </td>
        </tr>
      @endif
      <tr>
        <td>
          <button class="ui teal button"> Update </button>
        </td>
        <td></td>
      </tr>
    </table>
  {{ Form::close() }}
  </div> {{-- eleven wide column --}}
</div> {{-- ui stackable column grid --}}


{!! Form::open(['url' => '/office/seller/verify/'.$seller->id, 'class' => 'ui small reject_legal_id modal']) !!}
  <div class="header capitalized">
    Reject Legal ID
  </div>
  <div class="center aligned content">
    <p>Confirm reject of this legal ID - <b>{{ $seller }}</b>:</p>
    <input type="hidden" name="approval_code" value="{{\App\Enums\ApprovalCodes::REJECTED}}">

    {!! Form::select('legal_reject_code', \App\Enums\LegalRejectCodes::all(), $seller->legal_reject_code, ['class' => 'ui fluid dropdown']) !!}

  </div>
  <div class="actions">
    <button type="submit" class="ui positive right labeled icon button">
      Submit <i class="checkmark icon"></i>
    </button>
    <div class="ui cancel basic button">
      Cancel
    </div>
  </div>
{!! Form::close() !!}
@endsection