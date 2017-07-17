@extends('admin.layout')
@section('title')
Service attendance
@endsection
@section('content')

<a class="ui large header" href="/admin/service/{{$service->id}}" ><i class="arrow left icon"></i>Service attendance</a>
<div class="ui stackable column grid">
  <div class="sixteen wide column">
    <table class="ui table">
      @foreach ($souls as $soul)
      <tr>
        <td>
          {{$soul}}
        </td>
        <td>
          <span class="ui green label">
            <i class="check icon"></i>
          </span>
        </td>
        <td>
          <button class="ui red tiny icon button">
            <i class="remove icon"></i>
          </button>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection
