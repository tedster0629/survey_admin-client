	<?php
		$log = '<p>You need a password to access this survey</p>';
		$log .= '<input type="text" name="password" /><input type="submit" name="submit" value="Validate" />';
 
        if(survey_have_password())
        {
            if(isset($_POST['password']))
            {
                if($_POST['password'] == survey_have_password())
                {
                    setcookie('cookie_survey_allowed', $thisID);
                } else {
					echo $log;
					die();
				}
            } else {
				if(isset($_COOKIE['cookie_survey_allowed']) && @$_COOKIE['cookie_survey_allowed'] == $thisID)
				{ } else {
					echo $log;
					die();
				}
			}
        }
    ?>
    
    <?php
    if(user_completed_survey())
    {
        die('<div id="errorMsg" align="center"><p>'.survey_notice_tookSurvey('You already took this survey').'</p></div>');	
    } 
    ?>

    <?php if(user_answered()) { ?>
    <?php echo '<div id="errorMsg" align="center"><p>'.survey_notice_tookPage('You already answered this page. Continue to next page').'</p></div>';	?>
    <div class="buttonHolder">
        <p class="secondaryAction"><?php get_survey_note(); ?></p>
        <input type="hidden" name="last_page" value="false" />
        <input type="hidden" name="total_results" value="<?php echo count($results); ?>" />
        <input type="hidden" name="page" value="<?php echo user_answered(); ?>" />
        <input type="hidden" name="survey_id" value="<?php echo intval($_GET['id']); ?>" />
        <button class="primaryAction submitButton" name="enquirySubmission" data-option="save-survey" type="button" id="submit-survey-form"><?php echo next_button_text('Next'); ?></button>
    </div>
    <?php die(); } // just append the next button ?>

