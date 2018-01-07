<div class="ui link fluid card">
  <div class="content">
    <div class="header">{{ trans('event.bible_reading.bible_books.' . $comment['bible_book']) }}-{{ $comment['bible_book_chapter'] }}</div>
    <div class="meta">
      <span class="category">
        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',  $comment->created_at)->toDayDateTimeString() }}
      </span>
    </div>
    <div class="description">
      <p>
        {!! nl2br(e($comment->content)) !!}
      </p>
    </div>
  </div>
  <div class="extra content">
    <div class="fb-like" data-href="http://hcc.ground.my/bible_reading/?comment={{$comment->id}}" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>
    <div class="right floated author">
      <i class="user icon"></i>
       {{ $comment['author_name'] }}
    </div>
  </div>
</div>