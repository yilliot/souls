<div class="ui teal progress" data-percent="{{ $amount / 1189 * 100}}" id="example1">
  <div class="bar"></div>
  <div class="label">{{ round($amount / 1189 * 100, 2) }}% {{trans('event.bible_reading.chapter_read')}}</div>
</div>