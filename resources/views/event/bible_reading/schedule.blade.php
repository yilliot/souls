@extends('event.bible_reading.layout')

@section('title')
Bible Reading Home
@endsection

@section('content')
  
@if(!session('nric'))
<a href="/event/bible_reading/signup"> {{trans('event.bible_reading.signup')}} </a> |
@endif
<a href="/event/bible_reading/checkin"> {{trans('event.bible_reading.checkin')}} </a> | 
<a href="/event/bible_reading/history"> {{trans('event.bible_reading.history')}} </a>
@if(session('nric'))
| <a href="/event/bible_reading/logout"> {{trans('event.bible_reading.logout')}} </a> 
@endif
  
  @include('event.bible_reading.part.logo')
  @include('event.bible_reading.part.flash')
  <style>
    td{text-align: center !important; padding: 1px !important;}
    td label{display: block;}
    td span{display:block; font-size: 0.8em;}
  </style>
  <h3 class="ui header">一月读经表</h3>
  <table class="ui unstackable compact table">
    <thead>
      <tr>
        <th>Mo</th>
        <th>Tu</th>
        <th>We</th>
        <th>Th</th>
        <th>Fr</th>
        <th>Sa</th>
        <th>Su</th>
      </tr>
      <tr>
        <td><label>创</label> <span>1-3</span></td>
        <td><label>创</label> <span>4-6</span></td>
        <td><label>创</label> <span>7-9</span></td>
        <td><label>创</label> <span>10-12</span></td>
        <td><label>创</label> <span>13-15</span></td>
        <td><label>创</label> <span>16-18</span></td>
        <td><label>创</label> <span>19-22</span></td>
      </tr>
      <tr>
        <td><label>创</label> <span>23-25</span></td>
        <td><label>创</label> <span>26-28</span></td>
        <td><label>创</label> <span>29-31</span></td>
        <td><label>创</label> <span>32-34</span></td>
        <td><label>创</label> <span>35-37</span></td>
        <td><label>创</label> <span>38-40</span></td>
        <td><label>创</label> <span>41-44</span></td>
      </tr>
      <tr>
        <td><label>创</label> <span>45-47</span></td>
        <td><label>创</label> <span>48-50</span></td>
        <td><label>出</label> <span>1-3</span></td>
        <td><label>出</label> <span>4-6</span></td>
        <td><label>出</label> <span>7-9</span></td>
        <td><label>出</label> <span>10-12</span></td>
        <td><label>出</label> <span>13-16</span></td>
      </tr>
      <tr>
        <td><label>出</label> <span>17-19</span></td>
        <td><label>出</label> <span>20-22</span></td>
        <td><label>出</label> <span>23-25</span></td>
        <td><label>出</label> <span>26-28</span></td>
        <td><label>出</label> <span>29-31</span></td>
        <td><label>出</label> <span>32-34</span></td>
        <td><label>出</label> <span>35-38</span></td>
      </tr>
      <tr>
        <td><label>出/利</label> <span>39-1</span></td>
        <td><label>利</label> <span>2-4</span></td>
        <td><label>利</label> <span>5-7</span></td>
      </tr>

    </thead>
    
  </table>
  <div class="ui hidden divider"></div>
@endsection
