<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().'admin');
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>View Footer Setting Items</h1>
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
                                <th>SL</th>
                                <th>Language</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            foreach ($footer_setting as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['lang_name']; ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>admin/footer-setting/edit/<?php echo $row['id']; ?>" class="btn btn-primary btn-xs">Edit</a>
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


<section class="content-header">
    <div class="content-header-left">
        <h1>View Footer Setting Items (Language Independent)</h1>
    </div>
</section>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info" style="padding-top:0;">
                <div class="box-body" style="padding-top:0;">


                    <h3 class="sec_title">General Section</h3>
                    <?php echo form_open_multipart(base_url().'admin/footer-setting/update',array('class' => 'form-horizontal')); ?>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Number of Recent News</label>
                        <div class="col-sm-6">
                            <input type="text" name="footer_recent_news_item" class="form-control" value="<?php echo $footer_setting_lang_independent['footer_recent_news_item']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Number of Recent Portfolios</label>
                        <div class="col-sm-6">
                            <input type="text" name="footer_recent_portfolio_item" class="form-control" value="<?php echo $footer_setting_lang_independent['footer_recent_portfolio_item']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2"></label>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-success pull-left" name="form_footer_general">Update</button>
                        </select>
                        </div>
                    </div>
                    <?php echo form_close(); ?>


                    <h3 class="sec_title">Call to Action (CTA) Background</h3>
                    <?php echo form_open_multipart(base_url().'admin/footer-setting/update',array('class' => 'form-horizontal')); ?>
                        <input type="hidden" name="previous_photo" value="<?php echo $footer_setting_lang_independent['cta_background']; ?>">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Existing Background</label>
                            <div class="col-sm-6" style="padding-top:6px;">
                                <img src="<?php echo base_url(); ?>public/uploads/<?php echo $footer_setting_lang_independent['cta_background']; ?>" class="existing-photo" style="height:180px;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Change Background</label>
                            <div class="col-sm-6" style="padding-top:5px;">
                                <input type="file" name="cta_background">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form_footer_cta_bg">Update</button>
                            </select>
                            </div>
                        </div>
                    <?php echo form_close(); ?>


                </div>
            </div>
        </div>
    </div>
</section>