<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{ asset('semantic/semantic.min.css') }}" rel="stylesheet">
</head>
<body>

<button class="ui button yellow create_btn" type="button" id="test">Create</button>
    <div class="ui modal test">
  <i class="close icon"></i>
  <div class="header">
    Profile Picture
  </div>
  <div class="image content">
    <div class="ui medium image">
      <img src="https://semantic-ui.com/images/avatar2/large/rachel.png">
    </div>
    <div class="description">
      <div class="ui header">We've auto-chosen a profile image for you.</div>
      <p>We've grabbed the following image from the <a href="https://www.gravatar.com" target="_blank">gravatar</a> image associated with your registered e-mail address.</p>
      <p>Is it okay to use this photo?</p>
    </div>
  </div>
  <div class="actions">
    <div class="ui black deny button">
      Nope
    </div>
    <div class="ui positive right labeled icon button">
      Yep, that's me
      <i class="checkmark icon"></i>
    </div>
  </div>
</div>


  <body>
    <div class='menu-container'>
      <div class='menu'>
        <div class='date'>Aug 14, 2016</div>
      </div>
      <div class="spacearoundla">
        <div class='signup' style="">Sign Up</div>
        <div class='login'>Login</div>
      </div>
    </div>
  </body>

<style>

.date {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  background-color: grey;
}

.spacearoundla {
  display: flex;
  justify-content: space-around;
}

.signup {
  color: #fff;
  background-color: #5995DA;  /* Blue */
  padding: 20px 0;
}

.login {
  border: 1px solid #fff;  /* For debugging */
  background-color: pink;
  display: flex;
  justify-content: center;
}

</style>

<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="{{ asset('semantic/semantic.min.js') }}"></script>
  <script src="/js/manifest.js"></script>
  <script src="/js/vendor.js"></script>
  <script src="/js/event.bible-reading.js"></script>
  @yield('script')
</body>
</html>