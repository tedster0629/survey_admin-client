<!--Banner Start-->
<div class="banner-slider" style="background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo $page_dynamic_detail['banner']; ?>)">
    <div class="bg"></div>
    <div class="bannder-table">
        <div class="banner-text">
            <h1><?php echo $page_dynamic_detail['name']; ?></h1>
        </div>
    </div>
</div>
<!--Banner End-->

<!--About Start-->
<div class="about-page pt_60 pb_30">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php echo $page_dynamic_detail['content']; ?>
            </div>
        </div>
    </div>
</div>
<!--About End-->