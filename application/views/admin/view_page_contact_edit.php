<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().'admin');
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Edit Contact Page</h1>
    </div>
    <div class="content-header-right">
        <a href="<?php echo base_url(); ?>admin/page-contact" class="btn btn-primary btn-sm">View All</a>
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

            <?php echo form_open_multipart(base_url().'admin/page-contact/edit/'.$page_contact['id'], array('class' => 'form-horizontal'));?>
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Contact Heading </label>
                            <div class="col-sm-9">
                                <input type="text" autocomplete="off" class="form-control" name="contact_heading" value="<?php echo $page_contact['contact_heading']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Contact Address </label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="contact_address" style="height:60px;"><?php echo $page_contact['contact_address']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Contact Email </label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="contact_email" style="height:60px;"><?php echo $page_contact['contact_email']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Contact Phone </label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="contact_phone" style="height:60px;"><?php echo $page_contact['contact_phone']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Contact Map (iframe Code) </label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="contact_map" style="height:120px;"><?php echo $page_contact['contact_map']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Meta Title </label>
                            <div class="col-sm-9">
                                <input type="text" autocomplete="off" class="form-control" name="mt_contact" value="<?php echo $page_contact['mt_contact']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Meta Keyword </label>
                            <div class="col-sm-9">
                               <textarea class="form-control h_100" name="mk_contact"><?php echo $page_contact['mk_contact']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Meta Description </label>
                            <div class="col-sm-9">
                               <textarea class="form-control h_100" name="md_contact"><?php echo $page_contact['md_contact']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Language </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="" value="<?php echo $page_contact['lang_name']; ?>" disabled>
                            </div>
                        </div>
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