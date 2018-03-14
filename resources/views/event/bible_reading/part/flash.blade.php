@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
<div class="ui positive message">
  <i class="close icon"></i>
  <div class="uppercased header">{{ session('success') }}</div>
  <p>{{ session('message') }}</p>
</div>
@endif
@if (session('error'))
<div class="ui negative message">
  <i class="close icon"></i>
  <div class="uppercased header">{{ session('error') }}</div>
  <p>{{ session('message') }}</p>
</div>
@endif
@if (session('info'))
<div class="ui info message">
  <i class="close icon"></i>
  <div class="uppercased header">{{ session('info') }}</div>
  <p>{{ session('message') }}</p>
</div>
@endif
