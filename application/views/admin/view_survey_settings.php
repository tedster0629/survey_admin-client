<!-- MAIN -->
<div id="main">

    <!-- container -->
    <div class=" bg">

        <!-- row -->
        <div class="row">

            <div class="col-md-12 pe-0"><!-- col-md-9 -->
                <div class="content-header">
                    <h1 color = "#4172a5!important">Settings</h1>
                </div>

                <!-- MAIN CONTENT -->
                <div id="main-content" style = "padding : 15px">

                    <div class="notice_messages"></div>
                    <div class="box box-info" >
                    <form id="settings" method="post" style = "padding : 30px" action = "<?php echo base_url();?>admin/survey_settings/updateSettings">

                        <div class="row">
                            <div class="col-xs-3">
                                <label style = "margin-top : 8px" class="control-label pull-right">Survey success notice:</label>
                            </div>
                            <div class="col-xs-7">
                                <input type="text" name="succes_notice" class="form-control" value="<?php echo $setting1; ?>" />
                                <p class="help-block">Hint: Custom message to show to users when a survey is submitted.</p>
                            </div>
                        </div>


                        <div class="row" style = "padding-top: 10px">
                            <div class="col-xs-3">
                                <label style = "margin-top : 8px" class="control-label pull-right">Took survey notice:</label>
                            </div>
                            <div class="col-xs-7">
                                <input type="text" name="took_survey" class="form-control" value="<?php echo $setting2; ?>" />
                                <p class="help-block">Hint: Custom message to show to users when a survey is already submitted by the user.</p>
                            </div>
                        </div>


                        <div class="row" style = "padding-top: 10px">
                            <div class="col-xs-3">
                                <label style = "margin-top : 8px" class="control-label pull-right">Took page notice:</label>
                            </div>
                            <div class="col-xs-7">
                                <input type="text" name="took_page" class="form-control" value="<?php echo $setting3; ?>" />
                                <p class="help-block">Hint: Custom message to show to users when a page of the survey is already submitted by the user.</p>
                            </div>
                        </div>


                        <div class="row" style = "padding-top: 10px">
                            <div class="col-xs-3">
                                <label style = "margin-top : 8px" class="control-label pull-right">Next text button:</label>
                            </div>
                            <div class="col-xs-7">
                                <input type="text" name="next_button" class="form-control" value="<?php echo $setting4; ?>" />
                                <p class="help-block">Hint: Custom text for the next button.</p>
                            </div>
                        </div>

							
						<div class="row" style = "padding-top: 10px">
							<div class="col-xs-3">
								<label style = "margin-top : 8px" class="control-label pull-right">Submit text button:</label>
							</div>
							<div class="col-xs-7">
								<input type="text" name="submit_button" class="form-control" value="<?php echo $setting5; ?>" />
								<p class="help-block">Hint: Custom text for the submit button.</p>
							</div>
						</div>


						<div class="row" style = "padding-top: 10px">
							<div class="col-xs-3">
								<label style = "margin-top : 8px" class="control-label pull-right">Multiply Choices Hint:</label>
							</div>
							<div class="col-xs-7">
								<input type="text" name="choices_hint" class="form-control" value="<?php echo $setting6; ?>" />
								<p class="help-block">Hint: Custom hint message for multiply choices questions.</p>
							</div>
						</div>


						<div class="row" style = "padding-top: 10px">
							<div class="col-xs-3">
								<label  style = "margin-top : 8px" class="control-label pull-right">Questions per page:</label>
							</div>
							<div class="col-xs-7">
								<select name="per_page" class="form-control">
									<?php 
									$per_pagex = $setting7;
									for($xz = 2; $xz <= 10; $xz++) 
									{ 
										if($xz == $per_pagex)
										{
											echo '<option selected value="'.$xz.'">'.$xz.'</option>';	
										} else {
											echo '<option value="'.$xz.'">'.$xz.'</option>';		
										}
									}
									?>
								</select>
							</div>
						</div>


						<div class="row form-actions mb-3" style = "padding-top: 15px">
                            <div class="col-xs-3"></div>
							<div class="col-xs-8 text-left">
								<button type="submit" data-option="save-settings" class="btn btn-primary">Save changes</button>
							</div>
						</div>
                    </form>
                </div>