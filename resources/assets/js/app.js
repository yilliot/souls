require('./bootstrap');

window.$ = window.jQuery = require('jquery');

$(function(){
  $('.clone-next').click(function(){
    $(this).next().clone().insertAfter(this);
  });

});