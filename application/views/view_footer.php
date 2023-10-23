    <?php
    $CI =& get_instance();
    $CI->load->model('Model_common');
    $footer_setting = $CI->Model_common->all_footer_setting();
    $footer_setting_lang_independent = $CI->Model_common->all_footer_setting_lang_independent();
    $all_setting = $CI->Model_common->all_setting();
    ?>
    <!--Call Start-->
    <div class="call-us" style="background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo $footer_setting_lang_independent['cta_background']; ?>)">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="call-text">
                        <h3><?php echo $footer_setting['cta_text']; ?></h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="button">
                        <a href="<?php echo $footer_setting['cta_button_url']; ?>"><?php echo $footer_setting['cta_button_text']; ?> <i class="fa fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Call End-->

    <!--Footer-Area Start-->
    <div class="footer-area pt_60 pb_90">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item" id="newsletter">
                        <h3><?php echo FOOTER_1_HEADING; ?></h3>
                        <p>
                            <?php echo nl2br($footer_setting['newsletter_text']); ?>
                        </p>
                        <?php echo form_open(base_url().'newsletter/send',array('class' => '')); ?>
                        <div class="input-group">                            
                            <input type="email" class="form-control" placeholder="<?php echo EMAIL_ADDRESS; ?>" name="email_subscribe">
                            <span class="input-group-btn">
                                <button class="btn" type="submit" name="form_subscribe"><i class="fa fa-location-arrow"></i></button>
                            </span>                            
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item footer-recent-post">
                        <h3><?php echo FOOTER_2_HEADING; ?></h3>
                        <ul>
                            <?php
                            $i=0;
                            foreach ($all_news as $news) {
                                $i++;
                                if($i > $footer_setting_lang_independent['footer_recent_news_item']) {
                                    break;
                                }
                                ?>
                                <li><a href="<?php echo base_url(); ?>news/view/<?php echo $news['news_id']; ?>"><?php echo $news['news_title']; ?></a></li>    
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h3><?php echo FOOTER_3_HEADING; ?></h3>
                        <div class="row pl-10 pr-10">                            
                            <?php
                            $i=0;
                            foreach($portfolio_footer as $row) {
                                $i++;
                                if($i > $footer_setting_lang_independent['footer_recent_portfolio_item']) {
                                    break;
                                }
                                ?>
                                <div class="col-4 footer-project">
                                    <a href="<?php echo base_url(); ?>portfolio/view/<?php echo $row['id']; ?>"><img src="<?php echo base_url(); ?>public/uploads/<?php echo $row['photo']; ?>" alt="Project Photo"></a>
                                </div>
                                <?php
                            }
                            ?>                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h3><?php echo FOOTER_4_HEADING; ?></h3>
                        <div class="footer-address-item">
                            <div class="icon"><i class="fa fa-map-marker"></i></div>
                            <div class="text">
                                <span>
                                    <?php echo nl2br($footer_setting['footer_address']); ?>
                                </span>
                            </div>
                        </div>
                        <div class="footer-address-item">
                            <div class="icon"><i class="fa fa-phone"></i></div>
                            <div class="text">
                                <span>
                                    <?php echo nl2br($footer_setting['footer_phone']); ?>
                                </span>
                            </div>
                        </div>
                        <div class="footer-address-item">
                            <div class="icon"><i class="fa fa-envelope-o"></i></div>
                            <div class="text">
                                <span>
                                    <?php echo nl2br($footer_setting['footer_email']); ?>
                                </span>
                            </div>
                        </div>
                        <ul class="footer-social">
                            <?php
                            foreach ($social as $row)
                            {
                                if($row['social_url']!='')
                                {
                                    echo '<li><a href="'.$row['social_url'].'"><i class="'.$row['social_icon'].'"></i></a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom pt_50 pb_50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-menu">
                        <ul>
                            <li><a href="<?php echo base_url(); ?>"><?php echo HOME; ?></a></li>
                            <li><a href="<?php echo base_url(); ?>terms-and-conditions"><?php echo TERMS_AND_CONDITIONS; ?></a></li>
                            <li><a href="<?php echo base_url(); ?>privacy-policy"><?php echo PRIVACY_POLICY; ?></a></li>
                        </ul>
                    </div>
                    <div class="copy-text">
                        <p>
                            <?php echo $footer_setting['footer_copyright']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Footer-Area End-->

    <!--Scroll-Top-->
    <div class="scroll-top">
        <i class="fa fa-angle-up"></i>
    </div>
    <!--Scroll-Top-->

   
    <script src="<?php echo base_url(); ?>public/js/custom.js"></script>
    
    <?php if($_SESSION['sess_layout_direction'] == 'Left'): ?>
    <script src="<?php echo base_url(); ?>public/js/ltr.js"></script>
    <?php endif; ?>

    <?php if($_SESSION['sess_layout_direction'] == 'Right'): ?>
    <script src="<?php echo base_url(); ?>public/js/rtl.js"></script>
    <?php endif; ?>

    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>

<script type="text/javascript">
    $(document).ready(function() {
    $("#uniValidation").submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Serialize the form data
        var formData = $(this).serialize();

        // Send the form data via jQuery post()
        $.post("submitSurvey?ids=<?php echo $ids[$i]?>", formData, function(response) {
        // Handle the response from the server
        if(response){
            alert('Thank you for taking the survey');
            location.reload(true);
        }
        else{
            alert('Please check your data');
        }
        });
    });

    	// Answers Update
	$(".form-actions").delegate('[data-option="update-answers"]', 'click', function(e) 
	{
		var serialize = $('form#answers').serialize();

		$.post('answers/update_answer', serialize, function(response) 
		{	
			alert('Successfully updated answer');
			if(response == true) 
			{
				alert('Successfully updated answer');
			} else if(response == 'TRIGGER_INFO') {
				alert('In order to update answer the fields cannot be empty');	
			} else {
				alert('Failed to update answer. Probably the answer is already updated');	
			}
		});
		e.preventDefault();

	});

	// Define object at the end to fix ie bug
	var answers = {};

    
		let inputs = document.querySelectorAll('input[data-filter]');

        for (let input of inputs) {
        let state = {
            value: input.value,
            start: input.selectionStart,
            end: input.selectionEnd,
            pattern: RegExp('^' + input.dataset.filter + '$')
        };

        input.addEventListener('input', event => {
            if (state.pattern.test(input.value)) {
            state.value = input.value;
            } else {
            input.value = state.value;
            input.setSelectionRange(state.start, state.end);
            }
        });

        input.addEventListener('keydown', event => {
            state.start = input.selectionStart;
            state.end = input.selectionEnd;
        });
        }

        $('#cstedit-addembossing').on('input', function() {

        let $this = $(this);

        let newVal = $this.val()
        .normalize('NFD').replace(/[\u0300-\u036f]/g, "")
        .replace(/[^0-9A-Za-z _]+/g, '');

        $this.val(newVal);

        })

});
</script>
    <?php
        if($this->session->flashdata('success')):
            echo '
            <script>
            toastr.success(\''.$this->session->flashdata('success').'\');
            </script>
            ';
        endif;
        if($this->session->flashdata('error')):
            echo '
            <script>
            toastr.error(\''.$this->session->flashdata('error').'\');
            </script>
            ';
        endif;
    ?>

    <?php
    if($all_setting['tawk_live_chat_status'] == 'On'):
        echo $all_setting['tawk_live_chat_code'];
    endif;
    ?>
</body>
</html>