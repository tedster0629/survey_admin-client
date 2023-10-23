<?php 
	$id = intval($_GET['id']);
    // $sid = intval($_GET['sid']);
	if(!isset($id) || $id == 0)
	{
		header('Location: manage_survey.php');
		exit();
	}
?>
<!-- MAIN -->
<div id="main">
    <!-- container -->
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-md-12 pe-0">
                <div class="pagetitle">
                    <?php if ($this->Model_answers->get_questions_info($id, 'questions') == true) { ?>    
                    <h1 style = "color : #4172a5!important"><?php echo $this->Model_answers->get_questions_info($id, 'questions'); ?></h1>
                    <?php } else {
                        // not valid survey id and not valid id 
                        header('Location: view_manage_surveys.php');
                        exit();
                    } ?>
                </div>
                <!-- MAIN CONTENT -->      
                <div id="main-content">
                    <div class="notice_messages"></div>
                    <div class="box box-info" style = "margin-top: 20px">
                        <div class="header" style = "padding : 10px"><h3 class="sec_title" >Answers</h3></div> 
                        <div class="panel-body">
                            <?php if ($this->Model_answers->answer_exists($id) == false) { ?>
                            <form id="answers" class="form-horizontal" method="post">
                                <input type="hidden" id="question_type" name="question_type" value="<?php echo $this->Model_answers->get_questions_info($id, 'question_type') ?>" />
                                <input type="hidden" id="q_id" name="q_id" value="<?php echo $id; ?>" />
                                <?php
                                    
                                    switch($this->Model_answers->get_questions_info($_GET['id'], 'question_type'))
                                    {
                                        case "yes_no":
                                            include('forms/yes_no.php');
                                        break;
                                        
                                        case "radio":
                                        case "multiple_choice":
                                        case "dropdown_menu":
                                            include('forms/text_box.php');
                                        break;
                                        
                                        case "matrix_single":
                                        case "matrix_multi_select":
                                            include('forms/matrix.php');
                                        break;	
                                        
                                        case "single_text":
                                        case "comment_box":
                                            include('forms/input_textarea.php');
                                        break;

                                        case "short_answer":
                                            include('forms/short_answer.php');
                                        break;
                                        case "paragraph":
                                            include('forms/paragraph.php');
                                        break;
                                        case "file_upload":
                                            include('forms/file_upload.php');
                                        break;
                                        case "date":
                                            include('forms/date.php');
                                        break;
                                        case "rating":
                                            include('forms/rating.php');
                                        break;
                                        
                                        default:
                                            include('forms/no_template.php');
                                        break;
                                    }		
                                        
                                ?>
                            </form>
                            <?php } else { ?>

                            <form id="answers" class="form-horizontal" method="post" action = "<?php echo base_url();?>admin/answers/add_answer">
                           
                                <input type="hidden" id="question_type" name="question_type" value="<?php echo $this->Model_answers->get_questions_info($id, 'question_type') ?>" />
                                <input type="hidden" id="q_id" name="q_id" value="<?php echo $id; ?>" />
                                <?php
	
                                $answers = $this->Model_answers->listAnswer($_GET['id'], 'answer');
                                
                                $answers =  unserialize($answers[0]['answer']);

                                $css_class = $this->Model_answers->listAnswer($_GET['id'], 'css');
                                $css_class = $css_class[0]['css'];
                                
                                $position = $this->Model_answers->listAnswer($_GET['id'], 'position');
                                $position = $position[0]['position'];
                                switch($this->Model_answers->get_questions_info($_GET['id'], 'question_type'))
                                {
                                    case "yes_no":
                                        $answers = explode(',', $answers);
                                        include('forms/yes_no-update.php');
                                    break;
                                    
                                    case "radio":
                                    case "multiple_choice":
                                    case "dropdown_menu":
                                        include('forms/text_box-update.php');
                                    break;
                                    
                                    case "matrix_single":
                                    case "matrix_multi_select":
                                        include('forms/matrix-update.php');
                                    break;
                                    
                                    case "single_text":
                                    case "comment_box":
                                        include('forms/input_textarea-update.php');
                                    break;
                                    case "short_answer":
                                        include('forms/short_answer-update.php');
                                    break;
                                    case "paragraph":
                                        include('forms/paragraph-update.php');
                                    break;
                                    case "file_upload":
                                        include('forms/file_upload-update.php');
                                    break;
                                    case "date":
                                        include('forms/date-update.php');
                                    break;

                                    case "rating":
                                        include('forms/rating-update.php');
                                    break;
                                    default:
                                        include('forms/no_template.php');
                                    break;	
                                }

                            ?>
                            </form>
                            <?php } ?>           
                        </div>
                    </div>
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