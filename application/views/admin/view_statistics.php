<?php 
	$id = intval($_GET['id']);
	if(!isset($id) || $id == 0)
	{
		header('Location: view_surveys_statistics.php');
		exit();
	}
?>

<!-- MAIN -->
<div id="main">
    <!-- container -->
    <div class="bg">
        <!-- row -->
        <div class="row">
            <div class="col-md-12 col-xs-12"><!-- col-md-9 -->
                <div class="content-header">
                    <?php if($this->Model_statistics->get_survey_info($id, 'name') == true) { ?>    
                    <h1 color = "#4172a5!important"><?php echo $this->Model_statistics->get_survey_info($id, 'name'); ?></h1>
                    <p>Statistics and results for survey: <?php echo $this->Model_statistics->get_survey_info($id, 'name'); ?></p>
                    <?php 
                        if($this->Model_statistics->check_reset_admin_IP($id)) {
                            echo '<p><a href="#" class="survey-reset" id="'.$id.'">Reset took survey</a> for this survey</p>';    
                        }
                    } else {
                        // not valid survey id and not valid id 
                        header('Location: survey_statistics.php');
                        exit();
                    } ?>
                </div>
                <!-- MAIN CONTENT -->
                <div id="main-content" style = "padding : 15px">
                    <div class="notice_messages"></div>
                    <!-- Quick Buttons -->
                    <div class="quick-buttons" style = "margin-bottom : 10px">
                        <div class="row">
                            <div class="col-md-3">                    
                                <div class="btn btn-primary btn-block">
                                    <strong><?php echo $this->Model_statistics->counts('Surveys'); ?></strong>
                                    <span class="dasboard-icons-title">Surveys</span>
                                </div>
                            </div>
                            <div class="col-md-3">                    
                                <div class="btn btn-primary btn-block">
                                    <strong><?php echo $this->Model_statistics->get_number_of_questions($id); ?></strong>
                                    <span class="dasboard-icons-title">Questions</span>
                                </div> 
                            </div> 
                            <div class="col-md-3">                    
                                <div class="btn btn-primary btn-block">
                                    <strong><?php echo $this->Model_statistics->counts('Answers',  $id); ?></strong>
                                    <span class="dasboard-icons-title">Answers</span>
                                </div>
                            </div>                
                            <div class="col-md-3">                    
                                <div class="btn btn-primary btn-block">
                                    <strong><?php echo $this->Model_statistics->counts('Took_Survey', $id); ?></strong>
                                    <span class="dasboard-icons-title">Entries</span>
                                </div> 
                            </div> 
                        </div>
                    </div>
                    <!-- // Quick Buttons -->
                    <div class="box box-info">
                        <div class="header" style = "padding : 10px"><h3 class="sec_title">Questions</h3></div> 
                        <div class="content">
                        <?php if($this->Model_statistics->listQuestions($id) == true) { ?>
                        <table  id="example1" class="table table-bordered table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Fill</th>
                                    <th>Question</th>
                                    <th>Question Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($this->Model_statistics->listQuestions($id) as $v) { ?>
                                <tr>
                                    <td class="w-30">
                                    <?php
                                    if($this->Model_statistics->results_exists($v['question_ID'])) {
                                        echo '<span class="glyphicon glyphicon-ok"></span>';
                                    } else {
                                        echo '<span class="glyphicon glyphicon-remove"></span>';
                                    }
                                    ?>
                                    </td>
                                    <td><a href="<?php echo base_url();?>admin/statistic?id=<?php echo $v['question_ID']; ?>" title="View Answers"><?php echo $v['questions']; ?></a></td>
                                    <td class="w-130"><?php echo $this->Model_statistics->question_types[$v['question_type']]; ?></td>
                                </tr>    
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php } else { ?>
                            <p class="pad20 pb-0 mb-0">No Questions found</p>
                            <p class="pad20">There are no questions for this survey.</p>
                        <?php } ?>                              
                        </div>
                    </div>
                    <?php $_SESSION['survey_name'] = $this->Model_statistics->get_survey_info($id, 'name'); ?>
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