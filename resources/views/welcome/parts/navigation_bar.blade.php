
<section id='top-bar'>
  <div class="mt-2 pb-2 mb-3" style="display: flex; justify-content: space-between;">
    <div id="btn-nav" class="align-self-center"><i class="align justify icon"></i></div>

    <div>
      <a href="/session/lang/zh">中文</a> |
      <a href="/session/lang/en">English</a>
    </div>
  </div>
</section>

<div class="overlay"></div>
<nav id="nav" class="">
  
  <!-- nav profile -->

  <div id="nav-profile">
    <a href="/profile/">
      <div class="">
        <strong class="d-block">Hi,</strong>
        <div>View profile</div>
      </div>
    </a>
  </div>

  <!-- nav profile -->

    <div class="nav-item ui list">
      <div class='item p-3'>
        <a href="*" class="nav-title">
          Log In
        </a>
      </div>
      <div class='item p-3'>
        <a href="/pastoral/newcomer" class="nav-title">
          @if(!session('nric'))
          <a href="/welcome/signup"> {{trans('event.bible_reading.signup')}} </a>
          @endif
          @if(session('nric'))
          | <a href="/welcome/QR"> {{trans('event.bible_reading.logout')}} </a> 
          @endif
        </a>
      </div>
    <div class="dropdown-divider"></div>
      <div class='item p-3'>
        <a href="/welcome/QR" class="nav-title">
          QR
        </a>
      </div>
      <div class='item p-3'>
        <a href="/welcome/chatbook" class="nav-title">
          Chatbook
        </a>
      </div>
      <div class='item p-3'>
        <a href="/welcome/detail" class="nav-title">
          Detail
        </a>
      </div>
      <div class='item p-3'>
        <a href="/welcome/feedback" class="nav-title">
          Feedback
        </a>
      </div>
      <div class='item p-3'>
        <a href="/followup" class="nav-title">
          Followup
        </a>
      </div>
      <div class='item p-3'>
        <a href="/pastoral/newcomer" class="nav-title">
          Newcomer
        </a>
      </div>
    </div>
  </ul>
</nav>