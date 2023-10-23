<!--Banner Start-->
<div class="banner-slider" style="background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo $setting['banner_contact']; ?>)">
    <div class="bg"></div>
    <div class="bannder-table">
        <div class="banner-text">
            <h1><?php echo $page_contact['contact_heading']; ?></h1>
        </div>
    </div>
</div>
<!--Banner End-->

<!--Contact Start-->
<div class="contact-area pt_60 pb_90">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="contact-item flex">
                    <div class="contact-icon">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                    </div>
                    <div class="contact-text">
                        <h4><?php echo ADDRESS; ?></h4>
                        <p>
                            <?php echo nl2br($page_contact['contact_address']); ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="contact-item flex">
                    <div class="contact-icon">
                        <i class="fa fa-mobile" aria-hidden="true"></i>
                    </div>
                    <div class="contact-text">
                        <h4><?php echo PHONE_NUMBER; ?></h4>
                        <p>
                            <?php echo nl2br($page_contact['contact_phone']); ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="contact-item flex">
                    <div class="contact-icon">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    </div>
                    <div class="contact-text">
                        <h4><?php echo EMAIL_ADDRESS; ?></h4>
                        <p>
                            <?php echo nl2br($page_contact['contact_email']); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="contact-form headstyle pt_90">
                    <h4><?php echo CONTACT_FORM; ?></h4>
                    <?php echo form_open(base_url().'contact/send_email',array('class' => '')); ?>
                        <div class="form-row row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" placeholder="<?php echo NAME; ?>" name="name">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" placeholder="<?php echo PHONE_NUMBER; ?>" name="phone">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control" placeholder="<?php echo EMAIL_ADDRESS; ?>" name="email">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" placeholder="<?php echo SUBJECT; ?>" name="subject">
                            </div>
                            <div class="form-group col-12">
                                <textarea class="form-control" placeholder="<?php echo MESSAGE; ?>" name="message"></textarea>
                            </div>

                            <?php if($check_captcha['captcha_contact'] == 'Show'): ?>
                            <div class="form-group col-12">
                                <?php
                                $CI =& get_instance();
                                $CI->load->model('Model_contact');
                                $r_serial = mt_rand(1, $total_captcha);
                                $captcha_one = $CI->Model_contact->get_particular_captcha($r_serial);
                                ?>
                                <div class="captcha-section-1">
                                    <?php echo $captcha_one['captcha_value1'].' '.$captcha_one['captcha_symbol'].' '.$captcha_one['captcha_value2'].' = ' ?>
                                </div>
                                <div class="captcha-section-2">
                                    <input type="hidden" name="r_serial" value="<?php echo $r_serial; ?>">
                                    <input type="text" class="form-control w-60" name="captcha_input">
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="form-group col-12">
                                <button type="submit" class="btn" name="form_contact"><?php echo SEND_MESSAGE; ?></button>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Contact End-->

<!--Map Start-->
<div class="map-area">
    <?php echo $page_contact['contact_map']; ?>
</div>
<!--Map End-->