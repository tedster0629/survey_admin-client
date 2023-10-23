<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().'admin');
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Edit Dynamic Page</h1>
    </div>
    <div class="content-header-right">
        <a href="<?php echo base_url(); ?>admin/page-dynamic" class="btn btn-primary btn-sm">View All</a>
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

            <?php echo form_open_multipart(base_url().'admin/page-dynamic/edit/'.$page_dynamic['id'], array('class' => 'form-horizontal'));?>
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Name * </label>
                            <div class="col-sm-9">
                                <input type="text" autocomplete="off" class="form-control" name="name" value="<?php echo $page_dynamic['name']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Slug </label>
                            <div class="col-sm-9">
                                <input type="text" autocomplete="off" class="form-control" name="slug" value="<?php echo $page_dynamic['slug']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Content *</label>
                            <div class="col-sm-9">
                                <textarea class="form-control editor" name="content" style="height:140px;"><?php echo $page_dynamic['content']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Existing Banner</label>
                            <div class="col-sm-6">
                                <?php
                                if($page_dynamic['banner'] == '') {
                                    echo 'No photo found';
                                } else {
                                    ?><img src="<?php echo base_url(); ?>public/uploads/<?php echo $page_dynamic['banner']; ?>" alt="<?php echo $page_dynamic['name']; ?>" style="width:300px;"><?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Change Banner </label>
                            <div class="col-sm-9" style="margin-top:5px;">
                                <input type="file" name="banner">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Meta Title </label>
                            <div class="col-sm-9">
                                <input type="text" autocomplete="off" class="form-control" name="meta_title" value="<?php echo $page_dynamic['meta_title']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Meta Description </label>
                            <div class="col-sm-9">
                               <textarea class="form-control h_100" name="meta_description"><?php echo $page_dynamic['meta_description']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Language </label>
                            <div class="col-sm-2">
                                <select name="lang_id" class="form-control select2">
                                    <?php
                                    foreach($all_lang as $row)
                                    {
                                        ?><option value="<?php echo $row['lang_id']; ?>" <?php if($page_dynamic['lang_id'] == $row['lang_id']) {echo 'selected';} ?>><?php echo $row['lang_name']; ?></option><?php
                                    }
                                    ?>
                                </select>
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