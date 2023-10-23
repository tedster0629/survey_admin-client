<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().'admin');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>View Files</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url(); ?>admin/file/add" class="btn btn-primary btn-sm">Add File</a>
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
	        
			<div class="box box-info">
				<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="30">SL</th>
								<th>Preview</th>
								<th>File Title</th>
								<th>Copy File</th>
								<th width="120">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=0;							
							foreach ($file as $row) {
								$i++;
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td style="width:180px;">
										<?php
										// Check if it is image
										$exp = explode('.',$row['file_name']);
										?>
										<?php if( $exp[1] == 'jpg' || $exp[1] == 'JPG' || $exp[1] == 'jpeg' || $exp[1] == 'jpeg' || $exp[1] == 'png' || $exp[1] == 'PNG' || $exp[1] == 'gif' || $exp[1] == 'GIF' ): ?>

											<img src="<?php echo base_url(); ?>public/uploads/<?php echo $row['file_name']; ?>" alt="<?php echo $row['file_title']; ?>" style="width:120px;">

										<?php elseif( $exp[1] == 'pdf' || $exp[1] == 'PDF' ): ?>

											<img src="<?php echo base_url(); ?>public/admin/img/pdf.png" alt="<?php echo $row['file_title']; ?>" style="width:100px;">

										<?php elseif( $exp[1] == 'doc' || $exp[1] == 'DOC' || $exp[1] == 'docx' || $exp[1] == 'DOCX' ): ?>

											<img src="<?php echo base_url(); ?>public/admin/img/docx.png" alt="<?php echo $row['file_title']; ?>" style="width:100px;">

										<?php elseif( $exp[1] == 'xls' || $exp[1] == 'XLS' || $exp[1] == 'xlsx' || $exp[1] == 'XLSX' ): ?>

											<img src="<?php echo base_url(); ?>public/admin/img/xlsx.png" alt="<?php echo $row['file_title']; ?>" style="width:100px;">

										<?php elseif( $exp[1] == 'csv' || $exp[1] == 'CSV' ): ?>

											<img src="<?php echo base_url(); ?>public/admin/img/csv.png" alt="<?php echo $row['file_title']; ?>" style="width:100px;">	

										<?php endif; ?>
									</td>
									<td><?php echo $row['file_title']; ?></td>
									<td>
										<a href="<?php echo base_url().'public/uploads/'.$row['file_name']; ?>">Copy This</a>
									</td>
									<td>										
										<a href="<?php echo base_url(); ?>admin/file/edit/<?php echo $row['file_id']; ?>" class="btn btn-primary btn-xs">Edit</a>
										<a href="<?php echo base_url(); ?>admin/file/delete/<?php echo $row['file_id']; ?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure?');">Delete</a>
									</td>
								</tr>
								<?php
							}
							?>							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


</section>