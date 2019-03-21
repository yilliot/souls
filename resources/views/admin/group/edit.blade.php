@extends('admin.layout')
@section('title')
Update group
@endsection
@section('content')
<div class="ui text container">
  <h1 class="ui header">Update group</h1>
  {!! Form::open(['url' => 'admin/group/' . $group->id . '/edit', 'method' => 'POST', 'class' => 'ui form']) !!}
  <table class="ui structured table">
    <tr class="field {{$errors->has('nickname') ? 'error' : ''}}">
      <td>
        <b>Name</b>
      </td>
      <td>
        {{ Form::text('name', $group->name, ['placeholder' => 'name']) }}
        @if ($errors->has('name'))
          <span class="ui red pointing label"> {{ $errors->first('name') }}</span>
        @endif
      </td>
    </tr>

    <tr class="field {{$errors->has('leader_id') ? 'error' : ''}}">
      <td><b>Leader</b></td>
      <td>
        <select name="leader_id" class="ui search fluid dropdown">
          <option value="">Choose one</option>
          @foreach (\App\Models\Soul::all() as $soul)
            <option {{$soul->id == $group->leader_id ? 'selected' : ''}} value="{{$soul->id}}">{{$soul->nickname}}</option>
          @endforeach
        </select>
      </td>
    </tr>

    <tr class="field {{$errors->has('colead1_id') ? 'error' : ''}}">
      <td><b>Co Leader 1</b></td>
      <td>
        <select name="colead1_id" class="ui search fluid dropdown">
          <option value="">Choose one</option>
          @foreach (\App\Models\Soul::all() as $soul)
            <option {{$soul->id == $group->colead1_id ? 'selected' : ''}} value="{{$soul->id}}">{{$soul->nickname}}</option>
          @endforeach
        </select>
      </td>
    </tr>

    <tr class="field {{$errors->has('colead2_id') ? 'error' : ''}}">
      <td><b>Co Leader 2</b></td>
      <td>
        <select name="colead2_id" class="ui search fluid dropdown">
          <option value="">Choose one</option>
          @foreach (\App\Models\Soul::all() as $soul)
            <option {{$soul->id == $group->colead2_id ? 'selected' : ''}} value="{{$soul->id}}">{{$soul->nickname}}</option>
          @endforeach
        </select>
      </td>
    </tr>

    <tr class="field {{$errors->has('is_active') ? 'error' : ''}}">
      <td>
        <b>Is Active</b>
      </td>
      <td>
        {{ Form::select('is_active', \App\Enums\Boolean::all(), $group->is_active, ['class' => 'ui fluid dropdown']) }}
        @if ($errors->has('is_active'))
          <span class="ui red pointing label"> {{ $errors->first('is_active') }}</span>
        @endif
      </td>
    </tr>
    <tfoot class="full-width">
      <tr>
        <th colspan="2">
          <button type="submit" class="ui teal labeled icon button">
            Update <i class="edit icon"></i>
          </button>
          <a href="/admin/group/{{$group->id}}" class="ui teal basic button">
            View detail
          </a>
        </th>
      </tr>
    </tfoot>
  </table>
  {!! Form::close() !!}
</div>
@endsection
