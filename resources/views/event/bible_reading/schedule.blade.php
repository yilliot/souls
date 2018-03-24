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
  <h3 class="ui header">四月读经表</h3>
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
        <td><label></label> <span></span></td>
        <td><label></label> <span></span></td>
        <td><label></label> <span></span></td>
        <td><label></label> <span></span></td>
        <td colspan="2" style="text-align: right;">
          <label>撒下／王上</label> 
          <span style="padding-right: 17px ">21-1</span>
        </td>
      </tr>
      <tr>
        <td><label>王上</label> <span>2-4</span></td>
        <td><label>王上</label> <span>5-7</span></td>
        <td><label>王上</label> <span>8-10</span></td>
        <td><label>王上</label> <span>11-13</span></td>
        <td><label>王上</label> <span>14-16</span></td>
        <td><label>王上</label> <span>17-19</span></td>
        <td><label>王上/下</label> <span>20-2</span></td>
      </tr>
      <tr>
        <td><label>王下</label> <span>3-5</span></td>
        <td><label>王下</label> <span>6-8</span></td>
        <td><label>王下</label> <span>9-11</span></td>
        <td><label>王下</label> <span>12-14</span></td>
        <td><label>王下</label> <span>15-17</span></td>
        <td><label>王下</label> <span>18-20</span></td>
        <td><label>王下</label> <span>21-25</span></td>
      </tr>
      <tr>
        <td><label>代上</label> <span>1-3</span></td>
        <td><label>代上</label> <span>4-6</span></td>
        <td><label>代上</label> <span>7-9</span></td>
        <td><label>代上</label> <span>10-12</span></td>
        <td><label>代上</label> <span>13-15</span></td>
        <td><label>代上</label> <span>16-18</span></td>
        <td><label>代上</label> <span>19-23</span></td>
      </tr>
      <tr>
        <td><label>代上</label> <span>24-26</span></td>
        <td><label>代上</label> <span>27-29</span></td>
        <td><label>代下</label> <span>1-3</span></td>
        <td><label>代下</label> <span>4-6</span></td>
        <td><label>代下</label> <span>7-9</span></td>
        <td><label>代下</label> <span>10-12</span></td>
        <td><label>代下</label> <span>13-17</span></td>
      </tr>
      <tr>
        <td><label>代下</label> <span>18-20</span></td>
      </tr>
       


    </thead>
    
  </table>
  <div class="ui hidden divider"></div>
@endsection
