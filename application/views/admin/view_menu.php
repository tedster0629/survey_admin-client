<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().'admin');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Menu</h1>
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
			<?php echo form_open_multipart(base_url().'admin/menu',array('class' => 'form-horizontal')); ?>
				<div class="box box-info">
					<div class="box-body">
						<?php
						foreach($all_menus as $row)
						{
							?>
							<input type="hidden" name="menu_id[]" value="<?php echo $row['menu_id']; ?>">
							<div class="form-group">
								<label for="" class="col-sm-2 control-label"><?php echo $row['menu_name']; ?> </label>
								<div class="col-sm-2">
									<select name="menu_status[]" class="form-control select2">
										<option value="Show" <?php if($row['menu_status'] == 'Show') {echo 'selected';} ?>>Show</option>
										<option value="Hide" <?php if($row['menu_status'] == 'Hide') {echo 'selected';} ?>>Hide</option>
									</select>
								</div>
							</div>
							<?php
						}
						?>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
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