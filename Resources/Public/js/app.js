//
$(document).ready(function() {
	$.ajax({
		url: "/LoggedInUser",
		dataType:'json'
	}).done(function(response) {
		$('#ajaxo').html(response.name+'<img src="'+response.imagepath+'"/>');
	});
});