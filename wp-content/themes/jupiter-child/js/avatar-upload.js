function inIframe () {
    try {
        return window.self !== window.top;
    } catch (e) {
        return true;
    }
}
jQuery(document).ready(function($) {

	// if user clicked on button, the overlay layer or the dialogbox, close the dialog	
	$('a.avatar-close, .avatar-dialog-overlay').click(function () {		
		$('.avatar-dialog-overlay, .avatar-dialog-box').hide();		
		return false;
	});

	$(".page-id-623 .hidden-user-avatar > img.photo").appendTo(".page-id-623 .uap-user-page-avatar");
	$(".page-id-623 .hidden-user-avatar > div.edit-action").appendTo(".page-id-623 .uap-user-page-avatar");
	
	// if user resize the window, call the same function again
	// to make sure the overlay fills the screen and dialogbox aligned to center	
	$(window).resize(function () {
		
		//only do it if the dialog box is not hidden
		if (!$('.avatar-dialog-box').is(':hidden')) $(window).avatar_popup();		
	});

	$('#text-block-2 .uap-user-page-avatar').on("click", function() {
		$(this).avatar_popup();
	});

	//Popup dialog
	$.fn.avatar_popup = function() {

		// get the screen height and width  
		var maskHeight = $(document).height();  
		var maskWidth = $(window).width();
		
		// calculate the values for center alignment
		var dialogTop =  (maskHeight/2) - ($('.avatar-dialog-box').height()/2);  
		var dialogLeft = (maskWidth/2) - ($('.avatar-dialog-box').width()/2); 
		
		// assign values to the overlay and dialog box
		$('.avatar-dialog-overlay').css({height:maskHeight, width:maskWidth}).show();
		$('.avatar-dialog-box').css({top:dialogTop, left:dialogLeft}).show();
		
		// display the message
		//$('#dialog-message').html(message);

	}
});