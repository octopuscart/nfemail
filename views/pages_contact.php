<?php

include 'header.php';
$authobj = new AuthHandler();
$mailconf = $authobj->mail_configuration();

$baselink = 'http://' . $_SERVER['SERVER_NAME'];
$baselinkmain = strpos($baselink, '192.168') ? $baselink . '/nf3/gitfrontend' : $baselink . '/frontend';
$baseurl = $baselinkmain . '/';

if (isset($_POST['submitEnquiry'])) {
    if ($_POST['g-recaptcha-response']) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $address = $_POST['address'];
        $message = $_POST['message'];
        include '../phpPlugin/mailer/class.phpmailer.php';

        $messageto = $mailconf['username'];

        $mailtemplate = $template_header . '
            


 <table width="100%" border="0" style="padding: 5px; background-color: white;" cellspacing="0" cellpadding="0" align="center">
            <tbody>
                <tr>
                    <td>
                        <table style="    width: 100%;" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 38px  30px  30px  30px; background-color: #fafafa;">
                            <tbody>
                                <tr style="background-color: #FFF;">
                                    <td style="width:100%;    padding: 10px;">
                                    <center><img src="http://nitafashions.com/frontend/assets/images/logo/nf_logo_8.png" style="height: 100px;width:183px;"></center>
                                    </td>
                                    
                                </tr>
                                
                               
                               
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        

<table style="    width: 100%;" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 38px  30px  30px  30px; background-color: #fafafa;">
            <tbody>
                <tr>
                    <td colspan="3" height="10" style="border-bottom: 1px  solid  #eaedef;"></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <span style="
                              text-align: center;
                              width: 100%;
                              font-size: 24px;
                              float: left;
                              border-bottom: 1px solid #eaedef;
                              margin-bottom: 20px;
                              padding: 20px 0;
                              background-color: #000;
                              color: #fff;
                              font-weight: 300;                                
                              ">     ' . $subject . ' 
        </span>
</td>
</tr>
</tbody>
</table>



       
        <hr>
        <h4>' . $name . ',
             <br/>
            <p style="font-size:12px">'.$email.'<br/>'.$address.'</p></h4>
           
            <br/>
        
         ' . $message . "<hr><br/><b>End</b>" . $template_footer;

        $mail = new PHPMailer; // call the class  
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true;  // authentication enabled
//        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = $mailconf['host'];
        $mail->Port = $mailconf['port'];
        $mail->Username = $mailconf['username']; //Username for SMTP authentication any valid email created in your domain
        $mail->Password = $mailconf['password']; //Password for SMTP authentication
        $mail->AddReplyTo($email, 'Nita Fashions'); //reply-to address
        $mail->SetFrom($email, $name); //From address of the mail
// put your while loop here like below,
        $mail->Subject = $subject; //Subject od your mail
        $mail->AddCC($email);
        $mail->AddAddress($messageto, "");              // name is optional
//echo $welcomemsg;
        $mail->MsgHTML($mailtemplate); //Put your body of the message you can place html code here
        $send = $mail->Send(); //Send the mails
    }
}
?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<!--page title-->
<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="    padding: 0px 1px 8px 1px;background: black;">
    <div class="">
 
        <!-- breadcrumbs -->
        <ul class="hr_list d_inline_m breadcrumbs" style="margin-top: 10px;">
            <li class="m_right_8 f_xs_none" style="margin-right:0px !important">
                <a href="#" class="color_default d_inline_m m_right_10" style="margin-right:0px !important;color:white;">
                    <i class="icon-mail-alt"></i>&nbsp;&nbsp;Contact Us&nbsp;&nbsp;
                </a>
            </li>

        </ul>
    </div>
</section>
<!--content-->
<section class="section_offset">
    <div class="container clearfix">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_30">
                <h3 class="color_dark fw_light m_bottom_15 heading_1 t_align_c">Contact Information</h3>

                <p class="fw_light m_bottom_23">
                    World’s finest fabrics are carefully selected to live up to name of Nita Fashions. We carry over 11,000 fabrics: English flannels and worsted, Scottish tweeds and cashmere, French Gabardines and Italian and silk Mohairs.
                </p>
                <div class="row">
                    <ul class="col-lg-6 col-md-6 col-sm-6 fw_light w_break m_bottom_45 m_xs_bottom_30">
                        <li class="m_bottom_8">
                            <div class="d_inline_m icon_wrap_size_1 color_pink circle m_right_10">
                                <i class="icon-phone-1"></i>
                            </div>
                            + (852) 2721-9990
                        </li>
                        <li class="m_bottom_8">
                            <div class="d_inline_m icon_wrap_size_1 color_pink circle m_right_10">
                                <i class="icon-mail-alt"></i>
                            </div>
                            <a href="mailto:sales@nitafashions.com" class=" color_pink_hover" style="font-size: 18px;
                               color: rgb(122, 125, 127);">sales@nitafashions.com</a>
                        </li>

                    </ul>
                    <ul class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_30 vr_list_type_5">
                        <li class="m_bottom_8 fw_light">
                            <div class="f_left icon_wrap_size_1 color_pink circle">
                                <i class="icon-location"></i>
                            </div>
                            16 Mody Road, G/F, T.S.T, Kowloon, Hong Kong
                        </li>

                    </ul>
                </div>
                <h5 class="color_dark m_bottom_20 fw_light">Stay Connected</h5>
                <ul class="hr_list social_icons">
                    <!--tooltip_container class is required-->
                    <li class="m_right_15 m_bottom_15 tooltip_container">
                        <!--tooltip-->
                        <span class="d_block r_corners color_default tooltip fs_small tr_all">Follow Us on Facebook</span>
                        <a href="https://www.facebook.com/Nita-Fashions-224017321015214/" target="_blank" class="d_block facebook icon_wrap_size_2 circle color_grey_light_2">
                            <i class="icon-facebook fs_small"></i>
                        </a>
                    </li>
                    <li class="m_right_15 m_bottom_15 tooltip_container">
                        <!--tooltip-->
                        <span class="d_block r_corners color_default tooltip fs_small tr_all">Follow Us on Twitter</span>
                        <a href="https://twitter.com/nitafashions" target="_blank" class="d_block twitter icon_wrap_size_2 circle color_grey_light_2">
                            <i class="icon-twitter fs_small"></i>
                        </a>
                    </li>
                    <li class="m_right_15 m_bottom_15 tooltip_container m_xs_right_15">
                        <!--tooltip-->
                        <span class="d_block r_corners color_default tooltip fs_small tr_all">Google Plus</span>
                        <a href="#" class="d_block googleplus icon_wrap_size_2 circle color_grey_light_2">
                            <i class="icon-gplus-1 fs_small"></i>
                        </a>
                    </li>

                    <li class="m_right_15 m_bottom_15 tooltip_container">
                        <!--tooltip-->
                        <span class="d_block r_corners color_default tooltip fs_small tr_all">Youtube</span>
                        <a href="https://www.youtube.com/channel/UC5inme9JgQVjEBJJj_7VfHA" target="_blank" class="d_block youtube icon_wrap_size_2 circle color_grey_light_2">
                            <i class="icon-youtube-play fs_small"></i>
                        </a>
                    </li>

                    <li class="m_right_15 m_bottom_15 tooltip_container">
                        <!--tooltip-->
                        <span class="d_block r_corners color_default tooltip fs_small tr_all">Instagram</span>
                        <a href="#" class="d_block instagram icon_wrap_size_2 circle color_grey_light_2">
                            <i class="icon-instagramm fs_small"></i>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_30">
                <h3 class="color_dark fw_light m_bottom_15 heading_1 t_align_c">Contact Form</h3>
                <p class="m_bottom_35 heading_2 t_align_c">Send us Enquiry by filling the form. </p>		
                <form id="" method="post" action="#">
                    <ul>
                        <li class="row m_bottom_10">
                            <div class="col-lg-6 col-md-6 col-sm-6 w_xs_full m_xs_bottom_10">
                                <input type="text" name="name" placeholder="Name*" class="w_full r_corners fw_light" required="">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 w_xs_full">
                                <input type="email" name="email" placeholder="Email*" class="w_full r_corners fw_light" required="">
                            </div>
                        </li>
                        <li class="m_bottom_10">
                            <select name="subject" placeholder="Subject" class="w_full r_corners fw_light bg_light border_light select_title" style="   " required="">
                                <option>Enquiry</option>
                                <option>Send Swatches</option>
                                <option>Feedback</option>
                            </select>
                        </li>
                        <li class="m_bottom_10">
                            <input class="w_full r_corners fw_light " name="address" placeholder="Address" >
                        </li>
                        <li class="m_bottom_5">
                            <textarea class="w_full r_corners fw_light height_3" name="message" placeholder="Message" required=""></textarea>
                        </li>
                        <li class="m_bottom_10">
                            <div class="g-recaptcha" data-sitekey="6LeHqQ0UAAAAAA4nqqGPVY3nw7Uoih8aXHyoQAOc"></div>
                        </li>
                        <li class="m_bottom_10">
                            <button name="submitEnquiry" class="button_type_5 color_blue transparent r_corners fs_medium tr_all m_right_10 m_sm_bottom_10">Submit</button>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</section>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3691.5001960504874!2d114.17316699999999!3d22.296914999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x340400f2069d92bf%3A0x3184e99f392dc91e!2sNITA+FASHIONS!5e0!3m2!1sen!2sin!4v1432895214401" width="1500" height="350" frameborder="0" style="border:0"></iframe>		

<?php

include 'footer.php';
?>	


