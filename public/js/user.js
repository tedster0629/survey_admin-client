(function($) {
	
	"use strict"; 

	// Remove user
	$("a#removeUser").on('click', function(e) 
	{
		var id = $(this).data('id');
		var username = $(this).data('username');
		
		var form_data = {
			action: 'remove',
			id: id,
			username: username
		}
		
		$.post('includes/ajax_users.php', form_data, function(response) 
		{	
			if(response == true) 
			{
				success_notices('Successfully removed user');
				setTimeout(function(){
					document.location.reload();
				}, 2000);
			} else {
				failure_notices('Failed to remove user');	
			}
		});
	});

	// User Validity
	$('#password, #confirm_password').on('keyup', function () {
	  if ($('#password').val().length > 5 && $('#confirm_password').val().length > 5 && $('#password').val() == $('#confirm_password').val()) {
		$('#pmessage').html('Matching').css('color', 'green');
	  } else {
		$('#pmessage').html('Not Matching').css('color', 'red');
	  }
	});

	$('input#username, #password, #confirm_password').on('keyup', function () {
		if($('#profile').length > 0)
		{
			if( $('#password').val().length > 5 && $('#password').val() == $('#confirm_password').val() ) 
			{
				$('.add-user-btn').removeAttr('disabled');
				$('.inpass').removeClass('inpass-highlight');
			} else {
				$('.add-user-btn').attr("disabled", true);
				$('.inpass').addClass('inpass-highlight');
			}
		} else {
			if( $('input#username').val().length > 0 && $('#password').val().length > 5 && $('#password').val() == $('#confirm_password').val() ) 
			{
				$('.add-user-btn').removeAttr('disabled');
				$('.inpass').removeClass('inpass-highlight');
			} else {
				$('.add-user-btn').attr("disabled", true);
				$('.inpass').addClass('inpass-highlight');
			}
		}
	});

	// Save User
	$("#add-user").delegate('[data-option="add-user"]', 'click', function(e) 
	{
		var form = $('form#add-user').serialize();

		$.post('includes/ajax_users.php', form, function(response) 
		{
			if(response == true) 
			{
				success_notices('User Successfully Added');
				setTimeout(function(){
					document.location.reload();
				}, 2000);
			} else {
				failure_notices('Failed to Add User. User probably exists. Check the username and email.');
				toTop();	
			}
		});
		e.preventDefault();
	});

	// Change Data
	$(".form-actions").delegate('[data-option="save-settings-profile"]', 'click', function(e) 
	{
		var form = $('form#profile').serialize();

		$.post('includes/ajax_users.php', form, function(response) 
		{
			if(response == true) 
			{
				success_notices('User Successfully Updated');
				toTop();
				setTimeout(function(){
					document.location.reload();
				}, 2000);
			} else {
				failure_notices('Failed to Update User.');
				toTop();	
			}
		});
		
		e.preventDefault();
	});

	// Change Pass
	$(".form-actions").delegate('[data-option="save-settings-password"]', 'click', function(e) 
	{
		var form = $('form#profile-change-pass').serialize();

		$.post('includes/ajax_users.php', form, function(response) 
		{
			if(response == true) 
			{
				success_notices('Password Successfully Updated');
				toTop();
				setTimeout(function(){
					document.location.reload();
				}, 2000);
			} else {
				failure_notices('Failed to Update Password.');
				toTop();	
			}
		});
		
		e.preventDefault();
	});

})(jQuery);