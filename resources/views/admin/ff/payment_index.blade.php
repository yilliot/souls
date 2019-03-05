@extends('admin.layout')
@section('title')
Payment
@endsection
@section('content')

<a href="/admin/ff/payment/create/{{$pledge->id}}" class="ui teal button right floated">New Payment</a>
<h1 class="ui header">Payments</h1>

<div class="ui horizontal divider">{{$pledge->name}}'s <br> Summary </div>

<table class="ui unstackable table">
  <thead>
    <tr>
      <th class="center aligned"> {{trans('futurefund.total_pledge')}} </th>
      <th class="center aligned"> {{trans('futurefund.collected')}} </th>
      <th class="center aligned"> {{trans('futurefund.balance')}} </th>
    </tr>
  </thead>
  <tr>
    <td class="center aligned">RM {{number_format($pledge->amount, 2)}}</td>
    <td class="center aligned">RM {{number_format($pledge_collected, 2)}}</td>
    <td class="center aligned">RM {{number_format(($pledge->amount - $pledge_collected), 2)}}</td>
  </tr>
</table>


<div class="ui horizontal divider">{{$pledge->name}}'s <br> Payments </div>

<div class="ui segment">
    {!! Form::select('is_cleared', ['0' => 'Not cleared', '1' => 'Cleared', 'all' => 'All'], $filter['is_cleared'], ['class' => 'ui dropdown']) !!}
    {!! Form::select('is_cancelled', ['0' => 'Not cancelled', '1' => 'Cancelled', 'all' => 'All'], $filter['is_cancelled'], ['class' => 'ui dropdown']) !!}
    <div class="clearfix field">
      <a href="{{ url()->current() }}" class="ui basic right floated right labeled icon tiny button">
        Reset <i class="undo icon"></i>
      </a>
      <button class="ui teal right floated right labeled icon tiny button">
        Filter <i class="filter icon"></i>
      </button>
    </div>
    <div class="ui hidden divider"></div>
  {!! Form::close() !!}
</div>
<table class="ui very compact unstackable table">
  <thead>
    <tr>
      <th >{!! sort_by('id', 'ID' ) !!}</th>
      <th  class="three wide">Amount</th>
      <th >Status</th>
      <th >Created at</th>
      <th >Actions</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($payments as $payment)
      <tr>
        <td>
          <h5 class="ui header">
            {{ prefix()->wrap($payment) }}
          </h5>
        </td>
        <td>
          <h5 class="ui header">
            RM {{ $payment->amount }}
            @if ($payment->remarks)
              <div class="sub uppercased header">{{ $payment->remarks }}</div>
            @endif
          </h5>
        </td>
        <td>
          <div>
            @if ($payment->is_cancelled)
              <div class="ui grey label">cancelled</div>
            @else
              @if ($payment->is_cleared)
                <div class="ui green label">cleared</div>
              @else
                <div class="ui orange label">pending</div>
              @endif
            @endif
          </div>
        </td>
        <td>
          {{ $payment->created_at->format('Y-m-d') }}
          <div>{{ $payment->created_at->format('h:i a') }}</div>
        </td>
        <td>
          <div class="ui small icon buttons">
            <a href="/admin/ff/payment/update/{{$payment->id}}" class="ui button">
              <i class="pencil icon"></i>
            </a>
          </div>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="5"> No payment record yet, change filter or come back later </td>
      </tr>
    @endforelse
  </tbody>
</table>
@endsection
