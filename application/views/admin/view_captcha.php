<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().'admin');
}
?>

<?php if($this->session->flashdata('error')) : ?>
<section class="content min-height-auto"><div class="row"><div class="col-md-12">
<div class="callout callout-danger">
<p><?php echo $this->session->flashdata('error'); ?></p>
</div>
</div></div></section>
<?php endif; ?>

<?php if($this->session->flashdata('success')): ?>
<section class="content min-height-auto"><div class="row"><div class="col-md-12">
<div class="callout callout-success">
	<p><?php echo $this->session->flashdata('success'); ?></p>
</div>
</div></div></section>
<?php endif; ?>


<section class="content-header">
	<div class="content-header-left">
		<h1>Add Captcha</h1>
	</div>
</section>

<section class="content min-height-auto">
	<div class="row">
		<div class="col-md-12">
     		<?php echo form_open(base_url().'admin/captcha/add',array('class' => 'form-horizontal')); ?>
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<div class="col-sm-2">
                                <input type="text" class="form-control" name="captcha_value1">
                            </div>
                            <div class="col-sm-2">
                                <select name="captcha_symbol" class="form-control symbol">
                                    <option value="+">+</option>
                                    <option value="-">-</option>
                                    <option value="*">*</option>
                                    <option value="/">/</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="captcha_value2">
                            </div>
                            <div class="col-sm-1 equal text-center">
                                =
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="captcha_result">
                            </div>
						</div>
						<div class="form-group">
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

<section class="content-header">
	<div class="content-header-left">
		<h1>View Captcha</h1>
	</div>
</section>

<section class="content>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-striped">
			<thead>
			    <tr>
					<th>SL</th>
                    <th>Value 1</th>
                    <th>Symbol</th>
                    <th>Value 2</th>
                    <th>Result</th>
                    <th>Action</th>
			    </tr>
			</thead>
            <tbody>
	            <?php
	            	$i=0;
	            	foreach ($captcha as $row) {
	            		$i++;
		            	?>
			            <tr>
			                <td><?php echo $i; ?></td>
			                <td><?php echo $row['captcha_value1']; ?></td>
			                <td><?php echo $row['captcha_symbol']; ?></td>
							<td><?php echo $row['captcha_value2']; ?></td>
							<td><?php echo $row['captcha_result']; ?></td>
			                <td>
			                    <a href="<?php echo base_url(); ?>admin/captcha/delete/<?php echo $row['captcha_id']; ?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure?');">Delete</a> 
			                </td>
			            </tr>
			            <?php
	            	}
	            ?>
            </tbody>
          </table>
        </div>
      </div>
  

</section>