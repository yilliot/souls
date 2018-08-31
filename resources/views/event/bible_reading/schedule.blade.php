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
    #schedule td{text-align: center; padding: 1px;}
    #schedule th{text-align: center;}
    #schedule td label{display: block;}
    #schedule td span{display:block; font-size: 0.8em;}
  </style>
  <h3 class="ui header">八月读经表</h3>
  <table id="schedule" class="ui unstackable compact table">
    <thead>
      <tr>
        <th>Mon</th>
        <th>Tue</th>
        <th>Wed</th>
        <th>Thu</th>
        <th>Fri</th>
        <th>Sat</th>
        <th>Sun</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><label></label> <span></span></td>
        <td><label></label> <span></span></td>
        <td><label></label> <span></span></td>
        <td><label></label> <span></span></td>
        <td><label></label> <span></span></td>
        <td><label>耶</label> <span>46-48</span></td>
        <td><label>耶-哀</label> <span>49-1</span></td>
      </tr>
      <tr>
        <td><label>哀</label> <span>2-4</span></td>
        <td><label>哀-結</label> <span>5-2</span></td>
        <td><label>結</label> <span>3-5</span></td>
        <td><label>結</label> <span>6-8</span></td>
        <td><label>結</label> <span>9-11</span></td>
        <td><label>結</label> <span>12-14</span></td>
        <td><label>結</label> <span>15-19</span></td>
      </tr>
      <tr>
        <td><label>結</label> <span>20-22</span></td>
        <td><label>結</label> <span>23-25</span></td>
        <td><label>結</label> <span>26-28</span></td>
        <td><label>結</label> <span>29-31</span></td>
        <td><label>結</label> <span>32-34</span></td>
        <td><label>結</label> <span>35-37</span></td>
        <td><label>結</label> <span>38-42</span></td>
      </tr>
      <tr>
        <td><label>結</label> <span>43-45</span></td>
        <td><label>結</label> <span>46-48</span></td>
        <td><label>但</label> <span>1-3</span></td>
        <td><label>但</label> <span>4-6</span></td>
        <td><label>但</label> <span>7-9</span></td>
        <td><label>但</label> <span>10-12</span></td>
        <td><label>何</label> <span>1-5</span></td>
      </tr>
      <tr>
        <td><label>何</label> <span>6-8</span></td>
        <td><label>何</label> <span>9-11</span></td>
        <td><label>何</label> <span>12-14</span></td>
        <td><label>珥</label> <span>1-3</span></td>
        <td><label>摩</label> <span>1-3</span></td>
        <td><label>摩</label> <span>4-6</span></td>
        <td><label>摩-拿</label> <span>7-1</span></td>
      </tr>
    </tbody>
    
  </table>
  <div class="ui hidden divider"></div>
@endsection
