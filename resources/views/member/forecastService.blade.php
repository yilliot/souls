{{$soul->name}}
<br>
@forelse($services as $service)
{{$service->at}}<br>
@empty
@endforelse

@forelse($serviceAttendances as $serviceAttendance)
{{$serviceAttendance->service->at}}<br>
@empty
@endforelse
