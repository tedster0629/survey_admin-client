   <!-- MAIN -->
   <div id="main">
    	    
        <!-- container -->
        <div class="bg">
        	
            <!-- row -->
            <div class="row">

                <div class="col-md-12 pe-0"><!-- col-md-9 -->  
					<div class="content-header">    
						<h1 color = "#4172a5!important">Survey Statistics</h1>
					</div>

                    <!-- MAIN CONTENT -->
                    <div id="main-content" style = "padding : 15px">

                        <div class="notice_messages"></div>

                        <div class="box box-info">
                            <div class="header"  style = "padding : 10px">
                                <h3 class="sec_title">Surveys</h3>
                            </div>
                            <div class="box-body">
                                <?php if($survey == true) { ?>
                                <table id="example1" class="table table-bordered table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Survey</th>
                                            <th>Number of questions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($survey as $v) { ?>
                                        <tr>
                                            <td class="col-xs-3"><?php echo $v['survey_ID']; ?></td>
                                            <td><a href="<?php echo base_url(); ?>admin/statistics?id=<?php echo $v['survey_ID']; ?>" title="View Survey"><?php echo $v['name']; ?></a></td>
                                            <td class="col-xs-3"><?php echo $this->Model_manage_surveys->get_number_of_questions($v['survey_ID']); ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <?php } else { ?>
                                    <p class="pad20 pb-0 mb-0">No Surveys found</p>
                                    <p class="pad20">There are no surveys to manage. First, you need to <a href="create_survey.php">create a survey</a></p>
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