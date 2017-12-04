window.$ = window.jQuery = require('jquery');
require('../semantic/dist/semantic.js');

$(function(){
  $('button.option').click(function(e){
    var supreme_option = $(this).data('option');
    $('#supreme-container').css('background-image', 'url(/images/supreme-vote/' + supreme_option + '.jpg)');
    $('#form-option').val(supreme_option);
    e.preventDefault();
  });
});
