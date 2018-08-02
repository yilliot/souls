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
        <td><label>赛</label> <span>11-13</span></td>
        <td><label>赛</label> <span>14-16</span></td>
        <td><label>赛</label> <span>17-19</span></td>
        <td><label>赛</label> <span>20-22</span></td>
        <td><label>赛</label> <span>23-27</span></td>
      </tr>
      <tr>
        <td><label>赛</label> <span>28-30</span></td>
        <td><label>赛</label> <span>31-33</span></td>
        <td><label>赛</label> <span>34-36</span></td>
        <td><label>赛</label> <span>37-39</span></td>
        <td><label>赛</label> <span>40-42</span></td>
        <td><label>赛</label> <span>43-45</span></td>
        <td><label>赛</label> <span>46-50</span></td>
      </tr>
      <tr>
        <td><label>赛</label> <span>51-53</span></td>
        <td><label>赛</label> <span>54-56</span></td>
        <td><label>赛</label> <span>57-59</span></td>
        <td><label>赛</label> <span>60-62</span></td>
        <td><label>赛</label> <span>63-65</span></td>
        <td><label>赛-耶</label> <span>66-2</span></td>
        <td><label>耶</label> <span>3-7</span></td>
      </tr>
      <tr>
        <td><label>耶</label> <span>8-10</span></td>
        <td><label>耶</label> <span>11-13</span></td>
        <td><label>耶</label> <span>14-16</span></td>
        <td><label>耶</label> <span>17-19</span></td>
        <td><label>耶</label> <span>20-22</span></td>
        <td><label>耶</label> <span>23-25</span></td>
        <td><label>耶</label> <span>26-30</span></td>
      </tr>
      <tr>
        <td><label>耶</label> <span>31-33</span></td>
        <td><label>耶</label> <span>34-36</span></td>
        <td><label>耶</label> <span>37-39</span></td>
        <td><label>耶</label> <span>40-42</span></td>
        <td><label>耶</label> <span>43-45</span></td>
        <td><label></label> <span></span></td>
        <td><label></label> <span></span></td>
      </tr>
    </tbody>
    
  </table>
  <div class="ui hidden divider"></div>
@endsection
