<!-- MAIN -->
<div id="main">
        
        <!-- container -->
        <div class="bg">
        	
            <!-- row -->
            <div class="row">
            	
                <div class="col-md-12"><!-- col-md-9 -->
				  <div class="content-header">
					<h1 color = "#4172a5!important">Manage Surveys</h1>
				  </div>

				  <!-- MAIN CONTENT -->
				  <div id="main-content" style = "padding : 15px">
					<div class="notice_messages"></div>

					<div class="box box-info" >
					  <div class="header"  style = "padding : 10px">
						<h3 class="sec_title">Surveys</h3>
					  </div>
					  <div class="content table-responsive">
						<?php if ($survey == true) { ?>
							<table id="example1" class="table table-bordered table-striped" id="dataTable">
								<thead>
									<tr>
									<th>SL</th>
									<th>Survey</th>
									<th>Number of questions</th>
									<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($survey as $v) { ?>
									<tr>
									<td class="w-30"><?php echo $v['survey_ID']; ?></td>
									<td><a href="<?php echo base_url(); ?>admin/questions?id=<?php echo $v['survey_ID']; ?>" title="View Survey"><?php echo $v['name']; ?></a></td>
									<td class="w-130"><?php echo $this->Model_manage_surveys->get_number_of_questions($v['survey_ID']); ?></td>
									<td class="w-60">
										<a href="<?php echo base_url(); ?>admin/questions?id=<?php echo $v['survey_ID']; ?>" class="btn btn-warning btn-xs" title="View Survey">View</a>
										<a href="#editSurvey_<?php echo $v['survey_ID']; ?>" class="btn btn-primary btn-xs" data-toggle="modal" title="Edit Survey" data-survey="<?php echo $v['name']; ?>" data-password="<?php echo $v['password']; ?>" data-id="<?php echo $v['survey_ID']; ?>" id="editAction">Edit</a>
										<a href="#deleteSurvey_<?php echo $v['survey_ID']; ?>" class="btn btn-danger btn-xs" data-toggle="modal" title="Remove Survey" data-survey="<?php echo $v['name']; ?>" data-id="<?php echo $v['survey_ID']; ?>" id="deleteAction">Delete</a>
									</td>
									</tr>

								<!-- editSurvey Modal -->
									<div id="editSurvey_<?php echo $v['survey_ID']; ?>" class="modal fade">
										<div class="modal-dialog">
											<div class="modal-content">
											<div class="modal-header">
												<h3 class="modal-title">Edit <span id="surveyTitle"></span></h3>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											</div>
											<form id="edit-survey" class="form-horizontal margin-reset" method="post" action = "<?php echo base_url(); ?>admin/manage_surveys/editSurvey">
												<div class="modal-body">
												<div class="notice_messages"></div>
												<input type="hidden" name="survey_ID" id = "survey_ID" value = "<?php echo $v['survey_ID']; ?>" >
												<div class="row" style="margin-bottom : 10px">
													<div class="col-md-3">
													<p>New Survey Name:</p>
													</div>
													<div class="col-md-9">
													<input type="text" name="new-survey-name" id="new-survey-name" class="form-control" placeholder = "<?php echo $v['name'] ?>">
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
													<p>New Survey Password:</p>
													</div>
													<div class="col-md-9">
													<input type="text" name="new-survey-password" id="new-survey-password" class="form-control" placeholder = "<?php echo $v['password'] ?>">
													<p class="help-block">Hint: leave blank for no password</p>
													</div>
												</div>
												</div>
												<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												<button type="submit" name="create-survey" data-option="edit-survey" class="btn btn-primary">Save Changes</button>
												</div>
											</form>
											</div>
										</div>
									</div>

									<!-- deleteSurvey Modal -->
									<div id="deleteSurvey_<?php echo $v['survey_ID']; ?>" class="modal fade">
										<div class="modal-dialog">
											<div class="modal-content">
											<div class="modal-header">
												<h3 class="modal-title">Delete <span id="surveyTitle"></span>?</h3>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											</div>
											<form id="delete-survey" class="form-horizontal margin-reset" method="post" action = "<?php echo base_url(); ?>admin/manage_surveys/delete_survey">
												<input type="hidden" name="survey_ID" id = "survey_ID" value = "<?php echo $v['survey_ID']; ?>" >
												<div class="modal-body">
												<div class="notice_messages"></div>
												<p>By deleting this survey, you will also delete its statistics, answers, and questions.</p>
												<p>Are you sure you want to delete this survey?</p>
												</div>
												<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												<button type="submit" name="delete-survey" data-option="delete-survey" class="btn btn-danger">Delete</button>
												</div>
											</form>
											</div>
										</div>
									</div>
									

									<?php } ?>
								</tbody>
								</table>
						<?php } else { ?>
						<p class="px-4">No Surveys found</p>
						<p class="px-4">There are no surveys to manage. First, you need to <a href="<?php echo base_url(); ?>admin/create_surveys">create a survey</a></p>
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
	