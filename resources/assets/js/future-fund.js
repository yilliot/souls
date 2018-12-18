window.$ = window.jQuery = require('jquery');
require('../semantic/dist/semantic.js');
require('moment');
require('featherlight');
$(function(){

  // click form to submit
  $('.clicksubmit').click(function(){
    $(this).submit();
  });

  // click close to close message
  $('.message .close')
    .on('click', function() {
      $(this)
        .closest('.message')
        .transition('fade')
      ;
    })
  ;
  $('.ui.checkbox')
    .checkbox()
  ;
  $('.dropdown')
    .dropdown()
  ;

  $('.ui.progress').progress();

  $('.modalcaller').click( function() {

    // get the right modal init
    var modalclass = '.ui.modal';
    if ($(this).data('modalId')) {
      modalclass = modalclass + '.' + $(this).data('modalId');
    }
    
    // init
    $(modalclass).modal('show');
    
    // put in text data
    var modaldatatexts = $(this).data('modalText');
    for (var key in modaldatatexts) {
      var datafield = '.data.text.' + key;
      $(modalclass + ' ' + datafield).text(modaldatatexts[key]);
    }

    // put in value data
    var modaldatavals = $(this).data('modalVal');
    for (var key in modaldatavals) {
      var datafield = '.data.val.' + key;
      $(modalclass + ' ' + datafield).val(modaldatavals[key]);
    }
  });
});