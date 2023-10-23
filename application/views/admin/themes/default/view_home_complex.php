<?php include('header.php'); ?>
	
	<form class="uniForm" id="uniValidation" method="post">
    	
        <!-- Header -->
        <div class="header">
            <h2><?php get_survey_heading(); ?></h2>
            <p><?php get_survey_subHeading(); ?></p>
        </div>
        
		<?php 
		get_survey_intro();
		get_survey_description();
		?>
		
        <div id="ajax_messages"></div>
		
        <?php include('checks.php'); ?>
        
        <?php 
		for($i = $firstIndex; $i < $firstIndex+$per_page && $i < $total_pages; $i++)
        { 
			if($requeriment[$i+1] == 0)
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
			
            if(isset($session[$i]))
            {
                echo '<h3 class="section">'.$session[$i].'</h3>'."\n";
            }
            
            $t = '';
			
			$t .= '<div class="inlineLabels ctrlHolder">'."\n";
            switch($question_types_final[$i+1])
            {
                case "comment_box-".($i+1):
                    $t .= '<label>'.($i+1).'.'.$results[$i+1].'</label>'."\n";
                    $t .= '<textarea rows="25" name="suggestion-('.$ids[$i].')" class="'.$the_css.'" cols="25"'.$req_attr.'></textarea>'."\n";
                break;
                
                case "yes_no-".($i+1):
					if(stripos(', ', $combine["yes_no-".($i+1)])) { $rule = ', '; } else { $rule = ','; }
                    $ans = explode($rule,$combine["yes_no-".($i+1)]);
                    $t .= '<label>'.($i+1).'.'.$results[$i+1].'</label>'."\n";
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
					$t .= '<p class="formHint">'.choices_hint('Choose one or more options').'</p>'."\n";
				break;
				
				case "single_text-".($i+1):
					 $t .= '<label>'.($i+1).'.'.$results[$i+1].'</label>'."\n";
					 $t .= '<input type="text" name="single-('.$ids[$i].')" class="textInput large '.$the_css.'" value=""'.$req_attr.' />';
				break;
				
				case "matrix_single-".($i+1):
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
							$r .= '<td><input type="radio" name="matrix_single-('.$ids[$i].')-'.($ids[$i]+$z-1).'" title="'.$v.'-'.$cols[$xt].'" value="'.$v.'-'.$cols[$xt].'"'.$req_attr.' /></td>'."\n";	
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
					$t .= '<p class="formHint">'.choices_hint('Choose one or more options').'</p>'."\n";
				break;
				
            }	
			$t .= "</div>"."\n";
						
            echo $t;
			
        }
        ?>
                
        <?php include('buttons.php'); ?>
        
    </form>
    
<?php include('footer.php'); ?>