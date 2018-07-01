@extends('auth.layout')

@section('title')
    {{trans('attendance.forecast.title')}} @parent
@endsection

@section('content-blank')
@include('partial.firebase')
<script>
  window.onload = function() {
    firebaseDo(function() {
      Array.from(document.getElementsByClassName('submit-forecast'))
        .forEach(function(button){
          button.onclick = function(e) {
            const status = {
              go: 'going',
              ng: 'not going',
              tbc: 'to be confirmed'
            }
            e.preventDefault();
            db.collection("services")
            .doc("{{$service->id}}")
            .collection("souls")
            .doc("{{Auth::user()->soul_id}}")
              .set({
                forecast_status: status[this.id],
                cg_id: {{Auth::user()->soul->cellgroup_id}},
                soul_id: {{Auth::user()->soul_id}},
                is_attended: false
              }, { merge: true });
            return false;
          }
      });


      db.collection("services")
      .doc("{{$service->id}}")
      .collection("souls")
      .onSnapshot(function(querySnapshot) {
        let souls = {};
        querySnapshot.forEach(function(soul) {
          let {soul_id, cg_id, is_attended, forecast_status} = soul.data();
          if(!souls[cg_id])souls[cg_id] = {};
          souls[cg_id][soul_id] = {is_attended, forecast_status};
        });
        Array.from(document.getElementsByClassName('forecast-status'))
          .forEach(function(element){
            if(Object.keys(souls).includes('{{$cg->id}}')) {
              let status = souls['{{$cg->id}}'][element.id.slice(4)];
              element.classList.remove('positive');
              element.classList.remove('negative');
              if(status) element.classList.add(status.forecast_status == 'to be confirmed' || status.forecast_status == 'not going' ? 'negative': 'positive');
            }
        });

        Array.from(document.getElementsByClassName('circle'))
          .forEach(function(element){
            if(Object.keys(souls).includes('{{$cg->id}}')) {            
              let status = souls['{{$cg->id}}'][element.id.slice(9)];
              element.classList.remove('outline');
              if(status && (status.forecast_status == 'to be confirmed')) element.classList.add('outline');
            }
        });

      });

      db.collection("services")
      .doc("{{$service->id}}")
      .collection("guests")
      .onSnapshot(function(querySnapshot) {
        let guests = {};
        querySnapshot.forEach(function(guest) {
          let {soul_id, cg_id, is_attended, name} = guest.data();
          if(!guests[cg_id])guests[cg_id] = {};
          if(!guests[cg_id][soul_id])guests[cg_id][soul_id] = [];
          guests[cg_id][soul_id].push({is_attended, name});
        });
        console.log(guests);

        Array.from(document.getElementsByClassName('guest'))
          .forEach(function(element){
            if(Object.keys(guests).includes('{{$cg->id}}')) {            
              let content = '';
              let guests_list = guests['{{$cg->id}}'][element.id.slice(5)]? guests['{{$cg->id}}'][element.id.slice(5)]: [];
              for(let x in guests_list) {
                content += '<div>' + guests_list[x].name + '</div>';
              }
              if(content)element.innerHTML = content;
            }
        });

      });

    });
  }
</script>
<h2> {{ trans('attendance.forecast.greet2') }} </h2>

<div class="header">{{$service->topic}}</div>
<div>{{$service->at->format('(D) d M, h:iA')}} @ {{$service->venue}}</div>

<div class="ui divider"></div>

<div class="border-inset">

  <h2>{{trans("attendance.forecast.you-re")}}<span id="user_action">{{trans("attendance.forecast.not-responded-yet")}}</span></h2>

  <div class="ui form">
    {{csrf_field()}}
    <div class="ui fluid buttons">
      <button id="go"  class="ui button submit-forecast">{{trans("attendance.forecast.going")}}</button>
      <button id="ng"  class="ui button submit-forecast">{{trans("attendance.forecast.not-going")}}</button>
      <button id="tbc" class="ui button submit-forecast">{{trans("attendance.forecast.tbc")}}</button>
    </div>
  </div>
  <div class="ui hidden divider"></div>
  <a class="ui primary fluid mini button" href="/attendance/forecast/service/{{$service->id}}/guests">{{trans("attendance.forecast.bring-someone")}}</a>

</div>

<h2 class="ui header">What's up, {{$cg}}!
  <div class="sub header">3 {{trans("attendance.forecast.going")}}</div>
</h2>

<table class="ui very basic very compact unstackable table">
  <tbody>
  @foreach ($members as $member)
    <tr>
      <td>{{$member}} </td>
      <td id={{'soul' . $member->id}} class="forecast-status positive">
        {{-- <i class="circle outline icon"></i> --}}
        <i id={{'indicator' . $member->id}} class="circle icon"></i>
      </td>
      <td id={{'guest' . $member->id}} class="guest">
        <div>Guest 01</div>
        <div>Guest 02</div>
        <div>Guest 03</div>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>

@endsection