<div class = "container">
	<div class = "box box-info" style = "padding :30px">
<form class="uniForm" id="uniValidation" method = "POST" enctype = "multipart/form-data" action="<?php echo base_url();?>admin/launch_survey/submitSurvey?ids=<?php echo $ids[$i]?>">
    	
        <!-- Header -->
        <div class="header">
            <h2><?php  $get_survey_heading; ?></h2>
            <p><?php $get_survey_subHeading; ?></p>
        </div>
        
		<?php 
		$get_survey_intro;
		$get_survey_description;
		?>
		
        <div id="ajax_messages"></div>
		
		
		<?php
		// if($user_completed_survey)
		// {
		// 	die('<div id="errorMsg" align="center"><p>'.'You already took this survey'.'</p></div>');	
		// } 
		?>

		<?php if($user_answered) { ?>
		<?php echo '<div id="errorMsg" align="center"><p>'.$survey_notice_tookPage('You already answered this page. Continue to next page').'</p></div>';	?>
		<div class="buttonHolder">
			<p class="secondaryAction"><?php $get_survey_note; ?></p>
			<input type="hidden" name="last_page" value="false" />
			<input type="hidden" name="total_results" value="<?php echo count($results); ?>" />
			<input type="hidden" name="page" value="<?php echo $user_answered(); ?>" />
			<input type="hidden" name="survey_id" value="<?php echo $intval($_GET['id']); ?>" />
			<button class="primaryAction submitButton" name="enquirySubmission" data-option="save-survey" type="button" id="submit-survey-form"><?php echo $next_button_text('Next'); ?></button>
		</div>
		<?php die(); } // just append the next button ?>


        
        <?php 
		for($i = $firstIndex; $i < $firstIndex+$per_page && $i < $total_pages; $i++)
        { 
			
			if(isset($requeriment[$i+1]) &&$requeriment[$i+1] == 0)
			{
				$req = '';
				$req_attr = '';
			} else {
				$req = 'validate[required]';
				$req_attr = ' data-rule-required="true"';
			}
			
			if(!empty($css[$i+1]))
			{
				if(stripos('.', $css[$i+1]) || stripos('"', $css[$i+1]))
				{
					$the_css = '';	
				} else {
					$the_css = $css[$i+1];	
				}
			} else {
				$the_css = '';	
			}
            
            $t = '';
			
			$t .= '<div class="inlineLabels ctrlHolder">'."\n";
            switch($question_types_final[$i+1])
            {
				case "file_upload-".($i+1):
                    $t .= '<label>'.($i+1).'.'.$results[$i+1].'</label>'."\n";
                    $t .= '<input type="file" name="file_upload-('.$ids[$i].')" />
					<input  type="hidden" value="Upload" name="file_upload-('.$ids[$i].')" />'
					."\n";
                break;

				case "date-".($i+1):
                    $t .= '<label>'.($i+1).'.'.$results[$i+1].'</label>'."\n";
                    $t .= '<input name="date-('.$ids[$i].')" class="form-control" type="date">'."\n";
                break;

				case "rating-".($i+1):
                    $t .= '<label>'.($i+1).'.'.$results[$i+1].'</label>'."\n";
                    $t .= '<input type="number" name="rating-('.$ids[$i].')" min="0" max="5" class="form-control">'."\n";
                break;

				case "comment_box-".($i+1):
                    $t .= '<label>'.($i+1).'.'.$results[$i+1].'</label>'."\n";
                    $t .= '<textarea rows="25" name="suggestion-('.$ids[$i].')" class="'.$the_css.'" cols="25"'.$req_attr.'></textarea>'."\n";
                break;

				case "paragraph-".($i+1):
                    $t .= '<label>'.($i+1).'.'.$results[$i+1].'</label>'."\n";
                    $t .= '<textarea maxlength="1000"  onkeyup="limit(this)" id="cstedit-addembossing" rows="25" name="paragraph-('.$ids[$i].')" class="'.$the_css.' form-control" cols="25"'.$req_attr.'></textarea>'."\n";
                break;
                
                case "yes_no-".($i+1):
					if(stripos(', ', $combine["yes_no-".($i+1)])) { $rule = ', '; } else { $rule = ','; }
                    $ans = explode($rule,$combine["yes_no-".($i+1)]);
                    if(isset($results[$i+1]))$t .= '<label>'.($i+1).'.'.$results[$i+1].'</label>'."\n";
					$t .= '<ul class="'.$position[$i].'">'."\n";
                    foreach($ans as $v)
                    {
                        $t .= '<li><label><input name="yes_no-('.$ids[$i].')" class="'.$the_css.'" type="radio" value="'.$v.'"'.$req_attr.'> '.$v.'</label></li>'."\n";	
                    }
					$t .= '</ul>'."\n";
                break;
                
                case "dropdown_menu-".($i+1):
                    $ans = explode(', ',$combine["dropdown_menu-".($i+1)]);
                    $t .= '<label>'.($i+1).'.'.$results[$i+1].'</label>'."\n";
					$t .= '<select class="selectInput '.$the_css.'" name="dropdown_menu-('.$ids[$i].')"'.$req_attr.'>'."\n";
                    foreach($ans as $v)
                    {
                        $t .= '<option value="'.$v.'">'.$v.'</option>'."\n";	
                    }
					$t .= '</select>'."\n";
                break;
                
                case "radio-".($i+1):
                    $ans = explode(', ',$combine["radio-".($i+1)]);
                    $t .= '<label>'.($i+1).'.'.$results[$i+1].'</label>'."\n";
					$t .= '<ul class="'.$position[$i].'">'."\n";
                    foreach($ans as $v)
                    {
                        $t .= '<li><label><input name="radio-('.$ids[$i].')" class="'.$the_css.'" type="radio" value="'.$v.'"'.$req_attr.'> '.$v.'</label></li>'."\n";	
                    }
					$t .= '</ul>'."\n";
                break;
				
				case "multiple_choice-".($i+1):
					$ans = explode(', ',$combine["multiple_choice-".($i+1)]);
                    $t .= '<label>'.($i+1).'.'.$results[$i+1].'</label>'."\n";
					$t .= '<ul class="'.$position[$i].'">'."\n";
                    foreach($ans as $v)
                    {
                        $t .= '<li><label><input name="checkbox-('.$ids[$i].')[]" class="'.$the_css.'" type="checkbox" value="'.$v.'"'.$req_attr.'> '.$v.'</label></li>'."\n";	
                    }
					$t .= '</ul>'."\n";
					$t .= '<p class="formHint">'.'Choose one or more options'.'</p>'."\n";
				break;
				
				case "single_text-".($i+1):
					 $t .= '<label>'.($i+1).'.'.$results[$i+1].'</label>'."\n";
					 $t .= '<input type="text" name="single-('.$ids[$i].')" class="textInput large '.$the_css.'" value=""'.$req_attr.' />';
				break;

				case "short_answer-".($i+1):
					$t .= '<label>'.($i+1).'.'.$results[$i+1].'</label>'."\n";
					$t .= '<input  type="text" data-filter="([A-Z]?|[A-Z][a-z ]*)" maxlength="80" name="short_answer-('.$ids[$i].')" class="form-control textInput large '.$the_css.'" value=""'.$req_attr.' />';
			    break;
				
				case "matrix_single-".($i+1):
					if(isset($results[$i+1]))
					$t .= '<label>'.($i+1).'.'.$results[$i+1].'</label>'."\n";
					
					$a = $combine["matrix_single-".($i+1)];
					$rows = explode(', ',$a["rows"]);
					$cols = explode(', ',$a["headers"]);
					
					$h = '<th></th>'."\n";
					foreach($cols as $v)
					{
						$h .= '<th>'.$v.'</th>'."\n";
					}
					
					$r = ''; $z = 0;
					foreach($rows as $v)
					{
						$z++;
						$r .= '<tr>'."\n";
						$r .= '<th>'.$v.'</th>'."\n";
						for($xt = 0; $xt <= count($cols)-1; $xt++)
						{ 
							$r .= '<td><input type="radio" name="matrix_single-('.$ids[$i].')-'.($ids[$i]+$z-1).'" title="'.$v.'-'.$cols[$xt].'" value="'.$v.'-'.$cols[$xt].'" '.$req_attr.'/></td>'."\n";	
						}
						$r .= '</tr>'."\n";
					}
					
					$t .= 
					'<table class="pure-table pure-table-horizontal '.$the_css.'">
						<tr>
						   '.$h.'
						</tr>
						'.$r.'
					</table>
					';
				break;
				
				case "matrix_multi_select-".($i+1):
					 $t .= '<label>'.($i+1).'.'.$results[$i+1].'</label>'."\n";
					
					$a = $combine["matrix_multi_select-".($i+1)];
					$rows = explode(', ',$a["rows"]);
					$cols = explode(', ',$a["headers"]);
					
					$h = '<th></th>'."\n"; 
					foreach($cols as $v)
					{
						$h .= '<th>'.$v.'</th>'."\n";
					}
					
					$r = ''; $z = 0;
					foreach($rows as $v)
					{
						$z++;
						$r .= '<tr>'."\n";
						$r .= '<th>'.$v.'</th>'."\n";
						for($xt = 0; $xt <= count($cols)-1; $xt++)
						{
							$r .= '<td><input type="checkbox" name="matrix_multi_select-('.$ids[$i].')[]" title="'.$cols[$xt].'-'.$v.'" value="'.$cols[$xt].'-'.$v.'"'.$req_attr.' /></td>'."\n";	
						}
						$r .= '</tr>'."\n";
					}
					
					$t .= 
					'<table class="pure-table pure-table-horizontal '.$the_css.'">
						<tr>
						   '.$h.'
						</tr>
						'.$r.'
					</table>
					';
					$t .= '<p class="formHint">'.'Choose one or more options'.'</p>'."\n";
				break;
				
            }	
			$t .= "</div>"."\n";
						
            echo $t;
			
        }
        ?>
                
				<?php 
					if($i >= count($results) && $firstIndex >= count($results)) 
					{
						die('<div id="errorMsg" align="center"><p>Out of Range</p></div>');	
					}
					
					if($i !== count($results)) { 
						?>
						<div class="buttonHolder">
							<p class="secondaryAction"><?php $get_survey_note; ?></p>
							<input type="hidden" name="last_page" value="false" />
							<input type="hidden" name="total_results" value="<?php echo count($results); ?>" />
							<input type="hidden" name="page" value="<?php echo $page+1; ?>" />
							<input type="hidden" name="survey_id" value="<?php echo $_GET['id']; ?>" />
							<button class="primaryAction submitButton btn btn-primary" name="enquirySubmission" data-option="save-survey" type="button" id="submit-survey-form">Next</button>
						</div>
						<?php 
					} else { 
						?>
						<div class="buttonHolder">
							<p class="secondaryAction"><?php $get_survey_note; ?></p>
							<input type="hidden" name="last_page" value="true" />
							<input type="hidden" name="total_results" value="<?php echo count($results); ?>" />
							<input type="hidden" name="page" value="<?php echo $page+1; ?>" />
							<input type="hidden" name="survey_id" value="<?php echo $_GET['id']; ?>" />
							<button class="primaryAction btn btn-primary" name="enquirySubmission" id="submit-survey-form" data-option="save-survey" type="submit" value="Send">Send</button>
						</div>
						<?php
					} 
				?>
    </form>

</div>
</div>
    