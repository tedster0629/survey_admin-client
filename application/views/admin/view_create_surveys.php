 <!-- MAIN -->
 <div id="main">
        <!-- container -->
        <div class="bg">
        	
            <!-- row -->
            <div class="row">
            	
                <div class="col-md-12 pe-0"><!-- // col-9 -->
				  <div class = "content-header">
					<h1 color = "#4172a5!important">Create Surveys</h1>
				  </div>

				  <!-- MAIN CONTENT -->
				  <div id="main-content" style = "padding : 15px">
					<div class="notice_messages"></div>

					<div class="box box-info">
						<div class="header" style = "padding : 10px">
							<h3 class="sec_title" >New Survey</h3>
						</div>
						<div class="content" style="padding: 20px;">
							<form id="create-survey" class="form-horizontal" method="post" action="<?php echo base_url(); ?>admin/Create_surveys/create_survey">

								<div class="form-group">
									<label for="survey-name" class="col-sm-2 control-label">Survey Name:</label>
									<div class="col-sm-10">
										<input type="text" name="survey-name" class="form-control" />
										<p class="help-block">Hint: Name the survey you want to create</p>
									</div>
								</div>

								<div class="form-group">
									<label for="survey-password" class="col-sm-2 control-label">Password:</label>
									<div class="col-sm-10">
										<input type="text" name="survey-password" class="form-control" />
										<p class="help-block">Hint: Choose a password for the survey. If you want a survey without password, leave it blank.</p>
									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<button type="submit" name="create-survey" data-option="create-survey" class="btn btn-success">Create Survey</button>
									</div>
								</div>

							</form>
						</div>
					</div>
				</div>
				<!-- // MAIN CONTENT -->
				</div>
				<!-- // col-9 -->

				
            </div>
            <!-- // row -->
        </div>
        <!-- // container -->
    </div>
    <!-- // MAIN --> 