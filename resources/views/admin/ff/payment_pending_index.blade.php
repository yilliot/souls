@extends('admin.layout')
@section('title')
Pending Payment
@endsection
@section('content')
<h1 class="ui header">Pending Payment</h1>
<table class="ui very compact unstackable table">
  <thead>
    <tr>
      <th >{!! sort_by('id', 'ID' ) !!}</th>
      <th  class="three wide">Name</th>
      <th >Amount</th>
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
            <div class="sub uppercased header">
              {{ $payment->code }}
            </div>
          </h5>
        </td>
        <td>
          <h5 class="ui header">
            {{ $payment->pledge->name }}
            @if ($payment->pledge->soul)
              <div class="sub uppercased header">{{ $payment->pledge->soul->nickname }}</div>
            @endif
          </h5>
        </td>
        <td>
            <div>RM {{$payment->amount}}</div>
            <div>{{$payment->remarks}}</div>
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
        <td colspan="5"> No future fund session, change filter or come back later </td>
      </tr>
    @endforelse
  </tbody>
</table>
@endsection
