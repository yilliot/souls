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
  <h3 class="ui header">六月读经表</h3>
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
        <td><label>诗</label> <span>11-13</span></td>
        <td><label>诗</label> <span>14-16</span></td>
        <td><label>诗</label> <span>17-21</span></td>
      </tr>
      <tr>
        <td><label>诗</label> <span>22-24</span></td>
        <td><label>诗</label> <span>25-27</span></td>
        <td><label>诗</label> <span>28-30</span></td>
        <td><label>诗</label> <span>31-33</span></td>
        <td><label>诗</label> <span>34-36</span></td>
        <td><label>诗</label> <span>37-39</span></td>
        <td><label>诗</label> <span>40-44</span></td>
      </tr>
      <tr>
        <td><label>诗</label> <span>45-47</span></td>
        <td><label>诗</label> <span>48-50</span></td>
        <td><label>诗</label> <span>51-53</span></td>
        <td><label>诗</label> <span>54-56</span></td>
        <td><label>诗</label> <span>57-59</span></td>
        <td><label>诗</label> <span>60-62</span></td>
        <td><label>诗</label> <span>63-67</span></td>
      </tr>
      <tr>
        <td><label>诗</label> <span>68-70</span></td>
        <td><label>诗</label> <span>71-73</span></td>
        <td><label>诗</label> <span>74-76</span></td>
        <td><label>诗</label> <span>77-79</span></td>
        <td><label>诗</label> <span>80-82</span></td>
        <td><label>诗</label> <span>83-85</span></td>
        <td><label>诗</label> <span>86-90</span></td>
      </tr>
      <tr>
        <td><label>诗</label> <span>91-93</span></td>
        <td><label>诗</label> <span>94-96</span></td>
        <td><label>诗</label> <span>97-99</span></td>
        <td><label>诗</label> <span>100-102</span></td>
        <td><label>诗</label> <span>103-105</span></td>
        <td><label>诗</label> <span>106-108</span></td>
      </tr>
    </tbody>
    
  </table>
  <div class="ui hidden divider"></div>
@endsection
