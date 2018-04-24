window.$ = window.jQuery = require('jquery');
require('../semantic/dist/semantic.js');
require('moment');
require('featherlight');

$(function(){

  init_newcomerlist();
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
  $('.dropdown#contact-code')
    .dropdown()
  ;
  $('.dropdown#cellgroup')
    .dropdown()
  ;

  comment = $('#chapters').data('comment');
  comment_placeholder = $('#chapters').data('comment-placeholder');

  generateButton = function(selected_book) {
    options = '';
    for(var i = 1; i <= bible_books[selected_book]; i++){
      options += '<input name=\'chapters[]\' type=\'hidden\' value=\'0\'id=\'input-' + i + '\'>' +
                 '<div class=\'column p-clear\'><div class=\'ui basic checkin chapter button\' id=\'c' + i + '\' data-value=\'' + i + '\'>' + i + '</div></div>'
                  ;
    }
    $('#chapters').html(options);
    $('.checkin.chapter.button').off('click').on('click', function(){
      i = $(this).data('value');
      id = 'input-' + i;
      status = $('#' + id).val() != 0 ? 0:1;
      $('#' + id).val(status);
      if(i != 1)newlinebefore = '<div class="my hidden divider" id="newlinebefore' + i + '"></div>';
      newlineafter = '<div class="my hidden divider" id="newlineafter' + i + '"></div>';
      textarea = '<textarea name="comment[' + i + ']" id="comment' + i + '" cols="30" rows="10" placeholder="' + comment_placeholder + '"></textarea>';
      if (status == 1) {
        if(i != 1)$(this).parent().before(newlinebefore);
        $(this).parent().after(newlineafter + textarea);
        $(this).addClass('red');
        $(this).removeClass('basic');
        $(this).parent().removeClass('column').addClass('my fluid');
      } else {
        $(this).removeClass('red');
        $(this).addClass('basic');
        $(this).parent().addClass('column').removeClass('my fluid');
        if(i != 1)$('#newlinebefore' + i).remove();
        $('#newlineafter' + i).remove();
        $('#comment' + i).remove();
      }
    });
  }

  old_selected_book = $('.dropdown#books').val();

  $('.dropdown#books')
    .dropdown({
      onChange : function(){
        var selected_book = $(this).val();
        generateButton(selected_book);
      },
    });
  ;

  // Accordion
  $('.ui.accordion')
    .accordion({
      exclusive: true,
    })
  ;

  $('.ui.progress')
    .progress()
  ;

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


  // Bible books
  var bible_books = {
      'Gen' : 50,
      'Ex' : 40,
      'Lev' : 27,
      'Num' : 36,
      'Deut' : 34,
      'Josh' : 24,
      'Judg' : 21,
      'Ruth' : 4,
      '1Sam' : 31,
      '2Sam' : 24,
      '1Kings' : 22,
      '2Kings' : 25,
      '1Chron' : 29,
      '2Chron' : 36,
      'Ezra' : 10,
      'Neh' : 13,
      'Est' : 10,
      'Job' : 42,
      'Ps' : 150,
      'Prov' : 31,
      'Eccles' : 12,
      'Song' : 8,
      'Isa' : 66,
      'Jer' : 52,
      'Lam' : 5,
      'Ezek' : 48,
      'Dan' : 12,
      'Hos' : 14,
      'Joel' : 3,
      'Amos' : 9,
      'Obad' : 1,
      'Jonah' : 4,
      'Mic' : 7,
      'Nah' : 3,
      'Hab' : 3,
      'Zeph' : 3,
      'Hag' : 2,
      'Zech' : 14,
      'Mal' : 4,
      'Matt' : 28,
      'Mark' : 16,
      'Luke' : 24,
      'John' : 21,
      'Acts' : 28,
      'Rom' : 16,
      '1Cor' : 16,
      '2Cor' : 13,
      'Gal' : 6,
      'Eph' : 6,
      'Phil' : 4,
      'Col' : 4,
      '1Thess' : 5,
      '2Thess' : 3,
      '1Tim' : 6,
      '2Tim' : 4,
      'Titus' : 3,
      'Philemon' : 1,
      'Heb' : 13,
      'James' : 5,
      '1Pet' : 5,
      '2Pet' : 3,
      '1John' : 5,
      '2John' : 1,
      '3John' : 1,
      'Jude' : 1,
      'Rev' : 22,
  };


  /**
   * Generate the buttons of selected chapter
   */
  if(old_selected_book) {
    generateButton(old_selected_book);

    /**
     * Auto fill in with old input
     */
    chapter_data = $('#old-chapters');
    comment_data = $('#old-comment');
    buttons = $('.checkin.chapter.button');
    old_chapter = [];
    old_comment = [];
    for (var i = 1; i <= bible_books[old_selected_book]; i++) {
      if(chapter_data.data('chapter' + i) == 1) {
        id = 'input-' + i;
        status = 1;
        $('#' + id).val(status);
        if(i != 1)newlinebefore = '<div class="my hidden divider" id="newlinebefore' + i + '"></div>';
        newlineafter = '<div class="my hidden divider" id="newlineafter' + i + '"></div>';
        textarea = '<textarea name="comment[' + i + ']" id="comment' + i + '" cols="30" rows="10" placeholder="' + comment_placeholder + '"></textarea>';
        chapter_button = buttons.filter('#c' + i);
        chapter_button.parent().after(newlineafter + textarea);
        chapter_button.addClass('red');
        chapter_button.removeClass('basic');
        chapter_button.parent().removeClass('column').addClass('my fluid');
        if(comment_data.data('comment' + i)){
          $('#comment' + i).val(comment_data.data('comment' + i));
        }
      }
    }
  }
function init_newcomerlist() {
  $(".jsbutton").click(function(){
      let id = $(this).attr('id');
      $('.modal#modal-of-' + id).modal('show');  
  });
}
});