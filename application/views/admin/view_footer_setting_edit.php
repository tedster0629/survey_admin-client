<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().'admin');
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Edit Footer Setting</h1>
    </div>
    <div class="content-header-right">
        <a href="<?php echo base_url(); ?>admin/footer-setting" class="btn btn-primary btn-sm">View All</a>
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

            <?php echo form_open_multipart(base_url().'admin/footer-setting/edit/'.$footer_setting['id'], array('class' => 'form-horizontal'));?>
                <div class="box box-info" style="padding:0">
                    <div class="box-body" style="padding-top:0">

                        <h3 class="sec_title">General Section</h3>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Copyright Text </label>
                            <div class="col-sm-9">
                                <input type="text" autocomplete="off" class="form-control" name="footer_copyright" value="<?php echo $footer_setting['footer_copyright']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Address </label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="footer_address" style="height:70px;"><?php echo $footer_setting['footer_address']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Email </label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="footer_email" style="height:70px;"><?php echo $footer_setting['footer_email']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Phone </label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="footer_phone" style="height:70px;"><?php echo $footer_setting['footer_phone']; ?></textarea>
                            </div>
                        </div>

                        <h3 class="sec_title">Newsletter Section</h3>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Newsletter Text </label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="newsletter_text" style="height:70px;"><?php echo $footer_setting['newsletter_text']; ?></textarea>
                            </div>
                        </div>

                        <h3 class="sec_title">Call to Action (CTA) Section</h3>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Text </label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="cta_text" style="height:70px;"><?php echo $footer_setting['cta_text']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Button Text </label>
                            <div class="col-sm-9">
                                <input type="text" autocomplete="off" class="form-control" name="cta_button_text" value="<?php echo $footer_setting['cta_button_text']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Button URL </label>
                            <div class="col-sm-9">
                                <input type="text" autocomplete="off" class="form-control" name="cta_button_url" value="<?php echo $footer_setting['cta_button_url']; ?>">
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