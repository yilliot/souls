@extends('event.just_begin.layout')

@section('title')
3KM Validation
@endsection

@section('content')
  <div class="ui inverted segment container">
    <h1 class="ui center aligned icon header">
      Validation
    </h1>
    @include('event.just_begin.part.flash')
    <table class="ui inverted unstackable small compact basic table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Date</th>
          <th>Time</th>
          <th>CG</th>
          <th>KM</th>
          <th>Name</th>
          <th></th>
          <th>Speed</th>
          <th>Action</th>
        </tr>
      </thead>
    @forelse ($records as $id => $record)
      <tr>
        <td>
          {{$record->id}}
        </td>
        <td>
          {{$record->created_at->format('j M')}}
        </td>
        <td>
          {{$record->created_at->format('h:ia')}}
        </td>
        <td>
          <div class="ui {{$record->cellgroup->color}} small label">
            {{$record->cellgroup}}
          </div>
        </td>
        <td>
          @if ($record->meters > 10000)
            <span class="ui teal label">
              {{number_format($record->meters/1000, 2)}}km
            </span>
          @elseif ($record->meters < 3000)
            <span class="ui brown label">
              {{number_format($record->meters/1000, 2)}}km
            </span>
          @else
            {{number_format($record->meters/1000, 2)}}km
          @endif
        </td>
        <td>
          {{$record->soul->nickname}}
        </td>
        <td>
        </td>
        <td>
          @if ($record->speed < 5)
            <span class="ui brown label">
              <div>{{number_format( $record->pace, 2)}} mins/km</div>
              <div>{{number_format( $record->speed , 2)}} km/h</div>
            </span>
          @elseif ($record->speed > 9)
            <span class="ui teal label">
              <div>{{number_format( $record->pace, 2)}} mins/km</div>
              <div>{{number_format( $record->speed , 2)}} km/h</div>
            </span>
          @else
          <div>{{number_format( $record->pace, 2)}} mins/km</div>
          <div>{{number_format( $record->speed , 2)}} km/h</div>
          @endif
        </td>
        <td>
          <div class="ui mini icon buttons">
            <button class="ui pink button">
              <i class="remove icon"></i>
            </button>
            <button class="ui olive button">
              <i class="edit icon"></i>
            </button>
            <button class="ui orange button" data-featherlight="/storage/{{$record->screenshot_path}}">
              <i class="eye icon"></i>
            </button>
          </div>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="4">
          <div class="ui inverted red basic segment">
            {{trans('event.just_begin.no_result')}}
          </div>
        </td>
      </tr>
    @endforelse
    </table>
  </div>
@endsection
