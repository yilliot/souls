$('.visitors').mouseenter(function(){
	$(this).popup({
		popup:'#' + $(this).attr('data-visitor')
	});
});

$('.visitors').mouseleave(function(){
	$('.ui.popup#'+$(this).attr('data-visitor')).removeClass("visible").addClass("hidden");
});

$('.delServiceCaller').on('click',function(){
	setModalUp($(this),'.delservice',1);
});

$('.addVisitorCaller').on('click',function(){
	setModalUp($(this),'.addvisitor',1);
});

$('.delVisitorCaller').on('click',function(){
	$('.ui.popup').removeClass("visible").addClass("hidden");
	setModalUp($(this),'.delvisitor',2);
});

$('.addNewVisitor').on('click',function(){
	$('.ui.visitor.table').append('<tr><td><div class="ui fluid input"><input type="text" name="visitors[]" val=""></div></td></tr>');
});

var setModalUp = function(clicked,modalName,mode){
	if(mode==1){
		$('.serviceDate').html(clicked.attr('data-servicedate'));
		$('input#attendance_id').val(clicked.data('attendance'));
	}
	if(mode==2){
		$('.visitorName').html(clicked.attr('data-visitor'));
		$('input#visitor_id').val(clicked.data('visitor-id'));
	}
	$(modalName).modal('show');
};