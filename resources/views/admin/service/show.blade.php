@extends('admin.layout')
@section('title')
Service details
@endsection
@section('content')
@include('partial.firebase')
<script>
  auth.signInWithEmailAndPassword('admin@mail.io', 'secret').then(function() {
    db.collection("services").doc("{{$service->id}}").collection("souls")
      .onSnapshot(function(querySnapshot) {
        let souls = {};
        querySnapshot.forEach(function(doc) {
          let {cg_id, soul_id, is_attended, forecast_status} = doc.data()
          if (!souls[cg_id]) souls[cg_id] = {};
          souls[cg_id][soul_id] = {is_attended, forecast_status};
        });
        console.log(souls);
      });
    db.collection("services").doc("{{$service->id}}").collection("guests")
      .onSnapshot(function(querySnapshot) {
        let guests = {};
        querySnapshot.forEach(function(doc) {
          let {cg_id, soul_id, is_attended, name} = doc.data();
          guests[doc.data().cg_id] = {is_attended, forecast_status, name};
        });
      });
  }).catch(function(e) {
    console.log(e);
  });
</script>
<style>
  .attended {background-color: green; color: white;}
  .forecast_yes::after { content: "🌱";}
  .forecast_no::after { content: "❗";}
  ol.list {
    padding-left: 15px;
  }
  .guest-name{color: #000;}
  .invitor-name{ font-size: 0.7em;}
  .invitor-name::after {content: ")"; }
  .invitor-name::before {content: "("; }
</style>
<a class="ui large header" href="{{url()->previous()}}" ><i class="arrow left icon"></i>Service Detail</a>


<div class="ui hidden divider"></div>
<div class="ui stackable column grid">
  <div class="four wide column">
    @include('admin.service.partial.service-card', ['service' => $service])
    <a href="/admin/service/{{$service->id}}/edit" class="ui icon teal fluid button">
      <i class="pencil icon"></i>
      edit
    </a>

    <table class="ui striped unstackable compact table">
      <thead>
        <tr>
          <th>Cellgroup</th>
          <th>Forecast</th>
          <th>Attendance</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($cellgroups as $cellgroup)
          <tr>
            <td> {{$cellgroup}} </td>
            <td> 0 + 0</td>
            <td> 0 + 0 </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th> Total </th>
          <th> 0 + 0</th>
          <th> 0 + 0</th>
        </tr>
      </tfoot>
    </table>

  </div>
  <div class="twelve wide column">
    <div class="ui four doubling cards">
      @foreach ($cellgroups as $cg)
      <div class="card">
        <div class="content">
          <div class="header">
            {{$cg}}
          </div>
          <div class="meta">
            <span class="total_forecast_yes">8</span>
              +
            <span class="total_attended">7</span>
          </div>
          <div class="description">
            <ol class="list">
              <li><span class="forecast_yes attended">Member 001</span></li>
              <li><span class="attended">Member 005</span></li>
              <li><span class="forecast_no">Member 002</span></li>
              <li><span class="forecast_yes">Member 003</span></li>
              <li><span class="">Member 004</span></li>
            </ol>
          </div>
        </div> <!-- content -->
        <div class="extra content">
          <ol class="list">
            <li><span class="guest-name">Guest 01</span> <span class="invitor-name">Member 001</span></li>
            <li><span class="guest-name">Guest 02</span> <span class="invitor-name">Member 001</span></li>
            <li><span class="guest-name">Guest 03</span> <span class="invitor-name">Member 001</span></li>
          </ol>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
