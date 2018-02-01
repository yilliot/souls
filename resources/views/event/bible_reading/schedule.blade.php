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
  <h3 class="ui header">二月读经表</h3>
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
        <td><label></label> <span></span></td>
        <td><label></label> <span></span></td>
        <td><label></label> <span></span></td>
        <td><label>利</label> <span>8-10</span></td>
        <td><label>利</label> <span>11-13</span></td>
        <td><label>利</label> <span>14-16</span></td>
        <td><label>利</label> <span>17-20</span></td>
      </tr>
      <tr>
        <td><label>利</label> <span>21-23</span></td>
        <td><label>利</label> <span>24-26</span></td>
        <td><label>利/民</label> <span>27-2</span></td>
        <td><label>民</label> <span>3-5</span></td>
        <td><label>民</label> <span>6-8</span></td>
        <td><label>民</label> <span>9-11</span></td>
        <td><label>民</label> <span>12-15</span></td>
      </tr>
      <tr>
        <td><label>民</label> <span>16-18</span></td>
        <td><label>民</label> <span>19-21</span></td>
        <td><label>民</label> <span>22-24</span></td>
        <td><label>民</label> <span>25-27</span></td>
        <td><label>民</label> <span>28-30</span></td>
        <td><label>民</label> <span>31-33</span></td>
        <td><label>申</label> <span>34-1</span></td>
      </tr>
      <tr>
        <td><label>申</label> <span>2-4</span></td>
        <td><label>申</label> <span>5-7</span></td>
        <td><label>申</label> <span>8-10</span></td>
        <td><label>申</label> <span>11-13</span></td>
        <td><label>申</label> <span>14-16</span></td>
        <td><label>申</label> <span>17-19</span></td>
        <td><label>申</label> <span>20-24</span></td>
      </tr>
      <tr>
        <td><label>申</label> <span>25-27</span></td>
        <td><label>申</label> <span>28-30</span></td>
        <td><label>申</label> <span>31-33</span></td>
        <td><label>申/書</label> <span>34-2</span></td>
      </tr>

    </thead>
    
  </table>
  <div class="ui hidden divider"></div>
@endsection
