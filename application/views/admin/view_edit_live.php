<?php 
	$id = intval($_GET['id']);
	if(!isset($id) || $id == 0)
	{
		header('Location: view_launch_survey.php');
		exit();
	}
?>
<!-- MAIN -->
<div id="main">
    <!-- container -->
    <div class="bg">
        <!-- row -->
        <div class="row">
            <div class="col-md-12 pe-0"><!-- col-md-9 -->
				<div class="content-header">
					<h1 style="color: #4172a5!important;">Edit: <?php echo $this->Model_edit_live->get_live_survey('name', $id); ?></h1>
				</div>
				<!-- MAIN CONTENT -->      
				<div id="main-content">
					<div class="notice_messages"></div>
					<div class="box box-info">
						<div class="header" style="padding: 10px;">
							<h3 class="sec_title">Edit Survey Template: <?php echo $this->Model_edit_live->get_live_survey('name', $id); ?></h3>
						</div> 
						<div class="content">
							<form id="liveSurvey-form" class="form-horizontal margin-reset" method="post" action = "<?php echo base_url();?>admin/Edit_live/edit_liveSurvey">
								<div class="row pad20">
                                    <div class="col-xs-2"></div>
									<div class="col-xs-1">
									   Title:
									</div>
									<div class="col-xs-5">
										<input type="text" name="title" class="form-control" value="<?php echo $this->Model_edit_live->get_live_survey('title', $id); ?>" />
										<p class="help-block">Hint: The title for the survey</p>
									</div>
								</div>
								<div class="separator"></div>
								<div class="row pad20">
                                <div class="col-xs-2"></div>
									<div class="col-xs-1">
									   Heading:
									</div>
									<div class="col-xs-5">
										<input type="text" name="heading" class="form-control" value="<?php echo $this->Model_edit_live->get_live_survey('heading', $id); ?>" />
										<p class="help-block">Hint: The heading</p>
									</div>
								</div>
								<div class="separator"></div>
								<div class="row pad20">
                                <div class="col-xs-2"></div>
									<div class="col-xs-1">
									   Sub Heading:
									</div>
									<div class="col-xs-5">
										<input type="text" name="sub-heading" class="form-control" value="<?php echo $this->Model_edit_live->get_live_survey('sub_heading', $id); ?>" />
										<p class="help-block">Hint: The subheading</p>
									</div>
								</div>
								<div class="separator"></div>
								<div class="row pad20">
                                <div class="col-xs-2"></div>
									<div class="col-xs-1">
										Intro:
									</div>
									<div class="col-xs-5">
										<input type="text" name="intro" class="form-control" value="<?php echo $this->Model_edit_live->get_live_survey('intro', $id); ?>" />
										<p class="help-block">Hint: The introductory text for the survey</p>
									</div>
								</div>
								<div class="separator"></div>
								<div class="row pad20">
                                <div class="col-xs-2"></div>
									<div class="col-xs-1">
									   Description:
									</div>
									<div class="col-xs-5">
										<input type="text" name="description" class="form-control" value="<?php echo $this->Model_edit_live->get_live_survey('description', $id); ?>" />
										<p class="help-block">Hint: The description of the survey</p>
									</div>
								</div>
								<div class="separator"></div>
								<div class="row pad20">
                                <div class="col-xs-2"></div>
									<div class="col-xs-1">
									   Note:
									</div>
									<div class="col-xs-5">
										<input type="text" name="note" class="form-control" value="<?php echo $this->Model_edit_live->get_live_survey('note', $id); ?>" />
										<p class="help-block">Hint: Some note to the survey</p>
									</div>
								</div>
								<div class="separator"></div>
								<div class="row pad20">
                                <div class="col-xs-2"></div>
									<div class="col-xs-1">
									   Footer:
									</div>
									<div class="col-xs-5">
										<input type="text" name="footer" class="form-control" value="<?php echo $this->Model_edit_live->get_live_survey('footer', $id); ?>" />
										<p class="help-block">Hint: Custom footer</p>
									</div>
								</div>
								<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
								<div class="form-actions">
									<div class="float-end pad20">
                                    <div class="col-xs-2"></div>
										<button type="submit" name="save-live-changes" data-option="save-live-changes" class="btn btn-success">Save Changes</button>
									</div>
								</div>
							</form>
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