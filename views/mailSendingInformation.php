<?php
include 'header.php';
include '../producthandler/mailAndMessageHandler.php';
if ($_SESSION['user_id'] == '') {
    ?>
    <script>
        setTimeout(function () {
            $('.Login').click();
        }, 500);</script>

    <?php
} else {
?> 
<div class="section_offset counter" style="padding: 0px;">
    <div class="container">
        <div class="section_offset wpb_row vc_row-fluid sds_paralax_style_757222">
            <div class="container">
                <div class="row col-lg-6 col-md-6 col-sm-6 w_xs_full m_xs_bottom_10 col-md-push-6">
                    <div class="vc_col-sm-12 wpb_column vc_column_container ">
                        <div class="wpb_wrapper">
                            <div class="vc_row wpb_row vc_inner vc_row-fluid">
                                <div class="vc_col-sm-6 wpb_column vc_column_container ">
                                    <div class="wpb_wrapper">

                                    </div> 
                                </div> 

                                <div class="vc_col-sm-6 wpb_column vc_column_container ">
                                    <div class="wpb_wrapper">
                                        <div class="wpcf7" id="wpcf7-f884-p855-o1" lang="en-US" dir="ltr">
                                            <div class="screen-reader-response"></div>
                                            <form  method="post" class="wpcf7-form" novalidate="novalidate">
                                                <div style="display: none;">
                                                    <input type="hidden" name="_wpcf7" value="884">
                                                    <input type="hidden" name="_wpcf7_version" value="4.1.1">
                                                    <input type="hidden" name="_wpcf7_locale" value="en_US">
                                                    <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f884-p855-o1">
                                                    <input type="hidden" name="_wpnonce" value="8bdc3f61ed">
                                                </div>
                                                <ul class="clearfix">
                                                    <li class="row m_bottom_10">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 w_xs_full m_xs_bottom_10">
                                                            <span class="wpcf7-form-control-wrap your-name"><input type="text" name="name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required w_full r_corners fw_light" aria-required="true" aria-invalid="false" placeholder="Name*"></span>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 w_xs_full">
                                                            <span class="wpcf7-form-control-wrap your-email"><input type="email" name="email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email w_full r_corners fw_light" aria-required="true" aria-invalid="false" placeholder="Email*"></span>
                                                        </div>
                                                    </li>
                                                    <li class="m_bottom_10">
                                                        <span class="wpcf7-form-control-wrap your-subject"><input type="text" name="subject" value="" size="40" class="wpcf7-form-control wpcf7-text w_full r_corners fw_light" aria-invalid="false" placeholder="Subject"></span>
                                                    </li>
                                                    <li class="m_bottom_5">
                                                        <span class="wpcf7-form-control-wrap your-message"><textarea name="message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea w_full r_corners fw_light height_3" aria-invalid="false" placeholder="Message"></textarea></span>
                                                    </li>
                                                    <li class="m_bottom_5 col-md-3 col-sm-6 col-xs-6">
                                                        <input name="submit" type="submit" value="Submit" class="wpcf7-form-control wpcf7-submit button_type_5 color_blue transparent r_corners fs_medium tr_all m_right_10 m_sm_bottom_5"><img class="ajax-loader" src="http://demo.shopinmycity.com/dummy/wp-content/plugins/contact-form-7/images/ajax-loader.gif" alt="Sending ..." style="visibility: hidden;">
                                                    </li>
                                                </ul>
                                                <div class="wpcf7-response-output wpcf7-display-none"></div></form></div>
                                    </div> 
                                </div> 
                            </div>
                        </div> 
                    </div> 
                </div>  
            </div>
        </div>
    </div>
</div>
    
<?php
if (isset($_POST['submit'])) {
    $mailObj = new MailAndMessageHandler();
    $mailObj->mail_sending_information($_POST);
}
}
include 'footer.php';
?>
