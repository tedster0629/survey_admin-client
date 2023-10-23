<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us">

<head>
	<title><?php echo $get_survey_title; ?></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    
	<link href="<?php echo base_url();?>public/themes/css/uni-form.css" media="screen" rel="stylesheet"/>
    <link href="<?php echo base_url();?>public/themes/css/style.css" media="screen" rel="stylesheet"/>
    <link href="<?php echo base_url();?>public/themes/css/default.uni-form.css" id="formStyle" media="screen" rel="stylesheet"/>
    <link href="<?php echo base_url();?>public/themes/css/tables.css" media="screen" rel="stylesheet"/>
    
    <script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>public/themes/js/uni-form.jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>public/themes/js/jquery.validate.min.js"></script>
	

	<script>
		var form = document.getElementById("uniValidation");

		form.onsubmit = function() {
			// Check your condition here
			if ($("#uniValidation").valid()) {
				return false; // This will prevent the form from submitting
			}
		};
	</script>

    <script type="text/javascript">
	$(document).ready(function() {
		$("#uniValidation").uniform();
		$("#uniValidation").validate();
		$("form#uniValidation").delegate('[data-option="save-survey"]', 'click', function(e) 
		{
			setTimeout(function() {
				$('table label.error').text('This field is required.');
			}, 10);
			
			var data = $("form#uniValidation").serialize();
			if($("#uniValidation").valid())
			{
				if($(this).text() == 'Send')
				{
					$(this).attr('disabled', 'disabled');
				} else {
					$(this).removeAttr('disabled');
				}
				$.post('submitSurvey', data, function(response)
				{
					if(response == 'DONE')
					{

						$.post('../themes/default/finalpage', data, function(response));
						$("#ajax_messages").html('<div id="okMsg">Thank you for taking the survey</div>');

						
					} else {
						if(response.indexOf("takeSurvey") >= 0)
						{
							window.location.href = response;
						} else {
							alert('Something went wrong.');
						}
					}
				});
			}
			
		});


		let inputs = document.querySelectorAll('input[data-filter]');

		for (let input of inputs) {
		let state = {
			value: input.value,
			start: input.selectionStart,
			end: input.selectionEnd,
			pattern: RegExp('^' + input.dataset.filter + '$')
		};

		input.addEventListener('input', event => {
			if (state.pattern.test(input.value)) {
			state.value = input.value;
			} else {
			input.value = state.value;
			input.setSelectionRange(state.start, state.end);
			}
		});

		input.addEventListener('keydown', event => {
			state.start = input.selectionStart;
			state.end = input.selectionEnd;
		});
		}

		$('#cstedit-addembossing').on('input', function() {

		let $this = $(this);

		let newVal = $this.val()
		.normalize('NFD').replace(/[\u0300-\u036f]/g, "")
		.replace(/[^0-9A-Za-z _]+/g, '');

		$this.val(newVal);

		})

	});
	</script>
    
</head>
<body>
