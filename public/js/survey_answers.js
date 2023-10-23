(function($) {
	
	"use strict";

	/******************************************************************************************************************************************************************
	* Form Processor - Answers
	*******************************************************************************************************************************************************************/

	// Answers add
	$(".form-actions").delegate('[data-option="add-answers"]', 'click', function(e) 
	{
		var serialize = $('form#answers').serialize();

		$.post('includes/ajax_add_answer.php', serialize, function(response) 
		{	
			if(response == true) 
			{
				success_notices('Successfully added answer');
			} else if(response == 'TRIGGER_INFO') {
				info_notices('In order to add answer the fields cannot be empty');	
			} else {
				failure_notices('Failed to add answer. Probably the answer already exists');	
			}
		});
		e.preventDefault();

	});
	
	// Answers Update
	$(".form-actions").delegate('[data-option="update-answers"]', 'click', function(e) 
	{
		var serialize = $('form#answers').serialize();

		$.post('includes/ajax_update_answer.php', serialize, function(response) 
		{	
			if(response == true) 
			{
				success_notices('Successfully updated answer');
			} else if(response == 'TRIGGER_INFO') {
				info_notices('In order to update answer the fields cannot be empty');	
			} else {
				failure_notices('Failed to update answer. Probably the answer is already updated');	
			}
		});
		e.preventDefault();

	});

	// Define object at the end to fix ie bug
	var answers = {};
	
})(jQuery);