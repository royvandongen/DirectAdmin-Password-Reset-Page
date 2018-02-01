$(function() {
  $('#resetemail').submit(function(e) {
    e.preventDefault();
    var data = $(this).serialize();
		$('.formhandler').remove()
		$('input').attr('disabled', true)
 		var request = $.ajax({
			type: "POST",
			url: "https://" + location.hostname + "/reset_email_password.php",
			data: data
		});
  	request.done(function(response) {
  	    $('form').replaceWith('<h1 class="h3 mb-3 font-weight-normal message formhandler">Password changed!</h1>')
  	})
  	request.fail(function(xhr, textStatus ) {
    	    $('form').replaceWith('<h1 class="h3 mb-3 font-weight-normal message formhandler">'+xhr.getResponseHeader('x-error-response')+'</h1>')
	});
  });
});
