<div class="ui fluid card">
  <div class="content">
    {{-- <div class="header">{{ $comment->title }}</div> --}}
    <div class="header">
       {{ $comment->checkInChapter->first()->checkIn->first()->soul->first()->nickname }}
    </div>
    <div class="description">
      <p>
        {{ $comment->content }}
      </p>
    </div>
  </div>
  <div class="extra content">
    <span class="left floated">
      {{ trans('event.bible_reading.bible_books.' . $comment->chapter()->first()->book_name) }}-{{ $comment->chapter()->first()->chapter_number }}
    </span>
    <span class="right floated">
      <i class="clock icon"></i>
      {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',  $comment->created_at)->diffForHumans() }}
    </span>
  </div>
</div>