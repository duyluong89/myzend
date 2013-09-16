$(function(){ 
	$('.notifications').notify({
	    message: { text: $(".notifications").attr("data-id") },
	    fadeOut: { enabled: true, delay: 3000 }
	  }).show();
});