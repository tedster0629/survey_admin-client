<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().'admin');
}
?>
<section class="content-header">
	<div class="content-header-left">
		<h1>Edit File</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url(); ?>admin/file" class="btn btn-primary btn-sm">View All</a>
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

			<?php echo form_open_multipart(base_url().'admin/file/edit/'.$file['file_id'],array('class' => 'form-horizontal')); ?>
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">File Title <span>*</span></label>
							<div class="col-sm-6">
								<input type="text" autocomplete="off" class="form-control" name="file_title" value="<?php echo $file['file_title']; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">File URL <span>*</span></label>
							<div class="col-sm-6" style="padding-top:6px;">
								<a href="<?php echo base_url().'public/uploads/'.$file['file_name']; ?>" target="_blank"><?php echo base_url().'public/uploads/'.$file['file_name']; ?></a>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Preview</label>
							<div class="col-sm-9" style="padding-top:5px">
								<?php
								// Check if it is image
								$exp = explode('.',$file['file_name']);
								?>
								<?php if( $exp[1] == 'jpg' || $exp[1] == 'JPG' || $exp[1] == 'jpeg' || $exp[1] == 'jpeg' || $exp[1] == 'png' || $exp[1] == 'PNG' || $exp[1] == 'gif' || $exp[1] == 'GIF' ): ?>

									<img src="<?php echo base_url(); ?>public/uploads/<?php echo $file['file_name']; ?>" alt="<?php echo $file['file_title']; ?>" style="width:120px;">

								<?php elseif( $exp[1] == 'pdf' || $exp[1] == 'PDF' ): ?>

									<img src="<?php echo base_url(); ?>public/admin/img/pdf.png" alt="<?php echo $file['file_title']; ?>" style="width:100px;">

								<?php elseif( $exp[1] == 'doc' || $exp[1] == 'DOC' || $exp[1] == 'docx' || $exp[1] == 'DOCX' ): ?>

									<img src="<?php echo base_url(); ?>public/admin/img/docx.png" alt="<?php echo $file['file_title']; ?>" style="width:100px;">

								<?php elseif( $exp[1] == 'xls' || $exp[1] == 'XLS' || $exp[1] == 'xlsx' || $exp[1] == 'XLSX' ): ?>

									<img src="<?php echo base_url(); ?>public/admin/img/xlsx.png" alt="<?php echo $file['file_title']; ?>" style="width:100px;">

								<?php elseif( $exp[1] == 'csv' || $exp[1] == 'CSV' ): ?>

									<img src="<?php echo base_url(); ?>public/admin/img/csv.png" alt="<?php echo $file['file_title']; ?>" style="width:100px;">	

								<?php endif; ?>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Photo </label>
							<div class="col-sm-6" style="padding-top:5px">
								<input type="file" name="file_name">(Only jpg, jpeg, gif, png, pdf, doc, docx, xls, xlsx, csv file types are allowed)
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
							</div>
						</div>
					</div>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>

</section>