@extends('auth.layout')

@section('title')
    {{trans('attendance.forecast.title')}} @parent
@endsection

@section('content-blank')
@include('partial.firebase')
<script>
  window.onload = function() {
    firebaseDo(function() {

      let guests_list = document.getElementById('guests');
      let guests = [];
      db.collection("services").doc('{{$service->id}}').collection("guests")
        .get().then(function(docs) {
          docs.forEach(function(doc) {
            let guest = doc.data();
            if(guest.soul_id == {{Auth::user()->soul_id}})guests.push(guest);
          }); 
          let content = '';
          if(guests) guests.map(function(guest) {
            content += `<input class="guest" type="text" value="${guest.name}" placeholder="name of your friend">`;
          });
          if(content) guests_list.innerHTML = content;
        });

      let add_button = document.getElementById('add-button');
      add_button.onclick = function() {
        let names = [];
        Array.from(guests_list.getElementsByTagName('input'))
          .forEach(function(input){
            names.push(input.value);
        });
        let i = 0;
        guests_list.innerHTML += `<input class="guest" type="text" placeholder="name of your friend">`;
        Array.from(guests_list.getElementsByTagName('input'))
          .forEach(function(input){
            if(names[i])input.value = names[i++];
        });
      }

      let submit = document.getElementById('submit');
      submit.onclick = function(e) {
        db.collection("services")
          .doc("{{$service->id}}")
          .collection("guests")
          .where('soul_id', '==', {{Auth::user()->soul_id}})
          .get().then(function(querySnapshot) {
            console.log(querySnapshot);
            let batch = db.batch();
            querySnapshot.forEach(function(doc) {
              batch.delete(doc.ref);
            });

        batch.commit();

        Array.from(guests_list.getElementsByTagName('input'))
          .forEach(function(input){
            name = input.value;
            if(name) {
              db.collection("services").doc("{{$service->id}}").collection("guests").add({
                soul_id: {{Auth::user()->soul_id}},
                cg_id: {{Auth::user()->soul->cellgroup_id}},
                is_attended: false,
                name: name
              }).then(function() {
                window.location.href = "/attendance/forecast/service/{{$service->id}}";
              });
            } else {
              window.location.href = "/attendance/forecast/service/{{$service->id}}";
            }
          });
        });
      }
    });
    form.onsubmit = function(e) {
      e.preventDefault();
    }
  }
</script>
<h2>{{trans("attendance.forecast.bring-someone")}} </h2>

<div class="header">{{$service->topic}}</div>
<div>{{$service->at->format('(D) d M, h:iA')}} @ {{$service->venue}}</div>

<div class="ui divider"></div>

<h2>{{trans("attendance.forecast.im-bringing")}}</h2>
<form id="form" action="/attendance/forecast/service/{{$service->id}}" class="ui form">
  {{csrf_field()}}
  <div id="add-button" class="ui labeled icon mini fluid button clone-next">
    <i class="add icon"></i> {{trans('attendance.forecast.add-one-more')}}
  </div>
  <div class="field" id="guests"><input type="text" placeholder="name of your friend"></div>
  <button id="submit" class="ui primary fluid button">Ok</button>
</form>
@endsection