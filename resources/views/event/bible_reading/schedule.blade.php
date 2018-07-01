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
  <h3 class="ui header">七月读经表</h3>
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
        <td><label></label> <span></span></td>
        <td><label>诗</label> <span>109-113</span></td>
      </tr>
      <tr>
        <td><label>诗</label> <span>114-116</span></td>
        <td><label>诗</label> <span>117-119</span></td>
        <td><label>诗</label> <span>120-122</span></td>
        <td><label>诗</label> <span>123-125</span></td>
        <td><label>诗</label> <span>126-128</span></td>
        <td><label>诗</label> <span>129-131</span></td>
        <td><label>诗</label> <span>132-136</span></td>
      </tr>
      <tr>
        <td><label>诗</label> <span>137-139</span></td>
        <td><label>诗</label> <span>140-142</span></td>
        <td><label>诗</label> <span>143-145</span></td>
        <td><label>诗</label> <span>146-148</span></td>
        <td><label>诗-箴</label> <span>149-1</span></td>
        <td><label>箴</label> <span>2-4</span></td>
        <td><label>箴</label> <span>5-9</span></td>
      </tr>
      <tr>
        <td><label>箴</label> <span>10-12</span></td>
        <td><label>箴</label> <span>13-15</span></td>
        <td><label>箴</label> <span>16-18</span></td>
        <td><label>箴</label> <span>19-21</span></td>
        <td><label>箴</label> <span>22-24</span></td>
        <td><label>箴</label> <span>25-27</span></td>
        <td><label>传</label> <span>28-1</span></td>
      </tr>
      <tr>
        <td><label>传</label> <span>2-4</span></td>
        <td><label>传</label> <span>5-7</span></td>
        <td><label>传</label> <span>8-10</span></td>
        <td><label>传-歌</label> <span>11-1</span></td>
        <td><label>歌</label> <span>2-4</span></td>
        <td><label>歌</label> <span>5-7</span></td>
        <td><label>歌-赛</label> <span>8-4</span></td>
      </tr>
      <tr>
        <td><label>赛</label> <span>5-7</span></td>
        <td><label>赛</label> <span>8-10</span></td>
        <td><label></label> <span></span></td>
        <td><label></label> <span></span></td>
        <td><label></label> <span></span></td>
        <td><label></label> <span></span></td>
        <td><label></label> <span></span></td>
      </tr>
    </tbody>
    
  </table>
  <div class="ui hidden divider"></div>
@endsection
