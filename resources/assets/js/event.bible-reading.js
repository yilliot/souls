window.$ = window.jQuery = require('jquery');
require('../semantic/dist/semantic.js');
require('moment');
require('featherlight');

$(function(){

	$('.message .close')
	  .on('click', function() {
	    $(this)
	      .closest('.message')
	      .transition('fade')
	    ;
	  })
	;
});