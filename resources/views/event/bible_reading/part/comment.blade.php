<div class="ui link fluid card">
  <div class="content">
    <div class="header">{{ trans('event.bible_reading.bible_books.' . $comment->chapter()->first()->book_name) }}-{{ $comment->chapter()->first()->chapter_number }}</div>
    <div class="meta">
      <span class="category">
        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',  $comment->created_at)->toDayDateTimeString() }}
      </span>
    </div>
    <div class="description">
      <p>
        {{ $comment->content }}
      </p>
    </div>
  </div>
  <div class="extra content">
    <div class="right floated author">
      <i class="user icon"></i>
       {{ $comment->soul()->first()->nickname }}
    </div>
  </div>
</div>