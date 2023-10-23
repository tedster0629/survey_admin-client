	<?php 
		if($i >= count($results) && $firstIndex >= count($results)) 
		{
			die('<div id="errorMsg" align="center"><p>Out of Range</p></div>');	
		}
		
		if($i !== count($results)) { 
			?>
			<div class="buttonHolder">
				<p class="secondaryAction"><?php get_survey_note(); ?></p>
				<input type="hidden" name="last_page" value="false" />
				<input type="hidden" name="total_results" value="<?php echo count($results); ?>" />
				<input type="hidden" name="page" value="<?php echo $page+1; ?>" />
				<input type="hidden" name="survey_id" value="<?php echo $_GET['id']; ?>" />
				<button class="primaryAction submitButton btn btn-primary" name="enquirySubmission" data-option="save-survey" type="button" id="submit-survey-form"><?php echo next_button_text('Next'); ?></button>
			</div>
			<?php 
		} else { 
			?>
			<div class="buttonHolder">
				<p class="secondaryAction"><?php get_survey_note(); ?></p>
				<input type="hidden" name="last_page" value="true" />
				<input type="hidden" name="total_results" value="<?php echo count($results); ?>" />
				<input type="hidden" name="page" value="<?php echo $page+1; ?>" />
				<input type="hidden" name="survey_id" value="<?php echo $_GET['id']; ?>" />
				<button class="primaryAction btn btn-primary" name="enquirySubmission" id="submit-survey-form" data-option="save-survey" type="button" value="Send"><?php echo submit_button_text('Send') ?></button>
			</div>
			<?php
		} 
	?>