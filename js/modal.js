var MODAL_WIDTH=300;
var MODAL_HEIGHT=200;

$(document).ready(function(){
	$(".modal #close").click(function(){hideModal();});

	$('#auth_header a').click(function(){
		var path = $(this).html().toLowerCase();
		$(".modal #" + path).show();
		showModal();
	});
});

function showModal(){
	$('.modal').css('top','50%');
	$('body').append('<div class="black_overlay"></div>');
	$('.black_overlay').fadeIn();
}
function hideModal(){
	$('.modal').css('top','-50%');
	$('.black_overlay').fadeOut(function(){
		$('.modal >*:not(:first-child)').hide();
		$(this).remove();
	});
}