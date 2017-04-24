@extends('office.layout.base')
@section('title')
Services
@endsection
@section('content')
<h1 class="ui header">Services</h1>
<div class="ui segment">
  {!! Form::open(['url' => url()->current(), 'class' => 'ui form', 'method' => 'GET']) !!}
    {!! Form::select('approval_code', \App\Enums\ApprovalCodes::forFilters(), $filter['approval_code'], ['class' => 'ui dropdown']) !!}
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
<table class="ui table">
  <thead>
    <tr>
      <th>{!! sort_by('id', 'ID' ) !!}</th>
      <th class="three wide">Title</th>
      <th class="two wide">{!! sort_by('category_id', 'Catagory') !!}</th>
      <th>Seller</th>
      <th>Areas</th>
      <th>Job Status</th>
      <th>ID Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($jobs as $job)
      <tr>
        <td> {{prefix()->wrap($job)}} </td>
        <td> {{$job->title}} </td>
        <td> {{$job->category}} <div class="ui small">:: {{$job->categoryGroup}}</div> </td>
        <td> {{$job->seller}} </td>
        <td>
          @foreach ($job->jobAreaIds as $area)
             <div>{{ $area }}</div>
           @endforeach 
        </td>
        <td class="{{$job->approval_code==1?'positive':''}} {{$job->approval_code==2?'negative':''}}">
          {{$job->approval_code_translate}}
        </td>
        <td class='{{$job->seller->approval_code==1?'positive':''}} {{$job->seller->approval_code==2?'negative':''}}'>
          {{$job->seller->approval_code_translate}}
        </td>
        <td>
          <div class="ui small icon buttons">
            <a href="/office/job/{{$job->id}}" class="ui teal button">
              <i class="eye icon"></i>
            </a>
          </div>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="5"> No jobs, change filter or come back later </td>
      </tr>
    @endforelse
  </tbody>
</table>
{{ $jobs->appends(['approval_code' => $filter['approval_code']])->links() }}
@endsection
