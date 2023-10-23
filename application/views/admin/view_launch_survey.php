<!-- MAIN -->
<div id="main">
    <!-- container -->
    <div class="bg">
        <!-- row -->
        <div class="row">
            <div class="col-md-12 pe-0"><!-- col-md-9 -->  
                <div class="content-header">    
                    <h1 style="color: #4172a5!important;">Launch Survey</h1>
                    <p>Customize the survey that goes live</p>
                </div>
                <!-- MAIN CONTENT -->      
                <div id="main-content" style="padding: 15px;">
                    <div class="notice_messages"></div>
                    <?php
                    switch(@$_GET['step'])
                    {
                        case 1:
                            $check_survey = $check_survey_data;
                            // Step 1
                            ?>
                            <div class="box box-info">
                                <div class="header" style="padding: 10px;">
                                    <h3 class="sec_title">Launch Survey - Step 1</h3>
                                </div> 
                                <div class="content">
                                    <?php  if(!empty($check_survey)) { ?>
                                    <form id="launchSurvey-form" class="form-horizontal margin-reset" method="post" action="?step=2">
                                        <div class="row pad20">
                                            <div class="col-xs-3">
                                               Choose Survey:
                                            </div>
                                            <div class="col-xs-5">
                                                <select name="survey" class="form-control">
                                                    <?php 
                                                        foreach($check_survey_data as $v) 
                                                        { 
                                                            echo '<option value="'.$v['survey_ID'].'">'.$v['name'].'</option>'."\n";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="separator"></div>
                                        <div class="row pad20">
                                            <div class="col-xs-3">
                                               Choose a theme:
                                            </div>
                                            <div class="col-xs-5">
                                                <select name="theme" class="form-control">
                                                    <?php 
                                                        $themes = array('default');
	
                                                        foreach($themes as $v) 
                                                        { 
                                                            echo '<option value="'.$v.'">'.$v.'</option>'."\n";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="separator"></div>
                                        <div class="row pad20">
                                            <div class="col-xs-3">
                                               Title:
                                            </div>
                                            <div class="col-xs-5">
                                                <input type="text" name="title" class="form-control" />
                                                <p class="help-block">Hint: The title for the survey</p>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="separator"></div>
                                        <div class="row pad20">
                                            <div class="col-xs-3">
                                               Heading:
                                            </div>
                                            <div class="col-xs-5">
                                                <input type="text" name="heading" class="form-control" />
                                                <p class="help-block">Hint: The heading</p>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="separator"></div>
                                        <div class="row pad20">
                                            <div class="col-xs-3">
                                               Sub Heading:
                                            </div>
                                            <div class="col-xs-5">
                                                <input type="text" name="sub-heading" class="form-control" />
                                                <p class="help-block">Hint: The subheading</p>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="separator"></div>
                                        <div class="row pad20">
                                            <div class="col-xs-3">
                                                Intro:
                                            </div>
                                            <div class="col-xs-5">
                                                <input type="text" name="intro" class="form-control" />
                                                <p class="help-block">Hint: The introductory text for the survey</p>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="separator"></div>
                                        <div class="row pad20">
                                            <div class="col-xs-3">
                                               Description:
                                            </div>
                                            <div class="col-xs-5">
                                                <input type="text" name="description" class="form-control" />
                                                <p class="help-block">Hint: The description of the survey</p>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="separator"></div>
                                        <div class="row pad20">
                                            <div class="col-xs-3">
                                               Note:
                                            </div>
                                            <div class="col-xs-5">
                                                <input type="text" name="note" class="form-control" />
                                                <p class="help-block">Hint: Some note to the survey</p>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="separator"></div>
                                        <div class="row pad20">
                                            <div class="col-xs-3">
                                               Footer:
                                            </div>
                                            <div class="col-xs-5">
                                                <input type="text" name="footer" class="form-control" />
                                                <p class="help-block">Hint: Custom footer</p>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="separator"></div>
                                        <div class="row pad20">
                                            <div class="col-xs-3">
                                              Will this survey have template sessions?
                                            </div>
                                            <div class="col-xs-5">
                                                <label class="radio-inline">
                                                   <input type="radio" name="radio" value="Yes"> Yes
                                                </label>
                                                <label class="radio-inline">
                                                   <input type="radio" name="radio" checked="checked" value="No"> No
                                                </label>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="float-end pad20">
                                                <button type="submit" name="step2" data-option="step2" class="btn btn-primary float-end">Next</button>
                                            </div>
                                        </div>
                                     </form>
                                 <?php } else { ?>
                                    <p style="padding: 20px;">No surveys ready to be launched. Try adding some questions to the surveys and organize it to publish.</p>
                                 <?php } ?>
                                </div>
                            </div>
                        <?php
                        break;
                        case 2:
                            if(isset($_POST['survey']) && isset($_POST['radio']))
                            {
                                $survey_id = $_POST['survey'];
                                $action = $_POST['radio'];
                                if($action == 'Yes')
                                {
                                    $_POST['sessions'] = 'Y';
                                    // check if survey exists to avoid extra job:
                                    if($this->Model_launch_survey->check_template_survey('survey_id', 'survey_id', $_POST['survey']) == $_POST['survey'])
                                    {
                                        echo '<p>Something went wrong publishing survey. Probably it\'s already published</p>';    
                                        die();
                                    }
                                    $master_array = array(
                                        'survey_id' => $_POST['survey'],
                                        'title' => $_POST['title'],
                                        'heading' => $_POST['heading'],
                                        'sub_heading' => $_POST['sub-heading'],
                                        'intro' => $_POST['intro'],
                                        'description' => $_POST['description'],
                                        'note' => $_POST['note'],
                                        'footer' => $_POST['footer'],
                                        'template_rule' => '-',
                                        'sessions' => $_POST['sessions'],
                                        'theme' => $_POST['theme']
                                    );
                                    $serialized = htmlspecialchars(serialize($master_array));
                                    if($master_array)
                                    {
                                        // Check for dropzones - #dropzone
                                        echo '<p>One more step and it\'s done.</p>';
                                        echo '<p>You are allowed to organize your questions in a max of 6 sections. Leave blank if you don\'t want to use that section.</p>';
                                        ?>
                                        <div class="box box-info">
                                            <div class="header" style="padding: 10px;">
                                                <h3 class="sec_title">Launch Survey - Step 2</h3>
                                            </div> 
                                            <div class="content">
                                                <form id="launchSurvey-form" class="form-horizontal margin-reset" method="post" action="?step=3">
                                                    <div class="row pad20">
                                                        <div class="col-xs-3">
                                                            Drop Zone #1
                                                        </div>
                                                        <div class="col-xs-5">
                                                            <input type="text" class="form-control" name="name_drop-zone-1" />
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                    <div class="row pad20">
                                                        <div class="col-xs-3">
                                                            Drop Zone #2
                                                        </div>
                                                        <div class="col-xs-5">
                                                            <input type="text" class="form-control" name="name_drop-zone-2" />
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                    <div class="row pad20">
                                                        <div class="col-xs-3">
                                                            Drop Zone #3
                                                        </div>
                                                        <div class="col-xs-5">
                                                            <input type="text" class="form-control" name="name_drop-zone-3" />
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                    <div class="row pad20">
                                                        <div class="col-xs-3">
                                                            Drop Zone #4
                                                        </div>
                                                        <div class="col-xs-5">
                                                            <input type="text" class="form-control" name="name_drop-zone-4" />
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                    <div class="row pad20">
                                                        <div class="col-xs-3">
                                                            Drop Zone #5
                                                        </div>
                                                        <div class="col-xs-5">
                                                            <input type="text" class="form-control" name="name_drop-zone-5" />
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                    <div class="row pad20">
                                                        <div class="col-xs-3">
                                                            Drop Zone #6
                                                        </div>
                                                        <div class="col-xs-5">
                                                            <input type="text" class="form-control" name="name_drop-zone-6" />
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                   <p class="hint col-xs-12 pad20">Hint: Give a name to the sections that contain questions. Each dropzone equals each group of questions section</p>
                                                   <div class="clear"></div>
                                                    <?php echo "<input type=\"hidden\" name=\"ArrayData\" value=\"$serialized\"/>"; ?>
                                                    <div class="form-actions">
                                                        <div class="float-end pad20">
                                                            <button type="submit" name="step3" data-option="step3" class="btn btn-primary float-end">Next</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        echo '<p>Something went wrong publishing survey. Probably it\'s already published</p>';    
                                    }
                                } else {
                                    $_POST['sessions'] = 'N';
                                    $_POST['template_rule'] = '-';
                                    // Insert Survey
                                    $publish = $this->Model_launch_survey->publish_survey($_POST);
                                    if($publish)
                                    {
                                    echo '<p>Survey was successfully published. <a href="../check?id='.$_POST['survey'].'" target = "blank">Have a look</a></p>';
                                    } else {
                                        echo '<p>Something went wrong publishing survey. Probably it\'s already published</p>';    
                                    }
                                }
                            } else {
                                header('Location: ?step=1');
                                exit();    
                            }
                        break;
                        case 3:
                            // Last step for dropzones
                            if(isset($_POST['step3']) && (!empty($_POST['name_drop-zone-1']) || !empty($_POST['name_drop-zone-2']) || !empty($_POST['name_drop-zone-3']) || !empty($_POST['name_drop-zone-4']) || !empty($_POST['name_drop-zone-5']) || !empty($_POST['name_drop-zone-6'])))
                            {
                                function count_zones($a) 
                                {
                                    $total = 0;
                                    foreach ($a as $elt) 
                                    {
                                        if (!is_null($elt) && !empty($elt)) 
                                        {
                                            $total++;
                                        }
                                    }
                                    return $total;
                                }
                                $unserialized = unserialize($_POST['ArrayData']);
                                $ser_master['master_array']['master_array'] = $unserialized; 
                                $serialized_master = serialize($ser_master['master_array']);
                                $dropzones = array(
                                    $_POST['name_drop-zone-1'], 
                                    $_POST['name_drop-zone-2'], 
                                    $_POST['name_drop-zone-3'], 
                                    $_POST['name_drop-zone-4'], 
                                    $_POST['name_drop-zone-5'], 
                                    $_POST['name_drop-zone-6']
                                );
                                ?>
                                <!-- Items -->
                                <div class="box box-info">
                                    <div class="header" style="padding: 10px;">
                                        <h3 class="sec_title">Draggable Questions</h3>
                                    </div>
                                    <div class="content">
                                        <div id="questions-items" class="mt10">
                                            <ul class="unordered">
                                            <?php
                                                foreach($this->Model_launch_survey->listQuestions($unserialized['survey_id']) as $v)
                                                {
                                                    echo '<li id="'.$v['question_ID'].'">'.$v['questions'].'</li>';    
                                                }
                                            ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Dropzones -->
                               <div class="row-fluid grid-set tpl-dropzones">
                                    <?php 
                                        for($i = 1; $i <= count_zones($dropzones); $i++) 
                                        {
                                            ?>
                                                <div class="col-xs-4">
                                                    <div class="box box-info">
                                                        <div class="header" style="padding: 10px;"><h3 class="sec_title"><?php echo $dropzones[$i-1]; ?></h3></div>
                                                        <div class="content pad">
                                                            <div class="droppable">
                                                                <ol id="drop-zone<?php echo $i; ?>" style="padding: auto">
                                                                    <li class="placeholder">Add your items here</li>
                                                                </ol>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            <?php
                                            $new_array[] = $dropzones[$i-1];
                                            $serialized_dropzone = serialize($new_array);
                                        }
                                    ?>
                                    <input type="hidden" name="dropzones" id="dropzones-names" value="<?php echo $serialized_dropzone; ?>" />
                                    <input type="hidden" name="post-master" id="post-master" value="<?php echo $serialized_master; ?>" />
                                    <div class="clear"></div>
                                     <p class="hint mt20">Hint: Double click on the item inside the dropzone to remove the item</p>
                                    <div class="form-actions">
                                        <div class="float-end pad20">
                                            <button type="submit" name="save-drop-zones" id="save-drop-zones" class="btn btn-primary float-end">Publish Survey</button>
                                        </div>
                                    </div>
                                </div>  
                            <?php
                            } else {
                                header('Location: ?step=1');
                                exit();        
                            }
                        break;
                        default:
                            ?>
                            <div class="box box-info">
                                <div class="header" style="padding: 10px;">
                                    <h3 class="sec_title">Launched Surveys
                                        </h3>
                                        <a class="btn btn-sm btn-primary pull-right poscenter" href="?step=1">Launch Survey</a>
                                </div> 
                                <div class="content">
                                    <?php if($this->Model_launch_survey->listLiveSurveys() == true) { ?>
                                    <table id="example1" class="table table-bordered table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Survey Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($this->Model_launch_survey->listLiveSurveys() as $v) { ?>
                                            <tr>
                                                <td class="w-25"><?php echo $v->TID; ?></td>
                                                <td><a href="<?php echo base_url(); ?>admin/edit_live?id=<?php echo $v->TID; ?>" title="Edit Live Survey"><?php echo $v->name; ?></a></td>
                                                <td class="w-25">
                                                        <a class="btn btn-warning btn-xs" href="themes/default/validation?id=<?php echo $v->survey_ID; ?>" title="Preview Survey" target = "blank">Preview</a>
                                                        <a class="btn btn-primary btn-xs" href="<?php echo base_url(); ?>admin/edit_live?id=<?php echo $v->TID; ?>" title="Edit Live Survey">Edit</a>
                                                        <a class="btn btn-danger btn-xs" href="#deleteLiveSurvey<?php echo $v->TID; ?>" data-toggle="modal" title="Remove Live Survey" data-lsurvey="<?php echo $v->name; ?>" data-id="<?php echo $v->TID; ?>" id="deleteAction">Remove</a>
                                                </td>
                                            </tr>
                                            
                                            <!-- delete Survey Modal -->
                                            <div class="modal fade" id="deleteLiveSurvey<?php echo $v->TID; ?>" tabindex="-1" aria-labelledby="deleteLiveSurveyLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content" style = "padding : 30px">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteLiveSurveyLabel">Delete Live Survey: <span id="hliveSurvey"></span></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form id="delete-live-survey" class="modal-body" action = "<?php echo base_url(); ?>admin/launch_survey/delete_launchSurvey" method='post'>
                                                            <div class="notice_messages"></div>
                                                            <input type="hidden" name="id" id = "id" value = "<?php echo $v->TID; ?>" >
                                                            <p>Are you sure you want to delete this live survey?</p>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" name="delete-live-survey" data-option="delete-live-survey" class="btn btn-danger">Delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <?php } else { ?>
                                        <p class="pad20 pb-0 mb-0">No Live Surveys found</p>
                                        <p class="pad20">There are no published surveys. First, you need to <a data-toggle="modal" href="?step=1">publish a survey</a></p>
                                    <?php } ?>                              
                                </div>
                            </div>

                            <?php
                        break;
                    }
                    ?>
                </div>
                <!-- // MAIN CONTENT -->
            </div>
            <!-- // col-md-9 -->
        </div>
        <!-- // row -->
    </div>
    <!-- // container -->
</div>
<!-- // MAIN -->