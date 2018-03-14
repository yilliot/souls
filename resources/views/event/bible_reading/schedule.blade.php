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
    th{text-align: center !important;}
    td label{display: block;}
    td span{display:block; font-size: 0.8em;}
  </style>
  <h3 class="ui header">三月读经表</h3>
  <table class="ui unstackable compact table">
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
        <td><label></label> <span></span></td>
        <td><label></label> <span></span></td>
        <td><label>申/书</label> <span>34-2</span></td>
        <td><label>书</label> <span>3-5</span></td>
        <td><label>书</label> <span>6-8</span></td>
        <td><label>书</label> <span>9-13</span></td>
      </tr>
      <tr>
        <td><label>书</label> <span>14-16</span></td>
        <td><label>书</label> <span>17-19</span></td>
        <td><label>书</label> <span>20-22</span></td>
        <td><label>书/士</label> <span>23-1</span></td>
        <td><label>士</label> <span>2-4</span></td>
        <td><label>士</label> <span>5-7</span></td>
        <td><label>士</label> <span>8-12</span></td>
      </tr>
      <tr>
        <td><label>士</label> <span>13-15</span></td>
        <td><label>士</label> <span>16-18</span></td>
        <td><label>士</label> <span>19-21</span></td>
        <td><label>得</label> <span>1-3</span></td>
        <td><label>得/撒上</label> <span>4-2</span></td>
        <td><label>撒上</label> <span>3-5</span></td>
        <td><label>撒上</label> <span>6-10</span></td>
      </tr>
      <tr>
        <td><label>撒上</label> <span>11-13</span></td>
        <td><label>撒上</label> <span>14-16</span></td>
        <td><label>撒上</label> <span>17-19</span></td>
        <td><label>撒上</label> <span>20-22</span></td>
        <td><label>撒上</label> <span>23-25</span></td>
        <td><label>撒上</label> <span>26-28</span></td>
        <td><label>撒上/撒下</label> <span>29-2</span></td>
      </tr>
      <tr>
        <td><label>撒下</label> <span>3-5</span></td>
        <td><label>撒下</label> <span>6-8</span></td>
        <td><label>撒下</label> <span>9-11</span></td>
        <td><label>撒下</label> <span>12-14</span></td>
        <td><label>撒下</label> <span>15-17</span></td>
        <td><label>撒下</label> <span>18-20</span></td>
      </tr>

    </thead>
    
  </table>
  <div class="ui hidden divider"></div>
@endsection
