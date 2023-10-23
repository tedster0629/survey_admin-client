<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().'admin');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Settings Section</h1>
	</div>
</section>

<section class="content" style="min-height:auto;margin-bottom: -30px;">
	<div class="row">
		<div class="col-md-12">
			<?php
	        if($this->session->flashdata('error')) {
	            ?>
				<div class="callout callout-danger">
					<p><?php echo $this->session->flashdata('error'); ?></p>
				</div>
	            <?php
	        }
	        if($this->session->flashdata('success')) {
	            ?>
				<div class="callout callout-success">
					<p><?php echo $this->session->flashdata('success'); ?></p>
				</div>
	            <?php
	        }
	        ?>

		</div>
	</div>
</section>

<section class="content">

	<div class="row">
		<div class="col-md-12">
							
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_logo" data-toggle="tab">Logo</a></li>
						<li><a href="#tab_favicon" data-toggle="tab">Favicon</a></li>
						<li><a href="#tab_top_bar" data-toggle="tab">Top Bar</a></li>
						<li><a href="#tab_email" data-toggle="tab">Email</a></li>
						<li><a href="#tab_banner" data-toggle="tab">Banner</a></li>
						<li><a href="#tab_sidebar" data-toggle="tab">Sidebar</a></li>
                        <li><a href="#tab_color" data-toggle="tab">Color</a></li>
                        <li><a href="#tab_language" data-toggle="tab">Language</a></li>
                        <li><a href="#tab_other" data-toggle="tab">Other</a></li>
					</ul>

					<div class="tab-content">

          				<div class="tab-pane active" id="tab_logo">
          					<?php echo form_open_multipart(base_url().'admin/setting/update',array('class' => 'form-horizontal')); ?>
          					<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
							            <label for="" class="col-sm-2 control-label">Existing Photo</label>
							            <div class="col-sm-6" style="padding-top:6px;">
							                <img src="<?php echo base_url(); ?>public/uploads/<?php echo $setting['logo']; ?>" class="existing-photo" style="height:80px;">
							            </div>
							        </div>
									<div class="form-group">
							            <label for="" class="col-sm-2 control-label">New Photo</label>
							            <div class="col-sm-6" style="padding-top:6px;">
							                <input type="file" name="photo_logo">
							            </div>
							        </div>
							        <div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form_logo">Update Logo</button>
										</div>
									</div>
								</div>
							</div>
							<?php echo form_close(); ?>
          				</div>


          				<div class="tab-pane" id="tab_favicon">

          					<?php echo form_open_multipart(base_url().'admin/setting/update',array('class' => 'form-horizontal')); ?>
							<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
							            <label for="" class="col-sm-2 control-label">Existing Photo</label>
							            <div class="col-sm-6" style="padding-top:6px;">
							                <img src="<?php echo base_url(); ?>public/uploads/<?php echo $setting['favicon']; ?>" class="existing-photo" style="height:40px;">
							            </div>
							        </div>
									<div class="form-group">
							            <label for="" class="col-sm-2 control-label">New Photo</label>
							            <div class="col-sm-6" style="padding-top:6px;">
							                <input type="file" name="photo_favicon">
							            </div>
							        </div>
							        <div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form_favicon">Update Favicon</button>
										</div>
									</div>
								</div>
							</div>
							<?php echo form_close(); ?>
          				</div>


          				<div class="tab-pane" id="tab_top_bar">
							<?php echo form_open(base_url().'admin/setting/update',array('class' => 'form-horizontal')); ?>
							<div class="box box-info">
								<div class="box-body">									
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Top Bar Email </label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="top_bar_email" value="<?php echo $setting['top_bar_email']; ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Top Bar Phone Number </label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="top_bar_phone" value="<?php echo $setting['top_bar_phone']; ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form_top_bar">Update</button>
										</div>
									</div>
								</div>
							</div>
							<?php echo form_close(); ?>
          				</div>



          				<div class="tab-pane" id="tab_email">
          					<?php echo form_open(base_url().'admin/setting/update',array('class' => 'form-horizontal')); ?>
							<div class="box box-info">
								<div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Send Email From *</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="send_email_from" maxlength="255" autocomplete="off" value="<?php echo $setting['send_email_from']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Receive Email To *</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="receive_email_to" maxlength="255" autocomplete="off" value="<?php echo $setting['receive_email_to']; ?>">
                                        </div>
                                    </div>
				                    <div class="form-group">
				                        <label for="" class="col-sm-3 control-label">SMTP Host </label>
				                        <div class="col-sm-4">
				                            <input type="text" class="form-control" name="smtp_host" maxlength="255" autocomplete="off" value="<?php echo $setting['smtp_host']; ?>">
				                        </div>
				                    </div>
				                    <div class="form-group">
				                        <label for="" class="col-sm-3 control-label">SMTP Port </label>
				                        <div class="col-sm-4">
				                            <input type="text" class="form-control" name="smtp_port" maxlength="255" autocomplete="off" value="<?php echo $setting['smtp_port']; ?>">
				                        </div>
				                    </div>
				                    <div class="form-group">
				                        <label for="" class="col-sm-3 control-label">SMTP Username </label>
				                        <div class="col-sm-4">
				                            <input type="text" class="form-control" name="smtp_username" maxlength="255" autocomplete="off" value="<?php echo $setting['smtp_username']; ?>">
				                        </div>
				                    </div>
				                    <div class="form-group">
				                        <label for="" class="col-sm-3 control-label">SMTP Password </label>
				                        <div class="col-sm-4">
				                            <input type="text" class="form-control" name="smtp_password" maxlength="255" autocomplete="off" value="<?php echo $setting['smtp_password']; ?>">
				                        </div>
				                    </div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form_email">Update</button>
										</div>
									</div>
								</div>
							</div>
							<?php echo form_close(); ?>
          				</div>



          				<div class="tab-pane" id="tab_banner">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered">                                
                                        <tr>
                                            <?php echo form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:50%">
                                                <h4>About Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.$setting['banner_about']; ?>" alt="" style="width: 100%;height:auto;">
                                                </p>                                        
                                            </td>
                                            <td style="width:50%">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_about">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        
                                        <tr>
                                            <?php echo form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:50%">
                                                <h4>Testimonial Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.$setting['banner_testimonial']; ?>" alt="" style="width: 100%;height:auto;">  
                                                </p>                                        
                                            </td>
                                            <td style="width:50%">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_testimonial">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        <tr>
                                            <?php echo form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:50%">
                                                <h4>News Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.$setting['banner_news']; ?>" alt="" style="width: 100%;height:auto;">  
                                                </p>                                        
                                            </td>
                                            <td style="width:50%">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_news">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        <tr>
                                            <?php echo form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:50%">
                                                <h4>Event Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.$setting['banner_event']; ?>" alt="" style="width: 100%;height:auto;">  
                                                </p>                                        
                                            </td>
                                            <td style="width:50%">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_event">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        <tr>
                                            <?php echo form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:50%">
                                                <h4>Contact Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.$setting['banner_contact']; ?>" alt="" style="width: 100%;height:auto;">  
                                                </p>                                        
                                            </td>
                                            <td style="width:50%">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_contact">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        <tr>
                                            <?php echo form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:50%">
                                                <h4>Search Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.$setting['banner_search']; ?>" alt="" style="width: 100%;height:auto;">  
                                                </p>                                        
                                            </td>
                                            <td style="width:50%">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_search">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        
                                        <tr>
                                            <?php echo form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:50%">
                                                <h4>Privacy Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.$setting['banner_privacy']; ?>" alt="" style="width: 100%;height:auto;">  
                                                </p>                                        
                                            </td>
                                            <td style="width:50%">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_privacy">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        <tr>
                                            <?php echo form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:50%">
                                                <h4>Verify Subscriber Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.$setting['banner_verify_subscriber']; ?>" alt="" style="width: 100%;height:auto;">  
                                                </p>                                        
                                            </td>
                                            <td style="width:50%">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_verify_subscriber">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">    
                                        <tr>
                                            <?php echo form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:50%">
                                                <h4>FAQ Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.$setting['banner_faq']; ?>" alt="" style="width: 100%;height:auto;">  
                                                </p>                                        
                                            </td>
                                            <td style="width:50%">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_faq">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>

                                        <tr>
                                            <?php echo form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:50%">
                                                <h4>Service Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.$setting['banner_service']; ?>" alt="" style="width: 100%;height:auto;">  
                                                </p>                                        
                                            </td>
                                            <td style="width:50%">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_service">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        
                                        <tr>
                                            <?php echo form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:50%">
                                                <h4>Portfolio Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.$setting['banner_portfolio']; ?>" alt="" style="width: 100%;height:auto;">  
                                                </p>                                        
                                            </td>
                                            <td style="width:50%">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_portfolio">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        <tr>
                                            <?php echo form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:50%">
                                                <h4>Team Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.$setting['banner_team']; ?>" alt="" style="width: 100%;height:auto;">  
                                                </p>                                        
                                            </td>
                                            <td style="width:50%">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_team">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        <tr>
                                            <?php echo form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:50%">
                                                <h4>Pricing Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.$setting['banner_pricing']; ?>" alt="" style="width: 100%;height:auto;">  
                                                </p>                                        
                                            </td>
                                            <td style="width:50%">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_pricing">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        <tr>
                                            <?php echo form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:50%">
                                                <h4>Photo Gallery Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.$setting['banner_photo_gallery']; ?>" alt="" style="width: 100%;height:auto;">  
                                                </p>                                        
                                            </td>
                                            <td style="width:50%">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_photo_gallery">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        <tr>
                                            <?php echo form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:50%">
                                                <h4>Terms Page</h4>
                                                <p>
                                                    <img src="<?php echo base_url().'public/uploads/'.$setting['banner_terms']; ?>" alt="" style="width: 100%;height:auto;">  
                                                </p>                                        
                                            </td>
                                            <td style="width:50%">
                                                <h4>Change Banner</h4>
                                                Select Photo<input type="file" name="photo">
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_terms">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        
                                    </table>
                                </div>
                            </div>
          				</div>



          				<div class="tab-pane" id="tab_sidebar">
          					<?php echo form_open(base_url().'admin/setting/update',array('class' => 'form-horizontal')); ?>
							<div class="box box-info">
								<div class="box-body">                                    
                                    <h3 class="sec_title" style="margin-top:0;">News Page - Sidebar Section</h3>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Total Recent Posts *</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="sidebar_total_recent_post" maxlength="255" autocomplete="off" value="<?php echo $setting['sidebar_total_recent_post']; ?>">
                                        </div>
                                    </div>

                                    <h3 class="sec_title">Event Page - Sidebar Section</h3>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Total Upcoming Events *</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="sidebar_total_upcoming_event" maxlength="255" autocomplete="off" value="<?php echo $setting['sidebar_total_upcoming_event']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Total Past Events *</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="sidebar_total_past_event" maxlength="255" autocomplete="off" value="<?php echo $setting['sidebar_total_past_event']; ?>">
                                        </div>
                                    </div>
                                   
									<div class="form-group">
										<label for="" class="col-sm-3 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form_sidebar">Update</button>
										</div>
									</div>
								</div>
							</div>
							<?php echo form_close(); ?>
          				</div>


                        
                        <div class="tab-pane" id="tab_color">
                            <?php echo form_open(base_url().'admin/setting/update',array('class' => 'form-horizontal')); ?>
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Color </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="front_end_color" class="form-control jscolor" value="<?php echo $setting['front_end_color']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form_color">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>



                        <div class="tab-pane" id="tab_language">
                            <?php echo form_open(base_url().'admin/setting/update',array('class' => 'form-horizontal')); ?>
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Language Option? </label>
                                        <div class="col-sm-3">
                                            <select name="language_status" class="form-control select2">
                                            	<option value="Show" <?php if($setting['language_status'] == 'Show') {echo 'selected';} ?>>Show</option>
                                            	<option value="Hide" <?php if($setting['language_status'] == 'Hide') {echo 'selected';} ?>>Hide</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form_language">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>





                        <div class="tab-pane" id="tab_other">
                            <?php echo form_open(base_url().'admin/setting/update',array('class' => 'form-horizontal')); ?>
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Website Name </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="website_name" class="form-control" value="<?php echo $setting['website_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Preloader Status </label>
                                        <div class="col-sm-4">
                                            <select name="preloader_status" class="form-control select2">
                                            	<option value="On" <?php if($setting['preloader_status'] == 'On') {echo 'selected';} ?>>On</option>
                                            	<option value="Off" <?php if($setting['preloader_status'] == 'Off') {echo 'selected';} ?>>Off</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Tawk Live Chat Code </label>
                                        <div class="col-sm-6">
                                        	<textarea name="tawk_live_chat_code" class="form-control" cols="30" rows="10"><?php echo $setting['tawk_live_chat_code']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Tawk Live Chat Status </label>
                                        <div class="col-sm-4">
                                            <select name="tawk_live_chat_status" class="form-control select2">
                                            	<option value="On" <?php if($setting['tawk_live_chat_status'] == 'On') {echo 'selected';} ?>>On</option>
                                            	<option value="Off" <?php if($setting['tawk_live_chat_status'] == 'Off') {echo 'selected';} ?>>Off</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form_other">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                        










          			</div>
				</div>

			
		</div>
	</div>

</section>