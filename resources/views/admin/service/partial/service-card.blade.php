<div class="ui fluid card">
  <div class="content">
    <h1 class="ui header">
      {{ $service->topic }}
      <div class="sub header">
        {{ $service->at->toDateString() }}
      </div>
    </h1>
    <div> <i class="circle info icon"></i>{{ prefix()->wrap($service) }}</div>
    <div> <i class="power icon"></i> {{ $service->speaker }}</div>
    <div> <i class="map pin icon"></i> {{ $service->venue }}</div>
    <div>{{ $service->type }}</div>
  </div>
</div>