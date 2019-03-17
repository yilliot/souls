@extends('admin.layout')
@section('title')
Group details
@endsection
@section('content')

<a class="ui large header" href="{{url()->previous()}}" ><i class="arrow left icon"></i>Group Detail</a>
<div class="ui stackable column grid">
  <div class="five wide column">
    <div class="ui fluid card">
      <div class="content">
        <span class="large header">{{$group->name}}</span>
        <div class="meta"><span class="status">{{prefix()->wrap($group)}}</span></div><br/>
        <div class="extra content">
          <span class="large header">Leader :</span>
          {{$group->leader}} <br/>
          {{$group->colead1}} <br/>
          {{$group->colead2}} <br/>

          <br/>
          @if ($group->is_active)
            <div class="ui green label">active</div>
          @else
            <div class="ui grey label">not active</div>
          @endif
          <br>
          <i class="call icon"></i>{{$group->leader->contact}}<br/>
          @if ($group->colead1)
            <i class="call icon"></i>{{$group->colead1->contact}}<br/>
          @endif
          @if ($group->created_at)
            <i class="wait icon"></i>since {{$group->created_at->toFormattedDateString()}}<br/>
          @endif
        </div>
      </div>
    </div>
  </div>
  <div class="eleven wide column">
    <div class="ui header">members</div>
    <table class="ui very compact unstackable table">
      @foreach ($group->souls as $soul)
        <tr>
          <td>{{$soul->nickname}}</td>
          <td>
            <a href="/admin/soul/{{$soul->id}}">
              <i class="eye icon"></i>
            </a>
          </td>
        </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection
