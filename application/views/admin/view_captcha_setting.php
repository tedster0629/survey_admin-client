<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().'admin');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Captcha</h1>
	</div>
</section>

<section class="content">
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
			<?php echo form_open_multipart(base_url().'admin/captcha/setting',array('class' => 'form-horizontal')); ?>
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Captcha - Contact Page </label>
							<div class="col-sm-2">
								<select name="captcha_contact" class="form-control select2">
									<option value="Show" <?php if($captcha['captcha_contact'] == 'Show') {echo 'selected';} ?>>Show</option>
									<option value="Hide" <?php if($captcha['captcha_contact'] == 'Hide') {echo 'selected';} ?>>Hide</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Captcha - Service Detail Page </label>
							<div class="col-sm-2">
								<select name="captcha_service_detail" class="form-control select2">
									<option value="Show" <?php if($captcha['captcha_service_detail'] == 'Show') {echo 'selected';} ?>>Show</option>
									<option value="Hide" <?php if($captcha['captcha_service_detail'] == 'Hide') {echo 'selected';} ?>>Hide</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Captcha - Portfolio Detail Page </label>
							<div class="col-sm-2">
								<select name="captcha_portfolio_detail" class="form-control select2">
									<option value="Show" <?php if($captcha['captcha_portfolio_detail'] == 'Show') {echo 'selected';} ?>>Show</option>
									<option value="Hide" <?php if($captcha['captcha_portfolio_detail'] == 'Hide') {echo 'selected';} ?>>Hide</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form1">Update</button>
							</div>
						</div>
					</div>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>

</section>