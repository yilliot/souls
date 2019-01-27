<div class="ui fluid card">
  <div class="content">
    <h1 class="ui header">
      {{ $service->topic }}
      <div class="sub header">
        {{ $service->at->toDateString() }}
        <div class="ui label">{{ $service->type }}</div>
      </div>
    </h1>
    <div> <i class="time icon"></i> {{ $service->at->format('g:i A') }}</div>
    <div> <i class="power icon"></i> {{ $service->speaker }}</div>
    <div> <i class="map pin icon"></i> {{ $service->venue }}</div>
    <div class="ui divider"></div>
    <div> <i class="circle info icon"></i>{{ prefix()->wrap($service) }}</div>
  </div>
</div>