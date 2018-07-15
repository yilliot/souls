@extends('admin.layout')
@section('title')
Service details
@endsection
@section('content')
@include('partial.firebase')
<script>
  const status = {
    going: 'forecast_yes',
    ['not going']: 'forecast_no',
    ['to be confirmed']: 'tbc'
  }
  window.onload = function() {
    let count_template = function() {
      return {souls: 0, guests: 0, count: function() {
        return this.souls + this.guests;
      }};
    }
    let attended_count = {data: {}, soul_count: function() {
      let count = 0;
      for (let i in this.data) {
        count += this.data[i].souls;
      }
      return count;
    }, guest_count: function() {
      let count = 0;
      for (let i in this.data) {
        count += this.data[i].guests;
      }
      return count;
    }};
    let forecast_count = {data: {}, soul_count: function() {
      let count = 0;
      for (let i in this.data) {
        count += this.data[i].souls;
      }
      return count;
    }, guest_count: function() {
      let count = 0;
      for (let i in this.data) {
        count += this.data[i].guests;
      }
      return count;
    }};

    firebaseDo(function() {
      let souls = {};
      db.collection("services").doc("{{$service->id}}").collection("souls")
        .onSnapshot(function(querySnapshot) {
          querySnapshot.forEach(function(doc) {
            let {cg_id, soul_id, is_attended, forecast_status} = doc.data()
            if (!souls[cg_id]) souls[cg_id] = {};
            souls[cg_id][soul_id] = {is_attended, forecast_status};
          });
          for (let cg in souls) {
            if(!attended_count.data[cg]) attended_count.data[cg] = count_template();
            if(!forecast_count.data[cg]) forecast_count.data[cg] = count_template();
            attended_count.data[cg].souls = 0;
            forecast_count.data[cg].souls = 0;
            for (let id in souls[cg]) {
              document.getElementById('soul' + id).classList.forEach(function(className) {
                document.getElementById('soul' + id).classList.remove(className);
              });
              console.log(document.getElementById('soul' + id));
              console.log(status[souls[cg][id].forecast_status]);
              document.getElementById('soul' + id).classList.add(status[souls[cg][id].forecast_status]);
              if (souls[cg][id].is_attended)
              document.getElementById('soul' + id).classList.add("attended");
            
              if(souls[cg][id].forecast_status == 'going') forecast_count.data[cg].souls++;
              if(souls[cg][id].is_attended) attended_count.data[cg].souls++;
            }
            document.getElementById('cg_forecast' + cg).innerHTML = forecast_count.data[cg].count();
            document.getElementById('cg_attended' + cg).innerHTML = attended_count.data[cg].count();
            document.getElementById('summary_forecast' + cg).innerHTML = `${forecast_count.data[cg].souls} + ${forecast_count.data[cg].guests}`
            document.getElementById('summary_attended' + cg).innerHTML = `${attended_count.data[cg].souls} + ${attended_count.data[cg].guests}`;
          }
          document.getElementById('summary_total_forecast').innerHTML = `${forecast_count.soul_count()} + ${forecast_count.guest_count()}`
          document.getElementById('summary_total_attended').innerHTML = `${attended_count.soul_count()} + ${attended_count.guest_count()}`;
          // console.log(souls);
        });
      db.collection("services").doc("{{$service->id}}").collection("guests")
        .onSnapshot(function(querySnapshot) {
          let guests = {};
          querySnapshot.forEach(function(doc) {
            let {cg_id, soul_id, is_attended, name} = doc.data();
            if (!guests[cg_id]) guests[cg_id] = [];
            guests[cg_id].push({soul_id, is_attended, name});
          });
          for (let cg in guests) {
            if(!attended_count.data[cg]) attended_count.data[cg] = count_template();
            if(!forecast_count.data[cg]) forecast_count.data[cg] = count_template();
            attended_count.data[cg].guests = 0;
            forecast_count.data[cg].guests = 0;
            document.getElementById('cg' + cg).innerHTML = '';
            guests[cg].forEach(function(guest) {
              document.getElementById('cg' + cg).innerHTML += `
                <li class="${guest.is_attended? 'attended': ''}">
                  <span class="guest-name">${guest.name}</span>
                  <span class="invitor-name">${document.getElementById('soul'+guest.soul_id).getAttribute('data-name')}</span>
                </li>
              `;
              forecast_count.data[cg].guests++;
              if(guest.is_attended)attended_count.data[cg].guests++;
            });
            document.getElementById('cg_forecast' + cg).innerHTML = forecast_count.data[cg].count();
            document.getElementById('cg_attended' + cg).innerHTML = attended_count.data[cg].count();
            document.getElementById('summary_forecast' + cg).innerHTML = `${forecast_count.data[cg].souls} + ${forecast_count.data[cg].guests}`
            document.getElementById('summary_attended' + cg).innerHTML = `${attended_count.data[cg].souls} + ${attended_count.data[cg].guests}`;
          }
          document.getElementById('summary_total_forecast').innerHTML = `${forecast_count.soul_count()} + ${forecast_count.guest_count()}`
          document.getElementById('summary_total_attended').innerHTML = `${attended_count.soul_count()} + ${attended_count.guest_count()}`;
          // console.log(guests);
        });
    });
  }
</script>
<style>
  .attended {background-color: green; color: white;}
  .forecast_yes::after { content: "🌱";}
  .forecast_no::after { content: "❗";}
  ol.list {
    padding-left: 15px;
  }
  .guest-name{color: #000;}
  .attended > .guest-name{color: white;}
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
            <td id="summary_forecast{{$cellgroup->id}}"> 0 + 0</td>
            <td id="summary_attended{{$cellgroup->id}}"> 0 + 0 </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th> Total </th>
          <th id="summary_total_forecast"> 0 + 0</th>
          <th id="summary_total_attended"> 0 + 0</th>
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
            <span id="cg_forecast{{$cg->id}}" class="total_forecast_yes">0</span>
              +
            <span id="cg_attended{{$cg->id}}" class="total_attended">0</span>
          </div>
          <div class="description">
            <ol class="list">
              @foreach ($cg->members as $soul)
                <li data-name="{{$soul}}" id="soul{{$soul->id}}">{{$soul}}</li>
              @endforeach
            </ol>
          </div>
        </div> <!-- content -->
        <div class="extra content">
          <ol class="list" id="cg{{$cg->id}}">
          </ol>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
