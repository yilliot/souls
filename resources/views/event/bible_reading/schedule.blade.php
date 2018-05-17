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
  <h3 class="ui header">五月读经表</h3>
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
      <tr>
         <td><label></label> <span></span></td>
        <td><label>代下</label> <span>21-23</span></td>
        <td><label>代下</label> <span>24-26</span></td>
        <td><label>代下</label> <span>27-29</span></td>
        <td><label>代下</label> <span>30-32</span></td>
        <td><label>代下</label> <span>33-35</span></td>
        <td><label>代下／拉</label> <span>36－4</span>
        </td>
      </tr>
      <tr>
        <td><label>拉</label> <span>5-7</span></td>
        <td><label>拉</label> <span>8-10</span></td>
        <td><label>尼</label> <span>1-3</span></td>
        <td><label>尼</label> <span>4-6</span></td>
        <td><label>尼</label> <span>7-9</span></td>
        <td><label>尼</label> <span>10-12</span></td>
        <td><label>尼/斯</label> <span>13-4</span></td>
      </tr>
      <tr>
        <td><label>斯</label> <span>5-7</span></td>
        <td><label>斯</label> <span>8-10</span></td>
        <td><label>伯</label> <span>1－3</span></td>
        <td><label>伯</label> <span>4-6</span></td>
        <td><label>伯</label> <span>7-9</span></td>
        <td><label>伯</label> <span>10-12</span></td>
        <td><label>伯</label> <span>13-17</span></td>
      </tr>
      <tr>
        <td><label>伯</label> <span>18-20</span></td>
        <td><label>伯</label> <span>21-23</span></td>
        <td><label>伯</label> <span>24-26</span></td>
        <td><label>伯</label> <span>27-29</span></td>
        <td><label>伯</label> <span>30-32</span></td>
        <td><label>伯</label> <span>33-35</span></td>
        <td><label>伯</label> <span>36-40</span></td>
      </tr>
      <tr>
        <td><label>伯／诗</label> <span>41-1</span></td>
        <td><label>诗</label> <span>2-4</span></td>
        <td><label>诗</label> <span>5-7</span></td>
        <td><label>诗</label> <span>8-10</span></td>
      </tr>
    </thead>    
  </table>
  <div class="ui hidden divider"></div>
@endsection
