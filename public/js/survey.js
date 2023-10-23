(function($) {
	
	"use strict"; 
	
	/******************************************************************************************************************************************************************
	* Form Processor
	*******************************************************************************************************************************************************************/
	// Create Survey
	$(".form-actions").delegate('[data-option="create-survey"]', 'click', function(e) 
	{	
			
		var form_data = $("form#create-survey").serialize();
		
		$.post('includes/Ajax_create_survey.php', form_data, function(response) 
		{	
			if(response == true) 
			{
				success_notices('Successfully created survey');
				$("form#create-survey input").val('');
			} else if(response == 'TRIGGER_INFO') {
				info_notices('In order to create a survey you must have a survey name');	
			} else {
				failure_notices('Failed to create survey. Probably you have a survey with the same name');	
			}
		});
				
		e.preventDefault();
	});
	
	// Add Question
	$(".modal-footer").delegate('[data-option="add-question"]', 'click', function(e) 
	{
		
		var form_data = $("form#add-question").serialize();
		
		$.post('includes/ajax_add_question.php', form_data, function(response) 
		{	
			if(response == true) 
			{
				success_notices('Successfully added question');
				$("form#add-question input, form#add-question textarea, form#add-question select").val('');
				document.location.reload();
			} else if(response == 'TRIGGER_INFO') {
				info_notices('In order to add a question you must have a question name');	
			} else {
				failure_notices('Failed to add question. Probably you are duplicating the question');	
			}
			
		});
		
		e.preventDefault();
	});
	
	// Edit Survey
	$("a#editAction").on('click', function(e) 
	{
		$('span#surveyTitle').html($(this).data('survey'));
		$('#new-survey-name').val($(this).data('survey'));
		
		var pass = $(this).data('password');
		if(pass == 'NULL')
		{
			pass = '';
		}
		
		$('#new-survey-password').val(pass);		
		object.id = $(this).data('id');
		
		$(".modal-footer").delegate('[data-option="edit-survey"]', 'click', function(e) 
		{
			var new_survey_name = $('form#edit-survey input#new-survey-name').val();
			var new_survey_password = $('form#edit-survey input#new-survey-password').val();
		
			var constructor = 'new-survey-name='+new_survey_name+'&new-survey-password='+new_survey_password+'&id='+object.id;
			
			$.post('includes/ajax_edit_survey.php', constructor, function(response) 
			{	
				if(response == true) 
				{
					success_notices('Successfully modified survey');
					$("form#edit-survey input").val('');
					document.location.reload();
				} else if(response == 'TRIGGER_INFO') {
					info_notices('In order to modify this survey you must have a survey name');	
				} else {
					failure_notices('Failed to modify survey. Probably you have a survey with the same name');	
				}
			});
			e.preventDefault();
		});
		e.preventDefault();
	});
	
	// Edit Live Survey
	$(".form-actions").delegate('[data-option="save-live-changes"]', 'click', function(e) 
	{
		var form = $('form#liveSurvey-form').serialize();
	
		$.post('includes/ajax_live_changes.php', form, function(response) 
		{	
			if(response == true) 
			{
				success_notices('Successfully modified survey templating settings');
				toTop();
			} else if(response == 'TRIGGER_INFO') {
				info_notices('In order to modify this survey templating settings you must fill the form');
				toTop();	
			} else {
				failure_notices('Failed to modify survey templating. Probably you are duplicating');
				toTop();	
			}
		});
		e.preventDefault();
	});

	
	// Delete Survey
	$("a#deleteAction").on('click', function(e) 
	{
		
		$('span#surveyTitle').html($(this).data('survey'));
				
		object.del_id = $(this).data('id');
	
		$(".modal-footer").delegate('[data-option="delete-survey"]', 'click', function(e) 
		{
			var survey_id = 'id='+object.del_id;

			$.post('includes/ajax_delete_survey.php', survey_id, function(response) 
			{	
				if(response == true) 
				{
					success_notices('Successfully deleted survey');
					document.location.reload();
				} else if(response == 'TRIGGER_INFO') {
					info_notices('Something went wrong');	
				} else {
					failure_notices('Failed to delete survey');	
				}
			});
			e.preventDefault();
		});
		
		e.preventDefault();
	});
	
	// Edit Question
	$("a#editAction").on('click', function(e) 
	{
		$('span#questionTitle').html($(this).data('question'));
		$('#edit-question #new-question').val($(this).data('question'));
		
		object.qid = $(this).data('id');
		object.qtype = $(this).data('q-type');
		object.qreq = $(this).data('q-req');
		
		$('#question-type option[value="'+object.qtype+'"]').prop('selected', true);
		$('#edit-question input[value="'+object.qreq+'"]').prop('checked', true);
		
		$(".modal-footer").delegate('[data-option="edit-question"]', 'click', function(e) 
		{
			var new_question = $('form#edit-question textarea#new-question').val();
			var new_question_type = $('form#edit-question select#question-type').val();
			var requeriment = $('form#edit-question input[name=requeriment]:checked').val();
			var survey_id = $('form#edit-question input#survey_id').val();
			
			var constructor = 'new-question='+new_question+'&question-type='+new_question_type+'&requeriment='+requeriment+'&survey_id='+survey_id+'&id='+object.qid;
			
			$.post('includes/ajax_edit_question.php', constructor, function(response) 
			{	
				if(response == true) 
				{
					success_notices('Successfully modified question');
					$("form#edit-question input, form#edit-question textarea, form#edit-question select").val('');
					document.location.reload();
				} else if(response == 'TRIGGER_INFO') {
					info_notices('In order to modify this question you must modify this question');	
				} else {
					failure_notices('Failed to modify question. Probably you already have this question for this survey');	
				}
			});
			e.preventDefault();
		});
		e.preventDefault();
	});
	
	// Delete Question
	$("a#deleteAction").on('click', function(e) 
	{
		
		$('span#questionTitle').html($(this).data('question'));
				
		object.del_id = $(this).data('id');
	
		$(".modal-footer").delegate('[data-option="delete-question"]', 'click', function(e) 
		{
			var question_id = 'id='+object.del_id;

			$.post('includes/ajax_delete_question.php', question_id, function(response) 
			{	
				if(response == true) 
				{
					success_notices('Successfully deleted question');
					document.location.reload();
				} else if(response == 'TRIGGER_INFO') {
					info_notices('Something went wrong');	
				} else {
					failure_notices('Failed to delete question');	
				}
			});
			e.preventDefault();
		});
		
		e.preventDefault();
	});
	
	// Confirm Question Ordering
	$("#order-questions").delegate('[data-option="order-questions-confirm"]', 'click', function(e) 
	{
		e.preventDefault();
		document.location.reload();
	});
	
	// Delete Live Survey
	$("a#deleteAction").on('click', function(e) 
	{
		
		$('span#hliveSurvey').html($(this).data('lsurvey'));
				
		object.del_id = $(this).data('id');
	
		$(".modal-footer").delegate('[data-option="delete-live-survey"]', 'click', function(e) 
		{
			var l_id = 'id='+object.del_id;

			$.post('includes/ajax_delete_liveSurvey.php', l_id, function(response) 
			{	
				if(response == true) 
				{
					success_notices('Successfully deleted live survey');
					document.location.reload();
				} else if(response == 'TRIGGER_INFO') {
					info_notices('Something went wrong');	
				} else {
					failure_notices('Failed to delete live survey');	
				}
			});
			e.preventDefault();
		});
		
		e.preventDefault();
	});
	
	// Save Settings
	$(".form-actions").delegate('[data-option="save-settings"]', 'click', function(e) 
	{
		var form = $('form#settings').serialize();
	
		$.post('includes/ajax_settings.php', form, function(response) 
		{
			if(response == true) 
			{
				success_notices('Settings were changed');
				toTop();
			} else if(response == 'TRIGGER_INFO') {
				info_notices('Something went wrong saving settings. Try filling the settings or try again later');
				toTop();	
			} else {
				failure_notices('Failed to change settings');
				toTop();	
			}
		});
		e.preventDefault();
	});
	
	// Reset Survey
	$("a.survey-reset").on('click', function(e) 
	{
		var ID = $(this).attr('id');
		var dataString = 'id='+ID;
		
		$.post('includes/ajax_reset_survey.php', dataString, function(response) 
		{	
			if(response == true) 
			{
				success_notices('Successfully reseted this survey, you can take it again');
				document.location.reload();
			} else if(response == 'TRIGGER_INFO') {
				info_notices('Something went wrong');	
			} else {
				failure_notices('Failed to reset survey');	
			}
		});
		e.preventDefault();
	});
	
	/******************************************************************************************************************************************************************/
	/******************************************************************************************************************************************************************
	* Functions
	*******************************************************************************************************************************************************************/
	
	// Success Notice Function
	window.success_notices = function(message)
	{
		$(".notice_messages").html('<div class="alert alert-success">'+message+'</div>');
		setTimeout(function(){
			$('.notice_messages').html('');		
		}, 5000);	
	}
	
	// Information Notice Function
	window.info_notices = function(message)
	{
		$(".notice_messages").html('<div class="alert alert-info">'+message+'</div>');
		setTimeout(function(){
			$('.notice_messages').html('');		
		}, 5000);	
	}
	
	// Failure Notice Function
	window.failure_notices = function(message)
	{
		$(".notice_messages").html('<div class="alert alert-danger">'+message+'</div>');
		setTimeout(function(){
			$('.notice_messages').html('');
		}, 5000);	
	}
	
	// To Top
	window.toTop = function()
	{
		$('html, body').animate({scrollTop:0}, 'slow');
	}
	
	// CSV
	window.csv = function()
	{
		document.location.href = 'includes/csv.php?id='+$("#export-csv").data('qid')+'&qtype='+$("#export-csv").data('qtype');
	}

	if($(".sortList").length > 0)
	{
		console.log('-------sortlist------');
		$(".sortList").sortable({ 
			opacity: 0.6, 
			cursor: 'move', 
			placeholder: "placeholder",
			update: function() 
				{
					console.log('-------sortlist update------');
					var order = $(this).sortable("serialize") + '&action=updateRecordsListings';
					$.post("includes/updateOrder.php", order, function(theResponse){});
				}
		});
		$(".sortList").disableSelection();
	}
	
	// Define object at the end to fix ie bug
	var object = {};
	
})(jQuery);

$(document).ready(function() {
	$('.sortable-list').sortable({
		connectWith: '.sortable-list',
		update: function(event, ui) {
		  var changedList = this.id;
		  var order = $(this).sortable('toArray');
		  var positions = order.join(';');
	  
		  console.log({
			id: changedList,
			positions: positions
		  });
		}
	  });
})