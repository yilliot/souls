window.$ = window.jQuery = require('jquery');
require('../semantic/dist/semantic.js');
require('moment');
require('featherlight');

$(function(){
  init_newcomerlist();

});

function init_newcomerlist() {
  $(".jsbutton").click(function(){
      let id = $(this).attr('id');
      $('.modal#modal-of-' + id).modal('show');  
  });
}
