var MODAL_WIDTH=300;
var MODAL_HEIGHT=200;

$(document).ready(function(){
	$(".modal .close").click(function(){
		$(this).parent().css('top','-50%');
		$('.black_overlay').fadeOut(function(){
			$('#nav_modal >*:not(:first-child)').hide();
			$(this).remove();
		});
	});

	$("#theme_admin_btn").click(function(){showModal('#theme_admin');});

	$('#auth_header a').click(function(){
		var path = $(this).html().toLowerCase();
		$(".modal #" + path).show();
		showModal('#nav_modal');
	});

	$('#register-form').hide();
});

function showModal(which){
	$(which).css('top','50%');
	$('body').append('<div class="black_overlay"></div>');
	$('.black_overlay').fadeIn();
}

function changeForm(){
	if($('#login-form').is(':visible')){
		$('#login-form').fadeOut(function(){
			$('#register-form').fadeIn();
		});
	}else{
		$('#register-form').fadeOut(function(){
			$('#login-form').fadeIn();
		});
	}
}