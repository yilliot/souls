window.$ = window.jQuery = require('jquery');
require('../semantic/dist/semantic.js');
require('moment');
require('featherlight');

$(function(){
  init_newcomerlist();
  init_menu();

});

function init_newcomerlist() {
  $(".button-click").click(function(){
      let id = $(this).attr('id');
      $('.modal#modal-of-' + id).modal('show');  
  });
}

function init_menu() {
    $('#btn-nav').click(function () {
        $('#nav').addClass('open');
        $('.overlay').show();
    });
    $('.overlay').click(function () {
        $('#nav').removeClass('open');
        $('.overlay').hide();
    });
}